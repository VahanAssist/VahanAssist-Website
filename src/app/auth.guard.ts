import { CanActivateFn, Router } from '@angular/router';
import { WebapiService } from './webapi.service';
import { inject } from '@angular/core';

export const authGuard: CanActivateFn = (route, state) => {
  const authService = inject(WebapiService);
  const router = inject(Router);
    if (authService.isLogedIn()) {
       return true;
    }
    else{
      router.navigate(['/login']);
        return false;
    }

};
