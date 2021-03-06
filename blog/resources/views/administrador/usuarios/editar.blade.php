@extends('administrador.layouts.index')
@section('titulo','Rhweb - Editar Usuario')
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


        <div class="container">
            
            

            <section class="">
                <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('administrador.usuarios.update',$editar->id)}}">
                    @csrf
                    @method('PATCH')
                    
                    <!-- <input type="hidden" id="method" name="_method" value=""> -->
                    <input type="hidden" name="empresa" id="idempresa" value="">
                    
                    <section class="section__botao--voltar--acesso">
            
                        <div class="d-flex justify-content-start align-items-start div__voltar">
                            <a class="btn botao__voltar" href="{{route('administrador.usuarios.index')}}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                        </div>
                        
                        <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                            <button type="submit" id="atualizar" class="btn button__atualizar">
                                <i class="fad fa-sync"></i> Atualizar
                            </button>
                        </div>
                    </section>
        
                    <h5 class="text__title">Editar login <i class="fad fa-user-edit"></i></h5>


                    <div class="col-md-3">
                        <label for="empresa" class="form-label">Empresa</label>
                        <input type="text" list="listempresa" class="form-control fw-bold @error('empresa') is-invalid @enderror"   value="{{$editar->empresa->esnome}}" id="empresa">
                        @error('empresa')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="hidden" name="empresa" value="{{$editar->empresa->id}}">
                        <datalist id="listempresa">    
                        </datalist>
                    </div>

                    <div class="col-md-2">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" list="listusuario" class="form-control fw-bold @error('name') is-invalid @enderror"   name="name" value="{{$editar->name}}" id="usuario">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <datalist id="listusuario">    
                        </datalist>
                    </div>

                    <input type="hidden" name="email">
                    <div class="col-md-2">
                        <label for="cargo" class="form-label">Cargo</label>
                        <input type="text" class="form-control fw-bold @error('cargo') is-invalid @enderror" name="cargo" value="{{$editar->cargo}}" id="cargo">
                        @error('cargo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="col-md-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control fw-bold @error('email') is-invalid @enderror" name="email" value="{{$editar->email}}" id="email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control fw-bold" value="" name="senha" value="" id="senha">
                            <span class=""></span>
                    </div>
                </form>
            </section>
            
            
        </div>
        
        @stop