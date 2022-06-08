import {Injectable} from '@angular/core';
import {CountdownFormatFn} from 'ngx-countdown';
import * as moment from 'moment';
import {UtilityService} from "@shared/utils/utility.service";

@Injectable({
  providedIn: 'root'
})
export class DateTimeUtils {

  public static dayNames: Array<string> = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

  private countdownTimeUnits: Array<[string, number]> = [
    ['Y', 1000 * 60 * 60 * 24 * 365], // years
    ['M', 1000 * 60 * 60 * 24 * 30], // months
    ['D', 1000 * 60 * 60 * 24], // days
    ['H', 1000 * 60 * 60], // hours
    ['m', 1000 * 60], // minutes
    ['s', 1000], // seconds
    ['S', 1], // million seconds
  ];


  public monthShortNames: Array<string> = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Set', 'Oct', 'Nov', 'Dic'];
  public weeksList: Array<string> = ['D', 'L', 'M', 'M', 'J', 'V', 'S'];

  constructor() {
  }

  public countdownFormatDate?: CountdownFormatFn = ({date, formatStr, timezone}) => {
    let duration = Number(date || 0);

    if (duration >= 86400000) {
      return 'Más de 1 día';
    }

    return this.countdownTimeUnits.reduce((current, [name, unit]) => {
      if (current.indexOf(name) !== -1) {
        const v = Math.floor(duration / unit);
        duration -= v * unit;
        return current.replace(new RegExp(`${name}+`, 'g'), (match: string) => {
          return v.toString().padStart(match.length, '0');
        });
      }
      return current;
    }, formatStr);
  };

  public static getRangeDaysWeekFromToday(days = 7): any[] {
    const today = moment();
    let daysFromToday = [today];
    for (let countDay = 0; daysFromToday.length < days; countDay++) {
      daysFromToday.push(moment(daysFromToday[countDay]).add(1, 'day'));
    }
    return daysFromToday.map(horario => {
      return {
        day: UtilityService.capitalizeFirstLetter(horario.format('YYYY-MM-DD')),
        dayName: UtilityService.capitalizeFirstLetter(horario.format('ddd')).replace('.',''),
        dayNumber: horario.format('DD')
      };
    });
  }

  public static getFormatDateViewWithoutHour(fecha) {
    return moment(fecha).format('DD MMM YYYY');
  }

  public static getFormatDateBD(fecha) {
    return moment(fecha).format('YYYY-MM-DD');
  }

  public static getDayNumberFromDate(fecha) {
    return moment(fecha).format('DD');
  }

  public static getDateFormated(fecha, format) {
    return moment(fecha).format(format);
  }

  public static getHoursFromDate(fecha) {
    return moment(fecha).format('HH:mm');
  }

  public static getNextHourFromNow(hour) {
    return this.getDateFormated(this.addTimeToDate(this.obtenerFechaActual(), hour * 60), 'HH') + ':00';
  }

  public static getHoursFormatAMPM(fecha) {
    return moment(fecha).format('hh:mm A');
  }

  public static getCurrentDayWithoutHours() {
    return moment().format('YYYY-MM-DD');
  }

  public static getCurrentDayWithHoursAMPM() {
    return moment().format('DD MMM YYYY hh:mm A');
  }

  public static getFormatDayWithHoursAMPM(date) {
    return moment(date).format('DD MMM YYYY hh:mm A');
  }

  public static addTimeToDate(date, time, unitOfTime?, format?): any {
    if (!format) {
      format = 'YYYY-MM-DD HH:mm:ss';
    }
    if (!unitOfTime) {
      unitOfTime = 'minutes';
    }
    return moment(date).add(time, unitOfTime).format(format);
  }

  public static getCurrentTimeUnix() {
    return moment().unix();
  }

  public static getDiffTime(initialDate, endDate): any {
    let diffText = '';
    const initialDateM = moment(initialDate);
    const endDateM = moment(endDate);

    const days = endDateM.diff(initialDateM, 'days');
    let hours = endDateM.diff(initialDateM, 'hours');
    let minutes = endDateM.diff(initialDateM, 'minutes');

    if (days > 0) {
      diffText += days + 'd ';
    }
    if (hours > 0) {
      hours = hours - days * 24;
      diffText += hours + 'h ';
    }
    if (minutes > 0) {
      minutes = minutes - (days * 24 * 60 + hours * 60);
      diffText += minutes + 'm ';
    } else {
      diffText = ' menos de un minuto ';
    }
    return diffText;
  }

  public static getDiffTimeMinutes(initialDate, endDate, unitOfTime): any {
    if (!DateTimeUtils.dateIsValid(initialDate) || !DateTimeUtils.dateIsValid(endDate)) {
      return 0;
    }
    const initialDateM = moment(initialDate);
    const endDateM = moment(endDate);

    return endDateM.diff(initialDateM, unitOfTime);
  }

  public static obtenerFormatoVistaAMPM(fecha) {
    return moment(fecha).format('DD MMM YYYY hh:mm A');
  }

  public static obtenerFechaActual() {
    return moment().format('YYYY-MM-DD HH:mm:ss');
  }

  public static getCurrentYear() {
    return new Date().getFullYear();
  }

  public static dateIsValid(date) {
    return moment(date).isValid();
  }

  public static relativeTimeFromDate(date) {
    return moment(date).fromNow();
  }

  public getRangeHours(inicio?, fin?, intervalo?, dia?) {
    if (!intervalo) {
      intervalo = 15;
    }
    const listaHoras = [];
    let listaHorasConFormato = [];
    for (let countHora = 0; countHora < 25; countHora++) {
      listaHoras.push({
        horaEntera: this.zfill(countHora, 2),
        horaEnteraAMPM: this.zfill(countHora, 2),
      });
    }
    listaHoras.forEach(hora => {
      if (hora.horaEntera < 24) {
        for (let countMinuto = 0; countMinuto < 60; countMinuto = countMinuto + intervalo) {
          let prefijoMeridiano = 'am';
          if (hora.horaEntera >= '12:00') {
            prefijoMeridiano = 'pm';
          }
          listaHorasConFormato.push({
            horaEntera: hora.horaEntera + ':' + this.zfill(countMinuto, 2),
            horaEnteraAMPM: hora.horaEnteraAMPM + ':' + this.zfill(countMinuto, 2) + ' ' + prefijoMeridiano,
          });
        }
      }
    });
    if (inicio && fin) {
      const listaHorasSinFilter = listaHorasConFormato;
      listaHorasConFormato = listaHorasSinFilter.filter(hora => hora.horaEnteraAMPM >= inicio && hora.horaEnteraAMPM <= fin);
    }
    if (dia) {
      const hoyNumerico = moment().format('DD');
      const horaActualHoy = moment().format('HH:mm');
      if (dia == hoyNumerico) {
        const listaHorasSinFilterHoy = listaHorasConFormato;
        listaHorasConFormato = listaHorasSinFilterHoy.filter(hora => hora.horaEntera > horaActualHoy);
      }
    }
    return listaHorasConFormato;
  }

  public zfill(numero, width) {
    const numeroOutput = Math.abs(numero); /* Valor absoluto del número */
    const length = numero.toString().length; /* Largo del número */
    const zero = '0'; /* String de cero */

    if (width <= length) {
      if (numero < 0) {
        return ('-' + numeroOutput.toString());
      } else {
        return numeroOutput.toString();
      }
    } else {
      if (numero < 0) {
        return ('-' + (zero.repeat(width - length)) + numeroOutput.toString());
      } else {
        return ((zero.repeat(width - length)) + numeroOutput.toString());
      }
    }
  }
}
