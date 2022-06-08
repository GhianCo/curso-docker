import {Injectable} from '@angular/core';
import {ParseDataResponseMapper} from "@core/mappers/ParseDataResponseMapper";
import {HttpClient} from "@angular/common/http";
import {catchError, map} from "rxjs/operators";
import {environment} from "@environments/environment";
import {Observable} from "rxjs";
import {IResponse} from "@core/interfaces/models/IResponse";
import {SportRepositoryMapper} from "@core/mappers/SportRepositoryMapper";

@Injectable({
  providedIn: 'root'
})

export class SportRemoteDatasource {

  private parseDataResponseMapper = new ParseDataResponseMapper();
  private sportRepositoryMapper = new SportRepositoryMapper();

  private REMOTE_API_URI = environment.REMOTE_API_URI;

  constructor(
    private http: HttpClient,
  ) {
  }

  geAllSports(): Observable<IResponse> {
    return this.http.get(this.REMOTE_API_URI + 'common/getDeportes')
      .pipe(
        map((data: any) => {
          const response = this.parseDataResponseMapper.transform(data);
          if (response.data && Array.isArray(response.data)) {
            response.data = this.sportRepositoryMapper.transform(response.data);
          }
          return response;
        }),
        catchError(err => {
          throw 'Ocurrio un error "SportRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

}
