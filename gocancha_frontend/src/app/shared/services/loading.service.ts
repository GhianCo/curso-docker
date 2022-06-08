import {Injectable} from '@angular/core';
import {LoadingController} from '@ionic/angular';

@Injectable({
  providedIn: 'root'
})
export class LoadingService {

  constructor(public loadingCtrl: LoadingController) {
  }

  async showLoading(titulo = 'Cargando') {
    return await this.loadingCtrl.create({
      message: titulo,
      spinner: 'circles'
    }).then(a => {
      a.present().then();
    });
  }

  async hideLoading() {
    await this.loadingCtrl.dismiss();
  }
}
