import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { WindowRefService } from '../window-ref.service';
import { WebapiService } from '../webapi.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-subscription',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './subscription.component.html',
  styleUrl: './subscription.component.css'
})
export class SubscriptionComponent {
  userId: any;
  packagesList: any;

  constructor(private router: Router, private winRef: WindowRefService, private webapi: WebapiService) {

    this.getAllPackages();

    let type = sessionStorage.getItem('type');
    if (type != 'DEALER') {
      //  location.href = '/';
      //  this.router.navigate(['/']);
    }
    this.userId = sessionStorage.getItem('userId');

  }

  getAllPackages() {
    this.webapi.getAllPackages().subscribe((res: any) => {
      // console.log(res,'--pack');
      if (res.length > 0) {
        this.packagesList = res;
      }
      else {
        this.packagesList = [];
      }
    });
  }

  rzaorPayPayment(package_id: any, user_id: any) {
    // call api to create order_id
    // this.payWithRazor("1234");
    if (!user_id) {
      alert("Please Login First!!");
      return;
    }
    if (user_id && sessionStorage.getItem('type') != "DEALER") {
      alert("Subscription Only For Dealers..!");
      return;
    }
    let val = {
      user_id: user_id,
      package_id: package_id
    };

    this.webapi.createOrderRazorPay(val).subscribe((res: any) => {

      if (res.status == "success") {
        let dt = {
          name: res.data.name,
          email: res.data.email,
          phoneNumber: res.data.phoneNumber,
          order_id: res.data.order_id,
          amount: res.data.amount

        }
        this.payWithRazor(dt);
      }
      else {
        alert(res.msg);
      }


    });
  }

  payWithRazor(val: any) {
    const options: any = {
      key: 'rzp_live_SJ4vZVaVQgQY12',
      amount: val.amount * 100, // amount in paise format (₹1 = 100 paise)
      currency: 'INR',
      name: 'Vahaan Subscription', // company name or product name
      description: '',  // product description
      image: './assets/logo.png', // company logo or product image
      order_id: val.order_id, // order_id created by you in backend
      modal: {
        // We should prevent closing of the form when esc key is pressed.
        escape: false,
      },
      notes: {
        // include notes if any
      },
      theme: {
        color: '#0c238a'
      },
      prefill: {
        name: val.name,
        email: val.email,
        contact: val.phoneNumber,
      }
    };
    options.handler = ((response: any, error: any) => {
      // options.response = response;
      console.log(response, 'response');
      if (response) {
        this.webapi.verifyRazorPayment(response).subscribe((res: any) => {
          if (res.status == 'success') {
            alert(res.msg);
            location.href = '/marketplace';
          }
          else {
            alert(res.msg);
          }

        });
      }
      // call your backend api to verify payment signature & capture transaction
    });
    options.modal.ondismiss = (() => {
      // handle the case when user closes the form while transaction is in progress
      console.log('Transaction cancelled.', 'cancel');
    });
    const rzp = new this.winRef.nativeWindow.Razorpay(options);
    rzp.open();
  }

}
