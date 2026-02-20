import { Component } from '@angular/core';

import { RouterLink,Router } from '@angular/router';

import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { WebapiService } from '../webapi.service';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-forgotpwd',
  standalone: true,
  imports: [RouterLink],
  templateUrl: './forgotpwd.component.html',
  styleUrl: './forgotpwd.component.css'
})
export class ForgotpwdComponent {
  formData:any ={};
  constructor(private webapi: WebapiService, private toastr: ToastrService,private router: Router) {
  }
}
