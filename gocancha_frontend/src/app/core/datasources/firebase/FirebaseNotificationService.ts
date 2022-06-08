import { Injectable } from '@angular/core';
import {
  PushNotifications,
  Token,
  Channel,
  ActionPerformed,
  PushNotificationSchema
} from '@capacitor/push-notifications';
import * as AuthUIActions from "@store/pages/auth/auth.ui.actions";
import { Store } from "@ngrx/store";
import { IAuthenticationState } from "@store/pages/auth/auth.state";
import { Router } from '@angular/router';


export const initialPushNotificationChannel: Channel = {
  description: 'Notify Reservation Reminder',
  id: 'fcm_channel_reservation_reminder',
  importance: 5,
  lights: true,
  name: 'Recordatorio de reserva',
  sound: 'default',
  vibration: true,
  visibility: 1
};

@Injectable({
  providedIn: 'root'
})

export class FirebaseNotificationService {
  constructor(
    private store$: Store<IAuthenticationState>,
    private router: Router,
  ) {
  }

  public async registerPushNotifications(sesionApp?) {

    PushNotifications.requestPermissions().then(async permission => {
      if (permission.receive == 'granted') {
        await PushNotifications.register();
      }
    });

    PushNotifications.addListener('registration', async (token: Token) => {
      const criteria = {
        token_fcm: token.value
      };
      this.store$.dispatch(AuthUIActions.updateFCMLoad({ criteria }));
    }
    );

    PushNotifications.addListener('registrationError', (error: any) => {
      console.log('GhianCo Error: ' + JSON.stringify(error));
    }
    );

    PushNotifications.addListener('pushNotificationReceived', async (notification: PushNotificationSchema) => {
    });

    PushNotifications.addListener('pushNotificationActionPerformed', async (notification: ActionPerformed) => {
      const data = notification.notification.data;
      PushNotifications.removeAllDeliveredNotifications();
      await this.router.navigate(['/profile']);
    });

  }

  public static async createChannelPushNotifications() {
    PushNotifications.createChannel(initialPushNotificationChannel).then();
  }

  public static async removeAllListeners() {
    PushNotifications.removeAllListeners();
  }

  public static async removeAllDeliveredNotifications() {
    PushNotifications.removeAllDeliveredNotifications();
  }

}
