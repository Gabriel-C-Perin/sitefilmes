<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
	public function index()
	{
		$movies = Movie::with('category')->orderByDesc('created_at')->paginate(10);
		return view('admin.movies.index', compact('movies'));
	}

    /**
     * Show the form for creating a new resource.
     */
	public function create()
	{
		$categories = Category::orderBy('name')->pluck('name', 'id');
		return view('admin.movies.create', compact('categories'));
	}

    /**
     * Store a newly created resource in storage.
     */
	public function store(Request $request)
	{
		$validated = $request->validate([
			'name' => ['required', 'string', 'max:255'],
			'synopsis' => ['required', 'string'],
			'year' => ['required', 'integer', 'between:1888,' . (int)date('Y')],
			'category_id' => ['required', 'exists:categories,id'],
			'cover_image' => ['nullable', 'image', 'max:2048'],
			'trailer_url' => ['nullable', 'url'],
		]);

		$movieData = collect($validated)->except('cover_image')->toArray();

		if ($request->hasFile('cover_image')) {
			$path = $request->file('cover_image')->store('covers', 'public');
			$movieData['cover_image_path'] = $path;
		}

		$movie = Movie::create($movieData);

		return redirect()->route('admin.movies.edit', $movie)->with('success', 'Filme criado com sucesso.');
	}

    /**
     * Display the specified resource.
     */
	public function show(Movie $movie)
	{
		return redirect()->route('admin.movies.edit', $movie);
	}

    /**
     * Show the form for editing the specified resource.
     */
	public function edit(Movie $movie)
	{
		$categories = Category::orderBy('name')->pluck('name', 'id');
		return view('admin.movies.edit', compact('movie', 'categories'));
	}

    /**
     * Update the specified resource in storage.
     */
	public function update(Request $request, Movie $movie)
	{
		$validated = $request->validate([
			'name' => ['required', 'string', 'max:255'],
			'synopsis' => ['required', 'string'],
			'year' => ['required', 'integer', 'between:1888,' . (int)date('Y')],
			'category_id' => ['required', 'exists:categories,id'],
			'cover_image' => ['nullable', 'image', 'max:2048'],
			'trailer_url' => ['nullable', 'url'],
		]);

		$movieData = collect($validated)->except('cover_image')->toArray();

		if ($request->hasFile('cover_image')) {
			if ($movie->cover_image_path) {
				Storage::disk('public')->delete($movie->cover_image_path);
			}
			$path = $request->file('cover_image')->store('covers', 'public');
			$movieData['cover_image_path'] = $path;
		}

		$movie->update($movieData);

		return redirect()->route('admin.movies.index')->with('success', 'Filme atualizado com sucesso.');
	}

    /**
     * Remove the specified resource from storage.
     */
	public function destroy(Movie $movie)
	{
		if ($movie->cover_image_path) {
			Storage::disk('public')->delete($movie->cover_image_path);
		}
		$movie->delete();
		return redirect()->route('admin.movies.index')->with('success', 'Filme excluído com sucesso.');
	}
}
