import {MainMapper} from './MainMapper';
import {ISportplatform} from '@core/interfaces/models/ISportplatform';
import {SPORTS_APP} from "app/global/constants";

export class SportplatformRepositoryMapper extends MainMapper<any, ISportplatform> {
  protected map(sportplatform: any): ISportplatform {
    return {
      sportplatform_id: sportplatform.cancha_id,
      sportplatform_name: sportplatform.cancha_nombre,
      provider_id: sportplatform.proveedor_id,
      provider_name: sportplatform.proveedor_nombre,
      sport_id: sportplatform.deporte_id,
      sport_nombre: sportplatform.deporte_nombre,
      sportplatform_price: sportplatform.cancha_precio,
      feature_name: sportplatform.caracteristica_nombre,
      sportplatform_type: sportplatform.cancha_tipotext,
      sportplatform_size: sportplatform.deporte_id == SPORTS_APP.FUTBOL ? sportplatform.cancha_sizetext : 'Estándar',
      sportplatform_avalible: sportplatform.cancha_disponible || 0,
      provider_rating: sportplatform.proveedor_rating ? sportplatform.proveedor_rating : null,
      provider_image: sportplatform.proveedor_urllogo ? sportplatform.proveedor_urllogo : null,
      provider_address: sportplatform.proveedor_direccion ? sportplatform.proveedor_direccion : null,
      provider_ref: sportplatform.proveedor_referencia ? sportplatform.proveedor_referencia : null,
      imagenList: sportplatform.imagenList ? sportplatform.imagenList : [],
      sportplatform_isActive: sportplatform.cancha_estado ? sportplatform.cancha_estado : true,
      sportplatform_image: sportplatform.cancha_urllogo || 'gocancha/generic/izcgf7lxvmx7aai5fm2z.png',
      provider_totalPlatforms: sportplatform.totalCanchas,
    };
  }

}
