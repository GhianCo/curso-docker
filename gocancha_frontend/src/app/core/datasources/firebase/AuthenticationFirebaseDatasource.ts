import { Observable, of } from 'rxjs';
import { Injectable } from '@angular/core';
import { TypeLoginApp } from 'app/global/constants';
import { IResponse } from '@core/interfaces/models/IResponse';
import { AngularFireAuth } from "@angular/fire/auth";
import * as firebase from 'firebase/app';
import { ParseDataResponseMapper } from "@core/mappers/ParseDataResponseMapper";
import { Capacitor } from "@capacitor/core";
import { GoogleAuth } from '@codetrix-studio/capacitor-google-auth';
import { FacebookLogin } from '@capacitor-community/facebook-login';
import {
  SignInWithApple,
  SignInWithAppleOptions,
} from '@capacitor-community/apple-sign-in';

@Injectable({
  providedIn: 'root'
})

export class AuthenticationFirebaseDatasource {

  private parseDataResponseMapper = new ParseDataResponseMapper();

  constructor(
    private afAuth: AngularFireAuth,
  ) {
  }

  async login(criteria: any): Promise<any> {
    let dataSignIn = null;
    if (Capacitor.getPlatform() == 'web') {
      if (criteria == TypeLoginApp.Google) {
        dataSignIn = await this.afAuth.auth.signInWithPopup(new firebase.auth.GoogleAuthProvider());
        dataSignIn.provider = TypeLoginApp.Google;
      }
    } else {
      if (criteria == TypeLoginApp.Google) {
        dataSignIn = await GoogleAuth.signIn();
        dataSignIn.provider = TypeLoginApp.Google;
      }

      if (criteria == TypeLoginApp.Facebook) {
        await FacebookLogin.login({ permissions: ['email', 'public_profile'] });
        dataSignIn = await FacebookLogin.getProfile<{
          email: string;
          name: string;
        }>({ fields: ['email', 'name'] });
        dataSignIn.provider = TypeLoginApp.Facebook;
      }

      if (criteria == TypeLoginApp.Apple) {

        let options: SignInWithAppleOptions = {
          clientId: 'com.gocancha.app',
          redirectURI: 'https://www.gocancha.com/login',
          scopes: 'email name',
          state: '12345',
          nonce: 'nonce',
        };

        dataSignIn = (await SignInWithApple.authorize(options)).response;
        dataSignIn.provider = TypeLoginApp.Apple;
      }
    }
    return this.parseDataResponseMapper.transform(dataSignIn);
  }

  logOutSubdomain(criteria: any): Observable<IResponse> {
    return undefined;
  }

}
