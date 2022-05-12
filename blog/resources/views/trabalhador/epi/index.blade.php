@extends('layouts.index')
@section('titulo','Rhweb - Ficha de Epi')
@section('conteine')
<main role="main">
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
              title: '{{session("success")}}'
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
              title: 'Não foi possível gerar a ficha de EPI'
            })
        </script>
        @enderror  

        <form class="row g-3" action="{{route('epi.store')}}" method="POST">
        @csrf
        
            <section class="section__botoes--trabalhador">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                        <a class="botao__voltar" href="{{route('trabalhador.index')}}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                    <a  class="btn botao" href="{{route('ficha.epi.trabalhador',$id)}}" id="campo1">Gerar ficha <i class="fad fa-user-hard-hat"></i></a> 
                </div>
                
            </section>
        
            <h1 class="title__trabalhador">Item da Ficha de EPI <i class="fad fa-user-hard-hat"></i></h1>
            
            <input type="hidden" name="trabalhador" value="{{$id}}">
            
            <div class="mt-5" id="conteiner" >
                @if(count($listaepi) > 0)
                    @foreach($listaepi as $key=>$valor)
                    @if($key < 1)
                        <div class="row mb-3">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-1 col-xxl-1 mt-2">
                                <label for="quantidade{{$key}}" class="form-label">Qtd <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Quantidade"></i></label>
                                <input type="text" class="form-control numero @error('quantidade{{$key}}') is-invalid @enderror numero" name="quantidade{{$key}}" value="{{$valor->eiquantidade}}" maxlength="100" id="quantidade{{$key}}">
                                @error('quantidade{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-4 mt-2">
                                <label for="descricao{{$key}}" class="form-label">Descrição</label>
                                <input type="text" class="form-control @error('descricao{{$key}}') is-invalid @enderror"  name="descricao{{$key}}" value="{{$valor->esdescricao}}" maxlength="100" id="descricao{{$key}}">
                                @error('descricao{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-1 col-xxl-1 mt-2">
                                <label for="tamanho{{$key}}" class="form-label">Tam <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Tamanho"></i></label>
                                <input type="text" class="form-control @error('tamanho{{$key}}') is-invalid @enderror"  name="tamanho{{$key}}" value="{{$valor->estm}}" maxlength="100" id="tamanho{{$key}}">
                                @error('tamanho{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-1 col-xxl-1 mt-2">
                                <label for="ca{{$key}}" class="form-label">CA  <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Numero do Certificado de Aprovação"></i></label>
                                <input type="text" class="form-control numero @error('ca{{$key}}') is-invalid @enderror"  name="ca{{$key}}" value="{{$valor->eica}}" maxlength="100" id="ca{{$key}}">
                                @error('ca{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 col-xxl-2 mt-2">
                                <label for="data__recolhimento{{$key}}" class="form-label">Recolhimento  <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Data de recolhimento"></i></label>
                                <input type="date" class="form-control  @error('data__recolhimento{{$key}}') is-invalid @enderror"  name="data__recolhimento{{$key}}" value="{{$valor->esdatares}}" maxlength="100" id="data__recolhimento{{$key}}">
                                @error('data__recolhimento{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 col-xxl-2 mt-2">
                                <label for="data__devolucao{{$key}}" class="form-label">Devolução  <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Data de devolução"></i></label>
                                <input type="date" class="form-control @error('data__devolucao{{$key}}') is-invalid @enderror"  name="data__devolucao{{$key}}" value="{{$valor->esdatadev}}" maxlength="100" id="data__devolucao{{$key}}">
                                @error('data__devolucao{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                        </div>
                    @else
                        <div class="row mb-3 campo{{$key}}">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-1 col-xxl-1 mt-2">
                                <label for="quantidade{{$key}}" class="form-label">Qtd <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Quantidade"></i></label>
                                <input type="text" class="form-control numero @error('quantidade{{$key}}') is-invalid @enderror numero" name="quantidade{{$key}}" value="{{$valor->eiquantidade}}" maxlength="100" id="quantidade{{$key}}">
                                @error('quantidade{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-4 col-xxl-4 mt-2">
                                <label for="descricao{{$key}}" class="form-label">Descrição</label>
                                <input type="text" class="form-control @error('descricao{{$key}}') is-invalid @enderror"  name="descricao{{$key}}" value="{{$valor->esdescricao}}" maxlength="100" id="descricao{{$key}}">
                                @error('descricao{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-1 col-xxl-1 mt-2">
                                <label for="tamanho{{$key}}" class="form-label">Tam <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Tamanho"></i></label>
                                <input type="text" class="form-control @error('tamanho{{$key}}') is-invalid @enderror"  name="tamanho{{$key}}" value="{{$valor->estm}}" maxlength="100" id="tamanho{{$key}}">
                                @error('tamanho{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-1 col-xxl-1 mt-2">
                                <label for="ca{{$key}}" class="form-label">CA  <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Numero do Certificado de Aprovação"></i></label>
                                <input type="text" class="form-control numero @error('ca{{$key}}') is-invalid @enderror"  name="ca{{$key}}" value="{{$valor->eica}}" maxlength="100" id="ca{{$key}}">
                                @error('ca{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-2 col-xxl-2 mt-2">
                                <label for="data__recolhimento{{$key}}" class="form-label">Recolhimento <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Data de recolhimento"></i></label>
                                <input type="date" class="form-control @error('data__recolhimento{{$key}}') is-invalid @enderror"  name="data__recolhimento{{$key}}" value="{{$valor->esdatares}}" maxlength="100" id="data__recolhimento{{$key}}">
                                @error('data__recolhimento{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-2 col-xxl-2 mt-2">
                                <label for="data__devolucao{{$key}}" class="form-label">Devolução <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Data de devolução"></i></label>
                                <input type="date" class="form-control @error('data__devolucao{{$key}}') is-invalid @enderror"  name="data__devolucao{{$key}}" value="{{$valor->esdatadev}}" maxlength="100" id="data__devolucao{{$key}}">
                                @error('data__devolucao{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="d-flex div__botao--delete--epi align-items-center col-md-1" id="botaoDelete">    
                                <a onclick="remove('{{$key}}')">
                                    <i class="fas fa-2x fa-times btn icon__exit--epi"></i>
                                </a>
                            </div>
                            
                        </div>
                    @endif
                    @endforeach
                    <input type="hidden" name="quantidade" value="{{count($listaepi)}}" id="quantidade">
                    @else
                        <div class="row mb-3">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-1 col-xxl-1 mt-2">
                                <label for="quantidade" class="form-label">Qtd <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Quantidade"></i></label>
                                <input type="text" class="form-control numero @error('quantidade0') is-invalid @enderror" name="quantidade0"  maxlength="100" id="quantidade0">
                                @error('quantidade0')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-4 col-xxl-4 mt-2">
                                <label for="descricao0" class="form-label">Descrição</label>
                                <input type="text" class="form-control @error('descricao0') is-invalid @enderror"  name="descricao0"  maxlength="100" id="descricao0">
                                @error('descricao')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-1 col-xxl-1 mt-2">
                                <label for="tamanho0" class="form-label">Tam <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Tamanho"></i></label>
                                <input type="text" class="form-control @error('tamanho0') is-invalid @enderror"  name="tamanho0"  maxlength="100" id="tamanho0">
                                @error('tamanho0')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-1 col-xxl-1 mt-2">
                                <label for="ca0" class="form-label">CA  <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Numero do Certificado de Aprovação"></i></label>
                                <input type="text" class="form-control numero @error('ca0') is-invalid @enderror"  name="ca0"  maxlength="100" id="ca0">
                                @error('ca0')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-2 col-xxl-2 mt-2">
                                <label for="data__recolhimento0" class="form-label">Recolhimento <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Data de recolhimento"></i></label>
                                <input type="date" class="form-control @error('data__recolhimento0') is-invalid @enderror"  name="data__recolhimento0"  maxlength="100" id="data__recolhimento0">
                                @error('data__recolhimento0')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-2 col-xxl-2 mt-2">
                                <label for="data__devolucao0" class="form-label">Devolucão <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Data de devolução"></i></label>
                                <input type="date" class="form-control @error('data__devolucao0') is-invalid @enderror"  name="data__devolucao0"  maxlength="100" id="data__devolucao0">
                                @error('data__devolucao0')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                           
                        </div>
                        
                        <input type="hidden" name="quantidade" value="1" id="quantidade">
                    @endif
               
            </div>

            <div class="d-grid d-md-flex justify-content-md-end mb-5">
                <div class="mt-4 mb-5">
                    <a type="text" class="btn botao" id="adicinar"><i class="fad fa-plus"></i> Adicionar</a>
                    <button type="submit" class="btn botao" id="salvar1"><i class="fad fa-save"></i> Salvar</button>
                </div>
            </div>

        </form>

    </div>
</main>

        <script>
            function remove(index) {
                $(`.campo${index}`).remove();
            }
            let index = 0;
            function conteiner(index) {
                    let conteiner = '';
                    conteiner += `<div class="row d-flex mb-3 campo${index}">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1 col-xxl-1 mt-2">
                            <label for="quantidade" class="form-label">Quant.</label>
                            <input type="text" class="form-control numero input fw-bold text-dark" name="quantidade${index}" maxlength="100" id="quantidade${index}">
                            <div class="mt-1">
                                    <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 col-xxl-4 mt-2">
                            <label for="descricao" class="form-label">Descrição</label>
                            <input type="text" class="form-control input fw-bold text-dark"  name="descricao${index}" maxlength="100" id="descricao${index}">
                            <div class="mt-1">
                                    <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1 col-xxl-1 mt-2">
                            <label for="tamanho" class="form-label">Tam.</label>
                            <input type="text" class="form-control input fw-bold text-dark"  name="tamanho${index}" maxlength="100" id="tamanho${index}">
                            <div class="mt-1">
                                    <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1 col-xxl-1 mt-2">
                            <label for="ca" class="form-label">CA</label>
                            <input type="text" class="form-control numero input fw-bold text-dark"  name="ca${index}" maxlength="100" id="ca${index}">
                            <div class="mt-1">
                                    <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 col-xxl-2 mt-2">
                            <label for="data__recolhimento" class="form-label">Dta.Rec</label>
                            <input type="date" class="form-control input fw-bold text-dark"  name="data__recolhimento${index}" maxlength="100" id="data__recolhimento${index}">
                            <div class="mt-1">
                                    <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 col-xxl-2 mt-2">
                            <label for="data__devolucao" class="form-label">Dta.Dev</label>
                            <input type="date" class="form-control input fw-bold text-dark"  name="data__devolucao${index}" maxlength="100" id="data__devolucao${index}">
                            <div class="mt-1">
                                    <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center col-md-1" id="botaoDelete">  
                            <a onclick="remove(${index})">  
                                <i class="fas fa-2x fa-times btn icon__exit--epi"></i>
                            </a>
                        </div>

                    </div>`
                    
                return conteiner;
      
            }

            function alerta() {
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
                  title: 'Não pode ser cadastrado mais de 20!'
                })
            }

            $(document).ready(function(){
                $('.numero').mask('00000000000');
                $('#adicinar').click(function () {
                   
                    if ($('#quantidade').val() <= 20) {
                        index += 1;
                        let quantidade =  parseInt($('#quantidade').val());
                        $('#conteiner').append(conteiner(quantidade));
                        $('.numero').mask('00000000000');
                        $('#quantidade').val(quantidade + 1);
                    }else{
                        alerta()
                        $(this).addClass('disabled')
                    }
                })
            });
            
            </script>

@stop