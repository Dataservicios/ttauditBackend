<?php

use Auditor\Repositories\CustomerRepo;
use Auditor\Repositories\CompanyRepo;
use Auditor\Repositories\VisitorRepo;
use Auditor\Repositories\ProductDetailRepo;
use Auditor\Repositories\StoreRepo;
use Auditor\Repositories\PollRepo;
use Auditor\Repositories\PollOptionDetailRepo;
use Auditor\Repositories\PollOptionRepo;
use Auditor\Repositories\CompanyStoreRepo;
use Auditor\Repositories\PollDetailRepo;
use Auditor\Repositories\ProductRepo;
use Illuminate\Support\Collection;

class HistoryPricesAndFashionController extends BaseController{

    protected $customerRepo;
    protected $companyRepo;
    protected $visitorRepo;
    protected $productDetailRepo;
    protected $storeRepo;
    protected $pollRepo;
    protected $pollOptionDetailRepo;
    protected $pollOptionRepo;
    protected $companyStoreRepo;
    protected $pollDetailRepo;
    protected $productRepo;

    public $urlBase;
    public $urlImagesPublicities;
    public $urlImagesProducts;
    public $urlImages;
    public $urlImageBase;
    public $pollArray;
    public $estudio;
    public $customer_id;


    public function __construct(ProductRepo $productRepo,PollDetailRepo $pollDetailRepo,CompanyStoreRepo $companyStoreRepo,PollOptionRepo $pollOptionRepo,PollOptionDetailRepo $pollOptionDetailRepo,PollRepo $pollRepo,StoreRepo $storeRepo,ProductDetailRepo $productDetailRepo,VisitorRepo $visitorRepo,CustomerRepo $customerRepo,CompanyRepo $companyRepo)
    {
        $this->customerRepo = $customerRepo;
        $this->companyRepo = $companyRepo;
        $this->visitorRepo = $visitorRepo;
        $this->productDetailRepo = $productDetailRepo;
        $this->storeRepo = $storeRepo;
        $this->pollRepo = $pollRepo;
        $this->pollOptionDetailRepo = $pollOptionDetailRepo;
        $this->pollOptionRepo = $pollOptionRepo;
        $this->companyStoreRepo = $companyStoreRepo;
        $this->pollDetailRepo = $pollDetailRepo;
        $this->productRepo = $productRepo;

        $this->urlBase = \App::make('url')->to('/');
        $this->urlImages = '/media/fotos/';
        $this->urlImageBase = '/media/images/';
        $this->urlImagesProducts = '/media/images/bayer/products/';
        $this->customer_id = 5;

        $this->estudio='2';
        $this->saveSessions();
    }


    public function getColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    public function getAjaxHistoryPrices($companies="0",$canal="0",$cliente="0",$ciudad="0",$ejecutivo="0",$ajax="0")
    {
        $valoresPost= Input::all();
        $companies = $valoresPost['companies'];
        if ($companies<>"0"){
            $companiesLink = explode('|',$companies);
        }else{
            $companies = $this->companyRepo->getCompaniesForClient($this->customer_id,"1",$this->estudio);
            foreach ($companies as $company) {
                $companiesLink[] = $company->id;
            }
        }
        $chanel = $valoresPost['chanel'];
        $client = $valoresPost['client'];
        $category_product_id = $valoresPost['category_product_id'];
        $product_id = $valoresPost['product_id'];
        if (($product_id<>"0") and ($product_id<>"")){
            $productsFilter = explode('|',$product_id);
            $productsFilter = array_diff($productsFilter, array(""));
        }else{
            $productsFilter=[];
        }
        $pollsWeb =$this->getAllPollsWeb($this->customer_id,$this->estudio);

        //$companiesLink = array_diff($companiesLink, array($lastCompany_id));
        sort($companiesLink);//Invierte todos las campañas seleccionadas de menor a mayor incluyendo la campaña mas actual analizada al inicio
        if (count($companiesLink)>0)
        {
            $categories = $this->productRepo->getProductForCategory($category_product_id);
            foreach ($companiesLink as $companie) {
                $swRankingEncontrado=0;
                foreach ($pollsWeb as $poll) {
                    if (($poll['company_id']==$companie) and ($poll['identificador'] == 'precio')){
                        $poll_id_company=$poll['poll_id'];
                    }
                }
                //$categories = $this->productDetailRepo->getProductsForCategory($companie,$category_product_id);dd($categories);

                /*if ($companie==93){
                    $temporal=$categories->toArray();
                }
                if ($companie==98){
                    dd($temporal,$categories->toArray());
                }*/
                if (count($categories)>0) {
                    $value_products = '';
                    $c = 0;
                    if (count($productsFilter)>0){
                        foreach ($productsFilter as $productId) {
                            $c=$c+1;
                            if ($c==count($productsFilter)){
                                $value_products .=$productId;
                            }else{
                                $value_products .=$productId.",";
                            }
                        }
                    }else{
                        foreach ($categories as $producto) {
                            $c=$c+1;
                            if ($c==count($categories)){
                                $value_products .=$producto->id;
                            }else{
                                $value_products .=$producto->id.",";
                            }
                        }
                    }
                    /*if ($companie==98){
                        dd(count($value_products),$value_products);
                    }*/

                    $totalBase = $this->companyStoreRepo->getCountPDV($companie,$chanel,$client);
                    $totalBase = count($totalBase);
                    /*if ($companie==98){
                        dd($companie,$poll_id_company,$value_products,$chanel,$client,$category_product_id);
                    }*/

                    $regs = $this->pollDetailRepo->detailsResponseComment($companie,$poll_id_company,"0",$value_products,$chanel,$client,"0",$category_product_id);
                    //                             detailsResponseComment($company_id, $poll_id, $publicity_id="0", $product_id="0", $typeStore="0", $cadena="0", $ubigeo="0",$category_product_id="0")
                    $total_muestra = count($regs);
                    /*if ($companie==93){
                        $temporal1=$regs;
                    }
                    */
                    /*if ($companie==98){
                        dd(count($regs));
                    }*/
                    $products = $regs->groupBy(function($item){ return $item->product_id; });
                    /*if ($companie==93){
                        $temporal1=$products;
                    }*/

                    $products_id = explode(',', $value_products);$c=0;
                    /*if ($companie==93){
                        dd($products_id,$products);
                    }*/
                    foreach ($products_id as $product) {
                        foreach ($products as $index => $reg) {
                            if ((integer)$product==$index){
                                $objProduct = $this->productRepo->find($index);
                                $regCollection=Collection::make($reg);
                                $cantPricesForProduct = $regCollection->count();
                                $totalVolume = $regCollection->sum(function ($re) {
                                    return $re->comentario;
                                });
                                $promedio = round($totalVolume/$cantPricesForProduct,2);
                                $comp[] = array('cantidad' => $promedio, 'nombre' => $objProduct->fullname, 'company_id' => $companie,'product_id' => (integer)$index);
                                /*if ($companie==93){
                                    dd($comp);
                                }*/
                                break;
                            }else{
                                foreach ($comp as $item) {
                                    if (($item['company_id']==$companie) and ($item['product_id']==(integer)$product)){
                                        $c=$c+1;
                                    }
                                    if (($item['company_id']==$companie) and ($item['product_id']==$index)){
                                        $c=$c+1;
                                    }
                                }
                                if ($c==0){
                                    $objProduct = $this->productRepo->find($product);
                                    $comp[] = array('cantidad' => 0, 'nombre' => $objProduct->fullname, 'company_id' => $companie,'product_id' => (integer)$product);
                                    break;
                                }
                                $c=0;
                            }
                        }
                    }
                    foreach ($comp as $item) {
                        if ($item['company_id']==$companie){
                            $acumProductId[]=$item['product_id'];
                        }
                    }
                    $resultado = array_diff($products_id, $acumProductId);
                    if (count($resultado)>0){
                        foreach ($resultado as $item) {
                            $objProduct = $this->productRepo->find($item);
                            $comp[] = array('cantidad' => 0, 'nombre' => $objProduct->fullname, 'company_id' => $companie,'product_id' => (integer)$item);
                        }
                    }
                    unset($products_id);
                    /*if ($companie==93){
                        dd($comp);
                    }*/
                }


            }
        }

        if (count($comp)>0){
            $cont=0;$acumulado=0;

            foreach ($comp as $item) {
                $cont=$cont+1;
                if ($cont==1){
                    $v1 = $item['company_id'];
                }
                if ($v1==$item['company_id']){

                }else{
                    $acumulado=0;$v1=$item['company_id'];
                }
                $acumulado = $acumulado + $item['cantidad'];
                $restringeCampaigne[$item['company_id']] = $acumulado;

            }

            $v1='';
            foreach ($comp as $item) {
                if ($v1<>$item['company_id'])
                {
                    if ($restringeCampaigne[$item['company_id']]>0){
                        $compaigne[] = $item['company_id'];
                        $v1=$item['company_id'];
                    }

                }
            }
            foreach ($compaigne as $campaigne_id)
            {
                $company_data = $this->companyRepo->find($campaigne_id);
                $c=0;$nameComp="";$c=0;
                foreach ($comp as $item) {
                    if ($company_data->id == $item['company_id'])
                    {
                        $c=$c+1;
                        $coincidencias[$item['company_id']]=$c;
                    }else{

                    }
                }
                $c=0;
                /*if ($campaigne_id==98){
                    dd($coincidencias);
                }*/
                foreach ($comp as $item) {
                    if ($company_data->id == $item['company_id'])
                    {
                        $qComp[] =  $item['cantidad'];$c=$c+1;
                        if ($c == $coincidencias[$item['company_id']]){
                            $nameComp .= $item['nombre'];
                        }else{
                            $nameComp .= $item['nombre'].",";
                        }
                        $otrito[] = array('company'=>$item['company_id'],'nombre'=>$item['nombre'],'cantidad'=>$item['cantidad']);
                    }
                }


                if (count($qComp)>0)
                {
                    $estudio = str_replace("Estudio ", "", $company_data->fullname);
                    $data = ["estudio" => $estudio];$c=0;$color="";
                    foreach ($qComp as $item) {
                        //$prom1 = ($item/$total)*100;
                        if ($c == $coincidencias[$campaigne_id])
                        {
                            $color .= $this->getColor();
                        }else{
                            $color .= $this->getColor().',';
                        }
                        if ($item<>0){
                            $data1 = ['competencia'.$c => $item];
                            $data = array_merge($data,$data1);
                        }

                        $c=$c+1;
                    }
                    $data3 = ['competencias' => $c];
                    $data = array_merge($data,$data3);
                    $data2 =["names" => $nameComp,"color" => $color];
                    $data = array_merge($data,$data2);unset($data1);unset($data2);unset($qComp);
                    $dataNew[] = $data;unset($data);
                }
            }

        }else{
            $dataNew=[];
        }

        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return Response::json([ 'ranking'=> '','results' => $dataNew,'totalAbiertos'=>'']);
        //return Response::json($dataNew);
    }


    public function homeHistoryAverageAndFashion()
    {
        $titulo='Histórico Levantamiento de Precios y Moda';
        $customer =$this->customerRepo->find($this->customer_id);//dd($customer);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $objCompany = $this->companyRepo->getFirstCurrentCampaigns($this->customer_id,$this->estudio);
        $company_id = $objCompany->id;
        $urlBase = $this->urlBase;
        $menu="historicoPrecios";

        $getCompaignes = $this->companyRepo->getCompaniesForClient($customer->id,"1",$this->estudio);$valCampaignes="";
        foreach ($getCompaignes as $getCompaigne) {
            $arrayCampaines[]= $getCompaigne->id;
            $valCampaignes .=$getCompaigne->id."|";
        }
        //30|33|35|39|41|44|60|65|70|73|78|88|
        $typeStores = $this->storeRepo->getTypeStoreForCampaigne($company_id,1);
        $types = array(0 => "Seleccionar Canal") + $typeStores->lists('type','type');

        return View::make('report/bayer/mercaderismoHistoyPrices',compact('menu','valCampaignes','titulo','logo','company_id','urlBase','types'));
    }

}