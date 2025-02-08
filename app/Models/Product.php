<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'created_by',
        'title',
        'author',
        'language',
        'short_description',
        'long_description',
        'price',
        'version',
        'extra_information',
        'width',
        'height',
        'depth',
        'weight',
        'picture_one',
        'picture_two',
        'picture_three',
        'picture_four',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function categories() 
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id')
        ->withTimestamps();
    }

}
