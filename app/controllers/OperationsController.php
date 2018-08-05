<?php

use Auditor\Repositories\ProductStoreRegionRepo;
use Auditor\Repositories\StoreRepo;
use Auditor\Repositories\MediaRepo;
use Auditor\Repositories\ProductDetailRepo;
use Auditor\Repositories\PublicitiesDetailRepo;
use Auditor\Repositories\PollDetailRepo;
use Auditor\Repositories\CompanyRepo;
use Auditor\Repositories\PollRepo;
use Auditor\Repositories\RoadDetailRepo;
use Auditor\Repositories\PollOptionDetailRepo;
use Auditor\Repositories\AuditRoadStoreRepo;
use Auditor\Repositories\CompanyStoreRepo;

class OperationsController extends BaseController{

    protected $ProductStoreRegionRepo;
    protected $storeRepo;
    protected $mediaRepo;
    protected $productDetailRepo;
    protected $publicitiesDetailRepo;
    protected $pollDetailRepo;
    protected $companyRepo;
    protected $pollRepo;
    protected $roadDetailRepo;
    protected $pollOptionDetailRepo;
    protected $auditRoadStoreRepo;
    protected $companyStoreRepo;

    public $urlBase;
    public $urlPhotos;

    public function __construct(CompanyStoreRepo $companyStoreRepo,AuditRoadStoreRepo $auditRoadStoreRepo,PollOptionDetailRepo $pollOptionDetailRepo,RoadDetailRepo $roadDetailRepo,PollRepo $pollRepo,CompanyRepo $companyRepo,PollDetailRepo $pollDetailRepo,PublicitiesDetailRepo $publicitiesDetailRepo,ProductDetailRepo $productDetailRepo,MediaRepo $mediaRepo,StoreRepo $storeRepo,ProductStoreRegionRepo $ProductStoreRegionRepo)
    {
        $this->ProductStoreRegionRepo = $ProductStoreRegionRepo;
        $this->storeRepo = $storeRepo;
        $this->mediaRepo=$mediaRepo;
        $this->productDetailRepo = $productDetailRepo;
        $this->publicitiesDetailRepo = $publicitiesDetailRepo;
        $this->pollDetailRepo = $pollDetailRepo;
        $this->companyRepo = $companyRepo;
        $this->pollRepo = $pollRepo;
        $this->roadDetailRepo = $roadDetailRepo;
        $this->pollOptionDetailRepo = $pollOptionDetailRepo;
        $this->auditRoadStoreRepo = $auditRoadStoreRepo;
        $this->companyStoreRepo = $companyStoreRepo;

        $this->urlBase = \App::make('url')->to('/');
        $this->urlPhotos = 'media/fotos/';
    }

    public function addProdRegStoreForCVS($archivo,$company_id)
    {
        $file_name=$archivo;
        $row = 0;$v="";
        $mytime = Carbon\Carbon::now();
        $horaSistema = $mytime->toDateTimeString();
        $fp = fopen ( 'media/archivos/'.$file_name , "r" );
        $ciudades[0] = 'LIMA';
        $ciudades[1] = 'Tacna';
        $ciudades[2] = 'Huancayo';
        $ciudades[3] = 'Cusco';
        $ciudades[4] = 'Arequipa';
        $ciudades[5] = 'Chimbote';
        $ciudades[6] = 'Trujillo';
        $ciudades[7] = 'Chiclayo';
        $ciudades[8] = 'Piura';
        while ($data = fgetcsv ($fp, 1000, ",")){
            $num = count ($data);
            $row++;$c=0;$col=1;
            if ($row<>1){//'Mini Market','Bodega Clásica','Bodega Alto Tráfico'
                for ($i = 0; $i <= 8; $i++) {
                    $c++;
                    $col=$i + 1;
                    //if ($i==3){echo '$i='.$i.' $c='.$c.' $col='.$col ;dd($data);}
                    if ($data[$c] == 2){
                        $tipo_bodega ='Mini Market';
                        $addReg = $this->ProductStoreRegionRepo->getModel();
                        $addReg->product_id = $data[0];
                        $addReg->region = $ciudades[$i];
                        $addReg->tipo_bodega = $tipo_bodega;
                        $addReg->company_id = $company_id;
                        $addReg->price = $data[$col*4];
                        $addReg->created_at = $horaSistema;
                        $addReg->updated_at = $horaSistema;
                        $addReg->save();
                        //$v .='$c='.$c." ".'$col='.$col." ".$data[0]." ".$ciudades[$i]." ".$tipo_bodega." ".$company_id." ".$data[$col*4]." ".$horaSistema." ".$horaSistema. "<br>";
                    }  else{}
                    $c++;
                    if ($data[$c] == 2){
                        $tipo_bodega ='Bodega Clásica';
                        $addReg = $this->ProductStoreRegionRepo->getModel();
                        $addReg->product_id = $data[0];
                        $addReg->region = $ciudades[$i];
                        $addReg->tipo_bodega = $tipo_bodega;
                        $addReg->company_id = $company_id;
                        $addReg->price = $data[$col*4];
                        $addReg->created_at = $horaSistema;
                        $addReg->updated_at = $horaSistema;
                        $addReg->save();
                        //$v .='$c='.$c." ".'$col='.$col." ".$data[0]." ".$ciudades[$i]." ".$tipo_bodega." ".$company_id." ".$data[$col*4]." ".$horaSistema." ".$horaSistema. "<br>";
                    }  else{}
                    $c++;
                    if ($data[$c] == 2){
                        $tipo_bodega ='Bodega Alto Tráfico';
                        $addReg = $this->ProductStoreRegionRepo->getModel();
                        $addReg->product_id = $data[0];
                        $addReg->region = $ciudades[$i];
                        $addReg->tipo_bodega = $tipo_bodega;
                        $addReg->company_id = $company_id;
                        $addReg->price = $data[$col*4];
                        $addReg->created_at = $horaSistema;
                        $addReg->updated_at = $horaSistema;
                        $addReg->save();
                        //$v .='$c='.$c." ".'$col='.$col." ".$data[0]." ".$ciudades[$i]." ".$tipo_bodega." ".$company_id." ".$data[$col*4]." ".$horaSistema." ".$horaSistema. "<br>";
                    }  else{}
                    $c++;

                }//print_r($v);dd($v);
            }

        }
dd('ok');
    }

    public function updateEjecutivoStore($archivo)
    {
        $file_name=$archivo;
        $row = 0;$v="";$c=0;
        $mytime = Carbon\Carbon::now();
        $horaSistema = $mytime->toDateTimeString();
        $fp = fopen ( 'media/archivos/'.$file_name , "r" );
        while ($data = fgetcsv ($fp, 1000, ",")){
            $storeAct= $this->storeRepo->updateEjcutivoForStore($data[0],$data[1]);//dd($storeAct);
            if ($storeAct=true) {$valor = "ok";}else{$valor = "NO";}
            $store = $this->storeRepo->find($data[0]);
            $datosActualizados[] = array('store' => $store,'actualizado' => $valor);
        }//dd($datosActualizados);
        return View::make('operations/actualizaEjecutivo',compact('datosActualizados'));
    }
    
    public function deleteStoreCVS($archivo)
    {
        $file_name=$archivo;
        $row = 0;$v="";$c=0;
        $mytime = Carbon\Carbon::now();
        $horaSistema = $mytime->toDateTimeString();
        $fp = fopen ( 'media/archivos/'.$file_name , "r" );
        while ($data = fgetcsv ($fp, 1000, ",")){
            $store = $this->storeRepo->find($data[0]);
            $storeAct= $this->storeRepo->deleteStore($data[0]);//dd($storeAct);
            if ($storeAct==true) {$valor = "ok";}else{$valor = "NO";}

            $datosActualizados[] = array('store' => $store,'eliminado' => $valor);
        }//dd($datosActualizados);
        return View::make('operations/eliminaStore',compact('datosActualizados'));
    }

    /**
     * @description permite eliminar medias a traves del media_id especifico enviado
     * @param $media_id
     * @param string $type
     * @return mixed
     */
    public function deleteFileMedia($media_id, $type="photo"){
        $objMedia = $this->mediaRepo->find($media_id);//dd($objMedia);
        $modulo='eliminaPhoto';
        if (!is_null($objMedia)){
            if ($type=='photo'){
                $nombre_fichero = $this->urlPhotos.$objMedia->archivo;
                if (file_exists($nombre_fichero))
                {
                   if (unlink($nombre_fichero)){
                       $resultado = true;
                   }else{
                       $resultado = false;
                   }
                }else{
                    $resultado = false;
                }
            }
            $objMedia->delete();
        }

        return View::make('operations/operationsFull',compact('modulo','objMedia','resultado'));
    }

    /**
     * @description borra solamente archivos fotos del store_id y del company_id enviado borra varias fotos y registros medias
     * @param string $store_id
     * @param string $company_id
     * @param string $ajax
     * @return mixed
     */
    public function deletePhoto($store_id="0", $company_id="0", $publicity_id="0",$visit_id="0",$ajax="0"){
        if ($store_id=="0"){
            $valoresPost= Input::all();
            $store_id = $valoresPost['store_id'];
            $company_id = $valoresPost['company_id'];
            $ajax="1";
        }
        $objMedias = $this->mediaRepo->photosForStoreCompany($store_id,$company_id,$publicity_id,$visit_id);$num_fotos=0;
        $numMedias = count($objMedias);
        if ($numMedias>0){
            foreach ($objMedias as $objMedia) {
                $nombre_fichero = $this->urlPhotos.$objMedia->archivo;
                if (file_exists($nombre_fichero))
                {
                    if (unlink($nombre_fichero)){
                        $resultado = true;$num_fotos = $num_fotos + 1;
                    }else{
                        $resultado = false;
                    }
                }else{
                    $resultado = false;
                }
            }
        }else{
            $resultado = false;$num_fotos=0;
        }
        $objMedia = $this->mediaRepo->getModel();
        if ($publicity_id=="0"){
            $affectMedias = $objMedia->where('store_id',$store_id)->where('company_id',$company_id)->where('visit_id',$visit_id)->delete();
        }else{
            $affectMedias = $objMedia->where('store_id',$store_id)->where('company_id',$company_id)->where('publicities_id',$publicity_id)->where('visit_id',$visit_id)->delete();
        }

        if ($ajax=="1")
        {
            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');
            return  Response::json([ 'success'=> 1,'num_medias'=>$affectMedias,'num_fotos'=>$num_fotos]);
        }else{
            return  array('store_id'=>$store_id,'num_medias'=>$numMedias,'result'=>$affectMedias,'num_fotos'=>$num_fotos);
        }

    }

    public function saveSOD($publicityDetail_id="0",$sod="0",$foto="0",$publicity_id="0",$ajax="0"){
        if ($publicityDetail_id=="0"){
            $valoresPost= Input::all();
            $publicityDetail_id = $valoresPost['publicityDetail_id'];
            $sods = $valoresPost['sod'];
            $foto = $valoresPost['foto'];
            $company_id = $valoresPost['company_id'];
            $publicity_id = $valoresPost['publicity_id'];
            $ajax=1;
        }
        $customer_id = 4;
        $estudio=6;
        $pollsWeb =$this->getAllPollsWeb($customer_id,$estudio);
        foreach ($pollsWeb as $pollWeb) {
            if (($pollWeb['identificador']=='sodPorMarca') and ($pollWeb['company_id']==$company_id))
            {
                $pollSodPorMarca = $pollWeb['poll_id'];
            }
        }
        $objPublicityDetail = $this->publicitiesDetailRepo->find($publicityDetail_id);
        $objPublicityDetail->sod =1;
        $objPublicityDetail->photo = $foto;
        $objPublicityDetail->update();$sw=0;
        if (count($sods)>0)
        {
            for($i = 0; $i < count($sods); ++$i) {
                $valores = explode('|', $sods[$i]);
                $objPollDetail = $this->pollDetailRepo->getModel();
                $objPollDetail->poll_id = $pollSodPorMarca;
                $objPollDetail->product_id = $valores[0];
                $objPollDetail->comentario = $valores[1];
                $objPollDetail->store_id = $objPublicityDetail->store_id;
                $objPollDetail->created_at = $objPublicityDetail->created_at;
                $objPollDetail->auditor = $objPublicityDetail->user_id;
                $objPollDetail->coment = 1;
                $objPollDetail->publicity_id = $publicity_id;
                $objPollDetail->company_id = $company_id;
                $objPollDetail->save();
            }

        }else{
            $sw=1;
        }


        if ($ajax=="1")
        {
            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');
            if ($sw==1)
            {
                return  Response::json([ 'success'=> 0]);
            }else{

                return  Response::json([ 'success'=> 1]);
            }

        }else{

        }

    }

    public function getRoadDetails($company_id,$store_id)
    {
        $objRoadDetail = $this->roadDetailRepo->getModel();
        $objRoadDetails = $objRoadDetail->where('company_id',$company_id)->where('store_id',$store_id)->get();//dd($objRoadDetails);
        $modulo='listarRoaddetails';
        return View::make('operations/operationsRoads',compact('modulo','objRoadDetails'));
    }

    public function releasePointsInBlocks($ajax="1",$arrayStores_id="0",$company_id="0",$visits="0",$returnMap="0")
    {
        if ($ajax=="1"){
            $valoresPost= Input::all();
            $arrayStores_id = $valoresPost['arrayStores_id'];
            $company_id = $valoresPost['company_id'];
            $ajax=$valoresPost['ajax'];
            $visits=$valoresPost['visits'];
            $returnMap=$valoresPost['returnMap'];
        }
        $stores_ids = explode(",",$arrayStores_id);
        $objCompany = $this->companyRepo->find($company_id);
        if (count($stores_ids)>0)
        {
            foreach ($stores_ids as $stores_id) {
                if ($visits=="0"){
                    $visit_id=0;
                    $store_id=$stores_id;
                }
                $regsPollDetail = $this->pollDetailRepo->getModel();
                $affectedRowsPollDetails = $regsPollDetail->where('store_id',$store_id)->where('company_id',$company_id)->where('visit_id',$visit_id)->delete();
                $arayResultsPollDetails[] = array('store_id'=>$store_id,'affectCount'=>$affectedRowsPollDetails);

                $regsPollOptionDetail = $this->pollOptionDetailRepo->getModel();
                $affectedRowsPollOptionDetails = $regsPollOptionDetail->where('store_id',$store_id)->where('company_id',$company_id)->where('visit_id',$visit_id)->delete();
                $arayResultsPollOptionDetails[] = array('store_id'=>$store_id,'affectCount'=>$affectedRowsPollOptionDetails);

                $regsPublicityDetail = $this->publicitiesDetailRepo->getModel();
                $affectedRowsPublicitiesDetails = $regsPublicityDetail->where('store_id',$store_id)->where('company_id',$company_id)->delete();
                $arayResultsPollPublicitiesDetails[] = array('store_id'=>$store_id,'affectCount'=>$affectedRowsPublicitiesDetails);

                $affectedRowsMedia[] = $this->deletePhoto($store_id,$company_id,"0","0","0");
                $success=1;//dd($store_id,$arayResultsPollDetails,$arayResultsPollOptionDetails,$arayResultsPollPublicitiesDetails,$affectedRowsMedia);
                if ($returnMap=="1"){
                    $regsRoadDetail = $this->roadDetailRepo->getModel();//dd($regsRoadDetail);

                    if ($objCompany->visits==0){
                        $affectedRoadDetails = $regsRoadDetail->where('store_id',$store_id)->where('company_id',$company_id)->delete();
                        //$affectedRoadDetails = $regsRoadDetails->delete();
                        //$affectedRoadDetails=true;
                        $arayRoadDetail[] = array('store_id'=>$store_id,'affectCount'=>$affectedRoadDetails);
                        $regsAuditRoadStore = $this->auditRoadStoreRepo->getModel();
                        if ($visits=="0"){
                            $affectedAuditRoadStores = $regsAuditRoadStore->where('store_id',$store_id)->where('company_id',$company_id)->delete();
                        }else{
                            $affectedAuditRoadStores = $regsAuditRoadStore->where('store_id',$store_id)->where('company_id',$company_id)->where('visit_id',$visit_id)->delete();
                        }

                        $arayAuditRoadStores[] = array('store_id'=>$store_id,'affectCount'=>$affectedAuditRoadStores);

                        $objCompanyStore = $this->companyStoreRepo->getModel();
                        $regCompanyStore = $objCompanyStore->where('store_id',$store_id)->where('company_id',$company_id)->first();
                        $regCompanyStore->ruteado=0;
                        $regCompanyStore->save();
                        $arayCompanyStore[]= array('store_id'=>$store_id,'id'=>$regCompanyStore->id);
                        /*if (count($regCompanyStore)>0){

                        }else{
                            $arayCompanyStore=[];
                        }*/

                    }

                }else{
                    $arayRoadDetail=[];
                    $arayAuditRoadStores=[];
                    $arayCompanyStore=[];
                }
            }
        }else{
            $success=0;
            $arayResultsPollDetails= [];
            $arayResultsPollOptionDetails=[];
            $arayResultsPollPublicitiesDetails=[];
            $affectedRowsMedia=[];
            $arayRoadDetail=[];
            $arayAuditRoadStores=[];
            $arayCompanyStore=[];
        }
        $modulo='liberarPuntosMasa';
        if ($ajax==1){
            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');
            return  Response::json([ 'success'=> $success,'objCompany'=>$objCompany,'arrayStores_id'=>$arrayStores_id,'visits'=>$visits,'returnMap'=>$returnMap,'arayResultsPollDetails' => $arayResultsPollDetails,'arayResultsPollOptionDetails'=>$arayResultsPollOptionDetails,'arayResultsPollPublicitiesDetails'=>$arayResultsPollPublicitiesDetails,'affectedRowsMedia'=>$affectedRowsMedia,'arayRoadDetail'=>$arayRoadDetail,'arayAuditRoadStores'=>$arayAuditRoadStores,'arayCompanyStore'=>$arayCompanyStore]);
        }
        if ($ajax==0){
            return View::make('operations/operationsFull',compact('modulo','objCompany','arrayStores_id','visits','returnMap','arayResultsPollDetails','arayResultsPollOptionDetails','arayResultsPollPublicitiesDetails','affectedRowsMedia','arayRoadDetail','arayAuditRoadStores','arayCompanyStore'));
        }

    }

    /*public function verifyBasebayerTransCVS($archivo,$company_id)
    {
        $file_name=$archivo;
        $row = 0;$v="";
        $mytime = Carbon\Carbon::now();
        $horaSistema = $mytime->toDateTimeString();
        $fp = fopen ( 'media/archivos/'.$file_name , "r" );
        $ciudades[0] = 'LIMA';
        $ciudades[1] = 'Tacna';
        $ciudades[2] = 'Huancayo';
        $ciudades[3] = 'Cusco';
        $ciudades[4] = 'Arequipa';
        $ciudades[5] = 'Chimbote';
        $ciudades[6] = 'Trujillo';
        $ciudades[7] = 'Chiclayo';
        $ciudades[8] = 'Piura';
        while ($data = fgetcsv ($fp, 1000, ",")){
            $num = count ($data);
            $row++;$c=0;$col=1;
            if ($row<>1){//'Mini Market','Bodega Clásica','Bodega Alto Tráfico'
                for ($i = 0; $i <= 8; $i++) {
                    $c++;
                    $col=$i + 1;
                    //if ($i==3){echo '$i='.$i.' $c='.$c.' $col='.$col ;dd($data);}
                    if ($data[$c] == 2){
                        $tipo_bodega ='Mini Market';
                        $addReg = $this->ProductStoreRegionRepo->getModel();
                        $addReg->product_id = $data[0];
                        $addReg->region = $ciudades[$i];
                        $addReg->tipo_bodega = $tipo_bodega;
                        $addReg->company_id = $company_id;
                        $addReg->price = $data[$col*4];
                        $addReg->created_at = $horaSistema;
                        $addReg->updated_at = $horaSistema;
                        $addReg->save();
                        //$v .='$c='.$c." ".'$col='.$col." ".$data[0]." ".$ciudades[$i]." ".$tipo_bodega." ".$company_id." ".$data[$col*4]." ".$horaSistema." ".$horaSistema. "<br>";
                    }  else{}
                    $c++;
                    if ($data[$c] == 2){
                        $tipo_bodega ='Bodega Clásica';
                        $addReg = $this->ProductStoreRegionRepo->getModel();
                        $addReg->product_id = $data[0];
                        $addReg->region = $ciudades[$i];
                        $addReg->tipo_bodega = $tipo_bodega;
                        $addReg->company_id = $company_id;
                        $addReg->price = $data[$col*4];
                        $addReg->created_at = $horaSistema;
                        $addReg->updated_at = $horaSistema;
                        $addReg->save();
                        //$v .='$c='.$c." ".'$col='.$col." ".$data[0]." ".$ciudades[$i]." ".$tipo_bodega." ".$company_id." ".$data[$col*4]." ".$horaSistema." ".$horaSistema. "<br>";
                    }  else{}
                    $c++;
                    if ($data[$c] == 2){
                        $tipo_bodega ='Bodega Alto Tráfico';
                        $addReg = $this->ProductStoreRegionRepo->getModel();
                        $addReg->product_id = $data[0];
                        $addReg->region = $ciudades[$i];
                        $addReg->tipo_bodega = $tipo_bodega;
                        $addReg->company_id = $company_id;
                        $addReg->price = $data[$col*4];
                        $addReg->created_at = $horaSistema;
                        $addReg->updated_at = $horaSistema;
                        $addReg->save();
                        //$v .='$c='.$c." ".'$col='.$col." ".$data[0]." ".$ciudades[$i]." ".$tipo_bodega." ".$company_id." ".$data[$col*4]." ".$horaSistema." ".$horaSistema. "<br>";
                    }  else{}
                    $c++;

                }//print_r($v);dd($v);
            }

        }
        dd('ok');
    }*/
} 