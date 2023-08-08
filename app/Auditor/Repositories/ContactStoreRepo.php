<?php
namespace Auditor\Repositories;

use Auditor\Entities\ContactStore;


class ContactStoreRepo extends BaseRepo{

    public function getModel()
    {
        return new ContactStore;
    }


} 