<?php
namespace Auditor\Repositories;

use Auditor\Entities\Swap;


class SwapRepo extends BaseRepo{

    public function getModel()
    {
        return new Swap;
    }



} 