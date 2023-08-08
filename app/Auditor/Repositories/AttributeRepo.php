<?php
namespace Auditor\Repositories;

use Auditor\Entities\Attribute;


class AttributeRepo extends BaseRepo{

    public function getModel()
    {
        return new Attribute;
    }


} 