import {Inject, Injectable, PLATFORM_ID} from '@angular/core';
import {isNumeric} from 'rxjs/internal-compatibility';
import {isPlatformBrowser} from '@angular/common';
import {ORDER_ARRAY, PARAM} from 'app/global/constants';
import {ToasterService} from '@shared/services/toaster.service';
import {environment} from '@environments/environment';
import {throwError} from 'rxjs';
import {FormGroup} from '@angular/forms';
import {Md5} from 'ts-md5';

@Injectable({
  providedIn: 'root'
})

export class UtilityService {

  private audio = new Audio();

  constructor(
    @Inject(PLATFORM_ID) private platformId: Object,
    private dGoToastService: ToasterService,
  ) {
  }

  /**
   * Validadores
   */

  public static esUnIDValido(id: string) {
    // tslint:disable-next-line:radix
    return isNumeric(id) && parseInt(id) > 0;
  }
  private static _convertBlobToBase64(blob: Blob) {
    return new Promise((resolve, reject) => {
      const reader = new FileReader;
      reader.onerror = reject;
      reader.onload = () => {
        resolve(reader.result);
      };
      reader.readAsDataURL(blob);
    });
  }

  public static md5(textToEncode) {
    const md5 = new Md5();
    return md5.appendStr(textToEncode).end();
  }

  /**
   * metodo para obtener un codigo unico por navegador
   */
  public obtenerIdentificadorNavegador(): string {
    let uid = '';
    if (isPlatformBrowser(this.platformId)) { // For SSR
      const navigatorInfo = window.navigator;
      const screenInfo = window.screen;
      uid = String(navigatorInfo.mimeTypes.length);
      uid += navigatorInfo.userAgent.replace(/\D+/g, '');
      uid += navigatorInfo.plugins.length;
      uid += screenInfo.height || '';
      uid += screenInfo.width || '';
      uid += screenInfo.pixelDepth || '';
    }
    return uid;
  }

  /**
   * Parsers data
   */

  public async handleError(errorServidor: any) {
    let mensajeError: string;
    if (errorServidor.error instanceof ErrorEvent) {
      mensajeError = `Ocurrio un error: ${errorServidor.error.message}`;
      await this.dGoToastService.presentError(mensajeError);
    } else {
      mensajeError = `Backend retorno el codigo de error ${errorServidor.status}: ${errorServidor.message}`;
    }
    return throwError(mensajeError);
  }

  public static round(value, exp): number {
    if (typeof exp === 'undefined' || +exp === 0) {
      return Math.round(value);
    }
    value = UtilityService.round2(value, exp + 2);
    value = +value;
    exp = +exp;
    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
      return NaN;
    }
    value = value.toString().split('e');
    value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
  }

  public static round2(value, exp): number {
    if (typeof exp === 'undefined' || +exp === 0) {
      return Math.round(value);
    }
    value = +value;
    exp = +exp;
    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
      return NaN;
    }
    value = value.toString().split('e');
    value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
  }

  public static formatoNumero(amount, decimales?): string {
    const respaldo = amount;
    const decimals = Number(decimales) >= 0 ? decimales : 2;
    amount += '';
    if (amount === 'NaN' || amount === 'undefined' || amount === 'Infinity') {
      amount = '0';
    }
    if (isNaN(amount)) {
      return respaldo;
    }

    amount = parseFloat(amount); // convierte a numero
    amount = UtilityService.round(amount, decimals); // devuelve un string
    const codIdioma = UtilityService.obtenerIdiomaLocal();
    amount = (amount).toLocaleString(codIdioma, {minimumFractionDigits: decimals}); // retorna string
    return amount;
  }

  public static obtenerIdiomaLocal(): string {
    return 'es-Pe';
  }

  public objectosSonIguales(object1, object2): boolean {
    const keys1 = Object.keys(object1);
    const keys2 = Object.keys(object2);

    if (keys1.length !== keys2.length) {
      return false;
    }

    for (const key of keys1) {
      const val1 = object1[key];
      const val2 = object2[key];
      const areObjects = this.isObject(val1) && this.isObject(val2);
      if (
        areObjects && !this.objectosSonIguales(val1, val2) ||
        !areObjects && val1 !== val2
      ) {
        return false;
      }
    }

    return true;
  }

  public isObject(object): boolean {
    return object != null && typeof object === 'object';
  }

  public getDataLoginSubdomain(): any {
    const accessUser: any = {};
    accessUser.caja_id = PARAM.ACTIVO;
    accessUser.local_id = PARAM.ACTIVO;
    accessUser.turno_id = PARAM.ACTIVO;
    accessUser.usuario_recordar = PARAM.ACTIVO;
    accessUser.app = 'Proveedor';
    return accessUser;
  }

  public getTimeReservation() {
    return [
      {
        id: 60,
        description: '1 hora'
      },
      {
        id: 120,
        description: '2 horas'
      },
      {
        id: 180,
        description: '3 horas'
      },
      {
        id: 240,
        description: '4 horas'
      },
      {
        id: 300,
        description: '5 horas'
      },
      {
        id: 360,
        description: '6 horas'
      }
    ];
  }

  public getDistanceReservation() {
    return [
      {
        id: 1,
        description: '1 Km'
      },
      {
        id: 5,
        description: '5 Km'
      },
      {
        id: 10,
        description: '10 Km'
      },
      {
        id: 15,
        description: '15 Km'
      },
      {
        id: 20,
        description: '20 Km'
      },
      {
        id: 25,
        description: '25 Km'
      },
    ];
  }

  public static obtenerCDNBaseImagen(urlImagen, resolution): string {
    if (
      urlImagen
      && (urlImagen.startsWith('backgrounds/')
          || urlImagen.startsWith('products/')
          || urlImagen.startsWith('logos/')
          || urlImagen.startsWith('liquidacion/')
          || urlImagen.startsWith('story/')
      )
    ) {
      return environment.CDN_CLOUDINARY + resolution +'/' + urlImagen;
    }
    return urlImagen;
  }

  public static orderArray(array, type): any[] {
    if (type == ORDER_ARRAY.ASC) {
      return array.sort((a, b) => {
        return a.delivery_minutosestimadosTimer - b.delivery_minutosestimadosTimer;
      });
    } else {
      return array.sort((a, b) => {
        return b.delivery_minutosestimadosTimer - a.delivery_minutosestimadosTimer;
      });
    }

  }

  // Helper function
  // https://stackoverflow.com/questions/16245767/creating-a-blob-from-a-base64-string-in-javascript
  public static b64toBlob(b64Data, contentType = '', sliceSize = 512) {
    const byteCharacters = atob(b64Data);
    const byteArrays = [];

    for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
      const slice = byteCharacters.slice(offset, offset + sliceSize);

      const byteNumbers = new Array(slice.length);
      for (let i = 0; i < slice.length; i++) {
        byteNumbers[i] = slice.charCodeAt(i);
      }

      const byteArray = new Uint8Array(byteNumbers);
      byteArrays.push(byteArray);
    }

    return new Blob(byteArrays, {type: contentType});
  }

  public async commingSoon() {
    await this.dGoToastService.presentNotify('Pronto disponible...');
  }

  public async playNotify(soundFile?) {
    let sound = soundFile ? soundFile : 'sound_notify';
    this.audio.src = '/assets/' + sound +'.wav';
    this.audio.load();
    this.audio.loop = true;
    await this.audio.play();
    setTimeout(_ => {
      this.audio.pause();
    }, 60000);
  }

  public async stopNotify() {
    this.audio.pause();
  }

  public static markFormGroupTouched(form: FormGroup) {
    Object.values(form.controls).forEach(control => {
      control.markAsTouched();

      if ((control as any).controls) {
        UtilityService.markFormGroupTouched(control as FormGroup);
      }
    });
  }

  public static scrollToId(id, yOffset?) {
    yOffset = yOffset ? yOffset : -80;
    const element = document.getElementById(id);
    const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;
    window.scrollTo({top: y, behavior: 'smooth'});
  }

  public static capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

  public static getDistanceBetweenCoords(latInitial, longInitial, latEnd, longEnd) {
    return 6371 * Math.acos(Math.sin((latEnd * Math.PI / 180)) * Math.sin((latInitial * Math.PI / 180)) + Math.cos((longEnd - longInitial) * Math.PI / 180) * Math.cos(latEnd * Math.PI / 180) * Math.cos(latInitial * Math.PI / 180));
  }
}



