<?php
use Auditor\Repositories\CompanyStoreRepo;
use Auditor\Repositories\PublicityStoreRepo;
use Auditor\Repositories\VisitStoreRepo;
use Auditor\Repositories\MarkRouteRepo;
use Illuminate\Support\Collection;

class CompanyStoreController extends BaseController{

    protected $companyStoreRepo;
    protected $publicityStoreRepo;
    protected $visitStoreRepo;
    protected $markRouteRepo;

    public function __construct(MarkRouteRepo $markRouteRepo,VisitStoreRepo $visitStoreRepo,PublicityStoreRepo $publicityStoreRepo,CompanyStoreRepo $companyStoreRepo)
    {
        $this->companyStoreRepo = $companyStoreRepo;
        $this->publicityStoreRepo = $publicityStoreRepo;
        $this->visitStoreRepo = $visitStoreRepo;
        $this->markRouteRepo = $markRouteRepo;
    }

    public function insertCompanyStore()
    {
        $valoresPost= Input::all(); //dd($valoresPost);
        $company_id = $valoresPost['company_id'];
        $ruteado = $valoresPost['ruteado'];
        $store_id = $valoresPost['store_id'];
        $objCompanyStore = $this->companyStoreRepo->getModel();
        $objCompanyStore->company_id=$company_id;
        $objCompanyStore->store_id = $store_id;
        $objCompanyStore->ruteado=$ruteado;
        if ($objCompanyStore->save())
        {
            return Response::json([ 'success'=> 1, 'id' => $objCompanyStore->id]);
        }else{
            return Response::json([ 'success'=> 0, 'id' => 0]);
        }

    }
    
    /*public function getStoresForRoutingForCity(){
        $valoresPost= Input::all(); //dd($valoresPost);
        $departament = $valoresPost['departament'];
        $objCompanyStores = $this->companyStoreRepo->getStoresForRouting(0,$departament);
        
        if (count($objCompanyStores)>0){
            foreach ($objCompanyStores as $objCompanyStore) {
                if ($objCompanyStore->study_id==2){
                    $publicity_id='564';$visit_id=0;
                    if ($this->publicityStoreRepo->existPublicityInStore($publicity_id,$objCompanyStore->store_id,$objCompanyStore->company_id,$visit_id)){
                        $valores[]=array('id'=>$objCompanyStore->store_id,'cadenaRuc'=>$objCompanyStore->cadenaRuc,'tipo'=>$objCompanyStore->type,'fullname'=>$objCompanyStore->fullname,'address'=>$objCompanyStore->address,'referencia'=>$objCompanyStore->urbanization,'provincia'=>$objCompanyStore->region,'departamento'=>$objCompanyStore->ubigeo,'district'=>$objCompanyStore->district,'codclient'=>$objCompanyStore->codclient,'active'=>$objCompanyStore->active,'company_id'=>$objCompanyStore->company_id,'campaigne'=>$objCompanyStore->campaigne,'latitud'=>$objCompanyStore->latitude,'longitud'=>$objCompanyStore->longitude,'customer'=>$objCompanyStore->customer,'customer_id'=>$objCompanyStore->customer_id,'estudio_id'=>$objCompanyStore->study_id,'estudio'=>$objCompanyStore->estudio,'cabecera'=>1,'dif_campaigne'=>$objCompanyStore->cell);
                    }else{
                        $valores[]=array('id'=>$objCompanyStore->store_id,'cadenaRuc'=>$objCompanyStore->cadenaRuc,'tipo'=>$objCompanyStore->type,'fullname'=>$objCompanyStore->fullname,'address'=>$objCompanyStore->address,'referencia'=>$objCompanyStore->urbanization,'provincia'=>$objCompanyStore->region,'departamento'=>$objCompanyStore->ubigeo,'district'=>$objCompanyStore->district,'codclient'=>$objCompanyStore->codclient,'active'=>$objCompanyStore->active,'company_id'=>$objCompanyStore->company_id,'campaigne'=>$objCompanyStore->campaigne,'latitud'=>$objCompanyStore->latitude,'longitud'=>$objCompanyStore->longitude,'customer'=>$objCompanyStore->customer,'customer_id'=>$objCompanyStore->customer_id,'estudio_id'=>$objCompanyStore->study_id,'estudio'=>$objCompanyStore->estudio,'cabecera'=>0,'dif_campaigne'=>$objCompanyStore->cell);
                    }
                }else{
                    $valores[]=array('id'=>$objCompanyStore->store_id,'cadenaRuc'=>$objCompanyStore->cadenaRuc,'tipo'=>$objCompanyStore->type,'fullname'=>$objCompanyStore->fullname,'address'=>$objCompanyStore->address,'referencia'=>$objCompanyStore->urbanization,'provincia'=>$objCompanyStore->region,'departamento'=>$objCompanyStore->ubigeo,'district'=>$objCompanyStore->district,'codclient'=>$objCompanyStore->codclient,'active'=>$objCompanyStore->active,'company_id'=>$objCompanyStore->company_id,'campaigne'=>$objCompanyStore->campaigne,'latitud'=>$objCompanyStore->latitude,'longitud'=>$objCompanyStore->longitude,'customer'=>$objCompanyStore->customer,'customer_id'=>$objCompanyStore->customer_id,'estudio_id'=>$objCompanyStore->study_id,'estudio'=>$objCompanyStore->estudio,'cabecera'=>0,'dif_campaigne'=>$objCompanyStore->cell);
                }

            }

        }else{
            $valores=[];
        }
        header('Access-Control-Allow-Origin: *');
        return Response::json($valores);
        
    }*/

    public function getStoresForRoutingForCompanyVisit(){
        $valoresPost= Input::all(); //dd($valoresPost);
        $departament = $valoresPost['departament'];
        $company_id = $valoresPost['company_id'];
        $visit_id = $valoresPost['visit_id'];
        if ($visit_id<>"0"){
            $objCompanyStores = $this->companyStoreRepo->getStoresForRoutingForCompanyVisit(0,$departament,$company_id,$visit_id);//dd($objCompanyStores);
        }else{
            $objCompanyStores = $this->companyStoreRepo->getStoresForRouting(0,$departament,$company_id);
        }

        if (count($objCompanyStores)>0){
            foreach ($objCompanyStores as $objCompanyStore) {
                $publicity_id='564';
                if ($this->publicityStoreRepo->existPublicityInStore($publicity_id,$objCompanyStore->store_id,$objCompanyStore->company_id,$visit_id)){
                    $valores[]=array('id'=>$objCompanyStore->store_id,'cadenaRuc'=>$objCompanyStore->cadenaRuc,'tipo'=>$objCompanyStore->type,'fullname'=>$objCompanyStore->fullname,'address'=>$objCompanyStore->address,'referencia'=>$objCompanyStore->urbanization,'provincia'=>$objCompanyStore->region,'departamento'=>$objCompanyStore->ubigeo,'district'=>$objCompanyStore->district,'codclient'=>$objCompanyStore->codclient,'active'=>$objCompanyStore->active,'company_id'=>$objCompanyStore->company_id,'campaigne'=>$objCompanyStore->campaigne,'latitud'=>$objCompanyStore->latitude,'longitud'=>$objCompanyStore->longitude,'cabecera'=>1);
                }else{
                    $valores[]=array('id'=>$objCompanyStore->store_id,'cadenaRuc'=>$objCompanyStore->cadenaRuc,'tipo'=>$objCompanyStore->type,'fullname'=>$objCompanyStore->fullname,'address'=>$objCompanyStore->address,'referencia'=>$objCompanyStore->urbanization,'provincia'=>$objCompanyStore->region,'departamento'=>$objCompanyStore->ubigeo,'district'=>$objCompanyStore->district,'codclient'=>$objCompanyStore->codclient,'active'=>$objCompanyStore->active,'company_id'=>$objCompanyStore->company_id,'campaigne'=>$objCompanyStore->campaigne,'latitud'=>$objCompanyStore->latitude,'longitud'=>$objCompanyStore->longitude,'cabecera'=>0);
                }

            }

        }
        header('Access-Control-Allow-Origin: *');
        return Response::json($valores);

    }

    public function getStoresForRoutingForCity(){
        $valoresPost= Input::all(); //dd($valoresPost);
        $departament = $valoresPost['departament'];
        $objCompanyStores = $this->companyStoreRepo->getStoresForRouting(0,$departament);//dd($objCompanyStores);

        if (count($objCompanyStores)>0){
            foreach ($objCompanyStores as $objCompanyStore) {
                if ($objCompanyStore->study_id==2){
                    $publicity_id='564';$visit_id=0;
                    if ($this->publicityStoreRepo->existPublicityInStore($publicity_id,$objCompanyStore->store_id,$objCompanyStore->company_id,$visit_id)){
                        $valores[]=array(
                            'id'                =>      $objCompanyStore->store_id,
                            'cadenaRuc'         =>      $objCompanyStore->cadenaRuc,
                            'tipo'              =>      $objCompanyStore->type,
                            'fullname'          =>      $objCompanyStore->fullname,
                            'address'           =>      $objCompanyStore->address,
                            'referencia'        =>      $objCompanyStore->urbanization,
                            'provincia'         =>      $objCompanyStore->region,
                            'departamento'      =>      $objCompanyStore->ubigeo,
                            'district'          =>      $objCompanyStore->district,
                            'codclient'         =>      $objCompanyStore->codclient,
                            'active'            =>      $objCompanyStore->active,
                            'company_id'        =>      $objCompanyStore->company_id,
                            'campaigne'         =>      $objCompanyStore->campaigne,
                            'latitud'           =>      $objCompanyStore->latitude,
                            'longitud'          =>      $objCompanyStore->longitude,
                            'customer'          =>      $objCompanyStore->customer,
                            'customer_id'       =>      $objCompanyStore->customer_id,
                            'estudio_id'        =>      $objCompanyStore->study_id,
                            'owner'        =>      $objCompanyStore->owner,
                            'estudio'           =>      $objCompanyStore->estudio,
                            'cabecera'          =>      1,
                            'dif_campaigne'     =>      $objCompanyStore->cell,
                            'marker_point_web'  =>      $objCompanyStore->marker_point_web);
                    }else{
                        $valores[]=array(
                            'id'                =>      $objCompanyStore->store_id,
                            'cadenaRuc'         =>      $objCompanyStore->cadenaRuc,
                            'tipo'              =>      $objCompanyStore->type,
                            'fullname'          =>      $objCompanyStore->fullname,
                            'address'           =>      $objCompanyStore->address,
                            'referencia'        =>      $objCompanyStore->urbanization,
                            'provincia'         =>      $objCompanyStore->region,
                            'departamento'      =>      $objCompanyStore->ubigeo,
                            'district'          =>      $objCompanyStore->district,
                            'codclient'         =>      $objCompanyStore->codclient,
                            'active'            =>      $objCompanyStore->active,
                            'company_id'        =>      $objCompanyStore->company_id,
                            'campaigne'         =>      $objCompanyStore->campaigne,
                            'latitud'           =>      $objCompanyStore->latitude,
                            'longitud'          =>      $objCompanyStore->longitude,
                            'customer'          =>      $objCompanyStore->customer,
                            'customer_id'       =>      $objCompanyStore->customer_id,
                            'estudio_id'        =>      $objCompanyStore->study_id,
                            'owner'        =>      $objCompanyStore->owner,
                            'estudio'           =>      $objCompanyStore->estudio,
                            'cabecera'          =>      0,
                            'dif_campaigne'     =>      $objCompanyStore->cell,
                            'marker_point_web'  =>      $objCompanyStore->marker_point_web);
                    }
                }else{
                    $valores[]=array(
                        'id'                =>      $objCompanyStore->store_id,
                        'cadenaRuc'         =>      $objCompanyStore->cadenaRuc,
                        'tipo'              =>      $objCompanyStore->type,
                        'fullname'          =>      $objCompanyStore->fullname,
                        'address'           =>      $objCompanyStore->address,
                        'referencia'        =>      $objCompanyStore->urbanization,
                        'provincia'         =>      $objCompanyStore->region,
                        'departamento'      =>      $objCompanyStore->ubigeo,
                        'district'          =>      $objCompanyStore->district,
                        'codclient'         =>      $objCompanyStore->codclient,
                        'active'            =>      $objCompanyStore->active,
                        'company_id'        =>      $objCompanyStore->company_id,
                        'campaigne'         =>      $objCompanyStore->campaigne,
                        'latitud'           =>      $objCompanyStore->latitude,
                        'longitud'          =>      $objCompanyStore->longitude,
                        'customer'          =>      $objCompanyStore->customer,
                        'customer_id'       =>      $objCompanyStore->customer_id,
                        'estudio_id'        =>      $objCompanyStore->study_id,
                        'estudio'           =>      $objCompanyStore->estudio,
                        'owner'        =>      $objCompanyStore->owner,
                        'cabecera'          =>      0,
                        'dif_campaigne'     =>      $objCompanyStore->cell,
                        'marker_point_web'  =>      $objCompanyStore->marker_point_web,
                        'chanel_store_id'   =>      $objCompanyStore->chanel_store_id);
                }
            }

        }else{
            $valores=[];
        }

//        $valores=array( 'data' => $valores);
        header('Access-Control-Allow-Origin: *');
        return Response::json($valores);

    }

    public function getStoresForRoutingForCityVisits(){
        $valoresPost= Input::all(); //dd($valoresPost);
        $departament = $valoresPost['departament'];
        $objCompanyStores = $this->companyStoreRepo->getStoresForRouting(0,$departament,"0",1);//dd($objCompanyStores);
        $collectionCS = Collection::make($objCompanyStores);
        $objForCompany= $collectionCS->groupBy(function($item){ return $item->company_id; });
        //$objVisitStore = $this->visitStoreRepo->getModel();
        $objMarkRoute = $this->markRouteRepo->getModel();
        foreach ($objForCompany as $index => $reg) {
            $regMarkRoute[$index] = $objMarkRoute->where('company_id',$index)->get();
        }

        if (count($objCompanyStores)>0){
            foreach ($objCompanyStores as $objCompanyStore) {

                $num_visitas = round($objCompanyStore->visits);
                for($i=$objCompanyStore->visit_id_new; $i<=$num_visitas;$i++)
                {
                    foreach ($regMarkRoute[$objCompanyStore->company_id] as $reg) {
                        if (($reg->visit_id==$i) and ($objCompanyStore->chanel_store_id==$reg->chanel_store_id))
                        {
                            $arrayMarkPoints[] = array('visit_id'=>$i,'mark_point'=>$reg->mark_point);
                        }
                    }
                    /*$regVisitStore = $objVisitStore->where('company_id',$objCompanyStore->company_id)->where('store_id',$objCompanyStore->store_id)->where('visit_id',$i)->get();
                    if (count($regVisitStore)==0)
                    {
                        $regMarkRoute = $objMarkRoute->where('visit_id',$i)->where('company_id',$objCompanyStore->company_id)->where('chanel_store_id',$objCompanyStore->chanel_store_id)->first();
                        $arrayMarkPoints[] = array('visit_id'=>$i,'mark_point'=>$regMarkRoute->mark_point);
                    }*/
                }
                if (isset($arrayMarkPoints))
                {

                }else{
                    $arrayMarkPoints=[];
                }$max=0;
                foreach ($regMarkRoute[$objCompanyStore->company_id] as $reg) {
                    if ($max<$reg->visit_id)
                    {
                        $max = $reg->visit_id;
                    }
                }
                //$objNumMaxVisit = $objMarkRoute->where('company_id',$objCompanyStore->company_id)->orderBy('visit_id','DESC')->first();
                $regNumMaxVisit= $max;

                $valores[]=array(
                    'id'                =>      $objCompanyStore->store_id,
                    'cadenaRuc'         =>      $objCompanyStore->cadenaRuc,
                    'tipo'              =>      $objCompanyStore->type,
                    'fullname'          =>      $objCompanyStore->fullname,
                    'address'           =>      $objCompanyStore->address,
                    'referencia'        =>      $objCompanyStore->urbanization,
                    'provincia'         =>      $objCompanyStore->region,
                    'departamento'      =>      $objCompanyStore->ubigeo,
                    'district'          =>      $objCompanyStore->district,
                    'codclient'         =>      $objCompanyStore->codclient,
                    'active'            =>      $objCompanyStore->active,
                    'company_id'        =>      $objCompanyStore->company_id,
                    'campaigne'         =>      $objCompanyStore->campaigne,
                    'latitud'           =>      $objCompanyStore->latitude,
                    'longitud'          =>      $objCompanyStore->longitude,
                    'customer'          =>      $objCompanyStore->customer,
                    'customer_id'       =>      $objCompanyStore->customer_id,
                    'estudio_id'        =>      $objCompanyStore->study_id,
                    'estudio'           =>      $objCompanyStore->estudio,
                    'cabecera'          =>      0,
                    'dif_campaigne'     =>      $objCompanyStore->cell,
                    'marker_point_web'  =>      $objCompanyStore->marker_point_web,
                    'visits'            =>      $objCompanyStore->visits,
                    'num_max_visit'     =>      $regNumMaxVisit,
                    'chanel_store_id'   =>      $objCompanyStore->chanel_store_id,
                    'mark_points'       =>      $arrayMarkPoints);
                unset($arrayMarkPoints);
            }

        }else{
            $valores=[];
        }

//        $valores=array( 'data' => $valores);
        header('Access-Control-Allow-Origin: *');
        return Response::json($valores);

    }

} 