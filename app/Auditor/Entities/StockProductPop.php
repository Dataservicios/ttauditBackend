<?php
namespace Auditor\Entities;
class StockProductPop extends \Eloquent {
	protected $fillable = [];
	protected $table = 'stock_product_pop';

    public function product()
    {
        return $this->belongsto('Auditor\Entities\Product');
    }
}