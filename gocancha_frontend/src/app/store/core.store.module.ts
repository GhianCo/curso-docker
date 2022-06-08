import { NgModule } from '@angular/core';
import { environment } from '@environments/environment';
import { StoreModule } from '@ngrx/store';
import { StoreDevtoolsModule } from '@ngrx/store-devtools';

import { GoCanchaCustomerReducers } from '@store/pages/reducers';

@NgModule({
    imports: [
        StoreModule.forRoot(GoCanchaCustomerReducers),
        StoreDevtoolsModule.instrument({
            name: 'GoCanchaCustomer App DevTools',
            maxAge: 25,
            logOnly: environment.production
        }),
    ],
    declarations: [],
    exports: [],
    providers: []
})
export class CoreStoreModule { }
