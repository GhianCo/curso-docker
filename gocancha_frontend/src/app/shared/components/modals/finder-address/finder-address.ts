import { Component, Input, OnInit, ViewChild } from '@angular/core';
import { Observable } from 'rxjs';
import { ModalController } from "@ionic/angular";
import { AuthenticationStateFacade } from "@core/facades/stores/AuthStoreFacade";
import { Geolocation } from "@capacitor/geolocation";
import { LoadingService } from "@shared/services/loading.service";
import { Components } from "@ionic/core";
import { Dialog } from '@capacitor/dialog';

@Component({
  selector: 'app-finder-address',
  templateUrl: './finder-address.html',
  styleUrls: ['./finder-address.scss']
})

export class FinderAddress implements OnInit {

  public addressesFound$: Observable<any[]> = this.authenticationStateFacade.addressesFound$;
  public addressesFoundLoading$: Observable<boolean> = this.authenticationStateFacade.addressesFoundLoading$;

  @ViewChild('searchProduct') searchProduct: any;
  @Input() modal: Components.IonModal;

  public searchQuery = '';

  constructor(
    private authenticationStateFacade: AuthenticationStateFacade,
    public loadingService: LoadingService,
    private modalController: ModalController,
  ) {
  }

  ngOnInit() {
  }

  public performSearch() {

    if (this.searchQuery.length == 0) {
      return false;
    }

    this.authenticationStateFacade.loadSearchAddress(this.searchQuery);

  }

  public async selectAddress(address) {
    this.authenticationStateFacade.loadCoordsByPlace(address.id);
  }

  public async selectCurrentsCoords() {
    try {
      await this.loadingService.showLoading('Buscando las coordenadas de tu dirección...');
      const currentCoords = await Geolocation.getCurrentPosition();
      await this.loadingService.hideLoading();
      if (currentCoords) {
        await this.modalController.dismiss();
        this.authenticationStateFacade.getAddressByCoors(currentCoords.coords);
      }
    } catch (e) {
      await this.loadingService.hideLoading();

      await Dialog.alert({
        title: 'Geolocalización inactiva',
        message: 'Tu ubicación está inactiva, ingresa tu ubicación manual.',
      });
    }
  }

  public async dismiss() {
    await this.modal.dismiss('cancel');
  }

  ionViewDidEnter() {
    this.searchProduct.setFocus();
  }
}
