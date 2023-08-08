<?php

namespace Auditor\Repositories;

use Auditor\Entities\ReservationServiceDetail;

class ReservationServiceDetailRepo extends BaseRepo
{

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return new ReservationServiceDetail();
    }
}