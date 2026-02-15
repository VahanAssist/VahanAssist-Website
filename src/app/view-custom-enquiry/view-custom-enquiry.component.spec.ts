import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewCustomEnquiryComponent } from './view-custom-enquiry.component';

describe('ViewCustomEnquiryComponent', () => {
  let component: ViewCustomEnquiryComponent;
  let fixture: ComponentFixture<ViewCustomEnquiryComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ViewCustomEnquiryComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(ViewCustomEnquiryComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
