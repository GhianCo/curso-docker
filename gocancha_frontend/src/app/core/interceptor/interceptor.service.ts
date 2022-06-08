import {Injectable} from '@angular/core';
import {
  HttpEvent,
  HttpInterceptor,
  HttpHandler,
  HttpRequest,
  HttpResponse,
  HttpErrorResponse
} from '@angular/common/http';
import {Observable, throwError} from 'rxjs';
import {catchError, filter, retry, take, tap, timeout} from 'rxjs/operators';
import {ActivationEnd, Router} from '@angular/router';
import {CancelRequestService} from './cancel.request.service';
import {HTTP_RESPONSE} from 'app/global/constants';
import {AuthenticationStateFacade} from "@core/facades/stores/AuthStoreFacade";
import {ToasterService} from "@shared/services/toaster.service";
import {ModalController} from "@ionic/angular";
import {Capacitor} from "@capacitor/core";

@Injectable()
export class HttpTokenInterceptor implements HttpInterceptor {

  /**
   * Contiene la ruta de conexión a backend publico
   */
  constructor(
    private router: Router,
    private httpCancelService: CancelRequestService,
    private authenticationStoreFacade: AuthenticationStateFacade,
    private toastService: ToasterService,
    private modalController: ModalController,
  ) {
    router.events.subscribe(event => {
      // An event triggered at the end of the activation part of the Resolve phase of routing.
      if (event instanceof ActivationEnd) {
        // Cancel pending calls
        this.httpCancelService.cancelPendingRequests();
      }
    });
  }

  /**
   * Interceptor soporta captura de token para peticiones que apunten a api y
   * detecta la navegacion entre router para cancelar la peticion
   */

  intercept(req: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    const headersConfig = {};
    const authToken = this.getCurrentAuthToken;
    if (authToken) {
      if (req.url.toString() && (req.url.toString().indexOf('api/rest') >= 0)) {
        headersConfig['Authorization'] = 'Token token="' + authToken + '"';
      }
    }
    if (req.url.toString() && (req.url.toString().indexOf('api/rest') >= 0 || req.url.toString().indexOf('public/rest') >= 0)) {
      headersConfig['Platform'] = Capacitor.getPlatform().toUpperCase();
    }
    const request = req.clone({setHeaders: headersConfig});

    return next.handle(request).pipe(
      tap((event: HttpEvent<any>) => {
        if (event instanceof HttpResponse) {
          event = event.clone({body: this.redireccionarSegunRespuesta(event.body)});
        }
        return event;
        // Cancela la peticion al navegar entre routers
      }),
      //Cancelo la peticion si pasa los 30 seg
      timeout(10000),
      catchError((error) => {
        /*if (error instanceof TimeoutError) {
          this.toastService.presentError('La petición demoró en responder.');
        }*/
        if (error instanceof HttpErrorResponse) {
          this.toastService.presentError('La petición no respondió, verifica tu conexión a la red.');
        }
        this.modalController.dismiss();
        return throwError(error || 'Timeout Exception');
      }),
      retry(3)
    );
  }

  private async redireccionarSegunRespuesta(body: any) {
    if (Number(body.tipo) == Number(HTTP_RESPONSE.PERMISION_ERROR)) {
      this.authenticationStoreFacade.loadSignOut();
    }
  }

  private get getCurrentAuthToken() {
    let authToken = null;
    const currentProviderSub = this.authenticationStoreFacade.authToken$.pipe(
        take(1),
        filter(authToken => authToken && authToken != ''),
        tap(authTokenStore => {
          authToken = authTokenStore;
        })
    ).subscribe();
    currentProviderSub.unsubscribe();
    return authToken;
  }
}
