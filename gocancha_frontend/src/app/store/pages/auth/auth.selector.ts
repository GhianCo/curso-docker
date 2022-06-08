import { createFeatureSelector, createSelector } from '@ngrx/store';
import { IAuthenticationState } from './auth.state';

export const authState = createFeatureSelector<IAuthenticationState>('auth');

/**
 * Data auth
 */

export const getLoginLoading = createSelector(
  authState,
  state => state.loadingLogin
);

export const getUserSession = createSelector(
  authState,
  state => state.userName + ' ' + state.userLastName
);
export const getUserNumber = createSelector(
  authState,
  state => state.userNumber
);

export const getUserId = createSelector(
  authState,
  state => state.userId
);

export const getAuthToken = createSelector(
  authState,
  state => state.authToken
);

export const getCurrentStoreSession = createSelector(
  authState,
  state => state.currentStore
);

export const getCurrentCurrencySession = createSelector(
  authState,
  state => state.currentCurrency
);

export const getStateSearchingCurrentPosition = createSelector(
  authState,
  state => state.searchingCurrentPosition
);

export const getCurrentAddress = createSelector(
  authState,
  state => state.currentAddress
);

export const getCurrentCoords = createSelector(
  authState,
  state => state.currentCoords
);

export const getProfileCustomer = createSelector(
  authState,
  state => state.profileCustomer
);

export const profileCustomerLoading = createSelector(
  authState,
  state => state.loadingProfileCustomer
);

export const updateProfileCustomerLoading = createSelector(
  authState,
  state => state.loadingUpdateProfileCustomer
);

export const getHistoryReservationCustomer = createSelector(
  authState,
  state => state.historyReservationCustomer
);

export const historyReservationCustomerLoading = createSelector(
  authState,
  state => state.loadingHistoryReservationCustomer
);

export const getlastReservationsCustomer = createSelector(
  authState,
  state => state.lastReservationsCustomer
);

export const lastReservationsCustomerLoading = createSelector(
  authState,
  state => state.loadinglastReservationsCustomer
);

export const getSummaryReservationCustomer = createSelector(
  authState,
  state => state.summaryReservationCustomer
);

export const summaryReservationCustomerLoading = createSelector(
  authState,
  state => state.loadingSummaryReservationCustomer
);

export const getAddressesFound = createSelector(
  authState,
  state => state.addressesFound
);

export const addressesFoundLoading = createSelector(
  authState,
  state => state.loadingAddressesFound
);

export const loadingPaymentOnline = createSelector(
  authState,
  state => state.loadingPaymentOnline
);

export const reservationToPayOnline = createSelector(
  authState,
  state => state.reservationToPayOnline
);

export const loadingCoordsByPlace = createSelector(
  authState,
  state => state.loadingCoordsByPlace
);

