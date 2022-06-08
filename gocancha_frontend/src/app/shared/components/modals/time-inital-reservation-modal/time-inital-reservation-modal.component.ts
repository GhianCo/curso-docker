import {ChangeDetectionStrategy, ChangeDetectorRef, Component, Input, OnDestroy, OnInit} from '@angular/core';
import {ModalController} from '@ionic/angular';
import {Observable, Subject} from 'rxjs';
import {PARAM} from 'app/global/constants';
import {ProviderStateFacade} from "@core/facades/stores/ProviderStoreFacade";
import {ToasterService} from "@shared/services/toaster.service";
import {DateTimeUtils} from "@shared/utils/datetimeUtils";

@Component({
  selector: 'app-time-inital-reservation-modal',
  templateUrl: './time-inital-reservation-modal.component.html',
  styleUrls: ['./time-inital-reservation-modal.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush
})

export class TimeInitalReservationModalComponent implements OnInit, OnDestroy {

  @Input() dayReservation;

  public PARAM = PARAM;
  private unsubscribe$ = new Subject<void>();

  public hourInitialReservation$: Observable<any> = this.providerStateFacade.hourInitialReservation$;

  public hours = [];

  constructor(
    public modalController: ModalController,
    private providerStateFacade: ProviderStateFacade,
    public toasterService: ToasterService,
    public dateTimeUtils: DateTimeUtils,
  ) {
  }

  public ngOnInit() {
    this.dayReservation = DateTimeUtils.getDayNumberFromDate(this.dayReservation);
    this.hours = this.dateTimeUtils.getRangeHours('06:00', '23:30', 60, this.dayReservation);
  }

  public async selectHourInitial(hourInitialSelected) {
    if (!hourInitialSelected) {
      await this.toasterService.presentError('Selecciona una hora inicial para la reservación.');
      return false;
    }
    const hourInitial = this.hours.find(hour => hour.horaEntera == hourInitialSelected);
    this.providerStateFacade.setHourInitialReservation(hourInitial);
    await this.modalController.dismiss(hourInitial);
  }

  public ngOnDestroy(): void {
    this.unsubscribe$.next();
    this.unsubscribe$.complete();
  }

}
