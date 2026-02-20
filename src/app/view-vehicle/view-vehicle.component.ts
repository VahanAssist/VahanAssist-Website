import { Component } from '@angular/core';
import { RouterLink, Router } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { WebapiService } from '../webapi.service';
import { ToastrService } from 'ngx-toastr';
import { NgxPaginationModule } from 'ngx-pagination';

@Component({
  selector: 'app-view-vehicle',
  standalone: true,
  imports: [RouterLink, CommonModule, FormsModule, NgxPaginationModule],
  templateUrl: './view-vehicle.component.html',
  styleUrl: './view-vehicle.component.css'
})
export class ViewVehicleComponent {
  loginType: any;
  p = 1;
  vehicleList: any;
  sold: any = 0;
  live: any = 0;
  offline: any = 0;
  total: any = 0;

  filter: any = {
    vendor_id: '',
    start: 1,
    limit: 10
  };
  imageUrl: any = '';
  constructor(private webapi: WebapiService, private toastr: ToastrService, private router: Router) {
    this.imageUrl = this.webapi.imageBaseUrl;
    this.loginType = sessionStorage.getItem('type');
    if (!sessionStorage.getItem('userId')) {
      this.router.navigate(['/login']);

    }
    this.getAllMPVehiclesByVendor();
  }

  getAllMPVehiclesByVendor() {
    this.filter.vendor_id = sessionStorage.getItem('userId');
    this.webapi.getAllMPVehiclesByVendor(this.filter).subscribe((res: any) => {
      this.vehicleList = res.data;
      this.total = res.total;
      this.live = res.live;
      this.sold = res.sold;
      this.offline = res.offline;
    });
  }

  updateMPVehicleStatus(e: any, id: any) {
    let val = {
      id: id,
      status: e.target.value
    }

    this.webapi.updateMPVehicleStatus(val).subscribe((res: any) => {
      if (res.status == 'success') {
        this.toastr.success('Status Updated Success');
        this.getAllMPVehiclesByVendor();
      }
      else {
        this.toastr.error('Something Went Wrong, TRy Again!');
      }

    });
  }

  updateMPVehicleActive(e: any, id: any) {
    let val = {
      id: id,
      is_active: e.target.value
    }
    this.webapi.updateMPVehicleActive(val).subscribe((res: any) => {
      if (res.status == 'success') {
        this.toastr.success('Status Updated Success');
        this.getAllMPVehiclesByVendor();

      }
      else {
        this.toastr.error('Something Went Wrong, TRy Again!');
      }
    });
  }

  hideMPVehicle(id: any) {
    let conf = confirm("Are you sure you want to delete?");

    if (conf) {
      let val = {
        id: id,
        hide: 1
      }
      this.webapi.updateMpVehicleVisibility(val).subscribe((res: any) => {
        if (res.status == 'success') {
          this.toastr.success('Vehicle Deleted');
          this.getAllMPVehiclesByVendor();
        }
        else {
          this.toastr.error('Something Went Wrong, Try Again!');
        }
      });
    }

  }

  deleteMPVehicle(e: any) {

    let conf = confirm("Are you sure you want to delete?");

    if (conf) {

      let val = {
        id: e,
      }
      this.webapi.deleteMPVehicle(val).subscribe((res: any) => {
        if (res.status == 'success') {
          this.toastr.success(res.msg);
          this.getAllMPVehiclesByVendor();
        }
        else {
          this.toastr.error(res.msg);
        }
      });

    }

  }



  onTableDataChange(event: any) {
    this.filter.start = event;
    this.getAllMPVehiclesByVendor();
    this.p = event;
  }
}
