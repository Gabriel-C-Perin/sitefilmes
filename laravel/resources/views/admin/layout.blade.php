<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title', 'Admin - Filmes')</title>
    <style>
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Cantarell,Noto Sans,sans-serif;margin:0}
    .container{max-width:1000px;margin:0 auto;padding:16px}
    nav{display:flex;justify-content:space-between;align-items:center;margin-bottom:12px}
    nav ul{display:flex;gap:8px;list-style:none;padding:0;margin:0}
    a{color:#0366d6;text-decoration:none}
    table{width:100%;border-collapse:collapse}
    th,td{border:1px solid #e5e7eb;padding:8px;text-align:left}
    button,[role=button]{background:#111;color:#fff;border:none;padding:8px 12px;border-radius:6px;cursor:pointer}
    .secondary{background:#e5e7eb;color:#111}
    article.contrast{background:#eef7ee;border:1px solid #c6f6c6;padding:8px;border-radius:6px;margin-bottom:12px}
    img{max-width:100%}
    </style>
</head>
<body>
	<main class="container">
		<nav>
			<ul>
				<li><strong>Admin</strong></li>
			</ul>
			<ul>
				<li><a href="{{ route('admin.movies.index') }}">Filmes</a></li>
				<li><a href="{{ route('admin.categories.index') }}">Categorias</a></li>
				<li><a href="{{ route('catalog.index') }}">Catálogo</a></li>
				@auth
					<li><a href="{{ route('logout') }}" class="secondary">Sair</a></li>
				@else
					<li><a href="{{ route('login') }}">Entrar</a></li>
				@endauth
			</ul>
		</nav>

        @if(session('success'))
            <article class="contrast">{{ session('success') }}</article>
        @endif

		@yield('content')
	</main>
</body>
</html>


