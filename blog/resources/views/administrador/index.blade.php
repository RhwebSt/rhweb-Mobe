@extends('administrador.layouts.index')
@section('titulo','Rhweb - Administrador')
@section('conteine')

<div class="container">
    <section class="section__select">
        <div class="d-flex flex-row justify-content-end">
            {{-- inicio da escolha da data, mes ou semana que a pessoa quer os dados --}}
            <div class="dropdown">
                <button class="btn botao__select dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fad fa-calendar-day"></i>
                </button>
                <ul class="dropdown-menu dropdown__botao-select" aria-labelledby="dropdownMenuButton1">
                    <li><a id="daily" class="dropdown-item dropdown__link-select" href="#">Diário</a></li>
                    <li><a id="month" class="dropdown-item dropdown__link-select" href="#">Mensal</a></li>
                    <li><a id="week" class="dropdown-item dropdown__link-select" href="#">Semanal</a></li>
                </ul>
            </div>
            {{-- fim das escolha das datas --}}
        </div>
    </section>

    <section class="container__cards">
        <div class="row">
            {{-- inicio dos cards com as informações gerais --}}
            <div class="col-12 col-sm-12 col-md-4 mt-3">
                <div class="card cards__dashboard">
                    <div class="card-body card__body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="texto__card--usuario">Usuários</p>
                            <p class="texto__card--usuario--valor">{{$quantuser}}</p>
                        </div>

                        <div class="icone__card--usuario">
                            <i class="fad fa-2x fa-user-alt"></i>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-4 mt-3">
                <div class="card cards__dashboard">
                    <div class="card-body card__body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="texto__card--usuario">Bloqueados</p>
                            <p class="texto__card--usuario--valor">{{$quantuserbloqueador}}</p>
                        </div>

                        <div class="icone__card--usuario">
                            <i class="fad fa-2x fa-user-slash"></i>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-4 mt-3">
                <div class="card cards__dashboard">
                    <div class="card-body card__body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="texto__card--usuario">Tomadores</p>
                            <p class="texto__card--usuario--valor">{{$quantomador}}</p>
                        </div>

                        <div class="icone__card--usuario">
                            <i class="fad fa-2x fa-industry"></i>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-4 mt-3">
                <div class="card cards__dashboard">
                    <div class="card-body card__body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="texto__card--usuario">Trabalhadores</p>
                            <p class="texto__card--usuario--valor">{{$quantrabalhador}}</p>
                        </div>

                        <div class="icone__card--usuario">
                            <i class="fad fa-2x fa-user-hard-hat"></i>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-4 mt-3">
                <div class="card cards__dashboard">
                    <div class="card-body card__body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="texto__card--usuario">Faturas</p>
                            <p class="texto__card--usuario--valor">{{$quantfatura}}</p>
                        </div>

                        <div class="icone__card--usuario">
                            <i class="fad fa-2x fa-file-invoice-dollar"></i>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-4 mt-3">
                <div class="card cards__dashboard">
                    <div class="card-body card__body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="texto__card--usuario">Calculo Folha</p>
                            <p class="texto__card--usuario--valor">{{$quantfolhar}}</p>
                        </div>

                        <div class="icone__card--usuario">
                            <i class="fad fa-2x fa-calculator-alt"></i>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-4 mt-3">
                <div class="card cards__dashboard">
                    <div class="card-body card__body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="texto__card--usuario">Cartão Ponto</p>
                            <p class="texto__card--usuario--valor">{{$quantcartaoponto}}</p>
                        </div>

                        <div class="icone__card--usuario">
                            <i class="fad fa-2x fa-calendar-day"></i>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-4 mt-3">
                <div class="card cards__dashboard">
                    <div class="card-body card__body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="texto__card--usuario">Boletim com Tabela</p>
                            <p class="texto__card--usuario--valor">{{$quantboletimtabela}}</p>
                        </div>

                        <div class="icone__card--usuario">
                            <i class="fad fa-2x fa-table"></i>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-4 mt-3">
                <div class="card cards__dashboard">
                    <div class="card-body card__body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="texto__card--usuario">Usuario Online</p>
                            <p class="texto__card--usuario--valor">3.000</p>
                        </div>

                        <div class="icone__card--usuario">
                            <i class="fad fa-2x fa-globe"></i>
                        </div>

                    </div>
                </div>
            </div>
            {{-- fim dos cards --}}
        </div>
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