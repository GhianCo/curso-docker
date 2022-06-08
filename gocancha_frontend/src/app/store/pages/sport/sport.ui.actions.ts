import {createAction, props} from '@ngrx/store';

/**
 * Sport load data
 */

export const sportsLoad = createAction(
  '[Store Sport] Sport => Load'
);

export const sportsLoading = createAction(
  '[Store Sport] Sport => Loading',
);

export const sportsLoaded = createAction(
  '[Store Sport] Sport => Loaded',
  props<{ data: any }>()
);

export const sportsWithError = createAction(
  '[Store Sport] Sport => Error',
  props<{ error: string }>()
);

export const selectCurrentSport = createAction(
  '[Store Sport] Sport => Select sport name',
  props<{ sportNameSelected: string }>()
);
