import {createFeatureSelector, createSelector} from '@ngrx/store';
import {ISportplatformState} from './sportplatform.state';

export const sportplatformState = createFeatureSelector<ISportplatformState>('sportplatform');

/**
 * Data sport
 */

export const getSportsplatformSearch = createSelector(
  sportplatformState,
  state => state.sportplatformSearch
);

export const sportsplatformSearchLoading = createSelector(
  sportplatformState,
  state => state.loadingSportplatformSearch
);

export const currentSportplatformSelected = createSelector(
  sportplatformState,
  state => state.currentSportplatformSelected
);

export const getFiltersSportsplatform = createSelector(
  sportplatformState,
  state => state.filtersSportplatform
);

export const getSportplatformAvalibles = createSelector(
  sportplatformState,
  state => state.sportplatformAvalibles
);

export const filtersSportsplatformLoading = createSelector(
  sportplatformState,
  state => state.loadingFiltersSportplatform
);

export const getSportplatformsByFilter = createSelector(
  sportplatformState,
  state => state.sportplatformsByFilter
);

export const getPaginationSportplatformsByFilter = createSelector(
  sportplatformState,
  state => state.paginationSportplatformsByFilter
);

export const getSportplatformsFiltersApply = createSelector(
  sportplatformState,
  state => state.sportplatformsFiltersApply
);

export const sportplatformsByFilterLoading = createSelector(
  sportplatformState,
  state => state.loadingSportplatformsByFilter
);

export const paymentAmountSportplatform = createSelector(
  sportplatformState,
  state => state.paymentAmountSportplatform
);

export const paymentAmountSportplatformLoading = createSelector(
  sportplatformState,
  state => state.loadingPaymentAmountSportplatform
);

export const getDataCurrentSportplatform = createSelector(
  sportplatformState,
  state => state.dataCurrentSportplatform
);

export const dataCurrentSportplatformLoading = createSelector(
  sportplatformState,
  state => state.loadingDataCurrentSportplatform
);

export const getSizeToReservation = createSelector(
  sportplatformState,
  getFiltersSportsplatform,
  (state, filtersSportplatform) => {
    return filtersSportplatform.sizeList.find(size => size.selected);
  }
);

export const getLoadingBlockSportplatform = createSelector(
  sportplatformState,
  state => state.loadingBlockSportplatform
);
