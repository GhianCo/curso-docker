import { ChangeDetectionStrategy, Component, OnInit } from '@angular/core';
import { SplashScreen } from '@capacitor/splash-screen';
import { AuthenticationStateFacade } from "@core/facades/stores/AuthStoreFacade";
import { TypeLoginApp } from "app/global/constants";
import { Capacitor } from "@capacitor/core";
import { Observable } from 'rxjs';

@Component({
  selector: 'app-signin-page',
  templateUrl: './signin.page.html',
  styleUrls: ['./signin.page.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush
})

export class SigninPage implements OnInit {

  public isApple = Capacitor.getPlatform() == 'ios';
  public isWeb = Capacitor.getPlatform() == 'web';

  public loginLoading$: Observable<boolean> = this.authenticationStoreFacade.loginLoading$;

  constructor(
    public authenticationStoreFacade: AuthenticationStateFacade,
  ) {
  }

  async ngOnInit() {
  }

  public loginWithFacebook() {
    this.authenticationStoreFacade.login(TypeLoginApp.Facebook);
  }

  public loginWithGoogle() {
    this.authenticationStoreFacade.login(TypeLoginApp.Google);
  }

  public loginWithApple() {
    this.authenticationStoreFacade.login(TypeLoginApp.Apple);
  }

  public loginWithoutAccount() {
    this.authenticationStoreFacade.loadLoginSubdomain({
      cliente_fbid: "fbid_invitado",
    });
  }

  async ionViewDidEnter() {
    await SplashScreen.hide();
  }
}
