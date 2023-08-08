<?php
namespace Auditor\Entities;

class AttributeDetail extends \Eloquent {
	protected $fillable = [];
    protected $table = 'attribute_details';

    public function attribute()
    {
        return $this->belongsTo('Auditor\Entities\Attribute');
    }
}