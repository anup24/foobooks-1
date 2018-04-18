<?php

namespace App\Utilities;

use Artisan;

class Practice
{
    /*
    * Debugging/demo helper method to "blank slate" the database
    * Used when practicing queries
    */
    public static function resetDatabase()
    {
        dump('Clearing and re-seeding database');
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
    }
}