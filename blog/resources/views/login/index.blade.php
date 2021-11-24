<!DOCTYPE html>
<html lang="pt-br">
    <Head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="stylesheet" href="../reset.css">
        <link rel="shortcut icon" href="{{url('/imagem/arrowMobe.png')}}" type="image/x-icon">
        <Title>RHWEB | Login - Sistemas inteligentes</Title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link rel="stylesheet" href="{{url('/css/login.css')}}"/>
        <link rel="stylesheet" href="{{url('/css/loginVariaveis.css')}}">
    </Head>

    <body class=" mb-5 responsive d-flex justify-content-center align-items-center mt-5" >
    <main class="login">
    <div class="login__container">

<img class="imagem__logo" src="{{url('/imagem/RHWEBlogin.png')}}" alt="" >

<h1 class="login__title">Login</h1>
@error('mensagem')
    <div class="alert alert-danger">
        {{$message}}
    </div>
@enderror
<form class="login__form"  action="{{ route('login.store') }}" method="POST">
    @csrf
    <input class="login__input usuario @error('user') is-invalid @enderror" type="text" name="user" value="" placeholder="Usuário">
    @error('user')
        <span class="alert alert-danger mt-1">{{ $message }}</span>
    @enderror
    <span class="login__input--border"></span>

    <input class="login__input senha  @error('password') is-invalid @enderror" type="password" name="password" value="" placeholder="Senha" >
    @error('password')
        <span class="alert alert-danger mt-1">{{ $message }}</span>
    @enderror
    <span class="login__input--border"></span>

    <button  class="login__submit">Entrar</button>

</form>   
    </div>
    </main>
   
       
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>

    </html>