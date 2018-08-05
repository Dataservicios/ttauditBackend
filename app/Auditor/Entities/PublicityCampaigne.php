<?php

namespace Auditor\Entities;
class PublicityCampaigne extends \Eloquent {
	protected $fillable = [];
	protected $table = 'publicity_campaigne';

	public function publicity()
	{
		return $this->belongsto('Auditor\Entities\Publicity');
	}

    public function scopeCampaigne($query,$company_id)
    {
        $query->where('publicity_campaigne.company_id',$company_id);
    }

    public function scopeCompetencia($query,$competencia)
    {
        $query->where('publicity_campaigne.competencia',$competencia);
    }
}