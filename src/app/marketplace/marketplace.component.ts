import { Component, ElementRef, ViewChild } from '@angular/core';
import { RouterLink, Router, NavigationEnd } from '@angular/router';
import { WebapiService } from '../webapi.service';
import { NgxPaginationModule } from 'ngx-pagination';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { ToastrService } from 'ngx-toastr';
// import { Ng2SearchPipeModule } from 'ng2-search-filter';
import { NgMultiSelectDropDownModule } from 'ng-multiselect-dropdown';
import { IDropdownSettings } from 'ng-multiselect-dropdown';

@Component({
  selector: 'app-marketplace',
  standalone: true,
  imports: [RouterLink,CommonModule,NgxPaginationModule,FormsModule,NgMultiSelectDropDownModule],
  templateUrl: './marketplace.component.html',
  styleUrl: './marketplace.component.css'
})
export class MarketplaceComponent {
  dropdownSettings : IDropdownSettings;
  dropdownSettingsv2 : IDropdownSettings;
  dropdownCitySettingsv2 : IDropdownSettings;
  dropdownStateSettingsv2 : IDropdownSettings;
  @ViewChild('closeModal') closeModal?: ElementRef;
  userId: any;
  customData:any={};
  brandidsArray: any = [];
  custCatArray: any = [];
  custBrandArray: any = [];
  custModelArray: any = [];
  custCatArrayv2: any = [];
  custBrandArrayv2: any = [];
  custModelArrayv2: any = [];
  filter:any = {
    start:1,
    limit:12,
    category_id:'',
    brand_id:'',
    model_id:'',
    year:'',
    price:'',
    ownership:'',
    listingtype:'',
    state:'',
    city:'',
    notin:'',
    type:'',
    buyfrom:[]
   };
   total:any=0;
   vehicleList:any;
   p=1;
  imageUrl: any;
  ownershipArr:any=[];
  formData:any={};
  categoryList: any;
  brandList: any;
  modelList: any;
  userType: any='';
  buyfromArr:any=[];
  catsidsArray: any =[];
  searchResult:any;
  checkedCat:any=[];
  checkedBrand:any=[];
  checkedModel:any=[];
  filterFlag:boolean=false;
  selectedItems:any;
  selectedItemsV2:any;
  selectedItemsState:any;
  selectedItemsCity:any;
  stateList:any;
  cityList:any;

  constructor(private router: Router, private webapi: WebapiService,private toastr: ToastrService) {
    this.imageUrl = this.webapi.imageBaseUrl;
    this.userId = sessionStorage.getItem('userId');
    this.userType = sessionStorage.getItem('type');
    if(this.userId){
      this.filter.notin = this.userId;
      if(this.userType == "USER"){
         this.filter.listingtype = JSON.stringify(['stc']);
        this.filter.buyfrom = JSON.stringify(['DEALER']);
      }
      else if(this.userType == "DEALER"){
        this.filter.listingtype = JSON.stringify(['std','stc']);
        this.filter.buyfrom = JSON.stringify(['DEALER','USER']);
      }
    }
    else{
      this.filter.listingtype = JSON.stringify(['stc']);
      this.filter.buyfrom = JSON.stringify([]);
    }
    this.getAllMPVehicles();
    this.getAllCategory();
    this.getAllStates();


    this.dropdownSettings = {
      singleSelection: false,
      idField: 'id',
      textField: 'name',
      itemsShowLimit: 3,
      allowSearchFilter: true,
      enableCheckAll:true,
    };
    this.dropdownSettingsv2 = {
      singleSelection: false,
      idField: 'id',
      textField: 'name',
      itemsShowLimit: 3,
      allowSearchFilter: true,
      enableCheckAll:true,
    };
    this.dropdownCitySettingsv2 = {
      singleSelection: true,
      idField: 'id',
      textField: 'city',
      itemsShowLimit: 3,
      allowSearchFilter: true,
      enableCheckAll:true,
    };
    this.dropdownStateSettingsv2 = {
      singleSelection: true,
      idField: 'id',
      textField: 'state',
      itemsShowLimit: 3,
      allowSearchFilter: true,
      enableCheckAll:true,
    };
  }


  onItemBrandSelect(item: any) {
    this.brandidsArray.push(item.id);

    this.custBrandArrayv2.push(item.id);

    let val = {
      brand_ids:JSON.stringify(this.brandidsArray)
    }

    if(this.brandidsArray.length > 0){
      this.webapi.getAllModelV3(val).subscribe((res: any) => {
        if (res.length > 0) {
          this.modelList = res;
        }
        else {
          this.modelList = [];

        }

      });
    }
  }

  onBrandDeselect(item:any){

    let ind = this.custBrandArrayv2.indexOf(item.id);

       if(ind >=0){
         this.custBrandArrayv2.splice(ind,1);
       this.filter.brand_id = JSON.stringify(this.custBrandArrayv2);

       }

   let index = this.brandidsArray.indexOf(item.id);
   if(index >= 0){
     this.brandidsArray.splice(index, 1);
   }

   let val = {
    brand_ids:JSON.stringify(this.brandidsArray)
  }

  if(this.brandidsArray.length > 0){
    this.webapi.getAllModelV3(val).subscribe((res: any) => {
      if (res.length > 0) {
        this.modelList = res;
      }
      else {
        this.modelList = [];

      }

    });
  }

  }

  onItemModelSelect(item: any) {
    this.custModelArrayv2.push(item.id);
  }

  onModelDeselect(item:any){
    let index = this.custModelArrayv2.indexOf(item.id);

    if(index >=0){
      this.custModelArrayv2.splice(index,1);
    this.filter.model_id = JSON.stringify(this.custModelArrayv2);

    }

  }

  onItemModelStateSelect(item: any) {
    this.formData.state = item.id;

    this.getAllCityByState(item.id)
  }

  onModelStateDeselect(item:any){
    this.formData.state = '';
    this.cityList = [];
  }

  onItemModelCitySelect(item: any) {
    this.formData.city = item.id;
  }

  onModelCityDeselect(item:any){
    this.formData.city = '';
  }

  checkLoginUser(slug:any,addedby:any){
    if(!this.userId){
      this.toastr.error('Please Login first','');
      this.router.navigate([`/login`]);
    }
    else{

      if(this.userId == addedby){
        this.router.navigate([`view-vehicle`]);
        }
        else{
          this.router.navigate([`/vehicle-details/${slug}`]);
        }
    }
  }

  ngOnInit() {
    this.router.events.subscribe((evt) => {
        if (!(evt instanceof NavigationEnd)) {
            return;
        }
        window.scrollTo(0, 0)
    });
}

setBuyFrom(e:any){
  if(e.target.checked){
    this.buyfromArr.push(e.target.value);
  }
  else{
    let index = this.buyfromArr.indexOf(e.target.value);
    if(index >= 0){
      this.buyfromArr.splice(index,1);
    }
    else{
      this.buyfromArr = [];
    }
  }
  this.filter.buyfrom = JSON.stringify(this.buyfromArr);
  this.getAllMPVehicles();

  // if(e.target)

}

  getTypeAndRespons() {

    let type = sessionStorage.getItem('type');

    if (type == 'DEALER') {
      let val = {
        id: this.userId
      }
      this.webapi.getPaymentByUserId(val).subscribe((res: any) => {
        if (res.length > 0 && res[0].status == 'Completed') {
          this.router.navigate(['/vehicle-details']);
        }
        else {
          this.router.navigate(['/subscription']);

        }

      });
    }
    else {
      this.router.navigate(['/vehicle-details']);
    }

  }

  searchCars(e:any){
    console.log(e.target.value);

    if(e.target.value){
      let val = {
        search: e.target.value
       }
       this.webapi.searchCars(val).subscribe((res: any) => {
        console.log(res);
        this.searchResult = res;
      });
    }
    else{
      this.searchResult = [];
    }


  }

  clearFilter(){
   location.reload();
  }

  searchWithClick(key:any,value:any){

    if(this.filter[key] && JSON.parse(this.filter[key]).length > 0){
    this.filter[key] = JSON.stringify([value,...JSON.parse(this.filter[key])]);
    this.getAllMPVehicles();
    this.searchResult = [];
    }
    else{
   this.filter[key] = JSON.stringify([value]);
    this.getAllMPVehicles();
    this.searchResult = [];
    }

    if(this.filter.category_id && JSON.parse(this.filter.category_id).length > 0){
      this.checkedCat = JSON.parse(this.filter.category_id);
    }
    if(this.filter.brand_id && JSON.parse(this.filter.brand_id).length > 0){
      this.checkedBrand = JSON.parse(this.filter.brand_id);
    }
    if(this.filter.model_id && JSON.parse(this.filter.model_id).length > 0){
      this.checkedModel = JSON.parse(this.filter.model_id);
    }
  }

  getAllMPVehicles(){
    this.webapi.getAllMPVehicles(this.filter).subscribe((res: any) => {
      // console.log(res,'--');
      this.vehicleList = res.data;
      this.total = res.total;
    });
  }

  onMPFilterVehicle(data:any){
    if(this.custCatArrayv2.length > 0){
      this.filter.category_id = JSON.stringify(this.custCatArrayv2);
    }
    if(this.custBrandArrayv2.length > 0){
      this.filter.brand_id = JSON.stringify(this.custBrandArrayv2);
    }
    if(this.custModelArrayv2.length > 0){
      this.filter.model_id = JSON.stringify(this.custModelArrayv2);
    }

    if(this.ownershipArr.length > 0){
      this.filter.ownership_id = JSON.stringify(this.ownershipArr);
    }

    if(data.year){
      this.filter.year = data.year;
    }

    if(data.price){
      this.filter.price = data.price;
    }

    if(data.state){
      this.filter.state = data.state;
    }

    if(data.city){
      this.filter.city = data.city;
    }
    this.getAllMPVehicles();

    if(this.filter.category_id && JSON.parse(this.filter.category_id).length > 0){
      this.checkedCat = JSON.parse(this.filter.category_id);
    }
    if(this.filter.brand_id && JSON.parse(this.filter.brand_id).length > 0){
      this.checkedBrand = JSON.parse(this.filter.brand_id);
    }
    if(this.filter.model_id && JSON.parse(this.filter.model_id).length > 0){
      this.checkedModel = JSON.parse(this.filter.model_id);
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

  // getAllBrandById(e:any) {

  //   let val = {
  //     "category_id": e.target.value
  //   }
  //   this.webapi.getAllBrand().subscribe((res: any) => {
  //     if (res.length > 0) {
  //       this.brandList = res;
  //     }
  //     else {
  //       this.brandList = [];

  //     }

  //   });
  // }

  getBrandByBrandMultiple(e:any){

    if(e.target.checked){
      this.catsidsArray.push(e.target.value);
    }
    else{
      let index = this.catsidsArray.indexOf(e.target.value);
      if(index >= 0){
        this.catsidsArray.splice(index, 1);
      }

    }
  let val = {
    category_ids:JSON.stringify(this.catsidsArray)
  }

  if(this.catsidsArray.length > 0){
    this.webapi.getAllbrandV3(val).subscribe((res: any) => {
      if (res.length > 0) {
        this.brandList = res;
      }
      else {
        this.brandList = [];

      }

    });
  }
  else{
    this.brandList = [];

  }

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

  getModelByBrandMultiple(e:any){

    if(e.target.checked){
      this.brandidsArray.push(e.target.value);
    }
    else{
      let index = this.brandidsArray.indexOf(e.target.value);
      if(index >= 0){
        this.brandidsArray.splice(index, 1);
      }

    }
  let val = {
    brand_ids:JSON.stringify(this.brandidsArray)
  }

  if(this.brandidsArray.length > 0){
    this.webapi.getAllModelV3(val).subscribe((res: any) => {
      if (res.length > 0) {
        this.modelList = res;
      }
      else {
        this.modelList = [];

      }

    });
  }
  else{
    this.modelList = [];

  }

  }

  setcustomCat(e:any){
   if(e.target.checked){
    this.custCatArray.push(e.target.value);
   }
   else{
    let index = this.custCatArray.indexOf(e.target.value);

    if(index >=0){
      this.custCatArray.splice(index,1);
    }
   }
  }

  setcustomBrand(e:any){
    if(e.target.checked){
      this.custBrandArray.push(e.target.value);
     }
     else{
      let index = this.custBrandArray.indexOf(e.target.value);

      if(index >=0){
        this.custBrandArray.splice(index,1);
      }
     }
  }

  setcustomModel(e:any){
    if(e.target.checked){
      this.custModelArray.push(e.target.value);
     }
     else{
      let index = this.custModelArray.indexOf(e.target.value);

      if(index >=0){
        this.custModelArray.splice(index,1);
      }
     }
  }

  setOwnershipFilter(e:any){
    if(e.target.checked){
      this.ownershipArr.push(e.target.value);
     }
     else{
      let index = this.ownershipArr.indexOf(e.target.value);

      if(index >=0){
        this.ownershipArr.splice(index,1);
      }
     }
  }


  setcustomCatV2(e:any){
    if(e.target.checked){
     this.custCatArrayv2.push(e.target.value);
    }
    else{
     let index = this.custCatArrayv2.indexOf(e.target.value);

     if(index >=0){
       this.custCatArrayv2.splice(index,1);
       this.filter.category_id = JSON.stringify(this.custCatArrayv2);
     }
    }

   }

   setcustomBrandV2(e:any){
     if(e.target.checked){
       this.custBrandArrayv2.push(e.target.value);
      }
      else{
       let index = this.custBrandArrayv2.indexOf(e.target.value);

       if(index >=0){
         this.custBrandArrayv2.splice(index,1);
       this.filter.brand_id = JSON.stringify(this.custBrandArrayv2);

       }
      }
   }

   setcustomModelV2(e:any){
     if(e.target.checked){
       this.custModelArrayv2.push(e.target.value);
      }
      else{
       let index = this.custModelArrayv2.indexOf(e.target.value);

       if(index >=0){
         this.custModelArrayv2.splice(index,1);
       this.filter.model_id = JSON.stringify(this.custModelArrayv2);

       }
      }
   }



  customEnquiry(data:any){

    if(this.userId){

      if(this.custCatArray.length > 0){
        data.category = JSON.stringify(this.custCatArray);
      }
      if(this.custBrandArray.length > 0){
        data.brand = JSON.stringify(this.custBrandArray);
      }
      if(this.custModelArray.length > 0){
        data.model = JSON.stringify(this.custModelArray);
      }

      if(this.ownershipArr.length > 0){
        data.ownership = JSON.stringify(this.ownershipArr);
      }

      if(this.userId){
        data.userId = this.userId;
      }
      this.webapi.insertCustomMPEnquiry(data).subscribe((res: any) => {
      console.log(res);

      if(res.status == "success"){
        this.customData = {};
        this.closeModal?.nativeElement.click()
      this.toastr.success('Enquiry Submitted You will be Contact Shortly..', '');

      }
      else{
      this.toastr.error('Something Went wrong', '');

      }

      });
    }
    else{
      this.toastr.error('Please Login First', '');
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
      state: e
    }
    this.webapi.getAllCityByState(val).subscribe((res: any) => {
      if (res.length > 0) {
        this.cityList = res;
        console.log(this.cityList);

      }
    });
  }

  onTableDataChange(event: any) {
    this.filter.start = event;
    this.getAllMPVehicles();
    this.p = event;
 }

}
