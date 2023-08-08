<?php
namespace Auditor\Entities;

class Attribute extends \Eloquent {
	protected $fillable = [];
    protected $table = 'attributes';

    public function attributeDetail()
    {
        return $this->hasMany('Auditor\Entities\AttributeDetail');
    }
}