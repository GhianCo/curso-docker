import {Injectable} from '@angular/core';
import {ParseDataResponseMapper} from "@core/mappers/ParseDataResponseMapper";
import {HttpClient} from "@angular/common/http";
import {catchError, map} from "rxjs/operators";
import {environment} from "@environments/environment";
import {Observable} from "rxjs";
import {IResponse} from "@core/interfaces/models/IResponse";
import {SportplatformRepositoryMapper} from "@core/mappers/SportplatformRepositoryMapper";

@Injectable({
  providedIn: 'root'
})

export class SportplatformRemoteDatasource {

  private parseDataResponseMapper = new ParseDataResponseMapper();
  private sportplatformRepositoryMapper = new SportplatformRepositoryMapper();

  private REMOTE_API_URI = environment.REMOTE_API_URI;

  constructor(
    private http: HttpClient,
  ) {
  }

  search(criteria): Observable<IResponse> {
    return this.http.post(this.REMOTE_API_URI + 'proveedor/busquedaAvanzada', criteria)
      .pipe(
        map((data: any) => {
          const response = this.parseDataResponseMapper.transform(data);
          if (response.data && Array.isArray(response.data)) {
            response.data = this.sportplatformRepositoryMapper.transform(response.data);
          }
          return response;
        }),
        catchError(err => {
          throw 'Ocurrio un error "SportplatformRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

  getFilters(): Observable<IResponse> {
    return this.http.get(this.REMOTE_API_URI + 'cancha/getFiltrosCancha')
      .pipe(
        map((data: any) => {
          return this.parseDataResponseMapper.transform(data);
        }),
        catchError(err => {
          throw 'Ocurrio un error "SportplatformRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

  getByFilters(criteria): Observable<IResponse> {
    const {page, register} = criteria;
    return this.http.post(this.REMOTE_API_URI + 'cancha/getCanchaList/' + page + '/' + register, criteria)
      .pipe(
        map((data: any) => {
          const response = this.parseDataResponseMapper.transform(data);
          if (response.data && Array.isArray(response.data)) {
            response.data = this.sportplatformRepositoryMapper.transform(response.data);
          }
          return response;
        }),
        catchError(err => {
          throw 'Ocurrio un error "SportplatformRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

  dataFromSportplatform(sportplatformId): Observable<IResponse> {
    return this.http.get(this.REMOTE_API_URI + 'cancha/getInformacionCancha/' + sportplatformId)
      .pipe(
        map((data: any) => {
          return this.parseDataResponseMapper.transform(data);
        }),
        catchError(err => {
          throw 'Ocurrio un error "SportplatformRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

}
