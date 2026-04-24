import { Component } from '@angular/core';
import { WebapiService } from '../webapi.service';
import { NgxPaginationModule } from 'ngx-pagination';
import { CommonModule } from '@angular/common';
import { RouterLink, ActivatedRoute } from '@angular/router';
import { FormsModule } from '@angular/forms';


@Component({
  selector: 'app-view-price-requests-vehicle',
  standalone: true,
  imports: [CommonModule, NgxPaginationModule, RouterLink, FormsModule],
  templateUrl: './view-price-requests-vehicle.component.html',
  styleUrl: './view-price-requests-vehicle.component.css'
})

export class ViewPriceRequestsVehicleComponent {
  priceRequestList: any[] = [];
  filter: any = {};
  p: any = 1;
  vehicleId: any;
  total: any = 0;

  constructor(private webapi: WebapiService, private activatedRoute: ActivatedRoute) {
    this.filter = {
      vehicleId: '',
      start: 1,
      limit: 10
    };

    this.vehicleId = this.activatedRoute.snapshot.paramMap.get('id');

    if (this.vehicleId) {
      this.getPriceRequests();
    }
  }

  getPriceRequests() {
    this.filter.vehicleId = this.vehicleId;
    this.webapi.getPriceRequestsByVehicle(this.filter).subscribe((res: any) => {
      if (res.status === 'success') {
        this.priceRequestList = res.data;
        this.total = res.total;
      }
    });
  }

  onTableDataChange(event: any) {
    this.filter.start = event;
    this.getPriceRequests();
    this.p = event;
  }

}
