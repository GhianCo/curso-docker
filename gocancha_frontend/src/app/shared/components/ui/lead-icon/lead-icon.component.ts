import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-lead-icon',
  templateUrl: './lead-icon.component.html',
  styleUrls: ['./lead-icon.component.scss'],
})

export class LeadIconComponent implements OnInit {

  @Input() style: String = 'far';
  @Input() icon: String;
  public faIcon: Array<String>;

  constructor() { }

  ngOnInit() {
    this.faIcon = [this.style, this.icon];
  }

}
