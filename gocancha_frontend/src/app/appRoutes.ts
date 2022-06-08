import { MainContentComponent } from '@core/components/main-content/main-content.component';
import { AuthorizatedGuard } from '@core/guards/authorizated.guard';
import { UnauthorizatedGuard } from '@core/guards/unauthorizated.guard';

export function allRoutesApp() {

  return [
    {
      path: 'auth',
      loadChildren: () => import('./pages/auth/auth.module').then(m => m.AuthModule),
      canActivate: [UnauthorizatedGuard]
    },
    {
      path: '',
      component: MainContentComponent,
      children: [
        {
          path: 'home',
          loadChildren: () => import('./pages/home/home.module').then(m => m.HomeModule)
        },
        {
          path: '',
          redirectTo: '/home',
          pathMatch: 'full'
        }
      ],
      canActivate: [AuthorizatedGuard]
    }
  ];
}