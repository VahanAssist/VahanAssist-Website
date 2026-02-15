import { Component } from '@angular/core';
import { RouterLink,Router } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { WebapiService } from '../webapi.service';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-user-account',
  standalone: true,
  imports: [FormsModule,CommonModule,RouterLink],
  templateUrl: './user-account.component.html',
  styleUrl: './user-account.component.css'
})
export class UserAccountComponent {
  formData: any = {};
  userId:any;
  type:any;
  cityList: any;
  stateList: any;
  userDet:any;
  imageUrl: string='';
  constructor(private webapi: WebapiService, private toastr: ToastrService,private router: Router) {
    this.imageUrl = this.webapi.imageBaseUrlv2
    this.userId = sessionStorage.getItem('userId');
    this.type = sessionStorage.getItem('type');
   this.getAllStates();
    if(this.userId){
       this.getUserDetails(this.userId);
    }
  }

  getUserDetails(id:any){
   let val =  {
    userId:id
   }
    this.webapi.getUserById(val).subscribe((res: any) => {
       this.userDet = res;
       this.formData = res;
       this.getAllCityByState(res.state);
       console.log(this.formData);

    });

  }

  getAllStates() {
    this.webapi.getAllStates().subscribe((res: any) => {
         if(res.length > 0) {
          this.stateList = res;
         }
    });
  }

  getAllCityByState(e:any) {
    let val = {
      state:e
    }
    this.webapi.getAllCityByState(val).subscribe((res: any) => {
         if(res.length > 0) {
          this.cityList = res;
         }
    });
  }

  onUpdateUser(data:any){
    this.webapi.updateUser(data).subscribe((res: any) => {
      console.log(res);
      if(res.status == 'success'){
        this.toastr.success('Profile Updated', '');
        location.reload();
      }
      else{
        this.toastr.error('Erron on Profile Update!', '');

      }

    });

  }

  setLogo(e:any){
   this.formData.logo = e.target.files[0];
  }

  setGST(e:any){
    this.formData.gst = e.target.files[0];
   }

   setPAN(e:any){
    this.formData.pan = e.target.files[0];
   }
}
