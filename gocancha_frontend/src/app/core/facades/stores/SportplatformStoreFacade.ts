import {Observable} from "rxjs";
import {ISportplatform} from "@core/interfaces/models/ISportplatform";

export abstract class SportplatformStateFacade {
  allSportplatform$: Observable<ISportplatform[]>;
  sportplatformsLoading$: Observable<boolean>;
  currentSportplatformSelected$: Observable<ISportplatform>;

  allFiltersSportplatform$: Observable<any>;
  filtersSportplatformLoading$: Observable<boolean>;

  allSportplatformByFilter$: Observable<any[]>;
  allSportplatformFiltersApply$: Observable<any>;
  sportplatformByFilterLoading$: Observable<boolean>;

  sportplatformAvalibles$: Observable<number>;

  paymentAmountSportplatform$: Observable<any>;
  paymentAmountSportplatformLoading$: Observable<boolean>;

  dataCurrentSportplatform$: Observable<any>;
  dataCurrentSportplatformLoading$: Observable<boolean>;

  sizeToReservation$: Observable<any>;

  loadingBlockSportplatform$: Observable<boolean>;

  public abstract loadSportplatformBySearch(criteria): void;

  public abstract setCurrentSportplatformSelected(currentStory: ISportplatform): void;

  public abstract selectFiltersApplyToSportplatform(filter, filterSelected: any): void;

  public abstract loadFiltersSportplatform(): void;

  public abstract loadSportplatformByFilter(criteria): void;

  public abstract loadPaymentAmountSportplatform(criteria): void;

  public abstract loadDataCurrentSportplatform(sportplatformId): void;

}
