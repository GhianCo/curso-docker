import {Observable} from "rxjs";
import {ISport} from "@core/interfaces/models/ISport";

export abstract class SportStateFacade {
  allSports$: Observable<ISport[]>;
  sportsLoading$: Observable<boolean>;
  currentSportSelected$: Observable<ISport>;

  public abstract loadSports(): void;

  public abstract setCurrentSportNameSelected(sportName: string): void;

}
