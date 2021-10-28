<!DOCTYPE html>
<html lang="pt-br">
    <Head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="stylesheet" href="../reset.css">
        <link rel="shortcut icon" href="../mobe.ico" type="image/x-icon">
        <Title>RHWEB | Login - Sistemas inteligentes</Title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    </Head>

    <body class=" mb-5 responsive d-flex justify-content-center align-items-center mt-5" style="background-color:#310fc9">

        <div class="card login-form align-self-center" style="width: 30rem; padding: 1rem;">
            <img src="" class="card-img-top img-fluid" alt="...">
            <div class="card-body">
              <h5 class="card-title text-center fs-3 ">Login</h5>
                <!-- <p class="text-success">Login efetuado com sucesso.</p>

                <p class="text-danger">Não foi possivel efetuar o login, tente novamente.</p>

                <p class="text-danger">Usuario não cadastrado.</p>

                <p class="text-danger">Senha incorreta.</p> -->
                @if($errors->all())
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger mt-2 alert-block">
                        <strong>{{$error}}</strong>
                    </div>
                    @endforeach
                @endif
                <form  action="{{ route('login.store') }}" method="POST">
                @csrf
                    <div class="mb-2 col-md-12 form-group ">
                        <label for="usuario" class="form-label">Usuário</label>
                        <input type="text" name="user" class="form-control form-control-sm" id="usuario">
                    </div>
                    <div class="mb-4 col-md-12 form-group ">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" name="password" class="form-control form-control-sm" id="senha">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </form>
             
            </div>
        </div>     

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>

    </html>