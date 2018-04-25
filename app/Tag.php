<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function books()
    {
        # With timestamps() will ensure the pivot table has its created_at/updated_at fields automatically maintained
        return $this->belongsToMany('App\Book')->withTimestamps();
    }

    public static function getForCheckboxes()
    {
        $tags = self::orderBy('name')->get();

        $tagsForCheckboxes = [];

        foreach($tags as $tag) {
            $tagsForCheckboxes[$tag->id] = $tag->name;
        }

        return $tagsForCheckboxes;
    }
}
