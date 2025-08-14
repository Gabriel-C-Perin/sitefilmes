<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $movie->name }}</title>
    <style>
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Cantarell,Noto Sans,sans-serif;margin:0}
    .container{max-width:900px;margin:0 auto;padding:16px}
    a{color:#0366d6;text-decoration:none}
    .cover{max-width:300px;border-radius:8px}
    </style>
</head>
<body>
<main class="container">
    <nav>
        <ul>
            <li><a href="{{ route('catalog.index') }}">← Voltar</a></li>
        </ul>
        <ul>
            @auth
                <li><a href="{{ route('logout') }}" class="secondary">Sair</a></li>
            @else
                <li><a href="{{ route('login') }}">Entrar</a></li>
            @endauth
        </ul>
    </nav>

	<article>
		<h1>{{ $movie->name }}</h1>
		<p><small>{{ $movie->category?->name }} • {{ $movie->year }}</small></p>
		@if($movie->cover_image_path)
			<img class="cover" src="{{ asset('storage/' . $movie->cover_image_path) }}" alt="{{ $movie->name }}">
		@endif
		<p style="margin-top:1rem">{{ $movie->synopsis }}</p>

		@if($movie->trailer_url)
			<h3>Trailer</h3>
			@if(\Illuminate\Support\Str::contains($movie->trailer_url, 'youtube.com') || \Illuminate\Support\Str::contains($movie->trailer_url, 'youtu.be'))
				<div style="position:relative;padding-top:56.25%">
					<iframe src="{{ $movie->trailer_url }}" title="Trailer" frameborder="0" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%"></iframe>
				</div>
			@else
				<p><a href="{{ $movie->trailer_url }}" target="_blank">Assistir trailer</a></p>
			@endif
		@endif
	</article>
</main>
</body>
</html>


