import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { RouterModule } from '@angular/router';

import { SHARED_COMPONENTS } from '@shared/components';
import { IonicModule } from '@ionic/angular';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { SwiperModule } from 'swiper/angular';
import { CloudinaryModule } from '@cloudinary/angular-5.x';
import { CountdownModule } from 'ngx-countdown';
import { Cloudinary } from 'cloudinary-core';
import CloudinaryConfiguration from "@cloudinary/angular-5.x/lib/cloudinary-configuration.class";
import { environment } from '@environments/environment';
import { AgmCoreModule } from '@agm/core';
@NgModule({
    imports: [
        IonicModule,
        CommonModule,
        FormsModule,
        RouterModule,
        FontAwesomeModule,
        SwiperModule,
        CloudinaryModule.forRoot({ Cloudinary }, { cloud_name: environment.CDN_CLOUD_NAME_CLOUDINARY } as CloudinaryConfiguration),
        CountdownModule,
        ReactiveFormsModule,
        AgmCoreModule,
    ],
    declarations: [...SHARED_COMPONENTS],
    exports: [
        IonicModule,
        CommonModule,
        FormsModule,
        ...SHARED_COMPONENTS,
        SwiperModule,
        CloudinaryModule,
        CountdownModule,
        FontAwesomeModule,
        ReactiveFormsModule,
    ],
    providers: []
})
export class SharedModule { }
