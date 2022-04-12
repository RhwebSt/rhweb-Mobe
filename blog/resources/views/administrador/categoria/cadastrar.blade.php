@extends('administrador.layouts.index')
@section('titulo','Rhweb - Categórias')
@section('conteine')
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

            {{-- Inicio botoes principais --}}
            
            {{-- fim dos botoes principais --}}


            <section class="section__title--categoria">
                <div>
                    <h1 class="title__categoria">Cadastrar Categoria <i class="fad fa-comment-alt-plus"></i></h1>
                </div>
            </section>


            <section class="conteudo__categoria">

                <form class=" row g-3" action="{{route('administrador.categoria.store')}}" method="POST">
                <section class="section__botao--voltar--categoria">
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                    <a href="{{route('administrador.categoria.index')}}" class="btn button__voltar--categoria"><i class="fad fa-long-arrow-left"></i> Voltar</a>
                    <button type="submit" class="button__incluir--categoria btn"><i class="fad fa-save"></i> Incluir</button>
                </div>
                <input type="hidden" name="user" value="{{$user->empresa}}">
                @csrf
            </section>
                    <div class="d-flex justify-content-center flex-column align-items-center div__form--categoria">

                        <div class="mb-3 col-12 col-md-6">
                            <label for="codigo__categoria" class="form-label">Código</label>
                            <input type="text" class="form-control @error('codigo__categoria') is-invalid @enderror" id="codigo__categoria" value="{{ old('codigo__categoria')}}" name="codigo__categoria" placeholder="código" maxlength="5">
                            @error('codigo__categoria')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3 col-12 col-md-6">
                            <label for="descricao__categoria" class="form-label">Descrição</label>
                            <input type="text" class="form-control @error('descricao__categoria') is-invalid @enderror" id="descricao__categoria" name="descricao__categoria" value="{{ old('descricao__categoria')}}" placeholder="descrição" maxlength="255">
                            @error('descricao__categoria')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3 col-12 col-md-6">
                            <label for="texto1" class="form-label">Texto 1 - Recibo</label>
                            <input type="text" class="form-control @error('texto1') is-invalid @enderror" id="texto1" name="texto1" placeholder="Primeiro texto do recibo" value="{{ old('texto1')}}" maxlength="255">
                            @error('texto1')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3 col-12 col-md-6">
                            <label for="texto2" class="form-label">Texto 2 - Recibo</label>
                            <input type="text" class="form-control @error('texto2') is-invalid @enderror" id="texto2" name="texto2" placeholder="Segundo texto do recibo" value="{{ old('texto2')}}" maxlength="255">
                            @error('texto2')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

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