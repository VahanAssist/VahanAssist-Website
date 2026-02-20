import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { RouterLink, RouterLinkActive, Router, NavigationEnd } from '@angular/router';

@Component({
  selector: 'app-header',
  standalone: true,
  imports: [RouterLink,CommonModule],
  templateUrl: './header.component.html',
  styleUrl: './header.component.css'
})
export class HeaderComponent {
  loginId:any;
  constructor(private router: Router){
  }

  ngOnInit() {
    if (typeof sessionStorage !== "undefined") {
      this.loginId = sessionStorage.getItem('userId');


      this.router.events.subscribe((evt) => {
        if (!(evt instanceof NavigationEnd)) {
            return;
        }
        window.scrollTo(0, 0)
    });
    }

  }

  logout(){
    if (typeof sessionStorage !== "undefined") {
    sessionStorage.clear();
    }
    location.href = '/';
  }

}
