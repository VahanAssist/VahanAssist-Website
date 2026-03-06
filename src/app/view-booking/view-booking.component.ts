import { Component, OnInit } from '@angular/core';
import { CommonModule, Location } from '@angular/common';
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

    constructor(private webapi: WebapiService, private location: Location) {
        if (typeof sessionStorage !== 'undefined') {
            this.userId = sessionStorage.getItem('userId');
        }
    }

    goBack(): void {
        this.location.back();
    }

    getTypeClass(type: string): string {
        if (type === 'TRAILER') return 'bg-primary';
        if (type === 'INSPECTION') return 'bg-info';
        return 'bg-secondary';
    }

    getStatusClass(status: string): string {
        if (status === 'BOOKED') return 'bg-warning text-dark';
        if (status === 'ASSIGNED') return 'bg-primary';
        if (status === 'ONGOING') return 'bg-info';
        if (status === 'REASSIGNED' || status === 'NEW') return 'bg-secondary';
        if (status === 'COMPLETED') return 'bg-success';
        if (status === 'CANCELLED' || status === 'CANCEL') return 'bg-danger';
        return 'bg-secondary';
    }

    ngOnInit(): void {
        if (this.userId) {
            this.loadBookings();
        }
    }

    loadBookings() {
        this.webapi.getAllBooking({ userId: this.userId }).subscribe((res: any) => {
            if (res && res.status === 'success' && res.data) {
                let allBookings: any[] = [];
                if (res.data.booking && res.data.booking.length > 0) {
                    allBookings = [...allBookings, ...res.data.booking];
                }
                if (res.data.trailer && res.data.trailer.length > 0) {
                    allBookings = [...allBookings, ...res.data.trailer];
                }

                allBookings.sort((a, b) => parseInt(b.id) - parseInt(a.id));
                this.bookings = allBookings;
            } else {
                this.bookings = [];
            }
        });
    }
}
