import { Component } from '@angular/core';
import {FormsModule} from '@angular/forms';
import { CommonModule } from '@angular/common';
import { WebapiService } from '../webapi.service';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-trailor-booking',
  standalone: true,
  imports: [CommonModule,FormsModule],
  templateUrl: './trailor-booking.component.html',
  styleUrl: './trailor-booking.component.css'
})
export class TrailorBookingComponent {
  userId:any;
  userType:any='';
  formData:any={};
  pickupList: any=[];
  dropList: any = [];
  cars:any=[];
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

  onTrailerFormSubmit(data:any){
    if(sessionStorage.getItem('userId')){
      this.formData.userId = sessionStorage.getItem('userId');
    }
    if(!data.type && !data.pick && !data.drop && !data.data && !data.time && !data.name && !data.email && !data.phone){
      this.toastr.error('Fill out the required feilds..','Required');
    }
    else{
      data.bookingType = "TRALIOR";
      data.status = "BOOKED";
      this.webapi.insertBooking(data).subscribe((res:any)=>{
        if(res.status == "ok"){
          this.toastr.success(res.message,'Success');
          this.formData = {};
         }
         else{
          this.toastr.error(res.message,'Failed');
         }
      });
    }


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
      this.formData.pickLat = res.data.lat
      this.formData.pickLng = res.data.lng
    });

   }

   getDropLatLngByPlaceId(e:any){
    let val = {
      placeId : e.target.value
    }
    this.webapi.getLatLngByPlaceId(val).subscribe((res:any)=>{
      this.formData.dropLat = res.data.lat
      this.formData.dropLat = res.data.lng
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
  this.formData.carsDetails = JSON.stringify(this.cars);
  }


}
