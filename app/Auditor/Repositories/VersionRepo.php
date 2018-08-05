<?php
namespace Auditor\Repositories;

use Auditor\Entities\Version;


class VersionRepo extends BaseRepo{

    public function getModel()
    {
        return new Version;
    }

    public function getRegisterForCompany($company_id,$admin="0")
    {
        if ($admin==1)
        {
            $valores = Version::where('company_id', $company_id)->where('vigente',1)->get();
        }else{
            $valores = Version::where('company_id', $company_id)->where('vigente',1)->where('admin','<>',1)->get();
        }

        return $valores;
    }

} 