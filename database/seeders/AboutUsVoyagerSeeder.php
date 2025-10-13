<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\MenuItem;

class AboutUsVoyagerSeeder extends Seeder
{
    public function run()
    {
        // Only create About Us and Team Members data types
        // Skip Contact since you already have it configured

        $aboutUsDataType = DataType::firstOrCreate([
            'slug' => 'about-us',
        ], [
            'name' => 'about_us',
            'display_name_singular' => 'About Us',
            'display_name_plural' => 'About Us',
            'icon' => 'voyager-info-circled',
            'model_name' => 'App\\Models\\AboutUs',
        ]);

        $teamDataType = DataType::firstOrCreate([
            'slug' => 'team-members',
        ], [
            'name' => 'team_members',
            'display_name_singular' => 'Team Member',
            'display_name_plural' => 'Team Members',
            'icon' => 'voyager-people',
            'model_name' => 'App\\Models\\TeamMember',
        ]);

        // Create menu items with the url field
        MenuItem::firstOrCreate([
            'menu_id' => 1,
            'title' => 'About Us',
            'route' => 'voyager.about-us.index',
        ], [
            'url' => '',
            'target' => '_self',
            'icon_class' => 'voyager-info-circled',
            'color' => null,
            'parent_id' => null,
            'order' => 1,
        ]);

        MenuItem::firstOrCreate([
            'menu_id' => 1,
            'title' => 'Team Members',
            'route' => 'voyager.team-members.index',
        ], [
            'url' => '',
            'target' => '_self',
            'icon_class' => 'voyager-people',
            'color' => null,
            'parent_id' => null,
            'order' => 2,
        ]);
    }
}
