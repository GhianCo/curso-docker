import {ICustomer} from "@core/interfaces/models/ICustomer";
import {IReservation} from "@core/interfaces/models/IReservation";
import {ISummaryReservation} from "@core/interfaces/models/ISummaryReservation";

export interface IAuthenticationState {
  loadingLogin: boolean;
  authToken: string;
  providerAuth: string;
  userId: string;
  userNick: string;
  userName: string;
  userNumber: string;
  userLastName: string;
  countryId: string;
  currentStore: any;
  currentCurrency: any;
  currentAddress: string;
  currentCoords: any;

  profileCustomer: ICustomer;
  loadingProfileCustomer: boolean;

  loadingUpdateProfileCustomer: boolean;

  historyReservationCustomer: IReservation[];
  loadingHistoryReservationCustomer: boolean;

  lastReservationsCustomer: any[];
  loadinglastReservationsCustomer: boolean;

  summaryReservationCustomer: ISummaryReservation;
  loadingSummaryReservationCustomer: boolean;

  searchingCurrentPosition: boolean;
  addressesFound: any[];
  loadingAddressesFound: boolean;

  loadingCoordsByPlace: boolean;

  loadingPaymentOnline: boolean;


  reservationToPayOnline: any;
}

export const initialAuthenticationState: IAuthenticationState = {
  loadingLogin: false,
  authToken: '',
  providerAuth: '',
  userId: '',
  userNick: '',
  userName: '',
  userNumber: '',
  userLastName: '',
  countryId: '',
  currentStore: null,
  currentCurrency: null,
  currentAddress: 'Buscando tu ubicación...',
  currentCoords: null,
  profileCustomer: null,
  loadingProfileCustomer: false,

  loadingUpdateProfileCustomer: false,

  historyReservationCustomer: [],
  loadingHistoryReservationCustomer: false,

  lastReservationsCustomer: [],
  loadinglastReservationsCustomer: false,

  summaryReservationCustomer: null,
  loadingSummaryReservationCustomer: false,

  searchingCurrentPosition: false,
  addressesFound: [],
  loadingAddressesFound: false,

  loadingCoordsByPlace: false,

  loadingPaymentOnline: false,

  reservationToPayOnline: null
};
