
@extends('layouts.index')
@section('titulo','Rhweb - Epi')
@section('conteine')
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
                <h1 class="fw-bold text-center fs-4 mt-5">Item da Ficha de EPI <i class="fad fa-user-hard-hat"></i></h1>

                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                    <a  class="btn botao" href="{{route('ficha.epi.trabalhador',$id)}}" id="campo1">Gerar ficha de EPI <i class="fad fa-file-alt"></i></a> 
                </div>
                <input type="hidden" name="trabalhador" value="{{$id}}">
                <div class="mt-5" id="conteiner" >
                    @if(count($listaepi) > 0)
                        @foreach($listaepi as $key=>$valor)
                            <div class="row mb-3" style="background-color: #141414; padding-bottom: 20px; padding-top:5px; border-radius: 10px; margin:1px;">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1 col-xxl-1 mt-2">
                                    <label for="quantidade{{$key}}" class="form-label text-white">Quant.</label>
                                    <input type="text" class="form-control numero input fw-bold text-dark @error('quantidade{{$key}}') is-invalid @enderror numero" name="quantidade{{$key}}" value="{{$valor->eiquantidade}}" maxlength="100" id="quantidade{{$key}}">
                                    @error('quantidade{{$key}}')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 col-xxl-4 mt-2">
                                    <label for="descricao{{$key}}" class="form-label text-white">Descrição</label>
                                    <input type="text" class="form-control input fw-bold text-dark @error('descricao{{$key}}') is-invalid @enderror"  name="descricao{{$key}}" value="{{$valor->esdescricao}}" maxlength="100" id="descricao{{$key}}">
                                    @error('descricao{{$key}}')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1 col-xxl-1 mt-2">
                                    <label for="tamanho{{$key}}" class="form-label text-white">Tam.</label>
                                    <input type="text" class="form-control input fw-bold text-dark @error('tamanho{{$key}}') is-invalid @enderror"  name="tamanho{{$key}}" value="{{$valor->estm}}" maxlength="100" id="tamanho{{$key}}">
                                    @error('tamanho{{$key}}')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1 col-xxl-1 mt-2">
                                    <label for="ca{{$key}}" class="form-label text-white">CA</label>
                                    <input type="text" class="form-control numero input fw-bold text-dark @error('ca{{$key}}') is-invalid @enderror"  name="ca{{$key}}" value="{{$valor->eica}}" maxlength="100" id="ca{{$key}}">
                                    @error('ca{{$key}}')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 col-xxl-2 mt-2">
                                    <label for="data__recolhimento{{$key}}" class="form-label text-white">Dta.Rec</label>
                                    <input type="date" class="form-control input fw-bold text-dark @error('data__recolhimento{{$key}}') is-invalid @enderror"  name="data__recolhimento{{$key}}" value="{{$valor->esdatares}}" maxlength="100" id="data__recolhimento{{$key}}">
                                    @error('data__recolhimento{{$key}}')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 col-xxl-2 mt-2">
                                    <label for="data__devolucao{{$key}}" class="form-label text-white">Dta.Dev</label>
                                    <input type="date" class="form-control input fw-bold text-dark @error('data__devolucao{{$key}}') is-invalid @enderror"  name="data__devolucao{{$key}}" value="{{$valor->esdatadev}}" maxlength="100" id="data__devolucao{{$key}}">
                                    @error('data__devolucao{{$key}}')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @if($key > 0)
                                    <div class="d-flex align-items-center col-md-1" id="botaoDelete" style="padding-top: 32px;">    
                                        <a onclick="remove('{{$key}}','v')">
                                            <i class="fas fa-times btn" style="color:white; background-color:Darkred; padding-top: 8px; padding-bottom: 8px; padding-left:10px; padding-right:10px; border-radius: 30%; border: 1px solid red;"></i>
                                        </a>
                                    </div> 
                                @endif
                            </div>
                        @endforeach
                        <input type="hidden" name="quantidade" value="{{count($listaepi)}}" id="quantidade">
                    @else
                    <div class="row mb-3" style="background-color: #141414; padding-bottom: 20px; padding-top:5px; border-radius: 10px; margin:1px;">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1 col-xxl-1 mt-2">
                                    <label for="quantidade" class="form-label text-white">Quant.</label>
                                    <input type="text" class="form-control numero input fw-bold text-dark @error('quantidade0') is-invalid @enderror" name="quantidade0"  maxlength="100" id="quantidade0">
                                    @error('quantidade0')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 col-xxl-4 mt-2">
                                    <label for="descricao0" class="form-label text-white">Descrição</label>
                                    <input type="text" class="form-control input fw-bold text-dark @error('descricao0') is-invalid @enderror"  name="descricao0"  maxlength="100" id="descricao0">
                                    @error('descricao')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1 col-xxl-1 mt-2">
                                    <label for="tamanho0" class="form-label text-white">Tam.</label>
                                    <input type="text" class="form-control input fw-bold text-dark @error('tamanho0') is-invalid @enderror"  name="tamanho0"  maxlength="100" id="tamanho0">
                                    @error('tamanho0')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1 col-xxl-1 mt-2">
                                    <label for="ca0" class="form-label text-white">CA</label>
                                    <input type="text" class="form-control numero input fw-bold text-dark @error('ca0') is-invalid @enderror"  name="ca0"  maxlength="100" id="ca0">
                                    @error('ca0')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 col-xxl-2 mt-2">
                                    <label for="data__recolhimento0" class="form-label text-white">Dta.Rec</label>
                                    <input type="date" class="form-control input fw-bold text-dark @error('data__recolhimento0') is-invalid @enderror"  name="data__recolhimento0"  maxlength="100" id="data__recolhimento0">
                                    @error('data__recolhimento0')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 col-xxl-2 mt-2">
                                    <label for="data__devolucao0" class="form-label text-white">Dta.Dev</label>
                                    <input type="date" class="form-control input fw-bold text-dark @error('data__devolucao0') is-invalid @enderror"  name="data__devolucao0"  maxlength="100" id="data__devolucao0">
                                    @error('data__devolucao0')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                               
                            </div>
                    @endif
                   
                </div>

                <div class="d-grid d-md-flex justify-content-md-end">
                    <div class="mt-4 mb-5">
                        <a type="text" class="btn botao" id="adicinar">Adicionar <i class="fas fa-plus"></i></a>
                    </div>
                </div>

                <input type="hidden" name="quantidade" value="1" id="quantidade">

                    <div class="d-grid d-md-flex justify-content-md-end">
                        <div class="mt-2">
                            
                            <button type="submit" class="btn botao" id="salvar1">Salvar <i class="fad fa-save"></i></button>
                        </div>
                    </div>
                </div>

            </form>


        </main>

        <script>
            function remove(i,status) {
                console.log(i,status);
                if (status === 'v') {
                    $('#conteiner .row').eq(i).remove()
                }else{
                    $('#conteiner .row').eq(i - 1).remove()
                }
                
            }
            let index = 0;
            function conteiner(index) {
                    let conteiner = '';
                    conteiner += `<div class="row d-flex mb-3" style="background-color: #141414; padding-bottom: 20px; padding-top:5px; border-radius: 10px; margin:1px;">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1 col-xxl-1 mt-2">
                            <label for="quantidade" class="form-label text-white">Quant.</label>
                            <input type="text" class="form-control numero input fw-bold text-dark" name="quantidade${index}" maxlength="100" id="quantidade${index}">
                            <div class="mt-1">
                                    <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 col-xxl-4 mt-2">
                            <label for="descricao" class="form-label text-white">Descrição</label>
                            <input type="text" class="form-control input fw-bold text-dark"  name="descricao${index}" maxlength="100" id="descricao${index}">
                            <div class="mt-1">
                                    <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1 col-xxl-1 mt-2">
                            <label for="tamanho" class="form-label text-white">Tam.</label>
                            <input type="text" class="form-control input fw-bold text-dark"  name="tamanho${index}" maxlength="100" id="tamanho${index}">
                            <div class="mt-1">
                                    <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1 col-xxl-1 mt-2">
                            <label for="ca" class="form-label text-white">CA</label>
                            <input type="text" class="form-control numero input fw-bold text-dark"  name="ca${index}" maxlength="100" id="ca${index}">
                            <div class="mt-1">
                                    <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 col-xxl-2 mt-2">
                            <label for="data__recolhimento" class="form-label text-white">Dta.Rec</label>
                            <input type="date" class="form-control input fw-bold text-dark"  name="data__recolhimento${index}" maxlength="100" id="data__recolhimento${index}">
                            <div class="mt-1">
                                    <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 col-xxl-2 mt-2">
                            <label for="data__devolucao" class="form-label text-white">Dta.Dev</label>
                            <input type="date" class="form-control input fw-bold text-dark"  name="data__devolucao${index}" maxlength="100" id="data__devolucao${index}">
                            <div class="mt-1">
                                    <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center col-md-1" id="botaoDelete" style="padding-top: 32px;">  
                        <a onclick="remove(${index},'f')">  
                            <i class="fas fa-times btn" style="color:white; background-color:Darkred; padding-top: 8px; padding-bottom: 8px; padding-left:10px; padding-right:10px; border-radius: 30%; border: 1px solid red;"></i>
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
                        quantidade += 1;
                        $('#quantidade').val(quantidade)
                        $('#conteiner').append(conteiner(quantidade));
                        $('.numero').mask('00000000000');
                    }else{
                        alerta()
                        $(this).addClass('disabled')
                    }
                })
            });
            
            </script>

@stop