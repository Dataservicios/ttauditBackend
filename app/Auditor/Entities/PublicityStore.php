<?php
namespace Auditor\Entities;
class PublicityStore extends \Eloquent {
	protected $fillable = [];
	protected $table = 'publicity_store';

	public function publicity()
	{
		return $this->belongsto('Auditor\Entities\Publicity');
	}

	public function store()
	{
		return $this->belongsto('Auditor\Entities\Store');
	}

	public function company()
	{
		return $this->belongsto('Auditor\Entities\Company');
	}

    public function scopeStoreId($query,$store_id)
    {
        if ($store_id<>"0")
        {
            $stores = explode(',',$store_id);
            if (count($stores)>1)
            {
                $query->whereIn('publicity_store.store_id',explode(',' ,$store_id));
            }else{
                $query->where('publicity_store.store_id',$store_id);
            }
        }

    }

    public function scopeVisits($query,$visit_id)
    {
        if ($visit_id<>'all'){
            $visit_ids = explode(',',$visit_id);
            if (count($visit_ids)>1)
            {
                $query->whereIn('publicity_store.visit_id',explode(',' ,$visit_id));
            }else{
                $query->where('publicity_store.visit_id',$visit_id);
            }
        }

    }

    public function scopePublicityID($query,$publicity_id)
    {
        if ($publicity_id<>"0")
        {
            $publicity_ids = explode(',',$publicity_id);
            if (count($publicity_ids)>1)
            {
                $query->whereIn('publicity_store.publicity_id',explode(',' ,$publicity_id));
            }else{
                $query->where('publicity_store.publicity_id',$publicity_id);
            }
        }
    }

    public function scopeCompanyID($query,$company_id)
    {
        $query->where('publicity_store.company_id',$company_id);
    }

    public function scopeStoreCadenaRuc($query,$cadenaRuc)
    {
        if ($cadenaRuc<>"0")
        {
            $cadenaRucs = explode(',',$cadenaRuc);
            if (count($cadenaRucs)>1)
            {
                $query->whereIn('stores.cadenaRuc',explode(',' ,$cadenaRuc));
            }else{
                $query->where('stores.cadenaRuc',$cadenaRuc);
            }
        }
    }

    public function scopeStoreType($query,$type)
    {
        if ($type<>"0")
        {
            $types = explode(',',$type);
            if (count($types)>1)
            {
                $query->whereIn('stores.type',explode(',' ,$type));
            }else{
                $query->where('stores.type',$type);
            }
        }
    }
}