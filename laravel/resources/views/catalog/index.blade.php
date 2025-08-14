<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Catálogo de Filmes</title>
    <style>
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Cantarell,Noto Sans,sans-serif;margin:0}
    .container{max-width:1100px;margin:0 auto;padding:16px}
    nav{display:flex;justify-content:space-between;align-items:center;margin-bottom:12px}
    nav ul{display:flex;gap:8px;list-style:none;padding:0;margin:0}
    a{color:#0366d6;text-decoration:none}
    .grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:12px}
    .card{border:1px solid #e5e7eb;padding:12px;border-radius:8px;background:#fff}
    .card img{width:100%;height:260px;object-fit:cover;border-radius:6px}
    label{display:block}
    input,select,button{padding:8px;border:1px solid #ddd;border-radius:6px}
    button{background:#111;color:#fff;border:none}
    </style>
</head>
<body>
<main class="container">
    <nav>
        <ul>
            <li><strong>Catálogo</strong></li>
        </ul>
        <ul>
		@if(auth()->user()->is_admin)
            <li><a href="{{ route('admin.movies.index') }}">Admin</a></li>
        @endif
            @auth
                <li><a href="{{ route('logout') }}" class="secondary">Sair</a></li>
            @else
                <li><a href="{{ route('login') }}">Entrar</a></li>
            @endauth
        </ul>
    </nav>

    <form method="GET" action="{{ route('catalog.index') }}" class="grid" style="grid-template-columns:1fr 1fr auto; align-items:end;">
		<label>Ano
			<input type="number" name="year" value="{{ request('year') }}" min="1888" max="{{ date('Y') }}">
		</label>
		<label>Categoria
			<select name="category_id">
				<option value="">Todas</option>
				@foreach($categories as $category)
					<option value="{{ $category->id }}" @selected(request('category_id')==$category->id)>{{ $category->name }}</option>
				@endforeach
			</select>
		</label>
		<button type="submit">Filtrar</button>
	</form>

	<section class="grid" style="margin-top:1rem">
		@foreach($movies as $movie)
			<article class="card">
				<a href="{{ route('catalog.show', $movie) }}">
					@if($movie->cover_image_path)
						<img src="{{ asset('storage/' . $movie->cover_image_path) }}" alt="{{ $movie->name }}">
					@else
						<img src="https://placehold.co/400x600?text=Sem+Capa" alt="placeholder">
					@endif
					<h3 style="margin:.5rem 0 0">{{ $movie->name }}</h3>
				</a>
				<small>{{ $movie->category?->name }} • {{ $movie->year }}</small>
			</article>
		@endforeach
	</section>

	{{ $movies->links() }}
</main>
</body>
</html>


