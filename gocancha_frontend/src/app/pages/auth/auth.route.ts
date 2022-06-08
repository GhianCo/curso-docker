import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {SigninPage} from './login/signin/signin.page';

const routes: Routes = [
  {
    path: '',
    children: [
      {
        path: 'signin',
        component: SigninPage
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AuthRoute {
}
