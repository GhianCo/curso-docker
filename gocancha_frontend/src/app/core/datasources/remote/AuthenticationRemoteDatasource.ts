import {Injectable} from '@angular/core';
import {ParseDataResponseMapper} from "@core/mappers/ParseDataResponseMapper";
import {HttpClient} from "@angular/common/http";
import {catchError, map} from "rxjs/operators";
import {environment} from "@environments/environment";
import {Observable} from "rxjs";
import {IResponse} from "@core/interfaces/models/IResponse";

@Injectable({
  providedIn: 'root'
})

export class AuthenticationRemoteDatasource {

  private parseDataResponseMapper = new ParseDataResponseMapper();

  private REMOTE_API_URI = environment.REMOTE_API_URI;
  private REMOTE_PUBLIC_URI = environment.REMOTE_PUBLIC_URI;

  constructor(
    private http: HttpClient,
  ) {
  }

  login(criteria: any): Observable<IResponse> {
    return this.http.post(this.REMOTE_PUBLIC_URI + 'cliente/login', criteria)
      .pipe(
        map(response => this.parseDataResponseMapper.transform(response)),
        catchError(err => {
          throw 'Ocurrio un error "AuthenticationRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

  getAddressByCoords(criteria: any): Observable<IResponse> {
    const {latitude, longitude} = criteria;
    return this.http.get(this.REMOTE_PUBLIC_URI + 'address/getAddressByLocation/' + latitude + '/' + longitude)
      .pipe(
        map(response => this.parseDataResponseMapper.transform(response)),
        catchError(err => {
          throw 'Ocurrio un error "AuthenticationRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

  deleteToken(authToken: any): Observable<IResponse> {
    return this.http.get(this.REMOTE_PUBLIC_URI + 'cliente/deleteToken/' + authToken)
      .pipe(
        map(response => this.parseDataResponseMapper.transform(response)),
        catchError(err => {
          throw 'Ocurrio un error "AuthenticationRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

  updateFCM(criteria: any): Observable<IResponse> {
    return this.http.post(this.REMOTE_API_URI + 'cliente/updateFCM', criteria)
      .pipe(
        map(response => this.parseDataResponseMapper.transform(response)),
        catchError(err => {
          throw 'Ocurrio un error "AuthenticationRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

}
