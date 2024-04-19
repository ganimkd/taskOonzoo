<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
            'category' => $this->category,
            'image' => $this->image,
            'rating' => [
                'rate' => $this->rating,
                'count' => $this->rating_count
            ]
        ];
    }

}
