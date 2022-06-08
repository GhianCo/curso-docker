import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {SigninPage} from './login/signin/signin.page';
import {ReactiveFormsModule} from '@angular/forms';
import {IonicModule} from '@ionic/angular';
import {FontAwesomeModule} from '@fortawesome/angular-fontawesome';
import {AuthRoute} from './auth.route';

@NgModule({
  declarations: [
    SigninPage,
  ],
  imports: [
    CommonModule,
    AuthRoute,
    ReactiveFormsModule,
    IonicModule,
    FontAwesomeModule,
  ]
})
export class AuthModule {
}
