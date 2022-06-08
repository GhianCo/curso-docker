import { Component, EventEmitter, Input, OnInit, Output, ViewChild } from '@angular/core';
import { Capacitor } from '@capacitor/core';
import { IonDatetime } from '@ionic/angular';

@Component({
  selector: 'app-custom-date-time',
  templateUrl: './custom-date-time.component.html',
  styleUrls: ['./custom-date-time.component.scss'],
})
export class CustomDatetimeComponent implements OnInit {

  @ViewChild(IonDatetime) datetime: IonDatetime;

  @Input() trigger: string;
  @Input() date: string;
  @Input() max: string;
  @Input() min: string;

  @Output() dateChangedEvent: EventEmitter<any> = new EventEmitter<any>();

  public isIOS = Capacitor.getPlatform() == 'ios';
  
  constructor() { }

  ngOnInit() { }
  
  public dateChanged(dateSelected) {
    this.dateChangedEvent.emit(dateSelected);
  }

  public closeDatetime() {
    this.datetime.cancel(true);
  }

  public selectDate() {
    this.datetime.confirm(true);
  }

}
