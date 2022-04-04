@extends('administrador.layouts.index')
@section('titulo','Rhweb - Novo Usuario')
@section('conteine')
<div class="container">
    {{-- inicio do botão novo --}}
    <section class="section__btn--new">
        <div class="">
            <a href="{{route('administrador.usuarios.create')}}" class="button__new btn">Novo <i class="fad fa-user-plus"></i></a>
        </div>
    </section>
    {{-- final do botao novo --}}

    {{-- incio da pesquisa --}}
    <section class="search">
        <form action="">
            <div class="d-flex">
                <div class="col-10 col-md-3 me-1">
                    <input class="form-control" id="inputPesquisar" type="search" placeholder="Pesquisar...">
                </div>
                <div>
                    <button type="button" id="pesquisar" class="button__search btn"><i class="fad fa-search"></i></button>
                </div>
            </div>
        </form>
    </section>
    {{-- fim da pesquisa --}}

    {{-- inicio do filtro --}}
    <section>
        <div class="d-flex justify-content-end">
            <div>
                <div class="dropdown">
                    <button class="btn button__filter dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fad fa-sort"></i>
                    </button>
                    <ul class="dropdown-menu dropdown__filtro" aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item dropdown__links--filter" href="#"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                        <li><a class="dropdown-item dropdown__links--filter" href="#"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </section>
    {{-- fim do filtro --}}


    {{-- incicio da tabela --}}
    <section class="table">
        <div class="table-responsive-xxl">
            <table class="table">
                {{-- inicio da header da tabela --}}
                <thead class="table__header">

                    <tr class="tr__header">
                        <th class="th__header text-nowrap" style="width:300px">Empresa</th>
                        <th class="th__header text-nowrap" style="width:300px">Usuario</th>
                        <th class="th__header text-nowrap" style="width:320px">Email</th>
                        <th class="th__header text-nowrap" style="width:300px">Cargo</th>
                        <th class="th__header text-nowrap" style="width:80px">Permissão</th>
                        <th class="th__header text-nowrap" style="width:80px">Editar</th>
                        <!-- <th class="th__header text-nowrap" style="width:80px">Excluir</th> -->
                    </tr>

                </thead>
                {{-- final da heaader da tabela --}}

                {{-- começo do body da tabela --}}
                <tbody class="table__body">
                    @if(count($lista) > 0)
                    @foreach($lista as $key=>$listas)
                    <tr class="tr__body">
                    <td class="td__body text-nowrap col" style="width:300px" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$listas->esnome}}" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis;">{{$listas->esnome}}</td>
                        <td class="td__body text-nowrap col" style="width:300px" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$listas->name}}" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis;">{{$listas->name}}</td>
                        <td class="td__body text-nowrap col" style="width:320px">{{$listas->email}}</td>
                        <td class="td__body text-nowrap col" style="width:300px">{{$listas->cargo}}</td>
                        {{-- inicio do botao de permissao --}}
                        <td class="td__body text-nowrap col" style="width:80px">

                            <div class="dropdown">
                                <button class="btn button__permission dropdown-toggle" type="button" id="dropdownMenuButton{{$key}}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fad fa-user-lock"></i>
                                </button>
                                <ul class="dropdown-menu button__permission--dropdown" aria-labelledby="dropdownMenuButton{{$key}}">
                                    @foreach($permissao as $permisso)
                                        @if($listas->id === $permisso->model_id && $permisso->name === 'user')
                                            @if($permisso->model_type)
                                                <li><a class="dropdown-item botao-modal" href="{{route('permissao',[base64_encode($listas->id),base64_encode($permisso->permission_id),'R'])}}">Bloquear</a></li>
                                            @else
                                            <li><a class="dropdown-item botao-modal" href="{{route('permissao',[base64_encode($listas->id),base64_encode($permisso->permission_id),'D'])}}">Bloqueador <i class="fad fa-ban text-danger"></i></a></li>
                                            @endif
                                        @elseif($listas->id === $permisso->model_id && $permisso->name !== 'user')
                                            @if($permisso->model_type)
                                                <li><a class="dropdown-item botao-modal" href="{{route('permissao',[base64_encode($listas->id),base64_encode($permisso->permission_id),'R'])}}">{{$permisso->name}} <i class="fas fa-check text-success"></i></a></li>
                                            @else
                                            <li><a class="dropdown-item botao-modal" href="{{route('permissao',[base64_encode($listas->id),base64_encode($permisso->permission_id),'D'])}}">{{$permisso->name}} <i class="fad fa-ban text-danger"></i></a></li>
                                            @endif
                                        @endif
                                    @endforeach
                                </ul>
                            </div>

                        </td>
                        {{-- fim do botao de permissao --}}

                        {{-- inicio do botao de editar --}}
                        <td class="td__body text-nowrap" style="width:80px">

                            <a class="btn button__editar" href="{{route('administrador.usuarios.edit',$listas->id)}}"><i class="fad fa-pen"></i></a>

                        </td>
                        {{-- fim do botao de editar --}}

                        {{-- inicio do botao deletar --}}
                        <!-- <td class="td__body text-nowrap" style="width:80px">
                            <form action="">
                                <button id="button__delete" class="btn button__excluir"><i class="fad fa-trash"></i></button>
                            </form>
                        </td> -->
                        {{-- fim do botao deletar --}}
                    </tr>
                    @endforeach
                    @endif

                </tbody>
                {{-- final do body da tabela --}}

                {{-- inicio do footer da tabela --}}
                <tfoot>
                    <tr class="">
                        <td colspan="6" class="teste" style="border: none !important">
                            <nav aria-label="Page navigation example">
                               
                                @if ($lista->lastPage() > 1)
                                <ul class="pagination pagination__table pagination-sm">

                                    @for ($i = 1; $i <= $lista->lastPage(); $i++)
                                        <li class="page-item {{ ($lista->currentPage() == $i) ? ' active' : ''     }}">
                                            <a class="page-link modal-botao" href="{{ $lista->url($i) }}">{{ $i }}</a>
                                        </li>
                                        @endfor


                                </ul>
                                @endif
                            </nav>
                        </td>
                    </tr>
                </tfoot>
                {{-- fim do footer da tabela --}}
            </table>
        </div>
    </section>
    {{-- fim da tabela --}}


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