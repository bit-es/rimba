<?php

/* ============================================================
 | database/seeders/ApiConfigSeeder.php
 |============================================================ */

namespace Database\Seeders;

use Bites\Platform\Sync\Entities\ApiConfig;
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
            ['name' => 'External Employees Database'],
            [
                'source_type' => 'database',
                'source_config' => [
                    'connection' => 'external_hr',
                    'query' => '
SELECT
  (
    SELECT * FROM HrmDepartment ORDER BY uuid
    FOR JSON PATH
  ) AS departments,
  (
    SELECT * FROM HrmLocations ORDER BY uuid
    FOR JSON PATH
  ) AS locations,
  (
    SELECT * FROM HrmJobTitles ORDER BY uuid
    FOR JSON PATH
  ) AS job_titles
FOR JSON PATH, WITHOUT_ARRAY_WRAPPER;
                    ',
                ],

                // DB results already return rows
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
    }
}
