import {Observable} from "rxjs";
import {ICustomer} from "@core/interfaces/models/ICustomer";
import {IReservation} from "@core/interfaces/models/IReservation";
import {ISummaryReservation} from "@core/interfaces/models/ISummaryReservation";

export abstract class AuthenticationStateFacade {
  loginLoading$: Observable<boolean>;
  userSession$: Observable<string>;
  userNumber$: Observable<string>;
  userId$: Observable<string>;
  currentStore$: Observable<any>;
  currentCurrency$: Observable<any>;
  currentAddress$: Observable<string>;
  authToken$: Observable<string>;
  currentCoords$: Observable<any>;

  profileCustomer$: Observable<ICustomer>;
  profileCustomerLoading$: Observable<boolean>;

  updateProfileCustomerLoading$: Observable<boolean>;

  historyReservationCustomer$: Observable<IReservation[]>;
  historyReservationCustomerLoading$: Observable<boolean>;

  lastReservationsCustomer$: Observable<any>;
  lastReservationsCustomerLoading$: Observable<boolean>;

  summaryReservationCustomer$: Observable<ISummaryReservation>;
  summaryReservationCustomerLoading$: Observable<boolean>;

  searchingCurrentPosition$: Observable<boolean>;
  addressesFound$: Observable<any[]>;
  addressesFoundLoading$: Observable<boolean>;

  loadingPaymentOnline$: Observable<boolean>;

  reservationToPayOnline$: Observable<any>;

  loadingCoordsByPlace$: Observable<boolean>;

  public abstract login(criteria: string): void;

  public abstract loadLoginSubdomain(criteria: any): void;

  public abstract setSessionLocalstorageToStateApp(session: any): void;

  public abstract setCurrentCoords(currentCoords: any): void;

  public abstract getAddressByCoors(coords): void;

  public abstract loadSignOut(): void;

  public abstract loadProfileCustomer(): void;

  public abstract loadUpdateProfileCustomer(customer): void;

  public abstract loadHistoryReservationCustomer(criteria): void;

  public abstract loadlastReservationsCustomer(): void;

  public abstract loadSummaryReservationCustomer(criteria): void;

  public abstract searchingCurrentPosition(stateCurrentPosition): void;

  public abstract loadSearchAddress(address): void;

  public abstract loadCoordsByPlace(placeId): void;

  public abstract setSelectAddressManual(): void;

  public abstract saveReservationToPaymentOnline(reservation): void;

  public abstract clearReservationToPaymentOnline(): void;

  public abstract loadPaymentOnlineReservation(criteria): void;

}
