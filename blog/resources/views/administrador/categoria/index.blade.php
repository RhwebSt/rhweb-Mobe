@extends('administrador.layouts.index')
@section('titulo','Rhweb - Categórias')
@section('conteine')

        <div class="container">

            {{-- Inicio botoes principais --}}
            <section class="section__botao--voltar--categoria">
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                    <a href="#" class="btn button__voltar--categoria"><i class="fad fa-long-arrow-left"></i> Voltar</a>
                    <a href="{{route('administrador.categoria.create')}}" class="button__new--categoria btn">Novo <i class="fad fa-user-plus"></i></a>
                </div>
            </section>
            {{-- fim dos botoes principais --}}


            <section class="section__title--categoria">
                <div>
                    <h1 class="title__categoria">Categoria Automática <i class="fad fa-magic"></i></h1>
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
                                <th class="th__header text-nowrap" style="width:100px">Código</th>
                                <th class="th__header text-nowrap" style="max-width: 20ch">Descrição</th>
                                <th class="th__header text-nowrap" style="max-width: 20ch">Texto1</th>
                                <th class="th__header text-nowrap" style="max-width: 20ch">Texto2</th>
                                <th class="th__header text-nowrap" style="width:80px">Editar</th>
                            </tr>

                        </thead>
                        {{-- final da heaader da tabela --}}

                        {{-- começo do body da tabela --}}
                        <tbody class="table__body">

                            <tr class="tr__body">
                                
                                <td class="td__body text-nowrap col"  style="width:100px">220</td>

                                <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliel" style="max-width: 20ch !important; overflow: hidden; text-overflow: ellipsis;">Descrição da categoria</td>

                                <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliel" style="max-width: 20ch !important; overflow: hidden; text-overflow: ellipsis;">texto1</td>

                                <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliel" style="max-width: 20ch !important; overflow: hidden; text-overflow: ellipsis;">texto2</td>
                                
                                {{-- inicio do botao de editar --}}
                                <td class="td__body text-nowrap"  style="width:80px">

                                    <a href="#" class="btn button__editar"><i class="fad fa-pen"></i></a>

                                </td>
                                {{-- fim do botao de editar --}}
                            </tr>

                            {{--Inicio quando tiver nenhum cadastro --}}
                                <tr class="tr__body">
                                    <td colspan="7" class="no__register--table">Não há nenhum registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></td>
                                </tr>
                            {{--fim quando tiver nenhum cadastro --}}
     
                        </tbody>
                        {{-- final do body da tabela --}}



                        {{-- inicio do footer da tabela --}}
                        <tfoot>
                            <tr class="">
                                <td colspan="6" class="teste" style="border: none !important">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pagination__table pagination-sm">
                                          <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous">
                                              <span aria-hidden="true">&laquo;</span>
                                            </a>
                                          </li>
                                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                                          <li class="page-item"><a class="page-link" href="#">2</a></li>
                                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                                          <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                              <span aria-hidden="true">&raquo;</span>
                                            </a>
                                          </li>
                                        </ul>
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