import {IProvider} from "@core/interfaces/models/IProvider";
import { DateTimeUtils } from "@shared/utils/datetimeUtils";

export interface IProviderState {
  favoriteProviders: IProvider[];
  loadingFavoriteProviders: boolean;

  providersNearby: IProvider[];
  loadingProvidersNearby: boolean;

  currentProviderSelected: IProvider,

  bankAccounts: any[];
  loadingBankAccounts: boolean;

  voucherTranferPaymentProvider: string;
  loadingVoucherTranferPaymentProvider: boolean;

  loadingReservationSportplatform: boolean;

  loadingCancelReservationSportplatform: boolean;

  dateReservation: string;

  hourInitialReservation: any;

  hourFinalReservation: any;

  timeToReservation: any;

  distanceToReservation: any;

  featureSportplatformToReservation: any;
  typeSportplatformToReservation: any;

  dataFromProvider: any;
  loadingDataFromProvider: boolean;

  filterFavoriteProviders: boolean;

  loadingMarkProviderLikeFavorite: boolean;

  supportAgents: any[];
  loadingsupportAgents: boolean;

}

export const providerStateEmpty: IProvider = {
  provider_id: null,
  provider_name: '',
  provider_image: '',
  provider_rating: 0,
  provider_distance: null,
  provider_isActive: true,
  provider_isFavorite: false
};

export const initialProviderState: IProviderState = {
  favoriteProviders: [],
  loadingFavoriteProviders: false,

  providersNearby: [],
  loadingProvidersNearby: false,

  currentProviderSelected: providerStateEmpty,

  bankAccounts: [],
  loadingBankAccounts: false,

  voucherTranferPaymentProvider: null,
  loadingVoucherTranferPaymentProvider: false,

  loadingReservationSportplatform: false,

  loadingCancelReservationSportplatform: false,

  dateReservation: null,

  hourInitialReservation: {
    horaEntera: DateTimeUtils.getNextHourFromNow(1),
    horaEnteraAMPM: DateTimeUtils.getHoursFormatAMPM(DateTimeUtils.getCurrentDayWithoutHours() + ' ' +DateTimeUtils.getNextHourFromNow(1))
  },

  hourFinalReservation: {
    horaEntera: null,
    horaEnteraAMPM: null
  },

  timeToReservation: {
    id: 60,
    description: '1 hora'
  },

  distanceToReservation: {
    id: 5,
    description: '5 Km'
  },

  featureSportplatformToReservation: null,
  typeSportplatformToReservation: null,

  dataFromProvider: null,
  loadingDataFromProvider: false,

  filterFavoriteProviders: false,

  loadingMarkProviderLikeFavorite: false,

  supportAgents: [],
  loadingsupportAgents: false

};
