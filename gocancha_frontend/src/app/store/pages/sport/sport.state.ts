import { SPORTS_APP } from "app/global/constants";
import {ISport} from "@core/interfaces/models/ISport";

export interface ISportState {
  sports: ISport[];
  loadingSports: boolean;
  countSports: number;
  totalSportsLoaded: number;
  pageLoadSports: number;
  currentSportSelected: ISport,
}

export const sportStateEmpty: ISport = {
  sport_id: SPORTS_APP.FUTBOL + '',
  sport_name: 'Fútbol',
  sport_image: '',
  sport_position: 1,
  sport_isactive: true
};

export const initialSportState: ISportState = {
  sports: [],
  loadingSports: false,
  countSports: 0,
  totalSportsLoaded: 1,
  pageLoadSports: 1,
  currentSportSelected: sportStateEmpty
};
