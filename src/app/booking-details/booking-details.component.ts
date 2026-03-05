import { Component, OnInit } from '@angular/core';
import { CommonModule, Location } from '@angular/common';
import { ActivatedRoute, RouterLink } from '@angular/router';
import { WebapiService } from '../webapi.service';
import { ToastrService } from 'ngx-toastr';

declare var Razorpay: any;

@Component({
  selector: 'app-booking-details',
  standalone: true,
  imports: [CommonModule, RouterLink],
  templateUrl: './booking-details.component.html',
  styleUrl: './booking-details.component.css'
})
export class BookingDetailsComponent implements OnInit {
  bookingId: any;
  userId: any;
  bookingDetails: any;
  carDetails: any;
  driver1: any;
  driver2: any;
  vahanName: string = '';
  loading: boolean = true;

  constructor(
    private route: ActivatedRoute,
    private webapi: WebapiService,
    private toastr: ToastrService,
    private location: Location
  ) { }

  goBack(): void {
    this.location.back();
  }

  ngOnInit(): void {
    if (typeof sessionStorage !== 'undefined') {
      this.userId = sessionStorage.getItem('userId');
    }
    this.bookingId = this.route.snapshot.paramMap.get('id');
    if (this.bookingId) {
      this.loadBookingDetails();
    }
  }

  loadBookingDetails() {
    this.webapi.getBookingDetails({ bookingId: this.bookingId }).subscribe(
      (res: any) => {
        if (res && res.status === 'success') {
          let payload = res.data;
          this.bookingDetails = payload.booking ? payload.booking[0] : null;
          this.carDetails = payload.car;
          this.driver1 = payload.driver1 ? payload.driver1[0] : null;
          this.driver2 = payload.driver2 ? payload.driver2[0] : null;
          this.vahanName = payload.vahan;
        } else {
          this.toastr.error('Failed to load booking details');
        }
        this.loading = false;
      },
      (error) => {
        this.toastr.error('Error fetching data');
        this.loading = false;
      }
    );
  }

  payQuote() {
    if (!this.userId || !this.bookingId) return;

    let payReq = {
      user_id: this.userId,
      booking_id: this.bookingId
    };

    this.webapi.createOrderRazorPayBooking(payReq).subscribe((res: any) => {
      if (res.status == 'success') {
        const options: any = {
          key: 'rzp_live_SJ4vZVaVQgQY12',
          amount: res.data.amount * 100,
          currency: 'INR',
          name: 'Vahaan Assist',
          description: 'Booking Quote Payment',
          image: 'assets/images/logo.png',
          order_id: res.data.order_id,
          modal: {
            escape: false,
          },
          prefill: {
            name: res.data.name,
            email: res.data.email,
            contact: res.data.phoneNumber
          },
          handler: (response: any) => {
            this.verifyPayment(response);
          },
          theme: {
            color: '#00ccff'
          }
        };

        const rzp = new Razorpay(options);
        rzp.open();
      } else {
        this.toastr.error(res.msg);
      }
    });
  }

  verifyPayment(response: any) {
    this.webapi.verifyRazorPaymentBooking({
      razorpay_order_id: response.razorpay_order_id,
      razorpay_payment_id: response.razorpay_payment_id,
      razorpay_signature: response.razorpay_signature
    }).subscribe((res: any) => {
      if (res.status === 'success') {
        this.toastr.success('Payment Successful!');
        this.loadBookingDetails();
      } else {
        this.toastr.error(res.msg);
      }
    });
  }
}
