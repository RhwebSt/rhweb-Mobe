@extends('administrador.layouts.index')
@section('titulo','Rhweb - Novo Usuario')
@section('conteine')

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
              title: '{{$message}}'
            })
        </script>
    @enderror    


        <div class="container">


            <section class="form__cadastro--acesso">
                <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('administrador.usuarios.store')}}">
                    @csrf
                    <h5 class="text__title">Cadastro de Login <i class="fad fa-users"></i></h5>
                    <!-- <input type="hidden" id="method" name="_method" value=""> -->
                    <input type="hidden" name="empresa" id="idempresa" value="">
                    <div class="row">
                        <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                            <button type="submit" id="incluir" class="btn button__incluir">
                                <i class="fad fa-save"></i> Incluir
                            </button>
                            <a class="btn button__sair" href="{{route('administrador.usuarios.index')}}" role="button" ><i class="fad fa-sign-out-alt"></i> Sair</a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="empresa" class="form-label">Empresa</label>
                        <input type="text" list="listempresa" class="form-control fw-bold @error('empresa') is-invalid @enderror" value="{{old('empresa')}}" id="empresa">
                        @error('empresa')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="hidden" name="empresa">
                        <datalist id="listempresa">    
                        </datalist>
                    </div>

                    <div class="col-md-2">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" list="listusuario" class="form-control fw-bold @error('name') is-invalid @enderror" value="{{old('name')}}"   name="name" id="usuario">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <datalist id="listusuario">    
                        </datalist>
                    </div>
                    <div class="col-md-2">
                        <label for="cargo" class="form-label">Cargo</label>
                        <input type="text" class="form-control fw-bold @error('cargo') is-invalid @enderror" name="cargo" value="{{old('cargo')}}" id="cargo">
                        @error('cargo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="col-md-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control fw-bold @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" id="email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control fw-bold @error('senha') is-invalid @enderror" value="{{old('senha')}}" name="senha" value="" id="senha">
                        @error('senha')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            </section>
            
            <section>
                <div class="offcanvas off__canvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Notificações <i id="bell__notification--ofcanvas" class="fad fa-bell bell__notification--ofcanvas"></i></h5>
                        <i class="fas fa-2x fa-times icon__exit--side--bar" data-bs-dismiss="offcanvas"></i>
                    </div>
                    <div class="offcanvas-body off__canvas--body">

                        <div class="body__notification" id="notification">
                            <div class="d-flex flex-row justify-content-between header__notification">
                                {{-- cabecalho da notificação o Rhweb é fixo só muda o tempo que a mensagem foi feita --}}
                                <div class="">
                                    <p class="content__header-notification">Rhweb <i id="notification__icon-no-read" class="fas fa-circle notification__icon-no-read"></i></p>
                                </div>
                                {{-- inicio da contagem do tempo que a mensagem foi postada --}}
                                <div class="">
                                    <p class="content__header-notification">1s</p>
                                </div>
                                {{-- fim da contagem do tempo que a mensagem foi postada --}}
                            </div>
                            {{-- fim do cabecalho --}}

                            {{-- inicio corpo da mensagem --}}
                            <div class="teste">
                                <p class="text__body--notification">O sistema será atualizado no dia 30/03/22 as  </p>
                            </div>
                            {{-- fim do corpo da mensagem --}}

                            
                            {{-- inicio da  exclusao da notificacao --}}
                            <div class="d-flex justify-content-end footer-notification">
                                <form action=""></form>
                                <div class="content__footer-notification">
                                    <a href="#"><i class="fas icone__footer-notification fa-trash"></i></a>
                                </div>
                            </div>
                            {{-- fim da exclusão da notificação --}}
                        </div>

                        
                        {{-- inicio da contagem de mensagem nao lida --}}
                        <div class="no__read--message">
                            <p class="no__read--message--content">20 notificações não lidas</p>
                        </div>
                        {{-- fim da contagem da mensagem não lida --}}

                    
                        </div>
                    </div>
            </section>
        </div>
        @stop