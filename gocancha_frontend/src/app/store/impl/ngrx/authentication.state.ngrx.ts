import {Injectable} from '@angular/core';
import {Store} from '@ngrx/store';
import * as AuthUIActions from '@store/pages/auth/auth.ui.actions';
import {IAuthenticationState} from "@store/pages/auth/auth.state";
import {AuthenticationStateFacade} from "@core/facades/stores/AuthStoreFacade";
import {
  addressesFoundLoading,
  getAddressesFound,
  getAuthToken,
  getCurrentAddress,
  getCurrentCoords,
  getCurrentCurrencySession,
  getCurrentStoreSession,
  getHistoryReservationCustomer,
  getlastReservationsCustomer,
  getLoginLoading,
  getProfileCustomer,
  getStateSearchingCurrentPosition,
  getSummaryReservationCustomer, getUserId, getUserNumber,
  getUserSession,
  historyReservationCustomerLoading,
  lastReservationsCustomerLoading, loadingCoordsByPlace, loadingPaymentOnline,
  profileCustomerLoading, reservationToPayOnline, summaryReservationCustomerLoading, updateProfileCustomerLoading,
} from "@store/pages/auth/auth.selector";
import {filter, take, tap} from "rxjs/operators";
import { PARAM } from 'app/global/constants';

@Injectable({
  providedIn: 'root'
})

export class AuthenticationStateNgrx implements AuthenticationStateFacade {
  private authToken = '';

  loginLoading$ = this.store$.select(getLoginLoading);
  userSession$ = this.store$.select(getUserSession);
  userNumber$ = this.store$.select(getUserNumber);
  userId$ = this.store$.select(getUserId);
  currentStore$ = this.store$.select(getCurrentStoreSession);
  currentCurrency$ = this.store$.select(getCurrentCurrencySession);
  currentAddress$ = this.store$.select(getCurrentAddress);
  authToken$ = this.store$.select(getAuthToken);
  currentCoords$ = this.store$.select(getCurrentCoords);

  profileCustomer$ = this.store$.select(getProfileCustomer);
  profileCustomerLoading$ = this.store$.select(profileCustomerLoading);

  updateProfileCustomerLoading$ = this.store$.select(updateProfileCustomerLoading);

  historyReservationCustomer$ = this.store$.select(getHistoryReservationCustomer);
  historyReservationCustomerLoading$ = this.store$.select(historyReservationCustomerLoading);

  lastReservationsCustomer$ = this.store$.select(getlastReservationsCustomer);
  lastReservationsCustomerLoading$ = this.store$.select(lastReservationsCustomerLoading);

  summaryReservationCustomer$ = this.store$.select(getSummaryReservationCustomer);
  summaryReservationCustomerLoading$ = this.store$.select(summaryReservationCustomerLoading);

  searchingCurrentPosition$ = this.store$.select(getStateSearchingCurrentPosition);
  addressesFound$ = this.store$.select(getAddressesFound);
  addressesFoundLoading$ = this.store$.select(addressesFoundLoading);

  loadingPaymentOnline$ = this.store$.select(loadingPaymentOnline);

  reservationToPayOnline$ = this.store$.select(reservationToPayOnline);

  loadingCoordsByPlace$ = this.store$.select(loadingCoordsByPlace);

  constructor(
    private store$: Store<IAuthenticationState>,
  ) {
    this.store$.select(getAuthToken).pipe(tap(authToken => this.authToken = authToken)).subscribe();
  }

  public login(criteria: string) {
    this.store$.dispatch(AuthUIActions.loginFirebaseLoad({criteria}));
  }

  public loadLoginSubdomain(criteria: string) {
    this.store$.dispatch(AuthUIActions.loginSubdomainLoad({criteria}));
  }

  public setSessionLocalstorageToStateApp(session: any) {
    this.store$.dispatch(AuthUIActions.setSessionLocalstorageToStateApp({session}));
  }

  public async setCurrentCoords(currentCoords) {
    this.store$.dispatch(AuthUIActions.saveCurrentCoords({currentCoords}));
  }

  public async getAddressByCoors(coords) {
    this.store$.dispatch(AuthUIActions.getAddressByCoors({coords}));
  }

  public loadSignOut() {
    const authToken = this.authToken;
    this.store$.dispatch(AuthUIActions.logOutLoad({authToken}));
  }

  public loadProfileCustomer() {
    this.store$.dispatch(AuthUIActions.profileCustomerLoad());
  }

  public loadUpdateProfileCustomer(customer) {
    this.store$.dispatch(AuthUIActions.updateProfileCustomerLoad({customer}));
  }

  public loadHistoryReservationCustomer({...criteria}) {
    criteria.page = 1;
    criteria.register = 100;
    this.store$.dispatch(AuthUIActions.historyReservationCustomerLoad({criteria}));
  }

  public loadlastReservationsCustomer() {
    this.store$.dispatch(AuthUIActions.lastReservationsCustomerLoad());
  }

  public loadSummaryReservationCustomer(criteria) {
    this.store$.dispatch(AuthUIActions.summaryReservationCustomerLoad({criteria}));
  }

  public searchingCurrentPosition(stateCurrentPosition) {
    this.store$.dispatch(AuthUIActions.searchingCurrentPosition({stateCurrentPosition}));
  }

  public loadSearchAddress(address) {
    this.store$.dispatch(AuthUIActions.searchAddressLoad({address}));
  }

  public loadCoordsByPlace(placeId) {
    this.store$.dispatch(AuthUIActions.coordsByPlaceLoad({placeId}));
  }

  public setSelectAddressManual() {
    this.store$.dispatch(AuthUIActions.saveCurrentAddress({address: 'GPS inactivo, ingresa tu dirección manual...'}));
  }

  public saveReservationToPaymentOnline({...reservation}) {
    if (reservation.address && reservation.address.address_latitud == PARAM.TODOS && reservation.address.address_longitud == PARAM.TODOS) {
      const coords = this.getCurrentCoords;
      reservation.address.address_latitud = coords.latitude;
      reservation.address.address_longitud = coords.longitude;
    }
    this.store$.dispatch(AuthUIActions.saveReservationToPaymentOnline({reservation}));
  }

  public clearReservationToPaymentOnline() {
    this.store$.dispatch(AuthUIActions.clearReservationToPaymentOnline());
  }

  public loadPaymentOnlineReservation(criteria) {
    this.store$.dispatch(AuthUIActions.paymentOnlineReservationLoad({criteria}));
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

}
