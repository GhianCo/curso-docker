import {createFeatureSelector, createSelector} from '@ngrx/store';
import {IProviderState} from './provider.state';
import {DateTimeUtils} from "@shared/utils/datetimeUtils";

export const providerState = createFeatureSelector<IProviderState>('provider');

/**
 * Data provider
 */

export const getFavoriteProviders = createSelector(
  providerState,
  state => state.favoriteProviders
);

export const favoriteProvidersLoading = createSelector(
  providerState,
  state => state.loadingFavoriteProviders
);

export const getProvidersNearby = createSelector(
  providerState,
  state => state.providersNearby
);

export const providerNearbyLoading = createSelector(
  providerState,
  state => state.loadingProvidersNearby
);

export const currentProviderSelected = createSelector(
  providerState,
  state => state.currentProviderSelected
);

export const getBankAccounts = createSelector(
  providerState,
  state => state.bankAccounts
);

export const bankAccountsLoading = createSelector(
  providerState,
  state => state.loadingBankAccounts
);

export const getVoucherTranferPaymentProvider = createSelector(
  providerState,
  state => state.voucherTranferPaymentProvider
);

export const voucherTranferPaymentProviderLoading = createSelector(
  providerState,
  state => state.loadingVoucherTranferPaymentProvider
);

export const reservationSportplatformLoading = createSelector(
  providerState,
  state => state.loadingReservationSportplatform
);

export const getDateReservation = createSelector(
  providerState,
  state => state.dateReservation
);

export const getDateReservationFormated = createSelector(
  providerState,
  state => DateTimeUtils.getFormatDateViewWithoutHour(state.dateReservation)
);

export const getHourInitialReservation = createSelector(
  providerState,
  state => state.hourInitialReservation
);

export const getHourFinalReservation = createSelector(
  providerState,
  state => state.hourFinalReservation
);

export const getTimeToReservation = createSelector(
  providerState,
  state => state.timeToReservation
);

export const getDistanceToReservation = createSelector(
  providerState,
  state => state.distanceToReservation
);

export const getFeatureSportplatformToReservation = createSelector(
  providerState,
  state => state.featureSportplatformToReservation
);

export const getTypeSportplatformToReservation = createSelector(
  providerState,
  state => state.typeSportplatformToReservation
);

export const getDataFromProvider = createSelector(
  providerState,
  state => state.dataFromProvider
);

export const dataFromProviderLoading = createSelector(
  providerState,
  state => state.loadingDataFromProvider
);

export const getFilterFavoriteProviders = createSelector(
  providerState,
  state => state.filterFavoriteProviders
);

export const markProviderLikeFavoriteLoading = createSelector(
  providerState,
  state => state.loadingMarkProviderLikeFavorite
);

export const cancelReservationSportplatformLoading = createSelector(
  providerState,
  state => state.loadingCancelReservationSportplatform
);

export const getSupportAgents = createSelector(
  providerState,
  state => state.supportAgents
);

export const supportAgentsLoading = createSelector(
  providerState,
  state => state.loadingsupportAgents
);
