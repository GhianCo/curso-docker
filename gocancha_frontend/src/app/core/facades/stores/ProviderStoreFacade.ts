import {Observable} from "rxjs";
import {IProvider} from "@core/interfaces/models/IProvider";

export abstract class ProviderStateFacade {
  favoriteProviders$: Observable<IProvider[]>;
  favoriteProvidersLoading$: Observable<boolean>;

  providersNearby$: Observable<IProvider[]>;
  providersNearbyLoading$: Observable<boolean>;

  currentProviderSelected$: Observable<IProvider>;

  bankAccounts$: Observable<any[]>;
  bankAccountsLoading$: Observable<boolean>;

  voucherTranferPaymentProvider$: Observable<string>;
  voucherTranferPaymentProviderLoading$: Observable<boolean>;

  reservationSportplatformLoading$: Observable<boolean>;

  cancelReservationSportplatformLoading$: Observable<boolean>;

  dateReservation$: Observable<string>;

  dateReservationFormated$: Observable<string>;

  hourInitialReservation$: Observable<any>;

  hourFinalReservation$: Observable<any>;

  timeToReservation$: Observable<any>;

  distanceToReservation$: Observable<any>;
  featureSportplatformToReservation$: Observable<any>;
  typeSportplatformToReservation$: Observable<any>;

  dataFromProvider$: Observable<any>;
  dataFromProviderLoading$: Observable<boolean>;

  filterFavoriteProviders$: Observable<boolean>;

  supportAgents$: Observable<any[]>;
  supportAgentsLoading$: Observable<boolean>;

  public abstract loadFavoriteProviders(sportId?): void;

  public abstract loadProvidersNearby(coords?: any): void;

  public abstract setCurrentProviderSelected(currentStory: IProvider): void;

  public abstract loadBankAccounts(): void;

  public abstract loadUploadVoucherTranferPaymentProvider();

  public abstract loadReservationSportplataform(reservation);

  public abstract loadCancelReservationSportplataform(reservation);

  public abstract setDateReservation(dateReservation: string);

  public abstract setHourInitialReservation(hourInitialReservation: any);

  public abstract clearHourInitialReservation();

  public abstract setHourFinalReservation(hourFinalReservation: any);

  public abstract setTimeToReservation(timeToReservation: any);

  public abstract setDistanceToReservation(distanceToReservation: any);

  public abstract setFeatureSportplatformToReservation(featureSportplatformToReservation: any);

  public abstract setTypeSportplatformToReservation(typeSportplatformToReservation: any);

  public abstract loadDataFromProvider(providerId: any): void;

  public abstract switchFilterFavoriteProviders(): void;

  public abstract changeStateFavoriteProvider(providerId: any): void;

  public abstract loadSupportAgents(): void;

  public abstract clearVoucherTranferPaymentProvider(): void;

}
