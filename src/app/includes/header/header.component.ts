import { CommonModule } from '@angular/common';
import { Component, HostListener, OnDestroy, OnInit } from '@angular/core';
import { NavigationEnd, Router, RouterLink } from '@angular/router';
import { getApp, getApps, initializeApp } from 'firebase/app';
import { getMessaging, onMessage } from 'firebase/messaging';
import { environment } from '../../../environments/environment';
import { WebapiService } from '../../webapi.service';

@Component({
  selector: 'app-header',
  standalone: true,
  imports: [RouterLink, CommonModule],
  templateUrl: './header.component.html',
  styleUrl: './header.component.css'
})
export class HeaderComponent implements OnInit, OnDestroy {
  loginId: any;
  submenuOpen = false;
  accountMenuOpen = false;
  servicesMenuOpen = false;
  notificationOpen = false;
  notifications: any[] = [];
  unreadCount = 0;
  private pollInterval: any;

  constructor(private router: Router, private webapi: WebapiService) {
  }

  ngOnInit() {
    if (typeof sessionStorage !== 'undefined') {
      this.loginId = sessionStorage.getItem('userId');

      this.router.events.subscribe((evt) => {
        if (!(evt instanceof NavigationEnd)) {
          return;
        }
        window.scrollTo(0, 0);
      });

      if (this.loginId) {
        this.fetchNotifications();
        this.pollInterval = setInterval(() => {
          this.fetchNotifications();
        }, 30000);
        this.setupFirebaseListener();
      }
    }
  }

  ngOnDestroy() {
    if (this.pollInterval) {
      clearInterval(this.pollInterval);
    }
  }

  setupFirebaseListener() {
    try {
      const app = getApps().length ? getApp() : initializeApp(environment.firebaseConfig);
      const messaging = getMessaging(app);

      onMessage(messaging, (payload: any) => {
        const newNotif = {
          id: Date.now(),
          title: payload.notification?.title || 'New Notification',
          message: payload.notification?.body || '',
          is_read: '0',
          created_at: new Date().toISOString()
        };
        this.notifications.unshift(newNotif);
        this.unreadCount++;
      });
    } catch (error) {
      console.error('Firebase foreground listener error:', error);
    }
  }

  fetchNotifications() {
    if (!this.loginId) {
      return;
    }

    this.webapi.getNotifications({ userId: this.loginId }).subscribe((res: any) => {
      if (res.status === 'success' && res.data) {
        this.notifications = res.data;
        this.unreadCount = this.notifications.filter((notification: any) => notification.is_read === '0' || notification.is_read === 0).length;
      }
    });
  }

  toggleNotifications() {
    this.notificationOpen = !this.notificationOpen;
    if (this.notificationOpen) {
      this.accountMenuOpen = false;
      this.servicesMenuOpen = false;
      if (this.unreadCount > 0) {
        this.webapi.markNotificationsRead({ userId: this.loginId }).subscribe(() => {
          this.unreadCount = 0;
          this.notifications.forEach((notification: any) => notification.is_read = '1');
        });
      }
    }
  }

  @HostListener('document:click', ['$event'])
  onDocumentClick(event: Event) {
    const target = event.target as HTMLElement;
    if (!target.closest('.nav-notification-wrapper')) {
      this.notificationOpen = false;
    }
    if (!target.closest('.nav-account-dropdown')) {
      this.accountMenuOpen = false;
    }
  }

  getTimeAgo(dateStr: string): string {
    const now = new Date();
    const date = new Date(dateStr);
    const diffMs = now.getTime() - date.getTime();
    const diffMins = Math.floor(diffMs / 60000);
    const diffHrs = Math.floor(diffMins / 60);
    const diffDays = Math.floor(diffHrs / 24);

    if (diffMins < 1) return 'Just now';
    if (diffMins < 60) return diffMins + 'm ago';
    if (diffHrs < 24) return diffHrs + 'h ago';
    if (diffDays < 7) return diffDays + 'd ago';
    return date.toLocaleDateString('en-IN', { day: 'numeric', month: 'short' });
  }

  toggleSubmenu(event: Event) {
    event.preventDefault();
    this.submenuOpen = !this.submenuOpen;
  }

  toggleAccountMenu() {
    this.accountMenuOpen = !this.accountMenuOpen;
    if (this.accountMenuOpen) {
      this.servicesMenuOpen = false;
      this.notificationOpen = false;
    }
  }

  toggleServicesMenu(event: Event) {
    event.preventDefault();
    this.servicesMenuOpen = !this.servicesMenuOpen;
    if (this.servicesMenuOpen) {
      this.accountMenuOpen = false;
    }
  }

  logout() {
    if (typeof sessionStorage !== 'undefined') {
      sessionStorage.clear();
    }
    location.href = '/';
  }
}
