import { MainMapper } from './MainMapper';
import { ISport } from '@core/interfaces/models/ISport';
import { PARAM } from 'app/global/constants';

export class SportRepositoryMapper extends MainMapper<any, ISport> {
  protected map(sport: any): ISport {
    return {
      sport_id: sport.deporte_id,
      sport_name: sport.deporte_nombre,
      sport_image: sport.deporte_urlimagen,
      sport_position: sport.deporte_orden,
      sport_isactive: sport.deporte_estado == PARAM.ACTIVO
    };
  }

}
