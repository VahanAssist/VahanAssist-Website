import { Component } from '@angular/core';
import { WebapiService } from '../webapi.service';
import { Router,ActivatedRoute } from '@angular/router';
import { CommonModule } from '@angular/common';
import { NgxPaginationModule } from 'ngx-pagination';


@Component({
  selector: 'app-dealer-details',
  standalone: true,
  imports: [CommonModule,NgxPaginationModule],
  templateUrl: './dealer-details.component.html',
  styleUrl: './dealer-details.component.css'
})
export class DealerDetailsComponent {
  p=1;
  filter:any={
    "id":'',
    "start":1,
    "limit":10
  }
  imageUrl: any;
  dealerId: any;
  dealerData: any;
  productList:any;
  total: any = 0;

  constructor(private webapiService: WebapiService,private activatedRoute: ActivatedRoute){
    this.imageUrl = this.webapiService.imageBaseUrlv2;
    this.activatedRoute.params.subscribe(params => {
      this.dealerId = params['id'];
    });

    if(this.dealerId){
    this.getDealerById(this.dealerId);
    this.getAllVehcileByVendor(this.dealerId);
    }

  }

  getDealerById(id:any){
    let val = {
      id:id
    }
    this.webapiService.getAllDealerDataById(val).subscribe((res: any) => {
      // console.log(res);
      this.dealerData = res.data.userData;
    });
  }

  getAllVehcileByVendor(id:any){
    this.filter.id = id;
    this.webapiService.getAllMPVehicleByDealerId(this.filter).subscribe((res: any) => {
      this.total = res.data.total;
      this.productList = res.data
    });
  }

  onTableDataChange(event: any) {
    this.filter.start = event;
    this.getAllVehcileByVendor(this.dealerId);
    this.p = event;
 }
}
