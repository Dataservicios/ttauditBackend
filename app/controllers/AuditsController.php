<?php
/**
 * Created by PhpStorm.
 * User: Webmaster
 * Date: 25/06/2015
 * Time: 02:50 PM
 */

use Auditor\Repositories\CustomerRepo;
use Auditor\Repositories\CompanyRepo;
use Auditor\Repositories\CompanyStoreRepo;
use Auditor\Repositories\AuditRepo;
use Auditor\Repositories\PresenceDetailRepo;
use Auditor\Repositories\StoreRepo;
use Auditor\Repositories\PublicitiesDetailRepo;
use Auditor\Repositories\MediaRepo;
use Auditor\Repositories\AuditRoadStoreRepo;
use Auditor\Repositories\RoadDetailRepo;
use Auditor\Repositories\UserRepo;
use Auditor\Repositories\PublicityRepo;
use Auditor\Repositories\PollDetailRepo;
use Auditor\Repositories\PollOptionDetailRepo;
use Auditor\Repositories\PollOptionRepo;
use Auditor\Repositories\PollRepo;
use Auditor\Repositories\ControlTimeRepo;
use Auditor\Repositories\StockProductPopRepo;
use Auditor\Repositories\VersionRepo;
use Illuminate\Database\Eloquent\Collection;
use Auditor\Repositories\LogProcessRepo;
use Auditor\Repositories\RoadRepo;

class AuditsController extends BaseController{

    protected $customerRepo;
    protected $companyRepo;
    protected $companyStoreRepo;
    protected $auditRepo;
    protected $presenceDetailRepo;
    protected $storeRepo;
    protected $PublicitiesDetailRepo;
    protected $MediaRepo;
    protected $AuditRoadStoreRepo;
    protected $RoadDetailRepo;
    protected $userRepo;
    protected $publicityRepo;
    protected $PollDetailRepo;
    protected $PollOptionDetailRepo;
    protected $PollOptionRepo;
    protected $pollRepo;
    protected $controlTimeRepo;
    protected $stockProductPopRepo;
    protected $versionRepo;
    protected $logProcessRepo;
    protected $roadRepo;

    public $urlBase;
    public $urlFotos;
    public $urlImageBas;
    public $urlExcels;
    public $valoresCampaigne;
    public $valoresCategory;

    public function __construct(RoadRepo $roadRepo,LogProcessRepo $logProcessRepo,VersionRepo $versionRepo,StockProductPopRepo $stockProductPopRepo,ControlTimeRepo $controlTimeRepo,PollRepo $pollRepo,PollOptionRepo $PollOptionRepo,PollOptionDetailRepo $PollOptionDetailRepo,PollDetailRepo $PollDetailRepo,PublicityRepo $publicityRepo,UserRepo $userRepo,RoadDetailRepo $RoadDetailRepo,AuditRoadStoreRepo $AuditRoadStoreRepo, MediaRepo $MediaRepo,PublicitiesDetailRepo $PublicitiesDetailRepo,StoreRepo $storeRepo,PresenceDetailRepo $presenceDetailRepo, AuditRepo $auditRepo,CompanyStoreRepo $companyStoreRepo, CompanyRepo $companyRepo, CustomerRepo $customerRepo)
    {
        $this->customerRepo = $customerRepo;
        $this->companyRepo = $companyRepo;
        $this->companyStoreRepo = $companyStoreRepo;
        $this->auditRepo = $auditRepo;
        $this->presenceDetailRepo = $presenceDetailRepo;
        $this->storeRepo = $storeRepo;
        $this->PublicitiesDetailRepo = $PublicitiesDetailRepo;
        $this->MediaRepo = $MediaRepo;
        $this->AuditRoadStoreRepo = $AuditRoadStoreRepo;
        $this->RoadDetailRepo = $RoadDetailRepo;
        $this->userRepo = $userRepo;
        $this->publicityRepo = $publicityRepo;
        $this->PollDetailRepo = $PollDetailRepo;
        $this->PollOptionDetailRepo = $PollOptionDetailRepo;
        $this->PollOptionRepo = $PollOptionRepo;
        $this->pollRepo = $pollRepo;
        $this->controlTimeRepo = $controlTimeRepo;
        $this->stockProductPopRepo = $stockProductPopRepo;
        $this->versionRepo = $versionRepo;
        $this->logProcessRepo = $logProcessRepo;
        $this->roadRepo = $roadRepo;

        $this->urlBase = \App::make('url')->to('/');
        $this->urlFotos = '/media/fotos/';
        $this->urlImageBase = '/media/images/';
        $this->urlExcels = '/reportes_excel/';
        $this->valoresCampaigne[3] = array('ventanaW' => 193);
        $this->valoresCampaigne[18] = array('ventanaW' => 204);
        $this->valoresCampaigne[21] = array('ventanaW' => 250);
        $this->valoresCampaigne[15] = array('ventanaW' => 0);
        $this->valoresCampaigne[22] = array('ventanaW' => 255,'abierto' => 252,'permitio' =>254,'existeVent' => 256, 'visibleVent' =>257, 'comoEstaVent'=>258);
        $this->valoresCampaigne[29] = array('ventanaW' => 388,'abierto' => 385,'permitio' =>387,'existeVent' => 389, 'visibleVent' =>390, 'comoEstaVent'=>391);
        $this->valoresCampaigne[36] = array('ventanaW' => 491,'abierto' => 489,'permitio' =>490,'existeVent' => 492, 'visibleVent' =>493, 'comoEstaVent'=>494);
        $this->valoresCampaigne[38] = array('ventanaW' => 510,'abierto' => 508,'permitio' =>509,'existeVent' => 511, 'visibleVent' =>512, 'comoEstaVent'=>513);
        $this->valoresCampaigne[43] = array('ventanaW' => 565,'abierto' => 563,'permitio' =>564,'existeVent' => 566, 'visibleVent' =>567, 'comoEstaVent'=>568);
        $this->valoresCampaigne[46] = array('ventanaW' => 619,'abierto' => 617,'permitio' =>618,'existeVent' => 620, 'visibleVent' =>621, 'comoEstaVent'=>622);
        $this->valoresCampaigne[53] = array('ventanaW' => 758,'abierto' => 756,'permitio' =>757,'existeVent' => 759, 'visibleVent' =>760, 'comoEstaVent'=>761);
        $this->valoresCampaigne[59] = array('ventanaW' => 840,'abierto' => 838,'permitio' =>839,'existeVent' => 841, 'visibleVent' =>842, 'comoEstaVent'=>843);
        $this->valoresCampaigne[68] = array('ventanaW' => 975,'abierto' => 973,'permitio' =>974,'existeVent' => 976, 'visibleVent' =>977, 'comoEstaVent'=>978);
        $this->valoresCampaigne[71] = array('ventanaW' => 1138,'abierto' => 1136,'permitio' =>1137,'existeVent' => 1139, 'visibleVent' =>1140, 'comoEstaVent'=>1141);
        $this->valoresCampaigne[75] = array('ventanaW' => 1237,'abierto' => 1235,'permitio' =>1236,'existeVent' => 1238, 'visibleVent' =>1239, 'comoEstaVent'=>1240);
        $this->valoresCampaigne[81] = array('ventanaW' => 1381,'abierto' => 1379,'permitio' =>1380,'existeVent' => 1382, 'visibleVent' =>1383, 'comoEstaVent'=>1384);
        $this->valoresCampaigne[87] = array('ventanaW' => 1465,'abierto' => 1463,'permitio' =>1464,'existeVent' => 1466, 'visibleVent' =>1467, 'comoEstaVent'=>1468);
        $this->valoresCampaigne[94] = array('ventanaW' => 1607,'abierto' => 1605,'permitio' =>1606,'existeVent' => 1608, 'visibleVent' =>1609, 'comoEstaVent'=>1610);
        $this->valoresCampaigne[99] = array('ventanaW' => 1690,'abierto' => 1688,'permitio' =>1689,'existeVent' => 1691, 'visibleVent' =>1692, 'comoEstaVent'=>1693);
        $this->valoresCampaigne[109] = array('ventanaW' => 1871,'abierto' => 1869,'permitio' =>1870,'existeVent' => 1872, 'visibleVent' =>1873, 'comoEstaVent'=>1874);
        $this->valoresCampaigne[119] = array('ventanaW' => 2049,'abierto' => 2047,'permitio' =>2048,'existeVent' => 2050, 'visibleVent' =>2051, 'comoEstaVent'=>2052);
        $this->valoresCampaigne[129] = array('ventanaW' => 2223,'abierto' => 2221,'permitio' =>2222,'existeVent' => 2224, 'visibleVent' =>2225, 'comoEstaVent'=>2226);
        $this->valoresCampaigne[135] = array('ventanaW' => 2331,'abierto' => 2329,'permitio' =>2330,'existeVent' => 2332, 'visibleVent' =>2333, 'comoEstaVent'=>2334);
        $this->valoresCampaigne[140] = array('ventanaW' => 2361,'abierto' => 2359,'permitio' =>2360,'existeVent' => 2362, 'visibleVent' =>2363, 'comoEstaVent'=>2364);
        $this->valoresCampaigne[147] = array('ventanaW' => 2456,'abierto' => 2454,'permitio' =>2455,'existeVent' => 2457, 'visibleVent' =>2458, 'comoEstaVent'=>2459);
        $this->valoresCampaigne[154] = array('ventanaW' => 2582,'abierto' => 2580,'permitio' =>2581,'existeVent' => 2583, 'visibleVent' =>2584, 'comoEstaVent'=>2585);
        $this->valoresCampaigne[162] = array('ventanaW' => 2673,'abierto' => 2671,'permitio' =>2672,'existeVent' => 2674, 'visibleVent' =>2675, 'comoEstaVent'=>2676);
        $this->valoresCampaigne[174] = array('ventanaW' => 2851,'abierto' => 2849,'permitio' =>2850,'existeVent' => 2852, 'visibleVent' =>2853, 'comoEstaVent'=>2854);
        $this->valoresCampaigne[186] = array('ventanaW' => 3064,'abierto' => 3062,'permitio' =>3063,'existeVent' => 3065, 'visibleVent' =>3066, 'comoEstaVent'=>3067);
        $this->valoresCampaigne[200] = array('ventanaW' => 3276,'abierto' => 3274,'permitio' =>3275,'existeVent' => 3277, 'visibleVent' =>3278, 'comoEstaVent'=>3279);
        $this->valoresCampaigne[200] = array('ventanaW' => 3276,'abierto' => 3274,'permitio' =>3275,'existeVent' => 3277, 'visibleVent' =>3278, 'comoEstaVent'=>3279);
        $this->valoresCampaigne[208] = array('ventanaW' => 3452,'abierto' => 3462,'permitio' =>3463,'existeVent' => 3453, 'visibleVent' =>3454, 'comoEstaVent'=>3455);
        $this->valoresCampaigne[216] = array('ventanaW' => 3604,'abierto' => 3614,'permitio' =>3615,'existeVent' => 3605, 'visibleVent' =>3606, 'comoEstaVent'=>3607);
        $this->valoresCampaigne[223] = array('ventanaW' => 3825,'abierto' => 3835,'permitio' =>3836,'existeVent' => 3826, 'visibleVent' =>3827, 'comoEstaVent'=>3828);
        $this->valoresCampaigne[235] = array('ventanaW' => 4048,'abierto' => 4058,'permitio' =>4059,'existeVent' => 4049, 'visibleVent' =>4050, 'comoEstaVent'=>4051);
        $this->valoresCampaigne[239] = array('ventanaW' => 4122,'abierto' => 4132,'permitio' =>4133,'existeVent' => 4123, 'visibleVent' =>4124, 'comoEstaVent'=>4125);
        $this->valoresCampaigne[246] = array('ventanaW' => 4294,'abierto' => 4304,'permitio' =>4305,'existeVent' => 4295, 'visibleVent' =>4296, 'comoEstaVent'=>4297);
        $this->valoresCampaigne[254] = array('ventanaW' => 4442,'abierto' => 4452,'permitio' =>4453,'existeVent' => 4443, 'visibleVent' =>4444, 'comoEstaVent'=>4445);
        $this->valoresCampaigne[264] = array('ventanaW' => 4520,'abierto' => 4530,'permitio' =>4531,'existeVent' => 4521, 'visibleVent' =>4522, 'comoEstaVent'=>4523);
        $this->valoresCampaigne[272] = array('ventanaW' => 4614,'abierto' => 4624,'permitio' =>4625,'existeVent' => 4615, 'visibleVent' =>4616, 'comoEstaVent'=>4617);
        $this->valoresCampaigne[279] = array('ventanaW' => 4756,'abierto' => 4766,'permitio' =>4767,'existeVent' => 4757, 'visibleVent' =>4758, 'comoEstaVent'=>4759);
        //$this->valoresCategory[3] = array('sod' => 54,'exhi' => 53);

        $this->valoresCategory = array('sod' => 54,'exhi' => 53);
        //$this->valoresCategory[15] = array('sod' => 55,'exhi' => 56,'exhiAdic' => 57,'cartePromo' => 58);
    }

    public function HomeAudits()
    {
        $customers = $this->customerRepo->getCustomerActivs(1);
        $titulo = 'Cliente';
        foreach ($customers as $customer)
        {
            $links[] = array('nombre' => $customer->fullname, 'url' => route('CampaignForCustomer', array($customer->id)), 'target' => 0);
        }
        return View::make('audits/homeAudits', compact('links','titulo'));
    }

    public function Monitoreo()
    {
        $titulo = 'Monitoreo';
        $data = Session::all();
        //dd($data);
        $links[] = array('nombre' => 'Tracking Online', 'url' => 'http://ttaudit.com/admin/trackingOnline', 'target' => 1);
        $links[] = array('nombre' => 'Tracking Offline Por Usuario', 'url' => 'http://ttaudit.com/admin/trackingOffline', 'target' => 1);
        $links[] = array('nombre' => 'Excel Mensual Puntos Cerrados', 'url' => route('closedPoints'), 'target' => 0);
        return View::make('audits/homeAudits', compact('links','titulo'));
    }

    public function HomeCampaignForCustomer($customer_id)
    {
        $campaigns = $this->companyRepo->getCompaniesForClient($customer_id,"1");//dd($campaigns);
        $titulo = 'Estudio';
        if (count($campaigns)>0)
        {
            foreach ($campaigns as $campaign)
            {
                $links[] = array('nombre' => $campaign->fullname, 'url' => route('auditsForCampaign', array($campaign->id)), 'target' => 0);
            }
        }else{
            $links=[];
        }

        return View::make('audits/homeAudits', compact('links','titulo'));
    }

    public function auditsForCampaign($company_id)
    {
        $menus = $this->generateMenusAudits(0,$company_id);
        return View::make('audits/auditsCompany', compact('menus'));
    }
    
    public function getDetailQuestion($poll_id,$values,$company_id,$poll_option_id="0",$product_id="0",$publicity_id="0",$audit_id="0",$auditor="0")
    {//http://ttaudit.test/admin/audits/getDetailQuestion/3064/LIMA-0-0-0-0-0-1-0-0/186/0/0/925/1/587
        $valores = explode('-',$values);
        $pregSino = $valores[6];
        $city = $valores[0];
        $menus = $this->generateMenusAudits($audit_id,$company_id);

        $campaigne = $this->companyRepo->find($company_id);//dd($campaigne);
        $customer =$this->customerRepo->find($campaigne->customer_id);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        if ($pregSino==0)
        {
            $titulo = 'No trabajados';
        }else{
            $titulo = 'Trabajados';
        }
        $datosStores1 = $this->getStoresDetailSiNo($poll_id,$poll_option_id,$this->urlBase,$this->urlFotos,$valores,$product_id,$company_id,$publicity_id);
        //$pollsResult = $this->getResponsePollsAlicorp($store_id,$company_id,$publicity_id);
        //dd($datosStores1);
        foreach ($datosStores1 as $datosStore) {
            $objPublicityDetail = $this->PublicitiesDetailRepo->findDetailForCondition($publicity_id,$datosStore['store_id'],$company_id);dd($objPublicityDetail);
            $foto="Foto";
            $valoresPolls= $this->getValores();
            $poll_comoEstaVent = $valoresPolls[$company_id]['comoEstaVent'];
            $resp_comoEstaVent = $this->getResponsePolls($datosStore['store_id'],$company_id,$publicity_id,$poll_comoEstaVent,'Option');
            $datosStores[] = array('store_id' => $datosStore['store_id'], 'cadenaRuc' => $datosStore['cadenaRuc'],'type' =>$datosStore['type'],'codclient' => $datosStore['codclient'],'tipo_bodega' => $datosStore['tipo_bodega'],'distributor' => $datosStore['distributor'],'fullname' =>$datosStore['fullname'], 'departamento' => $datosStore['departamento'], 'Provincia' => $datosStore['Provincia'], 'distrito' => $datosStore['distrito'], 'comentario' => $datosStore['comentario'], 'otroComentario' => $datosStore['otroComentario'], 'arrayFoto' => $datosStore['arrayFoto'], 'fecha' => $datosStore['fecha'], 'publicity_details_id' => $objPublicityDetail[0]->id,'foto'=>$foto,'comoEstaVent' => $resp_comoEstaVent);
            //dd($datosStores);
        }
        return View::make('audits/sodTrabajados', compact('datosStores','menus','logo','titulo','audit_id','company_id','publicity_id','city','auditor'));
    }

    /**
     * @return json
     * Elimina registros tanto poll_details como poll_option_detail
     */
    public function delRegister()
    {
        $valoresPost= Input::all();
        $poll_detail_id = $valoresPost['poll_detail_id'];
        $poll_options_detail_id = $valoresPost['poll_options_detail_id'];
        $mytime = Carbon\Carbon::now();
        $pollDetail = $this->PollDetailRepo->getModel();
        $objPollDetail = $pollDetail::find($poll_detail_id);
        $objPollDetail->delete();
        if ($objPollDetail->delete())
        {
            $sw=1;
        }else{
            $sw=0;
        }
        if ($poll_options_detail_id<>'')
        {
            $arrayPollOptionsDetailId = explode('|',$poll_options_detail_id);
            for($i = 0; $i < count($arrayPollOptionsDetailId); ++$i) {
                if ($arrayPollOptionsDetailId[$i]<>'')
                {
                    $pollOptionDetail = $this->PollOptionDetailRepo->getModel();
                    $objPollOptionDetail = $pollOptionDetail::find($arrayPollOptionsDetailId[$i]);
                    $objPollOptionDetail->delete();
                }
            }

        }
        return Response::json([ 'success'=> $sw]);
    }


    /**
     * @return json
     * solo actualiza la respuesta en poll_details para tipos si y no
     */
    public function updatePollDetails()
    {
        $valoresPost= Input::all();//dd($valoresPost);
        $result = $valoresPost['result'];
        $company_id = $valoresPost['company_id'];
        $poll_detail_id = $valoresPost['poll_detail_id'];
        $mytime = Carbon\Carbon::now();
        $horaSistema = $mytime->toDateTimeString();
        $pollDetail = $this->PollDetailRepo->getModel();
        $user = $pollDetail::find($poll_detail_id);
        if ($user->auditor==0)
        {
            $objRoadDetails=$this->RoadDetailRepo->getModel();
            $road_details_obj=$objRoadDetails->where('store_id',$user->store_id)->where('company_id',$user->company_id)->first();
            $road_obj = $this->roadRepo->find($road_details_obj->road_id);
            $auditor_id=$road_obj->user_id;
            $user->auditor= $auditor_id;
        }

        $log_process = $this->logProcessRepo->getModel();
        $poll_id = $user->poll_id;
        $user_id = Auth::id();
        $this->insertLog($log_process,$poll_id,$user_id,'operations',$user,1,$user->result,$result,$poll_detail_id,'poll_details','updated');

        $user->result = $result;

        $updateResponse = $user->save();
        if ($updateResponse == true)
        {
            return Response::json([ 'success'=> 1, 'fecha' => $user->created_at]);
        }else{
            return Response::json([ 'success'=> 0, 'fecha' => $user->created_at]);
        }

    }

    public function trackingOffline($auditor="",$company_id="",$ubigeo="")
    {
        if ($auditor==""){
            $valoresPost= Input::all();
            if (count($valoresPost)>0){
                $auditor = $valoresPost['auditor'];
                $company_id = $valoresPost['company_id'];
                $ubigeo = $valoresPost['ubigeo'];
                $objUser = $this->userRepo->find($auditor);
                $nameAuditor = $objUser->fullname;
                $objCampaigne = $this->companyRepo->find($company_id);
                $nameCampaigne = $objCampaigne->fullname;
            }else{
                $auditor="0";$company_id="0";$ubigeo="0";
            }
        }
        $listAuditor = $this->userRepo->listUserCondition('auditor');
        $auditors= array(0 => "Seleccionar") + $listAuditor->lists('fullname','id');
        $listCurrentCampaigne = $this->companyRepo->getCurrentCampaigns();
        $currentCampaignes= array(0 => "Seleccionar") + $listCurrentCampaigne->lists('fullname','id');
        $ListStores = $this->storeRepo->getCityForCampaigne();//dd($ListStores);
        $ubigeos= array(0 => "Seleccionar") + $ListStores->lists('ubigeo','ubigeo');

        return View::make('trackingOffline', compact('auditor','company_id','ubigeo','auditors','currentCampaignes','ubigeos','nameAuditor','nameCampaigne'));
    }

    public function trackingOnline($auditor="")
    {
        if ($auditor==""){
            $valoresPost= Input::all();
            if (count($valoresPost)>0){
                $auditor = $valoresPost['auditor'];
                $objUser = $this->userRepo->find($auditor);
                $nameAuditor = $objUser->fullname;
            }else{
                $auditor="0";
            }
        }
        $listAuditor = $this->userRepo->listUserCondition('auditor');
        $auditors= array(0 => "Seleccionar") + $listAuditor->lists('fullname','id');

        return View::make('trackingOnnline', compact('auditor','auditors','nameAuditor'));
    }

    public function getJsonControlTime()
    {
        $valoresPost= Input::all();
        if (count($valoresPost)>0){
            $auditor = $valoresPost['user_id'];
            $company_id = $valoresPost['company'];
            $ubigeo = $valoresPost['ubigeo_id'];
        }else{
            $auditor="0";$company_id="0";$ubigeo="0";
        }
        $controlTimes = $this->controlTimeRepo->getRegForAuditorCompanyCity($auditor,$company_id,$ubigeo);//dd($controlTimes);
        if (($auditor<>"0") and ($company_id<>"0") and ($ubigeo<>"0"))
        {
            if (count($controlTimes)>0){
                foreach ($controlTimes as $controlTime)
                {
                    $dataM[] = array('store_id' => $controlTime->id,'fullname'=> $controlTime->fullname,'latitude_open'=> $controlTime->lat_open,'longitude_open'=> $controlTime->long_open,'latitude_close'=> $controlTime->lat_close,'longitude_close'=> $controlTime->long_close, 'latitude_store' => $controlTime->latitude, 'longitude_store' => $controlTime->longitude, 'time_open' => $controlTime->time_open, 'time_close' => $controlTime->time_close, 'created_at' => $controlTime->created_at, 'updated_at' => $controlTime->updated_at);
                }
            }else{
                $dataM = [];
            }

        }else{
            $dataM = [];
        }
        header('Access-Control-Allow-Origin: *');
        return Response::json( $dataM);
    }

    public function getJsonLastDayControlTime()
    {
        $valoresPost= Input::all();//dd(count($valoresPost));
        if (count($valoresPost)>0){
            $auditor = $valoresPost['auditor'];
            $id = $valoresPost['id'];
        }else{
            $auditor="0";
            $id = "0";
        }
        //$mytime = new Carbon\Carbon('yesterday');
        $mytime = Carbon\Carbon::now();
        //$mytime = $mytime->toDateString();
        $horaSistema = $mytime->format('Y-m-d');//dd($horaSistema);
        //$horaSistema = $mytime->toDateTimeString();//dd($horaSistema);
        $controlTimes = $this->controlTimeRepo->getRecOnTheLastAuditDay($auditor,$horaSistema,$id);//dd($controlTimes);
        if ($auditor<>"0")
        {
            if (count($controlTimes)>0){
                foreach ($controlTimes as $controlTime)
                {
                    $dataM[] = array('id' => $controlTime->id,'store_id' => $controlTime->store_id,'fullname'=> $controlTime->fullname,'latitude_open'=> $controlTime->lat_open,'longitude_open'=> $controlTime->long_open,'latitude_close'=> $controlTime->lat_close,'longitude_close'=> $controlTime->long_close, 'latitude_store' => $controlTime->latitude, 'longitude_store' => $controlTime->longitude, 'time_open' => $controlTime->time_open, 'time_close' => $controlTime->time_close, 'created_at' => $controlTime->created_at, 'updated_at' => $controlTime->updated_at);
                }
            }else{
                $dataM = [];
            }
        }else{
            $dataM = [];
        }//dd($dataM);
        header('Access-Control-Allow-Origin: *');
        return Response::json( $dataM);
    }

    /**
     * @return json
     * Actualiza todos los datos de poll_details
     */
    public function updatePollDetailsAll()
    {
        $valoresPost= Input::all();//dd($valoresPost);
        $result = $valoresPost['result'];
        $company_id = $valoresPost['company_id'];
        $poll_detail_id = $valoresPost['poll_detail_id'];
        $comment = $valoresPost['comment'];
        $limit = $valoresPost['limit'];
        $product_id = $valoresPost['product_id'];
        $publicity_id = $valoresPost['publicity_id'];
        $mytime = Carbon\Carbon::now();
        $horaSistema = $mytime->toDateTimeString();
        $pollDetail = $this->PollDetailRepo->getModel();
        $user = $pollDetail::find($poll_detail_id);
        //return Response::json([ 'success'=> $pollDetail]);
        $user->result = $result;
        $user->comentario = $comment;
        $user->limite = $limit;
        $user->product_id = $product_id;
        $user->company_id = $company_id;
        $user->publicity_id = $publicity_id;

        $updateResponse = $user->save();
        if ($updateResponse == true)
        {
            return Response::json([ 'success'=> 1, 'fecha' => $user->created_at]);
        }else{
            return Response::json([ 'success'=> 0, 'fecha' => $user->created_at]);
        }

    }

    /**
     * @return json
     * Actualiza todos los datos de poll_details por visita
     */
    public function updatePollDetailsAllVisits()
    {
        $valoresPost= Input::all();//dd($valoresPost);
        $result = $valoresPost['result'];
        $company_id = $valoresPost['company_id'];
        $poll_detail_id = $valoresPost['poll_detail_id'];
        $comment = $valoresPost['comment'];
        $limit = $valoresPost['limit'];
        $product_id = $valoresPost['product_id'];
        $publicity_id = $valoresPost['publicity_id'];
        $visit_id = $valoresPost['visit_id'];
        $mytime = Carbon\Carbon::now();
        $horaSistema = $mytime->toDateTimeString();
        $pollDetail = $this->PollDetailRepo->getModel();
        $user = $pollDetail::find($poll_detail_id);
        //return Response::json([ 'success'=> $pollDetail]);
        $user->result = $result;
        $user->comentario = $comment;
        $user->limite = $limit;
        $user->product_id = $product_id;
        $user->company_id = $company_id;
        $user->publicity_id = $publicity_id;
        $user->visit_id = $visit_id;

        $updateResponse = $user->save();
        if ($updateResponse == true)
        {
            return Response::json([ 'success'=> 1, 'fecha' => $user->created_at]);
        }else{
            return Response::json([ 'success'=> 0, 'fecha' => $user->created_at]);
        }

    }
    
    public function deleteAllOptions()
    {
        $valoresPost= Input::all();
        $company_id = $valoresPost['company_id'];
        $store_id= $valoresPost['store_id'];
        $product_id = $valoresPost['product_id'];
        $publicity_id = $valoresPost['publicity_id'];
        $poll_id = $valoresPost['poll_id'];
        $poll_option_ids = $this->PollOptionRepo->getOptions($poll_id);
        foreach ($poll_option_ids as $poll_option_id) {
            $this->PollOptionDetailRepo->deleteOptions($store_id,$company_id,$product_id,$publicity_id,$poll_option_id->id);
        }
        return Response::json([ 'success'=> 1]);


    }

    public function deleteAllOptionsVisits()
    {
        $valoresPost= Input::all();
        $company_id = $valoresPost['company_id'];
        $store_id= $valoresPost['store_id'];
        $product_id = $valoresPost['product_id'];
        $publicity_id = $valoresPost['publicity_id'];
        $poll_id = $valoresPost['poll_id'];
        $visit_id = $valoresPost['visit_id'];
        $poll_option_ids = $this->PollOptionRepo->getOptions($poll_id);
        foreach ($poll_option_ids as $poll_option_id) {
            $this->PollOptionDetailRepo->deleteOptions($store_id,$company_id,$product_id,$publicity_id,$poll_option_id->id,$visit_id);
        }
        return Response::json([ 'success'=> 1]);


    }

    public function insertPollDetail()
    {
        $valoresPost= Input::all();
        $company_id = $valoresPost['company_id'];
        $store_id= $valoresPost['store_id'];
        $product_id = $valoresPost['product_id'];
        $publicity_id = $valoresPost['publicity_id'];
        $options = $valoresPost['options'];
        $arrayOptions = explode('|',$options);
        $otros = $valoresPost['otros'];
        $priorities = $valoresPost['priorities'];
        $poll_id = $valoresPost['poll_id'];
        $user_id = $valoresPost['user_id'];
        $sino = $valoresPost['sino'];
        $fecha = $valoresPost['fecha'];
        $comentario = $valoresPost['comentario'];
        $objPoll = $this->pollRepo->find($poll_id);
        $objPollDetail = $this->PollDetailRepo->getModel();
        $objPollDetail->poll_id = $poll_id;
        $objPollDetail->store_id = $store_id;
        $objPollDetail->sino = $objPoll->sino;
        $objPollDetail->options = $objPoll->options;
        $objPollDetail->media = $objPoll->media;
        $objPollDetail->result = $sino;
        $objPollDetail->comentario = $comentario;
        $objPollDetail->auditor = $user_id;
        $objPollDetail->product_id = $product_id;
        $objPollDetail->publicity_id = $publicity_id;
        $objPollDetail->company_id = $company_id;
        $objPollDetail->created_at = $fecha;
        $valorInsert="";$id=0;
        if ($objPollDetail->save())
        {
            if (count($arrayOptions)>0)
            {
                for($i = 0; $i < count($arrayOptions); ++$i) {
                    if ($arrayOptions[$i] <> '') {
                        $objPollOptionDetail = $this->PollOptionDetailRepo->getModel();
                        $objPollOptionDetail->poll_option_id = $arrayOptions[$i];
                        $objPollOptionDetail->result = 1;
                        $objPollOptionDetail->product_id =$product_id;
                        $objPollOptionDetail->company_id =$company_id;
                        $objPollOptionDetail->store_id =$store_id;
                        $objPollOptionDetail->auditor =$user_id;
                        $objOption = $this->PollOptionRepo->find($arrayOptions[$i]);
                        $txtOption= $objOption->options;
                        if ($txtOption=='Otros'){
                            $objPollOptionDetail->otro =$otros;
                        }
                        //$objPollOptionDetail->created_at =$created_at;
                        /*if (count($arrayPriorities)>0)
                        {
                            if ($arrayPriorities[$i]<>'')
                            {
                                $objPollOptionDetail->priority = $arrayPriorities[$i];
                            }else{
                                $objPollOptionDetail->priority = 0;
                            }
                        }else{
                            $objPollOptionDetail->priority = 0;
                        }*/
                        if ($objPollOptionDetail->save())
                        {
                            $id = $objPollOptionDetail->id;
                            $valorInsert .=  ' Opción ingresada:'.$arrayOptions[$i];
                        }else{
                            $id=0;
                            $valorInsert .=  ' Opción NO ingresada:'.$arrayOptions[$i];
                        }
                    }
                }
            }
            return Response::json([ 'success'=> 1, 'last_insert_id'=> $objPollDetail->id,'idOption'=>$id,'options'=>$valorInsert]);
        }else{
            return Response::json([ 'success'=> 0, 'last_insert_id'=> 0,'idOption'=>$id,'options'=>$valorInsert]);
        }
    }

    public function insertPollDetailVisits()
    {
        $valoresPost= Input::all();
        $company_id = $valoresPost['company_id'];
        $store_id= $valoresPost['store_id'];
        $product_id = $valoresPost['product_id'];
        $publicity_id = $valoresPost['publicity_id'];
        $options = $valoresPost['options'];
        $arrayOptions = explode('|',$options);
        $otros = $valoresPost['otros'];
        $priorities = $valoresPost['priorities'];
        $poll_id = $valoresPost['poll_id'];
        $user_id = $valoresPost['user_id'];
        $sino = $valoresPost['sino'];
        $fecha = $valoresPost['fecha'];
        $comentario = $valoresPost['comentario'];
        $visit_id = $valoresPost['visit_id'];
        $objPoll = $this->pollRepo->find($poll_id);
        $objPollDetail = $this->PollDetailRepo->getModel();
        $objPollDetail->poll_id = $poll_id;
        $objPollDetail->store_id = $store_id;
        $objPollDetail->sino = $objPoll->sino;
        $objPollDetail->options = $objPoll->options;
        $objPollDetail->media = $objPoll->media;
        $objPollDetail->result = $sino;
        $objPollDetail->comentario = $comentario;
        $objPollDetail->auditor = $user_id;
        $objPollDetail->product_id = $product_id;
        $objPollDetail->publicity_id = $publicity_id;
        $objPollDetail->visit_id = $visit_id;
        $objPollDetail->company_id = $company_id;
        $objPollDetail->created_at = $fecha;
        $valorInsert="";$id=0;
        if ($objPollDetail->save())
        {
            if (count($arrayOptions)>0)
            {
                for($i = 0; $i < count($arrayOptions); ++$i) {
                    if ($arrayOptions[$i] <> '') {
                        $objPollOptionDetail = $this->PollOptionDetailRepo->getModel();
                        $objPollOptionDetail->poll_option_id = $arrayOptions[$i];
                        $objPollOptionDetail->result = 1;
                        $objPollOptionDetail->product_id =$product_id;
                        $objPollOptionDetail->company_id =$company_id;
                        $objPollOptionDetail->store_id =$store_id;
                        $objPollOptionDetail->auditor =$user_id;
                        $objPollOptionDetail->visit_id = $visit_id;
                        $objOption = $this->PollOptionRepo->find($arrayOptions[$i]);
                        $txtOption= $objOption->options;
                        if ($txtOption=='Otros'){
                            $objPollOptionDetail->otro =$otros;
                        }
                        //$objPollOptionDetail->created_at =$created_at;
                        /*if (count($arrayPriorities)>0)
                        {
                            if ($arrayPriorities[$i]<>'')
                            {
                                $objPollOptionDetail->priority = $arrayPriorities[$i];
                            }else{
                                $objPollOptionDetail->priority = 0;
                            }
                        }else{
                            $objPollOptionDetail->priority = 0;
                        }*/
                        if ($objPollOptionDetail->save())
                        {
                            $id = $objPollOptionDetail->id;
                            $valorInsert .=  ' Opción ingresada:'.$arrayOptions[$i];
                        }else{
                            $id=0;
                            $valorInsert .=  ' Opción NO ingresada:'.$arrayOptions[$i];
                        }
                    }
                }
            }
            return Response::json([ 'success'=> 1, 'last_insert_id'=> $objPollDetail->id,'idOption'=>$id,'options'=>$valorInsert]);
        }else{
            return Response::json([ 'success'=> 0, 'last_insert_id'=> 0,'idOption'=>$id,'options'=>$valorInsert]);
        }
    }

    /**
     * @return json y texto con opciones ingresadas
     * Ingresa varias opciones a la vez enviadas por post
     */
    public function insertOptions()
    {
        $valoresPost= Input::all();
        $company_id = $valoresPost['company_id'];
        $store_id= $valoresPost['store_id'];
        $product_id = $valoresPost['product_id'];
        $options = $valoresPost['options'];
        $priorities = $valoresPost['priorities'];
        $poll_detail_id = $valoresPost['poll_detail_id'];
        $user_id = $valoresPost['user_id'];
        $otros = $valoresPost['otros'];
        $objPollDetailRepo = $this->PollDetailRepo->find($poll_detail_id);
        $created_at = $objPollDetailRepo->created_at;
        $arrayOptions = explode('|',$options);
        $arrayPriorities = explode('|',$priorities);$valorInsert='';$id=0;
        if (count($arrayOptions)>0)
        {
            for($i = 0; $i < count($arrayOptions); ++$i) {
                if ($arrayOptions[$i]<>'')
                {
                    $objPollOptionDetail = $this->PollOptionDetailRepo->getModel();
                    $objPollOptionDetail->poll_option_id = $arrayOptions[$i];
                    $objPollOptionDetail->result = 1;
                    $objPollOptionDetail->product_id =$product_id;
                    $objPollOptionDetail->company_id =$company_id;
                    $objPollOptionDetail->store_id =$store_id;
                    $objPollOptionDetail->auditor =$user_id;
                    $objOption = $this->PollOptionRepo->find($arrayOptions[$i]);
                    $txtOption= $objOption->options;
                    if ($txtOption=='Otros'){
                        $objPollOptionDetail->otro =$otros;
                    }
                    $objPollOptionDetail->created_at =$created_at;
                    if (count($arrayPriorities)>0)
                    {
                        if ($arrayPriorities[$i]<>'')
                        {
                            $objPollOptionDetail->priority = $arrayPriorities[$i];
                        }else{
                            $objPollOptionDetail->priority = 0;
                        }
                    }else{
                        $objPollOptionDetail->priority = 0;
                    }
                    if ($objPollOptionDetail->save())
                    {
                        $id = $objPollOptionDetail->id;
                        $valorInsert .=  ' Opción ingresada:'.$arrayOptions[$i];
                    }else{
                        $id=0;
                        $valorInsert .=  ' Opción NO ingresada:'.$arrayOptions[$i];
                    }
                }
            }
            return Response::json([ 'success'=> 1, 'texto'=> $valorInsert, 'id'=> $id]);
        }else{
            return Response::json([ 'success'=> 0, 'texto'=> 'No hay opciones', 'id'=> $id]);
        }

    }

    /**
     * @return json y texto con opciones ingresadas
     * Ingresa varias opciones a la vez enviadas por post
     */
    public function insertOptionsVisits()
    {
        $valoresPost= Input::all();
        $company_id = $valoresPost['company_id'];
        $store_id= $valoresPost['store_id'];
        $product_id = $valoresPost['product_id'];
        $options = $valoresPost['options'];
        $priorities = $valoresPost['priorities'];
        $poll_detail_id = $valoresPost['poll_detail_id'];
        $user_id = $valoresPost['user_id'];
        $visit_id = $valoresPost['visit_id'];
        $otros = $valoresPost['otros'];
        $objPollDetailRepo = $this->PollDetailRepo->find($poll_detail_id);
        $created_at = $objPollDetailRepo->created_at;
        $arrayOptions = explode('|',$options);
        $arrayPriorities = explode('|',$priorities);$valorInsert='';$id=0;
        if (count($arrayOptions)>0)
        {
            for($i = 0; $i < count($arrayOptions); ++$i) {
                if ($arrayOptions[$i]<>'')
                {
                    $objPollOptionDetail = $this->PollOptionDetailRepo->getModel();
                    $objPollOptionDetail->poll_option_id = $arrayOptions[$i];
                    $objPollOptionDetail->result = 1;
                    $objPollOptionDetail->product_id =$product_id;
                    $objPollOptionDetail->company_id =$company_id;
                    $objPollOptionDetail->store_id =$store_id;
                    $objPollOptionDetail->auditor =$user_id;
                    $objPollOptionDetail->visit_id =$visit_id;
                    $objOption = $this->PollOptionRepo->find($arrayOptions[$i]);
                    $txtOption= $objOption->options;
                    if ($txtOption=='Otros'){
                        $objPollOptionDetail->otro =$otros;
                    }
                    $objPollOptionDetail->created_at =$created_at;
                    if (count($arrayPriorities)>0)
                    {
                        if ($arrayPriorities[$i]<>'')
                        {
                            $objPollOptionDetail->priority = $arrayPriorities[$i];
                        }else{
                            $objPollOptionDetail->priority = 0;
                        }
                    }else{
                        $objPollOptionDetail->priority = 0;
                    }
                    if ($objPollOptionDetail->save())
                    {
                        $id = $objPollOptionDetail->id;
                        $valorInsert .=  ' Opción ingresada:'.$arrayOptions[$i];
                    }else{
                        $id=0;
                        $valorInsert .=  ' Opción NO ingresada:'.$arrayOptions[$i];
                    }
                }
            }
            return Response::json([ 'success'=> 1, 'texto'=> $valorInsert, 'id'=> $id]);
        }else{
            return Response::json([ 'success'=> 0, 'texto'=> 'No hay opciones', 'id'=> $id]);
        }

    }

    //***JAIME ********
    /**
     * @return json succes y fecha de creación
     * Actualiza un poll_option_detail especifico
     * Para una opción especifica poll_option_id enviada por post
     */
    public function updatePollOptionsDetails()
    {
        $valoresPost= Input::all();//dd($valoresPost);
        //$result = $valoresPost['result'];
        //$company_id = $valoresPost['company_id'];
        $poll_option_details_id = $valoresPost['poll_option_details_id'];
        $selected_pol_options_id = $valoresPost['selected_pol_options_id'];
        $mytime = Carbon\Carbon::now();
        $horaSistema = $mytime->toDateTimeString();
        $pollOptionDetail = $this->PollOptionDetailRepo->getModel();
        $user = $pollOptionDetail::find($poll_option_details_id);

        $log_process = $this->logProcessRepo->getModel();
        $ObjPollOptionRepo= $this->PollOptionRepo->find($user->poll_option_id);
        $poll_id = $ObjPollOptionRepo->poll_id;
        $user_id = Auth::id();
        if ($user->auditor==0)
        {
            $objRoadDetails=$this->RoadDetailRepo->getModel();
            $road_details_obj=$objRoadDetails->where('store_id',$user->store_id)->where('company_id',$user->company_id)->first();
            $road_obj = $this->roadRepo->find($road_details_obj->road_id);
            $auditor_id=$road_obj->user_id;
            $user->auditor= $auditor_id;
        }
        $this->insertLog($log_process,$poll_id,$user_id,'operations',$user,0,$user->poll_option_id,$selected_pol_options_id,$poll_option_details_id,'poll_option_details','updated');

        $user->poll_option_id = $selected_pol_options_id;


        $updateResponse = $user->save();
        if ($updateResponse == true)
        {
            return Response::json([ 'success'=> 1, 'fecha' => $user->created_at]);
        }else{
            return Response::json([ 'success'=> 0, 'fecha' => $user->created_at]);
        }

    }
    
    public function excelCompanies($company_id,$audit_id)
    {
        $compaigne = $this->companyRepo->find($company_id);
        $customer = $this->customerRepo->find($compaigne->customer_id);//dd($customer);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $menus = $this->generateMenusAudits(0,$company_id,1);
        $valoresLinksExcels = $this->versionRepo->getRegisterForCompany($company_id,1);//dd($valoresLinksExcels->toArray());
        $urlBase = $this->urlBase;

        return View::make('audits/excelsCompany', compact('urlBase','customer','compaigne','valoresLinksExcels','menus','logo'));
    }



    public function detailsPublicitySod($company_id,$audit_id,$store_id,$publicity_id,$foto="0",$publicty_detail_id,$ciudad="0",$auditor_id="0")
    {

        $menus = $this->generateMenusAudits($audit_id,$company_id);
        $detailAudit = $this->auditRepo->find($audit_id);
        $campaigne = $this->companyRepo->find($company_id);
        $customer =$this->customerRepo->find($campaigne->customer_id);
        $objStore = $this->storeRepo->find($store_id);//dd(count($objStore));
        $alertas="";
        $city = $ciudad;$alertas .= $city." - ";
        $auditor = $auditor_id;
        if ($auditor=="0"){
            $obAuditor = [];
            $alertas .= " No Hay auditor Seleccionado ";
        }else{
            $obAuditor = $this->userRepo->find($auditor);
            $alertas .= $obAuditor->fullname ."(".$auditor.")"." - ";
        }

        $objPublicity = $this->publicityRepo->find($publicity_id);
        $alertas .= $objPublicity->fullname."(".$publicity_id.")"." - ";

        $objPublicityDetail = $this->PublicitiesDetailRepo->find($publicty_detail_id);
        $publictyDetail_id = $objPublicityDetail->id;

        $cantidadStoresForCampaigne = $this->companyStoreRepo->getStoresForCampaigne($company_id,"1","0","0","0","0","0","0","0","0","0");
        /*$cantidadStoresRouting = $this->companyStoreRepo->getStoresRoadsRouting($company_id);
        $cantidadStoresAudit = $this->companyStoreRepo->getStoresAuditRoadsRouting($company_id);*/
        $cantidadStoresRouting=0;$cantidadStoresAudit=0;

        $ListStores = $this->storeRepo->getCityForCampaigne($company_id,1);
        $ciudades= array(0 => "Seleccionar") + $ListStores->lists('ubigeo','ubigeo');
        $customer_id = 4;
        $estudio=6;
        $pollsWeb =$this->getAllPollsWeb($customer_id,$estudio);
        foreach ($pollsWeb as $pollWeb) {
            if (($pollWeb['identificador']=='abierto') and ($pollWeb['company_id']==$company_id))
            {
                $pollAbierto = $pollWeb['poll_id'];
            }
            if (($pollWeb['identificador']=='permitio') and ($pollWeb['company_id']==$company_id))
            {
                $pollPermitio = $pollWeb['poll_id'];
            }
            if (($pollWeb['identificador']=='existeVent') and ($pollWeb['company_id']==$company_id))
            {
                $pollExisteVent = $pollWeb['poll_id'];
            }
            if (($pollWeb['identificador']=='visibleVent') and ($pollWeb['company_id']==$company_id))
            {
                $pollVisibleVent = $pollWeb['poll_id'];
            }
            if (($pollWeb['identificador']=='ventanaW') and ($pollWeb['company_id']==$company_id))
            {
                $pollVentanaW = $pollWeb['poll_id'];
            }
            if (($pollWeb['identificador']=='comoEstaVent') and ($pollWeb['company_id']==$company_id))
            {
                $pollComoEstaVent = $pollWeb['poll_id'];
            }
            if (($pollWeb['identificador']=='encontroExhi') and ($pollWeb['company_id']==$company_id))
            {
                $pollEncontroExhi = $pollWeb['poll_id'];
            }
        }

        $ListAuditor = $this->userRepo->listUserCondition('auditor');
        $auditors= array(0 => "Seleccionar") + $ListAuditor->lists('fullname','id');

        $listCategory = $this->publicityRepo->getPublicityForCatMat($this->valoresCategory['sod'],$company_id);
        $publicities = array(0 => "Seleccionar") + $listCategory->lists('fullname','id');

        $storesxCampaigne = 0;$sod=$objPublicityDetail->sod;$tipo="Sod";
        if ($pollVentanaW==0)
        {
            $filtro=0;
            $photosAll= $this->MediaRepo->photosPublicityStore($publicity_id,$store_id,$company_id);//dd($photosAll);
            foreach ($photosAll as $photo)
            {
                $urlsFotos[] = array('id' => $photo->id,'archivo' => $photo->archivo,'urlFoto' => $this->urlBase.$this->urlFotos.$photo->archivo,'ingresado' => $photo->created_at);
            }//dd($urlsFotos);
            return View::make('audits/auditSodVentCampaign15', compact('objStore','city','auditor','alertas','sod','publictyDetail_id','publicity_id','publicities','urlsFotos','filtro','storesxCampaigne','company_id','auditors','ciudades','customer','campaigne','detailAudit','cantidadStoresForCampaigne','cantidadStoresRouting','cantidadStoresAudit','audit_id','menus'));
        }else{
            $filtro = $foto;//$urlsFotos = $this->urlBase.$this->urlFotos.$foto;
            $photosAll= $this->MediaRepo->photosPublicityStore($publicity_id,$store_id,$company_id);
            /*if (count($photosAll)<>1)
            {
                foreach ($photosAll as $photo)
                {
                    $urlsFotos[] = array('id' => $photo->id,'archivo' => $photo->archivo,'urlFoto' => $this->urlBase.$this->urlFotos.$photo->archivo,'ingresado' => $photo->created_at);
                }
                return View::make('audits/auditSodVentCampaign15', compact('objStore','city','auditor','alertas','sod','publictyDetail_id','publicity_id','publicities','urlsFotos','filtro','storesxCampaigne','company_id','auditors','ciudades','customer','campaigne','detailAudit','cantidadStoresForCampaigne','cantidadStoresRouting','cantidadStoresAudit','audit_id','menus'));
            }else{
                $filtro = $foto;$urlsFotos = $this->urlBase.$this->urlFotos.$foto;
            }*/
            if (count($photosAll)>0)
            {
                foreach ($photosAll as $photo)
                {
                    $urlsFotos[] = array('id' => $photo->id,'archivo' => $photo->archivo,'urlFoto' => $this->urlBase.$this->urlFotos.$photo->archivo,'ingresado' => $photo->created_at);
                }
            }else{
                $urlsFotos=[];
            }
        }

        //$valoresPolls= $this->getValores();


        $storeOpen =$pollAbierto;
        $storeAbierto = $this->getResponsePolls($store_id,$company_id,0,$storeOpen,'YesNo');

        $storePermitio = $pollPermitio;
        $permitio = $this->getResponsePolls($store_id,$company_id,0,$storePermitio,'YesNo');

        $storeExiste = $pollExisteVent;
        $existeVent = $this->getResponsePolls($store_id,$company_id,$publicity_id,$storeExiste,'YesNo');


        $storeVisible = $pollVisibleVent;
        $visibleVent = $this->getResponsePolls($store_id,$company_id,$publicity_id,$storeVisible,'YesNo');


        $storeW = $pollVentanaW;
        $ventW = $this->getResponsePolls($store_id,$company_id,$publicity_id,$storeW,'YesNo');


        $poll_comoEstaVent = $pollComoEstaVent;
        $comoEstaVent = $this->getResponsePolls($store_id,$company_id,$publicity_id,$poll_comoEstaVent,'Option');
//dd($pollComoEstaVent);
        $pollsResult = array('abierto' => $storeAbierto,'permitio' => $permitio,'existe' => $existeVent,'visible' => $visibleVent,'trabajada' => $ventW,'comoEstaVent'=>$comoEstaVent);

//dd($pollsResult);
        $poll_options_text= $this->PollOptionRepo->getOptions($pollComoEstaVent) ;

        $productForPublicity = $this->stockProductPopRepo->getProductForPublicity($company_id,$publicity_id);
        return View::make('audits/detailSod', compact('productForPublicity','pollsResult','tipo','objStore','city','auditor','alertas','sod','publictyDetail_id','publicity_id','publicities','urlsFotos','filtro','storesxCampaigne','company_id','auditors','ciudades','customer','campaigne','detailAudit','cantidadStoresForCampaigne','cantidadStoresRouting','cantidadStoresAudit','audit_id','menus','poll_options_text'));
    }

    public function ListStoresPublicity($ciudad="0",$publicity="0",$auditor_id="0",$audit="0",$company="0",$ventana="0",$trabajada="1")
    {
        $alertas="";
        if ($ciudad=="0"){
            $valoresPost= Input::all();//dd($valoresPost,$trabajada);
            $audit_id = $valoresPost['audit_id'];
            $company_id = $valoresPost['company_id'];

            if ($valoresPost['ciudad']<>"0"){
                $city =$valoresPost['ciudad'];
                $alertas .= $city." - ";
            }else{
                $city ="0";
            }
            if ($valoresPost['auditor']<>"0"){
                $auditor =$valoresPost['auditor'];
                $obAuditor = $this->userRepo->find($auditor);//dd($obAuditor);
                $alertas .= $obAuditor->fullname ."(".$auditor.")"." - ";
            }else{
                $auditor ="0";
            }
            if ($valoresPost['publicity']<>"0"){
                $publicity_id =$valoresPost['publicity'];
                $objPublicity = $this->publicityRepo->find($publicity_id);//dd($objPublicity);
                $alertas .= $objPublicity->fullname."(".$publicity_id.")"." - ";
            }else{
                $publicity_id ="0";
            }
            if ($valoresPost['tipo']<>"0"){
                $tipo =$valoresPost['tipo'];
            }else{
                $tipo ="0";
            }
        }else{
            $city = $ciudad;$alertas .= $city." - ";
            $auditor = $auditor_id;
            $audit_id = $audit;
            $company_id = $company;
            $tipo =$ventana;
            $obAuditor = $this->userRepo->find($auditor);
            $alertas .= $obAuditor->fullname ."(".$auditor.")"." - ";
            $publicity_id =$publicity;
            $objPublicity = $this->publicityRepo->find($publicity_id);
            $alertas .= $objPublicity->fullname."(".$publicity_id.")"." - ";
        }//dd($this->valoresCampaigne);

        $ventanasw = 1;

        $menus = $this->generateMenusAudits($audit_id,$company_id);
        $detailAudit = $this->auditRepo->find($audit_id);
        $campaigne = $this->companyRepo->find($company_id);
        $customer =$this->customerRepo->find($campaigne->customer_id);

        $cantidadStoresForCampaigne = $this->companyStoreRepo->getStoresForCampaigne($company_id,"1","0","0","0","0","0","0","0","0","0");
        $cantidadStoresRouting = $this->companyStoreRepo->getStoresRoadsRouting($company_id);
        $cantidadStoresAudit = $this->companyStoreRepo->getStoresAuditRoadsRouting($company_id);

        $ListStores = $this->storeRepo->getCityForCampaigne($company_id,1);
        $ciudades= array(0 => "Seleccionar") + $ListStores->lists('ubigeo','ubigeo');


        $ListAuditor = $this->userRepo->listUserCondition('auditor');
        $auditors= array(0 => "Seleccionar") + $ListAuditor->lists('fullname','id');

        if ($tipo=="Sod"){
            $listCategory = $this->publicityRepo->getPublicityForCatMat($this->valoresCategory['sod'],$company_id);
        }
        if ($tipo=="Exhibidor"){
            $listCategory = $this->publicityRepo->getPublicityForCatMat($this->valoresCategory['exhi'],$company_id);
        }

        $publicities = array(0 => "Seleccionar") + $listCategory->lists('fullname','id');

        $storesxCampaigne1 = $this->publicityRepo->getPublicityAlicorp($city,$auditor,$publicity_id,$company_id);
        $publicty_detail_id = 0;$sod = -1;$sw=0;//dd($storesxCampaigne1);
        if ($tipo=="Sod"){
            if (count($storesxCampaigne1)>0)
            {
                $collectStores = Collection::make($storesxCampaigne1);
                $grouped = $collectStores->groupBy('store_id');//dd($grouped[196514]);
                foreach ($grouped as $index =>$store)
                {
                    $storeAbierto="Si";$permitio="Si";$existeVent="Si";$ventW="Si";
                    //$store agrupa u array de objetos por cada poll_details_id
                    //if ($store->result == null){$result = 0;}else{$result = 1;}
                    //$publicty_detail_id = $store->publicity_details_id;$sod = $store->sod;
                    $collectPolls = Collection::make($store);
                    $grouped1 = $collectPolls->groupBy('poll_id');
                    foreach ($grouped1 as $index1 =>$store1)
                    {
                        if ($index1==$this->valoresCampaigne[$company_id]['abierto']){
                            if (($store1[0]->result==1) and ($store1[0]->publicity_id==0))
                            {
                                $storeAbierto= "Si";
                            }else{
                                $storeAbierto= "No";
                            }

                        }else{
                            if ($index1==$this->valoresCampaigne[$company_id]['permitio'])
                            {
                                if (($store1[0]->result==1)  and ($store1[0]->publicity_id==0)){
                                    $permitio='Si';
                                }else{
                                    $permitio='No';
                                }
                            }else{
                                if ($index1==$this->valoresCampaigne[$company_id]['existeVent'])
                                {
                                    if (($store1[0]->result==1)  and ($store1[0]->publicity_id==$publicity_id)){
                                        $existeVent="Si";
                                    }else{
                                        $existeVent="No";
                                    }
                                }else{
                                    if ($index1==$this->valoresCampaigne[$company_id]['ventanaW'])
                                    {
                                        if ($trabajada==1)
                                        {
                                            if (($store1[0]->result==1)  and ($store1[0]->publicity_id==$publicity_id)){
                                                $ventW = "Si";
                                            }else{
                                                $ventW = "No";
                                            }
                                        }else{
                                            if (($store1[0]->result==0)  and ($store1[0]->publicity_id==$publicity_id)){
                                                $ventW = "No";
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        $resultFiltro[$index] = array('abierto' => $storeAbierto,'permitio' => $permitio,'existe' => $existeVent,'trabajada' => $ventW);
                        //if (($store1[0]->store_id==186667) and ($publicity_id==961)){dd($trabajada,$store1[0],$index1,$this->valoresCampaigne[$company_id]['ventanaW'],$resultFiltro);}
                    }
                    //if ($store1[0]->store_id==186667){dd($resultFiltro);}
                }//dd($resultFiltro);
                $storesxCampaigne=[];
                foreach ($resultFiltro as $index2 =>$store2){
                    if ($trabajada==1){$respW="Si";}else{$respW="No";}
                    if (($store2['abierto']=="Si") and ($store2['permitio']=="Si") and ($store2['existe']=="Si") and ($store2['trabajada']==$respW)){
                        $foto='';
                        foreach ($grouped[$index2] as $values){
                            if ($values->publicity_id==$publicity_id){
                                $foto = $values->Foto;
                                $sod = $values->sod;
                            }
                        }
                        $storesxCampaigne[] = array('store_id' => $grouped[$index2][0]->store_id,'filtros' => $resultFiltro[$index2],'fullname' =>$grouped[$index2][0]->fullname,'auditor_id' =>$auditor, 'auditor' =>$obAuditor->fullname,'departamento'=>$grouped[$index2][0]->ubigeo,'fecha' =>$grouped[$index2][0]->fecha,'hora' => $grouped[$index2][0]->hora,'result'=>1,'foto' => $foto,'publicity_detail_id' => $grouped[$index2][0]->publicity_details_id,'sod'=>$sod);
                    }
                }
                //dd($storesxCampaigne,$respW);
            }else{
                $storesxCampaigne = [];
            }
        }
        if ($tipo=="Exhibidor"){
            if (count($storesxCampaigne1)>0) {
                $collectStores = Collection::make($storesxCampaigne1);
                $grouped = $collectStores->groupBy('store_id');
                foreach ($grouped as $index =>$store){
                    $publicty_detail_id = $store[0]->poll_details_id;
                    $sod = $store[0]->sod;
                    $storesxCampaigne[] = array('store_id' => $store[0]->store_id,'fullname' =>$store[0]->fullname,'auditor_id' =>$auditor, 'auditor' =>$obAuditor->fullname,'departamento'=>$store[0]->ubigeo,'fecha' =>$store[0]->fecha,'hora' => $store[0]->hora,'result'=>1,'foto' => $store[0]->Foto,'publicity_detail_id' => $publicty_detail_id,'sod'=>$sod);
                }
                /*foreach ($storesxCampaigne1 as $store) {
                    if ($store->result == null) {
                        $result = 0;
                    } else {
                        $result = 1;
                    }
                    $objPublicityDetail = $this->PublicitiesDetailRepo->findDetailForCondition($publicity_id,$store->store_id,$company_id);//dd($publicity_id,$store->store_id,$company_id,count($objPublicityDetail));
                    if (count($objPublicityDetail)>0) {
                        $publicty_detail_id = $objPublicityDetail[0]->id;
                        $sod = $objPublicityDetail[0]->sod;
                        $storesxCampaigne[] = array('store_id' => $store->store_id,'fullname' =>$store->fullname,'auditor_id' =>$store->auditor_id, 'auditor' =>$store->auditor,'departamento'=>$store->departamento,'fecha' =>$store->fecha,'hora' => $store->hora,'result'=>$result,'foto' => $store->foto,'publicity_detail_id' => $publicty_detail_id,'sod'=>$sod);
                    }

                }*/
            }else{
                $storesxCampaigne[] = array('store_id' => '','fullname' =>'','auditor_id' =>'', 'auditor' =>'','departamento'=>'','fecha' =>'','hora' => '','result'=>'','foto' => '','publicity_detail_id' => '','sod'=>'');
            }
        }//dd($storesxCampaigne);
        $filtro = 'SOD';$urlsFotos = $this->urlBase.$this->urlFotos;$publictyDetail_id='';$sod=0;$objStore=0;//dd($this->valoresCampaigne[$company_id]['ventanaW']);

        if ($tipo=="Sod"){//dd(count($storesxCampaigne),$respW);
            $valorPoll = $this->getValores();
            $pollW = $valorPoll[$company_id]['ventanaW'];
            return View::make('audits/auditSodVentCampaign3', compact('pollW','tipo','objStore','city','auditor','alertas','sod','publictyDetail_id','publicity_id','publicities','urlsFotos','filtro','storesxCampaigne','company_id','auditors','ciudades','customer','campaigne','detailAudit','cantidadStoresForCampaigne','cantidadStoresRouting','cantidadStoresAudit','audit_id','menus'));
        }
        if ($tipo=="Exhibidor"){
            return View::make('audits/auditExhiCampaign3', compact('objStore','city','auditor','alertas','sod','publictyDetail_id','publicity_id','publicities','urlsFotos','filtro','storesxCampaigne','company_id','auditors','ciudades','customer','campaigne','detailAudit','cantidadStoresForCampaigne','cantidadStoresRouting','cantidadStoresAudit','audit_id','menus'));
        }
    }

    public function getDetailPublicitiesCondition($publicity_id,$values,$contaminated,$company_id)
    {
        $audit_id=3;
        $urlBase = \App::make('url')->to('/');
        $urlImages = '/media/fotos/';
        $valores = explode('-',$values);//$valCiudad = "0-0-0-0-".$ubigeoext.'-'.$cadena; IBK:$valores = $city.'-'.$district.'-'.$ejecutivo.'-'.$rubro;
        $city = $valores[0];  //route('getDetailQuestionBayer', "106/".$valores."-0"."/".$company_id."/0"
        $dex = $valores[1];
        $menus = $this->generateMenusAudits($audit_id,$company_id);
        $obj_tipo_publicity = $this->publicityRepo->find($publicity_id);
        if ($obj_tipo_publicity->category_product_id==53){
            $tipo_exhibidor =1;
        }else{
            $tipo_exhibidor =0;
        }

        $datosStores = $this->getDetailPublicitiesAlicorp($publicity_id,$contaminated,$urlBase,$urlImages,$valores,$company_id);

        $campaigne = $this->companyRepo->find($company_id);
        $campaigne_name = $campaigne->fullname;//dd($campaigne_name);

        return View::make('audits/detailPublicities', compact('tipo_exhibidor','publicity_id','menus','company_id','city','dex','audit_id','datosStores','campaigne_name'));
    }

    public function ListStoresForAudit($audit_id, $company_id, $nroReg="0")
    {
        $menus = $this->generateMenusAudits($audit_id,$company_id);
        $detailAudit = $this->auditRepo->find($audit_id);
        $campaigne = $this->companyRepo->find($company_id);//dd($campaigne);
        $customer =$this->customerRepo->find($campaigne->customer_id);//dd($customer);
        $publicity_id=0;//dd($audit_id);
        $alertas="";
        if ($audit_id <> 1)
        {
            $roadsForCompany = $this->companyStoreRepo->getStoresForCampaigne($company_id);//dd($roadsForCompany[0]);
            $QAuditClose = $this->companyStoreRepo->getStoresRoadsRouting($roadsForCompany, 1);
            $QStoresForCompany = $this->companyStoreRepo->getStoresAuditRoadsRouting($company_id);
        }

        if ($audit_id == 1)
        {
            $cantidadStoresForCampaigne = $this->companyStoreRepo->getStoresForCampaigne($company_id,"1","0","0","0","0","0","0","0","0","0");
            $cantidadStoresRouting = $this->companyStoreRepo->getStoresRoadsRouting($company_id);
            $cantidadStoresAudit = $this->companyStoreRepo->getStoresAuditRoadsRouting($company_id);

            $ListStores = $this->storeRepo->getCityForCampaigne($company_id,1);
            $ciudades= array(0 => "Seleccionar") + $ListStores->lists('ubigeo','ubigeo');


            $ListAuditor = $this->userRepo->listUserCondition('auditor');
            $auditors= array(0 => "Seleccionar") + $ListAuditor->lists('fullname','id');

            $listCategory = $this->publicityRepo->getPublicityForCatMat($this->valoresCategory['sod'],$company_id);
            $publicities = array(0 => "Seleccionar") + $listCategory->lists('fullname','id');//dd($publicities);

            $storesxCampaigne=0;$filtro = '0';$urlsFotos='';$publictyDetail_id='';$sod=0;$city="";$auditor="";$objStore=0;$tipo="Sod";

            return View::make('audits/auditSodVentCampaign3', compact('tipo','objStore','city','auditor','alertas','sod','publictyDetail_id','publicity_id','publicities','urlsFotos','filtro','storesxCampaigne','company_id','auditors','ciudades','customer','campaigne','detailAudit','cantidadStoresForCampaigne','cantidadStoresRouting','cantidadStoresAudit','audit_id','menus'));
        }
        //alicorp Mistery
        if (($audit_id >= 68) and ($audit_id <= 71)  or ($audit_id == 77) or ($audit_id == 80) or ($audit_id == 85) or ($audit_id == 86) or ($audit_id == 87) or ($audit_id == 94) or ($audit_id == 93) or ($audit_id == 95) or ($audit_id == 96))
        {
            $num_reg = $QStoresForCompany - $QAuditClose;
            $regInsertAudit = $num_reg;
            return View::make('audits/auditListForCampaignIbk', compact('customer','campaigne','detailAudit','QStoresForCompany','QAuditClose','regInsertAudit','audit_id','menus'));
        }
        //alicorp Helena Evaluación
        if (($audit_id >= 73) and ($audit_id <= 76))
        {
            $num_reg = $QStoresForCompany - $QAuditClose;
            $regInsertAudit = $num_reg;
            return View::make('audits/auditListForCampaignIbk', compact('customer','campaigne','detailAudit','QStoresForCompany','QAuditClose','regInsertAudit','audit_id','menus'));
        }
        if ((($audit_id >= 7) and ($audit_id <= 11)) or (($audit_id >= 20) and ($audit_id <= 24)) or (($audit_id >= 25) and ($audit_id <= 29)) or (($audit_id >= 30) and ($audit_id <= 34)  and ($audit_id == 54)) or ($audit_id == 52) or ($audit_id == 61) or ($audit_id == 62) or   (($audit_id >= 100)  and ($audit_id <= 104) ) or (($audit_id >= 108)  and ($audit_id <= 114) ) )
        {
            $num_reg = $QStoresForCompany - $QAuditClose;
            $regInsertAudit = $num_reg;
            return View::make('audits/auditListForCampaignIbk', compact('customer','campaigne','detailAudit','QStoresForCompany','QAuditClose','regInsertAudit','audit_id','menus'));
        }
        if ((($audit_id >= 30) and ($audit_id <= 34)) or ($audit_id ==4) or ($audit_id ==37) or ($audit_id ==42) or ($audit_id ==39) or ($audit_id ==40) or ($audit_id ==41) or ($audit_id ==44) or ($audit_id ==46) or  ($audit_id == 45) or  ($audit_id == 59) or  (($audit_id >= 55) and ($audit_id <= 58) ))
        {
            $num_reg = $QStoresForCompany - $QAuditClose;
            $regInsertAudit = $num_reg;
            return View::make('audits/auditListForCampaignIbk', compact('customer','campaigne','detailAudit','QStoresForCompany','QAuditClose','regInsertAudit','audit_id','menus'));
        }
        //Bayer transferencista
        if ((($audit_id >= 63) and ($audit_id <= 66))  or  (($audit_id >= 85) and ($audit_id <= 87))){
            $num_reg = $QStoresForCompany - $QAuditClose;
            $regInsertAudit = $num_reg;
            return View::make('audits/auditBayerTransferencista', compact('customer','campaigne','detailAudit','QStoresForCompany','QAuditClose','regInsertAudit','audit_id','menus'));
            //return View::make('audits/audit63', compact('customer','campaigne','detailAudit','QStoresForCompany','QAuditClose','regInsertAudit','audit_id','menus'));
            //audit63 se usuara como prueba de VUE
        }
        if ($audit_id == 2)
        {
            if ($nroReg == "all"){
                $storesxCampaigne = $this->companyStoreRepo->getPresenceForCampaigne($company_id,"0");
                $vista = "todos";
            }else{
                $storesxCampaigne = $this->companyStoreRepo->getPresenceForCampaigne($company_id);
                $vista = "50 primeros";
            }
            $num_reg = $this->companyStoreRepo->getCountPresenceForCampaigne($company_id);
        }

        if ($audit_id == 3)
        {
            $cantidadStoresForCampaigne = $this->companyStoreRepo->getStoresForCampaigne($company_id,"1","0","0","0","0","0","0","0","0","0");
            $cantidadStoresRouting = $this->companyStoreRepo->getStoresRoadsRouting($company_id);
            $cantidadStoresAudit = $this->companyStoreRepo->getStoresAuditRoadsRouting($company_id);
            $ListStores = $this->storeRepo->getCityForCampaigne($company_id,1);
            $ciudades= array(0 => "Seleccionar") + $ListStores->lists('ubigeo','ubigeo');


            $ListAuditor = $this->userRepo->listUserCondition('auditor');
            $auditors= array(0 => "Seleccionar") + $ListAuditor->lists('fullname','id');

            $listCategory = $this->publicityRepo->getPublicityForCatMat($this->valoresCategory['exhi'],$company_id);
            $publicities = array(0 => "Seleccionar") + $listCategory->lists('fullname','id');//dd($publicities);

            $storesxCampaigne=0;$filtro = '0';$urlsFotos='';$publictyDetail_id='';$sod=0;$city="";$auditor="";$objStore=0;
            return View::make('audits/auditExhiCampaign3', compact('objStore','city','auditor','alertas','sod','publictyDetail_id','publicity_id','publicities','urlsFotos','filtro','storesxCampaigne','company_id','auditors','ciudades','customer','campaigne','detailAudit','cantidadStoresForCampaigne','cantidadStoresRouting','cantidadStoresAudit','audit_id','menus'));
        }

        if (($audit_id == 14) or ($audit_id == 48) or ($audit_id ==49) or ($audit_id ==50) or ($audit_id ==51) or ($audit_id ==93))
        {
            $cantidadStoresForCampaigne = $this->companyStoreRepo->getStoresForCampaigne($company_id,"1","0","0","0","0","0","0","0","0","0");
            $cantidadStoresRouting = $this->companyStoreRepo->getStoresRoadsRouting($company_id);
            $cantidadStoresAudit = $this->companyStoreRepo->getStoresAuditRoadsRouting($company_id);

            return View::make('audits/auditsQuestions', compact('customer','campaigne','detailAudit','cantidadStoresForCampaigne','cantidadStoresRouting','cantidadStoresAudit','audit_id','menus'));
        }

        if ($audit_id == 19)
        {
            $cantidadStoresForCampaigne = $this->companyStoreRepo->getStoresForCampaigne($company_id,"1","0","0","0","0","0","0","0","0","0");
            $cantidadStoresRouting = $this->companyStoreRepo->getStoresRoadsRouting($company_id);
            $cantidadStoresAudit = $this->companyStoreRepo->getStoresAuditRoadsRouting($company_id);

            $ListStores = $this->storeRepo->getCityForCampaigne($company_id,1);
            $ciudades= array(0 => "Seleccionar") + $ListStores->lists('ubigeo','ubigeo');


            $ListAuditor = $this->userRepo->listUserCondition('auditor');
            $auditors= array(0 => "Seleccionar") + $ListAuditor->lists('fullname','id');

            $listCategory = $this->publicityRepo->getPublicityForCatMat(55,$company_id);
            $publicities = array(0 => "Seleccionar") + $listCategory->lists('fullname','id');//dd($publicities);

            $storesxCampaigne=0;$filtro = '0';$urlsFotos='';$publictyDetail_id='';$sod=0;$city="";$auditor="";$objStore=0;

            return View::make('audits/auditSodVentCampaign3', compact('objStore','city','auditor','alertas','sod','publictyDetail_id','publicity_id','publicities','urlsFotos','filtro','storesxCampaigne','company_id','auditors','ciudades','customer','campaigne','detailAudit','cantidadStoresForCampaigne','cantidadStoresRouting','cantidadStoresAudit','audit_id','menus'));
        }
        if ($audit_id ==36)
        {
            $cantidadStoresForCampaigne = $this->companyStoreRepo->getStoresForCampaigne($company_id,"1","0","0","0","0","0","0","0","0","0");
            $cantidadStoresRouting = $this->companyStoreRepo->getStoresRoadsRouting($company_id);
            $cantidadStoresAudit = $this->companyStoreRepo->getStoresAuditRoadsRouting($company_id);
            return View::make('audits/auditListForCampaignBIM', compact('customer','campaigne','detailAudit','cantidadStoresForCampaigne','cantidadStoresRouting','cantidadStoresAudit','audit_id','menus'));
        }
        if ($audit_id == 38)
        {
            $cantidadStoresForCampaigne = $this->companyStoreRepo->getStoresForCampaigne($company_id,"1","0","0","0","0","0","0","0","0","0");
            $cantidadStoresRouting = $this->companyStoreRepo->getStoresRoadsRouting($company_id);
            $cantidadStoresAudit = $this->companyStoreRepo->getStoresAuditRoadsRouting($company_id);

            return View::make('audits/auditsQuestions', compact('customer','campaigne','detailAudit','cantidadStoresForCampaigne','cantidadStoresRouting','cantidadStoresAudit','audit_id','menus'));
        }
        if (isset($num_reg))
        {
            $regInsertAudit = $num_reg[0]->Num_Reg;
        }else{
            $regInsertAudit = 0;$vista=0;
        }

        return View::make('audits/auditListForCampaign', compact('vista','customer','campaigne','detailAudit','QStoresForCompany','QAuditClose','regInsertAudit','audit_id','menus','storesxCampaigne'));
    }

    public function DetailAudit($audit_id, $company_id, $store_id)
    {
        $menus = $this->generateMenusAudits($audit_id,$company_id);
        $detailAudit = $this->auditRepo->find($audit_id);
        $campaigne = $this->companyRepo->find($company_id);
        $customer =$this->customerRepo->find($campaigne->customer_id);
        $store_detail = $this->storeRepo->find($store_id);
        $urlBase = \App::make('url')->to('/');
        $urlImages = '/media/fotos/';

        if ($audit_id == 2)
        {
            $datosDetail = $this->presenceDetailRepo->getPresenceForStore($store_id);
            $num_reg = $this->companyStoreRepo->getCountPresenceForCampaigne($company_id);

        }
        if ($audit_id == 3)
        {
            $datosDetail0 = $this->PublicitiesDetailRepo->getPublicitiesForStore($store_id);
            $num_reg = $this->companyStoreRepo->getCountPublicityForCampaigne($company_id);
            if(! empty($datosDetail0)){
                foreach ($datosDetail0 as $publicityDetail){
                    $photos = $this->MediaRepo->photosPublicityStore($publicityDetail->publicity_id, $publicityDetail->store_id);

                    if(! empty($photos)){
                        foreach ($photos as $photo){
                            $datosFoto[] = array('id' => $photo->id,'archivo' => $photo->archivo, 'urlFoto' => $urlBase.$urlImages.$photo->archivo);
                        }

                    }else{
                        $datosFoto[] = array('id' => '0','archivo' => '', 'urlFoto' => '');
                    }
                    $datosDetail[] = array('publicity_id' => $publicityDetail->publicity_id, 'fullname' => $publicityDetail->publicity->fullname,'layout' =>$publicityDetail->layout, 'visible' => $publicityDetail->visible, 'contaminated' => $publicityDetail->contaminated, 'comment' => $publicityDetail->comment, 'arrayFoto' => $datosFoto, 'fechaCreated' => $publicityDetail->created_at,'fechaUpdated' => $publicityDetail->updated_at);
                    //dd($datosStores);
                    unset($datosFoto);
                }
            }else{
                $datosDetail[] = array('publicity_id' => 0, 'fullname' => '','layout' =>'', 'visible' => '', 'contaminated' => '', 'comment' => '', 'arrayFoto' => '', 'fechaCreated' => '','fechaUpdated' => '');
            }
        }
        $registros = $num_reg[0]->Num_Reg;
        return View::make('audits/auditDetailForStore', compact('store_detail','customer','campaigne','detailAudit','registros','audit_id','menus','datosDetail'));
    }

    public function closedPoints(){

        $titulo = 'Cliente';
        $links[] = array('nombre' => 'Excel General', 'url' => URL::to('/')."/reportes_excel/report_close_general.php", 'target' => 1);
        $links[] = array('nombre' => 'Excel Palmeras', 'url' => URL::to('/')."/reportes_excel/report_close_palmeras.php", 'target' => 1);
        $links[] = array('nombre' => 'Excel Promotoria', 'url' => URL::to('/')."/reportes_excel/report_close_promotoria.php", 'target' => 1);
        return View::make('audits/homeAudits', compact('links','titulo'));
    }


} 