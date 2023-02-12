<?php
namespace App\Services;

use App\Models\Reg\Org;

class OrgService
{

    public function createOrg(array $info): Org
    {
        $org = new Org();
        $org->fill($info);
        $org->save();

        return $org;
    }
}
