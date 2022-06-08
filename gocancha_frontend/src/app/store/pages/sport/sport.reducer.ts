import {Action, createReducer, on} from '@ngrx/store';
import * as SportUIActions from './sport.ui.actions';
import {ISportState, initialSportState} from "./sport.state";

const reducer = createReducer(
  initialSportState,
  /**
   * Load data sports
   */
  on(SportUIActions.sportsLoading, (state): ISportState => {
    return {
      ...state,
      loadingSports: true,
    };
  }),
  on(SportUIActions.sportsLoaded, (state, action): ISportState => {
    const sports = action.data;
    let currentSportSelected = null;
    if (sports.length) {
      currentSportSelected = sports[0];
    }
    return {
      ...state,
      sports,
      currentSportSelected,
      loadingSports: false,
    };
  }),
  on(SportUIActions.sportsWithError, (state): ISportState => {
    return {
      ...state,
      loadingSports: false,
    };
  }),
  on(SportUIActions.selectCurrentSport, (state, action): ISportState => {
    const currentSportSelected = state.sports.find(sport => sport.sport_name == action.sportNameSelected);
    return {
      ...state,
      currentSportSelected
    };
  }),
);

export function sport(state: ISportState | undefined, action: Action) {
  return reducer(state, action);
}
