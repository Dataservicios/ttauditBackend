<?php
/**
 * Created by PhpStorm.
 * User: Webmaster
 * Date: 25/06/2015
 * Time: 02:50 PM
 */

use Auditor\Repositories\ProjectionSaleRepo;
use Auditor\Repositories\OrderRepo;
use Auditor\Repositories\CompanyRepo;
use Auditor\Repositories\UserRepo;
use Auditor\Repositories\PublicityCampaigneRepo;
use Auditor\Repositories\OrderDetailRepo;
use Auditor\Repositories\PollRepo;
use Auditor\Repositories\CustomerRepo;
use Auditor\Repositories\PollDetailRepo;
use Auditor\Repositories\RoadDetailRepo;
use Auditor\Repositories\CompanyStoreRepo;
use Auditor\Repositories\PublicityStoreRepo;
use Auditor\Repositories\VersionRepo;
use Auditor\Repositories\AuditRoadStoreRepo;
use Auditor\Repositories\StoreRepo;
use Illuminate\Support\Collection;
use Auditor\Repositories\PublicityRepo;
use Auditor\Repositories\ProjectionSaleDetailRepo;
use Auditor\Repositories\PollOptionRepo;
use Auditor\Repositories\PollOptionDetailRepo;


class ProspeccionBayerController extends BaseController{

    protected $projectionSaleRepo;
    protected $orderRepo;
    protected $companyRepo;
    protected $userRepo;
    protected $publicityCampaigneRepo;
    protected $orderDetailRepo;
    protected $pollRepo;
    protected $customerRepo;
    protected $pollDetailRepo;
    protected $roadDetailRepo;
    protected $companyStoreRepo;
    protected $publicityStoreRepo;
    protected $versionRepo;
    protected $auditRoadStoreRepo;
    protected $storeRepo;
    protected $publicityRepo;
    protected $projectionSaleDetailRepo;
    protected $pollOptionRepo;
    protected $pollOptionDetailRepo;

    public $urlBase;
    public $urlImagesFotos;
    public $urlImageBase;
    public $estudio;
    public $customer_id;
    public $pollsWeb;

    public function __construct(PollOptionDetailRepo $pollOptionDetailRepo,PollOptionRepo $pollOptionRepo,ProjectionSaleDetailRepo $projectionSaleDetailRepo,PublicityRepo $publicityRepo,StoreRepo $storeRepo,AuditRoadStoreRepo $auditRoadStoreRepo,VersionRepo $versionRepo,PublicityStoreRepo $publicityStoreRepo,CompanyStoreRepo $companyStoreRepo,RoadDetailRepo $roadDetailRepo,PollDetailRepo $pollDetailRepo,CustomerRepo $customerRepo,PollRepo $pollRepo,OrderDetailRepo $orderDetailRepo,PublicityCampaigneRepo $publicityCampaigneRepo,ProjectionSaleRepo $projectionSaleRepo,OrderRepo $orderRepo,CompanyRepo $companyRepo,UserRepo $userRepo)
    {
        $this->projectionSaleRepo=$projectionSaleRepo;
        $this->orderRepo = $orderRepo;
        $this->companyRepo=$companyRepo;
        $this->userRepo=$userRepo;
        $this->publicityCampaigneRepo = $publicityCampaigneRepo;
        $this->orderDetailRepo = $orderDetailRepo;
        $this->pollRepo = $pollRepo;
        $this->customerRepo = $customerRepo;
        $this->pollDetailRepo = $pollDetailRepo;
        $this->roadDetailRepo = $roadDetailRepo;
        $this->companyStoreRepo = $companyStoreRepo;
        $this->publicityStoreRepo = $publicityStoreRepo;
        $this->versionRepo = $versionRepo;
        $this->auditRoadStoreRepo = $auditRoadStoreRepo;
        $this->storeRepo = $storeRepo;
        $this->publicityRepo = $publicityRepo;
        $this->projectionSaleDetailRepo = $projectionSaleDetailRepo;
        $this->pollOptionRepo = $pollOptionRepo;
        $this->pollOptionDetailRepo=$pollOptionDetailRepo;

        $this->urlBase = \App::make('url')->to('/');
        $this->urlImagesFotos = '/media/fotos/';
        $this->urlImageBase = '/media/images/';
        $this->customer_id = 5;
        $this->estudio=13;
        $this->pollsWeb =$this->getAllPollsWeb($this->customer_id,$this->estudio);
    }

    public function getProjectionSales($company_id="0",$store_id="0",$visit_id="0",$product_id="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            if (count($valoresPost)<>0){
                $company_id = $valoresPost['company_id'];
                $store_id = $valoresPost['store_id'];
                $visit_id = $valoresPost['visit_id'];
                $product_id = $valoresPost['product_id'];
            }
        }
        $objProjection = $this->projectionSaleRepo->getModel();
        if ($product_id<>"0")
        {
            $regsProjection = $objProjection->where('company_id',$company_id)->where('store_id',$store_id)->where('product_id',$product_id)->where('list_prices',0)->get();
        }else{
            $regsProjection = $objProjection->where('company_id',$company_id)->where('store_id',$store_id)->where('list_prices',0)->get();
        }

        if (count($regsProjection)>0)
        {
            $success=1;
        }else{
            $success=0;
        }
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> $success,'regs' => $regsProjection]);
    }

    public function getPricesForProduct($company_id="0",$product_id="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            if (count($valoresPost)<>0){
                $company_id = $valoresPost['company_id'];
                $product_id = $valoresPost['product_id'];
            }
        }
        $regsProjection = $this->projectionSaleRepo->getPricesForProduct($product_id,$company_id);
        if (count($regsProjection)>0)
        {
            $success=1;
        }else{
            $success=0;
        }
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> $success,'regs' => $regsProjection]);
    }

    public function saveOrder()
    {
        $valoresPost= Input::all();
        $company_id = $valoresPost['company_id'];
        /*if ($company_id==166)
        {
            $type_payment = $valoresPost['type_payment'];
        }*/
        $type_payment = $valoresPost['type_payment'];
        $product_id = $valoresPost['product_id'];
        $store_id = $valoresPost['store_id'];
        $provider_id = $valoresPost['provider_id'];
        $quantity = $valoresPost['quantity'];
        $price = $valoresPost['price'];
        $amount = $valoresPost['amount'];
        $auditor_id = $valoresPost['auditor_id'];
        $visit_id = $valoresPost['visit_id'];
        $code = $valoresPost['code'];
        $objOrder = $this->orderRepo->getModel();
        $regOrders=$objOrder->where('code',$code)->first();
        if (count($regOrders)==0)
        {
            $objOrder->company_id=$company_id;
            $objOrder->provider_id=$provider_id;
            $objOrder->store_id=$store_id;
            $objOrder->auditor_id=$auditor_id;
            $objOrder->visit_id=$visit_id;
            $objOrder->code=$code;
            /*if ($company_id==166)
            {
                $objOrder->type_payment=$type_payment;
            }*/
            $objOrder->type_payment=$type_payment;
            $objOrder->save();
            $idOrder = $objOrder->id;
        }else{
            $idOrder = $regOrders->id;
        }
        $objOrderDetail = $this->orderDetailRepo->getModel();
        $regOrderDetails = $objOrderDetail->where('order_id',$idOrder)->where('product_id',$product_id)->where('quantity',$quantity)->where('price',$price)->where('amount',$amount)->first();
        if (count($regOrderDetails)==0)
        {
            $objOrderDetail->order_id=$idOrder;
            $objOrderDetail->product_id=$product_id;
            $objOrderDetail->quantity = $quantity;
            $objOrderDetail->price = $price;
            $objOrderDetail->amount = $amount;
            $objOrderDetail->save();
        }

        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> 1]);
    }

    public function updateStockMinMax()
    {
        $valoresPost= Input::all();
        $company_id = $valoresPost['company_id'];
        $product_id = $valoresPost['product_id'];
        $store_id = $valoresPost['store_id'];
        $visit_id = $valoresPost['visit_id'];
        $stock_min = $valoresPost['stock_min'];
        $stock_max = $valoresPost['stock_max'];
        $objProjection = $this->projectionSaleRepo->getModel();
        $regObjProjection=$objProjection->where('company_id',$company_id)->where('product_id',$product_id)->where('store_id',$store_id)->first();
        $regObjProjection->stock_min=$stock_min;
        $regObjProjection->stock_max=$stock_max;
        $regObjProjection->visit_id = $visit_id;

        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        if ($regObjProjection->save())
        {
            $objProjectionSaleDetail = $this->projectionSaleDetailRepo->getModel();
            $regObjProjectionDetail=$objProjectionSaleDetail->where('projection_sale_id',$regObjProjection->id)->where('visit_id',$visit_id)->first();
            if (count($regObjProjectionDetail)==0)
            {
                $objProjectionSaleDetail->projection_sale_id=$regObjProjection->id;
                $objProjectionSaleDetail->stock_min=$stock_min;
                $objProjectionSaleDetail->stock_max=$stock_max;
                $objProjectionSaleDetail->visit_id = $visit_id;
                $objProjectionSaleDetail->company_id = $company_id;
                $objProjectionSaleDetail->save();
            }else{
                $regObjProjectionDetail->stock_min=$stock_min;
                $regObjProjectionDetail->stock_max=$stock_max;
                $regObjProjectionDetail->visit_id = $visit_id;
                $regObjProjectionDetail->save();
            }

            return  Response::json([ 'success'=> 1]);
        }else{
            return  Response::json([ 'success'=> 0]);
        }
    }

    public function getUsersTypeLaboratory($company_id="0")
    {
        if ($company_id=="0")
        {
            $valoresPost= Input::all();
            $company_id = $valoresPost['company_id'];
        }

        $campaigneDetail = $this->companyRepo->find($company_id);
        $customer_id=$campaigneDetail->customer_id;
        $regsUserLaboratory = $this->userRepo->getUsersForType('Laboratory',$customer_id,$company_id);
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        if (count($regsUserLaboratory)>0)
        {
            return  Response::json([ 'success'=> 1,'regs' => $regsUserLaboratory]);
        }else{
            return  Response::json([ 'success'=> 0,'regs' => $regsUserLaboratory]);
        }

    }

    public function getUsersTypeProvider($company_id="0")
    {
        if ($company_id=="0")
        {
            $valoresPost= Input::all();
            $company_id = $valoresPost['company_id'];
        }

        $campaigneDetail = $this->companyRepo->find($company_id);
        $customer_id=$campaigneDetail->customer_id;
        $regsUserLaboratory = $this->userRepo->getUsersForType('Provider',$customer_id,$company_id);
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        if (count($regsUserLaboratory)>0)
        {
            return  Response::json([ 'success'=> 1,'regs' => $regsUserLaboratory]);
        }else{
            return  Response::json([ 'success'=> 0,'regs' => $regsUserLaboratory]);
        }

    }

    public function getPublicitiesForCampaigne($company_id="0",$ajax="0",$type="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            $company_id = $valoresPost['company_id'];
            $type = $valoresPost['type'];
            //$ajax = $valoresPost['ajax'];
            $ajax=1;
        }
        $publicitiesCampaigne =$this->publicityCampaigneRepo->getPublicityForCampaigne($company_id,$type);//dd($publicitiesCampaigne);
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


    //web
    public function resumeHome($company_id="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            if (count($valoresPost)<>0){
                $ubigeoext = "0";
                $cadena = "0";
                $type = "0";
                $company_id = $valoresPost['company_id'];
                $company = $this->companyRepo->find($company_id);
                $titulo = 'Resumen Período '.$company->fullname;
            }else{
                $ubigeoext = "0";
                $cadena = "0";
                $type = "0";
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
            /*if (($pollWeb['identificador']=='permitio') and ($pollWeb['company_id']==$company_id))
            {
                $pollPermitio = $pollWeb['poll_id'];
            }*/
            if (($pollWeb['identificador']=='pop_encontrados') and ($pollWeb['company_id']==$company_id))
            {
                $pollPopEncontrado = $pollWeb['poll_id'];
            }
            if (($pollWeb['identificador']=='estado') and ($pollWeb['company_id']==$company_id))
            {
                $pollEstado = $pollWeb['poll_id'];
            }
            /*if (($pollWeb['identificador']=='competencia') and ($pollWeb['company_id']==$company_id))
            {
                $pollCompetencia = $pollWeb['poll_id'];
            }*/
        }
        $totalBaseBayer = $this->publicityStoreRepo->getAllPublicitiesBayerStart($company_id,"0","0","0","0",1);
        $customer =$this->customerRepo->find($this->customer_id);//dd($customer);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $campaignesClient = $this->companyRepo->getCompaniesForClient($customer->id,1,$this->estudio,"T");//Para combo de cambio de campañas collection array de objetos Company
        $campaignes = array(0 => "Períodos") + $campaignesClient->lists('fullname','id');
        $urlBase = $this->urlBase."/transferencista/resumeHome/";$type="CADENA";

        //$type='MINI CADENAS';

        $base_abiertos = $this->pollDetailRepo->detailsResponseSiNoAudits($company_id,$pollAbierto,1,1,"0","0",$type,$cadena,"0");

        $stores_abiertos="";$c=0;
        foreach ($base_abiertos as $base_abierto) {
            $stores_abiertos .= $base_abierto->store_id;
            $c=$c+1;
            if (count($base_abiertos) > $c)
            {
                $stores_abiertos .=",";
            }
        }

        $respuestaSI = $base_abiertos;
        $respuestaNO = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollAbierto,1,"0","0","0",$type,$cadena,$ubigeoext);
        $respuestas = count($respuestaNO)+count($respuestaSI);
        $totalAbiertos = count($totalBaseBayer);
        $valSiNo[0] = array("tipo" => 'Abierto', "cantidad" => count($respuestaSI), "color" => '#97C74F');
        $valSiNo[1] = array("tipo" => 'Cerrado', "cantidad" => count($respuestaNO), "color" => '#1AB1E6');
        $valAbiertosJson =json_encode($valSiNo);unset($valSiNo);

        if (count($respuestaNO)>0){

            $linkCerrados = $pollAbierto."/"."Cerrados-0-".$type."-".$cadena."-1/".$company_id."/"."0/0/0";
        }else{
            $linkCerrados = 0;
        }


        $publicities = $this->publicityCampaigneRepo->getPublicitiesForCampaigne($company_id);
        $colorEncontradoPop[0] = '#1A8EC7';
        $colorEncontradoPop[1] = '#84CFF4';
        $colorEncontradoPop[2] = '#B5E4FB';
        $baseBayers = $this->roadDetailRepo->getStoresAudits($company_id,1,1);$c=0;$baseBayer=0;
        foreach ($baseBayers as $baseBayer1) {
            if (($baseBayer1->type<>'AASS') and ($baseBayer1->chanel_store_id==1)){
                $baseBayer = $baseBayer+1;
            }
        }

        $totalPdvs = $this->companyStoreRepo->getCountPDV($company_id);$totalBaseBayer=0;
        foreach ($totalPdvs as $totalPdv) {
            if (($totalPdv->type<>'AASS') and ($totalPdv->chanel_store_id==1))
            {
                $totalBaseBayer = $totalBaseBayer+1;
            }
        }
        $sqlcoord="CALL sp_getStoresAuditForChanelStore(".$company_id.",1,1)";
        $storesTotal = DB::select($sqlcoord);
        $totalBaseBayer = count($storesTotal);

        foreach ($publicities as $publicity) {

            if ($publicity->publicity_id<>568)
            {
                $encontrados = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopEncontrado,1,1,$publicity->publicity_id,"0",$type,$cadena,$ubigeoext,$stores_abiertos);
                //dd(count($encontrados));
                //$base = $this->publicityStoreRepo->getPublicityInStore($publicity->publicity_id,"0",$company_id,0,$type,$cadena);
                $baseP = $this->publicityStoreRepo->getAllPublicitiesBayerStart($company_id,$publicity->publicity_id,"0",$type,$cadena);
                $base = $totalBaseBayer;
                $buenEstado = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollEstado,1,1,$publicity->publicity_id,"0",$type,$cadena,$ubigeoext,$stores_abiertos);
                $basePrinc = $base;//Num de puntos con AASS
                if ($basePrinc<>0){
                    $enconPorc = round(count($encontrados)/$totalAbiertos*100,0);
                    $buenPrinc = round(count($buenEstado)/$totalAbiertos*100,0);

                }else{
                    $enconPorc=0;
                    $buenPrinc=0;
                }

                $detalleItems[]=array('texto'=>'Bayer','cantidad'=>$totalAbiertos,'porcentaje' =>round($totalAbiertos/$basePrinc*100,0),'color'=>$colorEncontradoPop[0]);
                $detalleItems[]=array('texto'=>'Presencia','cantidad'=>count($encontrados),'porcentaje' =>$enconPorc,'color'=>$colorEncontradoPop[1]);
                $detalleItems[]=array('texto'=>'Buen Estado','cantidad'=>count($buenEstado),'porcentaje' =>$buenPrinc,'color'=>$colorEncontradoPop[2]);
                $detalleEncontradosPop[] = array('tipo'=> $publicity->publicity->fullname,'detalles'=>$detalleItems);
                unset($detalleItems);
                $valoresPop[] = array('tipo'=>$publicity->publicity->fullname,'Bayer'=>round($totalAbiertos/$basePrinc*100,0),'Presencia'=>$enconPorc,'Buen Estado'=>$buenPrinc);
            }

        }
        $valPopJson =json_encode($valoresPop);unset($valoresPop);
        $valColorEncontradosPop = json_encode($colorEncontradoPop);
        $menu="resumen";

        return View::make('report/bayer/prospeccion',compact('totalBaseBayer','valColorEncontradosPop','detalleEncontradosPop','linkNoPermitio','linkCerrados','campaignes','menu','urlBase','titulo','logo','valAbiertosJson','valPopJson','company_id'));
    }

    //web
    public function getExcels($company_id="0")
    {
        if ($company_id=="0"){
            $ObjCompany_id=$this->companyRepo->getFirstCurrentCampaigns($this->customer_id,$this->estudio);
            $company_id=$ObjCompany_id->id;
        }

        $company = $this->companyRepo->find($company_id);
        $titulo='Período Vigente '.$company->fullname;
        $customer =$this->customerRepo->find($this->customer_id);//dd($customer);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $campaignesClient = $this->companyRepo->getCompaniesForClient($customer->id,1,$this->estudio);//Para combo de cambio de campañas collection array de objetos Company
        $campaignes = array(0 => "Períodos") + $campaignesClient->lists('fullname','id');
        $urlBase = $this->urlBase."/transferencista/getExcels";
        $valoresLinksExcels = $this->versionRepo->getRegisterForCompany($company_id);
        if (count($valoresLinksExcels)>0)
        {
            foreach ($valoresLinksExcels as $valoresLinksExcel) {
                $excels[] = array('nombre'=> $valoresLinksExcel->title,'url' => $this->urlBase."/".$valoresLinksExcel->url);
            }
        }else{
            $excels=[];
        }


        $menu="excels";

        return View::make('report/bayer/prospeccionExcels',compact('campaignes','menu','urlBase','titulo','logo','excels','company_id'));
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

        $roads =$this->auditRoadStoreRepo->getRoadsResumeForCompany($company_id);
        $cliente='Bayer Transferencista';

        return View::make('report/listRoadsTransf',compact('cliente','titulo','logo','menu','roads','audit_id','company_id'));

    }

    public function getDetailPopEncontrado($company_id="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            if (count($valoresPost)<>0){
                $cliente = $valoresPost['cliente'];
                $publicity_id = $valoresPost['publicity_id'];
                $type = $valoresPost['type'];$type='CADENA';
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
            $titulo = 'Detalle POP Período '.$company->fullname;
        }
        foreach ($this->pollsWeb as $pollWeb)
        {
            if (($pollWeb['identificador']=='abierto') and ($pollWeb['company_id']==$company_id))
            {
                $pollPopAbierto = $pollWeb['poll_id'];
            }
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

        //$typeStores = $this->storeRepo->getTypeStoreForCampaigne($company_id,2);
        $types = array(0 => "Seleccionar Canal") + array("CADENA" => "CADENA");
        $popsCompanies = $this->getPublicitiesCampaigne($company_id,0);
        $collectionPops = Collection::make($popsCompanies);
        $pops = array(0=>'Seleccionar POP') + $collectionPops->lists('fullname','id');
        $menu="detalle";
        $leyenda="0";

        if ($publicity_id<>"0")
        {
            $base_abiertos = $this->pollDetailRepo->detailsResponseSiNoAudits($company_id,$pollPopAbierto,1,1,"0","0",$type,$cliente,"0");
            //dd(count($base_abiertos));
            $stores_abiertos="";$c=0;
            foreach ($base_abiertos as $base_abierto) {
                $stores_abiertos .= $base_abierto->store_id;
                $c=$c+1;
                if (count($base_abiertos) > $c)
                {
                    $stores_abiertos .=",";
                }
            }
            $base_pop_encontrados = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopEncontrado,1,1,$publicity_id,"0",$type,$cliente,"0",$stores_abiertos);
            $stores_pop_encontrados="";$c=0;
            foreach ($base_pop_encontrados as $base_abierto) {
                $stores_pop_encontrados .= $base_abierto->store_id;
                $c=$c+1;
                if (count($base_pop_encontrados) > $c)
                {
                    $stores_pop_encontrados .=",";
                }
            }
            $objPublicity = $this->publicityRepo->find($publicity_id);
            $leyenda = $type.", ".$cliente.", ".$objPublicity->fullname;
            //encontrado
            $num_visitas = $this->pollDetailRepo->getVisitStores($company_id,$publicity_id,"0",$type,$cliente);

            $num_end_visit = $this->pollDetailRepo->getEndVisitStores($company_id,$publicity_id,"0",$type,$cliente);//dd($company_id,$publicity_id,"0",$type,$cliente,$num_end_visit);
            $num_end_visit_end = $num_end_visit->visit_id;//dd($company_id,$publicity_id,$num_end_visit->visit_id);
            //$base = $this->publicityStoreRepo->getPublicityInStore($publicity_id,"0",$company_id,0,$type,$cliente);
            //dd($company_id,$publicity_id,"0",$type,$cliente);
            $base = $this->publicityStoreRepo->getAllPublicitiesBayerStart($company_id,$publicity_id,"0",$type,$cliente);
            //$valoresPopEncontrado[] = array('tipo'=>$objPublicity->fullname,'Base'=>count($base),'presencia'=>count($encontrados));
            if (count($base)>0)
            {
                $valoresPopEncontrado[] = array('respuesta' => 'Bayer', 'cantidad' => count($base), "porcentaje" => 100);
                if ((count($num_visitas)>0) and (2>3))//cabecera y vitrina
                {
                    foreach ($num_visitas as $num_visita) {
                        $encontrados = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopEncontrado,$num_visita->visit_id,1,$publicity_id,"0",$type,$cliente,"0");//dd($company_id,$pollPopEncontrado,$num_visita->visit_id,$encontrados->toArray());
                        $porcEncontrados = count($encontrados)/count($base)*100;
                        $valoresPopEncontrado[] = array('respuesta' => "Visita: ".$num_visita->visit_id, 'cantidad' => count($encontrados), "porcentaje" => round($porcEncontrados,0));
                    }
                }else{
                    //$encontrados = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopEncontrado,1,1,$publicity_id,"0",$type,$cliente,"0");
                    $encontrados = $base_pop_encontrados;
                    $porcEncontrados = count($encontrados)/count($base)*100;
                    $valoresPopEncontrado[] = array('respuesta' => "Visita: 1", 'cantidad' => count($encontrados), "porcentaje" => round($porcEncontrados,0));
                }

            }else{
                $porcEncontrados = 0;
                $valoresPopEncontrado[] = array('respuesta' => 'Bayer', 'cantidad' => count($base), "porcentaje" => 0);
                if ((count($num_visitas)>0) and (2>3))
                {
                    foreach ($num_visitas as $num_visita) {
                        $encontrados = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopEncontrado,$num_visita->visit_id,1,$publicity_id,"0",$type,$cliente,"0");
                        $valoresPopEncontrado[] = array('respuesta' => "Visita: ".$num_visita->visit_id, 'cantidad' => count($encontrados), "porcentaje" => 100);
                    }
                }else{
                    //$encontrados = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopEncontrado,1,1,$publicity_id,"0",$type,$cliente,"0");
                    $encontrados = $base_pop_encontrados;
                    $valoresPopEncontrado[] = array('respuesta' => "Visita: 1", 'cantidad' => count($encontrados), "porcentaje" => 100);
                }
            }


            //fin encontrado

            //visibilidad
            if (($publicity_id<>564)){// dif. de cabecera
                $visit_id=1;
                $visibles = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopVisible,$visit_id,1,$publicity_id,"0",$type,$cliente,"0",$stores_pop_encontrados);
//dd($company_id,$pollPopVisible,$visit_id,1,$publicity_id,"0",$type,$cliente);
                $totalVisibles = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopVisible,$visit_id,'T',$publicity_id,"0",$type,$cliente,"0",$stores_pop_encontrados);
                $noVisibles = count($totalVisibles) - count($visibles);
                $valSiNo[0] = array("tipo" => 'Sí', "cantidad" => count($visibles), "color" => '#97C74F');
                $valSiNo[1] = array("tipo" => 'No', "cantidad" => $noVisibles, "color" => '#1AB1E6');
                if ($noVisibles>0){
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
            //$num_visitas = $this->pollDetailRepo->getVisitStores($company_id,$publicity_id,"0",$type,$cliente);
            if (($publicity_id<>585) and ($publicity_id<>586)){
                //retirado solo mostrara para vitrinas y cabecera la ultima visita y en formato de grafico tipo pastel
                /*if ((count($num_visitas)>0) and ($publicity_id==564))
                {
                    //grafico barras por bloque
                    $colorEstadoVisitas[0] = '#1A8EC7';
                    $colorEstadoVisitas[1] = '#84CFF4';$acumulaTotalEstado=0;
                    foreach ($num_visitas as $num_visita) {
                        $buenEstado = $this->pollDetailRepo->detailsResponseSiNo($company_id, $pollPopEstado, $num_visita->visit_id, 1, $publicity_id, "0", $type, $cliente, "0");
                        $malEstado = $this->pollDetailRepo->detailsResponseSiNo($company_id, $pollPopEstado, $num_visita->visit_id, 0, $publicity_id, "0", $type, $cliente, "0");
                        $totalEstado = count($buenEstado) + count($malEstado);
                        $acumulaTotalEstado = $acumulaTotalEstado + $totalEstado;

                        if (count($malEstado)>0){
                            $linkMalEstado[] = array('visita'=>$num_visita->visit_id,'link'=>$pollPopEstado."/"."Mal Estado-0-".$type."-".$cliente."-".$num_visita->visit_id."/".$company_id."/"."0/0/".$publicity_id);
                        }else{
                            $linkMalEstado = [];
                        }

                        if ($totalEstado > 0) {
                            $porcBuenEstado = round(count($buenEstado) / $totalEstado * 100, 0);
                            $porcMalEstado = round(count($malEstado) / $totalEstado * 100, 0);
                        } else {
                            $porcBuenEstado = 0;$porcMalEstado=0;
                        }

                        $detalleItems[]=array('texto'=>'Buen Estado','cantidad'=>count($buenEstado),'porcentaje' =>$porcBuenEstado,'color'=>$colorEstadoVisitas[0]);
                        $detalleItems[]=array('texto'=>'Mal Estado','cantidad'=>count($malEstado),'porcentaje' =>$porcMalEstado,'color'=>$colorEstadoVisitas[1]);
                        $detalleEstadoVisitas[] = array('tipo'=> 'Visita ' . $num_visita->visit_id ,'detalles'=>$detalleItems);
                        $valSiNoE[] = array('tipo' => 'Visita ' . $num_visita->visit_id, 'Buen Estado' => $porcBuenEstado, 'Mal Estado' => $porcMalEstado);
                        unset($detalleItems);

                    }
                    if ($acumulaTotalEstado==0){
                        $detalleEstadoVisitas=[];
                    }

                }else{

                }*/
                //grafico pastel
                $buenEstado = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopEstado,1,1,$publicity_id,"0",$type,$cliente,"0",$stores_pop_encontrados);
                $malEstado = count($base_pop_encontrados)-count($buenEstado);
                //$malEstado = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopEstado,1,0,$publicity_id,"0",$type,$cliente,"0",$stores_pop_encontrados);
                $valSiNoE[0] = array("tipo" => 'Buen Estado', "cantidad" => count($buenEstado), "color" => '#97C74F');
                $valSiNoE[1] = array("tipo" => 'Mal Estado', "cantidad" => $malEstado, "color" => '#1AB1E6');
                if (count($malEstado)>0){
                    //{poll_id}/{values}/{company_id}/{poll_option_id?}/{product_id?}/{publicity_id?}
                    //$values = $textoResp.'-'.$respuesta.'-'.$type.'-'.$cadena.'-'.$visit_id;
                    $linkMalEstado = $pollPopEstado."/"."Mal Estado-0-".$type."-".$cliente."-1/".$company_id."/"."0/0/".$publicity_id;
                }else{
                    $linkMalEstado = 0;
                }
                $detalleEstadoVisitas=[];$colorEstadoVisitas=[];$colorOpcionesEstadoVisitas=[];

            }else{
                $valSiNoE=[];$linkMalEstado=0;$detalleEstadoVisitas=[];$colorEstadoVisitas=[];$colorOpcionesEstadoVisitas=[];
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
                        /*if ((count($num_visitas)>0) and ($publicity_id==564))
                        {
                            foreach ($num_visitas as $num_visita) {
                                $cantidad  = count($this->pollOptionDetailRepo->getResultOption($company_id,$option->id,$num_visita->visit_id,$publicity_id,"0",$type,$cliente,"0"));
                                $textoOpcion= ucwords(trim($option->options));
                                $opciones[] = array('id'=>$option->id,'opcion' => $textoOpcion,'cantidad' => $cantidad,'visita'=>$num_visita->visit_id);
                                $sw=0;
                            }

                        }else{

                        }*/
                        $cantidad  = count($this->pollOptionDetailRepo->getResultOption($company_id,$option->id,$num_end_visit->visit_id,$publicity_id,"0",$type,$cliente,"0"));
                        $textoOpcion= ucwords(trim($option->options));
                        $opciones[] = array('id'=>$option->id,'opcion' => $textoOpcion,'cantidad' => $cantidad,'visita'=>$num_end_visit->visit_id);
                        $totalOptions = $totalOptions + $cantidad;$sw=0;

                    }


                }
                unset($options);
                $colorOpcionesEstadoVisitas[0] = '#1A8EC7';
                $colorOpcionesEstadoVisitas[1] = '#84CFF4';
                if ((count($num_visitas)>0) and ($publicity_id==564)){
                    /*if (count($opciones)>0)
                    {
                        $regColl = Collection::make($opciones);
                        $visitas = $regColl->groupBy(function($item){ return $item['visita']; });$acumulaTotalEstado=0;


                        foreach ($visitas as $index =>$reg) {
                            $c=0;$opcionesTotal = array("tipo" => 'Visita ' . $index);unset($valoresOpciones0);$valoresOpciones0=[];
                            $rege = Collection::make($reg);
                            $totalOptions = $rege->sum(function ($re) {
                                return $re['cantidad'];
                            });

                            foreach ($reg as $option)
                            {
                                if ($totalOptions<>0){
                                    $porc = $option['cantidad']/$totalOptions*100;
                                }else{
                                    $porc =0;
                                }
                                $colorBarra = $colorOpcionesEstadoVisitas[$c];
                                $colorOpcionesEstadoVisitas[] = $colorBarra;
                                $c=$c+1;if ($c==1) $color = '#FFFFFF';if ($c==2) $color = '#FFFFFF';if ($c==3) $color = '#FFFFFF';if ($c==4) $color = '#FFFFFF';

                                $opcion = array($option['opcion']=>round($porc,0));

                                $detalleItems[]=array('texto'=>$option['opcion'],'cantidad'=>$option['cantidad'],'porcentaje' =>round($porc,0),'color'=>$colorBarra);
                                $acumulaTotalEstado = $acumulaTotalEstado + $option['cantidad'];
                                $valoresOpciones0 = array_merge($valoresOpciones0,$opcion);

                            }

                            $detalleOpcionesEstadoVisitas[] = array('tipo'=> 'Visita ' . $index ,'detalles'=>$detalleItems);
                            $valoresOpcionesE[] = array_merge($opcionesTotal,$valoresOpciones0);
                            unset($opciones);unset($valoresOpciones0);unset($detalleItems);
                        }
                        if ($acumulaTotalEstado==0){
                            $detalleOpcionesEstadoVisitas=[];
                        }

                    }else{
                        $valoresOpcionesE=[];$detalleOpcionesEstadoVisitas=[];
                    }*/
                }else{

                }
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
                    $valoresOpcionesE[] = array_merge($opcionesTotal,$valoresOpciones0);$detalleOpcionesEstadoVisitas=[];
                    unset($opciones);unset($valoresOpciones0);
                }else{
                    $valoresOpcionesE=[];$detalleOpcionesEstadoVisitas=[];
                }
                unset($totalOptions);
            }else{
                $valoresOpcionesE=[];$detalleOpcionesEstadoVisitas=[];
            }

            //fin opciones estado

            //cambios
            if (($publicity_id<>564)){
                $realizoCambios = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopCambio,1,1,$publicity_id,"0",$type,$cliente,"0",$stores_pop_encontrados);
                $noRealizoCambios = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollPopCambio,1,0,$publicity_id,"0",$type,$cliente,"0",$stores_pop_encontrados);
                $valSiNoC[0] = array("tipo" => 'Si', "cantidad" => count($realizoCambios), "color" => '#97C74F');
                $valSiNoC[1] = array("tipo" => 'No', "cantidad" => count($noRealizoCambios), "color" => '#1AB1E6');
                if (count($noRealizoCambios)>0){
                    //{poll_id}/{values}/{company_id}/{poll_option_id?}/{product_id?}/{publicity_id?}
                    //$values = $textoResp.'-'.$respuesta.'-'.$type.'-'.$cadena.'-'.$visit_id;
                    $linkNoCambios = $pollPopCambio."/"."No Cambios-0-".$type."-".$cliente."-1/".$company_id."/"."0/0/".$publicity_id;
                }else{
                    $linkNoCambios = 0;
                }
            }else{
                $valSiNoC=[];$linkNoCambios=0;
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
                $luzLedOperativaSi = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollLuzLed,1,1,$publicity_id,"0",$type,$cliente,"0",$stores_pop_encontrados);
                $luzLedOperativaNo = count($base_pop_encontrados)-count($luzLedOperativaSi);
                $valSiNoLuz[0] = array("tipo" => 'Sí', "cantidad" => count($luzLedOperativaSi), "color" => '#97C74F');
                $valSiNoLuz[1] = array("tipo" => 'No', "cantidad" => $luzLedOperativaNo, "color" => '#1AB1E6');
                if (count($luzLedOperativaNo)>0){
                    //{poll_id}/{values}/{company_id}/{poll_option_id?}/{product_id?}/{publicity_id?}
                    //$values = $textoResp.'-'.$respuesta.'-'.$type.'-'.$cadena.'-'.$visit_id;
                    $linkNoOperativo = $pollLuzLed."/"."No Operativo-0-".$type."-".$cliente."-1/".$company_id."/"."0/0/".$publicity_id;
                }else{
                    $linkNoOperativo = 0;
                }
            }else{
                $valSiNoLuz=[];$linkNoOperativo=0;
            }
            //fin led

            //layout
            if ($publicity_id==586){
                $layoutSi = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollLayout,1,1,$publicity_id,"0",$type,$cliente,"0",$stores_pop_encontrados);
                $layoutNo = $this->pollDetailRepo->detailsResponseSiNo($company_id,$pollLayout,1,0,$publicity_id,"0",$type,$cliente,"0",$stores_pop_encontrados);
                $valSiNoLayout[0] = array("tipo" => 'Sí', "cantidad" => count($layoutSi), "color" => '#97C74F');
                $valSiNoLayout[1] = array("tipo" => 'No', "cantidad" => count($layoutNo), "color" => '#1AB1E6');
                if (count($layoutNo)>0){
                    //{poll_id}/{values}/{company_id}/{poll_option_id?}/{product_id?}/{publicity_id?}
                    //$values = $textoResp.'-'.$respuesta.'-'.$type.'-'.$cadena.'-'.$visit_id;
                    $linkNoLayout = $pollLayout."/"."No Layout-0-".$type."-".$cliente."-1/".$company_id."/"."0/0/".$publicity_id;
                }else{
                    $linkNoLayout = 0;
                }
            }else{
                $valSiNoLayout=[];$linkNoLayout=0;
            }
            //fin layout

        }else{
            $colorOpcionesEstadoVisitas=[];$colorEstadoVisitas=[];$valoresPopEncontrado = [];$objPublicity=[];$valoresOpciones = [];$valSiNo=[];$valSiNoE=[];$valoresOpcionesE=[];$valSiNoC=[];$valoresOpcionesC=[];$valSiNoLuz=[];$valSiNoLayout=[];
            $detalleEstadoVisitas=[];$detalleOpcionesEstadoVisitas=[];$num_end_visit_end=0;
        }
        $valPopJson =json_encode($valoresPopEncontrado);unset($valoresPopEncontrado);
        $valVisibleJson =json_encode($valSiNo);unset($valSiNo);
        $valOpcionesJson =json_encode($valoresOpciones);unset($valoresOpciones);
        $valEstadoJson =json_encode($valSiNoE);unset($valSiNoE);
        $valColorsEstadoVisitas = json_encode($colorEstadoVisitas);
        $valColorOpcionesEstadoVisitas = json_encode($colorOpcionesEstadoVisitas);
        $valOpcionesEJson =json_encode($valoresOpcionesE);unset($valoresOpcionesE);
        $valCambiosJson =json_encode($valSiNoC);unset($valSiNoC);
        $valOpcionesCJson =json_encode($valoresOpcionesC);unset($valoresOpcionesC);
        $valLedJson =json_encode($valSiNoLuz);unset($valSiNoLuz);
        $valLayoutJson =json_encode($valSiNoLayout);unset($valSiNoLayout);

        return View::make('report/bayer/transferencistaDetalle',compact('num_end_visit_end','valColorOpcionesEstadoVisitas','detalleOpcionesEstadoVisitas','valColorsEstadoVisitas','detalleEstadoVisitas','linkNoLayout','linkNoOperativo','linkNoCambios','linkMalEstado','valLayoutJson','linkNoVisibles','campaignes','valLedJson','leyenda','valOpcionesCJson','valCambiosJson','menu','valOpcionesEJson','valEstadoJson','valOpcionesJson','valVisibleJson','objPublicity','valPopJson','urlBase','titulo','logo','types','company_id','pops'));
    }

    public function getPublicitiesCampaigne($company_id="0",$ajax="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            $company_id = $valoresPost['company_id'];
            //$ajax = $valoresPost['ajax'];
            $ajax=1;
        }
        $publicitiesCampaigne =$this->publicityCampaigneRepo->getPublicityForCampaigne($company_id);
        if (count($publicitiesCampaigne)>0){
            foreach ($publicitiesCampaigne as $publicity) {
                if (($publicity->publicity_id<>568) and ($publicity->publicity_id<>564)){
                    $valores[] = array('id' =>$publicity->publicity_id,'company_id' => $publicity->publicity->company_id,'fullname' => $publicity->publicity->fullname,'category_product_id' => $publicity->publicity->category_product_id,'description' => $publicity->publicity->description,'imagen' => $publicity->publicity->imagen,'created_at' => '','updated_at' => '');
                }
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

        $menu="";
        $objPoll = $this->pollRepo->find($poll_id);
        $customer =$this->customerRepo->find($this->customer_id);//dd($customer);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $titulo='Detalle de respuestas';
        $subTitulo = $objPoll->question.' Respuesta: '.$texto;

        //$regs = $this->pollDetailRepo->detailsResponseSiNo($company_id,$poll_id,1,$pregSino,$publicity_id,$product_id,$type,$cadena,"0");dd($regs[0]);

        return View::make('report/bayer/prospeccionDetailQuestion',compact('visit_id','menu','titulo','logo','subTitulo','poll_id','pregSino','type','cadena','company_id','poll_option_id','product_id','publicity_id'));

    }

    public function getOrdersAuditors($company_id="0",$auditor_id="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            if (count($valoresPost)<>0){
                $auditor_id = $valoresPost['user_id'];
                $store_id = $valoresPost['store_id'];
                $company_id = $valoresPost['company_id'];
                $company = $this->companyRepo->find($company_id);
                $titulo = 'Detalle Pedido Periódo '.$company->fullname;
            }else{
                $auditor_id = "0";
                $store_id="0";
                $ObjCompany_id=$this->companyRepo->getFirstCurrentCampaigns($this->customer_id,$this->estudio);
                $company_id=$ObjCompany_id->id;
                $company = $this->companyRepo->find($company_id);
                $titulo = 'Detalle Pedido Periódo '.$company->fullname;
            }
        }else{
            $auditor_id = "0";
            $store_id="0";
            $company = $this->companyRepo->find($company_id);
            $titulo = 'Detalle Pedido Período '.$company->fullname;
        }
        $objOrderRep = $this->orderRepo->getModel();
        $objOrderRegs = $objOrderRep->where('auditor_id',$auditor_id)->where('company_id',$company_id)->where('store_id',$store_id)->orderBy('created_at','DESC')->get();
        foreach ($objOrderRegs as $objOrderReg) {
            $resultOrderDetails = $objOrderReg->orderDetails;
            foreach ($resultOrderDetails as $resultOrderDetail) {
                $orderDetails[] = array('id'=>$resultOrderDetail->id,'product_id'=>$resultOrderDetail->product_id,'product'=>$resultOrderDetail->product->fullname,'cantidad'=>$resultOrderDetail->quantity,'precio'=>$resultOrderDetail->price,'monto'=>$resultOrderDetail->amount);
            }
            $resultOrders[] = array('id'=>$objOrderReg->id,'provider_id'=>$objOrderReg->provider_id,'provider'=>$objOrderReg->provider->fullname,'store_id'=>$objOrderReg->store_id,'punto'=>$objOrderReg->store->fullname,'auditor_id'=>$objOrderReg->auditor_id,'auditor'=>$objOrderReg->auditor->fullname,'created_at'=>$objOrderReg->created_at,'order_details'=>$orderDetails);
            unset($orderDetails);
        }
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> 1,'regs' => $resultOrders]);
    }
    public function searchOrders($company_id,$user_id)
    {

        return View::make('audits/detailOrders',compact('company_id','user_id'));
    }

    public function insertOrders($company_id,$user_id)
    {

    }

    public function searchStoresVisits()
    {
        $valoresPost= Input::all();
        $dir = $valoresPost['dir'];
        $valores = explode('|',$dir);
        $dir = $valores[0];
        $company_id = $valores[1];$limit=15;
        $stores = $this->storeRepo->searchStoresVisits($company_id,$dir,$limit);

        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return \Response::json($stores);
    }
}