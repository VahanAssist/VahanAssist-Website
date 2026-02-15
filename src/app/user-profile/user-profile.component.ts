import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { RouterLink,  Router, RouterLinkActive, NavigationEnd } from '@angular/router';

@Component({
  selector: 'app-user-profile',
  standalone: true,
  imports: [RouterLink,CommonModule],
  templateUrl: './user-profile.component.html',
  styleUrl: './user-profile.component.css'
})
export class UserProfileComponent {
   userName:any='';
   userType:any='';
   constructor(private router: Router){
    this.userName = sessionStorage.getItem('name');
    this.userType = sessionStorage.getItem('type');
   }

   ngOnInit() {
    this.router.events.subscribe((evt) => {
        if (!(evt instanceof NavigationEnd)) {
            return;
        }
        window.scrollTo(0, 0)
    });
}
}
