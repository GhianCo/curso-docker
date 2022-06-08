import {NgModule} from '@angular/core';
import {HomePage} from './pages/home-page/home.page';
import {HomePageRoutingModule} from './home-routing.module';
import {CountdownModule} from "ngx-countdown";
import { SearchSportCenterPage } from './pages/search-sport-center/search-sport-center.page';
import { SharedModule } from '@shared/shared.module';
import { SwipperSportsComponent } from './components/swipper/sports/swipper.sports.component';

@NgModule({
  imports: [
    SharedModule,
    HomePageRoutingModule,
    CountdownModule,
  ],
  declarations: [
    HomePage,
    SearchSportCenterPage,
    SwipperSportsComponent
  ],
  providers: []
})
export class HomeModule {
}
