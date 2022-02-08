@extends('layouts.index')
@section('titulo','Rhweb - Editar Descontos')
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
                  title: '{{$message}}'
                })
            </script>
        @enderror
        @error('tabelavazia')
            <script>
                Swal.fire({
                  icon: 'error',
                  title: 'Tabela de preço vazia',
                  text: '{{ $message }}',
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                  allowEnterKey: true,
                })
            </script>
        @enderror
        @error('dadosvazia')
            <script>
                Swal.fire({
                  icon: 'error',
                  title: 'Algo deu errado!',
                  text: '{{ $message }}',
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                  allowEnterKey: true,
                })
            </script>
        @enderror
       

        <section class="container">
            <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('descontos.update',$dadosdescontos->id)}}">
                <div class="container text-center mt-4 mb-3   fs-4 fw-bold">Editar Descontos <i class="fas fa-percent"></i></div>
                @csrf
                @method('PATCH')
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                    <button type="submit" id="incluir" class="btn botao"><i class="fad fa-sync-alt"></i> Atualizar</button>
                      <a class="btn botao" href="{{route('descontos.index')}}" role="button"><i class="fad fa-sign-out-alt"></i> Voltar</a>
                </div>

                <script>
                    function botaoModal (){
                         
                    Swal.fire({
                        title: 'Periodo',
                        html:
                        '<input type="date" name="inicio" id="swal-input1" class="swal2-input">' +
                        '<input type="date" name="final" id="swal-input2" class="swal2-input">',
                        inputLabel: 'teste',
                        confirmButtonText: 'Buscar',
                        showDenyButton: true,
                        denyButtonText: 'Sair',
                        showConfirmButton: true,
                        focusConfirm: false,
                        preConfirm: () => {
                            if (!document.getElementById('swal-input1').value || !document.getElementById('swal-input1').value) {
                                Swal.showValidationMessage('Preencha todos os campos')   
                            }else{
                                let inicio =  document.getElementById('swal-input1').value
                                let final = document.getElementById('swal-input2').value
                                let tomador = document.getElementById('tomador').value
                                location.href=`{{url('boletim/tomador')}}/${tomador}/${inicio}/${final}`;
                            } 
                            
                        }
                    });
                    }
                </script>

                <div>
                    <div class="col-md-3">
                        <label for="competencia" class="form-label">Competência</label>
                        <input type="month" class="form-control @error('competencia') is-invalid @enderror" name="competencia" value="{{$dadosdescontos->dscompetencia}}" id="competencia">
                        @error('competencia')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="matricula" class="form-label">Matrícula <i class="fas fa-lock"></i></label>
                    <input type="text" class="form-control " name="matricula" value="{{$dadosdescontos->tsmatricula}}" id="matricula" Readonly>
                </div>

                <div class="col-md-8">
                    <label for="nome__trab" class="form-label">Nome do Trabalhador <i class="fas fa-lock"></i></label>
                    <input type="text" class="form-control " name="nome__trab" value="{{$dadosdescontos->tsnome}}" id="nome__trab" Readonly>
                </div>

                <div class="col-md-6">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control  @error('descricao') is-invalid @enderror" name="descricao" value="{{$dadosdescontos->dsdescricao}}" id="descricao">
                    @error('descricao')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>

                <div class="col-md-3">
                    <label for="quinzena" class="form-label">Quinzena</label>
                    <select id="quinzena" name="quinzena" class="form-select fw-bold text-dark" >
                        @if($dadosdescontos->dsquinzena === '1 - Primeira')
                            <option selected>1 - Primeira</option>
                            <option>2 - Segunda</option>
                        @else
                            <option >1 - Primeira</option>
                            <option selected>2 - Segunda</option>
                        @endif
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="text" class="form-control @error('valor') is-invalid @enderror" name="valor" value="{{number_format((float)$dadosdescontos->dfvalor, 2, ',', '.')}}" id="valor">
                    @error('valor')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>

                <div class="table-responsive-xxl">
                    <table class="table border-bottom text-white mt-3 mb-5 table-responsive" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                              <thead>
                                  <th class="col text-center border-start border-top  text-nowrap" style="width:80px;">Matrícula</th>
                                  <th class="col text-center border-top  text-nowrap" style="width:400px">Nome</th>
                                  <th class="col text-center border-top  text-nowrap capitalize" style="300px;">Descrição</th>
                                  <th class="col text-center border-top  text-nowrap" style="width:130px;">Quinzena</th>
                                  <th class="col text-center border-top  text-nowrap" style="width:80px;">Competência</th>
                                  <th class="col text-center border-top  text-nowrap" style="width:110px;">Valor</th>
                              </thead>
                              
                              <tbody style="background-color: #081049; color: white;">
                              @if(count($descontos) > 0)
                                @foreach($descontos as $desconto)
                                  <tr class="bodyTabela">
                                  <td class="col text-center border-start  border-bottom text-nowrap text-uppercase" style="width:80px;">{{$desconto->tsmatricula}}</td>
                                  <td class="col text-center  border-bottom text-nowrap text-uppercase" style="width:400px">
                                    <button type="button" class="btn text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Eliel Felipedos santos rocha" style="max-width: 60ch; overflow: hidden; text-overflow: ellipsis; padding: 0 0; margin:0 0;">
                                        <a>{{$desconto->tsnome}}</a>
                                    </button>    
                                </td>
                                  <td class="col text-center  border-bottom  text-nowrap text-uppercase" style="300px;">
                                    <button type="button" class="btn text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$desconto->dsdescricao}}" style="max-width: 40ch; overflow: hidden; text-overflow: ellipsis; padding: 0 0; margin:0 0;">
                                        <a>{{$desconto->dsdescricao}}</a>
                                    </button>
                                </td>
                                  <td class="col text-center  border-bottom  text-nowrap text-uppercase" style="width:130px;">{{$desconto->dsquinzena}}</td>
                                  <td class="col text-center  border-bottom  text-nowrap text-uppercase" style="width:80px;">
                                    <?php
                                        $data = explode('-',$desconto->dscompetencia);
                                    ?>
                                    {{$data[1]}}/{{$data[0]}}
                                  </td>
                                  <td class="col text-center  border-bottom  text-nowrap text-uppercase" style="width:110px;">{{number_format((float)$desconto->dfvalor, 2, ',', '')}}</td>
                                 
                                  @endforeach
                                  @else
                                  <tr>
                                    <td class="text-center border-bottom border-end border-start text-nowrap" colspan="8" style="background-color: #081049; color: white;">
                                      <div class="alert" role="alert" style="background-color: #CC2836;">
                                          Não á registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></i>
                                      </div>
                                  </td>
                                  </tr>
                                  @endif
                              </tbody>
                                  <tfoot>
                                      <tr class=" border-end border-start border-bottom">
                                          <td colspan="11">
                                            {{$descontos->links()}}
                                          </td>
                                      </tr>
                                  </tfoot>
                              </table>
                          </div>
            </form>
        </section>
        @stop