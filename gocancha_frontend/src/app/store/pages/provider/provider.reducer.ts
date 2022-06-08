import {Action, createReducer, on} from '@ngrx/store';
import * as ProviderUIActions from './provider.ui.actions';
import {IProviderState, initialProviderState} from "./provider.state";
import {DateTimeUtils} from "@shared/utils/datetimeUtils";

const reducer = createReducer(
  initialProviderState,
  /**
   * Load data providers
   */
  on(ProviderUIActions.favoriteProvidersLoading, (state): IProviderState => {
    return {
      ...state,
      loadingFavoriteProviders: true,
    };
  }),
  on(ProviderUIActions.favoriteProvidersLoaded, (state, action): IProviderState => {
    const favoriteProviders = action.data;
    return {
      ...state,
      favoriteProviders,
      loadingFavoriteProviders: false,
    };
  }),
  on(ProviderUIActions.favoriteProvidersWithError, (state): IProviderState => {
    return {
      ...state,
      loadingFavoriteProviders: false,
    };
  }),
  on(ProviderUIActions.providersNearbyLoading, (state): IProviderState => {
    return {
      ...state,
      loadingProvidersNearby: true,
    };
  }),
  on(ProviderUIActions.providersNearbyLoaded, (state, action): IProviderState => {
    const providersNearby = action.data || [];
    return {
      ...state,
      providersNearby,
      loadingProvidersNearby: false,
    };
  }),
  on(ProviderUIActions.providersNearbyWithError, (state): IProviderState => {
    return {
      ...state,
      loadingProvidersNearby: false,
    };
  }),
  /**
   * Get bank accounts
   */
  on(ProviderUIActions.bankAccountLoading, (state): IProviderState => {
    return {
      ...state,
      loadingBankAccounts: true,
    };
  }),
  on(ProviderUIActions.bankAccountLoaded, (state, action): IProviderState => {
    const bankAccounts = action.data;
    return {
      ...state,
      bankAccounts,
      loadingBankAccounts: false,
    };
  }),
  on(ProviderUIActions.bankAccountWithError, (state): IProviderState => {
    return {
      ...state,
      loadingBankAccounts: false,
    };
  }),
  /**
   * Upload image
   */
  on(ProviderUIActions.uploadImageLoading, (state): IProviderState => {
    return {
      ...state,
      loadingVoucherTranferPaymentProvider: true,
    };
  }),
  on(ProviderUIActions.uploadImageLoaded, (state, action): IProviderState => {
    const data = action.data;
    return {
      ...state,
      voucherTranferPaymentProvider: data.public_id,
      loadingVoucherTranferPaymentProvider: false,
    };
  }),
  on(ProviderUIActions.clearImageLoaded, (state): IProviderState => {
    return {
      ...state,
      voucherTranferPaymentProvider: null,
    };
  }),
  on(ProviderUIActions.uploadImageWithError, (state): IProviderState => {
    return {
      ...state,
      loadingVoucherTranferPaymentProvider: false,
    };
  }),
  /**
   * Reservation sport platform
   */
  on(ProviderUIActions.reservationSportplatformLoading, (state): IProviderState => {
    return {
      ...state,
      loadingReservationSportplatform: true,
    };
  }),
  on(ProviderUIActions.reservationSportplatformLoaded, (state): IProviderState => {
    return {
      ...state,
      loadingReservationSportplatform: false,
    };
  }),
  on(ProviderUIActions.reservationSportplatformWithError, (state): IProviderState => {
    return {
      ...state,
      loadingReservationSportplatform: false,
    };
  }),
  /**
   * Reservation set date reservation
   */
  on(ProviderUIActions.saveDateReservation, (state, action): IProviderState => {
    const dateReservation = action.dateReservation;
    return {
      ...state,
      dateReservation
    };
  }),
  /**
   * Reservation set hour initial reservation
   */
  on(ProviderUIActions.saveHourInitialReservation, (state, action): IProviderState => {
    const hourInitialReservation = action.hourInitialReservation;
    const finalReservation = DateTimeUtils.getHoursFromDate(DateTimeUtils.addTimeToDate(state.dateReservation + ' ' + hourInitialReservation.horaEntera, state.timeToReservation.id));
    const hourFinalReservation = {
      horaEntera: finalReservation,
      horaEnteraAMPM: finalReservation > '12:00' ? finalReservation + ' pm' : finalReservation + ' am',
    };
    return {
      ...state,
      hourInitialReservation,
      hourFinalReservation
    };
  }),
  /**
   * Reservation clear hour initial
   */
  on(ProviderUIActions.clearHourInitialReservation, (state): IProviderState => {
    const hourInitialReservation = {
      horaEntera: DateTimeUtils.getNextHourFromNow(1),
      horaEnteraAMPM: DateTimeUtils.getHoursFormatAMPM(DateTimeUtils.getCurrentDayWithoutHours() + ' ' +DateTimeUtils.getNextHourFromNow(1))
    };
    return {
      ...state,
      hourInitialReservation,
    };
  }),
  /**
   * Reservation set hour final reservation
   */
  on(ProviderUIActions.saveHourFinalReservation, (state, action): IProviderState => {
    const hourFinalReservation = action.hourFinalReservation;
    return {
      ...state,
      hourFinalReservation
    };
  }),
  /**
   * Reservation set time to reservation
   */
  on(ProviderUIActions.saveTimeToReservation, (state, action): IProviderState => {
    const timeToReservation = action.timeToReservation;
    const finalReservation = DateTimeUtils.getHoursFromDate(DateTimeUtils.addTimeToDate(state.dateReservation + ' ' + state.hourInitialReservation.horaEntera, timeToReservation.id));
    const hourFinalReservation = {
      horaEntera: finalReservation,
      horaEnteraAMPM: finalReservation > '12:00' ? finalReservation + ' pm' : finalReservation + ' am',
    };
    return {
      ...state,
      timeToReservation,
      hourFinalReservation
    };
  }),
  /**
   * Reservation set distance to reservation
   */
  on(ProviderUIActions.saveDistanceToReservation, (state, action): IProviderState => {
    const distanceToReservation = action.distanceToReservation;
    return {
      ...state,
      distanceToReservation
    };
  }),
  /**
   * Reservation set feature sportplatform to reservation
   */
  on(ProviderUIActions.saveFeatureSportplatformToReservation, (state, action): IProviderState => {
    const featureSportplatformToReservation = action.featureSportplatformToReservation;
    return {
      ...state,
      featureSportplatformToReservation
    };
  }),
  /**
   * Reservation set type sportplatform to reservation
   */
  on(ProviderUIActions.saveTypeSportplatformToReservation, (state, action): IProviderState => {
    const typeSportplatformToReservation = action.typeSportplatformToReservation;
    return {
      ...state,
      typeSportplatformToReservation
    };
  }),
  /**
   * Data from provider
   */
  on(ProviderUIActions.dataFromProviderLoading, (state): IProviderState => {
    return {
      ...state,
      loadingDataFromProvider: true,
    };
  }),
  on(ProviderUIActions.dataFromProviderLoaded, (state, action): IProviderState => {
    const dataFromProvider = action.data;
    return {
      ...state,
      dataFromProvider,
      loadingDataFromProvider: false,
    };
  }),
  on(ProviderUIActions.dataFromProviderWithError, (state): IProviderState => {
    return {
      ...state,
      loadingDataFromProvider: false,
    };
  }),
  /**
   * Save swtich to favorite provider
   */
  on(ProviderUIActions.switchFilterFavoriteProviders, (state, action): IProviderState => {
    const filterFavoriteProviders = !state.filterFavoriteProviders;
    return {
      ...state,
      filterFavoriteProviders
    };
  }),
  /**
   * Data from provider
   */
  on(ProviderUIActions.markProviderLikeFavoriteLoading, (state): IProviderState => {
    const dataFromProvider = {...state.dataFromProvider};
    let favoriteProviders = [...state.favoriteProviders];
    dataFromProvider.provider_isFavorite = !dataFromProvider.provider_isFavorite;
    if (dataFromProvider.provider_isFavorite == true) {
      favoriteProviders.push(dataFromProvider)
    } else {
      favoriteProviders = favoriteProviders.filter(favoriteProvider => favoriteProvider.provider_id != dataFromProvider.provider_id);
    }
    return {
      ...state,
      dataFromProvider,
      favoriteProviders,
      loadingMarkProviderLikeFavorite: true,
    };
  }),
  on(ProviderUIActions.markProviderLikeFavoriteLoaded, (state): IProviderState => {
    return {
      ...state,
      loadingMarkProviderLikeFavorite: false,
    };
  }),
  on(ProviderUIActions.markProviderLikeFavoriteWithError, (state): IProviderState => {
    return {
      ...state,
      loadingMarkProviderLikeFavorite: false,
    };
  }),
  /**
   * Cancel reservation sport plataform
   */
  on(ProviderUIActions.cancelReservationSportplatformLoading, (state): IProviderState => {
    return {
      ...state,
      loadingCancelReservationSportplatform: true,
    };
  }),
  on(ProviderUIActions.cancelReservationSportplatformLoaded, (state, action): IProviderState => {
    return {
      ...state,
      loadingCancelReservationSportplatform: false,
    };
  }),
  on(ProviderUIActions.cancelReservationSportplatformWithError, (state): IProviderState => {
    return {
      ...state,
      loadingCancelReservationSportplatform: false,
    };
  }),
  /**
   * Support agents
   */
  on(ProviderUIActions.supportAgentLoading, (state): IProviderState => {
    return {
      ...state,
      loadingsupportAgents: true,
    };
  }),
  on(ProviderUIActions.supportAgentLoaded, (state, action): IProviderState => {
    return {
      ...state,
      supportAgents: action.data,
      loadingsupportAgents: false,
    };
  }),
  on(ProviderUIActions.supportAgentWithError, (state): IProviderState => {
    return {
      ...state,
      loadingsupportAgents: false,
    };
  }),
);

export function provider(state: IProviderState | undefined, action: Action) {
  return reducer(state, action);
}
