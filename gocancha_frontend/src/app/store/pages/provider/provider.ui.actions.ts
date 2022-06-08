import {createAction, props} from '@ngrx/store';

/**
 * Load data favorite providers
 */

export const favoriteProvidersLoad = createAction(
  '[Store Provider] Provider favorite => Load',
  props<{ sportId: any }>()
);

export const favoriteProvidersLoading = createAction(
  '[Store Provider] Provider favorite => Loading',
);

export const favoriteProvidersLoaded = createAction(
  '[Store Provider] Provider favorite => Loaded',
  props<{ data: any }>()
);

export const favoriteProvidersWithError = createAction(
  '[Store Provider] Provider favorite => Error',
  props<{ error: string }>()
);

/**
 * Load data favorite nearby
 */

export const providersNearbyLoad = createAction(
  '[Store Provider] Provider nearby => Load',
  props<{ criteria: any }>()
);

export const providersNearbyLoading = createAction(
  '[Store Provider] Provider nearby => Loading',
);

export const providersNearbyLoaded = createAction(
  '[Store Provider] Provider nearby => Loaded',
  props<{ data: any }>()
);

export const providersNearbyWithError = createAction(
  '[Store Provider] Provider nearby => Error',
  props<{ error: string }>()
);

/**
 * Load bank account
 */

export const bankAccountLoad = createAction(
  '[Store Provider] Provider bank account => Load'
);

export const bankAccountLoading = createAction(
  '[Store Provider] Provider bank account => Loading',
);

export const bankAccountLoaded = createAction(
  '[Store Provider] Provider bank account => Loaded',
  props<{ data: any }>()
);

export const bankAccountWithError = createAction(
  '[Store Provider] Provider bank account => Error',
  props<{ error: string }>()
);

/**
 * Load Upload image
 */

export const uploadImageLoad = createAction(
  '[Store Provider] Upload image => Load',
  props<{ criteria: any }>()
);

export const uploadImageLoading = createAction(
  '[Store Provider] Upload image => Loading',
);

export const uploadImageLoaded = createAction(
  '[Store Provider] Upload image => Loaded',
  props<{ data: any }>()
);

export const clearImageLoaded = createAction(
  '[Store Provider] Clear image voucher'
);

export const uploadImageWithError = createAction(
  '[Store Provider] Upload image => Error',
  props<{ error: string }>()
);

/**
 * Load Reservation sport center
 */

export const reservationSportplatformLoad = createAction(
  '[Store Provider] Reservation sport platform => Load',
  props<{ reservation: any }>()
);

export const reservationSportplatformLoading = createAction(
  '[Store Provider] Reservation sport platform => Loading',
);

export const reservationSportplatformLoaded = createAction(
  '[Store Provider] Reservation sport platform => Loaded',
  props<{ data: any }>()
);

export const reservationSportplatformWithError = createAction(
  '[Store Provider] Reservation sport platform => Error',
  props<{ error: string }>()
);

export const saveDateReservation = createAction(
  '[Store Provider] Set date to reservation',
  props<{ dateReservation: string }>()
);

export const saveHourInitialReservation = createAction(
  '[Store Provider] Set hour initial to reservation',
  props<{ hourInitialReservation: any }>()
);

export const clearHourInitialReservation = createAction(
  '[Store Provider] Clear hour initial to reservation'
);

export const saveHourFinalReservation = createAction(
  '[Store Provider] Set hour final to reservation',
  props<{ hourFinalReservation: any }>()
);

export const saveTimeToReservation = createAction(
  '[Store Provider] Set time to reservation',
  props<{ timeToReservation: any }>()
);

export const saveDistanceToReservation = createAction(
  '[Store Provider] Set distance to reservation',
  props<{ distanceToReservation: any }>()
);

export const saveFeatureSportplatformToReservation = createAction(
  '[Store Provider] Set feature sportplatform to reservation',
  props<{ featureSportplatformToReservation: any }>()
);

export const saveTypeSportplatformToReservation = createAction(
  '[Store Provider] Set type sportplatform to reservation',
  props<{ typeSportplatformToReservation: any }>()
);

/**
 * Load data from provider
 */

export const dataFromProviderLoad = createAction(
  '[Store Provider] Data from Provider with Id => Load',
  props<{ providerId: any }>()
);

export const dataFromProviderLoading = createAction(
  '[Store Provider] Data from Provider with Id => Loading',
);

export const dataFromProviderLoaded = createAction(
  '[Store Provider] Data from Provider with Id => Loaded',
  props<{ data: any }>()
);

export const dataFromProviderWithError = createAction(
  '[Store Provider] Data from Provider with Id => Error',
  props<{ error: string }>()
);

export const switchFilterFavoriteProviders = createAction(
  '[Store Provider] Switch filter favorite to list provider'
);

/**
 * Load Mark provider like favorite
 */

export const markProviderLikeFavoriteLoad = createAction(
  '[Store Provider] Mark provider like favorite with Id => Load',
  props<{ providerId: any }>()
);

export const markProviderLikeFavoriteLoading = createAction(
  '[Store Provider] Mark provider like favorite with Id => Loading',
);

export const markProviderLikeFavoriteLoaded = createAction(
  '[Store Provider] Mark provider like favorite with Id => Loaded',
  props<{ data: any }>()
);

export const markProviderLikeFavoriteWithError = createAction(
  '[Store Provider] Mark provider like favorite with Id => Error',
  props<{ error: string }>()
);

/**
 * Load cancel reservation sport center
 */

export const cancelReservationSportplatformLoad = createAction(
  '[Store Provider] Cancel reservation sport platform => Load',
  props<{ reservation: any }>()
);

export const cancelReservationSportplatformLoading = createAction(
  '[Store Provider] Cancel reservation sport platform => Loading',
);

export const cancelReservationSportplatformLoaded = createAction(
  '[Store Provider] Cancel reservation sport platform => Loaded',
  props<{ data: any }>()
);

export const cancelReservationSportplatformWithError = createAction(
  '[Store Provider] Cancel reservation sport platform => Error',
  props<{ error: string }>()
);

export const cancelLastReservation = createAction(
  '[Store Provider] Cancel last reservation sport platform'
);

/**
 * Load support list
 */

export const supportAgentLoad = createAction(
  '[Store Provider] Support agent => Load'
);

export const supportAgentLoading = createAction(
  '[Store Provider] Support agent => Loading',
);

export const supportAgentLoaded = createAction(
  '[Store Provider] Support agent => Loaded',
  props<{ data: any }>()
);

export const supportAgentWithError = createAction(
  '[Store Provider] Support agent => Error',
  props<{ error: string }>()
);
