<?php
/**
 * Created by PhpStorm.
 * User: Webmaster
 * Date: 18/12/2014
 * Time: 04:24 PM
 */

namespace Auditor\Repositories;
use Auditor\Entities\ProductStoreRegion;


class ProductStoreRegionRepo extends BaseRepo{

    public function getModel()
    {
        return new ProductStoreRegion();
    }

    /*public function getProductsForCampaigne($campaigne_id)
    {
        $registros = Presence::join('products','presences.product_id','=','products.id')->select('presences.product_id', 'presences.id','products.fullname')->where('products.company_id', $campaigne_id)->get();
        return $registros;
    }*/

    public function getProductsForCampaigneForTypeStore($campaigne_id,$type)
    {
        if ($type<>""){
            $registros = ProductStoreRegion::where('company_id', $campaigne_id)->where('type', $type)->get();
        }else{
            $registros = ProductStoreRegion::where('company_id', $campaigne_id)->get();
        }

        return $registros;
    }

    public function getCategoriesProductsForCampaigneForTypeStore($campaigne_id,$type)
    {
        return $registros = ProductStoreRegion::join('products','product_store_region.product_id','=','products.id')->join('category_products','products.category_product_id','=','category_products.id')->select('product_store_region.id as product_store_region_id','product_store_region.product_id',
            'products.fullname as producto','product_store_region.type','product_store_region.company_id','products.category_product_id','category_products.fullname as categoria','category_products.id as category_product_id')->where('product_store_region.company_id', $campaigne_id)->where('product_store_region.type', $type)->groupBy('category_products.id')->get();
    }

    

} 