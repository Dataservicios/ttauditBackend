<?php
namespace Auditor\Entities;
class PollOptionDetail extends \Eloquent {
    protected $fillable = ['poll_option_id','result','otro','store_id','auditor','product_id','company_id','poll_id','category_product_id','road_id',
        'poll_detail_id'];
    protected $perPage = 15;
    protected $table = 'poll_option_details';

    public function pollOption()
    {
        return $this->belongsto('Auditor\Entities\PollOption');
    }

    public function scopeCampaigne($query,$company_id)
    {
        $query->where('poll_option_details.company_id',$company_id);
    }

    public function scopeVisitId($query,$visit_id)
    {
        if ($visit_id<>"0")
        {
            $visit_ids = explode(',',$visit_id);
            if (count($visit_ids)>1)
            {
                $query->whereIn('poll_option_details.visit_id',explode(',' ,$visit_id));
            }else{
                $query->where('poll_option_details.visit_id',$visit_id);
            }
        }
    }

    public function scopePollOptionId($query,$poll_option_id)
    {
        $query->where('poll_option_details.poll_option_id',$poll_option_id);
    }

    public function scopePublicityId($query,$publicity_id)
    {
        if ($publicity_id<>"0")
        {
            $publicities = explode(',',$publicity_id);
            if (count($publicities)>1)
            {
                $query->whereIn('poll_option_details.publicity_id',explode(',' ,$publicity_id));
            }else{
                $query->where('poll_option_details.publicity_id',$publicity_id);
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
                $query->whereIn('poll_option_details.product_id',explode(',' ,$product_id));
            }else{
                $query->where('poll_option_details.product_id',$product_id);
            }
        }
    }

    public function scopeJoinOptionProductId($query,$product_id)
    {
        if ($product_id<>"0")
        {
            $product_ids = explode(',',$product_id);
            if (count($product_ids)>1)
            {
                $query->whereIn('poll_options.product_id',explode(',' ,$product_id));
            }else{
                $query->where('poll_options.product_id',$product_id);
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

    public function scopeJoinPollId($query,$poll_id)
    {
        if ($poll_id<>"0")
        {
            $poll_ids = explode(',',$poll_id);
            if (count($poll_ids)>1)
            {
                $query->whereIn('polls.id',explode(',' ,$poll_id));
            }else{
                $query->where('polls.id',$poll_id);
            }
        }
    }

    public function scopeJoinGroupColumn($query,$group)
    {
        if ($group<>"0"){
            if ($group=='poll_options.options')
            {
                $query->groupBy('poll_options.options');
            }
        }
    }

    public function scopeJoinUbigeo($query,$ubigeo)
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

    public function scopeJoinEjecutivo($query,$ejecutivo)
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
}