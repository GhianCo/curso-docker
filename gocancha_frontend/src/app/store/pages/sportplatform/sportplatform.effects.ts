import { Injectable } from '@angular/core';
import { Actions, createEffect, ofType } from "@ngrx/effects";
import { Store } from "@ngrx/store";
import { catchError, map, switchMap, tap } from "rxjs/operators";
import { of } from "rxjs";
import { SportplatformRemoteDatasource } from "@core/datasources/remote/SportplatformRemoteDatasource";
import { ISportplatformState } from "@store/pages/sportplatform/sportplatform.state";
import * as SportplatformUIActions from './sportplatform.ui.actions';
import { ModalController } from "@ionic/angular";
import { ToasterService } from "@shared/services/toaster.service";

@Injectable()
export class SportplatformEffects {
  constructor(
    private actions$: Actions,
    private sportplatformRemoteDatasource: SportplatformRemoteDatasource,
    private store$: Store<ISportplatformState>,
    private modalController: ModalController,
    private toasterService: ToasterService,
  ) {
  }

  loadSportplatformBySearh$ = this.loadSportplatformBySearh();
  loadFilters$ = this.loadFilters();
  loadByFilters$ = this.loadByFilters();
  loadDataFromSportplatform$ = this.loadDataFromSportplatform();

  private loadSportplatformBySearh() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(SportplatformUIActions.searchSportplatformLoad),
        tap(() => {
          this.store$.dispatch(SportplatformUIActions.searchSportplatformLoading());
        }
        ),
        switchMap(action => this.sportplatformRemoteDatasource.search(action.criteria).pipe(
          map(response => SportplatformUIActions.searchSportplatformLoaded({ data: response.data })),
          catchError(error => of(SportplatformUIActions.searchSportplatformWithError({ error })))
        ))
      )
    );
  }

  private loadFilters() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(SportplatformUIActions.filtersSportplatformLoad),
        tap(() => {
          this.store$.dispatch(SportplatformUIActions.filtersSportplatformLoading());
        }
        ),
        switchMap(_ => this.sportplatformRemoteDatasource.getFilters().pipe(
          map(response => SportplatformUIActions.filtersSportplatformLoaded({ data: response.data })),
          catchError(error => of(SportplatformUIActions.filtersSportplatformWithError({ error })))
        ))
      )
    );
  }

  private loadByFilters() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(SportplatformUIActions.sportplatformByFiltersLoad),
        tap(() => this.store$.dispatch(SportplatformUIActions.sportplatformByFiltersLoading())),
        switchMap(action => this.sportplatformRemoteDatasource.getByFilters(action.criteria).pipe(
          map(response => SportplatformUIActions.sportplatformByFiltersLoaded({ data: response })),
          catchError(error => of(SportplatformUIActions.sportplatformByFiltersWithError({ error })))
        ))
      )
    );
  }

  private loadDataFromSportplatform() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(SportplatformUIActions.dataFromSportplatformLoad),
        tap(() => {
          this.store$.dispatch(SportplatformUIActions.dataFromSportplatformLoading());
        }
        ),
        switchMap(action => this.sportplatformRemoteDatasource.dataFromSportplatform(action.sportplatformId).pipe(
          map(response => SportplatformUIActions.dataFromSportplatformLoaded({ data: response.data })),
          catchError(error => of(SportplatformUIActions.dataFromSportplatformWithError({ error })))
        ))
      )
    );
  }
}
