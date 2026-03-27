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
  submenuOpen = false;
  accountMenuOpen = false;
  servicesMenuOpen = false;

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

  toggleSubmenu(event: Event) {
    event.preventDefault();
    this.submenuOpen = !this.submenuOpen;
  }

  toggleAccountMenu() {
    this.accountMenuOpen = !this.accountMenuOpen;
    if(this.accountMenuOpen) {
      this.servicesMenuOpen = false;
    }
  }

  toggleServicesMenu(event: Event) {
    event.preventDefault();
    this.servicesMenuOpen = !this.servicesMenuOpen;
    if(this.servicesMenuOpen) {
      this.accountMenuOpen = false;
    }
  }

  logout(){
    if (typeof sessionStorage !== "undefined") {
    sessionStorage.clear();
    }
    location.href = '/';
  }

}
