<?php

declare(strict_types=1);

namespace Bites\Foundation\Access\Concerns;

trait SavesAccessControl
{
    public static function bootSavesAccessControl(): void
    {
        static::saved(function ($model): void {
            if (! request()->has('access')) {
                return;
            }

            $model->accessControls()->delete();
            foreach (request('access') as $action => $roles) {
                foreach ($roles ?? [] as $role) {
                    $model->accessControls()->create([
                        'action' => $action,
                        'role' => $role,
                    ]);
                }
            }
        });
    }
}
