<?php


namespace App\Models;

use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model 
{
    protected $table = 'Genres';
    use Searchable;
    protected $guarded = [];

      /**
     * Get the index name for the model.
     *
     * @return array
     */

    public function searchableAs()
    {
        return 'Genres';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }

}

