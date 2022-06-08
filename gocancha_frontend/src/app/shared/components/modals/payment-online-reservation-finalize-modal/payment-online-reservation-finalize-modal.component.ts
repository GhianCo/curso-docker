import {ChangeDetectionStrategy, Component, Input, OnDestroy, OnInit} from '@angular/core';
import {ModalController} from '@ionic/angular';
import {Observable, Subject} from 'rxjs';
import {UtilityService} from '@shared/utils/utility.service';
import {HTTP_RESPONSE, PARAM} from 'app/global/constants';
import {AuthenticationStateFacade} from "@core/facades/stores/AuthStoreFacade";
import {ICustomer} from "@core/interfaces/models/ICustomer";
import {Components} from "@ionic/core";

@Component({
  selector: 'app-payment-online-reservation-finalize-modal',
  templateUrl: './payment-online-reservation-finalize-modal.component.html',
  styleUrls: ['./payment-online-reservation-finalize-modal.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush
})

export class PaymentOnlineReservationFinalizeModalComponent implements OnInit, OnDestroy {

  public PARAM = PARAM;
  public HTTP_RESPONSE = HTTP_RESPONSE;
  private unsubscribe$ = new Subject<void>();

  @Input() typeResponseReservation: string;
  @Input() reservation: any;
  @Input() mensaje: string;
  @Input() modal: Components.IonModal;

  public reservationToPayOnline$: Observable<any> = this.authenticationStateFacade.reservationToPayOnline$;
  public profileCustomer$: Observable<ICustomer> = this.authenticationStateFacade.profileCustomer$;

  constructor(
    public modalController: ModalController,
    public utilityService: UtilityService,
    public authenticationStateFacade: AuthenticationStateFacade,
  ) {
  }

  public ngOnInit() {
  }

  public async closeModal() {
    await this.modal.dismiss('cancel');
  }

  public ngOnDestroy(): void {
    this.unsubscribe$.next();
    this.unsubscribe$.complete();
    this.authenticationStateFacade.clearReservationToPaymentOnline();
  }
  async ionViewWillLeave() {
    this.unsubscribe$.next();
    this.unsubscribe$.complete();
    this.authenticationStateFacade.clearReservationToPaymentOnline();
  }
}
