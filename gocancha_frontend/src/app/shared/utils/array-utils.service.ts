import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ArrayUtilsService {

  constructor() { }
  
  arrayFor(n: number): any[] {
    return Array(n);
  }
  
}
