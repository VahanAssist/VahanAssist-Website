import { Component } from '@angular/core';
import { RouterLink, Router, ActivatedRoute, NavigationEnd} from '@angular/router';
import { CommonModule } from '@angular/common';
import { WebapiService } from '../webapi.service';
import { ToastrService } from 'ngx-toastr';
import { CarouselModule,OwlOptions  } from 'ngx-owl-carousel-o';
import { NgMagnizoomModule } from 'ng-magnizoom';

@Component({
  selector: 'app-vehicle-detail',
  standalone: true,
  imports: [RouterLink, CommonModule,CarouselModule, NgMagnizoomModule],
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
    // this.router.events.subscribe((evt) => {
    //   console.log(evt);

    //     if (!(evt instanceof NavigationEnd)) {
    //         return;
    //     }
    //     window.scrollTo(0, 0)
    // });
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
        // this.getMoreVehicleBySameCars();
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
      // console.log(this.moreVehicleData,'kk');

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
   contactOwner(vid:any,dealerId:any){
   let cn = confirm("Do you want to contact owner?")

   if(cn){
    if(this.userId){

      let val = {
        vehicle_id:vid,
        user_id:this.userId,
        dealer_id:dealerId,
        status:"Enquired"
      }

      console.log(val);
      this.webapi.insertMPEnquiry(val).subscribe((res: any) => {
        console.log(res);
        if(res.status == "success"){
          this.toastr.success('Enquiry Submitted You will be Contact Shortly..', '');
          this.contactFlag = true;

        }
        else{
          this.contactFlag = false;
          this.toastr.error('Internal Server Error!!', '');

        }
       });

    }
    else{
      this.toastr.error('Please Login First', '');
    }
   }
   }

}
