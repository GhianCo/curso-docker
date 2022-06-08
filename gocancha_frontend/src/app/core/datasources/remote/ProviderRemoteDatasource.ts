import {Injectable} from '@angular/core';
import {ParseDataResponseMapper} from "@core/mappers/ParseDataResponseMapper";
import {HttpClient} from "@angular/common/http";
import {catchError, map} from "rxjs/operators";
import {environment} from "@environments/environment";
import {Observable} from "rxjs";
import {IResponse} from "@core/interfaces/models/IResponse";
import {ProviderRepositoryMapper} from "@core/mappers/ProviderRepositoryMapper";
import {DataFromProviderRepositoryMapper} from "@core/mappers/DataFromProviderRepositoryMapper";

@Injectable({
  providedIn: 'root'
})

export class ProviderRemoteDatasource {

  private parseDataResponseMapper = new ParseDataResponseMapper();
  private providerRepositoryMapper = new ProviderRepositoryMapper();
  private dataFromProviderRepositoryMapper = new DataFromProviderRepositoryMapper();

  private REMOTE_API_URI = environment.REMOTE_API_URI;

  constructor(
    private http: HttpClient,
  ) {
  }

  geAllFavoriteProvider(sportId?: number): Observable<IResponse> {
    let endpoint = 'common/getProveedoresFavoritos';
    if (sportId) {
      endpoint += '/' + sportId;
    }
    return this.http.get(this.REMOTE_API_URI + endpoint)
      .pipe(
        map((data: any) => {
          const response = this.parseDataResponseMapper.transform(data);
          if (response.data && Array.isArray(response.data)) {
            response.data = this.providerRepositoryMapper.transform(response.data);
          }
          return response;
        }),
        catchError(err => {
          throw 'Ocurrio un error "ProviderRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

  geAllFavoriteNearby(criteria): Observable<IResponse> {
    return this.http.post(this.REMOTE_API_URI + 'common/getProveedoresCerca', criteria)
      .pipe(
        map((data: any) => {
          const response = this.parseDataResponseMapper.transform(data);
          if (response.data && Array.isArray(response.data)) {
            response.data = this.providerRepositoryMapper.transform(response.data);
          }
          return response;
        }),
        catchError(err => {
          throw 'Ocurrio un error "ProviderRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

  getBankAccounts(): Observable<IResponse> {
    return this.http.get(this.REMOTE_API_URI + 'common/getCuentasList')
      .pipe(
        map((data: any) => {
          return this.parseDataResponseMapper.transform(data);
        }),
        catchError(err => {
          throw 'Ocurrio un error "ProviderRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

  reserveSportplatform(reservation): Observable<IResponse> {
    const {sportplatformId} = reservation;
    return this.http.post(this.REMOTE_API_URI + 'reserva/registrar/' + sportplatformId, reservation)
      .pipe(
        map((data: any) => {
          return this.parseDataResponseMapper.transform(data);
        }),
        catchError(err => {
          throw 'Ocurrio un error "ProviderRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

  cancelReservationSportplatform(reservation): Observable<IResponse> {
    const {reservation_id} = reservation;
    return this.http.post(this.REMOTE_API_URI + 'reserva/rechazar/' + reservation_id, reservation)
      .pipe(
        map((data: any) => {
          return this.parseDataResponseMapper.transform(data);
        }),
        catchError(err => {
          throw 'Ocurrio un error "ProviderRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

  dataFromProvider(providerId): Observable<IResponse> {
    return this.http.get(this.REMOTE_API_URI + 'proveedor/getInformacion/' + providerId)
      .pipe(
        map((data: any) => {
          const response = this.parseDataResponseMapper.transform(data);
          if (response.data) {
            response.data = this.dataFromProviderRepositoryMapper.transform(response.data);
          }
          return response;
        }),
        catchError(err => {
          throw 'Ocurrio un error "ProviderRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

  markLikeFavorite(providerId): Observable<IResponse> {
    return this.http.get(this.REMOTE_API_URI + 'proveedor/esFavorito/' + providerId)
      .pipe(
        map((data: any) => {
          return this.parseDataResponseMapper.transform(data);
        }),
        catchError(err => {
          throw 'Ocurrio un error "ProviderRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

  getSupportList(): Observable<IResponse> {
    return this.http.get(this.REMOTE_API_URI + 'common/getSupportList')
      .pipe(
        map((data: any) => {
          return this.parseDataResponseMapper.transform(data);
        }),
        catchError(err => {
          throw 'Ocurrio un error "ProviderRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

}
