import {Injectable} from '@angular/core';
import {Storage} from '@ionic/storage';

@Injectable({
  providedIn: 'root'
})

export class AppSessionLocalDatasource {
  constructor(
    private storage: Storage,
  ) {
  }

  async hasSession(): Promise<boolean> {
    const session = await this.storage.get('sesion') || {};
    // @ts-ignore
    return session.authToken && session.authToken != '';
  }

  async getAuthToken(): Promise<string> {
    const session = await this.storage.get('sesion') || {};
    return session.authToken && session.authToken != '' ? session.authToken : '';
  }

  async saveDataSession(session: any) {
    await this.storage.set('sesion', session);
  }

  async clearDataSession() {
    await this.storage.remove('sesion');
  }

  async getDataSession(): Promise<any> {
    const session = await this.storage.get('sesion') || {};
    return session ? session : null;
  }

  async saveCurrentSport(sport: any) {
    const session = await this.storage.get('sesion') || {};
    session.currentSport = sport;
    await this.storage.set('sesion', session);
  }

  async getSportSelected(): Promise<string> {
    const session = await this.storage.get('sesion') || {};
    return session.currentSport && session.currentSport != '' ? session.currentSport : null;
  }


}
