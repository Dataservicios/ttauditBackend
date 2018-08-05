<?php
namespace Auditor\Entities;
class Order extends \Eloquent {
	protected $fillable = [];
    protected $table = 'orders';

    public function orderDetails()
    {
        return $this->hasMany('Auditor\Entities\OrderDetail');
    }

    public function provider()
    {
        return $this->belongsto('Auditor\Entities\User','provider_id');
    }

    public function auditor()
    {
        return $this->belongsto('Auditor\Entities\User','auditor_id');
    }

    public function store()
    {
        return $this->belongsto('Auditor\Entities\Store');
    }
}