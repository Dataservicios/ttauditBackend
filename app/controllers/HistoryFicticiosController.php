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
use Auditor\Repositories\PublicityStoreRepo;

class HistoryFicticiosController extends BaseController{

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
    protected $publicityStoreRepo;

    public $urlBase;
    public $urlImagesPublicities;
    public $urlImagesProducts;
    public $urlImages;
    public $urlImageBase;
    public $pollArray;
    public $estudio;
    public $customer_id;


    public function __construct(PublicityStoreRepo $publicityStoreRepo,ProductRepo $productRepo,PollDetailRepo $pollDetailRepo,CompanyStoreRepo $companyStoreRepo,PollOptionRepo $pollOptionRepo,PollOptionDetailRepo $pollOptionDetailRepo,PollRepo $pollRepo,StoreRepo $storeRepo,ProductDetailRepo $productDetailRepo,VisitorRepo $visitorRepo,CustomerRepo $customerRepo,CompanyRepo $companyRepo)
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

    public function getAjaxHistoryFicticios($companies="0",$canal="0",$cliente="0",$ciudad="0",$ejecutivo="0",$ajax="0")
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

        $pollsWeb =$this->getAllPollsWeb($this->customer_id,$this->estudio);

        //$companiesLink = array_diff($companiesLink, array($lastCompany_id));
        sort($companiesLink);//Invierte todos las campañas seleccionadas de menor a mayor incluyendo la campaña mas actual analizada al inicio
        if (count($companiesLink)>0)
        {
            $colors = array('#1A8EC7','#84CFF4');
            foreach ($companiesLink as $companie) {
                $swRankingEncontrado=0;
                $company_data = $this->companyRepo->find($companie);
                foreach ($pollsWeb as $poll) {
                    if (($poll['company_id']==$companie) and ($poll['identificador'] == 'cambios')){
                        $poll_id_company=$poll['poll_id'];
                    }
                }

                //*
                $options= $this->pollOptionRepo->getOptions($poll_id_company);
                $totalOptions=0;
                $baseP = $this->publicityStoreRepo->getAllPublicitiesBayerStart($companie,562,"0",$client,$chanel);
                foreach ($options as $option) {
                    if (strtoupper(trim($option->options_abreviado))=="GANO ESPACIO"){
                        $opciones[] = array('id'=>'0','opcion' => 'Base Bayer','cantidad' => count($baseP));
                        $totalOptions = $totalOptions + count($baseP);
                        $pollOptionsDdetails = $this->pollOptionDetailRepo->getResultOption($companie,$option->id,"0",562,"0",$chanel,$client,"0");
                        $cantidad  = count($pollOptionsDdetails);
                        $textoOpcion= ucwords(trim($option->options));
                        $opciones[] = array('id'=>$option->id,'opcion' => $textoOpcion,'cantidad' => $cantidad);
                        $totalOptions = $totalOptions + $cantidad;
                    }

                }
                unset($options);
                if ($totalOptions>0)
                {
                    $c=0;
                    $opcionesTotal = array("tipo" => $company_data->fullname);$valoresOpciones0=[];

                    foreach ($opciones as $option)
                    {
                        $porc = $option['cantidad']/$totalOptions*100;
                        $opcion = array($option['opcion']=>round($porc,0));
                        $valoresOpciones0 = array_merge($valoresOpciones0,$opcion);
                        $resultados[] = array('texto'=>$option['opcion'],'cantidad'=>$option['cantidad'],'porcentaje'=>round($porc,0),'color'=>$colors[$c]);
                        $c=$c+1;
                    }
                    $textoOpciones[] = array('company_id'=>$company_data->id,'company'=>$company_data->fullname,'resultados'=>$resultados);unset($resultados);
                    $valoresOpciones[] = array_merge($opcionesTotal,$valoresOpciones0);
                    unset($opciones);unset($valoresOpciones0);
                }
                //*
            }
        }


        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return Response::json(['results' => $valoresOpciones,'textoOpciones'=>$textoOpciones,'colors'=>$colors]);
        //return Response::json($dataNew);
    }


    public function homeHistoryFicticios()
    {
        $titulo='Histórico Exhibiciones Ganadas (Ficticios)';
        $customer =$this->customerRepo->find($this->customer_id);//dd($customer);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $objCompany = $this->companyRepo->getFirstCurrentCampaigns($this->customer_id,$this->estudio);
        $company_id = $objCompany->id;
        $urlBase = $this->urlBase;
        $menu="historicoFicticios";

        $getCompaignes = $this->companyRepo->getCompaniesForClient($customer->id,"1",$this->estudio);$valCampaignes="";
        foreach ($getCompaignes as $getCompaigne) {
            $arrayCampaines[]= $getCompaigne->id;
            $valCampaignes .=$getCompaigne->id."|";
        }
        //30|33|35|39|41|44|60|65|70|73|78|88|
        $typeStores = $this->storeRepo->getTypeStoreForCampaigne($company_id,1);
        $types = array(0 => "Seleccionar Canal") + $typeStores->lists('type','type');

        return View::make('report/bayer/mercaderismoHistoryFicticios',compact('menu','valCampaignes','titulo','logo','company_id','urlBase','types'));
    }

}