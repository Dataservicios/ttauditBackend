<?php

use Auditor\Repositories\ReservationServiceDetailRepo;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Auditor\Repositories\PollDetailRepo;
use Auditor\Repositories\PollOptionRepo;
use Auditor\Repositories\PollOptionDetailRepo;
use Auditor\Repositories\PollRepo;
use Auditor\Repositories\UserRepo;
use Auditor\Repositories\CompanyRepo;
use Auditor\Repositories\CustomerRepo;
use Auditor\Repositories\StoreRepo;
use Auditor\Repositories\PublicityRepo;
use Auditor\Repositories\AttributeDetailRepo;
use Auditor\Repositories\MediaRepo;
use Auditor\Repositories\AlertRepo;
use Auditor\Repositories\ReservationRepo;
use Auditor\Repositories\ReservationStatuRepo;

class PollDetailController extends BaseController {
	protected $PollDetailRepo;
	protected $PollOptionRepo;
	protected $PollOptionDetailRepo;
	protected $PollRepo;
	protected $UserRepo;
	protected $campaigneRepo;
	protected $customerRepo;
	protected $StoreRepo;
	protected $publicityRepo;
	protected $attributeDetailRepo;
	protected $mediaRepo;
	protected $alertRepo;
    protected $reservationRepo;
    protected $reservationStatuRepo;
    protected $reservationServiceDetailRepo;

	public function __construct(ReservationServiceDetailRepo $reservationServiceDetailRepo, ReservationStatuRepo $reservationStatuRepo, ReservationRepo $reservationRepo, AlertRepo $alertRepo, MediaRepo $mediaRepo, AttributeDetailRepo $attributeDetailRepo, PublicityRepo $publicityRepo, StoreRepo $StoreRepo, CustomerRepo $customerRepo, CompanyRepo $campaigneRepo, UserRepo $UserRepo, PollRepo $PollRepo, PollOptionDetailRepo $PollOptionDetailRepo, PollOptionRepo $PollOptionRepo, PollDetailRepo $PollDetailRepo)
	{
		$this->PollDetailRepo = $PollDetailRepo;
		$this->PollOptionRepo = $PollOptionRepo;
		$this->PollOptionDetailRepo = $PollOptionDetailRepo;
		$this->PollRepo = $PollRepo;
		$this->UserRepo = $UserRepo;
		$this->campaigneRepo = $campaigneRepo;
		$this->customerRepo = $customerRepo;
		$this->StoreRepo = $StoreRepo;
		$this->publicityRepo = $publicityRepo;
		$this->attributeDetailRepo = $attributeDetailRepo;
		$this->mediaRepo = $mediaRepo;
		$this->alertRepo = $alertRepo;
        $this->reservationRepo = $reservationRepo;
        $this->reservationStatuRepo = $reservationStatuRepo;
        $this->reservationServiceDetailRepo = $reservationServiceDetailRepo;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$objPollDetail = $this->PollDetailRepo->getModel();
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
		$selectedOptions = $valoresPost['selectedOptions'];
		$selectedOptionsComment = $valoresPost['selectedOptionsComment'];
		$priority = $valoresPost['priority'];
		$mytime = Carbon::now();
		$horaSistema = $mytime->toDateTimeString();

		$objPollDetail->poll_id = $poll_id;//dd($objPollDetail->poll_id);
		$objPollDetail->store_id = $store_id;
		$objPollDetail->product_id = $product_id;
		$objPollDetail->publicity_id = $publicity_id;
		$objPollDetail->company_id = $company_id;
		$valor = $this->PollDetailRepo->searchPollDetail($objPollDetail);//dd($objPollDetail);
		$objPoll=$this->PollRepo->find($poll_id);
		$objAuditor = $this->UserRepo->find($auditor);
		$datoAuditor = $objAuditor->fullname."(".$auditor.")";
		$campaigneDetail = $this->campaigneRepo->find($company_id);//dd($campaigneDetail);
		$customer =$this->customerRepo->find($campaigneDetail->customer_id);
		$cliente = $customer->corto;
		$textoContent = $campaigneDetail->fullname."".$objPoll->question." - Id= ".$store_id;
		$objStore = $this->StoreRepo->find($store_id);
		$tipo_bodega = $objStore->tipo_bodega;
		$agente = $objStore->fullname;
		$dir = $objStore->codclient;
		$address = $objStore->address;
		$district = $objStore->district." - ".$objStore->region." - ".$objStore->ubigeo;
		$foto = "";
		$fono = $objStore->telephone."/".$objStore->cell;
		$fechaHoraEnvio = $horaSistema;

		if ($cliente=='interbank'){
			$textoContent = $campaigneDetail->fullname." ".substr($objPoll->question,0,10)."... - DIR: ".$dir." StoreId: ".$store_id;
		}

		if ($cliente=='alicorp'){
			$textoContent = $campaigneDetail->fullname." ".substr($objPoll->question,0,10)."... - StoreId: ".$store_id;
		}

		if ($cliente=='bayer'){
			$textoContent = $campaigneDetail->fullname." ".substr($objPoll->question,0,10)."... - CADENA: ".$objStore->cadenaRuc." StoreId: ".$store_id;
		}
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

			//send emails
			if ($result == 0){
				$motivo = $objPoll->question."(Id question: ".$objPoll->id.")".' Resp. NO('.$idPollDetail.')';
			}else{
				$motivo = $objPoll->question."(Id question: ".$objPoll->id.")".' Resp SI('.$idPollDetail.')';
			}
			$questions = $this->getQuestionsSendEmail();
			foreach ($questions as $question)
			{
				if (($question['company_id']==$company_id) and ($question['poll_id']==$poll_id) and ($question['send']==1))
				{
					if ($result == $question['result'])
					{
						$gruposEmails = $this->getGroupsEmails();
						$mascaras = explode('|',$question['mask']);
						for($i=0;$i<count($mascaras);$i++) {
							$emails = $gruposEmails[$mascaras[$i]];//dd($emails);
							$this->sendEmails($store_id,$textoContent,$motivo,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails);
						}
						//sendEmails($store_id,$textoContent,$motivo,$auditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails)
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
		$objPollDetailSearch = $this->PollDetailRepo->getModel();
		$ObjSearchPollDetail = $objPollDetailSearch::find($idPollDetail);//dd($selectedOptions);
		if ($ObjSearchPollDetail->options==1)
		{
			$opciones = explode('|',$selectedOptions);$c=0;
			$comentOpcion = explode('|',$selectedOptionsComment);//dd($comentOpcion);
			if ($opciones[0]<>'')
			{
				foreach ($opciones as $valor) {
					if ($valor<>''){
						$consulta1 = $this->PollOptionRepo->getOptionsForPollCodigo($ObjSearchPollDetail->poll_id,$valor);//dd($consulta1);
						if (count($consulta1)>0){
							$objPollOptionDetail = $this->PollOptionDetailRepo->getModel();
							$objPollOptionDetail->poll_option_id=$consulta1[0]->id;
							$objPollOptionDetail->store_id=$store_id;
							$objPollOptionDetail->product_id=$product_id;
							$objPollOptionDetail->company_id=$company_id;
							$objPollOptionDetail->publicity_id=$publicity_id;
							$valorOption = $this->PollOptionDetailRepo->searchPollOptionDetail($objPollOptionDetail);
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
								$motivo = $objPoll->question." opcion: ".$consulta1[0]->options.' ('.$idPollOptionDetail.')';
								$questions = $this->getQuestionsSendEmail();
								foreach ($questions as $question)
								{
									if (($question['company_id']==$company_id) and ($question['poll_id']==$poll_id) and ($question['poll_option_id']==$consulta1[0]->id))
									{
										$gruposEmails = $this->getGroupsEmails();
										$mascaras = explode('|',$question['mask']);
										for($i=0;$i<count($mascaras);$i++) {
											$emails = $gruposEmails[$mascaras[$i]];//dd($emails);
											$this->sendEmails($store_id,$textoContent,$motivo,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails,$fono);
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

		return Response::json([ 'success'=> 1, 'last_poll_detail_id' => $idPollDetail]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


    /**
     *
     * @return jason if de poll_detail grabado
     * @comment deprecated
     */
    public function saveRegisters()
	{
		$objPollDetail = $this->PollDetailRepo->getModel();
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
		$mytime = Carbon::now();
		$horaSistema = $mytime->toDateTimeString();
        $urlBase = App::make('url')->to('/');
        $urlImages = '/media/fotos/';

		$objPollDetail->poll_id = $poll_id;//dd($objPollDetail->poll_id);
		$objPollDetail->store_id = $store_id;
		$objPollDetail->product_id = $product_id;
		$objPollDetail->publicity_id = $publicity_id;
		$objPollDetail->company_id = $company_id;
		$objPollDetail->category_product_id = $category_product_id;

		$objPoll=$this->PollRepo->find($poll_id);
		$objAuditor = $this->UserRepo->find($auditor);
		$datoAuditor = $objAuditor->fullname."(".$auditor.")";
		$campaigneDetail = $this->campaigneRepo->find($company_id);//dd($campaigneDetail);
		$customer =$this->customerRepo->find($campaigneDetail->customer_id);
		$cliente = $customer->corto;
		if (($campaigneDetail->study_id==36) or ($campaigneDetail->study_id==22) or ($campaigneDetail->study_id==23) or ($campaigneDetail->study_id==24) or ($campaigneDetail->study_id==25) or ($campaigneDetail->study_id==28) or ($campaigneDetail->study_id==29) or ($campaigneDetail->study_id==32))
        {
            $valor=[];
        }else{
            $valor = $this->PollDetailRepo->searchPollDetail($objPollDetail,1);
        }

		$objStore = $this->StoreRepo->find($store_id);
		$tipo_bodega = $objStore->tipo_bodega;
		$agente = $objStore->fullname;
		$dir = $objStore->codclient;
		$address = $objStore->address;
		$fono = $objStore->telephone."/".$objStore->cell;
		$district = $objStore->district." - ".$objStore->region." - ".$objStore->ubigeo;
        if ($campaigneDetail->customer_id==1)
        {
            $objMediaRepo=$this->mediaRepo->getModel();
            $objMedia= $objMediaRepo->where('store_id',$store_id)->where('company_id',$company_id)->where('poll_id',$poll_id)->where('tipo',1)->get();
            if (count($objMedia)>0)
            {
                $foto = $urlBase.$urlImages.$objMedia[0]->archivo;
            }else{
                $foto = "";
            }
        }else{
            $foto = "";
        }
		$nomPublicity="";
		$fechaHoraEnvio = $horaSistema;

        if ($campaigneDetail->customer_id==1)
        {
            $textoContent = "ALERTA: ".$campaigneDetail->fullname." ".$objPoll->questionr." - Dir: ".$dir;
            $textoContentDEV = "ALERTA: ".$campaigneDetail->fullname." (".$campaigneDetail->id.") ".$objPoll->questionr." (".$objPoll->id.") - store_id: ".$store_id;
        }else{
            $textoContent = $campaigneDetail->fullname."".$objPoll->question." - Id= ".$store_id;
            $textoContentDEV = $campaigneDetail->fullname." (".$campaigneDetail->id.") ".$objPoll->question." (".$objPoll->id.") - store_id= ".$store_id;
        }

		/*if ($cliente=='interbank'){
			$textoContent = $campaigneDetail->fullname." ".substr($objPoll->question,0,10)."... - DIR: ".$dir." StoreId: ".$store_id;
		}*/

		if ($cliente=='alicorp'){
			if ($publicity_id<>"0")
			{
				$objPublicity = $this->publicityRepo->find($publicity_id);
				$nomPublicity = $objPublicity->fullname;
			}
			$textoContent = $campaigneDetail->fullname." ".substr($objPoll->question,0,10)."... - StoreId: ".$store_id;
            $textoContentDEV = $campaigneDetail->fullname."(".$campaigneDetail->id.") ".substr($objPoll->question,0,10)." (".$objPoll->id.") - Id= ".$store_id;
		}

		if ($cliente=='bayer'){
			$textoContent = $campaigneDetail->fullname." ".substr($objPoll->question,0,10)."... - CADENA: ".$objStore->cadenaRuc." StoreId: ".$store_id;
            $textoContentDEV = $campaigneDetail->fullname."(".$campaigneDetail->id.") ".substr($objPoll->question,0,10)." (".$objPoll->id.") - Id= ".$store_id;
		}

		if ($limits==1)
        {
            $opciones = explode('|',$selectedOptions);
            $nro_opciones = count($opciones);
            $objAttributeDetail = $this->attributeDetailRepo->getModel();
            $attributeDetailsValues = $objAttributeDetail->where('company_id',$company_id)->where('poll_orden',$objPoll->orden)->get();
            foreach ($attributeDetailsValues as $attributeDetailsValue) {
                if ($attributeDetailsValue->quantity1==0)
                {
                    if ($nro_opciones>=$attributeDetailsValue->quantity)
                    {
                        $obj_attribute = $attributeDetailsValue->attribute;
                    }
                }else{
                    if (($nro_opciones>=$attributeDetailsValue->quantity) and ($nro_opciones<=$attributeDetailsValue->quantity1))
                    {
                        $obj_attribute = $attributeDetailsValue->attribute;
                    }
                }
            }
            $limite = $obj_attribute->fullname;
        }
        if (($campaigneDetail->customer_id==1) and ($campaigneDetail->study_id==4)) {
            $objEjecutivo = $this->UserRepo->getModel();
            $obEjecBuscado=$objEjecutivo->where('email', $objStore->ejecutivo)->first();
            if (count($obEjecBuscado)>0){
                $ejecutivoID = $obEjecBuscado->id;
            }else{
                $ejecutivoID = 0;
            }

        }else{
            $ejecutivoID=0;
        }

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

			//send emails
			if ($result == 0){
                if ($campaigneDetail->customer_id==1)
                {
                    $motivo = $objPoll->questionr;
                    $motivoDEV = $objPoll->questionr." (Id question: ".$objPoll->id.")".' Resp. NO('.$idPollDetail.')';
                }else{
                    $motivo = $objPoll->question.' Resp. NO';
                    $motivoDEV = $objPoll->question." (Id question: ".$objPoll->id.")".' Resp. NO('.$idPollDetail.')';
                }

			}else{
                if ($campaigneDetail->customer_id==1)
                {
                    $motivo = $objPoll->questionr;
                    $motivoDEV = $objPoll->questionr." (Id question: ".$objPoll->id.")".' Resp. SI('.$idPollDetail.')';
                }else{
                    $motivo = $objPoll->question.' Resp SI';
                    $motivoDEV = $objPoll->question." (Id question: ".$objPoll->id.")".' Resp SI('.$idPollDetail.')';
                }
			}
			if ($nomPublicity<>""){
				$motivo .=" Publicidad: ".$nomPublicity;
			}
			$questions = $this->getQuestionsSendEmail();
			foreach ($questions as $question)
			{
				if (($question['company_id']==$company_id) and ($question['poll_id']==$poll_id) and ($question['send']==1))
				{
					if ($result == $question['result'])
					{
						$gruposEmails = $this->getGroupsEmails();
						$mascaras = explode('|',$question['mask']);//dd($mascaras);
                        $acum_emails ="";
						for($i=0;$i<count($mascaras);$i++) {
							$emails = $gruposEmails[$mascaras[$i]];
                            if ($campaigneDetail->customer_id==1)
                            {
                                if ($objPoll->orden == 23){
									
								}else{
									$emails['email'] = $emails['email'] . "|".$objStore->ejecutivo.":".$objStore->nomb_ejecutivo. "|".$objStore->coordinador.":Coodinador";
								}
                            }
                            if ($question['mask']=='sistemas')
                            {
                                $this->sendEmails($store_id,$textoContentDEV,$motivoDEV,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails);
                            }else{
                                if ($campaigneDetail->customer_id==1){
                                    if ($objPoll->orden == 23){
                                        if ($question['mask']<>'IBK'){
                                            $this->sendEmails($store_id,$textoContent,$motivo,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails);
                                            $acum_emails = $acum_emails . "-" . $emails['email'];
                                        }
                                    }else{
                                        $this->sendEmails($store_id,$textoContent,$motivo,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails);
                                        $acum_emails = $acum_emails . "-" . $emails['email'];
                                    }
                                }else{
                                    $this->sendEmails($store_id,$textoContent,$motivo,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails);
                                    $acum_emails = $acum_emails . "-" . $emails['email'];
                                }
                            }

						}
                        if (($campaigneDetail->customer_id==1) and ($objPoll->orden == 23)){

                        }else{
                            $objAlertRepo = $this->alertRepo->getModel();
                            $objAlertRepo->store_id=$objStore->id;
                            $objAlertRepo->user_id=$objAuditor->id;
                            $objAlertRepo->ejecutivo_id=$ejecutivoID;
                            $objAlertRepo->titulo=$textoContentDEV;
                            $objAlertRepo->motivo=$motivoDEV;
                            $objAlertRepo->company_id=$company_id;
                            $objAlertRepo->customer_id=$campaigneDetail->customer_id;
                            $objAlertRepo->emails=$acum_emails;
                            $objAlertRepo->send=1;
                            $objAlertRepo->poll_id=$poll_id;
                            $objAlertRepo->save();
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
		$objPollDetailSearch = $this->PollDetailRepo->getModel();
		$ObjSearchPollDetail = $objPollDetailSearch::find($idPollDetail);//dd($ObjSearchPollDetail);
		if ($ObjSearchPollDetail->options==1)
		{
			$opciones = explode('|',$selectedOptions);$c=0;
			$comentOpcion = explode('|',$selectedOptionsComment);
			if ($opciones[0]<>'')
			{
				foreach ($opciones as $valor) {
					if ($valor<>''){
						$consulta1 = $this->PollOptionRepo->getOptionsForPollCodigo($ObjSearchPollDetail->poll_id,$valor);
						if (count($consulta1)>0){
							$objPollOptionDetail = $this->PollOptionDetailRepo->getModel();
							$objPollOptionDetail->poll_option_id=$consulta1[0]->id;
							$objPollOptionDetail->store_id=$store_id;
							$objPollOptionDetail->product_id=$product_id;
							$objPollOptionDetail->company_id=$company_id;
							$objPollOptionDetail->publicity_id=$publicity_id;
                            $objPollOptionDetail->category_product_id=$category_product_id;
							$objPollOptionDetail->poll_id=$poll_id;
							$sw=0;
							if (($campaigneDetail->study_id==36) or ($campaigneDetail->study_id==22) or ($campaigneDetail->study_id==23) or ($campaigneDetail->study_id==24)  or ($campaigneDetail->study_id==25) or ($campaigneDetail->study_id==28) or ($campaigneDetail->study_id==29) or ($campaigneDetail->study_id==32))
							{
								if ($campaigneDetail->study_id==24)
								{
									$valorOption = $this->PollOptionDetailRepo->searchPollOptionDetail($objPollOptionDetail,2);
									if (count($valorOption)==0){
										$sw = 1;
									}else{
										$sw = 0;
									}
								}else{
									$sw = 1;
								}
							}else{
								$valorOption = $this->PollOptionDetailRepo->searchPollOptionDetail($objPollOptionDetail);
								if (count($valorOption)==0){
									$sw = 1;
								}else{
									$sw = 0;
								}
							}
				
							
							if ($sw==1){
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
                                if ($campaigneDetail->customer_id==1)
                                {
                                    $motivo = $consulta1[0]->options;
                                    $motivoDEV = $consulta1[0]->options."(Id question: ".$objPoll->id.")".' opcion('.$consulta1[0]->id.')'.' ('.$idPollOptionDetail.')';
                                }else{
                                    $motivo = $objPoll->question." opcion: ".$consulta1[0]->options;
                                    $motivoDEV = $objPoll->question." (Id question: ".$objPoll->id.")"." (IdResp.: ".$idPollDetail.") opcion: ".$consulta1[0]->options.' ('.$idPollOptionDetail.')';
                                }
                                //$salida =[];
								//$questions = $this->getQuestionsSendEmail();
								foreach ($questions as $question)
								{
									if (($question['company_id']==$company_id) and ($question['poll_id']==$poll_id) and ($question['poll_option_id']==$consulta1[0]->id))
									{
                                        //$salida[] = array('obj_question'=>$question,'company_id'=>$company_id,'poll_id'=>$poll_id,'consulta'=>$consulta1[0]->id,'question'=>$question['poll_option_id']);
										$gruposEmails = $this->getGroupsEmails();
										$mascaras = explode('|',$question['mask']);
                                        $acum_emails ="";
										for($i=0;$i<count($mascaras);$i++) {
											$emails = $gruposEmails[$mascaras[$i]];
											//dd($store_id,$textoContentDEV,$motivoDEV,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails,$fono);
                                            if ($campaigneDetail->customer_id==1)
                                            {
                                                $emails['email'] = $emails['email'] . "|".$objStore->ejecutivo.":".$objStore->nomb_ejecutivo. "|".$objStore->coordinador.":Coodinador";
                                            }
											if ($question['mask']=='sistemas')
                                            {
                                                $this->sendEmails($store_id,$textoContentDEV,$motivoDEV,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails,$fono);
                                                $acum_emails = $acum_emails . "-" . $emails['email'];
                                            }else{
                                                $this->sendEmails($store_id,$textoContent,$motivo,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails,$fono);
                                                $acum_emails = $acum_emails . "-" . $emails['email'];
                                            }
										}
                                        if (($campaigneDetail->customer_id==1) and ($objPoll->orden == 23)){

                                        }else{
                                            $objAlertRepo = $this->alertRepo->getModel();
                                            $objAlertRepo->store_id=$objStore->id;
                                            $objAlertRepo->user_id=$objAuditor->id;
                                            $objAlertRepo->ejecutivo_id=$ejecutivoID;
                                            $objAlertRepo->titulo=$textoContentDEV;
                                            $objAlertRepo->motivo=$motivoDEV;
                                            $objAlertRepo->company_id=$company_id;
                                            $objAlertRepo->customer_id=$campaigneDetail->customer_id;
                                            $objAlertRepo->emails=$acum_emails;
                                            $objAlertRepo->send=1;
                                            $objAlertRepo->poll_id=$poll_id;
                                            $objAlertRepo->save();
                                        }

									}
								}
								//dd($salida);

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

		return Response::json([ 'success'=> 1, 'last_poll_detail_id' => $idPollDetail]);
	}


    /**
     *
     * @return jason if de poll_detail grabado
     * @comment deprecated
     */
    public function savePollsNew()
    {
        $objPollDetail = $this->PollDetailRepo->getModel();
        //$objPollDetail->poll_id = 34;
        $valoresPost= Input::all();//dd($valoresPost);
        if (isset($valoresPost['response_number_id']))
        {
            $objPollDetail->response_number_id= $valoresPost['response_number_id'];
        }
        $poll_id = $valoresPost['poll_id'];
        $store_id= $valoresPost['store_id'];
        $sino= $valoresPost['sino'];
        $options= $valoresPost['options'];
        $limits= $valoresPost['limits'];
        $media= $valoresPost['media'];
        $coment= $valoresPost['coment'];
        $result= $valoresPost['result'];
        $road_id= $valoresPost['road_id'];
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
        $mytime = Carbon::now();
        $horaSistema = $mytime->toDateTimeString();
        $urlBase = App::make('url')->to('/');
        $urlImages = '/media/fotos/';

        $objPollDetail->poll_id = $poll_id;//dd($objPollDetail->poll_id);
        $objPollDetail->store_id = $store_id;
        $objPollDetail->product_id = $product_id;
        $objPollDetail->publicity_id = $publicity_id;
        $objPollDetail->company_id = $company_id;
        $objPollDetail->category_product_id = $category_product_id;

        $objPoll=$this->PollRepo->find($poll_id);
        $objAuditor = $this->UserRepo->find($auditor);
        $datoAuditor = $objAuditor->fullname."(".$auditor.")";
        $campaigneDetail = $this->campaigneRepo->find($company_id);//dd($campaigneDetail);
        $customer =$this->customerRepo->find($campaigneDetail->customer_id);
        $cliente = $customer->corto;
        if ($campaigneDetail->customer_id==18)
        {
            $objPollDetail->road_id = $road_id;
            $valor=[];
        }else{
            $valor = $this->PollDetailRepo->searchPollDetail($objPollDetail,1);
        }

        $objStore = $this->StoreRepo->find($store_id);
        $tipo_bodega = $objStore->tipo_bodega;
        $agente = $objStore->fullname;
        $dir = $objStore->codclient;
        $address = $objStore->address;
        $fono = $objStore->telephone."/".$objStore->cell;
        $district = $objStore->district." - ".$objStore->region." - ".$objStore->ubigeo;
        if ($campaigneDetail->customer_id==1)
        {
            $objMediaRepo=$this->mediaRepo->getModel();
            $objMedia= $objMediaRepo->where('store_id',$store_id)->where('company_id',$company_id)->where('poll_id',$poll_id)->where('tipo',1)->get();
            if (count($objMedia)>0)
            {
                $foto = $urlBase.$urlImages.$objMedia[0]->archivo;
            }else{
                $foto = "";
            }
        }else{
            $foto = "";
        }
        $nomPublicity="";
        $fechaHoraEnvio = $horaSistema;

        if ($campaigneDetail->customer_id==1)
        {
            $textoContent = "ALERTA: ".$campaigneDetail->fullname." ".$objPoll->questionr." - Dir: ".$dir;
            $textoContentDEV = "ALERTA: ".$campaigneDetail->fullname." (".$campaigneDetail->id.") ".$objPoll->questionr." (".$objPoll->id.") - store_id: ".$store_id;
        }else{
            $textoContent = $campaigneDetail->fullname."".$objPoll->question." - Id= ".$store_id;
            $textoContentDEV = $campaigneDetail->fullname." (".$campaigneDetail->id.") ".$objPoll->question." (".$objPoll->id.") - store_id= ".$store_id;
        }

        /*if ($cliente=='interbank'){
            $textoContent = $campaigneDetail->fullname." ".substr($objPoll->question,0,10)."... - DIR: ".$dir." StoreId: ".$store_id;
        }*/

        if ($cliente=='alicorp'){
            if ($publicity_id<>"0")
            {
                $objPublicity = $this->publicityRepo->find($publicity_id);
                $nomPublicity = $objPublicity->fullname;
            }
            $textoContent = $campaigneDetail->fullname." ".substr($objPoll->question,0,10)."... - StoreId: ".$store_id;
            $textoContentDEV = $campaigneDetail->fullname."(".$campaigneDetail->id.") ".substr($objPoll->question,0,10)." (".$objPoll->id.") - Id= ".$store_id;
        }

        if ($cliente=='bayer'){
            $textoContent = $campaigneDetail->fullname." ".substr($objPoll->question,0,10)."... - CADENA: ".$objStore->cadenaRuc." StoreId: ".$store_id;
            $textoContentDEV = $campaigneDetail->fullname."(".$campaigneDetail->id.") ".substr($objPoll->question,0,10)." (".$objPoll->id.") - Id= ".$store_id;
        }

        if ($limits==1)
        {
            $opciones = explode('|',$selectedOptions);
            $nro_opciones = count($opciones);
            $objAttributeDetail = $this->attributeDetailRepo->getModel();
            $attributeDetailsValues = $objAttributeDetail->where('company_id',$company_id)->where('poll_orden',$objPoll->orden)->get();
            foreach ($attributeDetailsValues as $attributeDetailsValue) {
                if ($attributeDetailsValue->quantity1==0)
                {
                    if ($nro_opciones>=$attributeDetailsValue->quantity)
                    {
                        $obj_attribute = $attributeDetailsValue->attribute;
                    }
                }else{
                    if (($nro_opciones>=$attributeDetailsValue->quantity) and ($nro_opciones<=$attributeDetailsValue->quantity1))
                    {
                        $obj_attribute = $attributeDetailsValue->attribute;
                    }
                }
            }
            $limite = $obj_attribute->fullname;
        }
        if (($campaigneDetail->customer_id==1) and ($campaigneDetail->study_id==4)) {
            $objEjecutivo = $this->UserRepo->getModel();
            $obEjecBuscado=$objEjecutivo->where('email', $objStore->ejecutivo)->first();
            if (count($obEjecBuscado)>0){
                $ejecutivoID = $obEjecBuscado->id;
            }else{
                $ejecutivoID = 0;
            }

        }else{
            $ejecutivoID=0;
        }

        if ((count($valor)==0) or (isset($valoresPost['response_number_id']))){
            $objPollDetail->sino = $sino;
            $objPollDetail->options = $options;
            $objPollDetail->limits = $limits;
            $objPollDetail->media = $media;
            $objPollDetail->coment = $coment;
            $objPollDetail->result = $result;
            $objPollDetail->limite = $limite;
            $objPollDetail->comentario = $comentario;
            $objPollDetail->auditor = $auditor;
            if (Input::has('brand_id'))
            {
                $objPollDetail->brand_id = $valoresPost['brand_id'];
            }

            $objPollDetail->save();
            $idPollDetail = $objPollDetail->id;

            //send emails
            if ($result == 0){
                if ($campaigneDetail->customer_id==1)
                {
                    $motivo = $objPoll->questionr;
                    $motivoDEV = $objPoll->questionr." (Id question: ".$objPoll->id.")".' Resp. NO('.$idPollDetail.')';
                }else{
                    $motivo = $objPoll->question.' Resp. NO';
                    $motivoDEV = $objPoll->question." (Id question: ".$objPoll->id.")".' Resp. NO('.$idPollDetail.')';
                }

            }else{
                if ($campaigneDetail->customer_id==1)
                {
                    $motivo = $objPoll->questionr;
                    $motivoDEV = $objPoll->questionr." (Id question: ".$objPoll->id.")".' Resp. SI('.$idPollDetail.')';
                }else{
                    $motivo = $objPoll->question.' Resp SI';
                    $motivoDEV = $objPoll->question." (Id question: ".$objPoll->id.")".' Resp SI('.$idPollDetail.')';
                }
            }
            if ($nomPublicity<>""){
                $motivo .=" Publicidad: ".$nomPublicity;
            }
            $questions = $this->getQuestionsSendEmail();
            foreach ($questions as $question)
            {
                if (($question['company_id']==$company_id) and ($question['poll_id']==$poll_id) and ($question['send']==1))
                {
                    if ($result == $question['result'])
                    {
                        $gruposEmails = $this->getGroupsEmails();
                        $mascaras = explode('|',$question['mask']);//dd($mascaras);
                        $acum_emails ="";
                        for($i=0;$i<count($mascaras);$i++) {
                            $emails = $gruposEmails[$mascaras[$i]];
                            if ($campaigneDetail->customer_id==1)
                            {
                                if ($objPoll->orden == 23){

                                }else{
                                    $emails['email'] = $emails['email'] . "|".$objStore->ejecutivo.":".$objStore->nomb_ejecutivo. "|".$objStore->coordinador.":Coodinador";
                                }
                            }
                            if ($question['mask']=='sistemas')
                            {
                                $this->sendEmails($store_id,$textoContentDEV,$motivoDEV,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails);
                            }else{
                                if ($campaigneDetail->customer_id==1){
                                    if ($objPoll->orden == 23){
                                        if ($question['mask']<>'IBK'){
                                            $this->sendEmails($store_id,$textoContent,$motivo,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails);
                                            $acum_emails = $acum_emails . "-" . $emails['email'];
                                        }
                                    }else{
                                        $this->sendEmails($store_id,$textoContent,$motivo,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails);
                                        $acum_emails = $acum_emails . "-" . $emails['email'];
                                    }
                                }else{
                                    $this->sendEmails($store_id,$textoContent,$motivo,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails);
                                    $acum_emails = $acum_emails . "-" . $emails['email'];
                                }
                            }

                        }
                        if (($campaigneDetail->customer_id==1) and ($objPoll->orden == 23)){

                        }else{
                            $objAlertRepo = $this->alertRepo->getModel();
                            $objAlertRepo->store_id=$objStore->id;
                            $objAlertRepo->user_id=$objAuditor->id;
                            $objAlertRepo->ejecutivo_id=$ejecutivoID;
                            $objAlertRepo->titulo=$textoContentDEV;
                            $objAlertRepo->motivo=$motivoDEV;
                            $objAlertRepo->company_id=$company_id;
                            $objAlertRepo->customer_id=$campaigneDetail->customer_id;
                            $objAlertRepo->emails=$acum_emails;
                            $objAlertRepo->send=1;
                            $objAlertRepo->poll_id=$poll_id;
                            $objAlertRepo->save();
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
            $valor->coment = $objPollDetail->coment;
            $valor->result = $result;
            $valor->limite = $limite;
            $valor->comentario = $comentario;
            $valor->auditor = $auditor;

            $valor->update();
            $idPollDetail = $valor->id;
        }
        $objPollDetailSearch = $this->PollDetailRepo->getModel();
        $ObjSearchPollDetail = $objPollDetailSearch::find($idPollDetail);//dd($ObjSearchPollDetail);

        if ($ObjSearchPollDetail->options==1)
        {
            $opciones = explode('|',$selectedOptions);$c=0;
            $comentOpcion = explode('|',$selectedOptionsComment);
            if ($opciones[0]<>'')
            {
                if (($campaigneDetail->customer_id==18) and ($objPoll->orden == 11) and ($campaigneDetail->study_id == 40))
                {
                    $objReservation = $this->reservationRepo->getModel();
                    $objReservation->store_id=$store_id;
                    $objReservation->company_id=$company_id;
                    $objReservation->statu_id=1;
                    $objReservation->service_id=1;
                    $objReservation->priority='ALTA';
                    $objReservation->comment=$comentario;
                    $objReservation->origin_type=2;
                    $objReservation->user_id=$auditor;
                    $objReservation->save();

                    $obReservationStatu = $this->reservationStatuRepo->getModel();
                    $obReservationStatu->reservation_id=$objReservation->id;
                    $obReservationStatu->statu_id=1;
                    $obReservationStatu->user_id=$auditor;
                    $obReservationStatu->save();
                }
                foreach ($opciones as $valor) {
                    if ($valor<>''){
                        $consulta1 = $this->PollOptionRepo->getOptionsForPollCodigo($ObjSearchPollDetail->poll_id,$valor);
                        if (count($consulta1)>0){
                            $objPollOptionDetail = $this->PollOptionDetailRepo->getModel();
                            $objPollOptionDetail->poll_option_id=$consulta1[0]->id;
                            $objPollOptionDetail->store_id=$store_id;
                            $objPollOptionDetail->product_id=$product_id;
                            $objPollOptionDetail->company_id=$company_id;
                            $objPollOptionDetail->publicity_id=$publicity_id;
                            $objPollOptionDetail->category_product_id=$category_product_id;
                            $objPollOptionDetail->poll_id=$poll_id;
                            $objPollOptionDetail->poll_detail_id=$idPollDetail;
                            $sw = 1;


                            if ($sw==1){
                                $objPollOptionDetail->result=1;
                                if (count($comentOpcion)>1){
                                    $objPollOptionDetail->otro=$comentOpcion[$c];
                                }else{
                                    $objPollOptionDetail->otro=$comentOpcion[0];
                                }

                                $objPollOptionDetail->auditor=$auditor;
                                $objPollOptionDetail->priority=$priority;
                                $objPollOptionDetail->road_id = $road_id;

                                $objPollOptionDetail->save();

                                if (($campaigneDetail->customer_id==18) and ($objPoll->orden == 11) and ($campaigneDetail->study_id == 40))
                                {
                                    $objReservationServiceDetail = $this->reservationServiceDetailRepo->getModel();
                                    $objReservationServiceDetail->reservation_id=$objReservation->id;
                                    $objReservationServiceDetail->service_detail_id=$consulta1[0]->service_detail_id;
                                    $objReservationServiceDetail->save();
                                }
                            }
                        }
                        $c=$c+1;
                    }
                }

            }else{
                $idPollOptionDetail=0;
            }

        }

        return Response::json([ 'success'=> 1, 'last_poll_detail_id' => $idPollDetail]);
    }

    /**
     * @return mixed
     * @comment versión 2 de saveRegisters
     */
    public function saveReg2()
    {
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
        if ($comentario != ""){
            $product_ids = explode('|',$comentario);
        }else{
            $product_ids =[];
        }

        $auditor= $valoresPost['auditor'];
        $product_id= $valoresPost['product_id'];
        $publicity_id= $valoresPost['publicity_id'];
        $company_id = $valoresPost['company_id'];
        $category_product_id = $valoresPost['category_product_id'];
        $selectedOptions = $valoresPost['selectedOptions'];
        $selectedOptionsComment = $valoresPost['selectedOptionsComment'];
        $priority = $valoresPost['priority'];
        $mytime = Carbon::now();
        $horaSistema = $mytime->toDateTimeString();



        $objPoll=$this->PollRepo->find($poll_id);
        $objAuditor = $this->UserRepo->find($auditor);
        $datoAuditor = $objAuditor->fullname."(".$auditor.")";
        $campaigneDetail = $this->campaigneRepo->find($company_id);//dd($campaigneDetail);
        $customer =$this->customerRepo->find($campaigneDetail->customer_id);
        $cliente = $customer->corto;


        $textoContent = $campaigneDetail->fullname."".$objPoll->question." - Id= ".$store_id;
        $objStore = $this->StoreRepo->find($store_id);
        $tipo_bodega = $objStore->tipo_bodega;
        $agente = $objStore->fullname;
        $dir = $objStore->codclient;
        $address = $objStore->address;
        $fono = $objStore->telephone."/".$objStore->cell;
        $district = $objStore->district." - ".$objStore->region." - ".$objStore->ubigeo;
        $foto = "";$nomPublicity="";
        $fechaHoraEnvio = $horaSistema;

        if ($cliente=='interbank'){
            $textoContent = $campaigneDetail->fullname." ".substr($objPoll->question,0,10)."... - DIR: ".$dir." StoreId: ".$store_id;
        }

        if ($cliente=='alicorp'){
            if ($publicity_id<>"0")
            {
                $objPublicity = $this->publicityRepo->find($publicity_id);
                $nomPublicity = $objPublicity->fullname;
            }
            $textoContent = $campaigneDetail->fullname." ".substr($objPoll->question,0,10)."... - StoreId: ".$store_id;
        }

        if ($cliente=='bayer'){
            $textoContent = $campaigneDetail->fullname." ".substr($objPoll->question,0,10)."... - CADENA: ".$objStore->cadenaRuc." StoreId: ".$store_id;
        }

        if (count($product_ids)>0)
        {
            $c=0;
            foreach ($product_ids as $product_id) {$c ++;
                if ($product_id<>"")
                {
                    $objPollDetail = $this->PollDetailRepo->getModel();
                    $objPollDetail->poll_id = $poll_id;//dd($objPollDetail->poll_id);
                    $objPollDetail->store_id = $store_id;
                    $objPollDetail->publicity_id = $publicity_id;
                    $objPollDetail->company_id = $company_id;
                    $objPollDetail->category_product_id = $category_product_id;
                    $productId = explode('-',$product_id);
                    $objPollDetail->product_id = $productId[0];
                    if (($campaigneDetail->study_id==22) or ($campaigneDetail->study_id==23) or ($campaigneDetail->study_id==24) or ($campaigneDetail->study_id==25) or ($campaigneDetail->study_id==28))
                    {
                        $objPollDetail->comentario = $productId[1];
                        $objPollDetail->result = 1;
                    }else{
                        if (($campaigneDetail->study_id==36)){
                            $objPollDetail->comentario = $productId[1];
                            $objPollDetail->limite = $productId[2];
                            $objPollDetail->result = 1;
                        }else{
                            if ($productId[1]==1)
                            {
                                $objPollDetail->result = 1;
                            }else{
                                $objPollDetail->result = 0;
                            }
                        }

                    }


                    $objPollDetail->sino = $sino;
                    $objPollDetail->options = $options;
                    $objPollDetail->limits = $limits;
                    $objPollDetail->media = $media;
                    $objPollDetail->coment = $coment;
                    if (($campaigneDetail->study_id != 36)){
                        $objPollDetail->limite = $limite;
                    }

                    //$objPollDetail->comentario = "";
                    $objPollDetail->auditor = $auditor;
                    //$objPollDetail->comentario = "";

                    if (($campaigneDetail->study_id == 36)  or ($campaigneDetail->study_id==22) or ($campaigneDetail->study_id==23) or ($campaigneDetail->study_id==24) or ($campaigneDetail->study_id==25) or ($campaigneDetail->study_id==28))
                    {
                        $valor=[];
                    }else{
                        $valor = $this->PollDetailRepo->searchPollDetail($objPollDetail,1);
                    }


                    if (count($valor)==0){
                        $objPollDetail->save();
                        $idPollDetail = $objPollDetail->id;

                        //send emails
                        if ($result == 0){
                            $motivo = $objPoll->question."(Id question: ".$objPoll->id.")".' Resp. NO('.$idPollDetail.')';
                        }else{
                            $motivo = $objPoll->question."(Id question: ".$objPoll->id.")".' Resp SI('.$idPollDetail.')';
                        }
                        if ($nomPublicity<>""){
                            $motivo .=" Publicidad: ".$nomPublicity;
                        }
                        $questions = $this->getQuestionsSendEmail();
                        foreach ($questions as $question)
                        {
                            if (($question['company_id']==$company_id) and ($question['poll_id']==$poll_id) and ($question['send']==1))
                            {
                                if ($result == $question['result'])
                                {
                                    $gruposEmails = $this->getGroupsEmails();
                                    $mascaras = explode('|',$question['mask']);
                                    for($i=0;$i<count($mascaras);$i++) {
                                        $emails = $gruposEmails[$mascaras[$i]];//dd($emails);
                                        $this->sendEmails($store_id,$textoContent,$motivo,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails);
                                    }
                                    //sendEmails($store_id,$textoContent,$motivo,$auditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails)
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
                        $valor->product_id = $productId[0];
                        if ($productId[1]==1)
                        {
                            $valor->result = 1;
                        }else{
                            $valor->result = 0;
                        }
                        $valor->limite = $limite;
                        $valor->comentario = "";
                        $valor->auditor = $auditor;
                        $valor->update();
                        $idPollDetail = $valor->id;
                    }
                    unset($objPollDetail);
                }
            }

        }

        $objPollDetailSearch = $this->PollDetailRepo->getModel();
        $ObjSearchPollDetail = $objPollDetailSearch::find($idPollDetail);//dd($selectedOptions);
        if ($ObjSearchPollDetail->options==1)
        {
            $opciones = explode('|',$selectedOptions);$c=0;
            $comentOpcion = explode('|',$selectedOptionsComment);//dd($opciones);
            if ($opciones[0]<>'')
            {
                foreach ($opciones as $valor) {
                    if ($valor<>''){
                        $consulta1 = $this->PollOptionRepo->getOptionsForPollCodigo($ObjSearchPollDetail->poll_id,$valor);//dd($consulta1[0]);
                        if (count($consulta1)>0){
                            $objPollOptionDetail = $this->PollOptionDetailRepo->getModel();
                            $objPollOptionDetail->poll_option_id=$consulta1[0]->id;
                            $objPollOptionDetail->store_id=$store_id;
                            $objPollOptionDetail->product_id=$product_id;
                            $objPollOptionDetail->company_id=$company_id;
                            $objPollOptionDetail->publicity_id=$publicity_id;

                            if ($campaigneDetail->study_id == 36){
                                $valorOption=[];
                            }else{
                                $valorOption = $this->PollOptionDetailRepo->searchPollOptionDetail($objPollOptionDetail);
                            }
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
                                            $emails = $gruposEmails[$mascaras[$i]];//dd($emails);
                                            $this->sendEmails($store_id,$textoContent,$motivo,$datoAuditor,$comentario,$cliente,$tipo_bodega,$agente,$dir,$address,$district,$foto,$fechaHoraEnvio,$emails,$fono);
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

        return Response::json([ 'success'=> 1, 'last_poll_detail_id' => $idPollDetail]);
    }

	public function saveExhibidorBodegaAlicorp(){
			$company_id = Input::only('company_id');
			$audit_id = Input::only('audit_id');
			$road_id = Input::only('rout_id');
			$store_id = Input::only('store_id');
			$user_id = Input::only('user_id');
			$publicity_id = Input::only('publicity_id');
			$found = Input::only('found');
			$visible = Input::only('visible');
			$contaminated = Input::only('contaminated');
			$status = Input::only('status');
			$comment = Input::only('comment');
			$mytime = Carbon::now();
			$horaSistema = $mytime->toDateTimeString();

			$sql1 = "SELECT id FROM publicity_details p 
					  where 
					  publicity_id='" . $publicity_id['publicity_id']  . "' and 
					  store_id='".$store_id['store_id']."' and 
					  user_id='".$user_id['user_id']."' and 
					  result='".$found['found']."' and 
					  visible='".$visible['visible']."' and 
					  comment='".$comment['comment']."' and 
					  contaminated='".$contaminated['contaminated']."' and 
					  company_id='".$company_id['company_id']."'";
			$consulta11 = DB::select($sql1);
			if (count($consulta11)==0){
				$result=DB::insert("INSERT INTO publicity_details (publicity_id,store_id,user_id,result,visible,comment,contaminated,company_id, created_at,updated_at) 
							VALUES(?,?,?,?,?,?,?,?,?,?)" ,
							array(
								$publicity_id['publicity_id'],
								$store_id['store_id'],
								$user_id['user_id'],
								$found['found'],
								$visible['visible'],
								$comment['comment'],
								$contaminated['contaminated'],
								$company_id['company_id'],
								$horaSistema,$horaSistema));

				if($result > 0) {
					return \Response::json([ 'success'=> 1]);
				}else{
					return \Response::json([ 'success'=> 0]);
				}
			}else{
				$result=DB::update("UPDATE  publicity_details set publicity_id=?,store_id=?,user_id=?,result=?,visible=?,comment=?,contaminated=?,company_id=?, created_at=?,updated_at=? 
							where publicity_id='" . $publicity_id['publicity_id']  . "' 
								and store_id='".$store_id['store_id']."' 
								and user_id='".$user_id['user_id']."' 
								and result='".$found['found']."' 
								and visible='".$visible['visible']."' 
								and comment='".$comment['comment']."' 
								and contaminated='".$contaminated['contaminated']."' 
								and company_id='".$company_id['company_id']."'" ,
							array(
								$publicity_id['publicity_id'],
								$store_id['store_id'],
								$user_id['user_id'],
								$found['found'],
								$visible['visible'],
								$comment['comment'],
								$contaminated['contaminated'],
								$company_id['company_id'],
								$horaSistema,$horaSistema));

				if($result > 0) {
					return \Response::json([ 'success'=> 1]);
				}else{
					return \Response::json([ 'success'=> 0]);
				}
			}




//		return [
//			'success' => true ,
//			'note' => 'hola',
//		];
}

	public function insertImagesPublicitiesAlicorp() {
		if(Input::hasFile('fotoUp')) {
			$archivo=Input::file('fotoUp');
			$archivo->move('media/fotos/',$archivo->getClientOriginalName());
		}
		$publicities_id = Input::only('publicities_id');
		$store_id = Input::only('store_id');
		$tipo = Input::only('tipo');
		$archivo = Input::only('archivo');
		$company_id =Input::only('company_id');
		$mytime =  Carbon::now();
		$horaSistema = $mytime->toDateTimeString();

		DB::insert("INSERT INTO medias (store_id,publicities_id, tipo,archivo, company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($store_id['store_id'],$publicities_id['publicities_id'], $tipo['tipo'], $archivo['archivo'],$company_id['company_id'],$horaSistema,$horaSistema));

		return \Response::json([ 'success'=> 1]);

	}

	public function insertImagesProductPollAlicorp() {
		if(Input::hasFile('fotoUp')) {
			$archivo=Input::file('fotoUp');
			$archivo->move('media/fotos/',$archivo->getClientOriginalName());
		}
		$product_id = Input::only('product_id');
		$poll_id = Input::only('poll_id');
		$store_id = Input::only('store_id');
		$tipo = Input::only('tipo');
		$archivo = Input::only('archivo');
		$company_id = Input::only('company_id');
		$mytime = Carbon::now();
		$horaSistema = $mytime->toDateTimeString();

		DB::insert("INSERT INTO medias (store_id,poll_id,product_id, tipo,archivo,company_id, created_at,updated_at) 
					VALUES(?,?,?,?,?,?,?,?)" ,
					array(
						$store_id['store_id'],
						$poll_id['poll_id'],
						$product_id['product_id'],
						$tipo['tipo'],
						$archivo['archivo'],
						$company_id['company_id'],
						$horaSistema,$horaSistema
					)
		);

		return \Response::json([ 'success'=> 1]);
	}

	public function insertImages() {
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
		$category_product_id = Input::only('category_product_id');
		$mytime = Carbon::now();
		$horaSistemaUpdate = $mytime->toDateTimeString();
		$horaSistema = Input::only('created_at');

		DB::insert("INSERT INTO medias (store_id,poll_id,publicities_id,product_id, tipo,archivo,company_id,category_product_id, created_at,updated_at) 
					VALUES(?,?,?,?,?,?,?,?,?,?)" ,
			array(
				$store_id['store_id'],
				$poll_id['poll_id'],
				$publicities_id['publicities_id'],
				$product_id['product_id'],
				$tipo['tipo'],
				$archivo['archivo'],
				$company_id['company_id'],
				$category_product_id['category_product_id'],
				$horaSistema['created_at'],
				$horaSistemaUpdate
			)
		);

		return \Response::json([ 'success'=> 1]);
	}

    private function printTextPhoto($namePhoto,$agente,$datePhoto)
    {

        $link =  "http://$_SERVER[HTTP_HOST]";

        // Ruta de la imagen original
        $imagenOriginal = 'media/fotos/'.$namePhoto;

        $fotoExist=false;

        if (file_exists($imagenOriginal) && is_file($imagenOriginal)) {
            $fotoExist=true;
            // Crear una imagen a partir del archivo
            $imagen = imagecreatefromjpeg($imagenOriginal);

            // Color del texto (en RGB)
            $colorTexto = imagecolorallocate($imagen, 255, 255, 255); // Blanco

            // Tamaño y fuente del texto
            $tamanioTexto = 25;
            $fuente = 'Photography.ttf'; // Ruta a un archivo de fuente TrueType (TTF)



            // Texto que deseas agregar
            $texto = 'TTAUDIT';
            $texto1 = $datePhoto;
            $texto2 = $agente;


            // Obtener las dimensiones de la imagen
            $anchoImagen = imagesx($imagen);
            $altoImagen = imagesy($imagen);

            // Obtener las dimensiones del texto
            $dimensionesTexto = imagettfbbox($tamanioTexto, 0, $fuente, $texto2);
            $anchoTexto = $dimensionesTexto[4] - $dimensionesTexto[6];
            $altoTexto = $dimensionesTexto[1] - $dimensionesTexto[7];

            /*// Calcular la posición del texto en la esquina inferior derecha
            $posX = $anchoImagen - $anchoTexto - 10; // 10 píxeles desde el borde derecho
            $posY = $altoImagen - 10;                // 10 píxeles desde el borde inferior*/

            // Calcular la posición del texto en la esquina inferior izquierda
            $posX = 10; // 10 píxeles desde el borde izquierdo
            $posY = $altoImagen - $altoTexto - 10; // 10 píxeles desde el borde inferior



            // Agregar el texto a la imagen
            imagettftext($imagen, $tamanioTexto, 0, $posX, $posY, $colorTexto, $fuente, $texto2);
            // Desplaza la posición vertical para la siguiente línea
            $posY -= 30; // Ajusta la distancia entre líneas según tu preferencia
            imagettftext($imagen, $tamanioTexto, 0, $posX, $posY, $colorTexto, $fuente, $texto1);
            $posY -= 30;
            imagettftext($imagen, $tamanioTexto, 0, $posX, $posY, $colorTexto, $fuente, $texto);

            // Guardar la imagen resultante (puedes reemplazar la original o guardarla con un nuevo nombre)
            $imageFinal ='media/fotos/imagentexto.jpg';
            imagejpeg($imagen, $imagenOriginal);

            // Liberar la memoria
            imagedestroy($imagen);
        } else {
            $fotoExist=false;
        }

    }

	public function insertImagesMayorista() {

        $valoresPost= Input::all();//dd($valoresPost);

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
        $mytime = Carbon::now();
        $horaSistemaUpdate = $mytime->toDateTimeString();

        $horaSistema = Input::only('horaSistema');
        /*
        date_default_timezone_set('America/Lima'); // Establece la zona horaria de Perú

        $horaSistema = Input::only('created_at'); // Suponiendo que $horaSistema contiene la cadena de fecha y hora en formato 'Y-m-d H:i:s'

        $horaPeru = new DateTime($horaSistema);
        $horaPeru->setTimezone(new DateTimeZone('America/Lima'));*/



        $sql1 = "SELECT id FROM medias p 
					  where 
					  poll_id='" . $poll_id['poll_id']  . "' and 
					  store_id='".$store_id['store_id']."' and 
					  publicities_id='".$publicities_id['publicities_id']."' and 
					  product_id='".$product_id['product_id']."' and 
					  tipo='".$tipo['tipo']."' and 
					  archivo='".$archivo['archivo']."' and 
					  company_id='".$company_id['company_id']."' and 
					  category_product_id='".$category_product_id['category_product_id']."' and  
					  monto='".$monto['monto']."' and 
					  razon_social='".$razon_social['razon_social']."'";
        $consulta11 = DB::select($sql1);
        if (count($consulta11)==0){

            if (isset($valoresPost['response_number_id']))
            {
                $resultado =DB::insert("INSERT INTO medias (response_number_id,store_id,poll_id,publicities_id,product_id, tipo,archivo,company_id,category_product_id,monto,razon_social, created_at,updated_at) 
					VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)" ,
                    array(
                        $valoresPost['response_number_id'],
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
                        $horaSistema['horaSistema'],
                        $horaSistemaUpdate
                    )
                );
                if ($resultado)
                {
                    $objStore = $this->StoreRepo->find($store_id['store_id']);
                    $agente = $objStore->fullname;
                    //$idMedia = DB::getPdo()->lastInsertId();
                    $this->printTextPhoto($archivo['archivo'],$agente,$horaSistema['horaSistema']);
                    return \Response::json([ 'success'=> 1,'store'=>$objStore]);
                }
            }else{
                DB::insert("INSERT INTO medias (store_id,poll_id,publicities_id,product_id, tipo,archivo,company_id,category_product_id,monto,razon_social, created_at,updated_at) 
					VALUES(?,?,?,?,?,?,?,?,?,?,?,?)" ,
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
                        $horaSistema['created_at'],
                        $horaSistemaUpdate
                    )
                );
            }


        }
        return \Response::json([ 'success'=> 1]);
	}

    public function insertImagesNewCp() {
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
        $mytime = Carbon::now();
        $horaSistemaUpdate = $mytime->toDateTimeString();

        $horaSistema = Input::only('horaSistema');
        /*
        date_default_timezone_set('America/Lima'); // Establece la zona horaria de Perú

        $horaSistema = Input::only('created_at'); // Suponiendo que $horaSistema contiene la cadena de fecha y hora en formato 'Y-m-d H:i:s'

        $horaPeru = new DateTime($horaSistema);
        $horaPeru->setTimezone(new DateTimeZone('America/Lima'));*/



        $sql1 = "SELECT id FROM medias p 
					  where 
					  poll_id='" . $poll_id['poll_id']  . "' and 
					  store_id='".$store_id['store_id']."' and 
					  publicities_id='".$publicities_id['publicities_id']."' and 
					  product_id='".$product_id['product_id']."' and 
					  tipo='".$tipo['tipo']."' and 
					  archivo='".$archivo['archivo']."' and 
					  company_id='".$company_id['company_id']."' and 
					  category_product_id='".$category_product_id['category_product_id']."' and  
					  monto='".$monto['monto']."' and 
					  razon_social='".$razon_social['razon_social']."'";
        $consulta11 = DB::select($sql1);
        if (count($consulta11)==0){
            $resultado =DB::insert("INSERT INTO medias (store_id,poll_id,publicities_id,product_id, tipo,archivo,company_id,category_product_id,monto,razon_social, created_at,updated_at) 
					VALUES(?,?,?,?,?,?,?,?,?,?,?,?)" ,
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
                    $horaSistema['horaSistema'],
                    $horaSistemaUpdate
                )
            );
            if ($resultado)
            {
                $objStore = $this->StoreRepo->find($store_id['store_id']);
                $agente = $objStore->fullname;
                //$idMedia = DB::getPdo()->lastInsertId();
                $this->printTextPhoto($archivo['archivo'],$agente,$horaSistema['horaSistema']);
                return \Response::json([ 'success'=> 1,'store'=>$objStore]);
            }
        }
        return \Response::json([ 'success'=> 1]);
    }

    public function insertDataImages()
    {
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
        $mytime = Carbon::now();
        $horaSistemaUpdate = $mytime->toDateTimeString();
        $horaSistema = Input::only('created_at');
        $idMedia=0;

        if (DB::insert("INSERT INTO medias (store_id,poll_id,publicities_id,product_id, tipo,archivo,company_id,category_product_id,monto,razon_social, created_at,updated_at) 
					VALUES(?,?,?,?,?,?,?,?,?,?,?,?)" ,
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
                $horaSistema['created_at'],
                $horaSistemaUpdate
            )
        )) {
            $idMedia = DB::getPdo()->lastInsertId();
            return \Response::json([ 'success'=> 1,'media_id'=>$idMedia]);
        }else{
            return \Response::json([ 'success'=> 0,'media_id'=>$idMedia]);
        }


    }

    public function insertFileImages()
    {
        if(Input::hasFile('fotoUp')) {
            $idMedia = Input::only('media_id');
            $archivo=Input::file('fotoUp');
            if ($archivo->move('media/fotos/',$archivo->getClientOriginalName()))
            {
                $objMedia = $this->mediaRepo->find($idMedia);
                $objMedia->active=1;
                $objMedia->save();
                return \Response::json([ 'success'=> 1,'media_id'=>$idMedia]);
            }else{
                return \Response::json([ 'success'=> 0,'media_id'=>$idMedia]);
            }
        }
    }

	public function closeAudit() {

		$company_id = Input::only('company_id');
		$audit_id = Input::only('audit_id');
		$road_id = Input::only('rout_id');
		$store_id = Input::only('store_id');
		$mytime = Carbon::now();
		$horaSistema = $mytime->toDateTimeString();


		$result = DB::update("UPDATE  audit_road_stores set audit= 1, updated_at=? where store_id = ? and  road_id = ? and company_id=? and audit_id=? " ,
			array(
				$horaSistema,
				$store_id['store_id'],
				$road_id['rout_id'],
				$company_id['company_id'],
				$audit_id['audit_id'])
		);
		if($result > 0) {
			return \Response::json([ 'success'=> 1]);
		}else{
			return \Response::json([ 'success'=> 0]);
		}

	}

}
