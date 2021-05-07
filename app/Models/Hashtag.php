<?php

namespace App\Models;

use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{

    protected $guarded = [];
    protected $table = 'Hashtags';

    /**
     * Get the index name for the model.
     *
     * @return array
     */

    public function searchableAs()
    {
        return 'Hashtags';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }



}