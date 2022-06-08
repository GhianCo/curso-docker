import { Injectable } from '@angular/core';
import { Store } from '@ngrx/store';
import * as SportplatformUIActions from '@store/pages/sportplatform/sportplatform.ui.actions';
import { ISportState } from "@store/pages/sport/sport.state";
import {
  currentSportplatformSelected, dataCurrentSportplatformLoading,
  filtersSportsplatformLoading,
  getDataCurrentSportplatform,
  getFiltersSportsplatform, getLoadingBlockSportplatform, getPaginationSportplatformsByFilter, getSizeToReservation, getSportplatformAvalibles,
  getSportplatformsByFilter, getSportplatformsFiltersApply,
  getSportsplatformSearch,
  paymentAmountSportplatform,
  paymentAmountSportplatformLoading,
  sportplatformsByFilterLoading,
  sportsplatformSearchLoading
} from "@store/pages/sportplatform/sportplatform.selector";
import { SportplatformStateFacade } from "@core/facades/stores/SportplatformStoreFacade";
import { getCurrentCoords } from '@store/pages/auth/auth.selector';
import { filter, take, tap } from 'rxjs/operators';
import { PARAM, SPORTS_APP } from 'app/global/constants';
import { currentSportSelected } from '@store/pages/sport/sport.selector';

@Injectable({
  providedIn: 'root'
})

export class SportplatformStateNgrx implements SportplatformStateFacade {
  allSportplatform$ = this.store$.select(getSportsplatformSearch);
  sportplatformsLoading$ = this.store$.select(sportsplatformSearchLoading);
  currentSportplatformSelected$ = this.store$.select(currentSportplatformSelected);

  allFiltersSportplatform$ = this.store$.select(getFiltersSportsplatform);
  filtersSportplatformLoading$ = this.store$.select(filtersSportsplatformLoading);

  sportplatformAvalibles$ = this.store$.select(getSportplatformAvalibles);

  allSportplatformByFilter$ = this.store$.select(getSportplatformsByFilter);
  allSportplatformFiltersApply$ = this.store$.select(getSportplatformsFiltersApply);
  sportplatformByFilterLoading$ = this.store$.select(sportplatformsByFilterLoading);

  paymentAmountSportplatform$ = this.store$.select(paymentAmountSportplatform);
  paymentAmountSportplatformLoading$ = this.store$.select(paymentAmountSportplatformLoading);

  dataCurrentSportplatform$ = this.store$.select(getDataCurrentSportplatform);
  dataCurrentSportplatformLoading$ = this.store$.select(dataCurrentSportplatformLoading);

  sizeToReservation$ = this.store$.select(getSizeToReservation);

  loadingBlockSportplatform$ = this.store$.select(getLoadingBlockSportplatform);

  constructor(
    private store$: Store<ISportState>,
  ) {
  }

  public loadSportplatformBySearch(criteria) {
    this.store$.dispatch(SportplatformUIActions.searchSportplatformLoad({ criteria }));
  }

  public setCurrentSportplatformSelected(store: any) {
  }

  public selectFiltersApplyToSportplatform(filter, filterSelected: any) {
    this.store$.dispatch(SportplatformUIActions.selectFiltersApplyToSportplatform({ filter, filterSelected }));
  }

  public loadFiltersSportplatform() {
    this.store$.dispatch(SportplatformUIActions.filtersSportplatformLoad());
  }

  public loadSportplatformByFilter({ ...criteria }) {
    const paginationSportplatformByFilters = this.getPaginationSportplatformByFilters;
    if (criteria.latitud == PARAM.TODOS && criteria.longitud == PARAM.TODOS) {
      const coords = this.getCurrentCoords;
      if (!coords) {
        return false;
      }
      criteria.latitud = coords.latitude;
      criteria.longitud = coords.longitude;
    }
    criteria.page = paginationSportplatformByFilters.page;
    if (criteria.resetPage) {
      criteria.page = 1;
      this.store$.dispatch(SportplatformUIActions.clearsportplatformByFilters());
    } else {
      if (paginationSportplatformByFilters.total == paginationSportplatformByFilters.count && paginationSportplatformByFilters.page > 1) {
        return false;
      }
    }
    if (!criteria.deporte_id) {
      criteria.deporte_id = this.getCurrentSportId;
    }
    this.store$.dispatch(SportplatformUIActions.sportplatformByFiltersLoad({ criteria }));
  }

  public loadPaymentAmountSportplatform(criteria) {
    this.store$.dispatch(SportplatformUIActions.paymentAmountSportplatformLoad({ criteria }));
  }

  public loadDataCurrentSportplatform(sportplatformId) {
    this.store$.dispatch(SportplatformUIActions.dataFromSportplatformLoad({ sportplatformId }));
  }

  private get getCurrentCoords() {
    let coords = null;
    const currentProviderSub = this.store$.select(getCurrentCoords).pipe(
      take(1),
      filter(currentProvider => currentProvider),
      tap(currentProvider => {
        coords = {
          latitude: currentProvider.latitude,
          longitude: currentProvider.longitude
        }
      })
    ).subscribe();
    currentProviderSub.unsubscribe();
    return coords;
  }

  private get getCurrentSportId() {
    let currentSportId: any = SPORTS_APP.FUTBOL;
    const currentProviderSub = this.store$.select(currentSportSelected).pipe(
      take(1),
      filter(currentSport => currentSport != null),
      tap(currentSport => {
        currentSportId = currentSport.sport_id;
      })
    ).subscribe();
    currentProviderSub.unsubscribe();
    return currentSportId;
  }

  private get getPaginationSportplatformByFilters() {
    let paginationSportplatformsByFilter = {
      count: 0,
      total: 0,
      page: 1,
    };
    const paginationSportplatformsByFilterSub = this.store$.select(getPaginationSportplatformsByFilter).pipe(
      take(1),
      tap(pagination => paginationSportplatformsByFilter = pagination)
    ).subscribe();
    paginationSportplatformsByFilterSub.unsubscribe();
    return paginationSportplatformsByFilter;
  }
}
