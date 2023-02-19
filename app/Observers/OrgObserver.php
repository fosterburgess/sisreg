<?php

namespace App\Observers;

use App\Models\Reg\Org;

class OrgObserver
{
    /**
     * Handle the Org "created" event.
     */
    public function created(Org $org): void
    {
        $parentIds = [];
        $checkedOrg = Org::find($org->id);
        while($pid = $checkedOrg?->parent_id) {
            $parentIds[] = $pid;
            $checkedOrg = Org::find($checkedOrg->parent_id);
        }
        $org->setMeta('parent_ids', $parentIds);
        $org->save();
    }

    /**
     * Handle the Org "updated" event.
     */
    public function updated(Org $org): void
    {
        $parentIds = [];
        $checkedOrg = Org::find($org->id);
        while($pid = $checkedOrg?->parent_id) {
            $parentIds[] = $pid;
            $checkedOrg = Org::find($checkedOrg->parent_id);
        }
        $org->setMeta('parent_ids', $parentIds);
        $org->saveQuietly();
    }

    /**
     * Handle the Org "deleted" event.
     */
    public function deleted(Org $org): void
    {
        //
    }

    /**
     * Handle the Org "restored" event.
     */
    public function restored(Org $org): void
    {
        //
    }

    /**
     * Handle the Org "force deleted" event.
     */
    public function forceDeleted(Org $org): void
    {
        //
    }
}
