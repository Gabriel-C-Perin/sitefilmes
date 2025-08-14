<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasFactory;

	protected $fillable = [
		'name',
		'synopsis',
		'year',
		'category_id',
		'cover_image_path',
		'trailer_url',
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}
}
