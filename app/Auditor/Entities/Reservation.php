<?php
namespace Auditor\Entities;
class Reservation extends \Eloquent {
	protected $fillable = ['company_id','store_id','statu_id','service_id','user_id','priority',
        'comment','date_creation'];
    protected $table = 'reservations';
}