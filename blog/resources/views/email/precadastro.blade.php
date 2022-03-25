@component('mail::message')
<h1>Bem Vindo!</h1>

<p>Olá bem vindo a RHWEB - Sistemas Inteligentes, ficamos feliz por ter escolhido a gente.</p>
<p>Para Iniciar nessa nova jornada, será necessário que você pegue as credenciais abaixo e faça o login no site para que possamos dar início ao cadastro da sua empresa.</p>
<p>
<strong>
Codigo:{{$user['name']}}
</strong><br>
<strong>
Senha:{{$user['senha']}}
</strong>
</p>
<p>	
Obs: Essa senha é temporária por motivos de segurança, recomendamos que troque após feito os primeiros passos no programa.
</p>
<p>
Agradecemos pela preferência, para mais informações entrar em contato com o suporte.
</p>
<p>
   <a href="{{route('usuario.show',$user['id'])}}"> Clique aqui para ir para o site</a>.
</p>

@endcomponent