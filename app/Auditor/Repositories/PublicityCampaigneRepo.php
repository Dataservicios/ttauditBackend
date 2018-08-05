<?php
namespace Auditor\Repositories;

use Auditor\Entities\PublicityCampaigne;


class PublicityCampaigneRepo extends BaseRepo{

    public function getModel()
    {
        return new PublicityCampaigne;
    }
    
    public function getPublicityForCampaigne($company_id,$type="0")
    {
        if ($type=="0")
        {
            return PublicityCampaigne::where('company_id',$company_id)->where('publicity_type_id',2)->get();
        }else{
            return PublicityCampaigne::where('company_id',$company_id)->where('publicity_type_id',$type)->get();
        }
    }

    public function getPublicitiesForCampaigne($company_id,$tipo="marca")
    {
        if ($tipo=="marca")
        {
            $publicities =  PublicityCampaigne::join('publicities','publicity_campaigne.publicity_id','=','publicities.id')->where('publicity_type_id',2)->campaigne($company_id)->competencia(0)->get();
        }
        if ($tipo=="competencia")
        {
            $publicities =  PublicityCampaigne::join('publicities','publicity_campaigne.publicity_id','=','publicities.id')->where('publicity_type_id',1)->campaigne($company_id)->competencia(1)->get();
        }
        return $publicities;
    }

} 