<?php
/**
 * Created by PhpStorm.
 * User: Franco
 * Date: 11/12/2018
 * Time: 12:49 PM
 */

namespace Auditor\Repositories;

use Auditor\Entities\LogProcess;

class LogProcessRepo extends BaseRepo
{
    public function getModel()
    {
        return new LogProcess();
    }
}