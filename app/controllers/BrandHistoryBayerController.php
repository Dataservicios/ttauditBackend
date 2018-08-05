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

class BrandHistoryBayerController extends BaseController{

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

    public function homeBrandHistory(){
        $titulo='Histórico por Marcas';
        $customer =$this->customerRepo->find($this->customer_id);//dd($customer);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $objCompany = $this->companyRepo->getFirstCurrentCampaigns($this->customer_id,$this->estudio);
        $company_id = $objCompany->id;
        $urlBase = $this->urlBase;
        $audit_id=0;
        $menus = $this->generateMenusBayer($company_id,0,7);
        $ubigeoextLink="0";
        $cadenaLink="0";
        $horizontalLink="0";
        $ejecutivo_id="0";
        $subtitulo="Competencia";

        $getCompaignes = $this->companyRepo->getCompaniesForClient($customer->id,"1",$this->estudio);
        foreach ($getCompaignes as $getCompaigne) {
            $arrayCampaines[]= $getCompaigne->id;
        }
        $ListProducts = $this->productDetailRepo->getAllProductsForCampaigne($arrayCampaines);
        
        return View::make('report/bayer/brandHistory',compact('subtitulo','ejecutivo_id','horizontalLink','cadenaLink','ubigeoextLink','ListProducts','titulo','logo','menus','company_id','audit_id','urlBase'));
    }

    public function detailBrandHistory($tipo="0"){
        $study_id=$this->estudio;$customer_id=5;
        if ($tipo=="0")
        {
            $valoresPost= Input::all();

            if (count($valoresPost)<>0){
                //$ubigeoext = $valoresPost['ubigeo'];
                $cadena = $valoresPost['cadena'];
                $horizontal = $valoresPost['horizontal'];
                $company_id = $valoresPost['company_id'];
                $tipo = $valoresPost['tipo'];
            }else{
                //$ubigeoext = "0";
                $cadena = "0";
                $horizontal = "0";
                $company_id="0";
            }
        }else{
            //$ubigeoext = "0";
            $cadena = "0";
            $horizontal = "0";
            $company_id="0";
        }
        if (is_array($cadena)){
            $cadenaLink="";$c=0;
            foreach ($cadena as $item) {
                $cadenaLink .=$item;
                $c = $c+1;
                if (count($cadena) > $c)
                {
                    $cadenaLink .="|";
                }
            }
        }else{
            if ($tipo=='Moderno'){
                $cadena = $this->storeRepo->getCadenasForCampaigne($company_id,2,$customer_id,$study_id);
                $cadenaLink="";$c=0;
                if (count($cadena)>0){
                    foreach ($cadena as $item){
                        $cadenaLink .=$item;
                        $c = $c+1;
                        if (count($cadena) > $c)
                        {
                            $cadenaLink .="|";
                        }
                    }
                }else{
                    $cadenaLink='0';$cadena = "0";
                }

            }else{
                $cadenaLink="0";
            }
        }
        if (is_array($horizontal)){
            $horizontalLink="";$c=0;
            foreach ($horizontal as $item) {
                $horizontalLink .=$item;
                $c = $c+1;
                if (count($horizontal) > $c)
                {
                    $horizontalLink .="|";
                }
            }
        }else{
            if ($tipo=='Tradicional'){
                $horizontal = $this->storeRepo->getHorizontalForCampaigne($company_id,2,$customer_id,$study_id);
                $horizontalLink="";$c=0;
                if (count($horizontal)>0){
                    foreach ($horizontal as $item){
                        $horizontalLink .=$item;
                        $c = $c+1;
                        if (count($horizontal) > $c)
                        {
                            $horizontalLink .="|";
                        }
                    }
                }else{
                    $horizontalLink="0";$horizontal = "0";
                }
            }else{
                $horizontalLink="0";$horizontal = "0";
            }

        }
        if($tipo=='Tradicional'){
            $ListCadenas = [];
        }
        if ($tipo=='Moderno'){
            $ListHorizontales =[];$cat=8;
        }
        if ($tipo=='Tradicional'){
            $ListHorizontales = $this->storeRepo->getHorizontalForCampaigne(0,2,$customer_id,$study_id);$cat=9;
        }
        if ($tipo=='0'){
            $ListHorizontales = $this->storeRepo->getHorizontalForCampaigne(0,2,$customer_id,$study_id);$cat=0;
        }
        if (($tipo=='0') or ($tipo=='Moderno')){
            $ListCadenas = $this->storeRepo->getCadenasForCampaigne(0,2,$customer_id,$study_id);
            if (count($ListCadenas)==0){
                $ListCadenas=[];
            }
        }

        $titulo='Canal '.$tipo.' Histórico por Marcas';
        $customer =$this->customerRepo->find($this->customer_id);//dd($customer);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $objCompany = $this->companyRepo->getFirstCurrentCampaigns($this->customer_id,$this->estudio);
        $company_id = $objCompany->id;
        $urlBase = $this->urlBase;
        $audit_id=0;
        $menus = $this->generateMenusBayer($company_id,0,$cat);
        $ubigeoextLink="0";
        $cadenaLink="0";
        $horizontalLink="0";
        $ejecutivo_id="0";
        $subtitulo="Competencia";
        $getCompaignes = $this->companyRepo->getCompaniesForClient($customer->id,"1",$this->estudio);
        foreach ($getCompaignes as $getCompaigne) {
            $arrayCampaines[]= $getCompaigne->id;
        }
        $ListProducts = $this->productDetailRepo->getAllProductsForCampaigne($arrayCampaines);

        return View::make('report/bayer/detailBrandHistory',compact('horizontal','ListHorizontales','cadena','ListCadenas','ListProducts','subtitulo','ejecutivo_id','horizontalLink','cadenaLink','ubigeoextLink','titulo','logo','menus','company_id','audit_id','urlBase'));
    }

    public function getRecomendedForSalesForProductAll($product_id="0",$cadena="0",$horizontal="0",$ubigeoext="0",$ajax="0")
    {
        if ($product_id=="0")
        {
            $valoresPost= Input::all();
            $cadena = $valoresPost['cadena'];
            $horizontal = $valoresPost['horizontal'];
            $product_id = $valoresPost['product_id'];
            $ubigeoext = $valoresPost['ubigeoext'];
            $ajax="1";
        }
        if ($ubigeoext<>"0"){
            $ubigeoextLink = explode('|',$ubigeoext);
        }else{
            $ubigeoextLink="0";
        }
        if ($cadena<>"0"){
            $cadenaLink = explode('|',$cadena);

        }else{
            $cadenaLink="0";
        }
        if ($horizontal<>"0"){
            $horizontalLink = explode('|',$horizontal);
        }else{
            $horizontalLink="0";
        }
        $companies = $this->companyRepo->getCompaniesForClient($this->customer_id,"1",$this->estudio);

        $group_poll_id='';$c=0;
        $pollsWeb =$this->getAllPollsWeb($this->customer_id,$this->estudio);

        foreach ($companies as $company_data)
        {
            $c=$c+1;
            foreach ($pollsWeb as $pollWeb) {
                if (($pollWeb['company_id']==$company_data->id) and ($pollWeb['identificador']=='queRecomendo')){
                    if($c==count($companies))
                    {
                        $group_poll_id .= $pollWeb['poll_id'];
                    }else{
                        $group_poll_id .= $pollWeb['poll_id'].',';
                    }
                }
            }
        }
        $totalOrdenado = $this->pollOptionDetailRepo->getTotalOptionForAll($group_poll_id,'0',$product_id,$cadenaLink,"0",'0',$horizontalLink,$ubigeoextLink);//dd($horizontalLink);
        if (count($totalOrdenado)>0)
        {
            foreach ($companies as $company_data) {
                foreach ($pollsWeb as $pollWeb) {
                    if (($pollWeb['company_id'] == $company_data->id) and ($pollWeb['identificador'] == 'queRecomendo')) {
                        $poll_id = $pollWeb['poll_id'];
                    }
                }
                $idCompany = $company_data->id;
                foreach ($totalOrdenado as $valor) {
                    $nameProduct = $valor->options;
                    $valoresProduct = $this->pollOptionDetailRepo->getTotalOptionForAll($nameProduct, '0', $product_id, $cadenaLink, $poll_id, "0", $horizontalLink, $ubigeoextLink);
                    $qCompany = $valoresProduct[0]->nro;
                    $comp[] = array('cantidad' => $qCompany, 'nombre' => $nameProduct, 'company_id' => $idCompany);
                }

            }
        }
        if (count($comp)>0){
            $cont=0;$acumulado=0;
            //Obtiene array acumulado por campaña siendo el company_id el indice
            //array (size=11)
              /*41 => int 661
              44 => int 735
              60 => int 452
              65 => int 497*/
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

            //Obtiene solo los company_id que tengan cantidades mayores a 0 y el ultimo company ingresado
            /*array (size=5)
              0 => int 41
              1 => int 44
              2 => int 60
              3 => int 65
              4 => int 78*/
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
                        $c=0;
                    }
                }
                foreach ($comp as $item) {//dd($item['company_id']);
                    if ($company_data->id == $item['company_id'])
                    {
                        $qComp[] =  $item['cantidad'];$c=$c+1;
                        if ($c == $coincidencias[$item['company_id']]){
                            $nameComp .= $item['nombre'];
                        }else{
                            $nameComp .= $item['nombre'].",";
                        }
                    }
                }
                $total = array_sum($qComp);
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
        }dd($dataNew);
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return Response::json($dataNew);
    }

    public function getColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    public function getHistoryRecomendForLastCompany($companies="0",$product_id="0",$canal="0",$cliente="0",$ciudad="0",$ejecutivo="0",$ajax="0")
    {
        if ($companies=="0")
        {
            $valoresPost= Input::all();
            $companies = $valoresPost['companies'];
            $canal = $valoresPost['canal'];
            $cliente = $valoresPost['cliente'];
            $product_id = $valoresPost['product_id'];
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
        rsort($companiesLink);
        $companiesLink = array_diff($companiesLink, array(""));$totalCompanies = $companiesLink;
        //$lastCompany_id = $companiesLink[0];
        /*$lastCompany_id = array_first($companiesLink, function ($key, $value) {
            return (($value <> "") and ($value <> "0"));
        });*/
        $pollsWeb =$this->getAllPollsWeb($this->customer_id,$this->estudio);
        foreach ($companiesLink as $linkCompany) {
            foreach ($pollsWeb as $poll) {
                if (($poll['company_id']==$linkCompany) and ($poll['identificador'] == 'queRecomendo')){
                    $poll_id_last=$poll['poll_id'];
                }
            }
            //Se obtiene todas las marcas de la campaña mas reciente ya ordenadas de mayor a menor de la selección realizada para la pregunta que producto recomendo $poll_id_last
            $totalOrdenado = $this->pollOptionDetailRepo->getTotalForOptions($poll_id_last,'0',"0",$product_id, $canalLink,$clienteLink,$ciudadLink,$ejecutivoLink,'poll_options.options');
            if (count($totalOrdenado)>0){
                $lastCompany_id = $linkCompany;break;
            }else{
                $lastCompany_id="0";
            }
        }
        //$totalOrdenado = $this->pollOptionDetailRepo->getTotalOptionForAll($poll_id_last,'0',$product_id,$cadenaLink,"0",'0',$horizontalLink,$ubigeoextLink);//dd($horizontalLink);
        if (count($totalOrdenado)>0)
        {
            $objLastCampaigne = $this->companyRepo->find($lastCompany_id);$c=0;$textoRanking="Ranking Competencias : ";
            foreach ($totalOrdenado as $valor) {
                $c=$c+1;
                $nameProduct = $valor->options;
                $qCompany = $valor->nro;
                $rankingLastPeriod[] = array('campaigne' => $objLastCampaigne->fullname,'company_id' => $objLastCampaigne->id,'product_id' => $product_id,'poll_option_id' => $valor->id,'option' => $nameProduct,'quota' => $qCompany);
                $rankingoptions[] = $nameProduct;
                if ($c<=4){ //se obtiene el ranking de los 4 top de marcas de la campaña mas actual del grupo de campañas seleccionadas
                    if ($c==1){
                        $textoRanking .= $c." - ".$nameProduct." : ".$qCompany." ";
                    }else{
                        $textoRanking .= " | ".$c." - ".$nameProduct." : ".$qCompany." ";
                    }
                }
                //$comp[] = array('cantidad' => $qCompany, 'nombre' => $nameProduct, 'company_id' => $lastCompany_id);
            }
        }else{
            $textoRanking="";$rankingLastPeriod=[];
        }
        //$companiesLink = array_diff($companiesLink, array($lastCompany_id));
        sort($companiesLink);//Invierte todos las campañas seleccionadas de menor a mayor incluyendo la campaña mas actual analizada al inicio
        if (count($companiesLink)>0)
        {
            foreach ($companiesLink as $companie) {
                $swRankingEncontrado=0;
                foreach ($pollsWeb as $poll) {
                    if (($poll['company_id']==$companie) and ($poll['identificador'] == 'queRecomendo')){
                        $poll_id_company=$poll['poll_id'];
                    }
                }
                unset($tempOptions);
                $options_company = $this->pollOptionRepo->getOptions($poll_id_company,$product_id);//opciones del company recorrido para $poll_id_company,$product_id
                if (count($options_company)>0)
                {
                    if (count($rankingLastPeriod)>0){
                        foreach ($rankingLastPeriod as $rankingOption)
                        {
                            //se busca todas las marcas obtenidas de la campaña mas reciente de la selección enviada en las otras campañas
                            foreach ($options_company as $pollOption)
                            {
                                if ($rankingOption['option'] ==$pollOption->options)
                                {
                                    $totalForOption = $this->pollOptionDetailRepo->getResultOption($companie,$pollOption->id,"0","0",$product_id,$canalLink,$clienteLink,$ciudadLink,$ejecutivoLink);
                                    $tempOptions[]= $pollOption->options;
                                    $comp[] = array('cantidad' => count($totalForOption), 'nombre' => $rankingOption['option'], 'company_id' => $companie);
                                    $swRankingEncontrado=0;
                                    break;
                                }else{
                                    $swRankingEncontrado=1;
                                }
                            }
                            if ($swRankingEncontrado==1)
                            {
                                $comp[] = array('cantidad' => 0, 'nombre' => $rankingOption['option'], 'company_id' => $companie);
                                $swRankingEncontrado=0;
                            }
                        }
                        /*$optionsRests = array_diff($rankingoptions,$tempOptions);//Obtiene los options que no estaban incluido en la campaña mas actual

                        foreach ($optionsRests as $optionsRest) {
                            $comp[] = array('cantidad' => 0, 'nombre' => $optionsRest, 'company_id' => $companie);
                        }*/
                    }else{
                        $comp=[];
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
                $nameComp="";$c=0;
                foreach ($comp as $item) {
                    if ($company_data->id == $item['company_id'])
                    {
                        $c=$c+1;
                        $coincidencias[$item['company_id']]=$c;
                    }else{

                    }
                }
                $c=0;
                foreach ($comp as $item) {//dd($item['company_id']);
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
                foreach ($pollsWeb as $pollWeb) {
                    if (($pollWeb['company_id']==$campaigne_id) and ($pollWeb['identificador']=='abiertoCerrado')){
                        $poll_abierto = $pollWeb['poll_id'];
                        break;
                    }
                }
                $total = count($this->pollDetailRepo->detailsResponseSiNo($campaigne_id,$poll_abierto,"0",1,"0","0",$canalLink,$clienteLink,$ciudadLink));
                $PollAbiertosxCompany[]=array('campaigne'=>$company_data->fullname,'totalAbiertos'=>$total);
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

                        if ($prom1>0.5){
                            $data1 = ['competencia'.$c => round($prom1,0)];
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
        $texto="";$c=0;
        foreach ($PollAbiertosxCompany as $item) {
            $c = $c+1;
            if ($c==1){
                $texto .= "PUNTOS ABIERTOS: <br>";
            }

            if ($c==count($PollAbiertosxCompany)){
                $texto .= $item['campaigne'] .'->'.$item['totalAbiertos'];
            }else{
                $texto .= $item['campaigne'] .'->'.$item['totalAbiertos']." | ";
            }

        }
        //$dataNew = array_reverse($dataNew);
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return Response::json([ 'ranking'=> $textoRanking,'results' => $dataNew,'totalAbiertos'=>$texto]);
        //return Response::json($dataNew);
    }

    public function getCompaniesBayer()
    {
        $campaignesClient = $this->companyRepo->getCompaniesForClient($this->customer_id,1,$this->estudio);
        foreach ($campaignesClient as $campaigne) {
            $cities =$this->companyStoreRepo->getCityForCampaigne($campaigne->id);
            foreach ($cities as $city) {
                $cityFilter[] = array('fullname' => $city->ubigeo);
            }
            $cadenas = $this->companyStoreRepo->getExistCadenaForCampaigne($campaigne->id);
            if (count($cadenas)>0){
                $chanel[] = array('fullname' => 'MODERNO');
            }
            $horizontals = $this->storeRepo->getHorizontalForCampaigne($campaigne->id,2);
            if (count($horizontals)>0){
                $chanel[] = array('fullname' => 'TRADICIONAL');
            }
            $valorCampaignes[] = array('id' => $campaigne->id,'fullname' => $campaigne->fullname,'city' =>$cityFilter,'chanel'=>$chanel);unset($cityFilter);unset($chanel);
        }
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> 1,'campaigne' => $valorCampaignes]);
    }

    public function getCitiesForCampaigneAll()
    {
        $campaignesClients = $this->companyRepo->getCompaniesForClient($this->customer_id,1,$this->estudio);$companies="";$c=0;
        foreach ($campaignesClients as $campaignesClient) {
            $c=$c+1;
            if($c==count($campaignesClients)){
                $companies .= $campaignesClient->id;
            }else{
                $companies .= $campaignesClient->id.",";
            }

        }
        $citiesAll = $this->companyStoreRepo->getCitiesForCampaigneAll($companies);
        foreach ($citiesAll as $city) {
            $datosCities[] = array('id' =>0, 'fullname' => $city->ubigeo);
        }
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> 1,'city' => $datosCities]);
    }

    public function getClientsForCampaigneAll()
    {
        $cadenas = $this->storeRepo->getCadenasForCampaigne("0",2,$this->customer_id,$this->estudio);
        foreach ($cadenas as $cadena) {
            $typeFilter[] = array("type" => "Moderno","fullname" => $cadena);
        }
        $horizontals = $this->storeRepo->getHorizontalForCampaigne("0",2,$this->customer_id,$this->estudio);
        foreach ($horizontals as $horizontal) {
            $typeFilter[] = array("type" => "Tradicional","fullname" => $horizontal);
        }
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> 1,'client' => $typeFilter]);
    }

    public function getEjecutivesForCampaigneAll()
    {
        $cadenas = $this->storeRepo->getCadenasForCampaigne("0",2,$this->customer_id,$this->estudio);
        foreach ($cadenas as $cadena) {
            $ejecutivesCadena = $this->companyStoreRepo->getGroupEjecutiveForCadena($this->customer_id,$this->estudio,$cadena);
            foreach ($ejecutivesCadena as $ejecutives) {
                $ejecutivesFilter[] = array('client' => $cadena, 'fullname' => $ejecutives->ejecutivo);
            }
        }
        $horizontals = $this->storeRepo->getHorizontalForCampaigne("0",2,$this->customer_id,$this->estudio);
        foreach ($horizontals as $horizontal) {
            $ejecutivesHorizontal = $this->companyStoreRepo->getGroupEjecutiveForHorizontal($this->customer_id,$this->estudio,$horizontal);
            foreach ($ejecutivesHorizontal as $ejecutives) {
                $ejecutivesFilter[] = array('client' => $horizontal, 'fullname' => $ejecutives->ejecutivo);
            }
        }

        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> 1,'ejecutivo' => $ejecutivesFilter]);
    }

    public function getClientsForUbigeoType()
    {
        $cities = $this->companyStoreRepo->getGroupClientsCityChanel($this->customer_id,$this->estudio);
        foreach ($cities as $city) {
            $datosCities[] = array('city' =>$city->ubigeo, 'chanel' => $city->chanel, 'client' => $city->client);

        }
        //$resultado = array_merge($datosCities1,$datosCities2);

        //return View::make('prueba2',compact($datosCities));
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> 1,'client' => $datosCities]);
    }

    public function getEjecutivesForUbigeoType()
    {
        $cities = $this->companyStoreRepo->getGroupExecutivesCityClient($this->customer_id,$this->estudio);
        foreach ($cities as $city) {
            $datosCities[] = array('city' =>$city->ubigeo, 'client' => $city->client,'ejecutivo' => $city->ejecutivo);
        }

        //return View::make('prueba2',compact($datosCities));
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> 1,'ejecutivo' => $datosCities]);
    }

    public function getEjecutivesForUbigeoChanel()
    {
        $cities = $this->companyStoreRepo->getGroupCity($this->customer_id,$this->estudio);$c=0;
        foreach ($cities as $city) {
            $datosTypes = $this->companyStoreRepo->getGroupTypeForCity($this->customer_id,$this->estudio,$city->ubigeo);
            foreach ($datosTypes as $datosType) {
                if (strtoupper($datosType->type)=='CADENA'){
                    $clients = $this->companyStoreRepo->getGroupEjecutiveForUbigeoChanel($this->customer_id,$this->estudio,$city->ubigeo,$datosType->type);
                    foreach ($clients as $client) {
                        $datosCities[] = array('city' =>$city->ubigeo, 'chanel' => 'Moderno','ejecutivo' => $client->ejecutivo);
                    }
                }
            }
            foreach ($datosTypes as $datosType) {
                if (strtoupper($datosType->type)<>'CADENA'){
                    //$datosCities[] = array('city' =>$city->ubigeo, 'chanel' => $datosType->type);
                    $ejecutives = $this->companyStoreRepo->getGroupEjecutiveForUbigeoChanel($this->customer_id,$this->estudio,$city->ubigeo,$datosType->type);
                    foreach ($ejecutives as $ejecutive) {
                        //$datosCities[] = array('city' =>$city->ubigeo, 'chanel' => $datosType->type,'ejecutivo' => $ejecutive->ejecutivo);
                        $datosCities1[] = array('ejecutivo' => $ejecutive->ejecutivo);
                    }
                }
            }
            rsort($datosCities1);$compara="";
            foreach ($datosCities1 as $item) {
                if ($item['ejecutivo']<>$compara)
                {
                    $compara = $item['ejecutivo'];$valTemps[]=$item['ejecutivo'];
                }

            }
            foreach ($valTemps as $valTemp) {
                $datosCities[] = array('city' =>$city->ubigeo, 'chanel' => 'Tradicional','ejecutivo' => $valTemp);
            }unset($valTemps);unset($datosCities1);
            $c ++;
        }

        //return View::make('prueba2',compact($datosCities));
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> 1,'ejecutivo' => $datosCities]);
    }

    public function getEjecutivesForCity()
    {
        $cities = $this->companyStoreRepo->getGroupCity($this->customer_id,$this->estudio);
        foreach ($cities as $city) {
            $ejecutives = $this->companyStoreRepo->getGroupEjecutiveForCity($this->customer_id,$this->estudio,$city->ubigeo);
            foreach ($ejecutives as $ejecutive) {
                $datosCities[] = array('city' =>$city->ubigeo, 'ejecutivo' => $ejecutive->ejecutivo);
            }
        }

        //return View::make('prueba2',compact($datosCities));
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> 1,'ejecutivo' => $datosCities]);
    }

    public function getCompanyForProduct()
    {
        $getCompaignes = $this->companyRepo->getCompaniesForClient($this->customer_id,"1",$this->estudio);
        foreach ($getCompaignes as $getCompaigne) {
            $arrayCampaines[]= $getCompaigne->id;
        }
        $ListProducts = $this->productDetailRepo->getAllProductsForCampaigne($arrayCampaines);

        foreach ($ListProducts as $product) {
            $companies = $this->companyRepo->getGroupCompanyForProduct($this->customer_id,$this->estudio,$product->product_id);
            foreach ($companies as $company) {
                $datosCities[] = array('product_id' =>$product->product_id, 'company_id' => $company->company_id, 'fullname' => $company->fullname);
            }
        }
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> 1,'productos' => $datosCities]);
    }

    public function getProductsCampaigne()
    {
        $getCompaignes = $this->companyRepo->getCompaniesForClient($this->customer_id,"1",$this->estudio);
        foreach ($getCompaignes as $getCompaigne) {
            $arrayCampaines[]= $getCompaigne->id;
        }
        $ListProducts = $this->productDetailRepo->getAllProductsForCampaigne($arrayCampaines);
        foreach ($ListProducts as $product) {
            $datosCities[] = array('product_id' =>$product->product_id, 'fullname' => $product->product->fullname);
        }
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> 1,'productos' => $datosCities]);
    }

    public function lastCampaigneHome()
    {
        $titulo='Histórico de Competencias';
        $customer =$this->customerRepo->find($this->customer_id);//dd($customer);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $objCompany = $this->companyRepo->getFirstCurrentCampaigns($this->customer_id,$this->estudio);
        $company_id = $objCompany->id;
        $urlBase = $this->urlBase;
        $audit_id=0;
        $menus = $this->generateMenusBayer($company_id,0,10);
        $canalLink="0";
        $clienteLink="0";
        $ejecutivoLink="0";
        $ciudadLink="0";
        $subtitulo="";
        $urlProducts = $this->urlBase.$this->urlImagesProducts;

        $getCompaignes = $this->companyRepo->getCompaniesForClient($customer->id,"1",$this->estudio);$valCampaignes="";
        foreach ($getCompaignes as $getCompaigne) {
            $arrayCampaines[]= $getCompaigne->id;$valCampaignes .=$getCompaigne->id."|";
        }
        //30|33|35|39|41|44|60|65|70|73|78|88|
        $ListProducts = $this->productDetailRepo->getAllProductsForCampaigne($arrayCampaines);

        return View::make('report/bayer/brandHistoryLastCampaigne',compact('urlProducts','valCampaignes','subtitulo','ejecutivoLink','clienteLink','canalLink','ciudadLink','ListProducts','titulo','logo','menus','company_id','audit_id','urlBase'));
    }

} 