<?php
namespace Auditor\Entities;
class PublicityDetail extends \Eloquent {
	protected $fillable = ['store_id','publicity_id','user_id','result','company_id','created_at'];

	public function publicity()
	{
		return $this->belongsto('Auditor\Entities\Publicity');
	}

    public function scopeCampaigne($query,$company_id)
    {
        $query->where('publicity_details.company_id',$company_id);
    }
}