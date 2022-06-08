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

export class AddressRemoteDatasource {

  private parseDataResponseMapper = new ParseDataResponseMapper();

  private REMOTE_PUBLIC_URI = environment.REMOTE_PUBLIC_URI;

  constructor(
    private http: HttpClient,
  ) {
  }

  searchAddress(address): Observable<IResponse> {
    return this.http.get(this.REMOTE_PUBLIC_URI + 'address/consultarGeolocalizacion/' + address)
      .pipe(
        map((data: any) => {
          return this.parseDataResponseMapper.transform(data);
        }),
        catchError(err => {
          throw 'Ocurrio un error "AddressRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

  coordsByPlace(placeId): Observable<IResponse> {
    return this.http.get(this.REMOTE_PUBLIC_URI + 'address/getPlaceById/' + placeId)
      .pipe(
        map((data: any) => {
          const response = this.parseDataResponseMapper.transform(data);
          if (response.data) {
            response.data.latitude = response.data.place_lat;
            response.data.longitude = response.data.place_lng;
          }
          return response;
          }),
        catchError(err => {
          throw 'Ocurrio un error "AddressRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

}
