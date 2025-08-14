<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Movie;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed some categories
        $categories = collect(['Ação', 'Drama', 'Comédia', 'Ficção Científica', 'Terror'])
            ->map(fn ($name) => Category::firstOrCreate(['name' => $name]));

        // Optionally create sample movies if factory exists
        if (class_exists(\Database\Factories\MovieFactory::class)) {
            Movie::factory()
                ->count(15)
                ->state(function () use ($categories) {
                    return [
                        'category_id' => $categories->random()->id,
                    ];
                })
                ->create();
        }

        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => 'admin',
                'is_admin' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@user.com'],
            [
                'name' => 'userteste',
                'password' => 'user',
                'is_admin' => false,
            ]
        );
    }
}
