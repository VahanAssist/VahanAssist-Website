import { Component } from '@angular/core';
import { WebapiService } from '../webapi.service';
import { NgxPaginationModule } from 'ngx-pagination';
import { CommonModule } from '@angular/common';
import { RouterLink, ActivatedRoute } from '@angular/router';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-view-appointments-vehicle',
  standalone: true,
  imports: [CommonModule,NgxPaginationModule,RouterLink,FormsModule],
  templateUrl: './view-appointments-vehicle.component.html',
  styleUrl: './view-appointments-vehicle.component.css'
})
export class ViewAppointmentsVehicleComponent {
  appointmentList:any[] = [];
  filter:any={};
  p: any = 1;
  vehicleId: any;
  total:any=0;

  constructor(private webapi: WebapiService, private activatedRoute: ActivatedRoute){
    this.filter = {
      vehicleId:'',
      start:1,
      limit:10
    };

    this.vehicleId = this.activatedRoute.snapshot.paramMap.get('id');

    if (this.vehicleId) {
      this.getAppointments();
    }
  }

  getAppointments(){
    this.filter.vehicleId = this.vehicleId;
    this.webapi.getAppointmentsByVehicle(this.filter).subscribe((res: any) => {
      if(res.status === 'success') {
        this.appointmentList = res.data;
        this.total = res.total;
      }
    });
  }

  onTableDataChange(event: any) {
    this.filter.start = event;
    this.getAppointments();
    this.p = event;
  }

}

