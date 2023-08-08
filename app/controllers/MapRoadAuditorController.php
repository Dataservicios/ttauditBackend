<?php

/**
 * Created by PhpStorm.
 * User: jcdia
 * Date: 21/09/2017
 * Time: 07:49
 */

use Auditor\Repositories\UserRepo;

class MapRoadAuditorController extends BaseController
{


    protected $UserRepo;


    public function __construct(UserRepo $UserRepo)
    {
        $this->UserRepo = $UserRepo;
    }
    public function listAuditorAll($company_id='0',$user_id='0')
    {

        $auditors = $this->UserRepo->listUserCondition("auditor",0); // ->allReg('fullname', 'id');
        $sql1 = "SELECT  stores.id,stores.ubigeo,company_stores.company_id
                    FROM  stores INNER JOIN company_stores ON (stores.id = company_stores.store_id)
                    WHERE stores.test=0 and company_stores.ruteado=0 group by ubigeo";

        $departaments = DB::select($sql1);
       // dd($departaments);
       // $auditors=$this->UserRepo;
        //dd($auditors);
        //dd($auditors->fullname);
        return View::make('roads/roadsAuditor',compact('auditors'),compact('departaments'));
    }

    public  function roadMap(){

        $user_id = Input::only('user_id');
        $city = Input::only('city');
        $user=$this->UserRepo->find($user_id);
        //$city = array('city' => $city);
        //dd($city);
        //dd($user);
        //return View::make('roads/roadsAuditorMap', array('user_id' => $user_id,'city' => $city));
        return View::make('roads/roadsAuditorMap', compact('user','city'));
    }

    public  function roadMapTest(){//version 2

        $user_id = Input::only('user_id');
        $city = Input::only('city');
        $user=$this->UserRepo->find($user_id);
        //$city = array('city' => $city);
        //dd($city);
        //dd($user);
        //return View::make('roads/roadsAuditorMap', array('user_id' => $user_id,'city' => $city));
        return View::make('roads/roadsAuditorMapVersion2', compact('user','city'));
    }

    public function listAuditorAllTest($company_id='0',$user_id='0')
    {

        $auditors = $this->UserRepo->listUserCondition("auditor",0);
        $sql1 = "SELECT  stores.id,stores.ubigeo,company_stores.company_id
                    FROM  stores INNER JOIN company_stores ON (stores.id = company_stores.store_id)
                    WHERE stores.test=0 and company_stores.ruteado=0 group by ubigeo";

        $departaments = DB::select($sql1);

        return View::make('roads/roadsAuditorTest',compact('auditors'),compact('departaments'));
    }
    
    
       public  function roadMapDemo(){

        $user_id = 5;
        $city = Input::only('city');
        $user=$this->UserRepo->find($user_id);
        //$city = array('city' => $city);
        //dd($city);
        //dd($user);
        //return View::make('roads/roadsAuditorMap', array('user_id' => $user_id,'city' => $city));
        return View::make('roads/roadsAuditorMapDemo', compact('user','city'));
    }
}