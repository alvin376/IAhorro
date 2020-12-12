<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Record;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	Employee::factory(10)->create();
    	Record::factory(30)->create();
    }
}
