import { Component } from '@angular/core';
import { WebapiService } from '../webapi.service';
import { NgxPaginationModule } from 'ngx-pagination';
import { CommonModule } from '@angular/common';
import { RouterLink } from '@angular/router';
import { FormsModule } from '@angular/forms';


@Component({
  selector: 'app-view-enquiry',
  standalone: true,
  imports: [CommonModule,NgxPaginationModule,RouterLink,FormsModule],
  templateUrl: './view-enquiry.component.html',
  styleUrl: './view-enquiry.component.css'
})
export class ViewEnquiryComponent {
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

    this.getAllEnquiry(this.userId);
  }

  getAllEnquiry(id:any){
    this.filter.userId = id;
    this.webapi.getAllEnquiry(this.filter).subscribe((res: any) => {
      console.log(res);
      this.enquiryList = res.data;
      this.total = res.total
    })
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
          this.getAllEnquiry(this.userId);
        }
        else{
          alert('Enquiry status update Error!!');
          this.getAllEnquiry(this.userId);
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
          this.getAllEnquiry(this.userId);
        }
        else{
          alert('Enquiry status update Error!!');
          this.getAllEnquiry(this.userId);
        }

      })
    }

  }

  onTableDataChange(event: any) {
    this.filter.start = event;
    this.getAllEnquiry(this.userId);
    this.p = event;
 }

}
