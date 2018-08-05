<?php
namespace Auditor\Repositories;

use Auditor\Entities\StockAward;


class StockAwardRepo extends BaseRepo{

    public function getModel()
    {
        return new StockAward;
    }



} 