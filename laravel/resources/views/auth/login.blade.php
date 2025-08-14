<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
    <style>
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Cantarell,Noto Sans,sans-serif;margin:0}
    .container{max-width:480px;margin:24px auto;padding:16px}
    label{display:block;margin-bottom:8px}
    input{width:100%;padding:8px;border:1px solid #ddd;border-radius:6px}
    button{background:#111;color:#fff;border:none;padding:8px 12px;border-radius:6px;cursor:pointer;margin-top:8px}
    a{color:#0366d6;text-decoration:none}
    </style>
</head>
<body>
<main class="container">
	<h2>Login</h2>
	<form method="POST" action="{{ route('login.attempt') }}">
		@csrf
		<label>E-mail
			<input type="email" name="email" value="{{ old('email') }}" required>
		</label>
		@error('email')<small style="color:red">{{ $message }}</small>@enderror
		<label>Senha
			<input type="password" name="password" required>
		</label>
		<label>
			<input type="checkbox" name="remember"> Lembrar-me
		</label>
		<button type="submit">Entrar</button>
	</form>
	<p>Não tem conta? <a href="{{ route('register') }}">Cadastre-se</a></p>
</main>
</body>
</html>


