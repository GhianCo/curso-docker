import { MainMapper } from './MainMapper';
import { PARAM } from "app/global/constants";
import { IProvider } from '@core/interfaces/models/IProvider';

export class ProviderRepositoryMapper extends MainMapper<any, IProvider> {
  protected map(provider: any): IProvider {
    let provider_isActive = true;
    if (provider.proveedor_estado) {
      provider_isActive = provider.proveedor_estado == PARAM.ACTIVO;
    }
    return {
      provider_id: provider.proveedor_id,
      provider_name: provider.proveedor_nombre,
      provider_image: provider.proveedor_urllogo,
      provider_rating: provider.proveedor_rating,
      provider_distance: provider.distancia || null,
      provider_isActive
    };
  }

}
