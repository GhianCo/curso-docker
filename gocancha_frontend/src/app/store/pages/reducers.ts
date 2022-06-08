import { ActionReducerMap } from "@ngrx/store";

import { IAuthenticationState, auth } from '@store/pages/auth';
import { IProviderState, provider } from '@store/pages/provider';
import { ISportState, sport } from '@store/pages/sport';
import { ISportplatformState, sportplatform } from '@store/pages/sportplatform';

export interface GoCanchaCustomerState {
    auth: IAuthenticationState,
    provider: IProviderState,
    sport: ISportState,
    sportplatform: ISportplatformState
}

export let GoCanchaCustomerReducers: ActionReducerMap<GoCanchaCustomerState> = {
    auth,
    provider,
    sport,
    sportplatform
}