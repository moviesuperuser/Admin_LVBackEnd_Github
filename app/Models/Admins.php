<?php

namespace App\Models;

use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{

    protected $guarded = [];
    protected $table = 'Admins';

    /**
     * Get the index name for the model.
     *
     * @return array
     */

    public function searchableAs()
    {
        return 'Admins';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }



}