<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SearchableRouteSeeder extends Seeder
{
    public function run()
    {
        DB::table('searchable_routes')->insert([
            'name' => 'home',
            'route' => '/',
            'description' => 'Go to home page'
        ]);

        DB::table('searchable_routes')->insert([
            'name' => 'archived',
            'route' => '/archived',
            'description' => 'Get the Archived list'
        ]);

        DB::table('searchable_routes')->insert([
            'name' => 'hidden',
            'route' => '/hidden',
            'description' => 'See the list of hidden markers'
        ]);

        DB::table('searchable_routes')->insert([
            'name' => 'tags',
            'route' => '/tags',
            'description' => 'Get all the tags'
        ]);

        [, $sections] = Section::getStandardList();
        foreach ($sections as $section) {
            $route = Str::of(route('section', [Str::slug($section)]))
                ->replace(config('app.url'), '')
                ->toString();

            DB::table('searchable_routes')->insert([
                'name' => strtolower($section),
                'route' => $route,
                'description' => "List of Markers in the $section section"
            ]);
        }
    }
}
