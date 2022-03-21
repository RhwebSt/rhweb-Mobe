<div class="modal fade" id="teste" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header modalHeader">
                        <h5 class="modal-title fw-bold" id="staticBackdropLabel1">Boletins cadastrados</h5>
                        <button type="button " class="btn-close modalClose" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body modalBody">
                          
                            <div class="col-md-5 mb-4 p-1 mt-2 pesquisar">
                                <form action="{{  route('tabcartaoponto.index')}}" method="GET">
                                    <div class="d-flex">
                                        <label for="exampleDataList" class="form-label"></label>
                                        <input placeholder="pesquisar..." class="form-control fw-bold text-dark pesquisa text-uppercase" list="listapesquisa" name="search" id="pesquisa">
                                        <datalist id="listapesquisa">
                                        </datalist>
                                        <input type="hidden" name="codicao" value="{{isset($dados->id)?$dados->id:null}}">
                                        <button type="submit" class="modal-botao btn botaoPesquisa">
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
                          
                           <div class="d-flex justify-content-end">
                                

                               <!--<div class="align-self-end mb-1 col-6 filtrar">-->
                               <!--     <label for="campoFiltro">Filtrar</label>-->
                               <!--     <input type="text" class="form-control" id="campoFiltro" placeholder="digite o nome do tomador"></input>-->
                               <!-- </div>-->
                               <div class="align-self-end mb-1 col-1 filtrar">
                                    <select class="form-select form-select-sm" id="quantidade" aria-label=".form-select-sm example" data-bs-toggle="tooltip" title="Quantidade de registro">
                                        <option selected>5</option>
                                        <option value="1">15</option>
                                        <option value="2">25</option>
                                        <option value="3">50</option>
                                        <option value="3">100</option>
                                    </select>
                                </div>

                                <div class="dropdown align-self-end mt-2 p-1">
                                    <button class="btn dropdown-toggle buttonFilter" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
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
                               
                                        <table class="table text-white mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                                            <thead>
                                                <th class="col text-center text-nowrap" style="width:115px;">Boletim</th>
                                                <th class="col text-center text-nowrap" style="width: 400px;">Tomador</th>
                                                <th class="col text-center text-nowrap" style="width:200px">Data</th>
                                                <th class="col text-center text-nowrap" style="width:200px">Quantidade</th>
                                                <th class="col text-center text-nowrap" style="width:60px;">Relatório</th>
                                                <th class="col text-center text-nowrap" style="width:60px;">Vizualizar</th>
                                                <th class="col text-center text-nowrap" style="width:60px;">Editar</th>
                                                <th class="col text-center text-nowrap" style="width:60px;">Excluir</th>
                                            </thead>
                                            
                                            <tbody style="background-color: #081049; color: white;">
                                               @if( count($lancamentotabelas) > 0)
                                               @foreach($lancamentotabelas as $lancamentotabela)
                                                <tr class="bodyTabela filtro">               
                                                    <td class="col text-center border-bottom text-nowrap" style="width:115px;">{{$lancamentotabela->liboletim}}</td>
                                                    <td class="col text-center border-bottom text-capitalize text-nowrap" style="width: 300px;">
                                                        <button type="button" class="btn text-white quebraLinha" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$lancamentotabela->tsnome}}">
                                                            <a class="text-uppercase text-decoration-none text-white texto">{{$lancamentotabela->tsnome}}</a>
                                                        </button>
                                                    </td>
                                                    <td class="col text-center border-bottom text-capitalize text-nowrap "style="width:200px">
                                                      <?php
                                                        $data = explode('-',$lancamentotabela->lsdata)
                                                      ?>
                                                      {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                                                    </td>
                                                    <td class="col text-center border-bottom text-nowrap " style="width:200px">{{$lancamentotabela->lsnumero}}</td>
                                                    <td class="col text-center border-bottom text-nowrap" style="width:60px">
                                                        <a href="{{route('relatorio.boletim.tabela',base64_encode($lancamentotabela->liboletim))}}" class="btn btn__padrao--relatorio"><i class="fad fa-file-alt" style="color:white"></i></a>
                                                    </td>
                                                    <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                                        
                                                        <a href="{{route('tabcadastro.create',[base64_encode($lancamentotabela->lsnumero),base64_encode($lancamentotabela->liboletim),base64_encode($lancamentotabela->tomador),base64_encode($lancamentotabela->id),base64_encode($lancamentotabela->lsdata)])}}" class="btn btn__padrao--vizualizar"><i class="fas fa-eye" style="color: white;"></i></a>
                                                    </td>
                                                    <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                                        <button class="btn">
                                                            <a href="{{route('tabcartaoponto.edit',$lancamentotabela->id)}}" class="btn__padrao--editar" ><i style="color:white" class="fas fa-pen"></i></a>
                                                        </button>
                                                    </td>
                                                    <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                                       <form action="{{route('tabcartaoponto.destroy',$lancamentotabela->id)}}"  method="post">
                                                        @csrf
                                                        @method('delete')
                                                            <button type="submit" class="btn btn__padrao--excluir"><i style="color:#FFFFFF;" class="fal fa-trash"></i></button>
                                                        </form> 
                                                        </td>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td class="text-center text-nowrap" colspan="11" style="background-color: #081049; color: white;">
                                                    <div class="alert" role="alert" style="background-color: #CC2836;">
                                                        Não á registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                            </tbody>
                                        <tfoot>
                                            <tr class="">
                                                <td colspan="11">
                                                @if ($lancamentotabelas->lastPage() > 1)
                                                    <ul class="pagination">
                                                       
                                                        @for ($i = 1; $i <= $lancamentotabelas->lastPage(); $i++)
                                                            <li class="page-item {{ ($lancamentotabelas->currentPage() == $i) ? ' active' : ''     }}">
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
                              <!--<div class="modal-footer">-->
                              <!--</div>-->
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
                <script>
                    
                
                
                    function filtro(){
                var campoFiltro = document.querySelector("#campoFiltro");
          
              campoFiltro.addEventListener('input', function(){
                  var descricoes = document.querySelectorAll(".filtro");
                    
                    if (this.value.length > 0) {
                        for(i = 0; i < descricoes.length; i++){
                            var descricao = descricoes[i];
                            var tdnome = descricao.querySelector(".texto");
                            var nome = tdnome.textContent
                            var expressao = new RegExp(this.value, "i");
                            if (!expressao.test(nome)) {
                                descricao.classList.add("invisivel");
                            } else {
                                descricao.classList.remove("invisivel");
                            }
                            console.log(nome);
                        }
                    }else{
                        for(i = 0; i < descricoes.length; i++){
                            var descricao = descricoes[i];
                            descricao.classList.remove("invisivel");
                        }
                    }
                    
              });
            }

            filtro();
                </script>
                