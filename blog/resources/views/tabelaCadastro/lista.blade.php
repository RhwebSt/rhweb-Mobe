<div class="modal fade" id="teste" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-black" id="staticBackdropLabel1">Boletins cadastrados</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          
                            
                          
                           <div class="d-flex justify-content-between">
                                
                                <div class="col-md-5 mb-1 p-1 mt-2 pesquisar">
                                <form action="{{  route('tabcartaoponto.index')}}" method="GET">
                                    <div class="d-flex">
                                        <label for="exampleDataList" class="form-label"></label>
                                        <input placeholder="Pesquisa..." class="form-control fw-bold text-dark pesquisa text-uppercase" list="listapesquisa" name="search" id="pesquisa">
                                        <datalist id="listapesquisa">
                                        </datalist>
                                        <input type="hidden" name="codicao" value="{{isset($dados->id)?$dados->id:null}}">
                                        <button type="submit" class="modal-botao">
                                        <i class="fas fa-search fa-md iconsear" id="icon"></i>
                                        </button>
                                       
                                        <div class="text-center d-none p-1" id="refres" >
                                            <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black; margin-top: 6px;width: 1.2rem; height: 1.2rem;">
                                              <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                
                            </div>
        
                                <div class="dropdown  mt-2 p-1">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#111317; color: white;">
                                        <i class="fad fa-sort"></i> Filtro 
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <!-- <li><a class="dropdown-item text-white" href="#"><i class="fad fa-history"></i> Mais Recente</a></li>
                                    <li><a class="dropdown-item text-white" href="#"><i class="fad fa-sort-numeric-down-alt"></i> Mais Antigo</a></li> -->
                                    <li><a class="dropdown-item text-white modal-botao" id="ordemCres" href="{{route('edit.ordem.tabela.cartao.ponto',[isset($dados->id)?$dados->id:' ','asc'])}}"><i class="fad fa-sort-amount-up-alt"></i> Ordem Crescente</a></li>
                                    <li><a class="dropdown-item text-white modal-botao" href="{{route('edit.ordem.tabela.cartao.ponto',[isset($dados->id)?$dados->id:' ','desc'])}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                    </ul>
                                </div>
                            </div>
                
                            <div class="table-responsive-xxl">
                                <table class="table border-bottom text-white mt-3 mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                                    <thead>
                                        <th class="col text-center border-start border-top text-nowrap" style="width:400px">Nome do Trabalhador</th>
                                        <th class="col text-center border-top text-nowrap" style="width:70px">Cod</th>
                                        <th class="col text-center border-top text-nowrap" style="width:400px">Descrição</th>
                                        <th class="col text-center border-top text-nowrap" style="width:100px">Quantidade</th>
                                        <th class="col text-center border-top text-nowrap" style="width:170px">Valor Unitário</th>
                                        <th class="col text-center border-top text-nowrap" style="width:170px">Total R$</th>
                                        <th class="col text-center border-top text-nowrap" style="width:70px">Editar</th>
                                        <th class="col text-center border-end border-top text-nowrap" style="width:70px">Excluir</th>
                                    </thead>
                                    <tbody style="background-color: #081049; color: white;">
                                        @if(count($lista) > 0)
                                        @foreach($lista as $listas)
                                            <tr class="bodyTabela">
                                                <td class="col text-center border-bottom border-start text-nowrap text-uppercase" style="width:400px">{{$listas->tsnome}}</td>
                                                <td class="col text-center border-bottom text-nowrap text-uppercase" style="width:70px">{{$listas->licodigo}}</td>
                                                <td class="col text-center border-bottom text-nowrap text-uppercase" style="width:400px">{{$listas->lshistorico}}</td>
                                                <td class="col text-center border-bottom text-nowrap text-uppercase" style="width:100px">
                                                    
                                                    @if(str_contains($listas->lsquantidade,':'))
                                                            {{$listas->lsquantidade}}
                                                    @else
                                                            {{number_format((float)$listas->lsquantidade, 2, ',', '.')}}
                                                    @endif
                                                </td>
                                                <td class="col text-center border-bottom text-nowrap text-uppercase" style="width:170px">R$ {{number_format((float)$listas->lfvalor, 2, ',', '')}}</td>
                                                <td class="col text-center border-bottom text-nowrap text-uppercase" style="width:170px">R$ {{number_format((float)calculovalores($listas->lsquantidade , $listas->lfvalor), 2, ',', '')}}</td>
                                                <td class="col text-center border-bottom text-nowrap text-uppercase" style="width:70px">
                                                    <button class="btn">
                                                    <a href="{{route('boletim.tabela.edit',[base64_encode($quantidade),base64_encode($boletim),base64_encode($tomador),base64_encode($listas->lancamento),base64_encode($listas->id),base64_encode($data)])}}" class="btn__padrao--editar" ><i style="color:#FFFFFF; padding-left: 3px;" class="fa fa-edit"></i></a>
                                                    </button> 
                                                </td>
                                                <td class="col text-center border-bottom border-end text-nowrap" style="width:70px">
                                                <form action="{{route('tabcadastro.destroy',$listas->id)}}"  method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn__padrao--excluir"><i style="color:#FFFFFF;" class="fal fa-trash"></i></button>
                                                </form> 
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                            <tr>
                                                <td class="text-center border-bottom border-end border-start text-nowrap" colspan="8" style="background-color: #081049; color: white;">
                                                    <div class="alert" role="alert" style="background-color: #CC2836;">
                                                        Não a registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="8" class="text-end">
                                                @if ($lista->lastPage() > 1)
                                                    <ul class="pagination">
                                                       
                                                        @for ($i = 1; $i <= $lista->lastPage(); $i++)
                                                            <li class="page-item {{ ($lista->currentPage() == $i) ? ' active' : ''     }}">
                                                                <a class="page-link modal-botao" href="{{ $lancamentotabelas->url($i) }}">{{ $i }}</a>
                                                            </li>
                                                        @endfor
                                                        
                                                    </ul>
                                                    @endif
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                          </div>
                        </div>
                            
                            
                             
                          </div>
              
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" id="formdelete" method="post">
                                @csrf
                                @method('delete')
                                <div class="modal-header modal__delete">
                                <h5 class="modal-title text-white fs-5" id="staticBackdropLabel">Excluir</h5>
                                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body modal-delbody">
                                    <p class="mb-1 text-start">Deseja realmente excluir?</p>
                                </div>
                                <div class="modal-footer modal-delfooter">
                                <button type="button" class="btn btn__fechar" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn__deletar">Deletar</button>

                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>