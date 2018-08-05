<?php
namespace Auditor\Entities;
class Store extends \Eloquent {
    protected $fillable = array('cadenaRuc','fullname','type','owner','address','urbanization','district','region','ubigeo','distributor','latitude','longitude','photo','ejecutivo','rubro');
    protected $perPage = 15;
    protected $table = 'stores';

    public function roadDetails()
    {
        return $this->hasMany('Auditor\Entities\RoadDetail');
    }

    public function companyStores()
    {
        return $this->hasMany('Auditor\Entities\CompanyStore');
    }

    public function publicitiesStore()
    {
        return $this->hasMany('Auditor\Entities\PublicityStore');
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

    public function scopeType($query,$type) //Por eliminar
    {
        if ($type<>"0")
        {
            $types = explode(',',$type);
            if (count($types)>1)
            {
                $query->whereIn('stores.type',$type);
            }else{
                $query->where('stores.type',$type);
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

}