<?php

namespace Auditor\Repositories;

use Auditor\Entities\ReservationStatu;

class ReservationStatuRepo extends BaseRepo
{

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return new ReservationStatu();
    }
}