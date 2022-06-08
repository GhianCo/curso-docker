export interface IReservation {
  reservation_id: string;
  customer_id: string;
  sportplatform_id: string;
  address_id: string;
  platform_id: string;
  reservation_date: string;
  reservation_total: string;
  reservation_hourInitial: string;
  reservation_hourEnd: string;
  reservation_isActive: boolean;
  reservation_paymentType: string;
  reservation_urlvoucher: string;
  reservation_deviceid: string;
  reservation_commission: string;
  reservation_firstorder: string;
  provider_name: string;
}
