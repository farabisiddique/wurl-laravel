<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Domain;

class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        //first truncate the table to avoid duplicate entries
        Domain::truncate();
        $domains = [
            ['domain_name' => 'wurl.io', 'is_active' => true],
        ];

        foreach ($domains as $domain) {
            Domain::create($domain);
        }    
    
    }
}
