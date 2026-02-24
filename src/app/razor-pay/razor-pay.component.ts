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

  // openRzaorPay(){
  //   console.log('jj');

  // }

  rzaorPayPayment() {
    // call api to create order_id
    // this.payWithRazor("1234");
    let val = {
      user_id: 2,
      package_id: 1
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
      amount: val.amount * 100, // amount in paise format (₹1 = 100 paise)
      currency: 'INR',
      name: 'Testing', // company name or product name
      description: '',  // product description
      image: '', // Removed local logo to avoid CORS/Mixed Content errors in local testing
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
