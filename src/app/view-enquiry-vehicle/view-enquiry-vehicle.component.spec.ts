import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewEnquiryVehicleComponent } from './view-enquiry-vehicle.component';

describe('ViewEnquiryVehicleComponent', () => {
  let component: ViewEnquiryVehicleComponent;
  let fixture: ComponentFixture<ViewEnquiryVehicleComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ViewEnquiryVehicleComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(ViewEnquiryVehicleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
