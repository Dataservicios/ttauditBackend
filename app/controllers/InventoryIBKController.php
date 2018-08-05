<?php

use Auditor\Repositories\PollRepo;
use Auditor\Repositories\CompanyAuditRepo;
use Auditor\Repositories\PollOptionRepo;
use Auditor\Repositories\PollOptionDetailRepo;
use Auditor\Repositories\PollDetailRepo;
use Auditor\Repositories\AuditRepo;
use Auditor\Repositories\RoadDetailRepo;
use Auditor\Repositories\CompanyRepo;
use Auditor\Repositories\CustomerRepo;
use Auditor\Repositories\StoreRepo;
use Auditor\Repositories\CategoryProductRepo;
use Auditor\Repositories\MediaRepo;


class InventoryIBKController extends BaseController {

    protected $pollRepo;
    protected $CompanyAuditRepo;
    protected $pollOptionRepo;
    protected $pollOptionDetailRepo;
    protected $pollDetailRepo;
    protected $auditRepo;
    protected $roadDetailRepo;
    protected $companyRepo;
    protected $customerRepo;
    protected $storeRepo;
    protected $categoryProductRepo;
    protected $MediaRepo;

    public $urlBase;
    public $urlImagesProducts;
    public $urlImages;
    public $urlImageBase;

    public function __construct(MediaRepo $MediaRepo,CategoryProductRepo $categoryProductRepo,StoreRepo $storeRepo,CustomerRepo $customerRepo,CompanyRepo $companyRepo,RoadDetailRepo $roadDetailRepo,AuditRepo $auditRepo,PollDetailRepo $pollDetailRepo, PollRepo $pollRepo, CompanyAuditRepo $CompanyAuditRepo, PollOptionRepo $pollOptionRepo, PollOptionDetailRepo $pollOptionDetailRepo)
    {
        $this->pollRepo = $pollRepo;
        $this->CompanyAuditRepo = $CompanyAuditRepo;
        $this->pollOptionRepo = $pollOptionRepo;
        $this->pollOptionDetailRepo = $pollOptionDetailRepo;
        $this->pollDetailRepo = $pollDetailRepo;
        $this->auditRepo = $auditRepo;
        $this->roadDetailRepo = $roadDetailRepo;
        $this->companyRepo = $companyRepo;
        $this->customerRepo = $customerRepo;
        $this->storeRepo = $storeRepo;
        $this->categoryProductRepo = $categoryProductRepo;
        $this->MediaRepo = $MediaRepo;

        $this->urlBase = \App::make('url')->to('/');
        $this->urlImages = '/media/fotos/';
        $this->urlImageBase = '/media/images/';
        $this->urlImagesProducts = '/media/images/bayer/products/';
    }

    public function getDetailMediasPublic($company_id="0",$audit_id="0",$category_product_id="0",$store_id="0",$poll_id="0")
    {
        $objCategory = $this->categoryProductRepo->find($category_product_id);
        $titulo = "Detalle Fotos ".$objCategory->fullname;
        $detailAudit = $this->auditRepo->find($audit_id);//dd($detailAudit);
        $objRoadDetail = $this->roadDetailRepo->getRoadForStoreCompany($store_id,$company_id);//dd($objRoadDetail[0]);
        $campaigne = $this->companyRepo->find($company_id);//dd($campaigne);
        $customer =$this->customerRepo->find($campaigne->customer_id);//dd($customer);
        $objStore = $this->storeRepo->find($store_id);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $url_image = $this->urlBase.$this->urlImages;
        $photos = $this->getPhotos($poll_id,$store_id,$company_id,"0","0",$category_product_id);//dd($photos);
        return View::make('medias/detailPhotosPublicIbk', compact('photos','url_image','objRoadDetail','objStore','campaigne','customer','titulo','logo','detailAudit'));
    }

    public function getCategoryProducts(){
        $regsCategoryProducts = $this->categoryProductRepo->getCatMaterialsForCustomer(1,0,139);

        header('Access-Control-Allow-Origin: *');
        return Response::json([ 'success'=> 1, 'categories' => $regsCategoryProducts]);

    }

    public function getPhotosInventory($company_id="0",$store_id_post="0")
    {
        if ($company_id=="0"){
            $valoresPost= Input::all();
            $company_id = $valoresPost['company_id'];
            $store_id_post = $valoresPost['store_id'];
        }
        //temporalmente hasta crear nueva pasarella
        $customer =$this->customerRepo->find(1);//dd($customer);
        $logo = $this->urlBase.$this->urlImageBase.$customer->corto.'/'.$customer->logo;
        $obj_company_id = $this->companyRepo->getFirstCurrentCampaigns(1);
        $company_id_base = $obj_company_id->id;
        //fin temporal
        $menus = $this->generateMenusInterbank($company_id_base,-1);
        $titulo = "Inventarios IBK";
        if ($store_id_post<>"0"){

            $objStore = $this->storeRepo->getStoreForCompanyCod($company_id,$store_id_post);
            if (count($objStore)>0){
                $store_id = $objStore->id;//dd($store_id,$objStore->codclient);
                $polls = $this->pollRepo->getQuestionForWeb($company_id);//dd($polls);
                foreach ($polls as $poll) {
                    $photos = $this->MediaRepo->photosProductPollStore($poll->id,$store_id,$company_id);//if (count($photos)>0)//dd($photos);
                    if(! empty($photos)){
                        //dd($photos);
                        //dd(\App::make('url')->to('/'));
                        foreach ($photos as $photo){
                            $datosFotos[] = array('id' => $photo->id,'poll_id' => $poll->id,'archivo' => $photo->archivo, 'urlFoto' => $this->urlBase.$this->urlImages.$photo->archivo,'category_product_id' => $photo->category_product_id);
                        }
                    }else{
                        $datosFotos = [];
                    }
                    if ($poll->categoryProduct==1){
                        $objCategoryProduct = $this->categoryProductRepo->getModel();
                        $categoriesProducts = $objCategoryProduct->where('idpadre',82)->orderBy('orden','ASC')->get();
                    }else{
                        $categoriesProducts=[];
                    }
                }
                $msj="";
            }else{
                $polls=[];$datosFotos = [];$categoriesProducts=[];$msj = "No existe Registros";
            }
        }else{
            $polls=[];$datosFotos = [];$categoriesProducts=[];$msj="";
        }


        return View::make('report/interbank/inventarios',compact('msj','objStore','categoriesProducts','datosFotos','polls','menus','logo','titulo'));
    }

} 