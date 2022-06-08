export interface IProvider {
  provider_id: string;
  provider_name: string;
  provider_image: string;
  provider_latitude?: number;
  provider_longitude?: number;
  provider_address?: string;
  provider_reference?: string;
  provider_sport?: string;
  provider_sizes?: any[];
  provider_schedules?: any[];
  provider_images?: any[];
  provider_features?: any[];
  provider_rating: number;
  provider_distance: string;
  provider_isActive?: boolean;
  provider_isFavorite?: boolean;
  provider_favorite?: string;
  sport_id?: string;
}
