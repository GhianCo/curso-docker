import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-lead',
  templateUrl: './lead.component.html',
  styleUrls: ['./lead.component.scss'],
})
export class LeadComponent implements OnInit {

  @Input() icon: String = "box-open";
  @Input() title: String;

  constructor() { }

  ngOnInit() {}

}
