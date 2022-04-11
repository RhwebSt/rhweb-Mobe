@extends('administrador.layouts.index')
@section('titulo','Rhweb - CBO')
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


    <section class="section__title--cbo">
        <div>
            <h1 class="title__cbo">Cadastrar CBO <i class="fad fa-comment-alt-plus"></i></h1>
        </div>
    </section>


    <section class="conteudo__cbo">

        <form class=" row g-3" action="{{route('administrador.cbo.store')}}" method="Post">
            <section class="section__botao--voltar--cbo">
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                    <a href="{{route('administrador.cbo.index')}}" class="btn button__voltar--cbo"><i class="fad fa-long-arrow-left"></i> Voltar</a>
                    <button type="submit" class="button__incluir--cbo btn"><i class="fad fa-save"></i> Incluir</button>
                </div>
            </section>
            <input type="hidden" name="user" value="{{$user->empresa}}">
            @csrf
            <div class="d-flex justify-content-center flex-column align-items-center div__form--cbo">

                <div class="mb-3 col-12 col-md-6">
                    <label for="codigo__cbo" class="form-label">Código Cbo</label>
                    <input type="text" class="form-control @error('codigo__cbo') is-invalid @enderror" id="codigo__cbo" value="{{ old('codigo__cbo')}}" name="codigo__cbo" placeholder="código" maxlength="5">
                    @error('codigo__cbo')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 col-12 col-md-6">
                    <label for="descricao__cbo" class="form-label">Descrição</label>
                    <input type="text" class="form-control @error('descricao__cbo') is-invalid @enderror" id="descricao__cbo" name="descricao__cbo" value="{{ old('descricao__cbo')}}" placeholder="descrição" maxlength="60">
                    @error('descricao__cbo')
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
                        <p class="text__body--notification">O sistema será atualizado no dia 30/03/22 as </p>
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