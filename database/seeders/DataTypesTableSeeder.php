<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DataTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_types')->delete();
        
        \DB::table('data_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'users',
                'slug' => 'users',
                'display_name_singular' => 'User',
                'display_name_plural' => 'Users',
                'icon' => 'voyager-person',
                'model_name' => 'TCG\\Voyager\\Models\\User',
                'policy_name' => 'TCG\\Voyager\\Policies\\UserPolicy',
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => NULL,
                'created_at' => '2023-09-27 14:52:37',
                'updated_at' => '2023-09-27 14:52:37',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'menus',
                'slug' => 'menus',
                'display_name_singular' => 'Menu',
                'display_name_plural' => 'Menus',
                'icon' => 'voyager-list',
                'model_name' => 'TCG\\Voyager\\Models\\Menu',
                'policy_name' => NULL,
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => NULL,
                'created_at' => '2023-09-27 14:52:37',
                'updated_at' => '2023-09-27 14:52:37',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'roles',
                'slug' => 'roles',
                'display_name_singular' => 'Role',
                'display_name_plural' => 'Roles',
                'icon' => 'voyager-lock',
                'model_name' => 'TCG\\Voyager\\Models\\Role',
                'policy_name' => NULL,
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => NULL,
                'created_at' => '2023-09-27 14:52:37',
                'updated_at' => '2023-09-27 14:52:37',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'tournaments',
                'slug' => 'tournaments',
                'display_name_singular' => 'Torneo',
                'display_name_plural' => 'Torneos',
                'icon' => 'fa-solid fa-trophy',
                'model_name' => 'App\\Models\\Tournament',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2023-09-27 17:06:40',
                'updated_at' => '2023-09-28 13:41:45',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'tournaments_categories',
                'slug' => 'tournaments-categories',
                'display_name_singular' => 'Tipo de Torneo',
                'display_name_plural' => 'Tipos de Torneos',
                'icon' => 'voyager-categories',
                'model_name' => 'App\\Models\\TournamentsCategory',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2023-09-27 19:33:22',
                'updated_at' => '2023-09-30 03:13:07',
            ),
            5 => 
            array (
                'id' => 10,
                'name' => 'dojos',
                'slug' => 'dojos',
                'display_name_singular' => 'Dojo',
                'display_name_plural' => 'Dojos',
                'icon' => 'voyager-pirate-swords',
                'model_name' => 'App\\Models\\Dojo',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2023-09-27 21:31:25',
                'updated_at' => '2023-09-27 21:33:05',
            ),
            6 => 
            array (
                'id' => 11,
                'name' => 'referees',
                'slug' => 'referees',
                'display_name_singular' => 'Arbitro',
                'display_name_plural' => 'Arbitros',
                'icon' => 'voyager-alarm-clock',
                'model_name' => 'App\\Models\\Referee',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2023-09-27 21:51:55',
                'updated_at' => '2023-09-27 21:53:50',
            ),
        ));
        
        
    }
}