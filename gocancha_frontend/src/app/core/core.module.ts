import { NgModule } from '@angular/core';

import { HTTP_INTERCEPTORS } from '@angular/common/http';
import { HttpTokenInterceptor } from './interceptor/interceptor.service';
import { CoreStoreModule } from '@store/core.store.module';
import { AppEffectsModule } from '@store/pages/app.effects.module';

@NgModule({
    imports: [CoreStoreModule, AppEffectsModule],
    declarations: [],
    exports: [CoreStoreModule],
    providers: [
        {
            provide: HTTP_INTERCEPTORS,
            useClass: HttpTokenInterceptor,
            multi: true
        }
    ]
})
export class CoreModule {
}
