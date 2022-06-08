import { Component, EventEmitter, Input, Output } from '@angular/core';
import { SportStateFacade } from "@core/facades/stores/SportStoreFacade";
import { SwiperOptions } from 'swiper';
import { ISport } from '@core/interfaces/models/ISport';
import { Observable } from 'rxjs';
import { AuthenticationStateFacade } from '@core/facades/stores/AuthStoreFacade';

@Component({
  selector: 'app-swipper-sports',
  templateUrl: './swipper.sports.component.html',
  styleUrls: ['./swipper.sports.component.scss'],
})

export class SwipperSportsComponent {

  @Input() sports: ISport[]
  @Input() loading = false;

  @Output() selectSportEvent: EventEmitter<any> = new EventEmitter<any>();

  public currentSportSelected$: Observable<ISport> = this.sportStateFacade.currentSportSelected$;
  public currentCoords$: Observable<any> = this.authenticationStateFacade.currentCoords$;

  public optionsSlideSports: SwiperOptions = {
    slidesPerView: 4.5,
  };
  constructor(
    public authenticationStateFacade: AuthenticationStateFacade,
    public sportStateFacade: SportStateFacade,
  ) {
  }

  public selectCurrentSport(sport, currentSportSelected, currentCoords) {
    this.selectSportEvent.emit({
      sport,
      currentSportSelected,
      currentCoords
    });
  }

}
