<?php

/* ============================================================
 | database/seeders/ApiConfigSeeder.php
 |============================================================ */

namespace Database\Seeders;

use App\Models\Business\Hrm\Models\JobTitle;
use App\Models\Job\JobContract;
use App\Models\Job\JobPosition;
use App\Models\Ppl\Staff;
use App\Models\Org\OrgCorp;
use App\Models\Org\OrgUnit;
use App\Models\Support\Sync\ApiConfig;
use Illuminate\Database\Seeder;

class ApiConfigSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * ------------------------------------------------
         * Example 1: REST API – Orders with Items
         * ------------------------------------------------
         */
        ApiConfig::updateOrCreate(
            ['name' => 'Sample Orders API'],
            [
                'source_type' => 'rest',
                'source_config' => [
                    'url' => 'https://raw.githubusercontent.com/bit-es/curio/refs/heads/main/test.json',
                    'headers' => [
                        'Accept' => 'application/json',
                    ],
                ],

                // Where the list is inside the response
                'data_path' => 'data',

                // Mapping rules
                'mapping' => [
                    [
                        'table' => 'orders',
                        'path' => '',
                        'many' => false,
                        'unique_by' => 'external_id',

                        'fields' => [
                            ['from' => 'id', 'to' => 'external_id'],
                            ['from' => 'customer_name', 'to' => 'customer_name'],
                            ['from' => 'total', 'to' => 'total_amount'],
                        ],

                        'children' => [
                            [
                                'table' => 'order_items',
                                'path' => 'items',
                                'many' => true,
                                'foreign_key' => 'order_id',

                                'fields' => [
                                    ['from' => 'sku', 'to' => 'sku'],
                                    ['from' => 'qty', 'to' => 'quantity'],
                                    ['from' => 'price', 'to' => 'unit_price'],
                                ],
                            ],
                        ],
                    ],
                ],

                'active' => true,
            ]
        );

        /**
         * ------------------------------------------------
         * Example 2: REST API – Users (Flat structure)
         * ------------------------------------------------
         */
        ApiConfig::updateOrCreate(
            ['name' => 'Sample Users API'],
            [
                'source_type' => 'rest',
                'source_config' => [
                    'url' => 'https://api.example.com/users',
                ],

                'data_path' => 'users',

                'mapping' => [
                    [
                        'table' => 'users',
                        'path' => '',
                        'many' => true,
                        'unique_by' => 'email',

                        'fields' => [
                            ['from' => 'name', 'to' => 'name'],
                            ['from' => 'email', 'to' => 'email'],
                            ['from' => 'phone', 'to' => 'phone'],
                        ],
                    ],
                ],

                'active' => true,
            ]
        );

        /**
         * ------------------------------------------------
         * Example 3: Database Source – External Employees
         * ------------------------------------------------
         */
        ApiConfig::updateOrCreate(
            ['name' => 'HRDB(Weaver) Employees'],
            [
                'source_type' => 'database',

                'source_config' => [
                    'connection' => 'external_hr',
                    'query' => '
            SELECT
                r.*,
                d.uuid AS department_uuid,
                j.uuid AS job_title_uuid,
                l.uuid AS location_uuid,
                m.uuid AS manager_uuid,
                c.*
            FROM HrmResource r
            LEFT JOIN HrmDepartment d ON r.departmentid = d.id
            LEFT JOIN HrmJobTitles j ON r.jobtitle = j.id
            LEFT JOIN HrmLocations l ON r.locationid = l.id
            LEFT JOIN HrmResource m ON r.managerid = m.id
            LEFT JOIN cus_fielddata c ON r.id = c.id
            WHERE r.workcode IS NOT NULL
            ORDER BY r.uuid
            ',
                ],
                // DB returns rows directly
                'data_path' => null,
                'mapping' => [
                    [
                        'table' => 'staff',
                        'model' => JobContract::class,
                        'path' => '',
                        'many' => true,
                        'unique_by' => 'uuid',
                        'add_extra' => true,
                        'fields' => [
                            ['from' => 'uuid', 'to' => 'uuid'],
                            ['from' => 'companystartdate', 'to' => 'start_date'],
                            ['from' => 'workenddate', 'to' => 'end_date'],
                            ['from' => 'workcode', 'to' => 'employee_no'],
                            ['value' => 'FTE', 'to' => 'contract_type'],
                            // ['from' => 'department_uuid', 'to' => 'department_uuid'],
                            // ['from' => 'job_title_uuid', 'to' => 'job_title_uuid'],
                            // ['from' => 'location_uuid', 'to' => 'location_uuid'],
                            ['from' => 'manager_uuid', 'to' => 'manager_uuid'],
                            [
                                'from' => 'job_title_uuid',
                                'to' => 'job_title_id',
                                'do' => [
                                    'query' => 'SELECT id FROM job_titles WHERE uuid = ?',
                                    'bindings' => ['$value'],
                                    'column' => 'id'
                                ],
                            ],
                            [
                                'from' => 'location_uuid',
                                'to' => 'issuing_org_corp_id',
                                'do' => [
                                    'query' => 'SELECT id FROM org_corps WHERE uuid = ?',
                                    'bindings' => ['$value'],
                                    'column' => 'id'
                                ],
                            ],
                        ],
                        'children' => [

                            // ==========================================================
                            // STAFF
                            // ==========================================================
                            [
                                'model' => Staff::class,
                                'unique_by' => 'full_name',
                                'add_extra' => true,
                                'fields' => [
                                    ['from' => 'lastname',   'to' => 'name'],
                                    ['from' => 'workcode',   'to' => 'staff_no'],
                                    ['value' => 'FTE',       'to' => 'type'],
                                    ['from' => 'field8',    'to' => 'shift_code'],
                                    [
                                        'from' => 'location_uuid',
                                        'to' => 'org_corp_id',
                                        'do' => [
                                            'query' => 'SELECT id FROM org_corps WHERE uuid = ?',
                                            'bindings' => ['$value'],
                                            'column' => 'id'
                                        ],
                                    ],
                                ],

                                // 👈 inject Staff ID into JobContract.staff_id
                                'parent_key' => 'staff_id',
                                'foreign_key' => 'job_contract_id',
                            ],

                            // ==========================================================
                            // JOB POSITION
                            // ==========================================================
                            [
                                'model' => JobPosition::class,

                                // Stable external identity for a position/title
                                'unique_by' => 'title',
                                'add_extra' => true,
                                'fields' => [
                                    ['from' => 'job_title_uuid', 'to' => 'title'],
                                    [
                                        'from' => 'department_uuid',
                                        'to' => 'org_unit_id',
                                        'do' => [
                                            'query' => 'SELECT id FROM org_units WHERE uuid = ?',
                                            'bindings' => ['$value'],
                                            'column' => 'id'
                                        ],
                                    ],
                                ],
                                'foreign_key' => 'job_contract_id',
                            ],
                        ],

                    ],

                ],

                'active' => true,
            ]
        );
        ApiConfig::updateOrCreate(
            ['name' => 'HRDB(Weaver) Departments'],
            [
                'source_type' => 'database',

                'source_config' => [
                    'connection' => 'external_hr',
                    'query' => '
                SELECT *
                FROM HrmDepartment
                ORDER BY uuid',
                ],

                'data_path' => null,

                'mapping' => [
                    [
                        'table' => 'org_units',
                        'model' => OrgUnit::class,
                        'path' => '',
                        'many' => true,
                        'unique_by' => 'uuid',
                        'fields' => [
                            ['from' => 'uuid', 'to' => 'uuid'],
                            ['from' => 'departmentname', 'to' => 'name'],
                            [
                                'do' => [
                                    'artisan' => 'permission:create-role $value',
                                    'transform' => '@"d." . strtolower($from)',
                                ],
                                // 'from' => 'departmentname',
                                'from' => 'uuid',
                            ],
                        ],
                    ],
                ],

                'active' => true,
            ]
        );
        ApiConfig::updateOrCreate(
            ['name' => 'HRDB(Weaver) Organizations'],
            [
                'source_type' => 'database',

                'source_config' => [
                    'connection' => 'external_hr',
                    'query' => '
                SELECT *
                FROM HrmLocations
                ORDER BY uuid',
                ],

                'data_path' => null,

                'mapping' => [
                    [
                        'table' => 'locations',
                        'model' => OrgCorp::class,
                        'path' => '',
                        'many' => true,
                        'unique_by' => 'uuid',

                        'fields' => [
                            ['from' => 'uuid', 'to' => 'uuid'],
                            ['from' => 'locationname', 'to' => 'name'],
                            ['from' => 'locationdesc', 'to' => 'description'],
                            ['from' => 'uuid', 'to' => 'uuid'],
                            [
                                'do' => [
                                    'artisan' => 'permission:create-role $value',
                                    'transform' => '@"o." . strtolower($from)',
                                ],
                                // 'from' => 'locationname',
                                'from' => 'uuid',
                            ],
                        ],
                    ],
                ],

                'active' => true,
            ]
        );
        ApiConfig::updateOrCreate(
            ['name' => 'HRDB(Weaver) Job Titles'],
            [
                'source_type' => 'database',

                'source_config' => [
                    'connection' => 'external_hr',
                    'query' => '
                SELECT *
                FROM HrmJobTitles
                ORDER BY uuid',
                ],

                'data_path' => null,

                'mapping' => [
                    [
                        'table' => 'job_titles',
                        'model' => JobTitle::class,
                        'path' => '',
                        'many' => true,
                        'unique_by' => 'uuid',

                        'fields' => [
                            ['from' => 'uuid', 'to' => 'uuid'],
                            ['from' => 'jobtitlename', 'to' => 'title', 'regex' => '/^.*-/'],
                            ['from' => 'jobtitlename', 'to' => 'jobgrade', 'regex' => '/^[^-]+-(.*)-[^-]+$/'],
                            ['from' => 'jobtitlemark', 'to' => 'description'],
                        ],
                        'skip_if' => [
                            'field' => 'title',
                            'min_length' => 3,
                        ],
                    ],
                ],

                'active' => true,
            ]
        );
    }
}
