<?php

namespace App\Models;

use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table = 'Collections';
    use Searchable;
    protected $guarded = [];

          /**
     * Get the index name for the model.
     *
     * @return array
     */


    public function searchableAs()
    {
        return 'Collections';
    }
    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }

   
}
