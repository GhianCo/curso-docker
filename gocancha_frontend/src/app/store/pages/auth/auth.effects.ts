import { Injectable } from '@angular/core';
import { Actions, createEffect, ofType } from "@ngrx/effects";
import { Store } from "@ngrx/store";
import { IAuthenticationState } from "./auth.state";
import { catchError, filter, map, switchMap, tap } from "rxjs/operators";
import * as AuthUIActions from './auth.ui.actions';
import { of } from "rxjs";
import { Router } from "@angular/router";
import { HTTP_RESPONSE, TypeLoginApp } from "app/global/constants";
import { AppSessionLocalDatasource } from "@core/datasources/local/AppSessionLocalDatasource";
import { AuthenticationFirebaseDatasource } from "@core/datasources/firebase/AuthenticationFirebaseDatasource";
import { AuthenticationRemoteDatasource } from "@core/datasources/remote/AuthenticationRemoteDatasource";
import { AddressRemoteDatasource } from "@core/datasources/remote/AddressRemoteDatasource";
import { ModalController } from "@ionic/angular";
import { DateTimeUtils } from "@shared/utils/datetimeUtils";
import { LoadingService } from "@shared/services/loading.service";
import { FirebaseCloudMessageService } from "@core/datasources/firebase/FirebaseCloudMessageDatasource";
import { Capacitor } from '@capacitor/core';

@Injectable()
export class AuthenticationEffects {
  constructor(
    private actions$: Actions,
    private authenticationFirebaseDatasource: AuthenticationFirebaseDatasource,
    private authenticationRemoteDatasource: AuthenticationRemoteDatasource,
    private store$: Store<IAuthenticationState>,
    private appSessionLocalDatasource: AppSessionLocalDatasource,
    private addressRemoteDatasource: AddressRemoteDatasource,
    private router: Router,
    private modalController: ModalController,
    public loadingService: LoadingService,
    private firebaseCloudMessageService: FirebaseCloudMessageService,
  ) {
  }

  loadLoginFirebase$ = this.loadLoginFirebase();
  loadLoginSubdomain$ = this.loadLoginSubdomain();
  getAddressByCoors$ = this.getAddressByCoors();
  loadLogOut$ = this.loadLogOut();

  loadSearchAddress$ = this.loadSearchAddress();
  loadCoordsByPlace$ = this.loadCoordsByPlace();
  updateFCM$ = this.updateFCM();

  private loadLoginFirebase() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(AuthUIActions.loginFirebaseLoad),
        tap(() => {
          this.store$.dispatch(AuthUIActions.loginFirebaseLoading());
        }
        ),
        switchMap(action => this.authenticationFirebaseDatasource.login(action.criteria).then(async response => {
          if (response.tipo == HTTP_RESPONSE.SUCCESS) {
            const data = response.data;
            let criteria: any = {
              cliente_nombres: data.givenName || data.name || data?.additionalUserInfo?.profile?.given_name || 'Nombre',
              cliente_apellidos: data.familyName || data?.additionalUserInfo?.profile?.family_name || 'Apellidos',
              cliente_correo: data.email || data?.additionalUserInfo?.profile?.email || DateTimeUtils.getCurrentTimeUnix() + '@correo.com'
            };
            let uid = null;
            if (Capacitor.getPlatform() == 'ios') {
              uid = data.id || data.user;
            } else {
              uid = data.id || data?.additionalUserInfo?.profile?.id;
            }

            if (data.provider == TypeLoginApp.Google) {
              criteria.cliente_gid = uid;
            } else if (data.provider == TypeLoginApp.Facebook) {
              criteria.cliente_fbid = uid;
            } else {
              criteria.cliente_aid = uid;
            }
            this.store$.dispatch(AuthUIActions.loginSubdomainLoad({ criteria }));
          }
        }))
      ),
      { dispatch: false }
    );
  }

  private loadLoginSubdomain() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(AuthUIActions.loginSubdomainLoad),
        tap(async () => {
          await this.loadingService.showLoading('Accediendo a GoCancha...');
          this.store$.dispatch(AuthUIActions.loginSubdomainLoading());
        }
        ),
        switchMap(action => this.authenticationRemoteDatasource.login(action.criteria).pipe(
          tap(async response => {
            const data = response.data;
            const session = {
              authToken: data.token,
              userId: data.cliente_id,
              userNick: data.cliente_correo || 'Usuario',
              userName: data.cliente_nombres,
              userLastName: data.cliente_apellidos,
              userNumber: data.cliente_telefono,
            };
            await this.appSessionLocalDatasource.saveDataSession(session);
            this.store$.dispatch(AuthUIActions.setSessionLocalstorageToStateApp({ session }));
            this.store$.dispatch(AuthUIActions.profileCustomerLoad());
            await this.router.navigate(['/home']);
            await this.firebaseCloudMessageService.initNotifications();
            this.loadingService.hideLoading();
          }),
          filter(reponse => reponse.tipo == HTTP_RESPONSE.SUCCESS),
          map(response => AuthUIActions.loginSubdomainLoaded({ data: response })),
          catchError(error => {
            this.loadingService.hideLoading();
            return of(AuthUIActions.loginSubdomainWithError({ error }))
          })
        ))
      )
    );
  }

  private getAddressByCoors() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(AuthUIActions.getAddressByCoors),
        switchMap(action => this.authenticationRemoteDatasource.getAddressByCoords(action.coords).pipe(
          map(response => AuthUIActions.saveCurrentAddress({ address: response.data.address })),
          catchError(error => of(AuthUIActions.getAddressByCoorsWithError({ error })))
        ))
      )
    );
  }

  private loadLogOut() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(AuthUIActions.logOutLoad),
        tap(async () => {
          this.store$.dispatch(AuthUIActions.logOutLoading());
          await this.loadingService.showLoading('Saliendo de GoCancha...');
        }
        ),
        switchMap(action => this.authenticationRemoteDatasource.deleteToken(action.authToken).pipe(
          tap(async response => {
            if (response.tipo == HTTP_RESPONSE.SUCCESS) {
              await this.appSessionLocalDatasource.clearDataSession();
              await this.router.navigate(['/auth/signin'])
            } else {
              AuthUIActions.logOutWithError(response.mensajes);
            }
            this.loadingService.hideLoading();
          }),
          filter(reponse => reponse.tipo == HTTP_RESPONSE.SUCCESS),
          map(response => AuthUIActions.loginFirebaseLoaded({ data: response })),
          catchError(error => {
            this.loadingService.hideLoading();
            return of(AuthUIActions.logOutWithError({ error }))
          })
        ))
      )
    );
  }

  private loadSearchAddress() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(AuthUIActions.searchAddressLoad),
        tap(() => this.store$.dispatch(AuthUIActions.searchAddressLoading())),
        switchMap(action => this.addressRemoteDatasource.searchAddress(action.address).pipe(
          map(response => AuthUIActions.searchAddressLoaded({ data: response.data })),
          catchError(error => of(AuthUIActions.searchAddressWithError({ error })))
        ))
      )
    );
  }

  private loadCoordsByPlace() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(AuthUIActions.coordsByPlaceLoad),
        tap(async () => {
          this.store$.dispatch(AuthUIActions.coordsByPlaceLoading());
          await this.loadingService.showLoading('Buscando las coordenadas de tu dirección...');
        }
        ),
        switchMap(action => this.addressRemoteDatasource.coordsByPlace(action.placeId).pipe(
          tap(response => {
            const data = response.data;
            const currentCoords = {
              latitude: data.latitude,
              longitude: data.longitude
            };
            this.store$.dispatch(AuthUIActions.saveCurrentCoords({ currentCoords }));
          })
        )),
        switchMap(place => this.authenticationRemoteDatasource.getAddressByCoords(place.data).pipe(
          map(response => AuthUIActions.saveCurrentAddress({ address: response.data.address })),
          tap(async _ => {
            await this.loadingService.hideLoading();
            await this.modalController.dismiss();
          }),
          catchError(error => {
            this.loadingService.hideLoading();
            return of(AuthUIActions.coordsByPlaceWithError({ error }))
          })
        ))
      )
    );
  }

  private updateFCM() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(AuthUIActions.updateFCMLoad),
        tap(() => {
          this.store$.dispatch(AuthUIActions.updateFCMLoading());
        }
        ),
        switchMap(action => this.authenticationRemoteDatasource.updateFCM(action.criteria).pipe(
          map(response => AuthUIActions.updateFCMLoaded({ data: response })),
          catchError(error => of(AuthUIActions.updateFCMWithError({ error })))
        ))
      )
    );
  }

}
