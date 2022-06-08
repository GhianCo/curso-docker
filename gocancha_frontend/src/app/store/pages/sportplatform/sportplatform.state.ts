import {ISportplatform} from "@core/interfaces/models/ISportplatform";
import {PARAM} from "app/global/constants";
import {DateTimeUtils} from "@shared/utils/datetimeUtils";

export interface ISportplatformState {
  sportplatformSearch: ISportplatform[];
  loadingSportplatformSearch: boolean;
  currentSportplatformSelected: ISportplatform,

  filtersSportplatform: any;
  loadingFiltersSportplatform: boolean;

  sportplatformAvalibles: number;

  sportplatformsByFilter: any[];
  paginationSportplatformsByFilter: any;

  sportplatformsFiltersApply: any;
  loadingSportplatformsByFilter: boolean;

  paymentAmountSportplatform: any;
  loadingPaymentAmountSportplatform: boolean;

  dataCurrentSportplatform: any;
  loadingDataCurrentSportplatform: boolean;

  loadingBlockSportplatform: boolean;
}

export const initialSportplatformState: ISportplatformState = {
  sportplatformSearch: [],
  loadingSportplatformSearch: false,
  currentSportplatformSelected: null,

  filtersSportplatform: {
    tipoList: [],
    caracteristicaList: [],
    sizeList: [],
  },
  loadingFiltersSportplatform: false,

  sportplatformsByFilter: [],
  paginationSportplatformsByFilter: {
    count: 0,
    total: 0,
    page: 1,
  },
  sportplatformsFiltersApply: {
    deporte_id: "",
    distancia: 5,
    favorito: PARAM.NO,
    fecha: DateTimeUtils.getCurrentDayWithoutHours(),
    dateFormated:  DateTimeUtils.getFormatDateViewWithoutHour(DateTimeUtils.getCurrentDayWithoutHours()),
    horafin: null,
    horaEndFormated: null,
    horainicio: null,
    horaInitialFormated: null,
    latitud: "",
    longitud: "",
    page: 1,
    register: 50,
    size_id: PARAM.TODOS,
    caracteristica_id: PARAM.TODOS,
    tipo_id: PARAM.TODOS
  },
  loadingSportplatformsByFilter: false,

  sportplatformAvalibles: 0,

  paymentAmountSportplatform: null,
  loadingPaymentAmountSportplatform: false,

  dataCurrentSportplatform: null,
  loadingDataCurrentSportplatform: false,

  loadingBlockSportplatform: false,
};
