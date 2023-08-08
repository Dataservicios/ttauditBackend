<?php
namespace Auditor\Repositories;

use Auditor\Entities\AttributeDetail;


class AttributeDetailRepo extends BaseRepo{

    public function getModel()
    {
        return new AttributeDetail;
    }


} 