import { ComponentFixture, TestBed } from '@angular/core/testing';

import { TrailorBookingComponent } from './trailor-booking.component';

describe('TrailorBookingComponent', () => {
  let component: TrailorBookingComponent;
  let fixture: ComponentFixture<TrailorBookingComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [TrailorBookingComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(TrailorBookingComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
