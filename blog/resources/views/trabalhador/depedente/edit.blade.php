@extends('layouts.index')
@section('titulo','Rhweb - Editar depedente')
@section('conteine')
<main class="container">
            <div class="card-body">
              

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
              <form class="row g-3 mt-1 mb-3"  action="{{ route('depedente.update',$id) }}" method="POST" id="form">

                <div class="row">
                    <div class="col-12 mt-5">
                        <h5 class="card-title text-start fs-3 ">Dependentes <i class="fad fa-users"></i></h5>
                    </div>
                  <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap">
                    <div class="btn form-control" role="button" aria-label="Basic example">
                      <button type="submit" id="incluir" class="btn botao"><i class="fas fa-sync-alt"></i> Atualizar</button>
                      <a class="btn botao " href="{{ route('depedente.mostrar.index',$depedentes->trabalhador) }}"  role="button"><i class="fas fa-sign-out-alt"></i> Sair</a>
                    </div>
                  </div>
              </div>
              @csrf
              <input type="hidden" id="method" name="_method" value="PUT">
              <input type="hidden" name="trabalhador" value="{{$depedentes->trabalhador}}">
                
                <input type="hidden" name="trabalhador" value="{{$id}}">
                
                <div class="col-md-8">
                  <label for="nome__dependente" class="form-label">Nome do dependente</label>
                  <input type="text" class="form-control  @error('nome__dependente') is-invalid @enderror  fw-bold text-dark" value="{{$depedentes->dsnome}}" name="nome__dependente"  id="nome__dependente">
                  @error('nome__dependente')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              
                <div class="col-md-4">
                  <label for="cpf__dependente" class="form-label">CPF do dependente</label>
                  <input type="text" class="form-control  @error('dscpf') is-invalid @enderror  fw-bold text-dark" value="{{$depedentes->dscpf}}" name="dscpf"  id="cpf__dependente">
                  @error('dscpf')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="tipo__dependente" class="form-label">Tipo do dependente</label>
                    <input type="text" class="form-control @error('tipo__dependente') is-invalid @enderror  fw-bold text-dark" value="{{$depedentes->dstipo}}" name="tipo__dependente"  id="tipo__dependente">
                    @error('tipo__dependente')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                
                <input type="hidden" name="trabalhador" value="{{$id}}">
                <div class="col-md-4">
                    <label for="data__nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control @error('data__nascimento') is-invalid @enderror  fw-bold text-dark" value="{{$depedentes->dsdata}}" name="data__nascimento"  id="data__nascimento">
                    @error('data__nascimento')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-md-4">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select id="sexo" name="sexo" class="form-select fw-bold text-dark" value="">
                      @if($depedentes->dssexo === 'Masculino')
                      <option selected >Masculino</option>
                      <option >Feminino</option>
                      <option>Outro</option>
                      @elseif($depedentes->dssexo === 'Feminino')
                      <option  >Masculino</option>
                      <option selected>Feminino</option>
                      <option>Outro</option>
                      @elseif($depedentes->dssexo === 'Outro')
                      <option  >Masculino</option>
                      <option >Feminino</option>
                      <option selected>Outro</option>
                      @endif
                    </select>
                </div>

                

                

                <div class="col-md-4">
                    <label for="irrfs" class="form-label">IRRF</label>
                    <!-- <input type="text" class="form-control @error('irrf') is-invalid @enderror  fw-bold text-dark" value="{{$depedentes->dsirrf}}" name="irrf" id="irrf">
                    @error('irrf')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror -->
                    <select id="irrfs" name="irrf" class="form-select" value="">
                      @if($depedentes->dsirrf === 'Sim')
                      <option selected>Sim</option>
                      <option>Não</option>
                      @else
                      <option>Sim</option>
                      <option selected>Não</option>
                      @endif
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label for="sfs" class="form-label">Salário Familia</label>
                    <!-- <input type="text" class="form-control @error('sf') is-invalid @enderror  fw-bold text-dark" value="{{$depedentes->dssf}}" name="sf" value="" id="sf">
                    @error('sf')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror -->
                    <select id="sfs" name="sf" class="form-select" value="">
                      @if($depedentes->dsirrf === 'Sim')
                      <option  selected>Sim</option>
                      <option>Não</option>
                      @else
                      <option>Sim</option>
                      <option selected>Não</option>
                      @endif
                    </select>
                </div>
              </form> 
              
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
      </main>
@stop