<?php
namespace Auditor\Repositories;

use Auditor\Entities\MarketDetail;


class MarketDetailRepo extends BaseRepo{

    public function getModel()
    {
        return new MarketDetail;
    }



} 