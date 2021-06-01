<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get the database name, database username, database password
        $user   = \Config::get('database.connections.mysql.username');
        $db     = \Config::get('database.connections.mysql.database');

        //PATH OF SQL FILE
        $path = 'database/seeds/rooms.sql';

        // running command line import in php code
        //mysql -u username -p password database_name < file.sql
        exec("mysql -u {$user} -p {$db} < {$path}");

        //REF : https://stackoverflow.com/questions/25906199/laravel-seeding-large-sql-file/25907181

    }
}
