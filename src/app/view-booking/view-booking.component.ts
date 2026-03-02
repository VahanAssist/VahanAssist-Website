import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterLink } from '@angular/router';
import { WebapiService } from '../webapi.service';

@Component({
    selector: 'app-view-booking',
    standalone: true,
    imports: [CommonModule, RouterLink],
    templateUrl: './view-booking.component.html',
    styleUrl: './view-booking.component.css'
})
export class ViewBookingComponent implements OnInit {
    bookings: any[] = [];
    userId: any;

    constructor(private webapi: WebapiService) {
        this.userId = sessionStorage.getItem('userId');
    }

    ngOnInit(): void {
        if (this.userId) {
            this.loadBookings();
        }
    }

    loadBookings() {
        this.webapi.getAllBooking({ userId: this.userId }).subscribe((res: any) => {
            if (res) {
                this.bookings = res;
            }
        });
    }
}
