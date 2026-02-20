import { Component } from '@angular/core';
import { RouterLink,Router } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { WebapiService } from '../webapi.service';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [RouterLink, CommonModule, FormsModule],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {
  formData:any ={};
  constructor(private webapi: WebapiService, private toastr: ToastrService,private router: Router) {
  }

  onLoginFormSubmit(data: any) {
    if (!data.phoneNumber || !data.password) {
      this.toastr.error('Fill out the required feilds', 'Required');
    }
    else {
        this.webapi.getUser(data).subscribe((res: any) => {
          if (res.status == "ok") {
            sessionStorage.setItem('userId',res.data.userId);
            sessionStorage.setItem('name',res.data.name);
            sessionStorage.setItem('type',res.data.type);
            sessionStorage.setItem('city',res.data.city);

            // this.router.navigate(['/'])
            location.href = '/';
          }
          else {
            this.toastr.error(res.message, 'Failed');
          }
        });
    }

  }
}
