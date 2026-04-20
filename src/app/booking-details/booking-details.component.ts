import { Component, OnInit } from '@angular/core';
import { CommonModule, Location, DatePipe } from '@angular/common';
import { ActivatedRoute, RouterLink } from '@angular/router';
import { WebapiService } from '../webapi.service';
import { ToastrService } from 'ngx-toastr';
import { environment } from '../../environments/environment';

declare var Razorpay: any;

@Component({
  selector: 'app-booking-details',
  standalone: true,
  imports: [CommonModule, RouterLink, DatePipe],
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
  
  // Tracking & Images
  trackingHistory: any[] = [];
  transitStatus: any[] = [];
  pickupImages: any[] = [];
  handoverImages: any[] = [];
  loadingImages: any[] = [];
  dropImages: any[] = [];
  
  // Unified timeline
  timeline: any[] = [];
  
  // Lightbox
  lightboxImage: string = '';
  showLightbox: boolean = false;
  
  imageBaseUrl: string = environment.imageBaseUrl;

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
          
          this.trackingHistory = payload.tracking || [];
          this.transitStatus = payload.transitStatus || [];
          this.pickupImages = payload.pickupImages || [];
          this.handoverImages = payload.handoverImages || [];
          this.loadingImages = payload.loadingImages || [];
          this.dropImages = payload.dropImages || [];
          
          this.buildTimeline();
          
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

  buildTimeline() {
    this.timeline = [];
    
    // Add tracking entries
    for (let t of this.trackingHistory) {
      this.timeline.push({
        type: 'tracking',
        date: t.date_time,
        label: t.comment,
        icon: 'mdi-message-text-outline'
      });
    }
    
    // Add transit status entries
    for (let s of this.transitStatus) {
      let icon = 'mdi-truck-delivery';
      let label = s.status_label.toLowerCase();
      if (label.includes('loaded')) icon = 'mdi-package-up';
      else if (label.includes('unloaded')) icon = 'mdi-package-down';
      else if (label.includes('crossed') || label.includes('transit')) icon = 'mdi-map-marker-path';
      else if (label.includes('completed')) icon = 'mdi-check-circle';
      
      this.timeline.push({
        type: 'transit',
        date: s.date_time,
        label: s.status_label,
        comment: s.comment,
        icon: icon
      });
    }
    
    // Sort by date ascending
    this.timeline.sort((a, b) => new Date(a.date).getTime() - new Date(b.date).getTime());
  }

  openLightbox(img: string) {
    this.lightboxImage = this.imageBaseUrl + img;
    this.showLightbox = true;
  }

  closeLightbox() {
    this.showLightbox = false;
    this.lightboxImage = '';
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
