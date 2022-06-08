import { APP_INITIALIZER, ErrorHandler, NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { PreloadAllModules, RouteReuseStrategy, RouterModule } from '@angular/router';
import { IonicModule, IonicRouteStrategy } from '@ionic/angular';
import { AppComponent } from './app.component';
import { FaIconLibrary, FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import {
 faHome,
 faCalendar,
 faHeadphones,
 faUserAlt,
 faFilter,
 faMailbox,
 faAngleDown,
 faFileSearch,
 faTimes,
 faCheck,
 faExclamationTriangle,
 faPhone
} from '@fortawesome/pro-regular-svg-icons';
import {
  faHome as fasHome,
  faCalendar as fasCalendar,
  faUserAlt as fasUserAlt
} from '@fortawesome/pro-solid-svg-icons';
import { HttpClientModule } from '@angular/common/http';
import { IonicStorageModule } from '@ionic/storage';
import { AgmCoreModule } from '@agm/core';
import { CancelRequestService } from '@core/interceptor/cancel.request.service';
import { MomentModule } from 'ngx-moment';
import { CommonModule, HashLocationStrategy, LocationStrategy } from '@angular/common';
import { environment } from '@environments/environment';

import { Market } from '@ionic-native/market/ngx';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import 'moment/locale/es';
import { InitDataProvider, initDataProviderFactory } from '@global/init.data.provider';
import { GlobalErrorHandler } from '@core/errors/global-error-handler';
import { AngularFireModule } from '@angular/fire';
import { AngularFireAuthModule } from '@angular/fire/auth';
import { AuthenticationStateFacade } from "@core/facades/stores/AuthStoreFacade";
import { AuthenticationStateNgrx } from "@store/impl/ngrx/authentication.state.ngrx";
import { SportStateFacade } from "@core/facades/stores/SportStoreFacade";
import { SportStateNgrx } from "@store/impl/ngrx/sport.state.ngrx";
import { ProviderStateFacade } from "@core/facades/stores/ProviderStoreFacade";
import { ProviderStateNgrx } from "@store/impl/ngrx/provider.state.ngrx";
import { SportplatformStateNgrx } from "@store/impl/ngrx/sportplatform.state.ngrx";
import { SportplatformStateFacade } from "@core/facades/stores/SportplatformStoreFacade";
import { allRoutesApp } from './appRoutes';
import { CORE_COMPONENTS } from '@core/components';
import { CoreModule } from '@core/core.module';

@NgModule({
  declarations: [AppComponent, ...CORE_COMPONENTS],
  imports: [
    CommonModule,
    BrowserModule,
    BrowserAnimationsModule,
    IonicModule.forRoot({
      mode: 'md'
    }),
    AgmCoreModule.forRoot({
      apiKey: environment.API_KEY_GOOGLE_MAPS,
      libraries: ['places']
    }),
    MomentModule,
    HttpClientModule,
    IonicStorageModule.forRoot(),
    AngularFireAuthModule,
    RouterModule.forRoot(allRoutesApp(), { preloadingStrategy: PreloadAllModules }),
    AngularFireModule.initializeApp(environment.firebaseConfig),
    FontAwesomeModule,
    CoreModule,
  ],
  exports: [...CORE_COMPONENTS],
  providers: [
    CancelRequestService,
    InitDataProvider,
    { provide: ErrorHandler, useClass: GlobalErrorHandler },
    { provide: LocationStrategy, useClass: HashLocationStrategy },
    { provide: RouteReuseStrategy, useClass: IonicRouteStrategy },
    { provide: APP_INITIALIZER, useFactory: initDataProviderFactory, deps: [InitDataProvider], multi: true },
    Market,
    /**
     * Dependency Inyection
     * Category
     */
    { provide: AuthenticationStateFacade, useClass: AuthenticationStateNgrx },
    { provide: SportStateFacade, useClass: SportStateNgrx },
    { provide: ProviderStateFacade, useClass: ProviderStateNgrx },
    { provide: SportplatformStateFacade, useClass: SportplatformStateNgrx },
  ],
  bootstrap: [AppComponent]
})
export class AppModule {

  constructor(library: FaIconLibrary) {
    // Add an icon to the library for convenient access in other components
    library.addIcons(
      faHome,
      fasHome,
      faCalendar,
      fasCalendar,
      faHeadphones,
      faUserAlt,
      fasUserAlt,
      faFilter,
      faMailbox,
      faAngleDown,
      faFileSearch,
      faTimes,
      faCheck,
      faExclamationTriangle,
      faPhone
    );
  }

}
