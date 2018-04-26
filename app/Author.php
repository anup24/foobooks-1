<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    /*
     * Define the one to many relationship with authors
     */
    public function books()
    {
        # Author has many Books
        # Define a one-to-many relationship.
        return $this->hasMany('App\Book');
    }

    /**
     * Return an array of authors where key = author id and value = authors name
     */
    public static function getForDropdown()
    {
        $authors = self::orderBy('last_name')->get();

        $authorsForDropdown = [];
        foreach ($authors as $author) {
            $authorsForDropdown[$author->id] = $author->getFullName($reverse = true);
        }

        return $authorsForDropdown;
    }

    /*
     * Return authors full name
     */
    public function getFullName($reverse = false) {
        if($reverse) {
            return $this->last_name . ', ' . $this->first_name;
        } else {
            return $this->first_name.' '.$this->last_name;
        }
    }

}
