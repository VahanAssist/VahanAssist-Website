import { Component } from '@angular/core';
import { WebapiService } from '../webapi.service';
import { NgxPaginationModule } from 'ngx-pagination';
import { CommonModule } from '@angular/common';
import { RouterLink } from '@angular/router';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-view-custom-enquiry',
  standalone: true,
  imports: [CommonModule,NgxPaginationModule,RouterLink,FormsModule],
  templateUrl: './view-custom-enquiry.component.html',
  styleUrl: './view-custom-enquiry.component.css'
})
export class ViewCustomEnquiryComponent {
  enquiryList:any;
  filter:any={};
  p: any = 1;
  userId: any;
  total:any=0;

  constructor(private webapi: WebapiService){
    this.filter = {
      userId:'',
      start:1,
      limit:10
    };

    this.userId = sessionStorage.getItem('userId');

    this.getAllCustomEnquiry(this.userId);
  }

  getAllCustomEnquiry(id:any){
    this.filter.userId = id;
    this.webapi.getAllCustomEnquiry(this.filter).subscribe((res: any) => {
      console.log(res);
      this.enquiryList = res.data;
      this.total = res.total
    })
  }

  updateCustomEnquiryStatus(event:any,id:any){
    let val ={
      id:id,
      status:event.target.value
    }
    this.webapi.updateCustomEnquiryStatus(val).subscribe((res: any) => {
      console.log(res,'--');

      if(res.status == 'ok'){
        alert('Enquiry status updated');
        this.getAllCustomEnquiry(this.userId);
      }
      else{
        alert('Enquiry status update Error!!');
        this.getAllCustomEnquiry(this.userId);
      }

    })
  }

  hideMPEnquiry(enqid:any){
    let cn = confirm('Are you sure you want to Update');

    if(cn){
      let val = {
        id:enqid,
        hide:1
      }
      this.webapi.updateCustomEnquiryVisibilty(val).subscribe((res: any) => {
        if(res.status == 'ok'){
          alert('Enquiry status updated');
          this.getAllCustomEnquiry(this.userId);
        }
        else{
          alert('Enquiry status update Error!!');
          this.getAllCustomEnquiry(this.userId);
        }

      })
    }

  }

  onTableDataChange(event: any) {
    this.filter.start = event;
    this.getAllCustomEnquiry(this.userId);
    this.p = event;
 }

}
