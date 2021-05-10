<?php

namespace App\Models;

use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;

class Moderators extends Model
{

    protected $guarded = [];
    protected $table = 'Moderators';

    /**
     * Get the index name for the model.
     *
     * @return array
     */

    public function searchableAs()
    {
        return 'Moderators';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }



}