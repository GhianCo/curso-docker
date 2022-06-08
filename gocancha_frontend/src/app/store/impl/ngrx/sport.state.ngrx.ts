import {Injectable} from '@angular/core';
import {Store} from '@ngrx/store';
import * as SportUIActions from '@store/pages/sport/sport.ui.actions';
import {ISportState} from "@store/pages/sport/sport.state";
import {currentSportSelected, getSports, sportsLoading} from "@store/pages/sport/sport.selector";
import {SportStateFacade} from "@core/facades/stores/SportStoreFacade";

@Injectable({
  providedIn: 'root'
})

export class SportStateNgrx implements SportStateFacade {
  allSports$ = this.store$.select(getSports);
  sportsLoading$ = this.store$.select(sportsLoading);
  currentSportSelected$ = this.store$.select(currentSportSelected);

  constructor(
    private store$: Store<ISportState>,
  ) {
  }

  public loadSports() {
    this.store$.dispatch(SportUIActions.sportsLoad());
  }

  public setCurrentSportNameSelected(sportNameSelected: string) {
    this.store$.dispatch(SportUIActions.selectCurrentSport({sportNameSelected}));
  }
}
