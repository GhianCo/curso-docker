export interface ISportplatform {
  sportplatform_id: string;
  sportplatform_name: string;
  provider_id: string;
  provider_name: string;
  sport_id: number;
  sport_nombre: string;
  sportplatform_price: string;
  feature_name: string;
  sportplatform_type: string;
  sportplatform_size: string;
  provider_rating?: string;
  provider_image?: string;
  provider_address?: string;
  provider_ref?: string;
  provider_totalPlatforms?: number;
  sportplatform_isActive?: boolean;
  sportplatform_image?: string;
  sportplatform_avalible?: string;
  imagenList?: any[];
}
