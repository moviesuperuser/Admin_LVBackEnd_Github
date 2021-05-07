<?php

namespace App\Models;

use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    use Searchable;
    protected $guarded = [];
    protected $table = 'Movies';

    /**
     * Get the index name for the model.
     *
     * @return array
     */

    public function searchableAs()
    {
        return 'Movies';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }



}