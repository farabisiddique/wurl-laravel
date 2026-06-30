<?php

namespace Database\Seeders;

use App\Models\Domain;
use Illuminate\Database\Seeder;

class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $domains = [
            ['domain_name' => 'wurl.io', 'is_active' => true],
            ['domain_name' => 'wurl.com', 'is_active' => true],
        ];

        foreach ($domains as $domain) {
            Domain::firstOrCreate(['domain_name' => $domain['domain_name']], $domain);
        }
    }
}
