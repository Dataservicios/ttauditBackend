<?php
namespace Auditor\Repositories;

use Auditor\Entities\ProjectionSale;


class ProjectionSaleRepo extends BaseRepo{

    public function getModel()
    {
        return new ProjectionSale;
    }


    public function getPricesForProduct($product_id,$company_id)
    {
        if ($product_id<>'0')
        {
            $detailResult = \DB::table('projection_sales')->join('users','projection_sales.provider_id','=','users.id')->select('projection_sales.id', 'projection_sales.product_id','projection_sales.provider_id','users.fullname','projection_sales.quantity','projection_sales.quantity1','projection_sales.price','projection_sales.created_at','projection_sales.updated_at')->where('projection_sales.product_id', $product_id)->where('projection_sales.company_id', $company_id)->where('list_prices',1)->get();
        }else{
            $detailResult = \DB::table('projection_sales')->join('users','projection_sales.provider_id','=','users.id')->select('projection_sales.id', 'projection_sales.product_id','projection_sales.provider_id','users.fullname','projection_sales.quantity','projection_sales.quantity1','projection_sales.price','projection_sales.created_at','projection_sales.updated_at')->where('projection_sales.company_id', $company_id)->where('list_prices',1)->get();
        }

        return $detailResult;
    }

    public function getCodProductForProvider($company_id,$provider_id,$product_id)
    {
        $detailResult = \DB::table('projection_sales')->where('projection_sales.company_id', $company_id)->where('list_prices',1)->where('projection_sales.provider_id', $provider_id)->where('projection_sales.product_id', $product_id)->first();
        return $detailResult;
    }

} 