<?php
/**
 * Created by PhpStorm.
 * User: Webmaster
 * Date: 18/12/2014
 * Time: 04:14 PM
 */

namespace Auditor\Managers;


class RoadManager extends BaseManager {

    public function getRules()
    {
        $rules = [
            'fullname' => 'required',
            'user_id' => 'required',
            'audit'    => 'required',
            'test'=> 'required',
            'f_ejecucion'  =>  'required',
            'active' => 'required',
        ];
        return $rules;
    }


} 