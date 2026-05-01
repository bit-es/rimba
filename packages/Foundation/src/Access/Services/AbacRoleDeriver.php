<?php
declare(strict_types=1);

namespace Bites\Foundation\Access\Services;

use Bites\Foundation\Person\Entities\Staff;
use Carbon\Carbon;

final class AbacRoleDeriver
{
    /**
     * Derive all roles for a Staff at a point in time
     */
    public function deriveForStaff(Staff $staff, ?Carbon $at = null): array
    {
        $at ??= now();
        $roles = [];

        /* =====================================================
         | STAFF SELF
         |===================================================== */
        $roles[] = "s.view.self";

        /* =====================================================
         | EMPLOYEE ROLES
         |===================================================== */
        if (in_array($staff->staff_type, ['FTE', 'FTC'], true)) {
            $roles[] = "e.access.hr";
        }

        /* =====================================================
         | ORG TEAMS
         |===================================================== */
        foreach ($staff->teams as $team) {
            $roles[] = 't.member.' . $team->id;

            if ($team->owner_staff_id === $staff->id) {
                $roles[] = 't.lead.' . $team->id;
            }
        }

        /* =====================================================
         | JOB CONTRACTS (ACTIVE ONLY)
         |===================================================== */
        foreach ($staff->contracts as $contract) {

            if (
                $contract->start_date > $at ||
                ($contract->end_date && $contract->end_date < $at)
            ) {
                continue;
            }

            $position = $contract->position;
            $unit = $position->unit;

            /* ---------------------------------------------
             | ORG UNIT OWNERSHIP
             |--------------------------------------------- */
            if ($unit->owner_job_position_id === $position->id) {
                $roles[] = 'd.manage.' . $unit->id;
            }

            /* ---------------------------------------------
             | POSITION ROLES
             |--------------------------------------------- */
            foreach ($position->roles as $role) {
                $roles[] = 'p.execute.' . $role->code;
            }

            /* ---------------------------------------------
             | ATTRIBUTES → APPROVAL
             |--------------------------------------------- */
            foreach ($position->attributes as $attr) {
                if ($attr->code === 'approval_scope') {
                    $roles[] = 'p.approve.' . $attr->value;
                }
            }
        }

        /* =====================================================
         | ORG LEVEL ATTRIBUTES
         |===================================================== */
        foreach ($staff->attributes as $attr) {
            if ($attr->code === 'org_admin' && $attr->value === 'true') {
                $roles[] = 'o.manage.all';
            }
        }

        return array_values(array_unique($roles));
    }
}