import {createAction, props} from '@ngrx/store';

/**
 * Login Firebase
 */

export const loginFirebaseLoad = createAction(
  '[Store Login Firebase] Login Firebase => Load',
  props<{ criteria: any }>()
);

export const loginFirebaseLoading = createAction(
  '[Store Login Firebase] Login Firebase => Loading',
);

export const loginFirebaseLoaded = createAction(
  '[Store Login Firebase] Login Firebase => Loaded',
  props<{ data: any }>()
);

export const loginFirebaseWithError = createAction(
  '[Store Login Firebase] Login Firebase => Error',
  props<{ error: string }>()
);

/**
 * Login Subdomain
 */

export const loginSubdomainLoad = createAction(
  '[Store Login] Login => Load',
  props<{ criteria: any }>()
);

export const loginSubdomainLoading = createAction(
  '[Store Login] Login => Loading',
);

export const loginSubdomainLoaded = createAction(
  '[Store Login] Login => Loaded',
  props<{ data: any }>()
);

export const loginSubdomainWithError = createAction(
  '[Store Login] Login => Error',
  props<{ error: string }>()
);

/**
 * Set data from localstorage to state app
 */

export const setSessionLocalstorageToStateApp = createAction(
  '[Store App] Set data session localstorage to state',
  props<{ session: any }>()
);

/**
 * Set data currento store in state
 */

export const getAddressByCoors = createAction(
  '[Store App] Get current position device',
  props<{ coords: any }>()
);

export const getAddressByCoorsWithError = createAction(
  '[Store App] Get current position device => Error',
  props<{ error: string }>()
);

export const saveCurrentAddress = createAction(
  '[Store App] Save current address',
  props<{ address: any }>()
);

export const saveCurrentCoords = createAction(
  '[Store App] Save current coords to search',
  props<{ currentCoords: any }>()
);

export const searchingCurrentPosition = createAction(
  '[Store App] Change state to search current position',
  props<{ stateCurrentPosition: boolean }>()
);

/**
 * Logout session
 */
export const logOutLoad = createAction(
  '[Store Auth] LogOut en subdominio => Load',
  props<{ authToken: string }>()
);

export const logOutLoading = createAction(
  '[Store Auth] LogOut en subdominio => Loading',
);

export const logOutLoaded = createAction(
  '[Store Auth] LogOut en subdominio => Loaded'
);

export const logOutWithError = createAction(
  '[Store Auth] LogOut en subdominio => Error',
  props<{ error: string }>()
);

/**
 * Profile customer
 */

export const profileCustomerLoad = createAction(
  '[Store Profile customer] Profile customer => Load'
);

export const profileCustomerLoading = createAction(
  '[Store Profile customer] Profile customer => Loading',
);

export const profileCustomerLoaded = createAction(
  '[Store Profile customer] Profile customer => Loaded',
  props<{ data: any }>()
);

export const profileCustomerWithError = createAction(
  '[Store Profile customer] Profile customer => Error',
  props<{ error: string }>()
);

/**
 * Update profile customer
 */

export const updateProfileCustomerLoad = createAction(
  '[Store Profile customer] Update Profile customer => Load',
  props<{ customer: any }>()

);

export const updateProfileCustomerLoading = createAction(
  '[Store Profile customer] Update Profile customer => Loading',
);

export const updateProfileCustomerLoaded = createAction(
  '[Store Profile customer] Update Profile customer => Loaded',
  props<{ data: any }>()
);

export const updateProfileCustomerWithError = createAction(
  '[Store Profile customer] Update Profile customer => Error',
  props<{ error: string }>()
);

/**
 * Load history reservation
 */

export const historyReservationCustomerLoad = createAction(
  '[Store History reservation customer] History reservation customer => Load',
  props<{ criteria: any }>()
);

export const historyReservationCustomerLoading = createAction(
  '[Store History reservation customer] History reservation customer => Loading',
);

export const historyReservationCustomerLoaded = createAction(
  '[Store History reservation customer] History reservation customer => Loaded',
  props<{ data: any }>()
);

export const historyReservationCustomerWithError = createAction(
  '[Store History reservation customer] History reservation customer => Error',
  props<{ error: string }>()
);

/**
 * Load last reservation
 */

export const lastReservationsCustomerLoad = createAction(
  '[Store Last reservation customer] Last reservation customer => Load'
);

export const lastReservationsCustomerLoading = createAction(
  '[Store Last reservation customer] Last reservation customer => Loading',
);

export const lastReservationsCustomerLoaded = createAction(
  '[Store Last reservation customer] Last reservation customer => Loaded',
  props<{ data: any }>()
);

export const lastReservationsCustomerWithError = createAction(
  '[Store Last reservation customer] Last reservation customer => Error',
  props<{ error: string }>()
);

/**
 * Load summary reservation
 */

export const summaryReservationCustomerLoad = createAction(
  '[Store Summary reservation customer] Summary reservation customer => Load',
  props<{ criteria: any }>()
);

export const summaryReservationCustomerLoading = createAction(
  '[Store Summary reservation customer] Summary reservation customer => Loading',
);

export const summaryReservationCustomerLoaded = createAction(
  '[Store Summary reservation customer] Summary reservation customer => Loaded',
  props<{ data: any }>()
);

export const summaryReservationCustomerWithError = createAction(
  '[Store Summary reservation customer] Summary reservation customer => Error',
  props<{ error: string }>()
);

/**
 * Load address by searh
 */

export const searchAddressLoad = createAction(
  '[Store Seach address] Seach address => Load',
  props<{ address: string }>()
);

export const searchAddressLoading = createAction(
  '[Store Seach address] Seach address => Loading',
);

export const searchAddressLoaded = createAction(
  '[Store Seach address] Seach address => Loaded',
  props<{ data: any }>()
);

export const searchAddressWithError = createAction(
  '[Store Seach address] Seach address => Error',
  props<{ error: string }>()
);

/**
 * Load coords by place
 */

export const coordsByPlaceLoad = createAction(
  '[Store Coords by place] Coords by place => Load',
  props<{ placeId: string }>()
);

export const coordsByPlaceLoading = createAction(
  '[Store Coords by place] Coords by place => Loading',
);

export const coordsByPlaceLoaded = createAction(
  '[Store Coords by place] Coords by place => Loaded',
  props<{ data: any }>()
);

export const coordsByPlaceWithError = createAction(
  '[Store Coords by place] Coords by place => Error',
  props<{ error: string }>()
);

/**
 * Load payment online reservation
 */

export const paymentOnlineReservationLoad = createAction(
  '[Store Auth] Payment Online Reservation => Load',
  props<{ criteria: string }>()
);

export const paymentOnlineReservationLoading = createAction(
  '[Store Auth] Payment Online Reservation => Loading',
);

export const paymentOnlineReservationLoaded = createAction(
  '[Store Auth] Payment Online Reservation => Loaded',
  props<{ data: any }>()
);

export const paymentOnlineReservationWasSuccess = createAction(
  '[Store Auth] Payment Online Reservation was success',
  props<{ data: any }>()
);

export const paymentOnlineReservationWithError = createAction(
  '[Store Auth] Payment Online Reservation => Error',
  props<{ error: string }>()
);

export const saveReservationToPaymentOnline = createAction(
  '[Store Auth] Save Reservation to Payment Online Reservation',
  props<{ reservation: any }>()
);

export const clearReservationToPaymentOnline = createAction(
  '[Store Auth] Clear Reservation to Payment Online Reservation',
);

/**
 * Update FCM
 */

export const updateFCMLoad = createAction(
  '[Store Auth] Auth update FCM => Load',
  props<{ criteria: any }>()
);

export const updateFCMLoading = createAction(
  '[Store Auth] Auth update FCM => Loading',
);

export const updateFCMLoaded = createAction(
  '[Store Auth] Auth update FCM => Loaded',
  props<{ data: any }>()
);

export const updateFCMWithError = createAction(
  '[Store Auth] Auth update FCM => Error',
  props<{ error: string }>()
);
