import { Component } from '@angular/core';
import { WindowRefService } from '../window-ref.service';
import { WebapiService } from '../webapi.service';

@Component({
  selector: 'app-razor-pay',
  standalone: true,
  imports: [],
  templateUrl: './razor-pay.component.html',
  styleUrl: './razor-pay.component.css'
})
export class RazorPayComponent {

  constructor(private winRef: WindowRefService, private webapi: WebapiService) {

  }

  rzaorPayPayment() {
    let user_id = sessionStorage.getItem('userId');
    let package_id = sessionStorage.getItem('package_id') || 1;

    if (!user_id) {
      alert("Please Login First!!");
      return;
    }

    let val = {
      user_id: user_id,
      package_id: package_id
    };

    this.webapi.createOrderRazorPay(val).subscribe((res: any) => {
      console.log(res, '--');

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
      amount: val.amount * 100,
      currency: 'INR',
      name: 'Testing',
      description: '',
      image: '',
      order_id: val.order_id,
      modal: {
        escape: false,
      },
      notes: {},
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
      console.log(response, 'response');
      if (response) {
        this.webapi.verifyRazorPayment(response).subscribe((res: any) => {
          console.log(res, '--');

          if (res.status == 'success') {
            alert(res.msg);
            location.reload();
          }
          else {
            alert(res.msg);
          }
        });
      }
    });
    options.modal.ondismiss = (() => {
      console.log('Transaction cancelled.', 'cancel');
    });
    const rzp = new this.winRef.nativeWindow.Razorpay(options);
    rzp.open();
  }

}
