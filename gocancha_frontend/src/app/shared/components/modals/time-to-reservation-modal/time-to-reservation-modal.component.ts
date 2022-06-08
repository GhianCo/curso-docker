import {ChangeDetectionStrategy, Component, OnDestroy, OnInit} from '@angular/core';
import {ModalController} from '@ionic/angular';
import {Observable, Subject} from 'rxjs';
import {UtilityService} from '@shared/utils/utility.service';
import {PARAM} from 'app/global/constants';
import {ProviderStateFacade} from "@core/facades/stores/ProviderStoreFacade";
import {ToasterService} from "@shared/services/toaster.service";
import {SportplatformStateFacade} from "@core/facades/stores/SportplatformStoreFacade";

@Component({
  selector: 'app-time-to-reservation-modal',
  templateUrl: './time-to-reservation-modal.component.html',
  styleUrls: ['./time-to-reservation-modal.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush
})

export class TimeToReservationModalComponent implements OnInit, OnDestroy {

  public PARAM = PARAM;
  private unsubscribe$ = new Subject<void>();

  public minutesToReservation = this.utilityService.getTimeReservation();

  public timeToReservation$: Observable<any> = this.providerStateFacade.timeToReservation$;

  constructor(
    public modalController: ModalController,
    public utilityService: UtilityService,
    private providerStateFacade: ProviderStateFacade,
    private sportplatformStateFacade: SportplatformStateFacade,
    public toasterService: ToasterService,
  ) {
  }

  public ngOnInit() {
  }

  public async selectTimeToReservation(hourInitialSelected) {
    if (!hourInitialSelected) {
      await this.toasterService.presentError('Selecciona un tiempo para la reservación.');
      return false;
    }
    const timeReservationSelected = this.minutesToReservation.find(hour => hour.id == hourInitialSelected);
    this.providerStateFacade.setTimeToReservation(timeReservationSelected);
    await this.modalController.dismiss(timeReservationSelected);
  }

  public ngOnDestroy(): void {
    this.unsubscribe$.next();
    this.unsubscribe$.complete();
  }

}
