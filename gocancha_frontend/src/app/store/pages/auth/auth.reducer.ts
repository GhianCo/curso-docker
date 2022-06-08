import { Action, createReducer, on } from '@ngrx/store';
import * as AuthUIActions from './auth.ui.actions';
import { IAuthenticationState, initialAuthenticationState } from "./auth.state";

const reducer = createReducer(
  initialAuthenticationState,
  /**
   * Load data login in firebase
   */
  on(AuthUIActions.loginFirebaseLoading, (state): IAuthenticationState => {
    return {
      ...state,
      //loadingLogin: true,
    };
  }),
  on(AuthUIActions.loginFirebaseLoaded, (state): IAuthenticationState => {
    return {
      ...state,
      //loadingLogin: false,
    };
  }),
  on(AuthUIActions.loginFirebaseWithError, (state): IAuthenticationState => {
    return {
      ...state,
      //loadingLogin: false,
    };
  }),
  /**
   * Load data login in subdomain
   */
  on(AuthUIActions.loginSubdomainLoading, (state): IAuthenticationState => {
    return {
      ...state,
      loadingLogin: true,
    };
  }),
  on(AuthUIActions.loginSubdomainLoaded, (state): IAuthenticationState => {
    return {
      ...state,
      loadingLogin: false,
    };
  }),
  on(AuthUIActions.loginSubdomainWithError, (state): IAuthenticationState => {
    return {
      ...state,
      loadingLogin: false,
    };
  }),
  /**
   * Set data localstorage to state app
   */
  on(AuthUIActions.setSessionLocalstorageToStateApp, (state, action): IAuthenticationState => {
    const session = action.session;
    return {
      ...state,
      ...session
    };
  }),
  /**
   * Save current address geolocalization
   */
  on(AuthUIActions.saveCurrentAddress, (state, action): IAuthenticationState => {
    const currentAddress = action.address;
    return {
      ...state,
      currentAddress,
      loadingCoordsByPlace: false
    };
  }),
  /**
   * Save current coords
   */
  on(AuthUIActions.saveCurrentCoords, (state, action): IAuthenticationState => {
    const currentCoords = action.currentCoords;
    return {
      ...state,
      currentCoords,
    };
  }),
  on(AuthUIActions.searchingCurrentPosition, (state, action): IAuthenticationState => {
    return {
      ...state,
      searchingCurrentPosition: action.stateCurrentPosition,
    };
  }),
  /**
   * Save current coords too
   */
  on(AuthUIActions.getAddressByCoors, (state, action): IAuthenticationState => {
    const coords = action.coords;
    const currentCoords = { ...state.currentCoords };
    currentCoords.latitude = coords.latitude;
    currentCoords.longitude = coords.longitude;
    return {
      ...state,
      currentCoords,
    };
  }),
  /**
   * Get profile customer
   */
  on(AuthUIActions.profileCustomerLoading, (state): IAuthenticationState => {
    return {
      ...state,
      loadingProfileCustomer: true,
    };
  }),
  on(AuthUIActions.profileCustomerLoaded, (state, action): IAuthenticationState => {
    const profileCustomer = action.data;
    return {
      ...state,
      profileCustomer,
      loadingProfileCustomer: false,
    };
  }),
  on(AuthUIActions.profileCustomerWithError, (state): IAuthenticationState => {
    return {
      ...state,
      loadingProfileCustomer: false,
    };
  }),
  /**
   * Update profile customer
   */
  on(AuthUIActions.updateProfileCustomerLoading, (state): IAuthenticationState => {
    return {
      ...state,
      loadingUpdateProfileCustomer: true,
    };
  }),
  on(AuthUIActions.updateProfileCustomerLoaded, (state, action): IAuthenticationState => {
    const profileCustomer = action.data || state.profileCustomer;
    return {
      ...state,
      profileCustomer,
      loadingUpdateProfileCustomer: false,
    };
  }),
  on(AuthUIActions.updateProfileCustomerWithError, (state): IAuthenticationState => {
    return {
      ...state,
      loadingUpdateProfileCustomer: false,
    };
  }),
  /**
   * Get history reservation customer
   */
  on(AuthUIActions.historyReservationCustomerLoading, (state): IAuthenticationState => {
    return {
      ...state,
      loadingHistoryReservationCustomer: true,
    };
  }),
  on(AuthUIActions.historyReservationCustomerLoaded, (state, action): IAuthenticationState => {
    const historyReservationCustomer = action.data;
    return {
      ...state,
      historyReservationCustomer,
      loadingHistoryReservationCustomer: false,
    };
  }),
  on(AuthUIActions.historyReservationCustomerWithError, (state): IAuthenticationState => {
    return {
      ...state,
      loadingHistoryReservationCustomer: false,
    };
  }),
  /**
   * Get last reservation customer
   */
  on(AuthUIActions.lastReservationsCustomerLoading, (state): IAuthenticationState => {
    return {
      ...state,
      loadinglastReservationsCustomer: true,
    };
  }),
  on(AuthUIActions.lastReservationsCustomerLoaded, (state, action): IAuthenticationState => {
    const lastReservationsCustomer = action.data;
    return {
      ...state,
      lastReservationsCustomer,
      loadinglastReservationsCustomer: false,
    };
  }),
  on(AuthUIActions.lastReservationsCustomerWithError, (state): IAuthenticationState => {
    return {
      ...state,
      loadinglastReservationsCustomer: false,
    };
  }),
  /**
   * Get summary reservation customer
   */
  on(AuthUIActions.summaryReservationCustomerLoading, (state): IAuthenticationState => {
    return {
      ...state,
      loadingSummaryReservationCustomer: true,
    };
  }),
  on(AuthUIActions.summaryReservationCustomerLoaded, (state, action): IAuthenticationState => {
    const summaryReservationCustomer = action.data;
    return {
      ...state,
      summaryReservationCustomer,
      loadingSummaryReservationCustomer: false,
    };
  }),
  on(AuthUIActions.summaryReservationCustomerWithError, (state): IAuthenticationState => {
    return {
      ...state,
      loadingSummaryReservationCustomer: false,
    };
  }),
  /**
   * Search address by query
   */
  on(AuthUIActions.searchAddressLoading, (state): IAuthenticationState => {
    return {
      ...state,
      loadingAddressesFound: true,
    };
  }),
  on(AuthUIActions.searchAddressLoaded, (state, action): IAuthenticationState => {
    const addressesFound = action.data;
    return {
      ...state,
      addressesFound,
      loadingAddressesFound: false,
    };
  }),
  on(AuthUIActions.searchAddressWithError, (state): IAuthenticationState => {
    return {
      ...state,
      loadingAddressesFound: false,
    };
  }),
  /**
   * Get coords by place
   */
  on(AuthUIActions.coordsByPlaceLoading, (state): IAuthenticationState => {
    return {
      ...state,
      loadingCoordsByPlace: true,
    };
  }),
  on(AuthUIActions.coordsByPlaceLoaded, (state,): IAuthenticationState => {
    return {
      ...state,
      loadingCoordsByPlace: false,
    };
  }),
  on(AuthUIActions.coordsByPlaceWithError, (state): IAuthenticationState => {
    return {
      ...state,
      loadingCoordsByPlace: false,
    };
  }),
  /**
   * Payment online reservation
   */
  on(AuthUIActions.paymentOnlineReservationLoading, (state): IAuthenticationState => {
    return {
      ...state,
      loadingPaymentOnline: true,
    };
  }),
  on(AuthUIActions.paymentOnlineReservationLoaded, (state,): IAuthenticationState => {
    return {
      ...state,
      loadingPaymentOnline: false,
    };
  }),
  on(AuthUIActions.paymentOnlineReservationWithError, (state): IAuthenticationState => {
    return {
      ...state,
      loadingPaymentOnline: false,
    };
  }),
  on(AuthUIActions.paymentOnlineReservationWasSuccess, (state, action): IAuthenticationState => {
    const reservationToPayOnline = { ...state.reservationToPayOnline };
    const reserva = { ...reservationToPayOnline.reserva };
    reserva.reserva_niubiz = action.data;
    reservationToPayOnline.reserva = reserva;
    return {
      ...state,
      reservationToPayOnline
    };
  }),
  on(AuthUIActions.saveReservationToPaymentOnline, (state, action): IAuthenticationState => {
    return {
      ...state,
      reservationToPayOnline: action.reservation,
    };
  }),
  on(AuthUIActions.clearReservationToPaymentOnline, (state): IAuthenticationState => {
    return {
      ...state,
      reservationToPayOnline: null
    };
  }),
);

export function auth(state: IAuthenticationState | undefined, action: Action) {
  return reducer(state, action);
}
