<?php

namespace App\Models;

use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;

class Livestream extends Model
{

    use Searchable;
    protected $guarded = [];
    protected $table = 'Livestream';

    /**
     * Get the index name for the model.
     *
     * @return array
     */

    public function searchableAs()
    {
        return 'Livestream';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }



}