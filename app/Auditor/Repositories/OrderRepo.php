<?php
namespace Auditor\Repositories;

use Auditor\Entities\Order;


class OrderRepo extends BaseRepo{

    public function getModel()
    {
        return new Order;
    }


} 