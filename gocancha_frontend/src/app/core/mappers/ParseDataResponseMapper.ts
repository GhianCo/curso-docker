import { MainMapper } from './MainMapper';
import { HTTP_RESPONSE } from 'app/global/constants';
import { IResponse } from '@core/interfaces/models/IResponse';

export class ParseDataResponseMapper extends MainMapper<any, IResponse> {
  protected map(responseBackend: any): IResponse {
    let dataObj: IResponse = { tipo: HTTP_RESPONSE.MALFORMED_JSON, mensajes: ['JSON mal formado', responseBackend], data: null };
    if (responseBackend !== null && typeof responseBackend === 'object') {
      if (responseBackend.data !== null && typeof responseBackend.data === 'object') {
        dataObj = responseBackend;
      } else {
        /**
         * Si la respuesta es pura sin tipo ni mensajes seteo data a la respuesta
         */
        if (responseBackend.data && responseBackend.tipo && responseBackend.mensajes) {
          dataObj = responseBackend;
        } else if (!responseBackend.data && responseBackend.tipo && (responseBackend.mensajes || responseBackend.mensaje)) {
          dataObj = responseBackend;
        } else {
          if (!responseBackend.tipo && !responseBackend.mensajes) {
            dataObj = { tipo: HTTP_RESPONSE.SUCCESS, mensajes: [], data: responseBackend };
            if (responseBackend.mensajes && Array.isArray(responseBackend.mensajes)) {
              dataObj = { tipo: HTTP_RESPONSE.SUCCESS, mensajes: responseBackend.mensajes, data: responseBackend };
            }
            if (responseBackend.mensajes && !Array.isArray(responseBackend.mensajes)) {
              dataObj = { tipo: HTTP_RESPONSE.SUCCESS, mensajes: [responseBackend.mensajes], data: responseBackend };
            }
          } else {
            if (responseBackend.tipo === HTTP_RESPONSE.PERMISION_ERROR) {
              dataObj = responseBackend;
            }
            if (responseBackend.tipo === HTTP_RESPONSE.SUCCESS) {
              if (responseBackend.mensajes && Array.isArray(responseBackend.mensajes)) {
                dataObj = { tipo: responseBackend.tipo, mensajes: responseBackend.mensajes, data: responseBackend };
              } else {
                dataObj = { tipo: responseBackend.tipo, mensajes: [responseBackend.mensajes], data: responseBackend };
              }
            }
            if (responseBackend.tipo === HTTP_RESPONSE.WARNING) {
              if (responseBackend.mensajes && Array.isArray(responseBackend.mensajes)) {
                dataObj = { tipo: responseBackend.tipo, mensajes: responseBackend.mensajes, data: responseBackend };
              } else {
                dataObj = { tipo: responseBackend.tipo, mensajes: [responseBackend.mensajes], data: responseBackend };
              }
            }
            if (responseBackend.tipo === HTTP_RESPONSE.INFO) {
              if (responseBackend.mensajes && Array.isArray(responseBackend.mensajes)) {
                dataObj = { tipo: responseBackend.tipo, mensajes: responseBackend.mensajes, data: responseBackend };
              } else {
                dataObj = { tipo: responseBackend.tipo, mensajes: [responseBackend.mensajes], data: responseBackend };
              }
            }
            if (responseBackend.tipo === HTTP_RESPONSE.ERROR) {
              if (responseBackend.mensajes && Array.isArray(responseBackend.mensajes)) {
                /**
                 * Si la respuesta tiene alguno de los siguientes problemas parseo
                 * la respuesta indicando el origen del problema
                 */
                dataObj = { tipo: responseBackend.tipo, mensajes: [''], data: responseBackend };
              } else {
                dataObj = { tipo: responseBackend.tipo, mensajes: [responseBackend.mensajes], data: responseBackend };
              }
            }
          }
        }
      }
    }
    return dataObj;
  }

}
