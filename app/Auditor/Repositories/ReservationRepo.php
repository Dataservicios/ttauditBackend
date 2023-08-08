<?php

namespace Auditor\Repositories;

use Auditor\Entities\Reservation;

class ReservationRepo extends BaseRepo
{

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return new Reservation;
    }
}