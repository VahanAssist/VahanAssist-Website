import { Component } from '@angular/core';
import { RouterLink, Router, ActivatedRoute, NavigationEnd} from '@angular/router';
import { CommonModule } from '@angular/common';
import { WebapiService } from '../webapi.service';
import { ToastrService } from 'ngx-toastr';
import { CarouselModule,OwlOptions  } from 'ngx-owl-carousel-o';
import { NgMagnizoomModule } from 'ng-magnizoom';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-vehicle-detail',
  standalone: true,
  imports: [RouterLink, CommonModule,CarouselModule, NgMagnizoomModule, FormsModule],
  templateUrl: './vehicle-detail.component.html',
  styleUrl: './vehicle-detail.component.css'
})
export class VehicleDetailComponent {

  customOptions: OwlOptions = {
    loop: true,
    mouseDrag: true,
    touchDrag: true,
    pullDrag: true,
    dots: true,
    autoplay: true,
    navSpeed: 500,
    navText: ['', ''],
    responsive: {
      0: {
        items: 1
      },
      400: {
        items: 1
      },
      740: {
        items: 1
      },
      940: {
        items: 1
      }
    },
    nav: false
  }

  vehicleId:any;
  imageUrl: any;
  vehicleDetail:any;
 userId:any;
 contactFlag: boolean=false;
  moreVehicleData: any;
  vehicleModelData:any={};
  showContactModal: boolean = false;

  // Price Modal
  showPriceModal: boolean = false;
  priceValue: any = '';
  selectedVid: any;

  // Appointment Modal
  showAppointmentModal: boolean = false;
  apptDate: string = '';
  apptTime: string = '';
  apptNote: string = '';

  constructor(private webapi: WebapiService, private router: Router,private activatedRoute: ActivatedRoute,private toastr: ToastrService,){
    this.imageUrl = this.webapi.imageBaseUrl;
    this.userId = sessionStorage.getItem("userId");
    this.activatedRoute.params.subscribe(params => {
      this.vehicleId = params['id'];
    });

    if(this.vehicleId){
    this.getVehicleById(this.vehicleId);
    }


  }

  ngOnInit() {
    this.router.routeReuseStrategy.shouldReuseRoute = function () {
      return false;
  }
  this.router.onSameUrlNavigation = 'reload';
}

zoomIn(event: any) {
  event.target.style.transform = 'scale(1.5)';
}

zoomOut(event: any) {
  event.target.style.transform = 'scale(1)';
}

  getVehicleById(id:any){
    let val = {
      id:id,
     }
     this.webapi.getVehicleById(val).subscribe((res: any) => {

      if(res.status == 'success'){
        this.vehicleDetail = res.data;
        this.vehicleModelData = {...res.data.model_data};
        console.log(this.vehicleModelData,'----j');
        this.getMoreVehicleByDealer(res.data.id,res.data.added_by,res.data.category_id,res.data.brand_id,res.data.model_id);
      }
      else{
        this.vehicleDetail = {};
      }

     });
   }

   getMoreVehicleByDealer(vehId:any,dealerId:any,cat:any,brand:any, model:any){
     let val = {
      id:vehId,
      dealerId:dealerId
     }
     this.webapi.getMoreMPVehicleByDealer(val).subscribe((res: any) => {
      if(res.status == "success"){
        this.moreVehicleData = res.data;
      }
      else{
        this.getMoreVehicleBySameCars(cat,brand,model);
      }

     });
   }

   getMoreVehicleBySameCars(cat:any,brand:any, model:any){
    let val = {
     cat_id:cat,
     brand_id:brand,
     model_id:model
    }
    this.webapi.getMoreVehicleBySameCars(val).subscribe((res: any) => {
     if(res.status == "success"){
      this.moreVehicleData = res.data;
     }
     else{
      this.moreVehicleData = [];
     }
    });
  }


  dealerDetails(dealerId:any){

    if(!this.userId){
      this.toastr.error('Login in first!!', '');
    }
    else{
      this.router.navigate([`/dealer-details/${dealerId}`]);
    }

  }

  // Contact Owner - opens bottom sheet modal
  contactOwner(vid:any, dealerId:any){
    if(!this.userId){
      this.toastr.error('Please Login First', '');
      return;
    }

    // Submit enquiry
    let val = {
      vehicle_id: vid,
      user_id: this.userId,
      dealer_id: dealerId,
      status: "Enquired"
    };

    this.webapi.insertMPEnquiry(val).subscribe((res: any) => {
      if(res.status == "success"){
        this.toastr.success('Enquiry Submitted Successfully', '');
        this.contactFlag = true;
        this.showContactModal = true;
      }
      else{
        this.toastr.error('Failed to submit enquiry', '');
      }
    },
    (error: any) => {
      this.toastr.error('Internal Server Error', '');
    });
  }

  // Close contact modal
  closeContactModal(){
    this.showContactModal = false;
  }

  // WhatsApp action
  openWhatsApp(phone: string){
    const cleanPhone = phone?.replace(/\D/g, '');
    if(cleanPhone){
      window.open(`https://wa.me/91${cleanPhone}`, '_blank');
    }
    this.showContactModal = false;
  }

  // Call action
  callOwner(phone: string){
    const cleanPhone = phone?.replace(/\D/g, '');
    if(cleanPhone){
      window.open(`tel:+91${cleanPhone}`, '_self');
    }
    this.showContactModal = false;
  }

  // Request Price
  requestPrice(vid:any, dealerId:any){
    if(!this.userId){
      this.toastr.error('Please Login First', '');
      return;
    }
    this.selectedVid = vid;
    this.priceValue = this.vehicleDetail?.price || '';
    this.showPriceModal = true;
  }

  closePriceModal() {
    this.showPriceModal = false;
  }

  submitPriceRequest() {
    let val = {
      vehicle_id: this.selectedVid,
      user_id: this.userId,
      price: this.priceValue
    };

    this.webapi.insertPriceRequest(val).subscribe((res: any) => {
      if(res.status == "success"){
        this.toastr.success('Price Request Sent Successfully', '');
        this.showPriceModal = false;
      }
      else{
        this.toastr.error('Failed to send price request', '');
      }
    },
    (error: any) => {
      this.toastr.error('Internal Server Error', '');
    });
  }

  // Book Appointment
  bookAppointment(vid:any, dealerId:any){
    if(!this.userId){
      this.toastr.error('Please Login First', '');
      return;
    }
    this.selectedVid = vid;
    const today = new Date();
    this.apptDate = today.toISOString().split('T')[0];
    this.apptTime = today.toTimeString().substring(0,5);
    this.apptNote = '';
    this.showAppointmentModal = true;
  }

  closeAppointmentModal() {
    this.showAppointmentModal = false;
  }

  submitAppointment() {
    let val = {
      vehicle_id: this.selectedVid,
      user_id: this.userId,
      date: this.apptDate,
      time: this.apptTime,
      description: this.apptNote
    };

    this.webapi.insertAppointment(val).subscribe((res: any) => {
      if(res.status == "success"){
        this.toastr.success('Appointment Placed Successfully', '');
        this.showAppointmentModal = false;
      }
      else{
        this.toastr.error('Failed to book appointment', '');
      }
    },
    (error: any) => {
      this.toastr.error('Internal Server Error', '');
    });
  }

}
