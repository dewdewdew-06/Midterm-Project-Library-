<?php
# https://laravel.com/docs/12.x/seeding
# for reference
# https://stackoverflow.com/questions/56670247/laravel-insert-seed-if-data-doesnt-already-exist
# database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //User::factory()->create([
        //    'name' => 'Test User',
        //    'email' => 'test@example.com',
        //]);

        // DB::table('users')->insert([
        //     [
        //         'name' => 'dewdewdew',
        //         'email' => 'dsutjiadi@somecompany.com',
        //         'password' => Hash::make('06_01_2004'),
        //     ],

        //     [
        //         'name' => 'unsmartest',
        //         'email' => 'iluvc4ts@somecompany.com',
        //         'password' => Hash::make('09_09_2006'),
        //     ]
        // ]);

        DB::table('authors')->insert([
            [
                'name' => 'raynArdian',
                'booksPublished' => 1
            ],

            [
                'name' => 'stereotypicalAddress',
                'booksPublished' => 2
            ]
        ]);

        DB::table('books')->insert([
            [
                'authorID' => 1,
                'name' => 'How to Not Commit Suicide',
                'releaseDate' => '1997-02-19',
                'genre' => 'Self-Improvement',
                'pages' => 67
            ],

            [
                'authorID' => 2,
                'name' => '99 Recipes',
                'releaseDate' => '2004-12-31',
                'genre' => 'Cooking',
                'pages' => 24
            ],

            [
                'authorID' => 2,
                'name' => '99 Ways to Extinguish a Fire in Your Home',
                'releaseDate' => '2005-07-19',
                'genre' => 'Self-Improvement',
                'pages' => 121
            ]
        ]);
    }
}