<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->insert([
            'name' => 'Mira Code',
            'category' =>'landing',
            'url' => 'https://miracode.app',
        ]);
        DB::table('projects')->insert([
            'name' => 'Chloe Lee',
            'category' =>'landing',
            'url' => 'https://chloelee.miracode.app/',
        ]);
        DB::table('projects')->insert([
            'name' => '5G Counsultancy',
            'category' =>'landing',
            'url' => 'https://5gconsultancy.com/',
        ]);
        DB::table('projects')->insert([
            'name' => 'O2gether',
            'category' =>'landing',
            'url' => 'https://o2getherevent.com/',
        ]);
        DB::table('projects')->insert([
            'name' => 'Lays Brother',
            'category' =>'landing',
            'url' => 'https://laysbrother.com/#',
        ]);
        
    }
}
