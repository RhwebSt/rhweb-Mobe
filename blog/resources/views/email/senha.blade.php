@component('mail::message')
<h1>Esqueceu sua senha?</h1>
<strong>
    Olá esta é sua nova senha:{{$user['password']}},
</strong>
<p>Esqueceu sua senha?. recebemos uma solicitação para a troca de senha.</p>
<p>Para trocar sua senha<a href="#">Clique aqui</a></p>
<p>	
Este e-mail contém informações privadas e confidencias dirigidas exclusivamente à pessoa a que esta destinado. Se você não é o destinatário do mesmo, não pode usar ou compartihar as informações contidas no mesmo. Se você recebeu esta mensagem erroneamente,delete e informe o remetente. A RHWEB - Sistemas Inteligentes não será responsavel se esta mensagem for interceptada ou modificada por qualquer pessoa. Medidas de segurança foram implementadas para previnir a transmissão de vírus dentro desta mensagem e/ou possíveis anexos.</p>

@endcomponent