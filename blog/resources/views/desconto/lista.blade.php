<div class="modal fade" id="teste" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header header__modal">
                <h5 class="modal-title" id="staticBackdropLabel1"><i class="fad fa-lg fa-percentage"></i> Descontos</h5>
                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            
            <div class="modal-body body__modal">
                
                <section class="section__search">
                    <div class="col-md-5">
                        <form action="" method="GET">
                            
                            <div class="d-flex">
                                
                                <input placeholder="clique ou digite para pesquisar" class="form-control" list="listapesquisa" name="search" id="search">
                                <datalist id="listapesquisa"></datalist>

                                <input type="hidden" name="codicao" value="">
                                
                                <button type="submit" class="btn botao__search">
                                    <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                </button>

                            </div>
                            
                        </form>
                    </div>
                </section>
                
                
                <section>
                    <div class="d-flex justify-content-end">
                        <div>
                            <div class="dropdown">
                                <button class="btn button__filter dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fad fa-sort"></i>
                                </button>
                                <ul class="dropdown-menu dropdown__filtro" aria-labelledby="dropdownMenuButton2">
                                  <li><a class="dropdown-item dropdown__links--filter" href=""><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                  <li><a class="dropdown-item dropdown__links--filter" href=""><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                </ul>
                              </div>
                        </div>

                    </div>
                </section>
                
                <section class="table">
                    <div class="table-responsive-xxl">
                        <table class="table">
                            <thead class="tr__header">
                                <th class="th__header text-nowrap" style="width:80px;">Matrícula</th>
                                <th class="th__header text-nowrap">Nome</th>
                                <th class="th__header text-nowrap">Descrição</th>
                                <th class="th__header text-nowrap" style="width:150px;">Quinzena</th>
                                <th class="th__header text-nowrap" style="width:150px;">Competência</th>
                                <th class="th__header text-nowrap" style="width:150px;">Valor</th>
                                <th class="th__header text-nowrap" style="width:60px;">Relatório</th>
                                <th class="th__header text-nowrap" style="width:60px;">Editar</th>
                                <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                            </thead>
                                  
                            <tbody class="table__body">
                              @if(count($descontos) > 0)
                                @foreach($descontos as $desconto)
                                <tr class="tr__body">
                                    <td class="td__body text-nowrap col" style="width:80px;">{{$desconto->tsmatricula}}</td>
                                    
                                    <td class="td__body text-nowrap col limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$desconto->tsnome}}">
                                        <a>{{$desconto->tsnome}}</a>
                                    </td>
                                    
                                    <td class="td__body text-nowrap col limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$desconto->dsdescricao}}">
                                        <a>{{$desconto->dsdescricao}}</a>
                                    </td>
                                    
                                    <td class="td__body text-nowrap col" style="width:150px;">{{$desconto->dsquinzena}}</td>
                                    
                                    <td class="td__body text-nowrap col" style="width:150px;">
                                        <?php
                                            $data = explode('-',$desconto->dscompetencia);
                                        ?>
                                        {{$data[1]}}/{{$data[0]}}
                                    </td>
                                    
                                    <td class="td__body text-nowrap col" style="width:150px;">{{number_format((float)$desconto->dfvalor, 2, ',', '')}}</td>
                                    
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        <div class="dropdown">
                                            <button class="btn btn__relatorio modal-botao dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="icon__color fas fa-file-alt"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li class=""><a class="dropdown-item text-decoration-none ps-2 text-capitalize" onclick ="botaoModal()"  id="imprimir" role="button">Rol dos Descontos <i class="fas fa-file"></i></a></li>
                                                <li class=""><a class="dropdown-item text-decoration-none ps-2 text-capitalize"  id="imprimir" data-bs-toggle="modal" data-bs-target="#exampleModal" role="button">Rol dos Descontos - Por trabalhador <i class="fas fa-file"></i></a></li>
                                            </ul>
                                        </div>
                                    </td>
                                    
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        <a class="button__editar btn" href="{{route('descontos.edit',base64_encode($desconto->id))}}" class=""><i style="color:white" class="fas fa-pen"></i></a>
                                    </td>
                                    
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        <form action="{{route('descontos.destroy',$desconto->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                            <button type="submit" class="btn button__excluir modal-botao"><i class="icon__color fad fa-trash"></i></button>
                                        </form>
                                    </td>
                                    
                                </tr>
                                @endforeach
                                @else
                                <tr class="tr__body">
                                    <td colspan="11" class="no__register--table">Não há nenhum registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></td>
                                </tr>
                                @endif
                            </tbody>
                                
                            <tfoot>
                                <tr>
                                  <td colspan="11">
                                    {{$descontos->links()}}
                                  </td>
                                </tr>
                            </tfoot>
                            
                        </table>
                    </div>
                </section>
            </div>
            
            <div class="modal-footer">
            </div>
        
        
        </div>
    </div>
</div>

<section class="delete__descontos">
    <div class="modal fade" id="deleteDescontos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <form action="" id="formdelete" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-header header__modal">
                        <h5 class="modal-title" id="rolDescontoTrabLabel"><i class="fad fa-lg fa-percentage"></i></h5>
                        <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
                    </div>
                    
                    <div class="modal-body body__modal">
                        <p class="mb-1 text-start">Deseja realmente excluir?</p>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn botao" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn__deletar">Deletar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
