import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewPriceRequestsVehicleComponent } from './view-price-requests-vehicle.component';

describe('ViewPriceRequestsVehicleComponent', () => {
  let component: ViewPriceRequestsVehicleComponent;
  let fixture: ComponentFixture<ViewPriceRequestsVehicleComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ViewPriceRequestsVehicleComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(ViewPriceRequestsVehicleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
