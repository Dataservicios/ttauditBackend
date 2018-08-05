<?php
namespace Auditor\Repositories;

use Auditor\Entities\OrderDetail;


class OrderDetailRepo extends BaseRepo{

    public function getModel()
    {
        return new OrderDetail;
    }


} 