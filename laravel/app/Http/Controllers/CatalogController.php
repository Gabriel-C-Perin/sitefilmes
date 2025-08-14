<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;

class CatalogController extends Controller
{
	public function index(Request $request)
	{
		$categories = Category::orderBy('name')->get();
		$moviesQuery = Movie::with('category')->orderByDesc('created_at');

		if ($request->filled('year')) {
			$moviesQuery->where('year', $request->integer('year'));
		}

		if ($request->filled('category_id')) {
			$moviesQuery->where('category_id', $request->integer('category_id'));
		}

		$movies = $moviesQuery->paginate(12)->withQueryString();

		return view('catalog.index', compact('movies', 'categories'));
	}

	public function show(Movie $movie)
	{
		return view('catalog.show', compact('movie'));
	}
}
