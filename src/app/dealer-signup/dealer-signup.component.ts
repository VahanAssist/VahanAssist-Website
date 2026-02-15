import { Component } from '@angular/core';
import { RouterLink,Router } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { WebapiService } from '../webapi.service';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-dealer-signup',
  standalone: true,
  imports: [RouterLink, CommonModule, FormsModule],
  templateUrl: './dealer-signup.component.html',
  styleUrl: './dealer-signup.component.css'
})
export class DealerSignupComponent {
  userId:any;
  type:any;
  formData: any = {};
  stateList:any={};
  cityList:any={};
  userName:any='';
  constructor(private webapi: WebapiService, private toastr: ToastrService,private router: Router) {
    this.userId = sessionStorage.getItem('userId');
    this.type = sessionStorage.getItem('type');
    this.userName = sessionStorage.getItem('name');
    this.getAllStates();
  }

  onSignupFormSubmit(data: any) {
    if (!data.firstName || !data.email || !data.password || !data.phoneNumber) {
      this.toastr.error('Fill out the required feilds', 'Required');
    }
    else {

      if (data.check == true) {
        data.type = 'DEALER';
        this.webapi.insertUser(data).subscribe((res: any) => {
          if (res.status == "ok") {
            this.toastr.success(res.message, 'Success');
            this.formData = {};
            this.router.navigate(['/login']);
          }
          else {
            this.toastr.error(res.message, 'Failed');
          }
        });
      }
      else {
        this.toastr.error('check terms and conditions', 'Required');

      }

    }

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
      state:e.target.value
    }
    this.webapi.getAllCityByState(val).subscribe((res: any) => {
         if(res.length > 0) {
          this.cityList = res;
         }
    });
  }

  logout(){
    sessionStorage.clear();
    location.href = '/';
  }
}
