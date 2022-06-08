import {Component, Input, OnInit, ViewChild} from '@angular/core';
import {Observable} from 'rxjs';
import {PARAM} from 'app/global/constants';
import {AgmMap} from "@agm/core";
import {DateTimeUtils} from "@shared/utils/datetimeUtils";
import {ISportplatform} from "@core/interfaces/models/ISportplatform";
import {ProviderStateFacade} from "@core/facades/stores/ProviderStoreFacade";
import {IProvider} from "@core/interfaces/models/IProvider";
import {TimeInitalReservationModalComponent} from "@shared/components/modals/time-inital-reservation-modal/time-inital-reservation-modal.component";
import {TimeToReservationModalComponent} from "@shared/components/modals/time-to-reservation-modal/time-to-reservation-modal.component";
import {IonDatetime, ModalController} from "@ionic/angular";
import {ToasterService} from "@shared/services/toaster.service";
import {SportplatformStateFacade} from "@core/facades/stores/SportplatformStoreFacade";
import {ViewfinderImageModalComponent} from "@shared/components/modals/viewfinder-image-modal/viewfinder-image-modal.component";
import {AuthenticationStateFacade} from "@core/facades/stores/AuthStoreFacade";
import {Router} from "@angular/router";
import {Components} from "@ionic/core";
import { Share } from '@capacitor/share';

@Component({
  selector: 'app-detail-sport-center',
  templateUrl: './detail-sport-center.component.html',
  styleUrls: ['./detail-sport-center.component.scss'],
})

export class DetailSportCenterComponent implements OnInit {
  @ViewChild('AgmMap') agmMap: AgmMap;
  @ViewChild(IonDatetime) datetime: IonDatetime;
  @Input() provider: ISportplatform;
  @Input() displayReservation = true;
  @Input() callSportplatforms = true;
  @Input() modal: Components.IonModal;
  
  public PARAM = PARAM;

  public filtersBooking: any = this.getFiltersBooking;

  public timeInitialSelected = {
    horaEntera: DateTimeUtils.getNextHourFromNow(1),
    horaEnteraAMPM: DateTimeUtils.getHoursFormatAMPM(DateTimeUtils.getCurrentDayWithoutHours() + ' ' +DateTimeUtils.getNextHourFromNow(1))
  };

  public timeToReservation = {
    id: 60,
    description: '1 hora'
  }

  public initialTab = 'info';

  public scheduleday = DateTimeUtils.getRangeDaysWeekFromToday();
  public today = DateTimeUtils.getCurrentDayWithoutHours();

  public viewImages = false;

  public currentLatitude = -5.1642359;
  public currentLongitude = -80.6304834;
  public zoom = 12;

  public dataFromProvider$: Observable<IProvider> = this.providerStateFacade.dataFromProvider$;
  public dataFromProviderLoading$: Observable<boolean> = this.providerStateFacade.dataFromProviderLoading$;

  public hourInitialReservation$: Observable<any> = this.providerStateFacade.hourInitialReservation$;
  public hourFinalReservation$: Observable<any> = this.providerStateFacade.hourFinalReservation$;

  public allSportplatformByFilter$: Observable<any[]> = this.sportplatformStateFacade.allSportplatformByFilter$;
  public sportplatformByFilterLoading$: Observable<boolean> = this.sportplatformStateFacade.sportplatformByFilterLoading$;
  public sportplatformAvalibles$: Observable<number> = this.sportplatformStateFacade.sportplatformAvalibles$;

  public voucherTranferPaymentProvider$: Observable<string> = this.providerStateFacade.voucherTranferPaymentProvider$;
  public voucherTranferPaymentProviderLoading$: Observable<boolean> = this.providerStateFacade.voucherTranferPaymentProviderLoading$;

  public currentAddress$: Observable<string> = this.authenticationStateFacade.currentAddress$;
  public userId$: Observable<string> = this.authenticationStateFacade.userId$;
  public profileCustomer$: Observable<any> = this.authenticationStateFacade.profileCustomer$;

  public reservationSportplatformLoading$: Observable<boolean> = this.providerStateFacade.reservationSportplatformLoading$;

  public aggreTermsAndConditions = false;

  public sportplatformSelected = null;

  public dateReservationWithFormat = DateTimeUtils.getFormatDateViewWithoutHour(this.filtersBooking.fecha);

  public sportplatformsImages = [];

  constructor(
    public dateTimeUtils: DateTimeUtils,
    private providerStateFacade: ProviderStateFacade,
    private modalController: ModalController,
    public toasterService: ToasterService,
    public sportplatformStateFacade: SportplatformStateFacade,
    public authenticationStateFacade: AuthenticationStateFacade,
    public dateUtils: DateTimeUtils,
    private router: Router,
  ) {
  }

  ngOnInit() {
    this.filtersBooking.proveedor_id = this.provider.provider_id;
    this.providerStateFacade.loadDataFromProvider(this.provider.provider_id);
    this.providerStateFacade.clearHourInitialReservation();
    if (this.callSportplatforms) {
      this.filtersBooking.resetPage = true;
      this.sportplatformStateFacade.loadSportplatformByFilter(this.filtersBooking);
    }
    this.providerStateFacade.setDateReservation(this.filtersBooking.fecha);
    this.providerStateFacade.setTimeToReservation({id: 60, description: '1 hora'});
  }

  public async segmentChanged(ev: any) {
    this.initialTab = ev.detail.value
  }

  public selectScheduleday(scheduleday) {
    this.filtersBooking.fecha = scheduleday.day;
    this.dateReservationWithFormat = DateTimeUtils.getFormatDateViewWithoutHour(this.filtersBooking.fecha);
    this.providerStateFacade.setDateReservation(this.filtersBooking.fecha);
    this.sportplatformStateFacade.loadSportplatformByFilter(this.filtersBooking);
    this.sportplatformSelected = null;
  }

  public async selectHourInitialReservation() {
    this.sportplatformSelected = null;
    const modal = await this.modalController.create({
      component: TimeInitalReservationModalComponent,
      componentProps: {
        dayReservation: this.filtersBooking.fecha,
      },
      initialBreakpoint: .3,
      breakpoints: [0, 0.3]
    });

    modal.onWillDismiss().then(response => {
      if (response.data) {
        this.timeInitialSelected = response.data;
        this.filtersBooking.horainicio = response.data.horaEntera;
        this.filtersBooking.horafin = DateTimeUtils.getHoursFromDate(DateTimeUtils.addTimeToDate(this.filtersBooking.fecha + ' ' + this.filtersBooking.horainicio, this.timeToReservation.id));
        this.sportplatformStateFacade.loadSportplatformByFilter(this.filtersBooking);
      }
    });

    return await modal.present();
  }

  public async selectTimeToReservation() {
    this.sportplatformSelected = null;
    const modal = await this.modalController.create({
      component: TimeToReservationModalComponent,
      initialBreakpoint: .2,
      breakpoints: [0, .2]
    });

    modal.onWillDismiss().then(response => {
      if (response.data) {
        this.timeToReservation = response.data;
        if (this.timeInitialSelected.horaEntera != PARAM.TODOS) {
          this.filtersBooking.horafin = DateTimeUtils.getHoursFromDate(DateTimeUtils.addTimeToDate(this.filtersBooking.fecha + ' ' + this.filtersBooking.horainicio, this.timeToReservation.id));
          this.sportplatformStateFacade.loadSportplatformByFilter(this.filtersBooking);
        }
      }
    });

    return await modal.present();
  }

  public async showFullScreenImage(image){
    const modal = await this.modalController.create({
      component: ViewfinderImageModalComponent,
      componentProps: {
        image
      },
      initialBreakpoint: .9,
      breakpoints: [0, .5, .9]
    });

    modal.onWillDismiss().then(_ => {
    });

    return await modal.present();
  }

  public async openModalReservation({...provider}) {
    if (!this.filtersBooking.horainicio) {
      await this.toasterService.presentError('Selecciona una hora de inicio para la reservación.');
      return false;
    }
    if (this.sportplatformSelected.sportplatform_avalible == PARAM.NO) {
      await this.toasterService.presentError('La cancha seleccionada está reservada.');
      return false;
    }
    provider.sportplatform_id = this.sportplatformSelected.sportplatform_id;
    provider.sportplatform_name = this.sportplatformSelected.sportplatform_name;
    provider.sportplatform_size = this.sportplatformSelected.sportplatform_size;
    await this.dismiss();
  }

  public async selectSporplatformToReservation(sportplatform) {
    this.sportplatformSelected = null;
    if (sportplatform.sportplatform_avalible == PARAM.NO) {
      await this.toasterService.presentError('La cancha seleccionada está reservada.');
      return false;
    }
    this.sportplatformSelected = sportplatform;
  }

  public changeStateFavoriteProvider(provider) {
    this.providerStateFacade.changeStateFavoriteProvider(provider.provider_id);
  }

  public onMapReady(agmMap: AgmMap) {
    this.agmMap = agmMap;
  }

  public async openImages(images) {
    this.viewImages = true;
    this.sportplatformsImages = images;
  }

  public async sharedLocation(provider) {
    await Share.share({
      title: 'Comparte la ubicación',
      text: 'Encontré esta canchita: "' + provider.provider_name + '", te envio la ubicación',
      url: 'http://maps.google.com/?q='+provider.provider_latitude+',' + provider.provider_longitude,
      dialogTitle: 'Compartir la canchita',
    });
  }

  public closeDatetime() {
    this.datetime.cancel(true);
  }

  public selectDate() {
    this.datetime.confirm(true);
  }

  public dateChanged(dateSelected) {
    this.filtersBooking.fecha = dateSelected;
    this.dateReservationWithFormat = DateTimeUtils.getFormatDateViewWithoutHour(this.filtersBooking.fecha);
    this.providerStateFacade.setDateReservation(this.filtersBooking.fechaReservation);
    this.sportplatformSelected = null;
    this.sportplatformStateFacade.loadSportplatformByFilter(this.filtersBooking);
  }

  public async goToEditProfile() {
    await this.dismiss();
    await this.router.navigate(['/profile/edit'], {
      queryParams: {
        next: '/home'
      },
    });
  }

  public async dismiss() {
    delete this.filtersBooking.deporte_id;
    delete this.filtersBooking.proveedor_id;
    this.sportplatformStateFacade.loadSportplatformByFilter(this.filtersBooking);
    await this.modal.dismiss('cancel');
  }

  public get getFiltersBooking() {
    return {
      proveedor_id: null,
      deporte_id: PARAM.TODOS,
      fecha: DateTimeUtils.getCurrentDayWithoutHours(),
      page: 1,
      register: 50,
      horainicio: DateTimeUtils.getNextHourFromNow(1),
      horafin: DateTimeUtils.getNextHourFromNow(2),
      latitud: PARAM.TODOS,
      longitud: PARAM.TODOS,
    }
  }
}
