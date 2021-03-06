@extends('layouts.index')
@section('titulo','Editar rúbricas - Rhweb')
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
                      title: '{{ session("success") }}'
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

    <form class="row g-3 mt-1 mb-3 mt-5" id="form" method="POST" action="{{route('rublica.update',$rublicas->id)}}" >
        
        
        @method('PATCH')
        <input type="hidden" name="empresa" value="{{$user->empresa}}">
        @csrf
                <div class="row">
                    <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                        <button type="submit" id="atualizar"  class="btn botao"><i class="fad fa-sync-alt"></i> Atualizar</button>
                        <a type="button" class="btn botao modal-botao" data-bs-toggle="modal" data-bs-target="#teste">
                            <i class="fa-solid fa-list"></i> Lista
                        </a>
                        <a class="btn botao" href="{{route('rublica.index')}}" role="button"><i class="fad fa-sign-out-alt"></i> Sair</a>
                    </div>
                </div>


                <h1 class="container text-center mt-4 mb-2 fs-3 fw-bold">Rúbricas</h1>

                <div class="col-md-2">
                    <label for="rubricas" class="form-label">Rúbricas <i class="fas fa-lock"></i></label>
                    <input type="text" class="form-control @error('rubricas') is-invalid @enderror fw-bold"  name="rubricas" id="rubricas" value="{{$rublicas->rsrublica}}" Readonly>
                    @error('rubricas')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="descricao" class="form-label">Descrição <i class="fas fa-lock"></i></label>
                    <input type="text" class="form-control @error('descricao') is-invalid @enderror fw-bold" name="descricao" id="descricao" value="{{$rublicas->rsdescricao}}" Readonly>
                    @error('descricao')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="incidencia" class="form-label">Incidência</label>
                    
                    <select id="incidencia" name="incidencia" class="form-select fw-bold text-dark fw-bold">
                        @if($rublicas->rsincidencia === 'Sim')
                            <option selected>Sim</option>
                            <option>Não</option>
                        @else
                            <option selected>Sim</option>
                            <option selected>Não</option>
                        @endif
                    </select>
                    
                </div>

                <div class="col-md-2">
                    <label for="dc" class="form-label">D/C</label>
                    <select id="dc" name="dc" class="form-select fw-bold text-dark fw-bold" value="">
                        @if($rublicas->rsdc === 'Créditos')
                            <option selected>Créditos</option>
                            <option>Descontos</option>
                        @else
                            <option >Créditos</option>
                            <option selected>Descontos</option>
                        @endif
                    </select>
                </div>
    </form>
                <div class="table-responsive-xxl">
                <table class="table border-bottom text-white mt-3 mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                    <thead>
                        <th class="col text-center border-start border-top text-nowrap" style="width:120px;">Rúbricas</th>
                        <th class="col text-center border-top text-nowrap" style="width:500px;">Descrição</th>
                        <th class="col text-center border-top text-nowrap" style="width:100px;">Incidência</th>
                        <th class="col text-center border-top text-nowrap" style="width:250px">D/C</th>
                    </thead>
                    <tbody style="background-color: #081049; color: white;">
                    @if(count($lista) > 0)
                        @foreach($lista as $listas)
                        <tr class="bodyTabela">               
                                <td class="col text-center border-bottom border-start text-capitalize text-nowrap" style="width: 120px;">
                                    {{$listas->rsrublica}}
                                </td>
                                
                                <td class="col text-center border-bottom text-nowrap" style="width:500px;">
                                    {{$listas->rsdescricao}}
                                </td>
                                
                                <td class="col text-center border-bottom text-capitalize text-nowrap" style="width:100px;">
                                {{$listas->rsincidencia}}
                                </td>
                                
                                <td class="col text-center border-bottom text-nowrap" style="width:250px">
                                {{$listas->rsdc}}
                                </td>
                                
                        </tr>


                        @endforeach
                        @else
                        <tr>
                            <td class="text-center border-end border-start text-nowrap" colspan="11" style="background-color: #081049; color: white;">
                                <div class="alert" role="alert" style="background-color: #CC2836;">
                                    Não a registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></i>
                                </div>
                            </td>
                        </tr>
                        @endif
                        <tfoot>
                    <tr>
                        <td colspan="8" class="text-end">
                            {{$lista->links()}}
                        </td>
                    </tr>
                    </tfoot>
                </table>

            
    </div>
   
    <script>
         $('.modal-botao').click(function() {
                    localStorage.setItem("modal", "enabled");
                })
               function verficarModal(){
                  var valueModal = localStorage.getItem('modal');
                  if(valueModal === "enabled"){
                      $(document).ready(function(){
                          $("#teste").modal("show");
                      });
                      localStorage.setItem("modal","disabled");
                  }
                }
                verficarModal()
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