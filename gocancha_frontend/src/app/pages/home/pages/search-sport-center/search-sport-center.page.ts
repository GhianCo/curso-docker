import {Component, OnInit, ViewChild} from '@angular/core';
import {Observable} from 'rxjs';
import {SportplatformStateFacade} from "@core/facades/stores/SportplatformStoreFacade";
import {ISportplatform} from "@core/interfaces/models/ISportplatform";
import {DetailSportCenterComponent} from "@shared/components/modals/detail-sport-center/detail-sport-center.component";
import {ModalController} from "@ionic/angular";

@Component({
  selector: 'app-search-sport-center',
  templateUrl: './search-sport-center.page.html',
  styleUrls: ['./search-sport-center.page.scss']
})

export class SearchSportCenterPage implements OnInit {

  public allSportplatform$: Observable<ISportplatform[]> = this.sportplatformStateFacade.allSportplatform$;
  public sportplatformsLoading$: Observable<boolean> = this.sportplatformStateFacade.sportplatformsLoading$;

  @ViewChild('searchProduct') searchProduct: any;

  public searchQuery = '';

  constructor(
    private sportplatformStateFacade: SportplatformStateFacade,
    private modalController: ModalController,
  ) {
  }

  ngOnInit() {
  }

  public performSearch() {

    if (this.searchQuery.length == 0) {
      return false;
    }

    const criteria = {
      query: this.searchQuery
    }

    this.sportplatformStateFacade.loadSportplatformBySearch(criteria);

  }

  public async openDetailSportCenter(provider) {
    const modal = await this.modalController.create({
      component: DetailSportCenterComponent,
      componentProps: {
        provider
      }
    });

    modal.onWillDismiss().then(_ => {

    });

    return await modal.present();
  }

  ionViewDidEnter() {
    this.searchProduct.setFocus();
  }
}
