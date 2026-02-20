import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { WebapiService } from '../webapi.service';
import { CommonModule } from '@angular/common';
import { ToastrService } from 'ngx-toastr';
import { Router, RouterLink,RouterLinkActive } from '@angular/router';
import { LoadingBarModule } from '@ngx-loading-bar/core';
import { LoadingBarService } from '@ngx-loading-bar/core';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [FormsModule, RouterLink,CommonModule,LoadingBarModule],
  templateUrl: './home.component.html',
  styleUrl: './home.component.css',
  host: {ngSkipHydration: 'true'},
})
export class HomeComponent {

  homeVehList:any;
  imageUrl:any;
  userId:any;
  userType:any='';

  constructor(private webapi:WebapiService,private toastr:ToastrService,private loading : LoadingBarService,private router:Router){

    this.imageUrl = this.webapi.imageBaseUrl;

    if (typeof sessionStorage !== "undefined") {

    this.userId = sessionStorage.getItem('userId');
    this.userType = sessionStorage.getItem('type');
    }
    if(this.userId){
      if(this.userType == 'DEALER'){
        this.getHomeCarsWithLimit(8,this.userId,JSON.stringify(['stc','std']));
      }
      else if(this.userType == 'USER'){
        this.getHomeCarsWithLimit(8,this.userId,JSON.stringify(['stc']));

      }
    }
    else{
      this.getHomeCarsWithLimit(8,this.userId,'')
    }


  }
  enquiryData: any = {};

  checkLoginUser(slug:any,addedby:any){
    if(!this.userId){
      this.toastr.error('Please Login first','');
      this.router.navigate([`/login`]);
    }
    else{

      if(this.userId == addedby){
      this.router.navigate([`view-vehicle`]);
      }
      else{
        this.router.navigate([`/vehicle-details/${slug}`]);
      }
    }
  }

  insertEnquiry(data:any){
   if(!data.name && !data.email && !data.phoneNumber && !data.message){
        this.toastr.error('Please provide a name , email and Phone Number.','Required');
        return
   }
   if(data.name && data.email && data.phoneNumber){
      data.type="WEB";
     this.webapi.insertEnquiry(data).subscribe((res:any)=>{
         if(res.status == "ok"){
          this.toastr.success(res.message,'Success');
          this.enquiryData = {};
         }
         else{
          this.toastr.error(res.message,'Failed');
         }
     });
   }
   else{
    this.toastr.error('Name, Email and Phone must be provided','Required');
   }
  }

  getHomeCarsWithLimit(num:any,id:any,listing:any){
    let val = {
      limit:num,
      notinId:id ? id : '',
      listing:listing
    }
    this.webapi.getHomeCarsWithLimit(val).subscribe((res:any)=>{
      // console.log(res);
      if(res){
        this.homeVehList = res;
        this.loading.complete();
      }
      else{
        this.homeVehList = [];
      }
    });
  }

}
