<?php
namespace Auditor\Repositories;

use Auditor\Entities\Award;


class AwardRepo extends BaseRepo{

    public function getModel()
    {
        return new Award;
    }



} 