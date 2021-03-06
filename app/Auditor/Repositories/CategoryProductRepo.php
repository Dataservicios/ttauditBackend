<?php
namespace Auditor\Repositories;
use Auditor\Entities\CategoryProduct;

class CategoryProductRepo extends BaseRepo {

    public function getModel()
    {
        return new CategoryProduct;
    }

    public function getCatMaterialsForCustomer($customer_id,$tipo=1,$company_id="0")
    {
        if ($company_id==0)
        {
            $valores = CategoryProduct::where('customer_id', $customer_id)->where('type',$tipo)->where('idpadre','<>',0)->get();
        }else{
            $valores = CategoryProduct::where('type',$tipo)->where('idpadre','<>',0)->where('company_id',$company_id)->orderBy('orden','ASC')->get();
        }

        return $valores;
    }

    public function getCategoryProductForCompany($company_id){
        $sql = "SELECT 
  `category_products`.`id`,
  `category_products`.`idpadre`,
  `category_products`.`fullname`,
  `category_products`.`type`,
  `category_products`.`customer_id`,
  `category_products`.`created_at`,
  `category_products`.`updated_at`
FROM
  `product_detail`
  INNER JOIN `products` ON (`product_detail`.`product_id` = `products`.`id`)
  INNER JOIN `category_products` ON (`products`.`category_product_id` = `category_products`.`id`)
WHERE
  `product_detail`.`company_id` = '".$company_id."' AND 
  `product_detail`.`competencia` = 0
GROUP BY
  `category_products`.`id`";

        $consulta=\DB::select($sql);
        return  $consulta;
    }

} 