<?php

/* ============================================================
 | database/seeders/ApiConfigSeeder.php
 |============================================================ */

namespace Database\Seeders;

use Bites\Platform\Sync\Models\ApiConfig;
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
            ['name' => 'External Employees'],
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
                        'table' => 'employees',
                        'path' => '',
                        'many' => true,
                        'unique_by' => 'external_id',

                        'fields' => [
                            ['from' => 'emp_id', 'to' => 'external_id'],
                            ['from' => 'full_name', 'to' => 'name'],
                            ['from' => 'department_code', 'to' => 'department_code'],
                        ],
                    ],
                ],

                'active' => true,
            ]
        );
        ApiConfig::updateOrCreate(
            ['name' => 'External Departments'],
            [
                'source_type' => 'database',

                'source_config' => [
                    'connection' => 'external_hr',
                    'query' => '
                SELECT *
                FROM HrmDepartment
                ORDER BY uuid
            ',
                ],

                'data_path' => null,

                'mapping' => [
                    [
                        'table' => 'departments',
                        'path' => '',
                        'many' => true,
                        'unique_by' => 'external_id',

                        'fields' => [
                            ['from' => 'uuid', 'to' => 'external_id'],
                            ['from' => 'code', 'to' => 'code'],
                            ['from' => 'name', 'to' => 'name'],
                        ],
                    ],
                ],

                'active' => true,
            ]
        );
        ApiConfig::updateOrCreate(
            ['name' => 'External Locations'],
            [
                'source_type' => 'database',

                'source_config' => [
                    'connection' => 'external_hr',
                    'query' => '
                SELECT *
                FROM HrmLocations
                ORDER BY uuid
            ',
                ],

                'data_path' => null,

                'mapping' => [
                    [
                        'table' => 'locations',
                        'path' => '',
                        'many' => true,
                        'unique_by' => 'external_id',

                        'fields' => [
                            ['from' => 'uuid', 'to' => 'external_id'],
                            ['from' => 'name', 'to' => 'name'],
                            ['from' => 'region', 'to' => 'region'],
                        ],
                    ],
                ],

                'active' => true,
            ]
        );
        ApiConfig::updateOrCreate(
            ['name' => 'External Job Titles'],
            [
                'source_type' => 'database',

                'source_config' => [
                    'connection' => 'external_hr',
                    'query' => '
                SELECT *
                FROM HrmJobTitles
                ORDER BY uuid
            ',
                ],

                'data_path' => null,

                'mapping' => [
                    [
                        'table' => 'job_titles',
                        'path' => '',
                        'many' => true,
                        'unique_by' => 'external_id',

                        'fields' => [
                            ['from' => 'uuid', 'to' => 'external_id'],
                            ['from' => 'title', 'to' => 'title'],
                            ['from' => 'grade', 'to' => 'grade'],
                        ],
                    ],
                ],

                'active' => true,
            ]
        );
    }
}
