<?php

use Auditor\Repositories\CategoryProductRepo;

class ProductsController extends BaseController
{

    protected $categoryProductRepo;

    public $urlBase;
    public $urlImages;
    public $urlPhotos;

    public function __construct(CategoryProductRepo $categoryProductRepo)
    {
        $this->categoryProductRepo = $categoryProductRepo;

        $this->urlBase = \App::make('url')->to('/');
        $this->urlImages = '/media/images/';
        $this->urlPhotos = '/media/fotos/';
    }

    public function getCategoryProductsOsaCP($company_id="0"){
        if ($company_id=="0"){
            $valoresPost= Input::all();
            $company_id = $valoresPost['company_id'];
        }

        $regsCategoryProducts = $this->categoryProductRepo->getCatMaterialsForCustomer(4,0,$company_id,141);

        header('Access-Control-Allow-Origin: *');
        return Response::json([ 'success'=> 1, 'categories' => $regsCategoryProducts]);

    }

} 