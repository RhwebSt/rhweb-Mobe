@extends('layouts.index')
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
                      title: '{{$message}}'
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
              <form class="row g-3 mt-1 mb-3"  action="{{ route('depedente.store') }}" method="POST" id="form">

                <div class="row">
                    <div class="col-12 mt-5">
                        <h5 class="card-title text-start fs-3 ">Dependentes <i class="fad fa-users"></i></h5>
                    </div>
                  <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap">
                    <div class="btn form-control" role="button" aria-label="Basic example">
                      <a class="btn botao" href="{{ route('depedente.mostrar.index',$id) }}" role="button">Sair</a>
                      <button type="submit" id="incluir" class="btn botao">Incluir</button>
                    </div>
                  </div>
              </div>
              @csrf
              
              <div class="col-md-8">
                  <label for="nome__dependente" class="form-label">Nome do dependente</label>
                  <input type="text" class="form-control  @error('nome__dependente') is-invalid @enderror  fw-bold text-dark" value="{{old('nome__dependente')}}" name="nome__dependente"  id="nome__dependente">
                  @error('nome__dependente')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              
              <input type="hidden" id="method" name="_method" value="">
                <div class="col-md-4">
                  <label for="cpf__dependente" class="form-label">CPF do dependente</label>
                  <input type="text" class="form-control  @error('cpf__dependente') is-invalid @enderror  fw-bold text-dark" value="{{old('cpf__dependente')}}" name="cpf__dependente"  id="cpf__dependente">
                  @error('cpf__dependente')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <input type="hidden" name="trabalhador" value="{{$id}}">

                <div class="col-md-4">
                    <label for="tipo__dependente" class="form-label">Tipo do dependente</label>
                    <input type="text" class="form-control @error('tipo__dependente') is-invalid @enderror  fw-bold text-dark" value="{{old('tipo__dependente')}}" name="tipo__dependente"  id="tipo__dependente">
                    @error('tipo__dependente')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="data__nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control @error('data__nascimento') is-invalid @enderror  fw-bold text-dark" value="{{old('data__nascimento')}}" name="data__nascimento"  id="data__nascimento">
                    @error('data__nascimento')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="col-md-4">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select id="sexo" name="sexo" class="form-select fw-bold text-dark" value="">
                      <option selected>Masculino</option>
                      <option>Feminino</option>
                      <option>Outro</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="irrf" class="form-label">IRRF</label>
                    <input type="text" class="form-control @error('irrf') is-invalid @enderror  fw-bold text-dark" value="{{old('irrf')}}" name="irrf" id="irrf">
                    @error('irrf')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                    <!-- <select id="irrf" name="irrf" class="form-select" value="">
                      <option selected>Sim</option>
                      <option>Não</option>
                    </select> -->
                </div>
                
                <div class="col-md-4">
                    <label for="sf" class="form-label">Salário Familia</label>
                    <input type="text" class="form-control @error('sf') is-invalid @enderror  fw-bold text-dark" value="{{old('sf')}}" name="sf" value="" id="sf">
                    @error('sf')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                    <!-- <select id="sf" name="sf" class="form-select" value="">
                      <option selected>Sim</option>
                      <option>Não</option>
                    </select> -->
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
      <!-- <script>
        $(document).ready(function(){
           if ("{!$depedentes->id!}") {
             $('#form').attr('action', "{{ route('depedente.update',$id) }}");
             $('#method').val('PUT')
             $('#incluir').attr('disabled','disabled')
             $('#atualizar').removeAttr( "disabled" )
             $('#deletar').removeAttr( "disabled" )
             $('#formdelete').attr('action',"{{ route('depedente.destroy',$id)}}")
           }else{
            $('#form').attr('action', "{{ route('trabalhador.store') }}");
            $('#method').val(' ')
            $('#incluir').removeAttr( "disabled" )
            $('#atualizar').attr('disabled','disabled')
            $('#deletar').attr('disabled','disabled')
           }
        });
    </script> -->
@stop