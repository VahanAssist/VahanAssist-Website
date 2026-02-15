import { Component, ChangeDetectorRef } from '@angular/core';
import { RouterLink, Router, ActivatedRoute, NavigationEnd } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { WebapiService } from '../webapi.service';
import { ToastrService } from 'ngx-toastr';
import { ToWords } from 'to-words';

@Component({
  selector: 'app-add-vehicle',
  standalone: true,
  imports: [RouterLink, CommonModule, FormsModule],
  templateUrl: './add-vehicle.component.html',
  styleUrl: './add-vehicle.component.css'
})
export class AddVehicleComponent {
  categoryList: any;
  numbertoWord: any;
  brandList: any;
  modelList: any;
  imgPreviewArray: any = [];
  imagesUploadArr: any = [];
  vehicleId: any
  imgDbArray: any;
  imagePreview: any;
  formData: any = {};
  imageUrl: any;
  stateList: any
  cityList: any;
  modelDetails: any;
  type: any = '';
  uploadSingle: boolean = false;
  discountPrice:any=0;
  constructor(private webapi: WebapiService, private toastr: ToastrService, private router: Router, private activatedRoute: ActivatedRoute, private cdr: ChangeDetectorRef) {
    this.imageUrl = this.webapi.imageBaseUrl;
    this.vehicleId = this.activatedRoute.snapshot.paramMap.get("id");
    if (this.vehicleId) {
      this.getVehicleById(this.vehicleId);
    }

    if (!sessionStorage.getItem('userId')) {
      this.router.navigate(['/login']);
    }

    this.getAllCategory();
    // this.getAllBrand();
    this.getAllStates();
    this.type = sessionStorage.getItem('type');
  }

  ngOnInit() {
    this.router.events.subscribe((evt) => {
      if (!(evt instanceof NavigationEnd)) {
        return;
      }
      window.scrollTo(0, 0)
    });
  }


  onVehicleAdd(data: any) {

    if (this.vehicleId) {
      delete data.images;
      delete data.created;
      delete data.updated;
      this.webapi.insertMKVehicle(data).subscribe((res: any) => {
        if (res.status == 'success') {
          if (this.imagesUploadArr.length > 0) {
            this.uploadMultipleImages(res.vehicleId);
          }
          this.toastr.success(res.msg);
          this.router.navigate(['/view-vehicle'])
        }
        else {
          this.toastr.error(res.msg);
        }
      });
    }
    else {
      if('image' in this.formData){
        if (this.imagesUploadArr.length > 1) {
          if (this.type == 'USER') {
            data.listingtype = 'std';
          }
          data.added_by = sessionStorage.getItem('userId');
          data.added_type = sessionStorage.getItem('type');

          console.log(data);

          // this.webapi.insertMKVehicle(data).subscribe((res: any) => {

          //   if (res.status == 'success') {
          //     if (this.imagesUploadArr.length > 0) {
          //       this.uploadMultipleImages(res.vehicleId);
          //     }
          //     this.toastr.success(res.msg);
          //     this.router.navigate(['/view-vehicle'])
          //   }
          //   else {
          //     this.toastr.error(res.msg);
          //   }

          // });
        }
        else {
          alert('Please Add atleast 2 Multi images for vehicle..')
        }
      }
      else{
        alert('Cover image is required');
      }

    }

  }

  onPercentPrice(e: any){
    if(!this.formData.price){
     alert('Please Enter Price first');
     this.formData.discount_percent = '';
    return
    }

          let d_price = Number(this.formData.price) * (Number(e.target.value)/100);

          let sellingPrice = Number(this.formData.price) - Number(d_price);

          this.formData.discount_price = sellingPrice;
          this.discountPrice = sellingPrice;
  }


  onPercentPriceV2(e: any){
    if(this.formData.discount_percent){
      if(!this.formData.price){
        alert('Please Enter Price first');
        this.formData.discount_percent = '';
       return
       }

             let d_price = Number(this.formData.price) * (Number(e)/100);

             let sellingPrice = Number(this.formData.price) - Number(d_price);

             this.formData.discount_price = sellingPrice;
             this.discountPrice = sellingPrice;
    }

  }

  getAllCategory() {
    this.webapi.getAllCategory().subscribe((res: any) => {
      if (res.length > 0) {
        this.categoryList = res;
      }
      else {
        this.categoryList = [];

      }

    });
  }

  getAllBrandByCategoryId(e: any) {
    let val = {
      category_id: e.target.value
    }
    this.webapi.getAllBrandByCategoryId(val).subscribe((res: any) => {
      if (res.length > 0) {
        this.brandList = res;
      }
      else {
        this.brandList = [];

      }

    });
  }

  getAllBrandByCategoryIdV2(e: any) {
    let val = {
      category_id: e
    }
    this.webapi.getAllBrandByCategoryId(val).subscribe((res: any) => {
      if (res.length > 0) {
        this.brandList = res;
      }
      else {
        this.brandList = [];

      }

    });
  }

  getAllModel(e: any) {
    let val = {
      "brand_id": e.target.value
    }
    this.webapi.getAllModel(val).subscribe((res: any) => {
      if (res.length > 0) {
        this.modelList = res;
      }
      else {
        this.modelList = [];

      }

    });
  }

  getAllModelV2(e: any) {
    let val = {
      "brand_id": e
    }
    this.webapi.getAllModel(val).subscribe((res: any) => {
      if (res.length > 0) {
        this.modelList = res;
      }
      else {
        this.modelList = [];

      }

    });
  }

  getVehicleImages(e: any) {
    if (e.target.files.length > 0) {

      if (this.imagesUploadArr.length > 15) {
        alert("You can only upload 15 Images only");
      }
      else {
        for (let i = 0; i < e.target.files.length; i++) {
          if (e.target.files[i]) {
            const reader = new FileReader();
            reader.onload = (e: any) => {
              let v = e.target.result;
              this.imgPreviewArray.push(v);
            };
            reader.readAsDataURL(e.target.files[i]);
          }
          this.imagesUploadArr.push(e.target.files[i]);
        }
      }
    }
  }

  getVehicleImageSingle(e: any) {
    if (e.target.files[0]) {
      const reader = new FileReader();
      reader.onload = (e: any) => {
        let v = e.target.result;
        this.imagePreview = v;
      };
      reader.readAsDataURL(e.target.files[0]);
      this.uploadSingle = true;
      this.formData.image = e.target.files[0];

    }
  }

  removePreview(index: any) {
    if (index >= 0) {
      this.imagesUploadArr.splice(index, 1);
      this.imgPreviewArray.splice(index, 1);
    }

  }

  removePreviewSingle(e: any) {
    this.formData.image = '';
    this.imagePreview = '';
  }


  uploadMultipleImages(vehId: any) {
    for (let j = 0; j < this.imagesUploadArr.length; j++) {
      let value = {
        image: this.imagesUploadArr[j],
        vehicle_id: vehId
      }
      this.webapi.uploadMKMultipleImages(value).subscribe((res: any) => {
        // console.log(res, '--');
      });
    }

  }

  getVehicleById(id: any) {
    let val = {
      id: id,
    }
    this.webapi.getVehicleByIdEdit(val).subscribe((res: any) => {
      if (res.status == "success") {
        this.formData = res.data
        // this.formData.vcondition = "New";
        this.getAllBrandByCategoryIdV2(res.data.category_id);
        this.getAllModelV2(res.data.brand_id);
        this.getAllCityByStateV2(res.data.state);
        // this.getModelDetailsV2(res.data.model_id);
        this.imgDbArray = res.data.images;
        this.cdr.detectChanges();
      }


    });
  }


  getNumber(e: any) {
    if (e.target.value) {
      const toWords = new ToWords({
        localeCode: 'en-IN',
        converterOptions: {
          currency: true,
          ignoreDecimal: false,
          ignoreZeroCurrency: false,
          doNotAddOnly: false,
          currencyOptions: {
            // can be used to override defaults for the selected locale
            name: 'Rupee',
            plural: 'Rupees',
            symbol: '₹',
            fractionalUnit: {
              name: 'Paisa',
              plural: 'Paise',
              symbol: '',
            },
          },
        },
      });

      let result = toWords.convert(e.target.value);
      this.numbertoWord = result;
      this.onPercentPriceV2(this.formData.discount_percent);
    }
  }

  getAllStates() {
    this.webapi.getAllStates().subscribe((res: any) => {
      if (res.length > 0) {
        this.stateList = res;
        // console.log(this.stateList);

      }
    });
  }

  getAllCityByState(e: any) {
    let val = {
      state: e.target.value
    }
    this.webapi.getAllCityByState(val).subscribe((res: any) => {
      if (res.length > 0) {
        this.cityList = res;
        // console.log(this.cityList);

      }
    });
  }


  getAllCityByStateV2(e: any) {
    let val = {
      state: e
    }
    this.webapi.getAllCityByState(val).subscribe((res: any) => {
      if (res.length > 0) {
        this.cityList = res;
        // console.log(this.cityList);

      }
    });
  }
  getModelDetails(e: any) {
    let val = {
      id: e.target.value
    }
    this.webapi.getModelDetailsById(val).subscribe((res: any) => {
      if (res.length > 0) {
        this.formData.transmission = res[0].transmission;
        this.formData.fuel_type = res[0].fuel_type;
        this.formData.displacement = res[0].displacement;
        this.formData.emission_norm = res[0].emission_norm;
        this.formData.fuel_tank_capacity = res[0].fuel_tank_capacity;

        this.formData.height = res[0].height;
        this.formData.length = res[0].length;
        this.formData.width = res[0].width;
        this.formData.body_type = res[0].body_type;
        this.formData.kerb_weight = res[0].kerb_weight;
        this.formData.gears = res[0].gears;
        this.formData.ground_clearance = res[0].ground_clearance;
        this.formData.front_brakes = res[0].front_brakes;
        this.formData.rear_brakes = res[0].rear_brakes;
        this.formData.power_windows = res[0].power_windows;
        this.formData.power_seats = res[0].power_seats;
        this.formData.power = res[0].power;
        this.formData.torque = res[0].torque;
        this.formData.odometer = res[0].odometer;
        this.formData.speedometer = res[0].speedometer;
        this.formData.seating_capacity = res[0].seating_capacity;
        this.formData.seats_material = res[0].seats_material;

        this.formData.central_locking = res[0].central_locking;
        this.formData.child_safety_locks = res[0].child_safety_locks;
        this.formData.abs = res[0].abs;
        this.formData.ventilation_system = res[0].ventilation_system;

      }

    });
  }


  getModelDetailsV2(e: any) {
    let val = {
      id: e
    }
    this.webapi.getModelDetailsById(val).subscribe((res: any) => {
      if (res.length > 0) {
        this.formData.transmission = res[0].transmission;
        this.formData.fuel_type = res[0].fuel_type;
      }

    });
  }

  // removeSingleImage(id:any){
  //   console.log(id,'--');

  // }

  removeMultipleImage(id: any) {
    let cn = confirm('Are you sure you want to Delete?');

    if (cn) {

      let val = {
        id: id
      }
      this.webapi.deleteMPVehicleMultiImage(val).subscribe((res: any) => {
        if (res.status == "success") {
          this.toastr.success('Deleted Success');
          this.getVehicleById(this.vehicleId);
        }
        else {
          this.toastr.error("Internal Server Error")
        }
      });
    }

  }
}
