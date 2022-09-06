<?php

namespace Database\Seeders;

use App\Models\Unit;
use App\Models\User;
use App\Models\Category;
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
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Hendy Prathama',
            'email' => 'hendy.prathama@fnc.co.id',
            'password' => '$2y$10$6NOogCtF2RGKdQjhIEfq5.ZWdW1BJj6DWDV1xwo2mePZX0ADfVDAO', //Hendy123
            'role' => 1,
            'is_active' => 1,
        ]);    
        
        Unit::create([
            'unit' => 'can',
        ]);    
        
        Unit::create([
            'unit' => 'jerry can',
        ]);    
        
        Unit::create([
            'unit' => 'kilogram',
        ]);
        
        Unit::create([
            'unit' => 'meter',
        ]);        

        Unit::create([
            'unit' => 'pack',
        ]);        

        Unit::create([
            'unit' => 'pcs',
        ]);                

        Unit::create([
            'unit' => 'roll',
        ]);
        
        Unit::create([
            'unit' => 'set',
        ]);    
        
        Unit::create([
            'unit' => 'unit',
        ]);                    

        Category::create([
            'category' => 'Electrical',
            'slug' => 'electrical'
        ]);

        Category::create([
            'category' => 'Mechanical',
            'slug' => 'mechanical'
        ]);

        Category::create([
            'category' => 'Civil',
            'slug' => 'civil'
        ]);

        Category::create([
            'category' => 'Sanitary',
            'slug' => 'sanitary'
        ]);

        Category::create([
            'category' => 'Desktop PC',
            'slug' => 'desktop-pc'
        ]);

        Category::create([
            'category' => 'Monitor and TV',
            'slug' => 'monitor-and-tv'
        ]);

        Category::create([
            'category' => 'Computer Accesories',
            'slug' => 'computer-accesories'
        ]);

        Category::create([
            'category' => 'Laptop',
            'slug' => 'laptop'
        ]);

        Category::create([
            'category' => 'Printer and Scanner',
            'slug' => 'printer-and-scanner'
        ]);

        Category::create([
            'category' => 'Network Equipment',
            'slug' => 'network-equipment'
        ]);
    }
}
