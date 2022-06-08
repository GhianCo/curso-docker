import {MainMapper} from './MainMapper';
import {PARAM} from "app/global/constants";
import { IProvider } from '@core/interfaces/models/IProvider';

export class DataFromProviderRepositoryMapper extends MainMapper<any, IProvider> {
  protected map(provider: any): IProvider {
    let provider_isActive = true;
    let provider_isFavorite = true;
    let caracteristicaList = [];
    if (provider.proveedor_estado) {
      provider_isActive = provider.proveedor_estado == PARAM.ACTIVO;
    }
    if (provider.esfavorito) {
      provider_isFavorite = provider.esfavorito == PARAM.ACTIVO;
    }
    if (provider.caracteristicaList) {
      caracteristicaList = provider.caracteristicaList;
    }
    return {
      provider_id: provider.proveedor_id,
      provider_name: provider.proveedor_nombre,
      sport_id: provider.sport_id,
      provider_image: provider.proveedor_urllogo || null,
      provider_latitude: Number(provider.proveedor_latitud),
      provider_longitude: Number(provider.proveedor_longitud),
      provider_rating: provider.proveedor_rating,
      provider_distance: provider.distancia || null,
      provider_address: provider.direccion || null,
      provider_isFavorite,
      provider_favorite: provider.esfavorito || null,
      provider_reference: provider.referencia || null,
      provider_sport: provider.deporte || null,
      provider_sizes: provider.sizeList || [],
      provider_schedules: provider.horarioList || [],
      provider_images: provider.imagenList || [],
      provider_features: caracteristicaList,
      provider_isActive
    };
  }

}
