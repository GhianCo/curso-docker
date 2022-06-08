// PARAM
export const PARAM = {
  ACTIVO: '1',
  INACTIVO: '0',
  SI: '1',
  NO: '0',
  TODOS: '-1',
  VACIO: ''
};

// HTTP RESPONSE
export const HTTP_RESPONSE = {
  SUCCESS: '1',
  WARNING: '2',
  ERROR: '3',
  INFO: '4',
  HTTP_200_OK: '200',
  PERMISION_ERROR: '401',
  CODE_NOT_DEFINED: '601',
  MALFORMED_JSON: '701',
  ACCESS_DENIED: '403'
};

export enum PAIS {
  PERU = '1',
}

export enum URI {
  LOGIN_CENTRAL = 'https://login.quipupos.com/login/m/rest/login/login',
}

export enum PETICION {
  SIN_INICIALIZAR = '1',
  EN_PROCESO = '2',
  FINALIZADA = '3'
}

export enum ACTION_CRUD {
  CREATE = '1',
  READ = '2',
  UPDATE = '3',
  DELETE = '4',
}

export enum NOTIFICACION_RESERVATION {
  RESERVATION_ACCEPTED,
  RESERVATION_REJECTED,
}

export enum ORDER_ARRAY {
  ASC = 0,
  DESC = 1,
}

export enum PERIODICITY_OFFER {
  NO_PERIODIC = '1',
  PERIODIC = '2',
}

export enum CHAT_WITH {
  CUSTOMER = '1',
  DRIVER = '2',
  SUPPORT = '3',
}

export enum TypeFileToUpload {
  Image = "1",
  Video = "2"
}

export enum TypeLoginApp {
  Remote = "1",
  Facebook = "2",
  Google = "3",
  Apple = "4"
}

export enum FylterSportplatform {
  Type,
  Feature,
  Size
}

export enum TYPE_PAYMENT_RESERVATION {
  ATTACH_IMAGE = 1,
  ON_LINE = 2
}

export enum SPORTS_APP {
  NONE,
  FUTBOL
}
