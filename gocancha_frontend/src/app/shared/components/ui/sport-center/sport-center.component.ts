import {Component, OnInit, Input} from '@angular/core';
import {DetailSportCenterComponent} from "@shared/components/modals/detail-sport-center/detail-sport-center.component";
import {ModalController} from "@ionic/angular";
import {IProvider} from "@core/interfaces/models/IProvider";
import {SwiperOptions} from "swiper";

@Component({
  selector: 'app-sport-center',
  templateUrl: './sport-center.component.html',
  styleUrls: ['./sport-center.component.scss']
})
export class SportCenterComponent implements OnInit {

  @Input() providers: Array<IProvider> = [];
  @Input() showDetail = true;
  @Input() isSlider = false;
  @Input() loading = false;

  public configSlides: SwiperOptions = {
    slidesPerView: 2.5,
  };

  constructor(
    private modalController: ModalController,
  ) {
  }

  ngOnInit() {
  }

  public async openDetailSportCenter(provider) {
    const modal = await this.modalController.create({
      component: DetailSportCenterComponent,
      componentProps: {
        provider
      }
    });

    modal.onWillDismiss().then((response) => {

    });

    return await modal.present();
  }

  public async openModalReservation() {
   
  }

}
