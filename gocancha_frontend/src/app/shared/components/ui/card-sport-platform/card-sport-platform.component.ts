import {Component, OnInit, Input} from '@angular/core';
import {DetailSportCenterComponent} from "@shared/components/modals/detail-sport-center/detail-sport-center.component";
import {ModalController} from "@ionic/angular";
import {ISportplatform} from "@core/interfaces/models/ISportplatform";
import {Observable} from "rxjs";
import {ProviderStateFacade} from "@core/facades/stores/ProviderStoreFacade";
import {ToasterService} from "@shared/services/toaster.service";
import {SportplatformStateFacade} from "@core/facades/stores/SportplatformStoreFacade";
import {AuthenticationStateFacade} from "@core/facades/stores/AuthStoreFacade";

@Component({
  selector: 'app-card-sport-platform',
  templateUrl: './card-sport-platform.component.html',
  styleUrls: ['./card-sport-platform.component.scss']
})

export class CardSportPlatformComponent implements OnInit {

  @Input() provider: ISportplatform;
  @Input() booking: any;
  @Input() showDetail = true;
  @Input() isSlider = false;
  @Input() loading = false;

  public allSportplatformFiltersApply$: Observable<any> = this.sportplatformStateFacade.allSportplatformFiltersApply$;
  public profileCustomer$: Observable<any> = this.authenticationStateFacade.profileCustomer$;

  constructor(
    private modalController: ModalController,
    public providerStateFacade: ProviderStateFacade,
    public toasterService: ToasterService,
    public sportplatformStateFacade: SportplatformStateFacade,
    public authenticationStateFacade: AuthenticationStateFacade,
  ) {
  }

  ngOnInit() {
  }

  public async openDetailSportCenter(provider) {
    const modal = await this.modalController.create({
      component: DetailSportCenterComponent,
      componentProps: {
        provider,
        displayReservation: false,
        callSportplatforms: false
      }
    });

    modal.onWillDismiss().then((response) => {

    });

    return await modal.present();
  }

  public async openModalReservation() {
    if (!this.booking.horainicio) {
      await this.toasterService.presentError('Selecciona una hora de inicio para la reservación.');
      return false;
    }
  }

}
