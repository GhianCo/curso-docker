import {ChangeDetectionStrategy, ChangeDetectorRef, Component, Input} from '@angular/core';
import {UtilityService} from '@shared/utils/utility.service';

@Component({
  selector: 'app-cached-image',
  templateUrl: './cached-image.component.html',
  styleUrls: ['./cached-image.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush
})

export class CachedImageComponent {

  public _src = '';
  public _class = 'rounded';
  @Input() spinner = true;
  @Input() width = 30;
  @Input() height = 30;
  @Input() resolution = 'h_120,w_120';

  @Input() set src(imageUrl: string) {
    if (imageUrl && imageUrl != '') {
      this._src = UtilityService.obtenerCDNBaseImagen(imageUrl, this.resolution);
    } else {
      this._src = 'assets/images/default_product.png';
      this.changeDetectorRef.markForCheck();
    }
  }


  @Input() set classImg(_class: string) {
    this._class = _class;
  }

  constructor(
    private changeDetectorRef: ChangeDetectorRef
  ) {
  }

}
