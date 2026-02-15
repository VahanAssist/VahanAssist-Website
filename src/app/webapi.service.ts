import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class WebapiService {

  private baseUrl = 'https://vahanassist.com/vahaan-admin/Insert_con/';
  private basePaymentUrl = 'https://vahanassist.com/vahaan-admin/Payment/';
  public imageBaseUrl = 'https://vahanassist.com/vahaan-admin/images/vehicle_image/';
  public imageBaseUrlv2 = 'https://vahanassist.com/vahaan-admin/images/profile/';
  // private googleApiKey = 'AIzaSyB39Z-mhm2udO-plmGRgG4QOyX3UjqOqqo';
  // private googleAutoPlaceUrl = 'https://maps.googleapis.com/maps/api/place/autocomplete/json';

  constructor(private http:HttpClient) { }

  isLogedIn(){
    if (typeof sessionStorage !== "undefined") {
      return sessionStorage.getItem('userId');
    }
    else{
      return false;
    }

  }

  insertEnquiry(data:any){
    var form_data= new FormData();
    for(var key in data){
      form_data.append(key,data[key]);
    }
    return this.http.post(this.baseUrl+"insertEnquiry", form_data);
 }


 getAllDealerDataById(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getAllDealerDataById", form_data);
}

getAllMPVehicleByDealerId(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getAllMPVehicleByDealerId", form_data);
}

 getHomeCarsWithLimit(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getHomeCarsWithLimit", form_data);
}

 insertBooking(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"insertBooking", form_data);
}

insertUser(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"register", form_data);
}

getUser(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"login", form_data);
}

uploadDocument(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"uploadDocument", form_data);
}

getPlacesByText(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getAutocompleteGoogle", form_data);
}

getLatLngByPlaceId(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getLatLngByPlaceId", form_data);
}

createOrderRazorPay(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.basePaymentUrl+"createPaymentId", form_data);
}

verifyRazorPayment(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.basePaymentUrl+"verifyRazorPayment", form_data);
}

getPaymentByUserId(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getPaymentByUserId", form_data);
}

 getAllPackages(){
  return this.http.get(this.baseUrl+"getAllPackages/");
 }

 getAllCategory(){
  return this.http.get(this.baseUrl+"getAllMpCategory/");
 }

 getAllBrand(){
  return this.http.get(this.baseUrl+"getAllBrand/");
 }

 getAllModelV2(){
  return this.http.get(this.baseUrl+"getAllModelV2/");
 }

 getAllBrandByCategoryId(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getAllBrandByCategoryId", form_data);
}

 getAllModel(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getAllModel", form_data);
}

getAllModelV3(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getAllModelV3", form_data);
}

getAllbrandV3(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getAllbrandV3", form_data);
}

searchCars(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"searchCars", form_data);
}


insertMKVehicle(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"insertMKVehicle", form_data);
}

uploadMKMultipleImages(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"uploadMKMultipleImages", form_data);
}


getAllMPVehicles(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getAllMPVehicles", form_data);
}

getAllMPVehiclesByVendor(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getAllMPVehiclesByVendor", form_data);
}

updateMPVehicleStatus(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"updateMPVehicleStatus", form_data);
}
updateMPVehicleActive(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"updateMPVehicleActive", form_data);
}

getVehicleById(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getMPVehicleById", form_data);
}

getMoreMPVehicleByDealer(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getMoreMPVehicleByDealer", form_data);
}

getMoreVehicleBySameCars(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getMoreVehicleBySameCars", form_data);
}

getVehicleByIdEdit(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getVehicleByIdEdit", form_data);
}

deleteMPVehicle(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"deleteMPVehicle", form_data);
}

updateMpVehicleVisibility(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"updateMpVehicleVisibility", form_data);
}

insertMPEnquiry(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"insertMPEnquiry", form_data);
}

insertCustomMPEnquiry(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"insertCustomMPEnquiry", form_data);
}

getAllStates(){
  return this.http.get(this.baseUrl+"getAllStates/");
 }

 getAllCityByState(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getAllCityByState", form_data);
}

getModelDetailsById(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getModelDetailsById", form_data);
}

getAllEnquiry(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getAllEnquiry", form_data);
}

getAllCustomEnquiry(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getAllCustomEnquiry", form_data);
}

updateEnquiryStatus(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"updateEnquiryStatus", form_data);
}

updateEnquiryVisibilty(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"updateEnquiryVisibilty", form_data);
}

updateCustomEnquiryStatus(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"updateCustomEnquiryStatus", form_data);
}

updateCustomEnquiryVisibilty(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"updateCustomEnquiryVisibilty", form_data);
}

getUserById(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"getUserById", form_data);
}

updateUser(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"updateUser", form_data);
}

deleteMPVehicleMultiImage(data:any){
  var form_data= new FormData();
  for(var key in data){
    form_data.append(key,data[key]);
  }
  return this.http.post(this.baseUrl+"deleteMPVehicleMultiImage", form_data);
}


//  getChecks(id=""){
//   return this.http.get(this.baseUrl+"getChecks/"+id);
//  }

}
