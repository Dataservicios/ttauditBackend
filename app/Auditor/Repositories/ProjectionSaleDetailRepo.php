<?php
namespace Auditor\Repositories;

use Auditor\Entities\ProjectionSaleDetail;


class ProjectionSaleDetailRepo extends BaseRepo{

    public function getModel()
    {
        return new ProjectionSaleDetail;
    }


} 