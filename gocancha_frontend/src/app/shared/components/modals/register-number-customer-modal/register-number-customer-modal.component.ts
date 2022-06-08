import {Component, OnDestroy, OnInit} from '@angular/core';
import {Observable, Subject} from 'rxjs';
import {AuthenticationStateFacade} from "@core/facades/stores/AuthStoreFacade";
import {ICustomer} from "@core/interfaces/models/ICustomer";

@Component({
  selector: 'app-register-number-customer-modal',
  templateUrl: './register-number-customer-modal.component.html',
  styleUrls: ['./register-number-customer-modal.component.scss'],
})

export class RegisterNumberCustomerModalComponent implements OnInit, OnDestroy {

  private unsubscribe$ = new Subject<void>();

  public phoneNumber = null;

  public profileCustomer$: Observable<ICustomer> = this.authenticationStateFacade.profileCustomer$;
  public updateProfileCustomerLoading$: Observable<boolean> = this.authenticationStateFacade.updateProfileCustomerLoading$;


  constructor(
    private authenticationStateFacade: AuthenticationStateFacade,
  ) {
  }

  public ngOnInit() {
  }

  public async savePhoneNumber({...profileCustomer}) {
    profileCustomer.cliente_telefono = this.phoneNumber;
    this.authenticationStateFacade.loadUpdateProfileCustomer(profileCustomer)
  }

  public ngOnDestroy(): void {
    this.unsubscribe$.next();
    this.unsubscribe$.complete();
  }

}
