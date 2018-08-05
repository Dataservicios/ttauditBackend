<?php
namespace Auditor\Entities;
class OrderDetail extends \Eloquent {
	protected $fillable = [];
    protected $table = 'order_details';

    public function Product()
    {
        return $this->belongsto('Auditor\Entities\Product');
    }

    public function Order()
    {
        return $this->belongsto('Auditor\Entities\OrderDetail');
    }
}