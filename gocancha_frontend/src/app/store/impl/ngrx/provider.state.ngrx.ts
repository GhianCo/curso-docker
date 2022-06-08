import { Injectable } from '@angular/core';
import { Store } from '@ngrx/store';
import * as ProviderUIActions from '@store/pages/provider/provider.ui.actions';
import { IProviderState } from "@store/pages/provider/provider.state";
import {
  bankAccountsLoading,
  cancelReservationSportplatformLoading,
  currentProviderSelected,
  dataFromProviderLoading,
  favoriteProvidersLoading,
  getBankAccounts,
  getDataFromProvider,
  getDateReservation,
  getDateReservationFormated,
  getDistanceToReservation,
  getFavoriteProviders,
  getFeatureSportplatformToReservation,
  getFilterFavoriteProviders,
  getHourFinalReservation,
  getHourInitialReservation,
  getProvidersNearby,
  getSupportAgents,
  getTimeToReservation, getTypeSportplatformToReservation,
  getVoucherTranferPaymentProvider,
  providerNearbyLoading,
  reservationSportplatformLoading,
  supportAgentsLoading,
  voucherTranferPaymentProviderLoading
} from "@store/pages/provider/provider.selector";
import { ProviderStateFacade } from "@core/facades/stores/ProviderStoreFacade";
import { Camera, CameraResultType, CameraSource } from "@capacitor/camera";
import { UtilityService } from "@shared/utils/utility.service";
import { PARAM, SPORTS_APP } from 'app/global/constants';
import { filter, take, tap } from 'rxjs/operators';
import { getCurrentCoords } from '@store/pages/auth/auth.selector';
import { currentSportSelected } from '@store/pages/sport/sport.selector';

@Injectable({
  providedIn: 'root'
})

export class ProviderStateNgrx implements ProviderStateFacade {
  favoriteProviders$ = this.store$.select(getFavoriteProviders);
  favoriteProvidersLoading$ = this.store$.select(favoriteProvidersLoading);

  providersNearby$ = this.store$.select(getProvidersNearby);
  providersNearbyLoading$ = this.store$.select(providerNearbyLoading);

  currentProviderSelected$ = this.store$.select(currentProviderSelected);

  bankAccounts$ = this.store$.select(getBankAccounts);
  bankAccountsLoading$ = this.store$.select(bankAccountsLoading);

  voucherTranferPaymentProvider$ = this.store$.select(getVoucherTranferPaymentProvider);
  voucherTranferPaymentProviderLoading$ = this.store$.select(voucherTranferPaymentProviderLoading);

  reservationSportplatformLoading$ = this.store$.select(reservationSportplatformLoading);

  cancelReservationSportplatformLoading$ = this.store$.select(cancelReservationSportplatformLoading);

  dateReservation$ = this.store$.select(getDateReservation);

  dateReservationFormated$ = this.store$.select(getDateReservationFormated);

  hourInitialReservation$ = this.store$.select(getHourInitialReservation);

  hourFinalReservation$ = this.store$.select(getHourFinalReservation);

  timeToReservation$ = this.store$.select(getTimeToReservation);

  distanceToReservation$ = this.store$.select(getDistanceToReservation);

  featureSportplatformToReservation$ = this.store$.select(getFeatureSportplatformToReservation);

  typeSportplatformToReservation$ = this.store$.select(getTypeSportplatformToReservation);

  dataFromProvider$ = this.store$.select(getDataFromProvider);
  dataFromProviderLoading$ = this.store$.select(dataFromProviderLoading);

  filterFavoriteProviders$ = this.store$.select(getFilterFavoriteProviders);

  supportAgents$ = this.store$.select(getSupportAgents);
  supportAgentsLoading$ = this.store$.select(supportAgentsLoading);

  constructor(
    private store$: Store<IProviderState>,
  ) {
  }

  public loadFavoriteProviders(sportId?) {
    if (!sportId) {
      sportId = this.getCurrentSportId;
    }
    this.store$.dispatch(ProviderUIActions.favoriteProvidersLoad({ sportId }));
  }

  public loadProvidersNearby(coords?: any) {
    const criteria: any = {
      pagina: 1,
      registros: 20,
      deporte_id: this.getCurrentSportId
    }
    if (coords) {
      criteria.latitud = coords.latitude;
      criteria.longitud = coords.longitude;
    } else {
      const currentCoords = this.getCurrentCoords;
      criteria.latitud = currentCoords.latitude;
      criteria.longitud = currentCoords.longitude;
    }
    this.store$.dispatch(ProviderUIActions.providersNearbyLoad({ criteria }));
  }

  public setCurrentProviderSelected(store: any) {
  }

  public loadBankAccounts() {
    this.store$.dispatch(ProviderUIActions.bankAccountLoad());
  }

  public async loadUploadVoucherTranferPaymentProvider() {
    const permissions = await Camera.checkPermissions();
    if (permissions.photos == 'denied') {
      await Camera.requestPermissions();
      return false;
    }
    const image = await Camera.getPhoto({
      quality: 100,
      allowEditing: false,
      resultType: CameraResultType.Base64,
      correctOrientation: false,
      source: CameraSource.Photos
    });

    const blobData = UtilityService.b64toBlob(image.base64String, `image/${image.format}`);
    if (blobData && blobData.size && blobData.size > 9000000) {
      return false;
    }
    const criteria = {
      blobData,
      dir: 'voucherReservation'
    }
    this.store$.dispatch(ProviderUIActions.uploadImageLoad({ criteria }));
  }

  public loadReservationSportplataform({ ...reservation }) {
    if (reservation.address && reservation.address.address_latitud == PARAM.TODOS && reservation.address.address_longitud == PARAM.TODOS) {
      const coords = this.getCurrentCoords;
      reservation.address.address_latitud = coords.latitude;
      reservation.address.address_longitud = coords.longitude;
    }
    this.store$.dispatch(ProviderUIActions.reservationSportplatformLoad({ reservation }));
  }

  public loadCancelReservationSportplataform(reservation) {
    this.store$.dispatch(ProviderUIActions.cancelReservationSportplatformLoad({ reservation }));
  }

  public setDateReservation(dateReservation: string) {
    this.store$.dispatch(ProviderUIActions.saveDateReservation({ dateReservation }));
  }

  public setHourInitialReservation(hourInitialReservation: any) {
    this.store$.dispatch(ProviderUIActions.saveHourInitialReservation({ hourInitialReservation }));
  }

  public clearHourInitialReservation() {
    this.store$.dispatch(ProviderUIActions.clearHourInitialReservation());
  }

  public setHourFinalReservation(hourFinalReservation: any) {
    this.store$.dispatch(ProviderUIActions.saveHourFinalReservation({ hourFinalReservation }));
  }

  public setTimeToReservation(timeToReservation: any) {
    this.store$.dispatch(ProviderUIActions.saveTimeToReservation({ timeToReservation }));
  }

  public setDistanceToReservation(distanceToReservation: any) {
    this.store$.dispatch(ProviderUIActions.saveDistanceToReservation({ distanceToReservation }));
  }

  public setFeatureSportplatformToReservation(featureSportplatformToReservation: any) {
    this.store$.dispatch(ProviderUIActions.saveFeatureSportplatformToReservation({ featureSportplatformToReservation }));
  }

  public setTypeSportplatformToReservation(typeSportplatformToReservation: any) {
    this.store$.dispatch(ProviderUIActions.saveTypeSportplatformToReservation({ typeSportplatformToReservation }));
  }

  public loadDataFromProvider(providerId: any) {
    this.store$.dispatch(ProviderUIActions.dataFromProviderLoad({ providerId }));
  }

  public switchFilterFavoriteProviders() {
    this.store$.dispatch(ProviderUIActions.switchFilterFavoriteProviders());
  }

  public changeStateFavoriteProvider(providerId) {
    this.store$.dispatch(ProviderUIActions.markProviderLikeFavoriteLoad({ providerId }));
  }

  public loadSupportAgents() {
    this.store$.dispatch(ProviderUIActions.supportAgentLoad());
  }

  public clearVoucherTranferPaymentProvider() {
    this.store$.dispatch(ProviderUIActions.clearImageLoaded());
  }

  private get getCurrentCoords() {
    let coords = {
      latitude: 0,
      longitude: 0
    };
    const currentProviderSub = this.store$.select(getCurrentCoords).pipe(
      take(1),
      filter(currentProvider => currentProvider),
      tap(currentProvider => {
        coords.latitude = currentProvider.latitude,
          coords.longitude = currentProvider.longitude
      })
    ).subscribe();
    currentProviderSub.unsubscribe();
    return coords;
  }

  private get getCurrentSportId() {
    let currentSportId: any = SPORTS_APP.FUTBOL;
    const currentProviderSub = this.store$.select(currentSportSelected).pipe(
      take(1),
      filter(currentSport => currentSport != null),
      tap(currentSport => {
        currentSportId = currentSport.sport_id;
      })
    ).subscribe();
    currentProviderSub.unsubscribe();
    return currentSportId;
  }

}
