import { Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { DriverBookingComponent } from './driver-booking/driver-booking.component';
import { TrailorBookingComponent } from './trailor-booking/trailor-booking.component';
import { LoginComponent } from './login/login.component';
import { SignupComponent } from './signup/signup.component';
import { ContactComponent } from './contact/contact.component';
import { AboutComponent } from './about/about.component';
import { DealerSignupComponent } from './dealer-signup/dealer-signup.component';
import { RazorPayComponent } from './razor-pay/razor-pay.component';
import { InspectionComponent } from './inspection/inspection.component';
import { SubscriptionComponent } from './subscription/subscription.component';
import { MarketplaceComponent } from './marketplace/marketplace.component';
import { UserProfileComponent } from './user-profile/user-profile.component';
import { AddVehicleComponent } from './add-vehicle/add-vehicle.component';
import { ViewVehicleComponent } from './view-vehicle/view-vehicle.component';
import { VehicleDetailComponent } from './vehicle-detail/vehicle-detail.component';
import { ViewEnquiryComponent } from './view-enquiry/view-enquiry.component';
import { ViewCustomEnquiryComponent } from './view-custom-enquiry/view-custom-enquiry.component';
import { authGuard } from './auth.guard';
import { UserAccountComponent } from './user-account/user-account.component';
import { ForgotpwdComponent } from './forgotpwd/forgotpwd.component';
import { DealerDetailsComponent } from './dealer-details/dealer-details.component';
import { ViewEnquiryVehicleComponent } from './view-enquiry-vehicle/view-enquiry-vehicle.component';
import { ViewAppointmentsVehicleComponent } from './view-appointments-vehicle/view-appointments-vehicle.component';
import { ViewPriceRequestsVehicleComponent } from './view-price-requests-vehicle/view-price-requests-vehicle.component';
import { TncComponent } from './tnc/tnc.component';
import { PrivacyComponent } from './privacy/privacy.component';
import { RtoComponent } from './rto/rto.component';
import { InsuranceComponent } from './insurance/insurance.component';
import { TowingComponent } from './towing/towing.component';

export const routes: Routes = [
  { path: '', component:HomeComponent},
   {path: 'home', component: HomeComponent},
   {path: 'driver-booking', component: DriverBookingComponent},
   {path: 'trailor-booking', component: TrailorBookingComponent},
   {path: 'inspection', component: InspectionComponent},

   {path: 'login', component: LoginComponent},
   {path: 'signup', component: SignupComponent},
   {path: 'forgot-password', component: ForgotpwdComponent},

   {path: 'dealer-signup', component: DealerSignupComponent},
   {path: 'contact', component: ContactComponent},
   {path: 'about', component: AboutComponent},
   {path: 'subscription', component: SubscriptionComponent},
   {path: 'marketplace', component: MarketplaceComponent},
   {path: 'dealer-details/:id', component: DealerDetailsComponent},
   {path: 'user-profile', component: UserProfileComponent, canActivate: [authGuard]},
   {path: 'user-account', component: UserAccountComponent, canActivate: [authGuard]},
   {path: 'add-vehicle', component: AddVehicleComponent, canActivate: [authGuard]},
   {path: 'view-vehicle', component: ViewVehicleComponent, canActivate: [authGuard]},
   {path: 'view-enquiry', component: ViewEnquiryComponent, canActivate: [authGuard]},
   {path: 'view-custom-enquiry', component: ViewCustomEnquiryComponent, canActivate: [authGuard]},

   {path: 'add-vehicle/:id', component: AddVehicleComponent, canActivate: [authGuard]},

   {path: 'view-enquiry-vehicle/:id', component: ViewEnquiryVehicleComponent, canActivate: [authGuard]},
   {path: 'view-appointments-vehicle/:id', component: ViewAppointmentsVehicleComponent, canActivate: [authGuard]},
   {path: 'view-price-vehicle/:id', component: ViewPriceRequestsVehicleComponent, canActivate: [authGuard]},

   {path: 'vehicle-details/:id', component: VehicleDetailComponent},
   {path: 'razor-pay', component: RazorPayComponent},

   {path: 'tnc', component: TncComponent},
   {path: 'privacypolicy', component: PrivacyComponent},

   {path: 'rto', component: RtoComponent},
   {path: 'insurance', component: InsuranceComponent},
   {path: 'towing', component: TowingComponent}


];
