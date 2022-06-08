import {Injectable} from '@angular/core';
import {ToastController} from '@ionic/angular';

@Injectable({
  providedIn: 'root'
})
export class ToasterService {

  constructor(private toastController: ToastController) {
  }

  async presentErrorToast(message) {
    console.warn('presentErrorToast(message) is obsolete. Use presentError(message) instead.');
    await this.presentError(message);
  }

  async presentError(message) {
    const toast = await this.toastController.create({
      message,
      duration: 3000,
      color: 'danger'
    });

    toast.present();
  }

  async presentSuccess(message) {
    const toast = await this.toastController.create({
      message,
      duration: 3000,
      color: 'dark'
    });

    toast.present();
  }

  async presentNotify(message) {
    const toast = await this.toastController.create({
      message,
      duration: 3000,
      color: 'primary'
    });

    toast.present();
  }
}
