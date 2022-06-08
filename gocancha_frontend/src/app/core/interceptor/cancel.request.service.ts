// ref: https://www.freakyjolly.com/angular-how-to-cancel-http-calls-on-router-change/#.Xs3LChMzYlV
// The CancelRequestService service will use A Subject which acts as an Observer to Observables.
import { Injectable } from '@angular/core';
import { Subject } from 'rxjs';

@Injectable()
export class CancelRequestService {

    private pendingHTTPRequests$ = new Subject<void>();

    constructor() { }

    // Cancel Pending HTTP calls
    public cancelPendingRequests() {
        this.pendingHTTPRequests$.next();
    }

    public onCancelPendingRequests() {
        return this.pendingHTTPRequests$.asObservable();
    }

}
