import { FinderAddress } from "@shared/components/modals/finder-address/finder-address";
import { PaymentOnlineReservationFinalizeModalComponent } from "@shared/components/modals/payment-online-reservation-finalize-modal/payment-online-reservation-finalize-modal.component";
import { RegisterNumberCustomerModalComponent } from "@shared/components/modals/register-number-customer-modal/register-number-customer-modal.component";
import { TimeInitalReservationModalComponent } from "@shared/components/modals/time-inital-reservation-modal/time-inital-reservation-modal.component";
import { TimeToReservationModalComponent } from "@shared/components/modals/time-to-reservation-modal/time-to-reservation-modal.component";
import { ViewfinderImageModalComponent } from "@shared/components/modals/viewfinder-image-modal/viewfinder-image-modal.component";
import { BannerComponent } from "@shared/components/ui/banner/banner.component";
import { CachedImageComponent } from "@shared/components/ui/cached-image/cached-image.component";
import { CardSportPlatformComponent } from "@shared/components/ui/card-sport-platform/card-sport-platform.component";
import { CustomClImageComponent } from "@shared/components/ui/custom-cl-image/custom-cl-image.component";
import { LeadIconComponent } from "@shared/components/ui/lead-icon/lead-icon.component";
import { LeadComponent } from "@shared/components/ui/lead/lead.component";
import { SportCenterComponent } from "@shared/components/ui/sport-center/sport-center.component";
import { MainToolbarComponent } from "@shared/components/main-toolbar/main-toolbar.component";
import { DetailSportCenterComponent } from "@shared/components/modals/detail-sport-center/detail-sport-center.component";
import { CustomDatetimeComponent } from "@shared/components/ui/custom-date-time/custom-date-time.component";

export const SHARED_COMPONENTS = [
    MainToolbarComponent,
    /**
     * Modals
     */
    FinderAddress,
    PaymentOnlineReservationFinalizeModalComponent,
    RegisterNumberCustomerModalComponent,
    TimeInitalReservationModalComponent,
    TimeToReservationModalComponent,
    ViewfinderImageModalComponent,
    DetailSportCenterComponent,
    /**
     * UI
     */
    BannerComponent,
    CachedImageComponent,
    CardSportPlatformComponent,
    CustomClImageComponent,
    LeadComponent,
    LeadIconComponent,
    SportCenterComponent,
    CustomDatetimeComponent
];
