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

class VisibilityHistoryBayerController extends BaseController{

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

    public $urlBase;
    public $urlImagesPublicities;
    public $urlImagesProducts;
    public $urlImages;
    public $urlImageBase;
    public $pollArray;
    public $estudio;
    public $customer_id;


    public function __construct(PollDetailRepo $pollDetailRepo,CompanyStoreRepo $companyStoreRepo,PollOptionRepo $pollOptionRepo,PollOptionDetailRepo $pollOptionDetailRepo,PollRepo $pollRepo,StoreRepo $storeRepo,ProductDetailRepo $productDetailRepo,VisitorRepo $visitorRepo,CustomerRepo $customerRepo,CompanyRepo $companyRepo)
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

        $this->urlBase = \App::make('url')->to('/');
        $this->urlImages = '/media/fotos/';
        $this->urlImageBase = '/media/images/';
        $this->urlImagesProducts = '/media/images/bayer/products/';
        $this->customer_id = 5;

        $this->estudio='1';
        $this->saveSessions();
    }


    public function getColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    public function getAjaxVisibilityHistory($companies="0",$canal="0",$cliente="0",$ciudad="0",$ejecutivo="0",$ajax="0")
    {
        if ($companies=="0")
        {
            $valoresPost= Input::all();
            $companies = $valoresPost['companies'];
            $canal = $valoresPost['canal'];
            $cliente = $valoresPost['cliente'];
            $ciudad = $valoresPost['ciudad'];
            $ejecutivo = $valoresPost['ejecutivo'];
            $ajax="1";
        }
        if ($companies<>"0"){
            $companiesLink = explode('|',$companies);
        }else{
            $companies = $this->companyRepo->getCompaniesForClient($this->customer_id,"1",$this->estudio);
            foreach ($companies as $company) {
                $companiesLink[] = $company->id;
            }
        }
        if (($ciudad<>"0") and ($ciudad<>"")){
            $ciudadPrevio = explode('|',$ciudad);
            $c=0;$ciudadLink="";
            foreach ($ciudadPrevio as $itemCiudad) {
                $c=$c+1;
                if ($c==count($ciudadPrevio)){
                    $ciudadLink .= $itemCiudad;
                }else{
                    $ciudadLink .= $itemCiudad.",";
                }
            }
        }else{
            $ciudadLink="0";
        }
        if (($cliente<>"0") and ($cliente<>"")){
            $clientePrevio = explode('|',$cliente);$c=0;$clienteLink="";
            foreach ($clientePrevio as $itemCliente) {
                $c=$c+1;
                if ($c==count($clientePrevio)){
                    $clienteLink .= $itemCliente;
                }else{
                    $clienteLink .= $itemCliente.",";
                }
            }
        }else{
            $clienteLink="0";
        }

        if (($canal<>"0") and ($canal<>"")){
            $canalPrevio = explode('|',$canal);$c=0;
            foreach ($canalPrevio as $type) {
                if (strtoupper($type)=='TRADICIONAL')
                {
                    if ($clienteLink=="0")
                    {
                        $horizontal = $this->storeRepo->getHorizontalForCampaigne("0",2,$this->customer_id,$this->estudio);$canalLink="";
                        foreach ($horizontal as $itemCanal) {
                            $c=$c+1;
                            if ($c==count($horizontal)){
                                $canalLink .= $itemCanal;
                            }else{
                                $canalLink .= $itemCanal.",";
                            }
                        }
                    }else{
                        $canalLink=$clienteLink;$clienteLink="0";
                    }
                }
                if (strtoupper($type)=='MODERNO')
                {
                    $canalLink = 'CADENA';
                }

            }
        }else{
            $canalLink="0";
        }
        if (($ejecutivo<>"0") and ($ejecutivo<>"")){
            $ejecutivoPrevio = explode('|',$ejecutivo);
            $c=0;$ejecutivoLink="";
            foreach ($ejecutivoPrevio as $itemEjecutivo) {
                $c=$c+1;
                if ($c==count($ejecutivoPrevio)){
                    $ejecutivoLink .= $itemEjecutivo;
                }else{
                    $ejecutivoLink .= $itemEjecutivo.",";
                }
            }
        }else{
            $ejecutivoLink="0";
        }
        $pollsWeb =$this->getAllPollsWeb($this->customer_id,$this->estudio);

        $textoRanking="";
        //$companiesLink = array_diff($companiesLink, array($lastCompany_id));
        sort($companiesLink);//Invierte todos las campañas seleccionadas de menor a mayor incluyendo la campaña mas actual analizada al inicio
        if (count($companiesLink)>0)
        {
            foreach ($companiesLink as $companie) {
                $swRankingEncontrado=0;
                foreach ($pollsWeb as $poll) {
                    if (($poll['company_id']==$companie) and ($poll['identificador'] == 'exhibicion')){
                        $poll_id_company=$poll['poll_id'];
                    }
                }
                unset($tempOptions);
                $options_company = $this->pollOptionRepo->getOptions($poll_id_company);//opciones del company recorrido para $poll_id_company,$product_id
                if (count($options_company)>0)
                {
                    foreach ($options_company as $pollOption)
                    {
                        $totalForOption = $this->pollOptionDetailRepo->getResultOption($companie,$pollOption->id,"0","0","0",$canalLink,$clienteLink,$ciudadLink,$ejecutivoLink);
                        $tempOptions[]= $pollOption->options;
                        $comp[] = array('cantidad' => count($totalForOption), 'nombre' => $pollOption->options, 'company_id' => $companie);
                    }

                }
            }
        }
        /*if ($companie==70){
            dd($comp);
        }*/
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
                /*foreach ($pollsWeb as $pollWeb) {
                    if (($pollWeb['company_id']==$campaigne_id) and ($pollWeb['identificador']=='abiertoCerrado')){
                        $poll_abierto = $pollWeb['poll_id'];break;
                    }
                }*/
                foreach ($pollsWeb as $poll) {
                    if (($poll['company_id']==$campaigne_id) and ($poll['identificador'] == 'exhibicion')){
                        $poll_id_company=$poll['poll_id'];
                    }
                }
                $total = count($this->pollDetailRepo->detailsResponseSiNo($campaigne_id,$poll_id_company,"0",1,"0","0",$canalLink,$clienteLink,$ciudadLink));
                $PollAbiertosxCompany[]=array('campaigne'=>$company_data->fullname,'totalExhibiciones'=>$total);
                //dd($campaigne_id,$poll_id_company,$total);
                /*if ($campaigne_id==91){
                    dd($campaigne_id."-".$canalLink."-".$clienteLink."-".$ciudadLink."-".$poll_abierto."=".$total);
                }*/

                //dd($campaigne_id."-".$poll_abierto."-".$canalLink."-".$clienteLink."-".$ciudadLink."-".$total);
                //$total = array_sum($qComp);
                if (count($qComp)>0)
                {
                    $estudio = str_replace("Estudio ", "", $company_data->fullname);
                    $data = ["estudio" => $estudio];$c=0;$color="";
                    foreach ($qComp as $item) {
                        $prom1 = ($item/$total)*100;
                        if ($c == $coincidencias[$campaigne_id])
                        {
                            $color .= $this->getColor();
                        }else{
                            $color .= $this->getColor().',';
                        }
                        $data1 = ['competencia'.$c => round($prom1,0)];
                        $data = array_merge($data,$data1);
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
        $texto="";$c=0;
        foreach ($PollAbiertosxCompany as $item) {
            $c = $c+1;
            if ($c==1){
                $texto .= "Total Exhibiciones encontradas: ";
            }

            if ($c==count($PollAbiertosxCompany)){
                $texto .= $item['campaigne'] .'->'.$item['totalExhibiciones'];
            }else{
                $texto .= $item['campaigne'] .'->'.$item['totalExhibiciones']." | ";
            }

        }
        //$dataNew = array_reverse($dataNew);
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return Response::json([ 'ranking'=> $textoRanking,'results' => $dataNew,'totalAbiertos'=>$texto]);
        //return Response::json($dataNew);
    }


    public function visibilityHomeHistory()
    {
        $titulo='Histórico Visibilidad';
        $customer =$this->customerRepo->find($this->customer_id);//dd($customer);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $objCompany = $this->companyRepo->getFirstCurrentCampaigns($this->customer_id,$this->estudio);
        $company_id = $objCompany->id;
        $urlBase = $this->urlBase;
        $audit_id=0;
        $menus = $this->generateMenusBayer($company_id,0,11);
        $canalLink="0";
        $clienteLink="0";
        $ejecutivoLink="0";
        $ciudadLink="0";
        $subtitulo="";

        $getCompaignes = $this->companyRepo->getCompaniesForClient($customer->id,"1",$this->estudio);$valCampaignes="";
        foreach ($getCompaignes as $getCompaigne) {
            $arrayCampaines[]= $getCompaigne->id;$valCampaignes .=$getCompaigne->id."|";
        }
        //30|33|35|39|41|44|60|65|70|73|78|88|
        //$ListProducts = $this->productDetailRepo->getAllProductsForCampaigne($arrayCampaines);

        return View::make('report/bayer/visibilityHistory',compact('valCampaignes','subtitulo','ejecutivoLink','clienteLink','canalLink','ciudadLink','titulo','logo','menus','company_id','audit_id','urlBase'));
    }

} 