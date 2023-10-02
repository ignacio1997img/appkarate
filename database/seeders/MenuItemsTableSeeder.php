<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menu_items')->delete();
        
        \DB::table('menu_items')->insert(array (
            0 => 
            array (
                'id' => 1,
                'menu_id' => 1,
                'title' => 'Inicio',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-home',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 1,
                'created_at' => '2023-09-27 14:52:37',
                'updated_at' => '2023-09-27 16:45:01',
                'route' => 'voyager.dashboard',
                'parameters' => 'null',
            ),
            1 => 
            array (
                'id' => 2,
                'menu_id' => 1,
                'title' => 'Media',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-images',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 4,
                'created_at' => '2023-09-27 14:52:37',
                'updated_at' => '2023-09-27 16:46:21',
                'route' => 'voyager.media.index',
                'parameters' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'menu_id' => 1,
                'title' => 'Usuarios',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-person',
                'color' => '#000000',
                'parent_id' => 14,
                'order' => 1,
                'created_at' => '2023-09-27 14:52:37',
                'updated_at' => '2023-09-27 16:45:55',
                'route' => 'voyager.users.index',
                'parameters' => 'null',
            ),
            3 => 
            array (
                'id' => 4,
                'menu_id' => 1,
                'title' => 'Roles',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-lock',
                'color' => NULL,
                'parent_id' => 14,
                'order' => 2,
                'created_at' => '2023-09-27 14:52:37',
                'updated_at' => '2023-09-27 16:45:43',
                'route' => 'voyager.roles.index',
                'parameters' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'menu_id' => 1,
                'title' => 'Herramientas',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-tools',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 7,
                'created_at' => '2023-09-27 14:52:37',
                'updated_at' => '2023-10-02 20:24:36',
                'route' => NULL,
                'parameters' => '',
            ),
            5 => 
            array (
                'id' => 6,
                'menu_id' => 1,
                'title' => 'Menu Builder',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-list',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 1,
                'created_at' => '2023-09-27 14:52:37',
                'updated_at' => '2023-09-27 16:46:21',
                'route' => 'voyager.menus.index',
                'parameters' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'menu_id' => 1,
                'title' => 'Database',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-data',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 2,
                'created_at' => '2023-09-27 14:52:37',
                'updated_at' => '2023-09-27 16:46:21',
                'route' => 'voyager.database.index',
                'parameters' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'menu_id' => 1,
                'title' => 'Compass',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-compass',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 3,
                'created_at' => '2023-09-27 14:52:37',
                'updated_at' => '2023-09-27 16:46:21',
                'route' => 'voyager.compass.index',
                'parameters' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'menu_id' => 1,
                'title' => 'BREAD',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-bread',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 5,
                'created_at' => '2023-09-27 14:52:37',
                'updated_at' => '2023-09-27 16:46:18',
                'route' => 'voyager.bread.index',
                'parameters' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'menu_id' => 1,
                'title' => 'Configuraciones',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-settings',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 8,
                'created_at' => '2023-09-27 14:52:37',
                'updated_at' => '2023-10-02 20:24:36',
                'route' => 'voyager.settings.index',
                'parameters' => 'null',
            ),
            10 => 
            array (
                'id' => 14,
                'menu_id' => 1,
                'title' => 'Seguridad',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-lock',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 6,
                'created_at' => '2023-09-27 16:45:29',
                'updated_at' => '2023-10-02 20:24:36',
                'route' => NULL,
                'parameters' => '',
            ),
            11 => 
            array (
                'id' => 15,
                'menu_id' => 1,
                'title' => 'Torneos',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'fa-solid fa-trophy',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 2,
                'created_at' => '2023-09-27 17:06:40',
                'updated_at' => '2023-09-27 18:00:46',
                'route' => 'voyager.tournaments.index',
                'parameters' => 'null',
            ),
            12 => 
            array (
                'id' => 16,
                'menu_id' => 1,
                'title' => 'Tipos de Torneos',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-categories',
                'color' => '#000000',
                'parent_id' => 17,
                'order' => 2,
                'created_at' => '2023-09-27 19:33:22',
                'updated_at' => '2023-09-30 03:12:41',
                'route' => 'voyager.tournaments-categories.index',
                'parameters' => 'null',
            ),
            13 => 
            array (
                'id' => 17,
                'menu_id' => 1,
                'title' => 'Parametros',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-params',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 5,
                'created_at' => '2023-09-27 20:54:33',
                'updated_at' => '2023-10-02 20:24:36',
                'route' => NULL,
                'parameters' => '',
            ),
            14 => 
            array (
                'id' => 19,
                'menu_id' => 1,
                'title' => 'Dojos',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-pirate-swords',
                'color' => NULL,
                'parent_id' => 17,
                'order' => 1,
                'created_at' => '2023-09-27 21:31:25',
                'updated_at' => '2023-09-27 21:31:41',
                'route' => 'voyager.dojos.index',
                'parameters' => NULL,
            ),
            15 => 
            array (
                'id' => 21,
                'menu_id' => 1,
                'title' => 'Arbitros',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'fa-solid fa-person',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 4,
                'created_at' => '2023-10-02 20:08:57',
                'updated_at' => '2023-10-02 20:24:36',
                'route' => 'voyager.referees.index',
                'parameters' => 'null',
            ),
            16 => 
            array (
                'id' => 22,
                'menu_id' => 1,
                'title' => 'Categorías',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'fa-solid fa-list',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 3,
                'created_at' => '2023-10-02 20:24:19',
                'updated_at' => '2023-10-02 20:24:58',
                'route' => 'tournaments.type',
                'parameters' => 'null',
            ),
        ));
        
        
    }
}