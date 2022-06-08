import { Action, createReducer, on } from '@ngrx/store';
import * as SportplatformUIActions from './sportplatform.ui.actions';
import { ISportplatformState, initialSportplatformState } from "./sportplatform.state";
import { FylterSportplatform, PARAM } from "app/global/constants";

const reducer = createReducer(
  initialSportplatformState,
  /**
   * Load data sports
   */
  on(SportplatformUIActions.searchSportplatformLoading, (state): ISportplatformState => {
    return {
      ...state,
      loadingSportplatformSearch: true,
    };
  }),
  on(SportplatformUIActions.searchSportplatformLoaded, (state, action): ISportplatformState => {
    const sportplatformSearch = action.data;
    return {
      ...state,
      sportplatformSearch,
      loadingSportplatformSearch: false,
    };
  }),
  on(SportplatformUIActions.searchSportplatformWithError, (state): ISportplatformState => {
    return {
      ...state,
      loadingSportplatformSearch: false,
    };
  }),
  /**
   * Load filters sportplatform
   */
  on(SportplatformUIActions.filtersSportplatformLoading, (state): ISportplatformState => {
    return {
      ...state,
      loadingFiltersSportplatform: true,
    };
  }),
  on(SportplatformUIActions.filtersSportplatformLoaded, (state, action): ISportplatformState => {
    const filtersSportplatform = action.data;
    return {
      ...state,
      filtersSportplatform,
      loadingFiltersSportplatform: false,
    };
  }),
  on(SportplatformUIActions.selectFiltersApplyToSportplatform, (state, action): ISportplatformState => {
    const filtersSportplatform = { ...state.filtersSportplatform };
    const filter = action.filter;
    const filterSelected = action.filterSelected;
    if (filter == FylterSportplatform.Type) {
      const tipoList = [...filtersSportplatform.tipoList];
      const types = tipoList.map(type => ({
        ...type,
        selected: false
      }));
      const updatedIndex = types.findIndex((type) => type.tipo_id == filterSelected.tipo_id);
      const updatedType = {
        ...types[updatedIndex]
      };
      updatedType.selected = !updatedType.selected;
      types[updatedIndex] = updatedType;
      filtersSportplatform.tipoList = types;
    } else if (filter == FylterSportplatform.Feature) {
      const caracteristicaList = [...filtersSportplatform.caracteristicaList];
      const features = caracteristicaList.map(feature => ({
        ...feature,
        selected: false
      }));
      const updatedIndex = features.findIndex((feature) => feature.caracteristica_id == filterSelected.caracteristica_id);
      const updatedFeature = {
        ...features[updatedIndex]
      };
      updatedFeature.selected = !updatedFeature.selected;
      features[updatedIndex] = updatedFeature;
      filtersSportplatform.caracteristicaList = features;
    } else {
      const sizeList = [...filtersSportplatform.sizeList];
      const sizes = sizeList.map(feature => ({
        ...feature,
        selected: false
      }));
      const updatedIndex = sizes.findIndex((size) => size.size_id == filterSelected.size_id);
      const updatedSize = {
        ...sizes[updatedIndex]
      };
      updatedSize.selected = !updatedSize.selected;
      sizes[updatedIndex] = updatedSize;
      filtersSportplatform.sizeList = sizes;
    }
    return {
      ...state,
      filtersSportplatform
    };
  }),
  /**
   * Load sportplatform by filters
   */
  on(SportplatformUIActions.sportplatformByFiltersLoading, (state): ISportplatformState => {
    return {
      ...state,
      loadingSportplatformsByFilter: true,
    };
  }),
  on(SportplatformUIActions.sportplatformByFiltersLoaded, (state, action): ISportplatformState => {
    let page = state.paginationSportplatformsByFilter.page;
    const data = action.data;
    const sportplatforms = data.data;
    if (sportplatforms.length) {
      page++;
    }
    const paginationSportplatformsByFilter = {
      page,
      count: data.totalregistros,
      total: state.sportplatformsByFilter.length + sportplatforms.length
    }

    const sportplatformsByFilter = [...state.sportplatformsByFilter];
    sportplatforms.forEach(sportplatform => {
      sportplatformsByFilter.push(sportplatform)
    });
    const sportplatformAvalibles = sportplatformsByFilter.filter(sportplatform => sportplatform.sportplatform_avalible == PARAM.SI).length;
    return {
      ...state,
      sportplatformsByFilter,
      sportplatformAvalibles,
      loadingSportplatformsByFilter: false,
      paginationSportplatformsByFilter
    };
  }),
  on(SportplatformUIActions.clearsportplatformByFilters, (state): ISportplatformState => {
    let paginationSportplatformsByFilter = { ...state.paginationSportplatformsByFilter };
    paginationSportplatformsByFilter.count = 0;
    paginationSportplatformsByFilter.total = 0;
    paginationSportplatformsByFilter.page = 1;
    return {
      ...state,
      paginationSportplatformsByFilter,
      sportplatformsByFilter: [],
    };
  }),
  /**
   * Load payment amount sport platform
   */
  on(SportplatformUIActions.paymentAmountSportplatformLoading, (state): ISportplatformState => {
    return {
      ...state,
      loadingPaymentAmountSportplatform: true,
    };
  }),
  on(SportplatformUIActions.paymentAmountSportplatformLoaded, (state, action): ISportplatformState => {
    const paymentAmountSportplatform = action.data;
    return {
      ...state,
      paymentAmountSportplatform,
      loadingPaymentAmountSportplatform: false,
    };
  }),
  on(SportplatformUIActions.paymentAmountSportplatformWithError, (state): ISportplatformState => {
    return {
      ...state,
      loadingPaymentAmountSportplatform: false,
    };
  }),
  /**
   * Load data current sport platform
   */
  on(SportplatformUIActions.dataFromSportplatformLoading, (state): ISportplatformState => {
    return {
      ...state,
      loadingPaymentAmountSportplatform: true,
    };
  }),
  on(SportplatformUIActions.dataFromSportplatformLoaded, (state, action): ISportplatformState => {
    const dataCurrentSportplatform = action.data;
    return {
      ...state,
      dataCurrentSportplatform,
      loadingDataCurrentSportplatform: false,
    };
  }),
  on(SportplatformUIActions.dataFromSportplatformWithError, (state): ISportplatformState => {
    return {
      ...state,
      loadingPaymentAmountSportplatform: false,
    };
  }),
);

export function sportplatform(state: ISportplatformState | undefined, action: Action) {
  return reducer(state, action);
}
