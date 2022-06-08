import {ErrorHandler, Injectable, Injector} from '@angular/core';
import {Capacitor} from '@capacitor/core';

@Injectable()
export class GlobalErrorHandler implements ErrorHandler {

  constructor(
    private injector: Injector,
  ) {
  }

  handleError(error: Error) {
    if (Capacitor.getPlatform() != 'web') {

    }
    // Always log errors
    console.error(error);
  }
}
