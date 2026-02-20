import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewAppointmentsVehicleComponent } from './view-appointments-vehicle.component';

describe('ViewAppointmentsVehicleComponent', () => {
  let component: ViewAppointmentsVehicleComponent;
  let fixture: ComponentFixture<ViewAppointmentsVehicleComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ViewAppointmentsVehicleComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(ViewAppointmentsVehicleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
