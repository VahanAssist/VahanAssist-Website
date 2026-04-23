import { Component } from '@angular/core';
import { RouterLink, Router } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { WebapiService } from '../webapi.service';
import { ToastrService } from 'ngx-toastr';
import { environment } from '../../environments/environment';
import { initializeApp } from "firebase/app";
import { getMessaging, getToken } from "firebase/messaging";

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [RouterLink, CommonModule, FormsModule],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {
  formData: any = { type: '' };
  constructor(private webapi: WebapiService, private toastr: ToastrService, private router: Router) {
  }

  onLoginFormSubmit(data: any) {
    if (!data.phoneNumber || !data.password || !data.type) {
      this.toastr.error('Fill out the required fields', 'Required');
    }
    else {
      this.webapi.getUser(data).subscribe((res: any) => {
        if (res.status == "ok") {
          sessionStorage.setItem('userId', res.data.userId);
          sessionStorage.setItem('name', res.data.name);
          sessionStorage.setItem('type', res.data.type);
          sessionStorage.setItem('city', res.data.city);

          try {
            const app = initializeApp(environment.firebaseConfig);
            const messaging = getMessaging(app);
            Notification.requestPermission().then((permission) => {
              if (permission === 'granted') {
                getToken(messaging).then((currentToken) => {
                  if (currentToken) {
                    this.webapi.updateDeviceToken({ userId: res.data.userId, token: currentToken }).subscribe(() => {
                      location.href = '/user-profile';
                    });
                  } else {
                    location.href = '/user-profile';
                  }
                }).catch((err) => {
                  console.error('An error occurred while retrieving token. ', err);
                  location.href = '/user-profile';
                });
              } else {
                location.href = '/user-profile';
              }
            });
          } catch (error) {
            console.error('Firebase initialization error', error);
            location.href = '/user-profile';
          }
        }
        else {
          this.toastr.error(res.message, 'Failed');
        }
      });
    }

  }
}
