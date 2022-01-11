@extends('layouts.index')
@section('conteine')
    <div class="container">
         @if(session('success'))
                <script>
                         
                    const Toast = Swal.mixin({
                      toast: true,
                      width: 500,
                      color: '#ffffff',
                      background: '#5AA300',
                      position: 'top-end',
                      showCloseButton: true,
                      showConfirmButton: false,
                      timer: 4000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      }
                    })
                    
                    Toast.fire({
                      icon: 'success',
                      title: '{{ $message }}'
                    })
                </script>
            @endif
            @error('false')
                <script>
                         
                    const Toast = Swal.mixin({
                      toast: true,
                      width: 500,
                      color: '#ffffff',
                      background: '#C53230',
                      position: 'top-end',
                      showCloseButton: true,
                      showConfirmButton: false,
                      timer: 4000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      }
                    })
                    
                    Toast.fire({
                      icon: 'error',
                      title: '{{ $message }}'
                    })
                </script>
            @enderror   

    <form class="row g-3 mt-1 mb-3 mt-5" id="form" method="POST" action="{{route('rublica.store')}}" >
        
        
            
        <input type="hidden" name="empresa" value="{{$user->empresa}}">
        <input type="hidden" id="method" name="_method" value="">
        @csrf
                <div class="row">
                    <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                    <button type="submit" id="incluir" class="btn botao" value="Validar!">Incluir</button>
                            <button type="submit" id="atualizar" disabled class="btn botao">Atualizar</button>
                            <button class="btn botao dropdown-toggle" type="button" id="relatoriotrabalhador"  data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fad fa-file-invoice"></i> Relatórios
                            </button>
                              <ul class="dropdown-menu" aria-labelledby="relatoriotrabalhador">
                                <li class=""><a class="dropdown-item text-decoration-none ps-2"  id="imprimir" role="button">Rol das Rúbricas</a></li>
                              </ul>
                            <a class="btn botao" href="#" role="button">Sair</a>
                    </div>
                </div>
                
                

                <div class="col-md-5 mt-5 mb-5 p-1 pesquisar">
                    <div class="d-flex">
                        <label for="exampleDataList" class="form-label"></label>
                        <input class="form-control fw-bold text-dark pesquisa" list="datalistOptions" name="pesquisa" id="pesquisa">
                        <datalist id="datalistOptions">
                        </datalist>
                        <i class="fas fa-search fa-md iconsear"></i>
                        <div class="text-center d-none p-1" id="refres" >
                            <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black; margin-top: 6px;width: 1.2rem; height: 1.2rem;">
                              <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>

                <h1 class="container text-center mt-4 mb-2 fs-3 fw-bold">Rúbricas</h1>

                <div class="col-md-2">
                    <label for="rubricas" class="form-label">Rúbricas</label>
                    <input type="text" class="form-control"  name="rubricas" id="rubricas" value="">
                    
                </div>

                <div class="col-md-6">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control" name="descricao" id="descricao" value="">
                </div>

                <div class="col-md-2">
                    <label for="incidencia" class="form-label">Incidência</label>
                    <input type="text" class="form-control" name="incidencia" id="incidencia" value="">
                </div>

                <div class="col-md-2">
                    <label for="dc" class="form-label">D/C</label>
                    <select id="dc" name="dc" class="form-select fw-bold text-dark" value="">
                      <option selected>Créditos</option>
                      <option>Descontos</option>
                    </select>
                </div>
                
                <div class="table-responsive-lg">
                <table class="table border-bottom text-white mt-3 mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                    <thead>
                        <th class="col text-center border-start border-top text-nowrap" style="width:120px;">Rúbricas</th>
                        <th class="col text-center border-top text-nowrap" style="width:500px;">Descrição</th>
                        <th class="col text-center border-top text-nowrap" style="width:100px;">Incidência</th>
                        <th class="col text-center border-top text-nowrap" style="width:250px">D/C</th>
                        <th class="col text-center border-top text-nowrap" style="width:60px;">Editar</th>
                        <th class="col text-center border-end border-top text-nowrap" style="width:60px;">Excluir</th>
                    </thead>
                    <tbody style="background-color: #081049; color: white;">
                        <tr>               
                            <td class="col text-center border-bottom border-start text-capitalize text-nowrap" style="width: 120px;">

                            </td>
                            
                            <td class="col text-center border-bottom text-nowrap" style="width:500px;">

                            </td>
                            
                            <td class="col text-center border-bottom text-capitalize text-nowrap" style="width:100px;">

                            </td>
                            
                            <td class="col text-center border-bottom text-nowrap" style="width:250px">

                            </td>
                            
                            
                            <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                <button class="btn" style="background-color:#204E83;">
                                <a href="" class="" ><i style="color:#FFFFFF; padding-left: 3px;" class="fal fa-edit"></i></a>
                                </button>
                            </td>
                            <td class="col text-center border-bottom border-end text-nowrap" style="width:60px;">
                                
                                
                                <button class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color:#FF331F">
                                    <i style="color:#FFFFFF; padding-right: 3px;" class="fal fa-trash"></i>
                                </button>
                                
                                <!-- Modal -->
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
                                </div></td>
                            </td>
                        </tr>


                    <tr>
                        <td class="text-center border-end border-start text-nowrap" colspan="11" style="background-color: #081049; color: white;">
                            <div class="alert" role="alert" style="background-color: #CC2836;">
                                Não a registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></i>
                            </div>
                        </td>
                    </tr>


            </form>
    </div>
    <script>
        $('#pesquisa').on('focus keyup',function() {
            let dados = 0;
            if ($(this).val()) {
                dados = $(this).val()
            }
            $.ajax({
                url: "{{url('rublica/pesquisa')}}/"+dados,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                    let nome = ''
                    if (data.length >= 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.rsdescricao}">`
                          nome += `<option value="${element.rsrublica}">`
                        });
                      $('#datalistOptions').html(nome)
                    }
                    if(data.length === 1 && dados.length >= 4){
                        buscaItem(dados)
                    }
                }
            })
        })
        function buscaItem(dados) {
            $.ajax({
                url: "{{url('rublica')}}/"+dados,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                    campos(data);
                }
            })
        }
        function campos(data) {
            if (data.id) {
                $('#form').attr('action', "{{ url('rublica')}}/"+data.id);
                $('#formdelete').attr('action',"{{ url('rublica')}}/"+data.id)
                $('#incluir').attr('disabled','disabled')
                $('#atualizar').removeAttr( "disabled" )
                $('#deletar').removeAttr( "disabled" )
                $('#excluir').removeAttr( "disabled" )
                $('#method').val('PUT')
            }else{
                
                $('#form').attr('action', "{{ route('rublica.store') }}");
                $('#incluir').removeAttr( "disabled" )
                $('#atualizar').attr('disabled','disabled')
                $('#deletar').attr('disabled','disabled')
                $('#method').val(' ')
                $('#excluir').attr( "disabled" )
            }
            $('#descricao').val(data.rsdescricao)
            $('#incidencia').val(data.rsincidencia)
            $('#rubricas').val(data.rsrublica)
            for (let index = 0; index <  $('#dc option').length; index++) {  
                if (data.rsdc == $('#dc option').eq(index).text()) {
                $('#dc option').eq(index).attr('selected','selected')
                }else  {
                $('#dc option').eq(index).removeAttr('selected')
                }
            }
        }
        // $( "#rubricas" ).keyup(function() {
        //     var dados = $(this).val();
        //     $.ajax({
        //         url: "{{url('rublica')}}/"+dados,
        //         type: 'get',
        //         contentType: 'application/json',
        //         success: function(data) {
        //             if (data.id) {
        //                 $('#form').attr('action', "{{ url('rublica')}}/"+data.id);
        //                 $('#formdelete').attr('action',"{{ url('rublica')}}/"+data.id)
        //                 $('#incluir').attr('disabled','disabled')
        //                 $('#atualizar').removeAttr( "disabled" )
        //                 $('#deletar').removeAttr( "disabled" )
        //                 $('#excluir').removeAttr( "disabled" )
        //                 $('#method').val('PUT')
        //             }else{
                      
        //                 $('#form').attr('action', "{{ route('rublica.store') }}");
        //                 $('#incluir').removeAttr( "disabled" )
        //                 $('#atualizar').attr('disabled','disabled')
        //                 $('#deletar').attr('disabled','disabled')
        //                 $('#method').val(' ')
        //                 $('#excluir').attr( "disabled" )
        //             }
        //             $('#descricao').val(data[0].rsdescricao)
        //             $('#incidencia').val(data[0].rsincidencia)
                 
        //             for (let index = 0; index <  $('#dc option').length; index++) {  
        //               if (data[0].rsdc == $('#dc option').eq(index).text()) {
        //                 $('#dc option').eq(index).attr('selected','selected')
        //               }else  {
        //                 $('#dc option').eq(index).removeAttr('selected')
        //               }
        //             }
                   
        //         }
        //     });
        // });
    </script>
@stop