@extends('administrador.layouts.index')
@section('titulo','Rhweb - Editar rúbrica')
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
            
            <section class="">
                <form class="row g-3 "id="form" method="POST" action="{{route('rublica.update',$rublicas->id)}}" >
            
            
                    @method('PATCH')
                    <input type="hidden" name="empresa" value="{{$user->empresa}}">
                    @csrf
                    
                    <section class="section__botao--voltar--acesso">
            
                        <div class="d-flex justify-content-start align-items-start div__voltar">
                            <a class="btn botao__voltar" href="{{route('rublica.index')}}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                        </div>
                        
                        <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                            <button type="submit" id="atualizar" class="btn botao"><i class="fad fa-sync-alt"></i> Atualizar</button>
                        </div>
                    </section>

                    <h1 class="text__title">Rúbricas</h1>
    
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
            </section>
            
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