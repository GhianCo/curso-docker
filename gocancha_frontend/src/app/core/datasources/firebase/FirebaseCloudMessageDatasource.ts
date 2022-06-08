import {Injectable} from '@angular/core';
import {Capacitor} from '@capacitor/core';
import {FirebaseNotificationService} from "@core/datasources/firebase/FirebaseNotificationService";

@Injectable({
  providedIn: 'root'
})

export class FirebaseCloudMessageService {
  constructor(
    private notificationService: FirebaseNotificationService,
  ) {
  }

  public async initNotifications(sesion?) {
    if (Capacitor.getPlatform() != 'web') {
      await FirebaseNotificationService.createChannelPushNotifications();
      await this.notificationService.registerPushNotifications(sesion);
    }
  }

}
