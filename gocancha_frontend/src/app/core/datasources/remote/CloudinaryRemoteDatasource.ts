import {Observable} from 'rxjs';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {catchError, map} from 'rxjs/operators';
import {Injectable} from '@angular/core';
import {ParseDataResponseMapper} from '../../mappers/ParseDataResponseMapper';
import {IResponse} from '@core/interfaces/models/IResponse';
import {UtilityService} from '@shared/utils/utility.service';
import {environment} from "@environments/environment";
import {DateTimeUtils} from "@shared/utils/datetimeUtils";

@Injectable({
  providedIn: 'root'
})

export class CloudinaryRemoteDatasource {
  private parseDataResponseMapper = new ParseDataResponseMapper();

  constructor(
    private http: HttpClient,
  ) {
  }

  public uploadImage(criteria: any): Observable<IResponse> {
    const {blobData, dir} = criteria;
    const formData = new FormData();
    formData.append('file', blobData);
    formData.append('upload_preset', 'gocancha');
    formData.append('public_id', dir + '/cloud-' + UtilityService.md5(DateTimeUtils.obtenerFechaActual()) + '-normal');
    formData.append('cloud_name', environment.CDN_CLOUD_NAME_CLOUDINARY);
    return this.http.post(environment.CDN_CLOUDINARY, formData)
      .pipe(
        map(response => this.parseDataResponseMapper.transform(response)),
        catchError(err => {
          throw 'Ocurrio un error "CloudinaryRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

  public (criteria: any): Observable<IResponse> {
    const {blobData, upload_preset} = criteria;
    const formData = new FormData();
    formData.append('file', blobData);
    formData.append('upload_preset', upload_preset);
    formData.append('public_id', UtilityService.md5('gocancha') + '/cloud-' + UtilityService.md5(DateTimeUtils.obtenerFechaActual()) + '-normal');
    formData.append('cloud_name', 'restaurant-pe');
    let headers = new HttpHeaders();
    headers.append('content-Type','multipart/form-data');
    return this.http.post(environment.CDN_CLOUDINARY, formData, { headers: headers})
      .pipe(
        map(response => this.parseDataResponseMapper.transform(response)),
        catchError(err => {
          throw 'Ocurrio un error "CloudinaryRemoteDatasource" :' + JSON.stringify(err);
        })
      );
  }

}
