<?php
namespace Auditor\Entities;
class CompanyStore extends \Eloquent {
	protected $fillable = [];

    public function store()
    {
        return $this->belongsto('Auditor\Entities\Store');
    }

    public function company()
    {
        return $this->belongsto('Auditor\Entities\Company');
    }

    public function scopeJoinCampaigne($query,$company_id)
    {
        if ($company_id<>"0")
        {
            $company_ids = explode(',',$company_id);
            if (count($company_ids)>1)
            {
                $query->whereIn('company_stores.company_id',explode(',' ,$company_id));
            }else{
                $query->where('company_stores.company_id',$company_id);
            }
        }
    }
    public function scopeStoreChanel($query,$chanel)
    {
        if ($chanel<>"0")
        {
            $chanels = explode(',',$chanel);
            if (count($chanels)>1)
            {
                $query->whereIn('stores.chanel',explode(',' ,$chanel));
            }else{
                $query->where('stores.chanel',$chanel);
            }
        }
    }

    public function scopeStoreClient($query,$client)
    {
        if ($client<>"0")
        {
            $clients = explode(',',$client);
            if (count($clients)>1)
            {
                $query->whereIn('stores.client',explode(',' ,$client));
            }else{
                $query->where('stores.client',$client);
            }
        }
    }

}