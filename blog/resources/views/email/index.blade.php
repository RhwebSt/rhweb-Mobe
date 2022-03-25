
@if($user['condicao'] == 'precadastro')
    @include('email.prescadastro')
    {{dd($user,$user['condicao'])}}
    
@else
    @include('email.senha')
@endif