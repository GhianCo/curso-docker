import { EffectsModule } from "@ngrx/effects";

import { AuthenticationEffects } from '@store/pages/auth/auth.effects';
import { ProviderEffects } from '@store/pages/provider/provider.effects';
import { SportEffects } from '@store/pages/sport/sport.effects';
import { SportplatformEffects } from '@store/pages/sportplatform/sportplatform.effects';

export const AppEffectsModule = EffectsModule.forRoot([
    AuthenticationEffects,
    ProviderEffects,
    SportEffects,
    SportplatformEffects
])