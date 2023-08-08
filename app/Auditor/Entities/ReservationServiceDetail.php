<?php
namespace Auditor\Entities;
class ReservationServiceDetail extends \Eloquent {
    protected $table = 'reservation_service_details';
    protected $fillable = ['reservation_id','service_detail_id'];
}