<?php
use Carbon\Carbon;
use Auditor\Repositories\PublicityCampaigneRepo;
use Auditor\Repositories\ProductDetailRepo;
use Auditor\Repositories\ProductStoreRegionRepo;
use Auditor\Repositories\RoadDetailRepo;
use Auditor\Repositories\VisitRepo;
use Auditor\Repositories\CategoryProductRepo;
use Auditor\Repositories\StockProductPopRepo;
use Auditor\Repositories\PublicityStoreRepo;
use Auditor\Repositories\PollDetailRepo;
use Auditor\Repositories\PollRepo;
use Auditor\Repositories\UserRepo;
use Auditor\Repositories\CompanyRepo;
use Auditor\Repositories\CustomerRepo;
use Auditor\Repositories\StoreRepo;
use Auditor\Repositories\PollOptionRepo;
use Auditor\Repositories\PollOptionDetailRepo;
use Auditor\Repositories\MediaRepo;
use Auditor\Repositories\PublicityRepo;
use Illuminate\Support\Collection;
use Auditor\Repositories\AuditRoadStoreRepo;
use Auditor\Repositories\RoadRepo;
use Auditor\Repositories\CompanyStoreRepo;
use Auditor\Repositories\ProductRepo;

class MercantilistaBayerController extends BaseController{
    protected $publicityCampaigneRepo;
    protected $productDetailRepo;
    protected $productStoreRegionRepo;
    protected $roadDetailRepo;
    protected $visitRepo;
    protected $categoryProductRepo;
    protected $stockProductPopRepo;
    protected $publicityStoreRepo;
    protected $pollDetailRepo;
    protected $pollRepo;
    protected $userRepo;
    protected $companyRepo;
    protected $customerRepo;
    protected $storeRepo;
    protected $pollOptionRepo;
    protected $pollOptionDetailRepo;
    protected $mediaRepo;
    protected $publicityRepo;
    protected $auditRoadStoreRepo;
    protected $roadRepo;
    protected $companyStoreRepo;
    protected $productRepo;

    public $urlBase;
    public $urlImagesFotos;
    public $urlImageBase;
    public $estudio;
    public $customer_id;
    public $pollsWeb;

    public function __construct(ProductRepo $productRepo,CompanyStoreRepo $companyStoreRepo,RoadRepo $roadRepo,AuditRoadStoreRepo $auditRoadStoreRepo,PublicityRepo $publicityRepo,MediaRepo $mediaRepo,PollOptionDetailRepo $pollOptionDetailRepo,PollOptionRepo $pollOptionRepo,StoreRepo $storeRepo,CustomerRepo $customerRepo,CompanyRepo $companyRepo,UserRepo $userRepo,PollRepo $pollRepo,PollDetailRepo $pollDetailRepo,PublicityStoreRepo $publicityStoreRepo,StockProductPopRepo $stockProductPopRepo,CategoryProductRepo $categoryProductRepo,VisitRepo $visitRepo,RoadDetailRepo $roadDetailRepo,PublicityCampaigneRepo $publicityCampaigneRepo, ProductDetailRepo $productDetailRepo,ProductStoreRegionRepo $productStoreRegionRepo)
    {
        $this->publicityCampaigneRepo=$publicityCampaigneRepo;
        $this->productDetailRepo =$productDetailRepo;
        $this->productStoreRegionRepo = $productStoreRegionRepo;
        $this->roadDetailRepo = $roadDetailRepo;
        $this->visitRepo = $visitRepo;
        $this->categoryProductRepo = $categoryProductRepo;
        $this->stockProductPopRepo = $stockProductPopRepo;
        $this->publicityStoreRepo = $publicityStoreRepo;
        $this->pollDetailRepo = $pollDetailRepo;
        $this->pollRepo = $pollRepo;
        $this->userRepo = $userRepo;
        $this->companyRepo = $companyRepo;
        $this->customerRepo = $customerRepo;
        $this->storeRepo = $storeRepo;
        $this->pollOptionRepo = $pollOptionRepo;
        $this->pollOptionDetailRepo = $pollOptionDetailRepo;
        $this->mediaRepo = $mediaRepo;
        $this->publicityRepo = $publicityRepo;
        $this->auditRoadStoreRepo = $auditRoadStoreRepo;
        $this->roadRepo = $roadRepo;
        $this->companyStoreRepo=$companyStoreRepo;
        $this->productRepo = $productRepo;

        $this->urlBase = \App::make('url')->to('/');
        $this->urlImagesFotos = '/media/fotos/';
        $this->urlImageBase = '/media/images/';
        $this->customer_id = 5;
        $this->estudio='2';
        $this->pollsWeb =$this->getAllPollsWeb($this->customer_id,$this->estudio);
    }

    public function resumeHome($company_id="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            if (count($valoresPost)<>0){
                $ubigeoext = "0";
                $cadena = "0";
                $type = "0";
                /*$ubigeoext = $valoresPost['ubigeo'];
                $cadena = $valoresPost['cadena'];
                $horizontal = $valoresPost['horizontal'];*/
                $company_id = $valoresPost['company_id'];
               /* $ejecutivo = $valoresPost['ejecutivo'];*/
                $company = $this->companyRepo->find($company_id);
                $titulo = 'Resumen Período '.$company->fullname;
            }else{
                $ubigeoext = "0";
                $cadena = "0";
                $type = "0";
                //$company = $this->UserCompanyRepo->getCompany(Auth::user()->id);
                //$company_id=$company[0]->id;//dd($company_id);
                //$titulo = $company[0]->fullname;
                $ObjCompany_id=$this->companyRepo->getFirstCurrentCampaigns($this->customer_id,$this->estudio);
                $company_id=$ObjCompany_id->id;
                $company = $this->companyRepo->find($company_id);
                $titulo = 'Resumen Período '.$company->fullname;
            }
        }else{
            $ubigeoext = "0";
            $cadena = "0";
            $type="0";
            $company = $this->companyRepo->find($company_id);
            $titulo = 'Resumen Período '.$company->fullname;
        }

        foreach ($this->pollsWeb as $pollWeb) {
            if (($pollWeb['identificador']=='abierto') and ($pollWeb['company_id']==$company_id))
            {
                $pollAbierto = $pollWeb['poll_id'];
            }
            if (($pollWeb['identificador']=='permitio') and ($pollWeb['company_id']==$company_id))
            {
                $pollPermitio = $pollWeb['poll_id'];
            }
            if (($pollWeb['identificador']=='pop_encontrados') and ($pollWeb['company_id']==$company_id))
            {
                $pollPopEncontrado = $pollWeb['poll_id'];
            }
            if (($pollWeb['identificador']=='estado') and ($pollWeb['company_id']==$company_id))
            {
                $pollEstado = $pollWeb['poll_id'];
            }
            if (($pollWeb['identificador']=='competencia') and ($pollWeb['company_id']==$company_id))
            {
                $pollCompetencia = $pollWeb['poll_id'];
            }
        }
        $customer =$this->customerRepo->find($this->customer_id);//dd($customer);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $campaignesClient = $this->companyRepo->getCompaniesForClient($customer->id,1,$this->estudio);//Para combo de cambio de campañas collection array de objetos Company
        $campaignes = array(0 => "Períodos") + $campaignesClient->lists('fullname','id');
        $urlBase = $this->urlBase."/mercaderismo/resumeHome/";

        //$type='MINI CADENAS';

        $respuestaSI = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollAbierto,1,1,"0","0",$type,$cadena,$ubigeoext);
        $respuestaNO = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollAbierto,1,0,"0","0",$type,$cadena,$ubigeoext);
        $valSiNo[0] = array("tipo" => 'Abierto', "cantidad" => count($respuestaSI), "color" => '#97C74F');
        $valSiNo[1] = array("tipo" => 'Cerrado', "cantidad" => count($respuestaNO), "color" => '#1AB1E6');
        $valAbiertosJson =json_encode($valSiNo);unset($valSiNo);

        $respuestaSI = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPermitio,1,1,"0","0",$type,$cadena,$ubigeoext);
        $respuestaNO = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPermitio,1,0,"0","0",$type,$cadena,$ubigeoext);
        $valSiNo[0] = array("tipo" => 'Sí', "cantidad" => count($respuestaSI), "color" => '#97C74F');
        $valSiNo[1] = array("tipo" => 'No', "cantidad" => count($respuestaNO), "color" => '#1AB1E6');
        $valPermitioJson =json_encode($valSiNo);unset($valSiNo);

        $publicities = $this->publicityCampaigneRepo->getPublicitiesForCampaigne($company_id);
        foreach ($publicities as $publicity) {
            if ($publicity->publicity_id<>568)
            {
                $encontrados = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopEncontrado,1,1,$publicity->publicity_id,"0",$type,$cadena,$ubigeoext);
                //$base = $this->publicityStoreRepo->getPublicityInStore($publicity->publicity_id,"0",$company_id,0,$type,$cadena);
                $base = $this->publicityStoreRepo->getAllPublicitiesBayerStart(79,$publicity->publicity_id,"0",$type,$cadena);
                $buenEstado = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollEstado,1,1,$publicity->publicity_id,"0",$type,$cadena,$ubigeoext);
                $basePrinc = count($base);
                if ($basePrinc<>0){
                    $enconPorc = round(count($encontrados)/$basePrinc*100,0);
                    $buenPrinc = round(count($buenEstado)/$basePrinc*100,0);
                }else{
                    $enconPorc=0;
                    $buenPrinc=0;
                }

                $valoresPop[] = array('tipo'=>$publicity->publicity->fullname,'Bayer'=>100,'Presencia'=>$enconPorc,'Buen Estado'=>$buenPrinc);
            }

        }
        $valPopJson =json_encode($valoresPop);unset($valoresPop);
        $menu="resumen";

        $productsCompetitions = $this->productDetailRepo->getProductsCompetitionForCampaigne($company_id,1);$sumaTotal=0;
        foreach ($productsCompetitions as $productsCompetition) {
            //$popCompetencia = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollCompetencia,1,1,"0",$productsCompetition->product_id,$type,$cadena,$ubigeoext);
            $popCompetencia = $this->pollDetailRepo->detailsGroupStores($company_id,$pollCompetencia,"0","0",$productsCompetition->product_id,$type,$cadena,$ubigeoext);
            $valoresTemp[$productsCompetition->product_id] = count($popCompetencia);$sumaTotal = $sumaTotal + count($popCompetencia);
        }
        $baseBayer = $this->publicityStoreRepo->getAllPublicitiesBayerStart('79',"0","0","0","0",1);$c=0;
        foreach ($productsCompetitions as $productsCompetition) {
            if ($c==0){
                $totalOrdenado[] = array('respuesta' => ucwords("Bayer"), 'cantidad' => count($baseBayer), "porcentaje" => 100);
                $c=$c+1;
            }
            $totalOrdenado[] = array('respuesta' => ucwords($productsCompetition->product->fullname), 'cantidad' => $valoresTemp[$productsCompetition->product_id], "porcentaje" => round($valoresTemp[$productsCompetition->product_id]/count($baseBayer)*100,0));
        }
        $valPopCompJson = json_encode($totalOrdenado);unset($totalOptions);unset($totalOrdenado);
        return View::make('report/bayer/mercaderismo',compact('campaignes','menu','urlBase','titulo','logo','valAbiertosJson','valPermitioJson','valPopJson','valPopCompJson','company_id'));
    }

    public function popCompetencia($company_id="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            if (count($valoresPost)<>0){
                $ubigeoext = "0";
                $cadena = "0";
                $type = "0";
                /*$ubigeoext = $valoresPost['ubigeo'];
                $cadena = $valoresPost['cadena'];
                $horizontal = $valoresPost['horizontal'];*/
                $company_id = $valoresPost['company_id'];
                /* $ejecutivo = $valoresPost['ejecutivo'];*/
                $company = $this->companyRepo->find($company_id);
                $titulo = 'Presencia POP Competencia Período '.$company->fullname;
            }else{
                $ubigeoext = "0";
                $cadena = "0";
                $type = "0";
                //$company = $this->UserCompanyRepo->getCompany(Auth::user()->id);
                //$company_id=$company[0]->id;//dd($company_id);
                //$titulo = $company[0]->fullname;
                $ObjCompany_id=$this->companyRepo->getFirstCurrentCampaigns($this->customer_id,$this->estudio);
                $company_id=$ObjCompany_id->id;
                $company = $this->companyRepo->find($company_id);
                $titulo = 'Presencia POP Competencia Período '.$company->fullname;
            }
        }else{
            $ubigeoext = "0";
            $cadena = "0";
            $type="0";
            $company = $this->companyRepo->find($company_id);
            $titulo = 'Presencia POP Competencia Período '.$company->fullname;
        }

        foreach ($this->pollsWeb as $pollWeb)
        {
            if (($pollWeb['identificador']=='competencia') and ($pollWeb['company_id']==$company_id))
            {
                $pollCompetencia = $pollWeb['poll_id'];
            }
        }

        $customer =$this->customerRepo->find($this->customer_id);//dd($customer);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $campaignesClient = $this->companyRepo->getCompaniesForClient($customer->id,1,$this->estudio);//Para combo de cambio de campañas collection array de objetos Company
        $campaignes = array(0 => "Períodos") + $campaignesClient->lists('fullname','id');
        $urlBase = $this->urlBase."/mercaderismo/popCompetencia/";

        $menu="competencia";

        $productsCompetitions = $this->productDetailRepo->getProductsCompetitionForCampaigne($company_id,1);$sumaTotal=0;

        foreach ($productsCompetitions as $productsCompetition) {
            //obtener cuantos pop fueron encontrados para el product_id: $productsCompetition->product_id
            $popCompetencia = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollCompetencia,1,1,"0",$productsCompetition->product_id,$type,$cadena,$ubigeoext);
            //Ordenar por publicity_id los registros encontrados
            $grouped = $popCompetencia->groupBy('publicity_id');
            $totalReg = count($popCompetencia);
            foreach($grouped as $key => $group)
            {
                $mykey = $key;
                $objPublicity = $this->publicityRepo->find($mykey);

                $totalOrdenado[] = array('respuesta' => ucwords($objPublicity->fullname), 'cantidad' => count($grouped[$mykey]), "porcentaje" => round(count($grouped[$mykey])/$totalReg*100,0));
            }

            $totalPorProducto[$productsCompetition->product_id] =  $totalOrdenado; unset($totalOrdenado);
        }
        return View::make('report/bayer/mercaderismoCompetencia',compact('campaignes','menu','urlBase','titulo','logo','totalPorProducto','company_id','productsCompetitions'));
    }

    public function getDetailPopEncontrado($company_id="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            if (count($valoresPost)<>0){
                $cliente = $valoresPost['cliente'];
                $publicity_id = $valoresPost['publicity_id'];
                $type = $valoresPost['type'];
                $company_id = $valoresPost['company_id'];
                $company = $this->companyRepo->find($company_id);
                $titulo = 'Detalle POP Periódo '.$company->fullname;
            }else{
                $cliente = "0";
                $publicity_id = "0";
                $type = "0";
                $ObjCompany_id=$this->companyRepo->getFirstCurrentCampaigns($this->customer_id,$this->estudio);
                $company_id=$ObjCompany_id->id;
                $company = $this->companyRepo->find($company_id);
                $titulo = 'Detalle POP Periódo '.$company->fullname;
            }
        }else{
            $cliente = "0";
            $publicity_id = "0";
            $type="0";
            $company = $this->companyRepo->find($company_id);
            $titulo = 'Detalle POP Periódo '.$company->fullname;
        }
        foreach ($this->pollsWeb as $pollWeb)
        {
            if (($pollWeb['identificador']=='pop_encontrados') and ($pollWeb['company_id']==$company_id))
            {
                $pollPopEncontrado = $pollWeb['poll_id'];
            }
            if (($pollWeb['identificador']=='visible') and ($pollWeb['company_id']==$company_id))
            {
                $pollPopVisible = $pollWeb['poll_id'];
            }
            if (($pollWeb['identificador']=='estado') and ($pollWeb['company_id']==$company_id))
            {
                $pollPopEstado = $pollWeb['poll_id'];
            }
            if (($pollWeb['identificador']=='cambios') and ($pollWeb['company_id']==$company_id))
            {
                $pollPopCambio = $pollWeb['poll_id'];
            }
            if (($pollWeb['identificador']=='led') and ($pollWeb['company_id']==$company_id))
            {
                $pollLuzLed = $pollWeb['poll_id'];
            }
            if (($pollWeb['identificador']=='layout') and ($pollWeb['company_id']==$company_id))
            {
                $pollLayout = $pollWeb['poll_id'];
            }
        }
        $customer =$this->customerRepo->find($this->customer_id);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $campaignesClient = $this->companyRepo->getCompaniesForClient($customer->id,1,$this->estudio);//Para combo de cambio de campañas collection array de objetos Company
        $campaignes = array(0 => "Períodos") + $campaignesClient->lists('fullname','id');
        $urlBase = route('detailPopEncontrado');

        $typeStores = $this->storeRepo->getTypeStoreForCampaigne($company_id,1);
        $types = array(0 => "Seleccionar Canal") + $typeStores->lists('type','type');
        $popsCompanies = $this->getPublicitiesCampaigne($company_id,0);
        $collectionPops = Collection::make($popsCompanies);
        $pops = array(0=>'Seleccionar POP') + $collectionPops->lists('fullname','id');
        $menu="detalle";
        $leyenda="0";

        if ($publicity_id<>"0")
        {
            $objPublicity = $this->publicityRepo->find($publicity_id);
            $leyenda = $type.", ".$cliente.", ".$objPublicity->fullname;
            //encontrado
            $num_visitas = $this->pollDetailRepo->getVisitStores($company_id,$publicity_id,"0",$type,$cliente);
            //$base = $this->publicityStoreRepo->getPublicityInStore($publicity_id,"0",$company_id,0,$type,$cliente);
            $base = $this->publicityStoreRepo->getAllPublicitiesBayerStart(79,$publicity_id,"0",$type,$cliente);
            //$valoresPopEncontrado[] = array('tipo'=>$objPublicity->fullname,'Base'=>count($base),'presencia'=>count($encontrados));
            if (count($base)>0)
            {
                $valoresPopEncontrado[] = array('respuesta' => 'Bayer', 'cantidad' => count($base), "porcentaje" => 100);
                if (count($num_visitas)>0)
                {
                    foreach ($num_visitas as $num_visita) {
                        $encontrados = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopEncontrado,$num_visita->visit_id,1,$publicity_id,"0",$type,$cliente,"0");
                        $porcEncontrados = count($encontrados)/count($base)*100;
                        $valoresPopEncontrado[] = array('respuesta' => "Visita: ".$num_visita->visit_id, 'cantidad' => count($encontrados), "porcentaje" => round($porcEncontrados,0));
                    }
                }

            }else{
                $porcEncontrados = 0;
                $valoresPopEncontrado[] = array('respuesta' => 'Bayer', 'cantidad' => count($base), "porcentaje" => 0);
                if (count($num_visitas)>0)
                {
                    foreach ($num_visitas as $num_visita) {
                        $encontrados = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopEncontrado,$num_visita->visit_id,1,$publicity_id,"0",$type,$cliente,"0");
                        $valoresPopEncontrado[] = array('respuesta' => "Visita: ".$num_visita->visit_id, 'cantidad' => count($encontrados), "porcentaje" => 100);
                    }
                }
            }


            //fin encontrado

            //visibilidad
            if (($publicity_id<>564)){
                $visit_id=1;
                $visibles = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopVisible,$visit_id,1,$publicity_id,"0",$type,$cliente,"0");
                $noVisibles = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopVisible,$visit_id,0,$publicity_id,"0",$type,$cliente,"0");
                $valSiNo[0] = array("tipo" => 'Sí', "cantidad" => count($visibles), "color" => '#97C74F');
                $valSiNo[1] = array("tipo" => 'No', "cantidad" => count($noVisibles), "color" => '#1AB1E6');
                if (count($noVisibles)>0){
                    //{poll_id}/{values}/{company_id}/{poll_option_id?}/{product_id?}/{publicity_id?}
                    //$values = $respuesta.'|'.$type.'|'.$cadena;
                    $linkNoVisibles = $pollPopVisible."/"."No Visibles-0-".$type."-".$cliente."-".$visit_id."/".$company_id."/"."0/0/".$publicity_id;
                }else{
                    $linkNoVisibles = 0;
                }

            }else{
                $valSiNo=[];$linkNoVisibles = 0;
            }

            //fin visibilidad

            //opciones visibilidad
            if (($publicity_id<>564)){
                $options= $this->pollOptionRepo->getOptions($pollPopVisible);//dd($options[0]);
                //chartData3 = JSON.parse('[{"category":"No Visible","texto_si":"Titulo 1","Si":38,"cant_si":324,"texto_no":"Titulo 2","No":62,"cant_no":528,"color":"#ffffff"}]');
                $totalOptions=0;
                foreach ($options as $option) {
                    $cantidad  = count($this->pollOptionDetailRepo->getResultOption($company_id,$option->id,1,$publicity_id,"0",$type,$cliente,"0"));
                    $textoOpcion= ucwords(trim($option->options));
                    $opciones[] = array('id'=>$option->id,'opcion' => $textoOpcion,'cantidad' => $cantidad);
                    $totalOptions = $totalOptions + $cantidad;
                }
                unset($options);
                if ($totalOptions>0)
                {
                    $c=0;$opcionesTotal = array("tipo" => 'No Visibles');$valoresOpciones0=[];
                    foreach ($opciones as $option)
                    {
                        $porc = $option['cantidad']/$totalOptions*100;
                        $c=$c+1;if ($c==1) $color = '#FFFFFF';if ($c==2) $color = '#FFFFFF';if ($c==3) $color = '#FFFFFF';if ($c==4) $color = '#FFFFFF';
                        $opcion = array($option['opcion']=>round($porc,0));
                        $valoresOpciones0 = array_merge($valoresOpciones0,$opcion);

                    }
                    $valoresOpciones[] = array_merge($opcionesTotal,$valoresOpciones0);
                    unset($opciones);unset($valoresOpciones0);
                }else{
                    $valoresOpciones = [];
                }
                unset($totalOptions);
            }else{
                $valoresOpciones = [];
            }

            //fin opciones visibilidad

            //estado
            if (($publicity_id<>585) and ($publicity_id<>586)){
                $buenEstado = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopEstado,1,1,$publicity_id,"0",$type,$cliente,"0");
                $malEstado = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopEstado,1,0,$publicity_id,"0",$type,$cliente,"0");
                $valSiNoE[0] = array("tipo" => 'Buen Estado', "cantidad" => count($buenEstado), "color" => '#97C74F');
                $valSiNoE[1] = array("tipo" => 'Mal Estado', "cantidad" => count($malEstado), "color" => '#1AB1E6');
            }else{
                $valSiNoE=[];
            }
            //fin estado

            //opciones estado
            if (($publicity_id<>585) and ($publicity_id<>586)){
                $options= $this->pollOptionRepo->getOptions($pollPopEstado);
                //chartData3 = JSON.parse('[{"category":"No Visible","texto_si":"Titulo 1","Si":38,"cant_si":324,"texto_no":"Titulo 2","No":62,"cant_no":528,"color":"#ffffff"}]');
                $totalOptions=0;unset($opciones);$sw=0;
                foreach ($options as $option) {
                    if ($publicity_id==561){
                        if (($option->codigo==$pollPopEstado.'d') or ($option->codigo==$pollPopEstado.'e')){
                            $sw=1;
                        }
                    }
                    if ($publicity_id==563){
                        if ($option->codigo==$pollPopEstado.'d'){
                            $sw=1;
                        }
                    }
                    if ($publicity_id==565){
                        if ($option->codigo==$pollPopEstado.'d'){
                            $sw=1;
                        }
                    }
                    if ($publicity_id==566){
                        if (($option->codigo==$pollPopEstado.'a') or ($option->codigo==$pollPopEstado.'b') or ($option->codigo==$pollPopEstado.'c')){
                            $sw=1;
                        }
                    }
                    if ($publicity_id==562){
                        if ($option->codigo==$pollPopEstado.'d'){
                            $sw=1;
                        }
                    }
                    if ($publicity_id==567){
                        if ($option->codigo==$pollPopEstado.'d'){
                            $sw=1;
                        }
                    }
                    if ($publicity_id==564){
                        if (($option->codigo==$pollPopEstado.'d') or ($option->codigo==$pollPopEstado.'f')){
                            $sw=1;
                        }
                    }
                    if ($sw==1){
                        $cantidad  = count($this->pollOptionDetailRepo->getResultOption($company_id,$option->id,1,$publicity_id,"0",$type,$cliente,"0"));
                        $textoOpcion= ucwords(trim($option->options));
                        $opciones[] = array('id'=>$option->id,'opcion' => $textoOpcion,'cantidad' => $cantidad);
                        $totalOptions = $totalOptions + $cantidad;$sw=0;
                    }


                }
                unset($options);
                if ($totalOptions>0)
                {
                    $c=0;$opcionesTotal = array("tipo" => 'Mal Estado');unset($valoresOpciones0);$valoresOpciones0=[];
                    foreach ($opciones as $option)
                    {
                        $porc = $option['cantidad']/$totalOptions*100;
                        $c=$c+1;if ($c==1) $color = '#FFFFFF';if ($c==2) $color = '#FFFFFF';if ($c==3) $color = '#FFFFFF';if ($c==4) $color = '#FFFFFF';

                        $opcion = array($option['opcion']=>round($porc,0));
                        $valoresOpciones0 = array_merge($valoresOpciones0,$opcion);

                    }
                    $valoresOpcionesE[] = array_merge($opcionesTotal,$valoresOpciones0);
                    unset($opciones);unset($valoresOpciones0);
                }else{
                    $valoresOpcionesE=[];
                }
                unset($totalOptions);
            }else{
                $valoresOpcionesE=[];
            }

            //fin opciones estado

            //cambios
            if (($publicity_id<>564)){
                $realizoCambios = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopCambio,1,1,$publicity_id,"0",$type,$cliente,"0");
                $noRealizoCambios = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopCambio,1,0,$publicity_id,"0",$type,$cliente,"0");
                $valSiNoC[0] = array("tipo" => 'Si', "cantidad" => count($realizoCambios), "color" => '#97C74F');
                $valSiNoC[1] = array("tipo" => 'No', "cantidad" => count($noRealizoCambios), "color" => '#1AB1E6');
            }else{
                $valSiNoC=[];
            }

            //fin cambios

            //opciones cambios
            if (($publicity_id<>564)){
                $options= $this->pollOptionRepo->getOptions($pollPopCambio);
                $totalOptions=0;unset($opciones);
                foreach ($options as $option) {
                    $cantidad  = count($this->pollOptionDetailRepo->getResultOption($company_id,$option->id,1,$publicity_id,"0",$type,$cliente,"0"));
                    $textoOpcion= ucwords(trim($option->options));
                    $opciones[] = array('id'=>$option->id,'opcion' => $textoOpcion,'cantidad' => $cantidad);
                    $totalOptions = $totalOptions + $cantidad;
                }
                unset($options);
                if ($totalOptions>0)
                {
                    $c=0;$opcionesTotal = array("tipo" => 'Se hizo Cambios');$valoresOpciones0=[];
                    foreach ($opciones as $option)
                    {
                        $porc = $option['cantidad']/$totalOptions*100;

                        $opcion = array($option['opcion']=>round($porc,0));
                        $valoresOpciones0 = array_merge($valoresOpciones0,$opcion);

                    }
                    $valoresOpcionesC[] = array_merge($opcionesTotal,$valoresOpciones0);
                    unset($opciones);unset($valoresOpciones0);
                }else{
                    $valoresOpcionesC=[];
                }
                unset($totalOptions);
            }else{
                $valoresOpcionesC=[];
            }

            //fin opciones cambios

            //led
            if (($publicity_id==565) or ($publicity_id==561)){
                $luzLedOperativaSi = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollLuzLed,1,1,$publicity_id,"0",$type,$cliente,"0");
                $luzLedOperativaNo = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollLuzLed,1,0,$publicity_id,"0",$type,$cliente,"0");
                $valSiNoLuz[0] = array("tipo" => 'Sí', "cantidad" => count($luzLedOperativaSi), "color" => '#97C74F');
                $valSiNoLuz[1] = array("tipo" => 'No', "cantidad" => count($luzLedOperativaNo), "color" => '#1AB1E6');
            }else{
                $valSiNoLuz=[];
            }
            //fin led

            //layout
            if ($publicity_id==586){
                $layoutSi = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollLayout,1,1,$publicity_id,"0",$type,$cliente,"0");
                $layoutNo = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollLayout,1,0,$publicity_id,"0",$type,$cliente,"0");
                $valSiNoLayout[0] = array("tipo" => 'Sí', "cantidad" => count($layoutSi), "color" => '#97C74F');
                $valSiNoLayout[1] = array("tipo" => 'No', "cantidad" => count($layoutNo), "color" => '#1AB1E6');
            }else{
                $valSiNoLayout=[];
            }
            //fin layout

        }else{
            $valoresPopEncontrado = [];$objPublicity=[];$valoresOpciones = [];$valSiNo=[];$valSiNoE=[];$valoresOpcionesE=[];$valSiNoC=[];$valoresOpcionesC=[];$valSiNoLuz=[];$valSiNoLayout=[];
        }
        $valPopJson =json_encode($valoresPopEncontrado);unset($valoresPopEncontrado);
        $valVisibleJson =json_encode($valSiNo);unset($valSiNo);
        $valOpcionesJson =json_encode($valoresOpciones);unset($valoresOpciones);
        $valEstadoJson =json_encode($valSiNoE);unset($valSiNoE);
        $valOpcionesEJson =json_encode($valoresOpcionesE);unset($valoresOpcionesE);
        $valCambiosJson =json_encode($valSiNoC);unset($valSiNoC);
        $valOpcionesCJson =json_encode($valoresOpcionesC);unset($valoresOpcionesC);
        $valLedJson =json_encode($valSiNoLuz);unset($valSiNoLuz);
        $valLayoutJson =json_encode($valSiNoLayout);unset($valSiNoLayout);

        return View::make('report/bayer/mercaderismoDetalle',compact('valLayoutJson','linkNoVisibles','campaignes','valLedJson','leyenda','valOpcionesCJson','valCambiosJson','menu','valOpcionesEJson','valEstadoJson','valOpcionesJson','valVisibleJson','objPublicity','valPopJson','urlBase','titulo','logo','types','company_id','pops'));
    }

    public function getCadenaRucForType($company_id="0",$type="0",$ajax="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            $company_id = $valoresPost['company_id'];
            $ajax = 1;
            $type = $valoresPost['type'];
        }
        $success=0;
        $cadenas = $this->storeRepo->getCadenaRucForType($company_id,$type);
        //$cadenas = array(0 => "Selecciona") + $cadenas1->lists('cadenaRuc','cadenaRuc');dd($cadenas1);
        if ($ajax=="0"){//web

        }
        if ($ajax=="1"){//json
            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');
            return  Response::json($cadenas);
        }

    }

    public function getPublicitiesCampaigne($company_id="0",$ajax="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            $company_id = $valoresPost['company_id'];
            //$ajax = $valoresPost['ajax'];
            $ajax=1;
        }
        $publicitiesCampaigne =$this->publicityCampaigneRepo->getPublicityForCampaigne($company_id);//dd($publicitiesCampaigne);
        if (count($publicitiesCampaigne)>0){
            foreach ($publicitiesCampaigne as $publicity) {
                $valores[] = array('id' =>$publicity->publicity_id,'company_id' => $publicity->publicity->company_id,'fullname' => $publicity->publicity->fullname,'category_product_id' => $publicity->publicity->category_product_id,'description' => $publicity->publicity->description,'imagen' => $publicity->publicity->imagen,'created_at' => '','updated_at' => '');
            }
            $success=1;
        }else{
            $valores=[];$success=0;
        }
        if ($ajax=="0"){//metodo
            return $valores;
        }
        if ($ajax=="1"){


            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');
            return Response::json([ 'success'=> $success,'publicities' => $valores]);
        }

    }

    public function getProductsForCompetition($company_id="0",$competition="0",$ajax="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            $company_id = $valoresPost['company_id'];
            $ajax = 1;
            $competition = $valoresPost['competition'];
        }
        $success=0;
        $products = $this->productDetailRepo->getProductsCompetitionForCampaigne($company_id,$competition);//dd($products[0]);
        if ($ajax=="0"){//web
            $titulo="";$logo='logoBayer.jpg';$publicitiesCampaigne=$products;
            return View::make('report/bayer/mercaderismo',compact('publicitiesCampaigne','titulo','logo'));
        }
        if ($ajax=="1"){//json
            if (count($products)>0){
                foreach ($products as $product) {
                    $valores[] = array('id' =>$product->product->id,'fullname' => $product->product->fullname,'company_id' => $product->company_id,'category_product_id' => $product->product->category_product_id,'precio' => $product->product->precio,'imagen' => $product->product->imagen,'composicion' => $product->product->composicion,'fabricante' => $product->product->fabricante,'presentacion' => $product->product->presentacion,'unidad' => $product->product->unidad,'created_at' => '','updated_at' => '');
                    $success=1;
                }
            }else{
                $valores = [];$success=0;
            }

            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');
            return  Response::json([ 'success'=> $success,'products' => $valores]);
        }
        
    }

    public function getProductsForCampaigneForTypeStore($company_id="0",$type="")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            $company_id = $valoresPost['company_id'];
            $ajax = $valoresPost['ajax'];
            $type = $valoresPost['type'];
        }
        $products = $this->productStoreRegionRepo->getProductsForCampaigneForTypeStore($company_id,$type);
        if ($ajax=="0"){
            /*$titulo="";$logo='logoBayer.jpg';$publicitiesCampaigne=$products;
            return View::make('report/bayer/mercaderismo',compact('publicitiesCampaigne','titulo','logo'));*/
        }
        if ($ajax=="1"){
            if (count($products)>0){
                foreach ($products as $product) {
                    $valores[] = array('id' =>$product->product->id,'fullname' => $product->product->fullname,'company_id' => $product->product->company_id,'category_product_id' => $product->product->category_product_id,'precio' => $product->product->precio,'imagen' => $product->product->imagen,'composicion' => $product->product->composicion,'fabricante' => $product->product->fabricante,'presentacion' => $product->product->presentacion,'unidad' => $product->product->unidad,'type' => $product->type,'created_at' => '','updated_at' => '');
                    $success=1;
                }
            }else{
                $valores = [];$success=0;
            }

            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');
            return  Response::json([ 'success'=> $success,'products' => $valores]);
        }
    }
    
    public function getRoadsDetail()
    {
        $valoresPost= Input::all();
        $company_id = $valoresPost['company_id'];
        $user_id = $valoresPost['user_id'];
        $valores = $this->roadDetailRepo->roadsDetail($company_id,$user_id);
        if (count($valores)>0){
            $success =1;
        }else{
            $success =0;
        }
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> $success,'roadsDetail' => $valores]);
    }
    
    public function getVisits(){
        $valoresPost= Input::all();
        $company_id = $valoresPost['company_id'];
        $valores = $this->visitRepo->getAll($company_id);
        if (count($valores)>0){
            $success=1;
        }else{
            $success=0;
        }
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> $success,'roadsDetail' => $valores]);
    }

    public function getCategoryProduct(){
        $valoresPost= Input::all();
        $company_id = $valoresPost['company_id'];
        $valores = $this->categoryProductRepo->getCategoryProductForCompany($company_id);
        if (count($valores)>0){
            $success=1;
        }else{
            $success=0;
        }
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> $success,'categoryProducts' => $valores]);
    }

    public function getStockForPublicity($company_id="0",$cliente="0",$publicity_id="0",$ajax="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            $cliente = $valoresPost['cliente'];
            $publicity_id = $valoresPost['publicity_id'];
            $company_id = $valoresPost['company_id'];
            $ajax=1;
        }
        $valores = $this->stockProductPopRepo->getStockForPublicity($cliente,$publicity_id,$company_id);
        if ($ajax=="0"){
            /*$titulo="";$logo='logoBayer.jpg';$publicitiesCampaigne=$products;
            return View::make('report/bayer/mercaderismo',compact('publicitiesCampaigne','titulo','logo'));*/
        }
        if ($ajax=="1"){
            if (count($valores)>0){
                $success=1;
            }else{
                $success=0;
            }
            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');
            return  Response::json([ 'success'=> $success,'stock_product_pop' => $valores]);
        }

    }

    public function getHistoryPublicityForStore($company_id="0",$store_id="0",$poll_id="0",$visit_id="0",$ajax="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            $company_id = $valoresPost['company_id'];
            $ajax = 1;
            $store_id = $valoresPost['store_id'];
            $poll_id = $valoresPost['poll_id'];
            $visit_id = $valoresPost['visit_id'];
        }
        $objVisit = $this->visitRepo->find($visit_id);
        $order = $objVisit->order;
        if ($visit_id==1){
            $visit_id=0;
        }else{
            $order = $order -1;
            $objVisitSearch = $this->visitRepo->getVisitIdForOrder($order);
            $visit_id = $objVisitSearch->id;
        }
        $publicity_stores = $this->publicityStoreRepo->getHistoryPublicityStore($company_id,$store_id,$visit_id);
        if ($ajax=="0"){
            /*$titulo="";$logo='logoBayer.jpg';$publicitiesCampaigne=$products;
            return View::make('report/bayer/mercaderismo',compact('publicitiesCampaigne','titulo','logo'));*/
        }
        if ($ajax=="1"){
            if (count($publicity_stores)>0){
                foreach ($publicity_stores as $publicity_store) {
                    $photos = $this->mediaRepo->photosProductPollStore($poll_id, $store_id,$company_id,"0",$publicity_store->publicity_id,$visit_id);
                    if(! empty($photos)){

                        foreach ($photos as $photo){
                            $foto = $this->urlBase.$this->urlImagesFotos.$photo->archivo;
                        }
                    }else{
                        $foto = '';
                    }
                    $valores[] = array('id' =>$publicity_store->id,'publicity_id' => $publicity_store->publicity_id,'publicity' => $publicity_store->publicity->fullname,'company_id' => $publicity_store->company_id,'company_name' => $publicity_store->company->fullname,'store_id' => $publicity_store->store_id,'store' => $publicity_store->store->fullname,'created_at' => $publicity_store->created_at->toDateTimeString(),'updated_at' => $publicity_store->updated_at->toDateTimeString(),'foto' => $foto);
                    $success=1;
                }
            }else{
                $valores = [];$success=0;
            }
            
            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');
            return  Response::json([ 'success'=> $success,'publicity' => $valores]);
        }
    }

    public function getStockForPublicityAll($company_id="0",$ajax="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            $company_id = $valoresPost['company_id'];
            $ajax=1;
        }
        $valores = $this->stockProductPopRepo->getStockForPublicityAll($company_id);
        if ($ajax=="0"){
            /*$titulo="";$logo='logoBayer.jpg';$publicitiesCampaigne=$products;
            return View::make('report/bayer/mercaderismo',compact('publicitiesCampaigne','titulo','logo'));*/
        }
        if ($ajax=="1"){
            if (count($valores)>0){
                $success=1;
            }else{
                $success=0;
            }
            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');
            return  Response::json([ 'success'=> $success,'stock_product_pop' => $valores]);
        }

    }

    public function saveRegistersBayerMercaderismo()
    {
        $objPollDetail = $this->pollDetailRepo->getModel();
        //$objPollDetail->poll_id = 34;
        $valoresPost= Input::all();//dd($valoresPost);
        $poll_id = $valoresPost['poll_id'];
        $store_id= $valoresPost['store_id'];
        $sino= $valoresPost['sino'];
        $options= $valoresPost['options'];
        $limits= $valoresPost['limits'];
        $media= $valoresPost['media'];
        $coment= $valoresPost['coment'];
        $result= $valoresPost['result'];
        $limite= $valoresPost['limite'];
        $comentario= $valoresPost['comentario'];
        $auditor= $valoresPost['auditor'];
        $product_id= $valoresPost['product_id'];
        $publicity_id= $valoresPost['publicity_id'];
        $company_id = $valoresPost['company_id'];
        $category_product_id = $valoresPost['category_product_id'];
        $selectedOptions = $valoresPost['selectedOptions'];
        $selectedOptionsComment = $valoresPost['selectedOptionsComment'];
        $priority = $valoresPost['priority'];
        $stock_product_pop_id =$valoresPost['stock_product_pop_id'];
        $visit_id = $valoresPost['visit_id'];
        $mytime = Carbon::now();
        $horaSistema = $mytime->toDateTimeString();

        $objPollDetail->poll_id = $poll_id;//dd($objPollDetail->poll_id);
        $objPollDetail->store_id = $store_id;
        $objPollDetail->product_id = $product_id;
        $objPollDetail->publicity_id = $publicity_id;
        $objPollDetail->company_id = $company_id;
        $objPollDetail->category_product_id = $category_product_id;
        $objPollDetail->stock_product_pop_id = $stock_product_pop_id;
        $objPollDetail->visit_id = $visit_id;
        $valor = $this->pollDetailRepo->searchPollDetail($objPollDetail,"2");//dd(count($valor));
        $objPoll=$this->pollRepo->find($poll_id);
        $objAuditor = $this->userRepo->find($auditor);
        $datoAuditor = $objAuditor->fullname."(".$auditor.")";
        $campaigneDetail = $this->companyRepo->find($company_id);//dd($campaigneDetail);
        $customer =$this->customerRepo->find($campaigneDetail->customer_id);
        $cliente = $customer->corto;
        $textoContent = $campaigneDetail->fullname."".$objPoll->question." - Id= ".$store_id;
        $objStore = $this->storeRepo->find($store_id);
        $tipo_bodega = $objStore->tipo_bodega;
        $agente = $objStore->fullname;
        $dir = $objStore->codclient;
        $address = $objStore->address;
        $fono = $objStore->telephone."/".$objStore->cell;
        $district = $objStore->district." - ".$objStore->region." - ".$objStore->ubigeo;
        $foto = "";$nomPublicity="";

        $fechaHoraEnvio = $horaSistema;

        $textoContent = $campaigneDetail->fullname." ".substr($objPoll->question,0,10)."... - ".$objStore->cadenaRuc." Store: ".$store_id;


        if (count($valor)==0){
            $objPollDetail->sino = $sino;
            $objPollDetail->options = $options;
            $objPollDetail->limits = $limits;
            $objPollDetail->media = $media;
            $objPollDetail->coment = $coment;
            $objPollDetail->result = $result;
            $objPollDetail->limite = $limite;
            $objPollDetail->comentario = $comentario;
            $objPollDetail->auditor = $auditor;
            $objPollDetail->save();
            $idPollDetail = $objPollDetail->id;

            if ($objPollDetail->publicity_id<>0){
                $objPublicity = $this->publicityRepo->find($objPollDetail->publicity_id);
                $nomPublicity = $objPublicity->fullname;
            }

            //send emails

            if ($result == 0){
                $motivo = $objPoll->question."(Id: ".$objPoll->id.")".' Rsp. NO('.$idPollDetail.')';
            }else{
                $motivo = $objPoll->question."(Id: ".$objPoll->id.")".' Rsp SI('.$idPollDetail.')';
            }
            if ($nomPublicity<>""){
                $motivo .=" POP: ".$nomPublicity;
            }
            $questions = $this->getQuestionsSendEmail();$sw=0;
            foreach ($questions as $question)
            {
                if (($question['company_id']==$company_id) and ($question['poll_id']==$poll_id) and ($question['send']==1))
                {
                    if ($result == $question['result'])
                    {
                        if ($objPoll->identificador=='pop_encontrados'){
                            if ($objStore->type=='AASS'){
                                $motivo = "Existe stock de Producto (Id: ".$objPoll->id.")".' Rsp. NO('.$idPollDetail.')';
                                $sw=1;
                            }else{
                                $sw=0;
                            }
                        }else{
                            $sw=1;
                        }
                        if ($sw==1){
                            $gruposEmails = $this->getGroupsEmails();
                            $mascaras = explode('|',$question['mask']);
                            for($i=0;$i<count($mascaras);$i++) {
                                $emails = $gruposEmails[$mascaras[$i]];//dd($emails);
                                $this->sendEmails($store_id,$textoContent,$motivo,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails);
                            }
                        }
                        //sendEmails($store_id,$textoContent,$motivo,$auditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails)
                    }

                }
            }
            if ($objPollDetail->stock_product_pop_id<>0){
                $publicity_cabecera=564;
                $objStockProductPopAll = $this->stockProductPopRepo->getStockForPublicity($objStore->cadenaRuc,$publicity_cabecera,$company_id);
                $cant_prod_stock_min=count($objStockProductPopAll);
                $responseStock = $this->pollDetailRepo->searchPollDetail($objPollDetail,"3");
                if ($cant_prod_stock_min == count($responseStock)){
                    $c=0;
                    foreach ($responseStock as $response) {
                        foreach ($objStockProductPopAll as $stockProductPop){
                            if ($response->stock_product_pop_id==$stockProductPop->id){
                                if ($response->comentario<=$stockProductPop->minimo){
                                    $c=$c+1;
                                    if ($c==1){
                                        $motivo = $objPoll->question.'(Id: '.$objPoll->id.') Productos que NO cumplen Stock Mínimo:<br>';
                                    }
                                    $motivo .='<strong>'.'Producto: '.$stockProductPop->fullname.'('.$stockProductPop->unidad.')'.'</strong>'.'<br>'.' Stock Encontrado:'.$response->comentario.'<br>'.' Stock Mínimo: '.$stockProductPop->minimo.'<br>'.' Stock Optimo: '.$stockProductPop->optimo.'<br>';
                                }
                            }
                        }
                    }
                    foreach ($questions as $question)
                    {
                        if (($question['company_id']==$company_id) and ($question['poll_id']==$poll_id) and ($c>0))
                        {
                            $gruposEmails = $this->getGroupsEmails();
                            $mascaras = explode('|',$question['mask']);
                            for($i=0;$i<count($mascaras);$i++) {
                                $emails = $gruposEmails[$mascaras[$i]];//dd($emails);
                                if ($mascaras[$i]=="bayerMercaderismo")
                                {
                                    $emails=array('email' => 'david.zapata@bayer.com:David');
                                    $this->sendEmails($store_id,$textoContent,$motivo,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails,"M");
                                    if ($objStore->cadenaRuc=="MIFARMA")
                                    {
                                        $emails=array('email' => 'lourdes.ramirez@bayer.com:Lourdes');
                                        $this->sendEmails($store_id,$textoContent,$motivo,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails,"M");
                                    }
                                    if (($objStore->cadenaRuc=="UNIVERSAL_SURCO") OR ($objStore->cadenaRuc=="UNIVERSAL_CENTRAL"))
                                    {
                                        $emails=array('email' => 'rosaluz.carranza@bayer.com:Rosa');
                                        $this->sendEmails($store_id,$textoContent,$motivo,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails,"M");
                                    }
                                }else{
                                    $this->sendEmails($store_id,$textoContent,$motivo,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails,"M");
                                }

                            }

                        }
                    }
                }
            }
            //end send emails
        }else{
            $valor->sino = $sino;
            $valor->options = $options;
            $valor->limits = $limits;
            $valor->media = $media;
            $valor->coment = $coment;
            $valor->result = $result;
            $valor->limite = $limite;
            $valor->comentario = $comentario;
            $valor->auditor = $auditor;
            $valor->update();
            $idPollDetail = $valor->id;
        }
        $objPollDetailSearch = $this->pollDetailRepo->getModel();
        $ObjSearchPollDetail = $objPollDetailSearch::find($idPollDetail);//dd($selectedOptions);
        if ($ObjSearchPollDetail->options==1)
        {
            $opciones = explode('|',$selectedOptions);$c=0;
            $comentOpcion = explode('|',$selectedOptionsComment);//dd($opciones);
            if ($opciones[0]<>'')
            {
                foreach ($opciones as $valor) {
                    if ($valor<>''){
                        $consulta1 = $this->pollOptionRepo->getOptionsForPollCodigo($ObjSearchPollDetail->poll_id,$valor);//dd($consulta1[0]);
                        if (count($consulta1)>0){
                            $objPollOptionDetail = $this->pollOptionDetailRepo->getModel();
                            $objPollOptionDetail->poll_option_id=$consulta1[0]->id;
                            $objPollOptionDetail->store_id=$store_id;
                            $objPollOptionDetail->product_id=$product_id;
                            $objPollOptionDetail->company_id=$company_id;
                            $objPollOptionDetail->publicity_id=$publicity_id;
                            $objPollOptionDetail->visit_id = $visit_id;
                            $valorOption = $this->pollOptionDetailRepo->searchPollOptionDetail($objPollOptionDetail,"1");
                            if (count($valorOption)==0){
                                $objPollOptionDetail->result=1;
                                if (count($comentOpcion)>1){
                                    $objPollOptionDetail->otro=$comentOpcion[$c];
                                }else{
                                    $objPollOptionDetail->otro=$comentOpcion[0];
                                }

                                $objPollOptionDetail->auditor=$auditor;
                                $objPollOptionDetail->priority=$priority;
                                $objPollOptionDetail->save();
                                $idPollOptionDetail = $objPollOptionDetail->id;
                                //send emails
                                $motivo = $objPoll->question." (Id question: ".$objPoll->id.")"." (IdResp.: ".$idPollDetail.") opcion: ".$consulta1[0]->options.' ('.$idPollOptionDetail.')';
                                $questions = $this->getQuestionsSendEmail();
                                foreach ($questions as $question)
                                {
                                    if (($question['company_id']==$company_id) and ($question['poll_id']==$poll_id) and ($question['poll_option_id']==$consulta1[0]->id))
                                    {
                                        $gruposEmails = $this->getGroupsEmails();
                                        $mascaras = explode('|',$question['mask']);
                                        for($i=0;$i<count($mascaras);$i++) {
                                            $emails = $gruposEmails[$mascaras[$i]];dd($mascaras[$i]);
                                            $this->sendEmails($store_id,$textoContent,$motivo,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails,"M");
                                        }
                                    }
                                }
                                //end send emails
                            }else{
                                $valorOption->result=1;
                                $valorOption->otro=$comentOpcion[$c];
                                $valorOption->auditor=$auditor;
                                $valorOption->priority=$priority;
                                $valorOption->update();
                                $idPollOptionDetail = $valorOption->id;
                            }
                        }
                        $c=$c+1;
                    }
                }
            }else{
                $idPollOptionDetail=0;
            }

        }
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return Response::json([ 'success'=> 1, 'last_poll_detail_id' => $idPollDetail]);
    }

    public function pruebasClass(){
        $objStore=$this->storeRepo->find(81349);$company_id=79;
        $objPoll = $this->pollRepo->find(1443);
        $objPollDetail = $this->pollDetailRepo->find(948291);
        if ($objPollDetail->stock_product_pop_id<>0){
            $objStockProductPopAll = $this->stockProductPopRepo->getStockForPublicity($objStore->cadenaRuc,564,$company_id);
            $cant_prod_stock_min=count($objStockProductPopAll);
            $responseStock = $this->pollDetailRepo->searchPollDetail($objPollDetail,"3");
            if ($cant_prod_stock_min == count($responseStock)){
                $c=0;
                foreach ($responseStock as $response) {
                    foreach ($objStockProductPopAll as $stockProductPop){
                        if ($response->stock_product_pop_id==$stockProductPop->id){
                            if ($response->comentario<=$stockProductPop->minimo){
                                $c=$c+1;
                                if ($c==1){
                                    $motivo = $objPoll->question.'(Id: '.$objPoll->id.') Productos encontrados NO cumplen Stock Mínimo:<br>';
                                }
                                $motivo .='Producto: '.$stockProductPop->fullname.'('.$stockProductPop->unidad.')'.' Stock Encontrado:'.$response->comentario.' Stock Mínimo: '.$stockProductPop->minimo.' Stock Optimo: '.$stockProductPop->optimo.'<br>';
                            }
                        }
                    }
                }dd($motivo);
                /*foreach ($questions as $question)
                {
                    if (($question['company_id']==$company_id) and ($question['poll_id']==$poll_id))
                    {
                        $gruposEmails = $this->getGroupsEmails();
                        $mascaras = explode('|',$question['mask']);
                        for($i=0;$i<count($mascaras);$i++) {
                            $emails = $gruposEmails[$mascaras[$i]];//dd($emails);
                            $this->sendEmails($store_id,$textoContent,$motivo,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails);
                        }

                    }
                }*/
            }
        }
    }

    public function insertImagesMercaderista() {
        if(Input::hasFile('fotoUp')) {
            $archivo=Input::file('fotoUp');
            $archivo->move('media/fotos/',$archivo->getClientOriginalName());
        }
        $product_id = Input::only('product_id');
        $poll_id = Input::only('poll_id');
        $store_id = Input::only('store_id');
        $publicities_id = Input::only('publicities_id');
        $tipo = Input::only('tipo');
        $archivo = Input::only('archivo');
        $company_id = Input::only('company_id');
        $monto = Input::only('monto');
        $razon_social = Input::only('razon_social');
        $category_product_id = Input::only('category_product_id');
        $visit_id = Input::only('visit_id');
        $mytime = Carbon::now();
        $horaSistemaUpdate = $mytime->toDateTimeString();
        $horaSistema = Input::only('created_at');

        DB::insert("INSERT INTO medias (store_id,poll_id,publicities_id,product_id, tipo,archivo,company_id,category_product_id,monto,razon_social,visit_id, created_at,updated_at) 
					VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)" ,
            array(
                $store_id['store_id'],
                $poll_id['poll_id'],
                $publicities_id['publicities_id'],
                $product_id['product_id'],
                $tipo['tipo'],
                $archivo['archivo'],
                $company_id['company_id'],
                $category_product_id['category_product_id'],
                $monto['monto'],
                $razon_social['razon_social'],
                $visit_id['visit_id'],
                $horaSistema['created_at'],
                $horaSistemaUpdate
            )
        );

        return \Response::json([ 'success'=> 1]);
    }

    public function insertHistoryPublicityStore($company_id="0",$publicity_id="0",$store_id="0",$visit_id="0",$ajax="0"){
        $idPublicityStore=0;
        if ($company_id=="0"){
            $valoresPost= Input::all();
            $company_id = $valoresPost['company_id'];
            $ajax = 1;
            $store_id = $valoresPost['store_id'];
            $publicity_id = $valoresPost['publicity_id'];
            $visit_id = $valoresPost['visit_id'];
        }
        $objPublicityStore = $this->publicityStoreRepo->getModel();
        $objPublicityStore->publicity_id=$publicity_id;
        $objPublicityStore->company_id=$company_id;
        $objPublicityStore->visit_id=$visit_id;
        $objPublicityStore->store_id=$store_id;
        $valor = $this->publicityStoreRepo->searchPublicityStore($objPublicityStore);
        if (count($valor)==0){
            $objPublicityStore->save();
            $idPublicityStore = $objPublicityStore->id;
        }else{
            $valor->update();
            $idPublicityStore = $valor->id;
        }

        if ($ajax==1){
            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');
            if ($idPublicityStore<>0){
                return Response::json([ 'success'=> 1, 'last_publicity_store_id' => $idPublicityStore]);
            }else{
                return Response::json([ 'success'=> 0, 'last_publicity_store_id' => $idPublicityStore]);
            }
        }else{

        }
    }

    public function productsForRegion($company_id="0",$competencia="0",$ajax="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            $competencia = $valoresPost['competencia'];
            $company_id = $valoresPost['company_id'];
            $ajax=1;
        }
        $valores = $this->productDetailRepo->getAllProductForCity($company_id,$competencia);
        if ($ajax=="0"){
            /*$titulo="";$logo='logoBayer.jpg';$publicitiesCampaigne=$products;
            return View::make('report/bayer/mercaderismo',compact('publicitiesCampaigne','titulo','logo'));*/
        }
        if ($ajax=="1"){
            if (count($valores)>0){
                $success=1;
            }else{
                $success=0;
            }
            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');
            return  Response::json([ 'success'=> $success,'stock_product_pop' => $valores]);
        }

    }

    public function getCompaniesMercaderismo()
    {
        $campaignesClient = $this->companyRepo->getCompaniesForClient($this->customer_id,1,$this->estudio);
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> 1,'campaigne' => $campaignesClient]);
    }

    public function getRoadsForCampaigne($company_id)
    {
        $company = $this->companyRepo->find($company_id);
        $titulo = $company->fullname;
        $audit_id=0;
        $campaigneDetail = $this->companyRepo->find($company_id);
        $customer =$this->customerRepo->find($campaigneDetail->customer_id);//dd($customer);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $menu = "rutas";

        $roads =$this->auditRoadStoreRepo->getRoadsResumeForCompany($company_id);//dd($roads);
        $cliente='Bayer Mercaderismo';

        return View::make('report/listRoadsMerca',compact('cliente','titulo','logo','menu','roads','audit_id','company_id'));

    }

    public function getDetailRoad($road_id,$company_id)
    {
        $road = $this->roadRepo->find($road_id);
        $roadDetails = $this->roadDetailRepo->getDetailStores($road_id);$auditados=0;
        $menu = "rutas";

        $company = $this->companyRepo->find($company_id);
        $titulo = $company->fullname;
        $audit_id=0;
        $customer =$this->customerRepo->find($company->customer_id);//dd($customer);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;//dd($roadDetails);
        $cliente='Bayer Mercaderismo';

        foreach ($roadDetails as  $roadDetail)
        {//dd($roadDetail);
            if($roadDetail->company_id==$company_id){
                $roadDetalles[] = $roadDetail;
                if($roadDetail->audit==1) $auditados ++;
            }
        }
        //dd($roadDetalles);
        return View::make('report/bayer/showRoadMerca',compact('company_id','road','roadDetalles','auditados','menu','titulo','audit_id','logo'));
    }

    public function getDetailQuestion($poll_id,$values,$company_id,$poll_option_id="0",$product_id="0",$publicity_id="0")
    {
        //getDetailQuestionBayerMercaderismo/{poll_id}/{values}/{company_id}/{poll_option_id?}/{product_id?}/{publicity_id?}

        $urlBase = $this->urlBase;
        $urlImages = $this->urlImagesFotos;
        $valores = explode('-',$values);
        //$values = $textoResp.'-'.$respuesta.'-'.$type.'-'.$cadena.'-'.$visit_id;
        $texto = $valores[0];
        $pregSino = $valores[1];
        $type = $valores[2];
        $cadena = $valores[3];
        $visit_id = $valores[4];

        $menu="detalle";
        $objPoll = $this->pollRepo->find($poll_id);
        $customer =$this->customerRepo->find($this->customer_id);//dd($customer);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $titulo='Detalle de respuestas';
        $subTitulo = $objPoll->question.' Respuesta: '.$texto;

        //$regs = $this->pollDetailRepo->detailsResponseSiNo($company_id,$poll_id,1,$pregSino,$publicity_id,$product_id,$type,$cadena,"0");dd($regs[0]);

        return View::make('report/bayer/mercaderismoDetailQuestion',compact('visit_id','menu','titulo','logo','subTitulo','poll_id','pregSino','type','cadena','company_id','poll_option_id','product_id','publicity_id'));

    }

    public function getAjaxResponsesForQuestion()
    {
        $valoresPost= Input::all();
        $company_id = $valoresPost['company_id'];
        $poll_id = $valoresPost['poll_id'];
        $visit_id = $valoresPost['visit_id'];
        $pregSino = $valoresPost['pregSino'];
        $publicity_id = $valoresPost['publicity_id'];
        $product_id = $valoresPost['product_id'];
        $type = $valoresPost['type'];
        $cadena = $valoresPost['cadena'];
        $poll_option_id = $valoresPost['poll_option_id'];

        $success=0;
        if ($poll_option_id=="0")
        {
            $regs = $this->pollDetailRepo->detailsResponseSiNo($company_id,$poll_id,$visit_id,$pregSino,$publicity_id,$product_id,$type,$cadena,"0");
        }
        if (count($regs)>0){
            foreach ($regs as $reg) {
                if ($reg->auditor<>0)
                {
                    $user = $this->userRepo->find($reg->auditor);
                }else{
                    $user = [];
                }


                $photos = $this->mediaRepo->photosProductPollStore($poll_id, $reg->store_id,$company_id,$product_id,$publicity_id);

                if(! empty($photos)){
                    foreach ($photos as $photo){
                        $datosFoto[] = array('id' => $photo->id,'archivo' => $photo->archivo, 'urlFoto' => $this->urlBase.$this->urlImagesFotos.$photo->archivo);
                    }
                }else{
                    $datosFoto = [];
                }

                $valores[] = array('poll_detail' =>$reg,'auditor' => $user,'fotos' => $datosFoto);
                $success=1;unset($datosFoto);
            }
        }else{
            $valores = [];$success=0;
        }

        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> $success,'details' => $valores]);

    }

    public function getPricesOfProductsFound($company_id="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            if (count($valoresPost)<>0){
                $ubigeoext = "0";
                $cadena = "0";
                $type = "0";
                /*$ubigeoext = $valoresPost['ubigeo'];
                $cadena = $valoresPost['cadena'];
                $horizontal = $valoresPost['horizontal'];*/
                $company_id = $valoresPost['company_id'];
                /* $ejecutivo = $valoresPost['ejecutivo'];*/
                $company = $this->companyRepo->find($company_id);
                $titulo = 'Levantamiento de Precios '.$company->fullname;
            }else{
                $ubigeoext = "0";
                $cadena = "0";
                $type = "0";
                $ObjCompany_id=$this->companyRepo->getFirstCurrentCampaigns($this->customer_id,$this->estudio);
                $company_id=$ObjCompany_id->id;
                $company = $this->companyRepo->find($company_id);
                $titulo = 'Levantamiento de Precios '.$company->fullname;
            }
        }else{
            $ubigeoext = "0";
            $cadena = "0";
            $type="0";
            $company = $this->companyRepo->find($company_id);
            $titulo = 'Levantamiento de Precios '.$company->fullname;
        }
        $customer =$this->customerRepo->find($this->customer_id);//dd($customer);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $campaignesClient = $this->companyRepo->getCompaniesForClient($customer->id,1,$this->estudio);//Para combo de cambio de campañas collection array de objetos Company
        $campaignes = array(0 => "Períodos") + $campaignesClient->lists('fullname','id');
        $urlBase = $this->urlBase."/mercaderismo/foundPrices/";

        $typeStores = $this->storeRepo->getTypeStoreForCampaigne($company_id,1);
        $types = array(0 => "Seleccionar Canal") + $typeStores->lists('type','type');
        $subtitulo = "";
        $menu="precios";
        return View::make('report/bayer/mercaderismoPrecios',compact('campaignes','menu','subtitulo','urlBase','titulo','logo','types','company_id'));
    }

    public function getAjaxPricesOfProducts()
    {
        $valoresPost= Input::all();
        $company_id = $valoresPost['company_id'];
        $chanel = $valoresPost['chanel'];
        $client = $valoresPost['client'];
        $category_product_id = $valoresPost['category_product_id'];
        foreach ($this->pollsWeb as $pollWeb) {
            if (($pollWeb['identificador']=='precio') and ($pollWeb['company_id']==$company_id))
            {
                $pollPrecio = $pollWeb['poll_id'];
            }

        }
        $categories = $this->productDetailRepo->getProductsForCategory($company_id,$category_product_id);
        $success=0;//dd($categories->toArray());
        if (count($categories)>0){$value_products='';$c=0;
            foreach ($categories as $producto) {
                $c=$c+1;
                if ($c==count($categories)){
                    $value_products .=$producto->product_id;
                }else{
                    $value_products .=$producto->product_id.",";
                }
            }

            $regs = $this->pollDetailRepo->detailsResponseComment($company_id,$pollPrecio,"0",$value_products,$chanel,$client,"0",$category_product_id);
            //dd($regs->toArray());
            if (count($regs)>0){
                //dd($regs);

                $clients = $regs->groupBy(function($item){ return $item->cadenaRuc; });
                //dd($clients);
                $success=1;
                foreach ($clients as $index => $reg) {
                    $regColl = Collection::make($reg);
                    $porProductos =  $regColl->groupBy(function($item){ return $item->product_id; });
                    $cliente0 = array('tipo'=>$index);$productos0 =[];
                    foreach ($porProductos as $porProduct_id => $porProducto) {
                        $producto = $this->productRepo->find($porProduct_id);
                        $rege=Collection::make($porProducto);//dd($rege[0]);
                        foreach ($rege as $item) {
                            $precios[] = array('store_id'=>$item->store_id,'precio'=>floatval($item->comentario),'poll_details_id'=>$item->id);
                        }

                        $cant = $rege->count();
                        $totalVolume = $rege->sum(function ($re) {
                            return $re->comentario;
                        });
                        $promedio = round($totalVolume/$cant,2);

                        $cliente1 = array($producto->fullname=>$promedio);
                        $productos0 = array_merge($productos0,$cliente1);
                        $clientes[] = array('cliente'=>$index,'producto'=>$producto->fullname,'precios'=>$precios,'promedio'=>$promedio,'cantidad'=>$cant);
                    }
                    $valoresPop[] = array_merge($cliente0,$productos0);

                }
                //dd($valoresPop);

            }
            $detalles[] = array('producto'=>$producto->fullname,'clientes'=>$clientes);

        }else{
            $valoresPop = [];$success=0;
        }

        //dd($valoresPop);

        $valPopJson =json_encode($valoresPop);unset($valoresPop);

        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> $success,'datos' => $valPopJson,'detalles' => $detalles]);
    }

    public function getCategoryProductForType($company_id="0",$type="0",$ajax="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            $company_id = $valoresPost['company_id'];
            $ajax = 1;
            $type = $valoresPost['type'];
        }
        $success=0;
        $categories = $this->productStoreRegionRepo->getCategoriesProductsForCampaigneForTypeStore($company_id,$type);
        if ($ajax=="0"){//web

        }
        if ($ajax=="1"){//json
            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');
            return  Response::json($categories);
        }

    }

    public function getProductsForCategory($company_id="0",$category="0",$ajax="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            $company_id = $valoresPost['company_id'];
            $ajax = 1;
            $category = $valoresPost['category'];
        }
        $success=0;
        $categories = $this->productDetailRepo->getProductsForCategory($company_id,$category);
        if ($ajax=="0"){//web
            return $categories;
        }
        if ($ajax=="1"){//json
            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');
            return  Response::json($categories);
        }
    }

    public function getClientsForChanel($company_id="0",$type="0",$ajax="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            $company_id = $valoresPost['company_id'];
            $ajax = 1;
            $type = $valoresPost['type'];
        }
        $success=0;
        $clients = $this->companyStoreRepo->getGroupClients($company_id,$type);
        if ($ajax=="0"){//web
            return $clients;
        }
        if ($ajax=="1"){//json
            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');
            return  Response::json($clients);
        }
    }

    public function getExcels()
    {
        $ObjCompany_id=$this->companyRepo->getFirstCurrentCampaigns($this->customer_id,$this->estudio);
        $company_id=$ObjCompany_id->id;
        $company = $this->companyRepo->find($company_id);
        $titulo='Período Vigente '.$company->fullname;
        $customer =$this->customerRepo->find($this->customer_id);//dd($customer);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $campaignesClient = $this->companyRepo->getCompaniesForClient($customer->id,1,$this->estudio);//Para combo de cambio de campañas collection array de objetos Company
        $campaignes = array(0 => "Períodos") + $campaignesClient->lists('fullname','id');
        $urlBase = $this->urlBase."/mercaderismo/getExcelsBayerMercaderismo";
        $excels[] = array('nombre'=>'Excel Regular Bayer Mercaderismo','url' =>$this->urlBase.'/excelPresenPopMercaBayer/'.$company_id.'/1/0');
        $excels[] = array('nombre'=>'Excel Cabeceras','url' =>$this->urlBase.'/excelPresenPopMercaBayerCabe/'.$company_id.'/');
        $excels[] = array('nombre'=>'Excel AASS','url' =>$this->urlBase.'/excelPresenPopMercaBayerAASS/'.$company_id.'/1');
        $excels[] = array('nombre'=>'Publicidades encontradas Competencias','url' =>$this->urlBase.'/excelPresenPopMercaBayerComp/'.$company_id);
        $excels[] = array('nombre'=>'Levantamiento de Precios','url' =>$this->urlBase.'/productsPriceCompetityAll/'.$company_id);
        $menu="excels";

        return View::make('report/bayer/mercaderismoExcels',compact('campaignes','menu','urlBase','titulo','logo','excels','company_id'));
    }

} 