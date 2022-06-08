import { Component, Input, OnInit } from '@angular/core';
import { ModalController } from '@ionic/angular';

@Component({
  selector: 'app-viewfinder-image-modal',
  templateUrl: './viewfinder-image-modal.component.html',
  styleUrls: ['./viewfinder-image-modal.component.scss'],
})

export class ViewfinderImageModalComponent implements OnInit {

  @Input() image;

  constructor(
    private modalController: ModalController,
  ) {
  }

  ngOnInit() {
  }
  public async viewed() {
    await this.modalController.dismiss();
  }
}
