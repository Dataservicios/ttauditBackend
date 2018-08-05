<?php
namespace Auditor\Repositories;

use Auditor\Entities\Mechanic;


class MechanicRepo extends BaseRepo{

    public function getModel()
    {
        return new Mechanic;
    }



} 