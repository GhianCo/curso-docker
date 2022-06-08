import {Component, OnInit} from '@angular/core';
import {Observable, Subject} from 'rxjs';
import {AuthenticationStateFacade} from "@core/facades/stores/AuthStoreFacade";
import {SportStateFacade} from "@core/facades/stores/SportStoreFacade";
import {ISport} from "@core/interfaces/models/ISport";
import {ProviderStateFacade} from "@core/facades/stores/ProviderStoreFacade";
import {IProvider} from "@core/interfaces/models/IProvider";
import {ActivatedRoute, Router} from "@angular/router";
import {SwiperOptions} from "swiper";
import {SportplatformStateFacade} from "@core/facades/stores/SportplatformStoreFacade";
import { filter, take, takeUntil, tap } from 'rxjs/operators';
import { SPORTS_APP } from 'app/global/constants';

@Component({
  selector: 'app-home-page',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss']
})

export class HomePage {
  public allSports$: Observable<ISport[]> = this.sportStateFacade.allSports$;
  public sportsLoading$: Observable<boolean> = this.sportStateFacade.sportsLoading$;

  public currentSportSelected$: Observable<ISport> = this.sportStateFacade.currentSportSelected$;
  public currentAddress$: Observable<string> = this.authenticationStateFacade.currentAddress$;
  public searchingCurrentPosition$: Observable<boolean> = this.authenticationStateFacade.searchingCurrentPosition$;

  public favoriteProviders$: Observable<IProvider[]> = this.providerStateFacade.favoriteProviders$;
  public favoriteProvidersLoading$: Observable<boolean> = this.providerStateFacade.favoriteProvidersLoading$;

  public providersNearby$: Observable<IProvider[]> = this.providerStateFacade.providersNearby$;
  public providersNearbyLoading$: Observable<boolean> = this.providerStateFacade.providersNearbyLoading$;

  public eventScrollLoadInfiniteScroll = null;

  public currentSportIdSelected: any = SPORTS_APP.FUTBOL;

  constructor(
    private authenticationStateFacade: AuthenticationStateFacade,
    public sportStateFacade: SportStateFacade,
    public providerStateFacade: ProviderStateFacade,
    private router: Router,
    private route: ActivatedRoute,
    public sportplatformStateFacade: SportplatformStateFacade,
  ) {
  }

  ionViewWillEnter() {
    this.validateChangeSportSelected();
  }

  public coordsWasChanged(currentCoords) {
    this.providerStateFacade.loadProvidersNearby(currentCoords);
    this.providerStateFacade.loadFavoriteProviders();
  }

  public async openSearchSportCenter() {
    await this.router.navigate(['search-sport-center'], {relativeTo: this.route});
  }

  public selectCurrentSport(event) {
    const {sport, currentSportSelected, currentCoords} = event;
    if (sport.sport_id == currentSportSelected.sport_id) {
      return false;
    }
    this.currentSportIdSelected = sport.sport_id;
    this.sportStateFacade.setCurrentSportNameSelected(sport.sport_name);
    this.providerStateFacade.loadProvidersNearby(currentCoords);
    this.providerStateFacade.loadFavoriteProviders(Number(sport.sport_id));
  }

  public validateChangeSportSelected() {
    const currentSportSelectedSub = this.currentSportSelected$.pipe(
      take(1),
      tap(currentSportSelected => {
        if (currentSportSelected.sport_id != this.currentSportIdSelected) {
            this.providerStateFacade.loadProvidersNearby();
            this.providerStateFacade.loadFavoriteProviders(currentSportSelected.sport_id);
        }
        this.currentSportIdSelected = currentSportSelected.sport_id;
      })
    ).subscribe();
    currentSportSelectedSub.unsubscribe();
  }
}
