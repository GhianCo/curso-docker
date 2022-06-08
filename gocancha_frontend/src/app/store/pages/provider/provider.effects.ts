import { Injectable } from '@angular/core';
import { Actions, createEffect, ofType } from "@ngrx/effects";
import { Store } from "@ngrx/store";
import { IProviderState } from "./provider.state";
import { catchError, filter, map, switchMap, tap, withLatestFrom } from "rxjs/operators";
import * as ProviderUIActions from './provider.ui.actions';
import { ProviderRemoteDatasource } from "@core/datasources/remote/ProviderRemoteDatasource";
import { of } from "rxjs";
import { CloudinaryRemoteDatasource } from "@core/datasources/remote/CloudinaryRemoteDatasource";
import * as AuthUIActions from "@store/pages/auth/auth.ui.actions";
import { ModalController } from "@ionic/angular";
import { ToasterService } from "@shared/services/toaster.service";
import { HTTP_RESPONSE, TYPE_PAYMENT_RESERVATION } from "app/global/constants";
import { Router } from "@angular/router";
import { getSupportAgents } from "@store/pages/provider/provider.selector";
import { PaymentOnlineReservationFinalizeModalComponent } from "@shared/components/modals/payment-online-reservation-finalize-modal/payment-online-reservation-finalize-modal.component";
import { DateTimeUtils } from "@shared/utils/datetimeUtils";
import { LoadingService } from '@shared/services/loading.service';

@Injectable()
export class ProviderEffects {
  constructor(
    private actions$: Actions,
    private providerRemoteDatasource: ProviderRemoteDatasource,
    private cloudinaryRemoteDatasource: CloudinaryRemoteDatasource,
    private store$: Store<IProviderState>,
    private modalController: ModalController,
    private toasterService: ToasterService,
    private router: Router,
    private loadingService: LoadingService,
  ) {
  }

  loadFavoriteProviders$ = this.loadFavoriteProviders();
  loadProvidersNearby$ = this.loadProvidersNearby();
  loadBankAccounts$ = this.loadBankAccounts();
  loadUploadImage$ = this.loadUploadImage();
  loadReservationSportplatform$ = this.loadReservationSportplatform();
  loadCancelReservationSportplatform$ = this.loadCancelReservationSportplatform();
  loadDataFromProvider$ = this.loadDataFromProvider();
  loadMarkProviderLikeFavorite$ = this.loadMarkProviderLikeFavorite();
  loadSupportAgent$ = this.loadSupportAgent();

  private loadFavoriteProviders() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(ProviderUIActions.favoriteProvidersLoad),
        tap(() => {
          this.store$.dispatch(ProviderUIActions.favoriteProvidersLoading());
        }
        ),
        switchMap(action => this.providerRemoteDatasource.geAllFavoriteProvider(action.sportId).pipe(
          map(response => ProviderUIActions.favoriteProvidersLoaded({ data: response.data })),
          catchError(error => of(ProviderUIActions.favoriteProvidersWithError({ error })))
        ))
      )
    );
  }

  private loadProvidersNearby() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(ProviderUIActions.providersNearbyLoad),
        tap(() => {
          this.store$.dispatch(ProviderUIActions.providersNearbyLoading());
        }
        ),
        switchMap(action => this.providerRemoteDatasource.geAllFavoriteNearby(action.criteria).pipe(
          map(response => ProviderUIActions.providersNearbyLoaded({ data: response.data })),
          catchError(error => of(ProviderUIActions.providersNearbyWithError({ error })))
        ))
      )
    );
  }

  private loadBankAccounts() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(ProviderUIActions.bankAccountLoad),
        tap(() => {
          this.store$.dispatch(ProviderUIActions.bankAccountLoading());
        }
        ),
        switchMap(_ => this.providerRemoteDatasource.getBankAccounts().pipe(
          map(response => ProviderUIActions.bankAccountLoaded({ data: response.data })),
          catchError(error => of(ProviderUIActions.bankAccountWithError({ error })))
        ))
      )
    );
  }

  private loadUploadImage() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(ProviderUIActions.uploadImageLoad),
        tap(() => {
          this.loadingService.showLoading('Subiendo imagen...');
          this.store$.dispatch(ProviderUIActions.uploadImageLoading());
        }),
        switchMap(action => this.cloudinaryRemoteDatasource.uploadImage(action.criteria).pipe(
          tap(_ => {
            this.loadingService.hideLoading();
          }),
          map(response => ProviderUIActions.uploadImageLoaded({ data: response.data })),
          catchError(error => {
            this.loadingService.hideLoading();
            return of(ProviderUIActions.uploadImageWithError({ error }))
          })
        ))
      )
    );
  }

  private loadReservationSportplatform() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(ProviderUIActions.reservationSportplatformLoad),
        tap(() => {
          this.store$.dispatch(ProviderUIActions.reservationSportplatformLoading());
        }
        ),
        switchMap(action => this.providerRemoteDatasource.reserveSportplatform(action.reservation).pipe(
          tap(async (response: any) => {
            const data = { ...response.data };
            if (response.tipo == HTTP_RESPONSE.SUCCESS) {
              await this.toasterService.presentSuccess(response.mensajes[0]);
              this.store$.dispatch(AuthUIActions.lastReservationsCustomerLoad());
              this.store$.dispatch(ProviderUIActions.clearImageLoaded());
              await this.router.navigate(['profile']);
              await this.modalController.dismiss();
            } else {
              this.store$.dispatch(AuthUIActions.clearReservationToPaymentOnline());
              await this.toasterService.presentError(response.mensajes[0]);
            }
            if (data.reserva_tipopago == TYPE_PAYMENT_RESERVATION.ON_LINE) { // Si es pago en linea
              data.date = DateTimeUtils.getFormatDayWithHoursAMPM(data.reserva_fecha);
              await this.showModalPaymentEnding(response.tipo, data);
            }
          }),
          map(response => ProviderUIActions.reservationSportplatformLoaded({ data: response.data })),
          catchError(error => of(ProviderUIActions.reservationSportplatformWithError({ error })))
        ))
      )
    );
  }

  private loadCancelReservationSportplatform() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(ProviderUIActions.cancelReservationSportplatformLoad),
        tap(() => {
          this.store$.dispatch(ProviderUIActions.cancelReservationSportplatformLoading());
        }
        ),
        switchMap(action => this.providerRemoteDatasource.cancelReservationSportplatform(action.reservation).pipe(
          tap(async (response: any) => {
            if (response.tipo == HTTP_RESPONSE.SUCCESS) {
              await this.toasterService.presentSuccess(response.mensajes[0]);
              this.store$.dispatch(AuthUIActions.lastReservationsCustomerLoad());
            } else {
              await this.toasterService.presentError(response.mensajes[0]);
            }
            await this.modalController.dismiss();
          }),
          map(response => ProviderUIActions.cancelReservationSportplatformLoaded({ data: response.data })),
          catchError(error => of(ProviderUIActions.cancelReservationSportplatformWithError({ error })))
        ))
      )
    );
  }

  private loadDataFromProvider() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(ProviderUIActions.dataFromProviderLoad),
        tap(() => {
          this.store$.dispatch(ProviderUIActions.dataFromProviderLoading());
        }
        ),
        switchMap(action => this.providerRemoteDatasource.dataFromProvider(action.providerId).pipe(
          map(response => ProviderUIActions.dataFromProviderLoaded({ data: response.data })),
          catchError(error => of(ProviderUIActions.dataFromProviderWithError({ error })))
        ))
      )
    );
  }

  private loadMarkProviderLikeFavorite() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(ProviderUIActions.markProviderLikeFavoriteLoad),
        tap(() => {
          this.store$.dispatch(ProviderUIActions.markProviderLikeFavoriteLoading());
        }
        ),
        switchMap(action => this.providerRemoteDatasource.markLikeFavorite(action.providerId).pipe(
          map(response => ProviderUIActions.markProviderLikeFavoriteLoaded({ data: response.data })),
          catchError(error => of(ProviderUIActions.markProviderLikeFavoriteWithError({ error })))
        ))
      )
    );
  }

  private loadSupportAgent() {
    return createEffect(() =>
      this.actions$.pipe(
        ofType(ProviderUIActions.supportAgentLoad),
        withLatestFrom(this.store$.select(getSupportAgents)),
        filter(([_, supportAgents]) => !supportAgents.length),
        tap(() => {
          this.store$.dispatch(ProviderUIActions.supportAgentLoading());
        }
        ),
        switchMap(_ => this.providerRemoteDatasource.getSupportList().pipe(
          map(response => ProviderUIActions.supportAgentLoaded({ data: response.data })),
          catchError(error => of(ProviderUIActions.supportAgentWithError({ error })))
        ))
      )
    );
  }

  private async showModalPaymentEnding(typeResponseReservation, reservation) {
    const modal = await this.modalController.create({
      component: PaymentOnlineReservationFinalizeModalComponent,
      initialBreakpoint: .5,
      componentProps: {
        typeResponseReservation,
        reservation
      },
    });

    return await modal.present();
  }

}
