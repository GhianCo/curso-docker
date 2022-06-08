import {createAction, props} from '@ngrx/store';

/**
 * Sport platform load data
 */

export const searchSportplatformLoad = createAction(
  '[Store Sport platform] Sport platform => Load',
  props<{ criteria: any }>()
);

export const searchSportplatformLoading = createAction(
  '[Store Sport platform] Sport platform => Loading',
);

export const searchSportplatformLoaded = createAction(
  '[Store Sport platform] Sport platform => Loaded',
  props<{ data: any }>()
);

export const searchSportplatformWithError = createAction(
  '[Store Sport platform] Sport platform => Error',
  props<{ error: string }>()
);

export const selectFiltersApplyToSportplatform = createAction(
  '[Store Sport platform] Select type filter to sport platforms',
  props<{ filter, filterSelected: any }>()
);

/**
 * Filters Sport platform load data
 */

export const filtersSportplatformLoad = createAction(
  '[Store Sport platform filters] Sport platform filters => Load'
);

export const filtersSportplatformLoading = createAction(
  '[Store Sport platform filters] Sport platform filters => Loading',
);

export const filtersSportplatformLoaded = createAction(
  '[Store Sport platform filters] Sport platform filters => Loaded',
  props<{ data: any }>()
);

export const filtersSportplatformWithError = createAction(
  '[Store Sport platform filters] Sport platform filters => Error',
  props<{ error: string }>()
);

/**
 * platform by filters load data
 */

export const sportplatformByFiltersLoad = createAction(
  '[Store Sport platform by filters] Sport platform by filters => Load',
  props<{ criteria: any }>()
);

export const sportplatformByFiltersLoading = createAction(
  '[Store Sport platform by filters] Sport platform by filters => Loading',
);

export const sportplatformByFiltersLoaded = createAction(
  '[Store Sport platform by filters] Sport platform by filters => Loaded',
  props<{ data: any }>()
);

export const sportplatformByFiltersWithError = createAction(
  '[Store Sport platform by filters] Sport platform by filters => Error',
  props<{ error: string }>()
);

export const clearsportplatformByFilters = createAction(
  '[Store Sport platform by filters] Clear sportplatform list => Clear',
);


/**
 * Payment amount by sport platform
 */

export const paymentAmountSportplatformLoad = createAction(
  '[Store Payment Amount Sport Platform] Payment Amount Sport Platform => Load',
  props<{ criteria: any }>()
);

export const paymentAmountSportplatformLoading = createAction(
  '[Store Payment Amount Sport Platform] Payment Amount Sport Platform => Loading',
);

export const paymentAmountSportplatformLoaded = createAction(
  '[Store Payment Amount Sport Platform] Payment Amount Sport Platform => Loaded',
  props<{ data: any }>()
);

export const paymentAmountSportplatformWithError = createAction(
  '[Store Payment Amount Sport Platform] Payment Amount Sport Platform => Error',
  props<{ error: string }>()
);

/**
 * Data from sportplatform
 */

export const dataFromSportplatformLoad = createAction(
  '[Store Sport platform] Data from Sport platform => Load',
  props<{ sportplatformId: any }>()
);

export const dataFromSportplatformLoading = createAction(
  '[Store Sport platform] Data from Sport platform => Loading',
);

export const dataFromSportplatformLoaded = createAction(
  '[Store Sport platform] Data from Sport platform => Loaded',
  props<{ data: any }>()
);

export const dataFromSportplatformWithError = createAction(
  '[Store Sport platform] Data from Sport platform => Error',
  props<{ error: string }>()
);
