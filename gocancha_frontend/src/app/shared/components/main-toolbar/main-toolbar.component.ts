import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ModalController } from "@ionic/angular";
import { AuthenticationStateFacade } from "@core/facades/stores/AuthStoreFacade";
import { Observable, Subject } from "rxjs";
import { FinderAddress } from "@shared/components/modals/finder-address/finder-address";
import { filter, takeUntil, tap } from 'rxjs/operators';
import { Dialog } from '@capacitor/dialog';

@Component({
  selector: 'app-main-toolbar',
  templateUrl: './main-toolbar.component.html',
  styleUrls: ['./main-toolbar.component.scss']
})

export class MainToolbarComponent implements OnInit {
  private unsubscribe$ = new Subject<void>();

  @Input() title: string;
  @Input() showGoToFindersAddress: boolean;
  @Input() showSignOut = false;
  @Output() showModalFilters: EventEmitter<any> = new EventEmitter<any>();
  @Output() showFindersAddress: EventEmitter<any> = new EventEmitter<any>();
  @Output() changeCoordsEvent: EventEmitter<any> = new EventEmitter<any>();

  public currentAddress$: Observable<string> = this.authenticationStateFacade.currentAddress$;

  constructor(
    public route: ActivatedRoute,
    private authenticationStateFacade: AuthenticationStateFacade,
    private modalController: ModalController,
  ) {
  }

  ngOnInit() {
    this.authenticationStateFacade.currentCoords$.pipe(
      takeUntil(this.unsubscribe$),
      filter(currentCoords => currentCoords),
      tap(currentCoords => {
        this.changeCoordsEvent.emit(currentCoords);
      })
    ).subscribe();
  }

  public async logOut() {
    const confirm = await Dialog.confirm({
      title: 'Confirmación',
      message: '¿Está seguro de querer salir de GoCancha?',
      okButtonTitle: 'Si, salir',
      cancelButtonTitle: 'No'
    });

    if (confirm.value === true) {
      await this.authenticationStateFacade.loadSignOut();
    }
  }

  public async goToFindersAddress() {
    const modal = await this.modalController.create({
      component: FinderAddress
    });

    modal.onWillDismiss().then((response) => {

    });

    return await modal.present();
  }

}
