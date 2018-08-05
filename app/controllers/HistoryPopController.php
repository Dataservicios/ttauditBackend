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
use Auditor\Repositories\PublicityRepo;
use Auditor\Repositories\RoadDetailRepo;
use Auditor\Repositories\PublicityStoreRepo;

class HistoryPopController extends BaseController{

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
    protected $publicityRepo;
    protected $roadDetailRepo;
    protected $publicityStoreRepo;

    public $urlBase;
    public $urlImagesPublicities;
    public $urlImagesProducts;
    public $urlImages;
    public $urlImageBase;
    public $pollArray;
    public $estudio;
    public $customer_id;


    public function __construct(PublicityStoreRepo $publicityStoreRepo,RoadDetailRepo $roadDetailRepo,PublicityRepo $publicityRepo,ProductRepo $productRepo,PollDetailRepo $pollDetailRepo,CompanyStoreRepo $companyStoreRepo,PollOptionRepo $pollOptionRepo,PollOptionDetailRepo $pollOptionDetailRepo,PollRepo $pollRepo,StoreRepo $storeRepo,ProductDetailRepo $productDetailRepo,VisitorRepo $visitorRepo,CustomerRepo $customerRepo,CompanyRepo $companyRepo)
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
        $this->publicityRepo = $publicityRepo;
        $this->roadDetailRepo = $roadDetailRepo;
        $this->publicityStoreRepo = $publicityStoreRepo;

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

    public function getAjaxHistoryPop($companies="0",$canal="0",$cliente="0",$ciudad="0",$ejecutivo="0",$ajax="0")
    {
        $valoresPost= Input::all();
        $pop = $valoresPost['pop'];
        $publicity = $this->publicityRepo->find($pop);
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

        $pollsWeb =$this->getAllPollsWeb($this->customer_id,$this->estudio);
        $colorEncontradoPop[0] = '#1A8EC7';
        $colorEncontradoPop[1] = '#84CFF4';
        $colorEncontradoPop[2] = '#B5E4FB';

        //$companiesLink = array_diff($companiesLink, array($lastCompany_id));
        sort($companiesLink);//Invierte todos las campañas seleccionadas de menor a mayor incluyendo la campaña mas actual analizada al inicio
        if (count($companiesLink)>0)
        {
            foreach ($companiesLink as $companie) {
                $company_data = $this->companyRepo->find($companie);
                $swRankingEncontrado=0;
                foreach ($pollsWeb as $poll) {
                    if (($poll['identificador']=='pop_encontrados') and ($poll['company_id']==$companie))
                    {
                        $pollPopEncontrado = $poll['poll_id'];
                    }
                    if (($poll['identificador']=='abierto') and ($poll['company_id']==$companie))
                    {
                        $pollAbierto = $poll['poll_id'];
                    }
                    if (($poll['identificador']=='permitio') and ($poll['company_id']==$companie))
                    {
                        $pollPermitio = $poll['poll_id'];
                    }
                    if (($poll['identificador']=='estado') and ($poll['company_id']==$companie))
                    {
                        $pollEstado = $poll['poll_id'];
                    }
                }

                $respuestaSI = $this->pollDetailRepo->detailsResponseSiNo($companie,$pollPermitio,1,1,"0","0",$chanel,$client,"0");
                $totalAbiertos = count($respuestaSI);

                $baseBayers = $this->roadDetailRepo->getStoresAudits($companie,1,1);$c=0;$baseBayer=0;
                foreach ($baseBayers as $baseBayer1) {
                    if ($baseBayer1->type<>'AASS'){
                        $baseBayer = $baseBayer+1;
                    }
                }
                //$totalBaseBayer = $this->publicityStoreRepo->getAllPublicitiesBayerStart($company_id,"0","0","0","0",1);
                $totalPdvs = $this->companyStoreRepo->getCountPDV($companie);$totalBaseBayer=0;
                foreach ($totalPdvs as $totalPdv) {
                    if ($totalPdv->type<>'AASS'){
                        $totalBaseBayer = $totalBaseBayer+1;
                    }
                }
                if ($publicity->id<>568)
                {
                    $encontrados = $this->pollDetailRepo->detailsResponseSiNo($companie,$pollPopEncontrado,1,1,$publicity->id,"0",$chanel,$client,"0");
                    $baseP = $this->publicityStoreRepo->getAllPublicitiesBayerStart($companie,$publicity->id,"0",$chanel,$client);
                    $base = count($baseP);
                    $buenEstado = $this->pollDetailRepo->detailsResponseSiNo($companie,$pollEstado,1,1,$publicity->id,"0",$chanel,$client,"0");
                    $basePrinc = $base;//Num de puntos con AASS
                    if ($basePrinc<>0){
                        $enconPorc = round(count($encontrados)/$basePrinc*100,0);
                        $buenPrinc = round(count($buenEstado)/$basePrinc*100,0);

                    }else{
                        $enconPorc=0;
                        $buenPrinc=0;
                    }

                    $detalleItems[]=array('texto'=>'Bayer','cantidad'=>$base,'porcentaje' =>100,'color'=>$colorEncontradoPop[0]);
                    $detalleItems[]=array('texto'=>'Presencia','cantidad'=>count($encontrados),'porcentaje' =>$enconPorc,'color'=>$colorEncontradoPop[1]);
                    $detalleItems[]=array('texto'=>'Buen Estado','cantidad'=>count($buenEstado),'porcentaje' =>$buenPrinc,'color'=>$colorEncontradoPop[2]);
                    $detalleEncontradosPop[] = array('tipo'=> $company_data->nameMin,'detalles'=>$detalleItems);
                    unset($detalleItems);
                    $valoresPop[] = array('tipo'=>$company_data->nameMin,'Bayer'=>100,'Presencia'=>$enconPorc,'Buen Estado'=>$buenPrinc);
                }

            }

            $valPopJson =$valoresPop;unset($valoresPop);
            $valColorEncontradosPop = $colorEncontradoPop;
        }


        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return Response::json(['results' => $valPopJson,'colors'=>$valColorEncontradosPop,'detalle'=>$detalleEncontradosPop]);
        //return Response::json($dataNew);
    }


    public function homeHistoryPop()
    {
        $titulo='Histórico Materiales POP';
        $customer =$this->customerRepo->find($this->customer_id);//dd($customer);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $objCompany = $this->companyRepo->getFirstCurrentCampaigns($this->customer_id,$this->estudio);
        $company_id = $objCompany->id;
        $urlBase = $this->urlBase;
        $menu="historicoPop";
        $category_Product_id = 65;

        $getCompaignes = $this->companyRepo->getCompaniesForClient($customer->id,"1",$this->estudio);$valCampaignes="";
        foreach ($getCompaignes as $getCompaigne) {
            $arrayCampaines[]= $getCompaigne->id;
            $valCampaignes .=$getCompaigne->id."|";
        }
        //30|33|35|39|41|44|60|65|70|73|78|88|
        $publicities = $this->publicityRepo->getPublicitiesCategory($category_Product_id);
        $new = $publicities->filter(function($album)
        {
            if (($album->id <> 568) and ($album->id <> 585) and ($album->id <> 586) and ($album->id <> 683)) {
                return true;
            }
        });
        $pops = array(0 => "Seleccionar Pop") + $new->lists('fullname','id');

        return View::make('report/bayer/mercaderismoHistoryPop',compact('menu','valCampaignes','titulo','logo','company_id','urlBase','pops'));
    }

}