import { Component } from '@angular/core';

import { RouterLink, Router } from '@angular/router';

import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { WebapiService } from '../webapi.service';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-forgotpwd',
  standalone: true,
  imports: [RouterLink, FormsModule, CommonModule],
  templateUrl: './forgotpwd.component.html',
  styleUrl: './forgotpwd.component.css'
})
export class ForgotpwdComponent {
  formData: any = {};
  constructor(private webapi: WebapiService, private toastr: ToastrService, private router: Router) {
  }

  onForgotFormSubmit(data: any) {
    if (!data.email) {
      this.toastr.error('Please enter your email address', 'Required');
    }
    else {
      this.webapi.forgetPassword(data).subscribe((res: any) => {
        if (!res) {
          this.toastr.error('Server error. Please try again.', 'Error');
        } else if (res.msg == "email Sent") {
          this.toastr.success('New password sent to your email', 'Success');
          this.router.navigate(['/login']);
        } else if (res.msg == "email Not found") {
          this.toastr.error('No account found with this email', 'Failed');
        } else {
          this.toastr.warning(res.msg, 'Notice');
        }
      });
    }
  }
}
