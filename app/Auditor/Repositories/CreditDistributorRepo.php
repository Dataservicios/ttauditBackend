<?php
namespace Auditor\Repositories;

use Auditor\Entities\CreditDistributor;


class CreditDistributorRepo extends BaseRepo{

    public function getModel()
    {
        return new CreditDistributor;
    }


    public function updateInsertCreditDistributor(CreditDistributor $creditDistributor)
    {
        $regCreditDistributor = CreditDistributor::where('store_id', $creditDistributor->store_id)->where('user_id',$creditDistributor->user_id)->first();
        if (count($regCreditDistributor)==0)
        {
            $creditDistributor->save();
            return $creditDistributor->id;
        }else{
            $regCreditDistributor->linea= $creditDistributor->linea;
            $regCreditDistributor->plazo= $creditDistributor->plazo;
            $regCreditDistributor->save();
            return $regCreditDistributor->id;
        }
    }

    public function listCreditDistributor($store_id)
    {
        $regs = CreditDistributor::where('store_id',$store_id)->get();
        return $regs;
    }
} 