@extends('administrador.layouts.index')
@section('titulo','Rhweb - Inss')
@section('conteine')

<div class="container">
    {{-- inicio do botão novo --}}
    <section class="section__btn--new--inss">
        <div class="">
            <a href="{{route('inss.create')}}" class="button__new--inss btn">Novo <i class="fad fa-user-plus"></i></a>
        </div>
    </section>
    {{-- final do botao novo --}}

    {{-- incio da pesquisa --}}
    <!-- <section class="search">
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
    </section> -->
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
                        <!-- <li><a class="dropdown-item dropdown__links--filter" href="#"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                        <li><a class="dropdown-item dropdown__links--filter" href="#"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li> -->
                        @foreach($inss as $i)
                            @if($i->isano)
                                <li><a class="dropdown-item dropdown__links--filter" href="{{route('inss.ordem',$i->isano)}}"><i class="fad fa-sort-amount-down-alt"></i>{{$i->isano}}</a></li>
                            @endif
                           
                        @endforeach
                        <li><a class="dropdown-item dropdown__links--filter" href="{{route('inss.ordem',null)}}"><i class="fad fa-sort-amount-down-alt"></i>Todos</a></li>
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
                        <th class="th__header text-nowrap" style="width:120px">Ano</th>
                        <th class="th__header text-nowrap" style="width:300px">Descrição</th>
                        <th class="th__header text-nowrap" style="width:80px">Editar</th>
                    </tr>

                </thead>
                {{-- final da heaader da tabela --}}

                {{-- começo do body da tabela --}}
                <tbody class="table__body">
                    @if(count($inss) > 0)
                    @foreach($inss as $i)
                    @if($i->isano)
                    <tr class="tr__body">
                        <td class="td__body text-nowrap col" style="width:120px">{{$i->isano}}</td>
                        <td class="td__body text-nowrap col" style="width:600px" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliel" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis;">Tabela do INSS</td>

                        {{-- inicio do botao de editar --}}
                        <td class="td__body text-nowrap" style="width:80px">

                            <a class="btn button__editar" href="{{route('inss.edit',$i->isano)}}"><i class="fad fa-pen"></i></a>
                        </td>
                        {{-- fim do botao de editar --}}
                    </tr>
                    @endif
                    @endforeach
                    @else
                    {{--Inicio quando tiver nenhum cadastro --}}
                    <tr class="tr__body">
                        <td colspan="7" class="no__register--table">Não há nenhum registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></td>
                    </tr>
                    {{--fim quando tiver nenhum cadastro --}}
                    @endif
                </tbody>
                {{-- final do body da tabela --}}



                {{-- inicio do footer da tabela --}}
                <tfoot>
                    <tr class="">
                        <td colspan="6" class="teste" style="border: none !important">
                            <nav aria-label="Page navigation example">
                                @if ($inss->lastPage() > 1)
                                <ul class="pagination pagination__table pagination-sm">

                                    @for ($i = 1; $i <= $inss->lastPage(); $i++)
                                        <li class="page-item {{ ($inss->currentPage() == $i) ? ' active' : ''     }}">
                                            <a class="page-link modal-botao" href="{{ $inss->url($i) }}">{{ $i }}</a>
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