import { Component } from '@angular/core';
import { RouterLink,Router } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { WebapiService } from '../webapi.service';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-signup',
  standalone: true,
  imports: [RouterLink, CommonModule, FormsModule],
  templateUrl: './signup.component.html',
  styleUrl: './signup.component.css'
})
export class SignupComponent {
  formData: any = {};
  stateList:any=[];
  cityList:any=[];
  constructor(private webapi: WebapiService, private toastr: ToastrService,private router: Router) {
    this.getAllStates();
  }

  onSignupFormSubmit(data: any) {
    if (!data.firstName || !data.email || !data.password || !data.phoneNumber) {
      this.toastr.error('Fill out the required feilds', 'Required');
    }
    else {

      if (data.check == true) {
        data.type = 'USER';
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
          // console.log(this.stateList);

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
          // console.log(this.cityList);

         }
    });
  }

}
