@extends('administrador.layouts.index')
@section('titulo','Rhweb - Lista Trabalhador')
@section('conteine')
        <div class="container">


            <section class="section__title--historico--trab">
                <div>
                    <h1 class="title__historico--trab">Histórico do Trabalhador <i class="fad fa-history"></i></h1>
                </div>
            </section>

            

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
                                <th class="th__header text-nowrap" style="max-width: 20ch">Trabalhador</th>
                                <th class="th__header text-nowrap" style="width:100px">CPF</th>
                                <th class="th__header text-nowrap" style="width:100px">Admissão</th>
                                <th class="th__header text-nowrap" style="max-width: 20ch">Empresa</th>
                                <th class="th__header text-nowrap" style="width:100px">CNPJ</th>
                                <th class="th__header text-nowrap" style="width:80px">Histórico</th>
                            </tr>

                        </thead>
                        {{-- final da heaader da tabela --}}

                        {{-- começo do body da tabela --}}
                        <tbody class="table__body">
                        @if(count($trabalhador) > 0)
                            @foreach($trabalhador as $trabalhadores)
                            <tr class="tr__body">
                                <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$trabalhadores->tsnome}}" style="max-width: 20ch !important; overflow: hidden; text-overflow: ellipsis;">{{$trabalhadores->tsnome}}</td>

                                <td class="td__body text-nowrap col"  style="width:100px">{{$trabalhadores->tscpf}}</td>

                                <td class="td__body text-nowrap col"  style="width:100px">{{ date("d/m/Y",strtotime($trabalhadores->csadmissao))}}</td>

                                <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$trabalhadores->esnome}}" style="max-width: 20ch; overflow: hidden; text-overflow: ellipsis;">{{$trabalhadores->esnome}}</td>

                                <td class="td__body text-nowrap col"  style="width:100px">{{$trabalhadores->escnpj}}</td>
                                
                                {{-- inicio do botao de Historico --}}
                                <td class="td__body text-nowrap"  style="width:80px">

                                    <a href="{{route('administrador.trabalhador.historico.show',$trabalhadores->id)}}" class="btn button__historico--trabalhador"><i class="fas fa-eye"></i></a> 

                                </td>
                                {{-- fim do botao de Historico --}}
                            </tr>
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
                                        @if ($trabalhador->lastPage() > 1)
                                            <ul class="pagination  pagination__table pagination-sm">
                                                @for ($i = 1; $i <= $trabalhador->lastPage(); $i++)
                                                    <li class="page-item {{ ($trabalhador->currentPage() == $i) ? ' active' : ''     }}">
                                                        <a class="page-link modal-botao" href="{{ $trabalhador->url($i) }}">{{ $i }}</a>
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