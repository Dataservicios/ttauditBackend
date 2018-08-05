<?php
/**
 * Created by PhpStorm.
 * User: Webmaster
 * Date: 25/06/2015
 * Time: 02:50 PM
 */

use Auditor\Repositories\MechanicRepo;
use Auditor\Repositories\SwapRepo;
use Auditor\Repositories\AwardRepo;
use Auditor\Repositories\StockAwardRepo;


class CanjeController extends BaseController{

    protected $mechanicRepo;
    protected $swapRepo;
    protected $awardRepo;
    protected $stockAwardRepo;

    public $urlBase;
    public $urlImagesFotos;
    public $urlImageBase;
    public $customer_id;
    public $estudio;
    public $pollsWeb;

    public function __construct(StockAwardRepo $stockAwardRepo,AwardRepo $awardRepo,MechanicRepo $mechanicRepo,SwapRepo $swapRepo)
    {
        $this->mechanicRepo = $mechanicRepo;
        $this->swapRepo = $swapRepo;
        $this->awardRepo = $awardRepo;
        $this->stockAwardRepo = $stockAwardRepo;

        $this->urlBase = \App::make('url')->to('/');
        $this->urlImagesFotos = '/media/fotos/';
        $this->urlImageBase = '/media/images/';
        $this->customer_id = 4;
        $this->estudio=15;
        //$this->pollsWeb =$this->getAllPollsWeb($this->customer_id,$this->estudio);

    }

    public function getMechanics($company_id="0")
    {
        if ($company_id=="0")
        {
            $valoresPost= Input::all();
            $company_id = $valoresPost['company_id'];
        }
        $mechanicObj = $this->mechanicRepo->getModel();
        $mechanicRegs = $mechanicObj->where('company_id',$company_id)->get();
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        if (count($mechanicRegs)>0)
        {
            return  Response::json([ 'success'=> 1,'regs' => $mechanicRegs]);
        }else{
            return  Response::json([ 'success'=> 0,'regs' => []]);
        }
    }

    public function getSwaps($mechanic_id="0")
    {
        if ($mechanic_id=="0")
        {
            $valoresPost= Input::all();
            $mechanic_id = $valoresPost['mechanic_id'];
        }
        $swapObj = $this->swapRepo->getModel();
        $swapRegs = $swapObj->where('mechanic_id',$mechanic_id)->get();
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        if (count($swapRegs)>0)
        {
            return  Response::json([ 'success'=> 1,'regs' => $swapRegs]);
        }else{
            return  Response::json([ 'success'=> 0,'regs' => []]);
        }
    }


    public function saveOperationSwap()
    {
        /*0 = {HashMap$Node@6475} "store_id" -> "194499"
1 = {HashMap$Node@6476} "company_id" -> "169"
2 = {HashMap$Node@6477} "mechanic_id" -> "1"
3 = {HashMap$Node@6478} "distributor_id" -> "571"
4 = {HashMap$Node@6479} "swap_id" -> "1"*/
        $valoresPost= Input::all();
        $mechanic_id = $valoresPost['mechanic_id'];
        $user_id = $valoresPost['distributor_id'];
        $company_id = $valoresPost['company_id'];
        $store_id = $valoresPost['store_id'];
        $swap_ids = $valoresPost['swap_id'];
        $swaps_ids = explode('|',$swap_ids);

        foreach ($swaps_ids as $swaps_id) {
            $swapObj = $this->swapRepo->find($swaps_id);
            $objAward = $this->awardRepo->getModel();
            $regAward = $objAward->where('swap_id',$swaps_id)->first();
            $objStockAward = $this->stockAwardRepo->getModel();
            $objStockAward->user_id = $user_id;
            $objStockAward->mechanic_id = $mechanic_id;
            $objStockAward->swap_id = $swaps_id;
            $objStockAward->award_id = $regAward->id;
            $objStockAward->product_id = $regAward->product_id;
            $objStockAward->description = "Mecánica Rotación :".$swapObj->rotation." Premio: ".$swapObj->prize;
            $objStockAward->quantity = $regAward->quantity*(-1);
            $objStockAward->store_id = $store_id;
            $objStockAward->company_id = $company_id;
            $objStockAward->save();
        }
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  Response::json([ 'success'=> 1]);
    }

} 