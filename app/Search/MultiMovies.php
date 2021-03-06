<?php

namespace App\Search;

use Algolia\ScoutExtended\Searchable\Aggregator;

class MultiMovies extends Aggregator
{
    /**
     * The names of the models that should be aggregated.
     *
     * @var string[]
     */
    protected $models = [
        \App\Models\Movie::class,
        \App\Models\Genre::class,
        \App\Models\Collection::class,
        \App\Models\User::class,
        \App\Models\Livestream::class
    ];
}
