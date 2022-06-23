@extends('layouts.index')
@section('titulo','Rhweb - Alteração de Senha')
@section('conteine')

<main role="main">
    <div class="container">

        @if(session('success'))
            <script>
                     
                const Toast = Swal.mixin({
                  toast: true,
                  width: 500,
                  color: '#ffffff',
                  background: '#5AA300',
                  position: 'top-end',
                  showCloseButton: true,
                  showConfirmButton: false,
                  timer: 4000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })
                
                Toast.fire({
                  icon: 'success',
                  title: '{{session("success")}}'
                })
            </script>
        @endif
        @error('false')
            <script>
                     
                const Toast = Swal.mixin({
                  toast: true,
                  width: 500,
                  color: '#ffffff',
                  background: '#C53230',
                  position: 'top-end',
                  showCloseButton: true,
                  showConfirmButton: false,
                  timer: 4000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })
                
                Toast.fire({
                  icon: 'error',
                  title: '{{ $message }}'
                })
            </script>
        @enderror  
        
        <script>
            function validaRobo(){

                if(hcaptcha.getResponse() != "") return true;

                Swal.fire({
                  icon: 'error',
                  title: 'Algo deu errado!!',
                  text: 'Preencha a caixa de "Sou Humano"',
                })

            }
        </script>
        
        
        
        
        <section class="section__altera--senha">

                <form class="row g-3" id="form" action="{{route('altera.store')}}" enctype="multipart/form-data"  method="Post" onsubmit="return validaRobo()" style="">
                    @csrf
                    <h1 class="title__altera--senha">Alterar Senha <i class="fad fa-key"></i></h1>

                    <div class="d-flex justify-content-center flex-row">
                        
                        <div class="col-11 col-md-8 div__icone--inside">
                            <label for="password" class="form-label">Senha Anterior</label>
                                <input type="password" id="password" class=" @error('password') is-invalid @enderror form-control password pass" value="" maxlength="100" name="password">
                                <span class="show icone__inside"><i class="fad fa-lg fa-eye icon eye__icon" id=""></i></span>
                                @error('password')
                                    <div class="mt-3">
                                        <span class="msg__span--erro-senha">{{ $message }}</span>
                                    </div>
                                    
                                @enderror
                        </div>

                    </div>



                    <div class="d-flex justify-content-center flex-row">
                        
                        <div class="col-11 col-md-8  div__icone--inside">
                            <label for="nome__social" class="form-label">Nova Senha</label>
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <input type="password" id="password1" class="form-control password1 pass" onKeyUp="verificaForcaSenha();"   value="" maxlength="100" name="password1">
                            <span class="show1 icone__inside"><i class="fad fa-lg fa-eye icon1 eye__icon" id=""></i></span>
                            <div class="mt-3">
                                <span class="" id="password-status"></span>
                            </div>
                        </div>

                        
                    </div>
                    
                    <div class="d-flex justify-content-center flex-row">
                        

                        <div class="progress col-7" style="height: 5px;" id="progressBar">
                            <div class="progress-bar"  role="progressbar" style="width: 0%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" ></div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center flex-row">
                        
                        <div class="col-11 col-md-8  div__icone--inside">
                            <label for="nome__social" class="form-label">Confirme sua senha</label>
                            <input type="password" id="password2" class="form-control password2 pass" onblur="validarSenha()" value="" maxlength="100" name="password2">
                            <span class="show2 icone__inside"><i class="fad fa-lg fa-eye icon2 eye__icon" id=""></i></span>
                            <div class="mt-3">
                                <span class="span" id="span" style=" "></span>
                            </div>
                        </div>

                    </div>
         
                                 
                    <div class="d-flex justify-content-center align-items-center flex-row">
                        
                        
                        <div class="h-captcha mx-auto recaptcha" data-sitekey="9a42a3c7-383e-44c2-8c52-361a51bba6da"></div>
                    </div>


                    <div class="d-flex justify-content-center align-items-center div__botao--alterar">
                        <button type="submit" id="alterar" class="btn botao__alterar">Alterar <i class="fad fa-exchange"></i></button>
                    </div>
                    
                    </form>
        </section>
    </div>
</main>

<script type="text/javascript" src="{{url('/js/user/alteraSenha/alteracaoSenha.js')}}"></script> 

            @stop