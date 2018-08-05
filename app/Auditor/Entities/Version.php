<?php
namespace Auditor\Entities;
class Version extends \Eloquent {
	protected $fillable = [];
    protected $table = 'versiones';

    public function company()
    {
        return $this->belongsto('Auditor\Entities\Company');
    }
}