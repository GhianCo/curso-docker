import { ChangeDetectionStrategy, Component, OnDestroy, OnInit } from '@angular/core';
import { Subject } from 'rxjs';
import { UtilityService } from '@shared/utils/utility.service';
import { AuthenticationStateFacade } from "@core/facades/stores/AuthStoreFacade";
import { filter, tap } from "rxjs/operators";
import { ProviderStateFacade } from "@core/facades/stores/ProviderStoreFacade";
import { MapsAPILoader } from '@agm/core';
import { Geolocation } from "@capacitor/geolocation";
import { ModalController } from "@ionic/angular";
import { SportStateFacade } from "@core/facades/stores/SportStoreFacade";
import { FinderAddress } from "@shared/components/modals/finder-address/finder-address";
import { Dialog } from '@capacitor/dialog';
import { Directory, Filesystem } from '@capacitor/filesystem';
import { StatusBar, Style } from '@capacitor/status-bar';
import { Capacitor } from '@capacitor/core';
import { FirebaseNotificationService } from '@core/datasources/firebase/FirebaseNotificationService';

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush
})

export class AppComponent implements OnInit, OnDestroy {
  private unsubscribe$ = new Subject<void>();

  constructor(
    public utilityService: UtilityService,
    public authenticationStoreFacade: AuthenticationStateFacade,
    public providerStateFacade: ProviderStateFacade,
    public mapsAPILoader: MapsAPILoader,
    private authenticationStateFacade: AuthenticationStateFacade,
    public sportStateFacade: SportStateFacade,
    private modalController: ModalController
  ) {
    this.initializeApp();
  }

  private async initializeApp() {
    if (Capacitor.getPlatform() != 'web') {
      await StatusBar.setStyle({ style: Style.Light });
      FirebaseNotificationService.removeAllDeliveredNotifications();
    }
    try {
      await Filesystem.mkdir({
        directory: Directory.Cache,
        path: 'CACHED-IMG',
        recursive: false
      })
    } catch (e) {
    }
  }

  public async ngOnInit() {
    this.authenticationStoreFacade.authToken$.pipe(
      filter(authToken => authToken != ''),
      tap(async _ => {
        this.sportStateFacade.loadSports();
        this.authenticationStateFacade.loadProfileCustomer();
        try {
          this.authenticationStateFacade.searchingCurrentPosition(true);
          const currentCoords = await Geolocation.getCurrentPosition();
          if (currentCoords) {
            this.authenticationStoreFacade.getAddressByCoors(currentCoords.coords);
          }
          this.authenticationStateFacade.searchingCurrentPosition(false);
        } catch (e) {
          this.authenticationStateFacade.searchingCurrentPosition(false);
          this.authenticationStateFacade.setSelectAddressManual();

          await Dialog.alert({
            title: 'Geolocalización inactiva',
            message: 'Tu ubicación está inactiva, ingresa tu ubicación manual.',
          });

          const modal = await this.modalController.create({
            component: FinderAddress
          });

          modal.onWillDismiss().then((response) => {

          });

          return await modal.present();
        }
      }),
    ).subscribe();
  }

  ngOnDestroy(): void {
    this.unsubscribe$.next();
    this.unsubscribe$.complete();
  }

}
