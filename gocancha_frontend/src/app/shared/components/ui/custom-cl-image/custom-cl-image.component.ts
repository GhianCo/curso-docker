import { ChangeDetectionStrategy, ChangeDetectorRef, Component, EventEmitter, Input, Output } from '@angular/core';
import { Filesystem, Directory } from '@capacitor/filesystem';
import { FileUtils } from '@shared/utils/fileUtils';

const CACHE_FOLDER = 'CACHED-IMG';

@Component({
  selector: 'app-custom-cl-image',
  templateUrl: './custom-cl-image.component.html',
  styleUrls: ['./custom-cl-image.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush
})

export class CustomClImageComponent {

  @Input() spinner = true;

  _src = '';
  public _class = '';
  @Output() action: EventEmitter<any> = new EventEmitter<any>();

  @Input() set classImg(_class: string) {
    this._class = _class;
  }

  constructor(
    private changeDetectorRef: ChangeDetectorRef
  ) {
  }

  @Input()
  set publicId(publicId: string) {
    const imageName = publicId.split('/').pop();
    Filesystem.readFile({
      directory: Directory.Cache,
      path: `${CACHE_FOLDER}/${imageName}`
    }).then(readFile => {
      if (readFile.data.includes('data')) {
        this._src = `assets/images/defaultImage.png`;
      } else {
        this._src = `data:image/webp;base64,${readFile.data}`;
      }
      this.changeDetectorRef.markForCheck();
    }).catch(async _ => {
      await FileUtils.storeImageCloudinary(publicId, imageName);
      Filesystem.readFile({
        directory: Directory.Cache,
        path: `${CACHE_FOLDER}/${imageName}`
      }).then(readFile => {
        this._src = `data:image/webp;base64,${readFile.data}`;
        this.changeDetectorRef.markForCheck();
      })
    })
  };

  public actionEmit() {
    this.action.emit();
  }

}
