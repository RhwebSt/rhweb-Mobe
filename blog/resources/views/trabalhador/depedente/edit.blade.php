@extends('layouts.index')
@section('titulo','Editar depedente - Rhweb')
@section('conteine')
<main role="main">
    <div class="container">
        @if(session('success'))
        <script>
            Swal.fire({
              position: 'center',
              icon: 'success',
              html: '<p class="modal__aviso">{{session("success")}}</p>',
              background: '#45484A',
              showConfirmButton: true,
              timer: 2500,
    
            });
        </script>
        @endif
        @error('false')
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                html: '<p class="modal__aviso">{{ $message }}</p>',
                background: '#45484A',
                showConfirmButton: true,
                timer: 5000,
    
            });
        </script>
        @enderror
        
        <form class="row g-3" action="{{ route('depedente.update',$id) }}" method="POST" id="form">

            <section class="section__botao--padrao">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{ route('depedente.mostrar.index',base64_encode($depedentes->trabalhador_id)) }}"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                        
                <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap">
                    <button type="submit" id="incluir" class="btn botao"><i class="fas fa-sync-alt"></i> Atualizar</button>
                </div>
                  
            </section>
            
            <h5 class="title__pagina--padrao">Dependentes <i class="fad fa-users"></i></h1>
            
            @csrf
            <input type="hidden" id="method" name="_method" value="PUT">
            <input type="hidden" name="trabalhador" value="{{$depedentes->trabalhador}}">
            <input type="hidden" name="trabalhador" value="{{$id}}">
                
            <div class="col-md-8">
                <label for="nome__dependente" class="form-label">Nome do dependente</label>
                <input type="text" class="form-control  @error('nome__dependente') is-invalid @enderror" value="{{$depedentes->dsnome}}" name="nome__dependente"  id="nome__dependente">
                @error('nome__dependente')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
              
            <div class="col-md-4">
                <label for="cpf__dependente" class="form-label">CPF do dependente</label>
                <input type="text" class="form-control  @error('dscpf') is-invalid @enderror" value="{{$depedentes->dscpf}}" name="dscpf"  id="cpf__dependente">
                @error('dscpf')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                
               
            <div class="col-md-4">
                <label for="tipo__dependente" class="form-label">Tipo de Depedente</label>
                <select id="tipo__dependente" name="tipo__dependente" class="form-select" value="{{old('tipo__dependente')}}">
                    <?php
                        $tipo = ['Cônjuge','Filho(a) ou enteado(a)','Irmão(ã), neto(a) ou bisneto(a)',
                        'Pais, avós e bisavós','Tutor ou Cuidador','Ex-cônjuge','Menor com guarda judicial','Agregado/Outros'];
                        foreach ($tipo as $key => $tipos) {
                          if ($tipos === $depedentes->dstipo) {
                            echo'<option selected>'.$depedentes->dstipo.'</option>';
                          }else{
                            echo'<option>'.$tipos.'</option>';
                          }
                        }
                    ?>
                </select>
            </div>
                
            <input type="hidden" name="trabalhador" value="{{$id}}">
            
            <div class="col-md-4">
                <label for="data__nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control @error('data__nascimento') is-invalid @enderror" value="{{$depedentes->dsdata}}" name="data__nascimento"  id="data__nascimento">
                @error('data__nascimento')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="col-md-4">
                <label for="sexo" class="form-label">Sexo</label>
                <select id="sexo" name="sexo" class="form-select" value="">
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
        
        <section class="modal__excluir">
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="" id="formdelete" method="post">
                            @csrf
                            @method('delete')
                            <div class="modal-header  header__modal">
                                <h5 class="modal-title text-white fs-5" id="staticBackdropLabel"><i class="fad fa-trash"></i> Excluir</h5>
                                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
                            </div>
                            
                            <div class="modal-body body__modal">
                                <p class="mb-1 text-start">Deseja realmente excluir?</p>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn__fechar" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn__deletar">Deletar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        
    </div>         
</main>

<script type="text/javascript" src="{{url('/js/user/trabalhador/depedente/edit.js')}}"></script>
@stop