import { Component } from '@angular/core';
import { WebapiService } from '../webapi.service';
import { NgxPaginationModule } from 'ngx-pagination';
import { CommonModule } from '@angular/common';
import { RouterLink, ActivatedRoute } from '@angular/router';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-view-enquiry-vehicle',
  standalone: true,
  imports: [CommonModule,NgxPaginationModule,RouterLink,FormsModule],
  templateUrl: './view-enquiry-vehicle.component.html',
  styleUrl: './view-enquiry-vehicle.component.css'
})

export class ViewEnquiryVehicleComponent {
  enquiryList:any[] = [];
  filter:any={};
  p: any = 1;
  vehicleId: any;
  total:any=0;

  constructor(private webapi: WebapiService, private activatedRoute: ActivatedRoute){
    this.filter = {
      vehicleId:'',
      start:1,
      limit:10
    };

    this.vehicleId = this.activatedRoute.snapshot.paramMap.get('id');

    if (this.vehicleId) {
      this.getEnquiries();
    }
  }

  getEnquiries(){
    this.filter.vehicleId = this.vehicleId;
    this.webapi.getEnquiriesByVehicle(this.filter).subscribe((res: any) => {
      if(res.status === 'success') {
        this.enquiryList = res.data;
        this.total = res.total;
      }
    });
  }

  updateEnquiryStatus(event:any,id:any){
    let cn = confirm('Are you sure you want to Update');

    if(cn){
      let val ={
        id:id,
        status:event.target.value
      }
      this.webapi.updateEnquiryStatus(val).subscribe((res: any) => {
        if(res.status == 'ok'){
          alert('Enquiry status updated');
          this.getEnquiries();
        }
        else{
          alert('Enquiry status update Error!!');
          this.getEnquiries();
        }

      });
    }

  }

  hideMPEnquiry(enqid:any){
    let cn = confirm('Are you sure you want to Update');

    if(cn){
      let val = {
        id:enqid,
        hide:1
      }
      this.webapi.updateEnquiryVisibilty(val).subscribe((res: any) => {
        if(res.status == 'ok'){
          alert('Enquiry status updated');
          this.getEnquiries();
        }
        else{
          alert('Enquiry status update Error!!');
          this.getEnquiries();
        }

      })
    }

  }

  onTableDataChange(event: any) {
    this.filter.start = event;
    this.getEnquiries();
    this.p = event;
 }

}
