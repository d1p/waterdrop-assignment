<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Scout\Searchable;

class Dog extends Model
{
    use HasFactory;
    use Searchable;
    protected $fillable = [
        'data'
    ];

    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    public function searchableAs()
    {
        return 'dogs_index';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // extract json data from the data column and add it as a top level key
        $array['name'] = $this->data['name'];

        // remove the data column
        unset($array['data']);

        return $array;
    }
}
