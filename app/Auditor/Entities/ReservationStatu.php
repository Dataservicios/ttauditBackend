<?php
namespace Auditor\Entities;
class ReservationStatu extends \Eloquent {
    protected $fillable = [
        'reservation_id',
        'statu_id',
        'user_id',
        'date_creation'
    ];
    protected $table = 'reservation_status';
}