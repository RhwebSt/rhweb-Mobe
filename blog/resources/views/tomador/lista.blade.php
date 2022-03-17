
<div class="modal fade" id="teste" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-black fw-bold" id="staticBackdropLabel1">Tomadores cadastrados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div class="col-md-5 mb-1 p-1 mt-2 pesquisar">
                        <form action="" method="GET">
                            <div class="d-flex">
                                <label for="exampleDataList" class="form-label"></label>
                                <input placeholder="pesquisar..." class="form-control fw-bold text-dark pesquisa text-uppercase" list="listapesquisa" name="search" id="pesquisa">
                                <datalist id="listapesquisa">
                                </datalist>
                                <input type="hidden" name="codicao" value="">
                                <button type="submit" class="modal-botao btn botaoPesquisa modal-botao">
                                    <i class="fas fa-search fa-md iconsear" id="icon"></i>
                                </button>

                                <div class="text-center d-none p-1" id="refres">
                                    <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black; margin-top: 6px;width: 1.2rem; height: 1.2rem;">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                        </form>
                    </div>
                    </div>
                    <div class="dropdown  mt-2 p-1">
                        <button class="btn dropdown-toggle buttonFilter" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-sort"></i> Filtro
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <!-- <li><a class="dropdown-item text-white" href="#"><i class="fas fa-history"></i> Mais Recente</a></li>
                                    <li><a class="dropdown-item text-white" href="#"><i class="fas fa-sort-numeric-down-alt"></i> Mais Antigo</a></li> -->
                            <li><a class="dropdown-item text-white modal-botao" href=""><i class="fas fa-sort-amount-up-alt"></i> Ordem Crescente</a></li>
                            <li><a class="dropdown-item text-white modal-botao" href=""><i class="fas fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                        </ul>
                    </div>
                </div>
                <div class="table-responsive-xxl">
                    <table class="table border-bottom text-white mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                        <thead>
                            <th class="col text-center text-nowrap" style="width:80px;">Matrícula</th>
                            <th class="col text-center text-nowrap" style="width:400px;">Tomador</th>
                            <th class="col text-center text-nowrap" style="width:200px">CNPJ</th>
                            <th class="col text-center text-nowrap" style="width:120px">Tabela Preço</th>
                            <th class="col text-center text-nowrap" style="width:60px">Relatórios</th>
                            <th class="col text-center text-nowrap" style="width:60px">S-1020</th>
                            <th class="col text-center text-nowrap" style="width:60px;">Editar</th>
                            <th class="col text-center text-nowrap" style="width:60px;">Excluir</th>
                        </thead>
                        <tbody style="background-color: #081049; color: white;">
                            <tr class="bodyTabela">
                                <td class="col text-center border-bottom text-nowrap" style="width:80px;"></td>
                                <td class="col text-center border-bottom text-capitalize text-nowrap" style="width: 300px;">
                                    <button type="button" class="btn text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis;">
                                        <a></a>
                                    </button>
                                </td>
                                <td class="col text-center border-bottom text-capitalize text-nowrap " style="width:200px">

                                </td>

                                <td class="col text-center border-bottom text-capitalize text-nowrap " style="width:120px">
                                    <a class="btn__padrao--relatorio modal-botao" href="" class=""><i class="fad fa-file-invoice"></i></a>
                                </td>

                                <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                <a class="btn__padrao--relatorio modal-botao" href="" class=""><i style="color:white;" class="fad fa-file-invoice"></i></a>
                                </td>
                                <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                <a class="btn__padrao--editar" href="" class=""><i class="fad fa-door-open"></i></a>
                                </td>
                                <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                    <button class="btn">
                                        <a class="btn__padrao--editar" href="" class=""><i style="color: white;" class="fas fa-pen"></i></a>
                                    </button>
                                </td>
                                <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                    <form action="" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn modal-botao" style="background-color:#FF331F; border: 1px solid #E5767D;"><i style="color:#FFFFFF;" class="fad fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center text-nowrap" colspan="11" style="background-color: #081049; color: white;">
                                    <div class="alert" role="alert" style="background-color: #CC2836;">
                                        Não á registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></i>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                        <tfoot>
                            <tr class="">
                                <td colspan="11">

                                    <ul class="pagination">


                                            <li class="page-item">
                                                <a class="page-link modal-botao" href=""></a>
                                            </li>


                                    </ul>

                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
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