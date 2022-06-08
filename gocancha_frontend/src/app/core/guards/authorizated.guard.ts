import {Injectable} from '@angular/core';
import {Router} from '@angular/router';
import {AppSessionLocalDatasource} from "@core/datasources/local/AppSessionLocalDatasource";

@Injectable({
  providedIn: 'root'
})
export class AuthorizatedGuard {

  constructor(
    private router: Router,
    private appSessionLocalDatasource: AppSessionLocalDatasource
  ) {
  }

  async canActivate(): Promise<boolean> {

    if (await this.appSessionLocalDatasource.hasSession()) {
      return true;
    }
    await this.router.navigateByUrl('/auth/signin');
    return false;
  }
}
