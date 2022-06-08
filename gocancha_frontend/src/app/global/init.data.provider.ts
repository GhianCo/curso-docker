import {Injectable} from '@angular/core';
import {AppSessionLocalDatasource} from "@core/datasources/local/AppSessionLocalDatasource";
import {AuthenticationStateFacade} from "@core/facades/stores/AuthStoreFacade";
import {FirebaseCloudMessageService} from "@core/datasources/firebase/FirebaseCloudMessageDatasource";

export function initDataProviderFactory(provider: any) {
  return () => provider.initializeAppData();
}

@Injectable()
export class InitDataProvider {

  constructor(
    private appSessionLocalDatasource: AppSessionLocalDatasource,
    private authenticationStateFacade: AuthenticationStateFacade,
    private firebaseCloudMessageService: FirebaseCloudMessageService,
  ) {

  }

  async initializeAppData() {
    const dataSession = await this.appSessionLocalDatasource.getDataSession();
    if (dataSession && dataSession.authToken && dataSession.authToken != '') {
      this.authenticationStateFacade.setSessionLocalstorageToStateApp(dataSession);
      await this.firebaseCloudMessageService.initNotifications();
    }
  }

}
