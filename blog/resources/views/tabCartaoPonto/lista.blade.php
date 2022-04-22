    <div class="modal fade" id="teste" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header modalHeader">
                    <h5 class="modal-title fw-bold" id="staticBackdropLabel1">Boletins cadastrados</h5>
                    <button type="button " class="btn-close modalClose" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body modalBody">
                          
                    <div class="col-md-5 mb-4 p-1 mt-2 pesquisar">
                        <form action="{{route('tabcartaoponto.index')}}" method="GET">
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
                            </div>
                        </form>
                    </div>
                          

                    <section>
                        <div class="d-flex justify-content-end">
                            <div>
                                <div class="dropdown">
                                    <button class="btn button__filter dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fad fa-sort"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown__filtro" aria-labelledby="dropdownMenuButton2">
                                      <li><a class="dropdown-item dropdown__links--filter" href="{{route('edit.ordem.tabela.cartao.ponto',[isset($dados->id)?$dados->id:' ','asc'])}}"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                      <li><a class="dropdown-item dropdown__links--filter" href="{{route('edit.ordem.tabela.cartao.ponto',[isset($dados->id)?$dados->id:' ','desc'])}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                    </ul>
                                  </div>
                            </div>
    
                        </div>
                    </section>
                            
                             
                    <section class="table">
                        <div class="table-responsive-xxl">
                           
                            <table class="table">
                                <thead class="tr__header">
                                    <th class="th__header text-nowrap" style="width:115px;">Boletim</th>
                                    <th class="th__header text-nowrap">Tomador</th>
                                    <th class="th__header text-nowrap" style="width:200px">Data</th>
                                    <th class="th__header text-nowrap" style="width:200px">Quantidade</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Relatório</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Vizualizar</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Editar</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                                </thead>
                                        
                                <tbody class="table__body">
                                   @if( count($lancamentotabelas) > 0)
                                   @foreach($lancamentotabelas as $lancamentotabela)
                                    <tr class="tr__body">               
                                        <td class="td__body text-nowrap col" style="width:115px;">{{$lancamentotabela->liboletim}}</td>
                                        
                                        <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$lancamentotabela->tsnome}}" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis;">
                                            <a>{{$lancamentotabela->tsnome}}</a>
                                        </td>
                                        <td class="td__body text-nowrap col"style="width:200px">
                                          <?php
                                            $data = explode('-',$lancamentotabela->lsdata)
                                          ?>
                                          {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                                        </td>
                                        <td class="td__body text-nowrap col" style="width:200px">{{$lancamentotabela->lsnumero}}</td>
                                        
                                        <td class="td__body text-nowrap col" style="width:60px">
                                            <a class="btn btn__relatorio modal-botao" href="{{route('relatorio.boletim.tabela',base64_encode($lancamentotabela->liboletim))}}"><i class="icon__color fas fa-file-alt"></i></a>
                                        </td>
                                        
                                        <td class="td__body text-nowrap col" style="width:60px;">
                                            
                                            <a class="btn btn__vizualizar" href="{{route('boletim.tabela.create',[base64_encode($lancamentotabela->lsnumero),base64_encode($lancamentotabela->liboletim),base64_encode($lancamentotabela->tomador),base64_encode($lancamentotabela->id),base64_encode($lancamentotabela->lsdata)])}}"><i class="icon__color fad fa-eye"></i></a>
                                        </td>
                                        
                                        <td class="td__body text-nowrap col" style="width:60px;">
                                            <button class="btn">
                                                <a class="button__editar btn modal-botao" href="{{route('tabcartaoponto.edit',base64_encode($lancamentotabela->id))}}"><i class="icon__color fas fa-pen"></i></a>
                                            </button>
                                        </td>
                                        
                                        <td class="td__body text-nowrap col" style="width:60px;">
                                           <form action="{{route('tabcartaoponto.destroy',$lancamentotabela->id)}}"  method="post">
                                            @csrf
                                            @method('delete')
                                                <button type="submit" class="btn button__excluir modal-botao"><i class="icon__color fad fa-trash"></i></button>
                                            </form> 
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="tr__body">
                                        <td colspan="7" class="no__register--table">Não há nenhum registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></td>
                                    </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr class="">
                                        <td colspan="11">
                                            {{$lancamentotabelas->links()}}
                                        <!--@if ($lancamentotabelas->lastPage() > 1)-->
                                        <!--    <ul class="pagination">-->
                                               
                                        <!--        @for ($i = 1; $i <= $lancamentotabelas->lastPage(); $i++)-->
                                        <!--            <li class="page-item {{ ($lancamentotabelas->currentPage() == $i) ? ' active' : ''     }}">-->
                                        <!--                <a class="page-link modal-botao" href="{{ $lancamentotabelas->url($i) }}">{{ $i }}</a>-->
                                        <!--            </li>-->
                                        <!--        @endfor-->
    
                                                
                                        <!--    </ul>-->
                                        <!--    @endif-->
                                        </td>
                                    </tr>
                                </tfoot>
                                
                            </table>
                            
                        </div>
                        
                    </section>
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
                