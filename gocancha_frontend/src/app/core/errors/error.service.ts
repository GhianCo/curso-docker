import {Injectable} from '@angular/core';

@Injectable({
  providedIn: 'root'
})

export class ErrorService {

  getClientErrorMessage(error: Error): string {
    return error.message ? error.message : error.toString();
  }
}
