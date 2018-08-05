<?php
namespace Auditor\Entities;
class PollDetail extends \Eloquent {
	protected $fillable = ['poll_id','store_id','sino','options','limits','media','coment','result','limite','comentario','comentOptions','auditor'];
    protected $table = 'poll_details';


    public function poll()
    {
        return $this->belongsto('Auditor\Entities\Poll');
    }

    public function product()
    {
        return $this->belongsto('Auditor\Entities\Product');
    }

    public function publicity()
    {
        return $this->belongsto('Auditor\Entities\Publicity');
    }

    public function store()
    {
        return $this->belongsto('Auditor\Entities\Store');
    }

    public function scopeCampaigne($query,$company_id)
    {
        $query->where('poll_details.company_id',$company_id);
    }

    public function scopeResult($query,$result)
    {
        if ($result<>"T"){
            $query->where('poll_details.result',$result);
        }
    }

    public function scopePollId($query,$poll_id)
    {
        $query->where('poll_details.poll_id',$poll_id);
    }

    public function scopeStoreId($query,$store_id)
    {
        if ($store_id<>"0")
        {
            $store_ids = explode(',',$store_id);
            if (count($store_ids)>1)
            {
                $query->whereIn('poll_details.store_id',explode(',' ,$store_id));
            }else{
                $query->where('poll_details.store_id',$store_id);
            }
        }
    }

    public function scopePublicityId($query,$publicity_id)
    {
        if ($publicity_id<>"0")
        {
            $publicities = explode(',',$publicity_id);
            if (count($publicities)>1)
            {
                $query->whereIn('poll_details.publicity_id',explode(',' ,$publicity_id));
            }else{
                $query->where('poll_details.publicity_id',$publicity_id);
            }
        }

    }

    public function scopeCadenaRuc($query,$cadenaRuc)
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

    public function scopeUbigeoStore($query,$ubigeo)
    {
        if ($ubigeo<>"0")
        {
            $ubigeos = explode(',',$ubigeo);
            if (count($ubigeos)>1)
            {
                $query->whereIn('stores.ubigeo',explode(',' ,$ubigeo));
            }else{
                $query->where('stores.ubigeo',$ubigeo);
            }
        }
    }

    public function scopeProductId($query,$product_id)
    {
        if ($product_id<>"0")
        {
            $product_ids = explode(',',$product_id);
            if (count($product_ids)>1)
            {
                $query->whereIn('poll_details.product_id',explode(',' ,$product_id));
            }else{
                $query->where('poll_details.product_id',$product_id);
            }
        }

    }

    public function scopeTypeStore($query,$type)
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

    public function scopeVisitId($query,$visit_id)
    {

        if ($visit_id<>"0")
        {
            $visit_ids = explode(',',$visit_id);
            if (count($visit_ids)>1)
            {
                $query->whereIn('poll_details.visit_id',explode(',' ,$visit_id));
            }else{
                $query->where('poll_details.visit_id',$visit_id);
            }
        }
    }

    public function scopeCategoryProductId($query,$category_product_id)
    {

        if ($category_product_id<>"0")
        {
            $category_product_ids = explode(',',$category_product_id);
            if (count($category_product_ids)>1)
            {
                $query->whereIn('poll_details.category_product_id',explode(',' ,$category_product_id));
            }else{
                $query->where('poll_details.category_product_id',$category_product_id);
            }
        }
    }

    public function scopeDistrictStore($query,$district)
    {
        if ($district<>"0")
        {
            $districts = explode(',',$district);
            if (count($districts)>1)
            {
                $query->whereIn('stores.district',explode(',' ,$district));
            }else{
                $query->where('stores.district',$district);
            }
        }
    }

    public function scopeRegionStore($query,$region)
    {
        if ($region<>"0")
        {
            $regions = explode(',',$region);
            if (count($regions)>1)
            {
                $query->whereIn('stores.region',explode(',' ,$region));
            }else{
                $query->where('stores.region',$region);
            }
        }
    }

    public function scopeEjecutivoStore($query,$ejecutivo)
    {
        if ($ejecutivo<>"0")
        {
            $ejecutivos = explode(',',$ejecutivo);
            if (count($ejecutivos)>1)
            {
                $query->whereIn('stores.ejecutivo',explode(',' ,$ejecutivo));
            }else{
                $query->where('stores.ejecutivo',$ejecutivo);
            }
        }
    }

    public function scopeRubroStore($query,$rubro)
    {
        if ($rubro<>"0")
        {
            $rubros = explode(',',$rubro);
            if (count($rubros)>1)
            {
                $query->whereIn('stores.rubro',explode(',' ,$rubro));
            }else{
                $query->where('stores.rubro',$rubro);
            }
        }
    }

}