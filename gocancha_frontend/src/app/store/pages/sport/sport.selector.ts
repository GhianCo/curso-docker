import {createFeatureSelector, createSelector} from '@ngrx/store';
import {ISportState} from './sport.state';

export const sportState = createFeatureSelector<ISportState>('sport');

/**
 * Data sport
 */

export const getSports = createSelector(
  sportState,
  state => state.sports
);

export const sportsLoading = createSelector(
  sportState,
  state => state.loadingSports
);

export const currentSportSelected = createSelector(
  sportState,
  state => state.currentSportSelected
);
