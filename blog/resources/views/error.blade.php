<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('/css/reset.css')}}">
    <link rel="stylesheet" href="{{url('/css/error.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <title>Error - 404</title>
</head>
<body>
    <main>
        <div class="container d-flex flex-row justify-content-between d-flex align-items-center">

            <div class="align-self-center">
                <img src="{{url('/imagem/rhwebsmsm.png')}}" alt="" srcset="">
                <p class="fs-1 fw-bold error">404 - Não Encontrado</p>
                @if($id === 'trabalhador')
                    <a href="{{route('trabalhador.index')}}" class="btn back">Voltar</a>
                @elseif($id === 'cartao ponto')
                    <a href="{{route('boletimcartaoponto.create',$novodados)}}" class="btn back">Voltar</a>
                @endif
            </div>

            <div class="align-self-center ">
                <img class="imagem" src="{{url('/imagem/macoteMedium.png')}}" alt="" srcset="" style="width:500px; height:500px;">
            </div>
            


        </div>
    </main>
    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>