import {Injectable} from '@angular/core';
import {Actions, createEffect, ofType} from "@ngrx/effects";
import {Store} from "@ngrx/store";
import {ISportState} from "./sport.state";
import {catchError, map, switchMap, tap} from "rxjs/operators";
import * as SportUIActions from './sport.ui.actions';
import {SportRemoteDatasource} from "@core/datasources/remote/SportRemoteDatasource";
import {of} from "rxjs";

@Injectable()
export class SportEffects {
  constructor(
    private actions$: Actions,
    private sportRemoteDatasource: SportRemoteDatasource,
    private store$: Store<ISportState>,
  ) {
  }

  loadSports$ = this.loadSports();

  private loadSports() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(SportUIActions.sportsLoad),
        tap(() => this.store$.dispatch(SportUIActions.sportsLoading())),
        switchMap(_ => this.sportRemoteDatasource.geAllSports().pipe(
          map(response => SportUIActions.sportsLoaded({data: response.data})),
          catchError(error => of(SportUIActions.sportsWithError({error})))
        ))
      )
    );
  }

}
