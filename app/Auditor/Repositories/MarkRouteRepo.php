<?php
namespace Auditor\Repositories;

use Auditor\Entities\MarkRoute;


class MarkRouteRepo extends BaseRepo{

    public function getModel()
    {
        return new MarkRoute;
    }


} 