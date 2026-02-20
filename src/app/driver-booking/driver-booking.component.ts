import { Component } from '@angular/core';
import {FormsModule,ReactiveFormsModule,FormGroup, FormControl, Validators} from '@angular/forms';
import { CommonModule } from '@angular/common';
import { WebapiService } from '../webapi.service';
import { ToastrService } from 'ngx-toastr';
import { SharedModule } from '../shared/shared.module';
@Component({
  selector: 'app-driver-booking',
  standalone: true,
  imports: [CommonModule,FormsModule,ReactiveFormsModule,SharedModule],
  templateUrl: './driver-booking.component.html',
  styleUrl: './driver-booking.component.css'
})
export class DriverBookingComponent {
  cars:any=[];
  userId:any;
  userType:any='';
  bookingForm = new FormGroup({
  type: new FormControl('',[Validators.required]),
  date: new FormControl('',[Validators.required]),
  time: new FormControl('',[Validators.required]),
  name: new FormControl('',[Validators.required]),
  phone: new FormControl('',[Validators.required]),
  email: new FormControl('',[Validators.required,Validators.email]),
  comments: new FormControl(''),
  pickLat: new FormControl('',[Validators.required]),
    dropLat: new FormControl('',[Validators.required]),
    pickLng: new FormControl('',[Validators.required]),
    dropLng: new FormControl('',[Validators.required]),
    status: new FormControl('BOOKED',),
    bookingType: new FormControl('DRIVER',),
    userId: new FormControl('',),
    carsDetails: new FormControl('',)
  })
  pickupList: any=[];
  dropList: any = [];

  constructor(private webapi:WebapiService,private toastr:ToastrService){
    if(sessionStorage.getItem('userId')){
      this.userId = sessionStorage.getItem('userId');
      this.userType = sessionStorage.getItem('type');
    }

    this.cars = [
      {
        "model":""
      }
    ]

  }



  onBookingFormSubmit(){
    if(sessionStorage.getItem('userId')){
      this.bookingForm.patchValue({userId: sessionStorage.getItem('userId')});
    }
    this.webapi.insertBooking(this.bookingForm.value).subscribe((res:any)=>{
      // console.log(res,'--');
      if(res.status == "ok"){
        this.toastr.success(res.message,'Success');
        this.bookingForm.reset();
       }
       else{
        this.toastr.error(res.message,'Failed');
       }
    });
  }

  getPickupLocation(e:any){
    if(e.target.value){
      let val = {
        "query":e.target.value
      }
      this.webapi.getPlacesByText(val).subscribe((res:any)=>{
         this.pickupList = res.data;
      });
    }
    else{
      console.log('ff');
    }

  }

  getDropLocation(e:any){
    if(e.target.value){
      let val = {
        "query":e.target.value
      }
      this.webapi.getPlacesByText(val).subscribe((res:any)=>{
        this.dropList = res.data;
      });
    }
    else{
      console.log('ff');
    }

  }
   getPickLatLngByPlaceId(e:any){

    let val = {
      placeId : e.target.value
    }
    this.webapi.getLatLngByPlaceId(val).subscribe((res:any)=>{
      this.bookingForm.get('pickLat')?.setValue(res.data.lat);
      this.bookingForm.get('pickLng')?.setValue(res.data.lng);
    });

   }

   getDropLatLngByPlaceId(e:any){
    let val = {
      placeId : e.target.value
    }
    this.webapi.getLatLngByPlaceId(val).subscribe((res:any)=>{
      this.bookingForm.get('dropLat')?.setValue(res.data.lat);
      this.bookingForm.get('dropLng')?.setValue(res.data.lng);
    });
   }

   onDocUpload(e: any,index:any) {
    let obj = { "image" : e.target.files[0]};
    this.webapi.uploadDocument(obj).subscribe((res:any)=>{
       if(res.status == "ok"){
        this.cars[index].image = res.image;
       }
       else{
        this.cars[index].image = '';
       }
    });


  }

   addRow(){
    this.cars.push({});
  }

  removeRow(i:any){
    console.log(i);
    this.cars.splice(i,1);

  }

  saveCardDetails(){
  this.bookingForm.get('carsDetails')?.setValue(JSON.stringify(this.cars));
  }



}
