@extends('layouts.index')
@section('titulo','Rhweb - Alteração de senha')
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
                  title: '{{ $message }}'
                })
            </script>
        @enderror  
            <section class="mt-5">
                <div class="container d-flex justify-content-center flex-column align-items-center mt-5 p-2" >
                    <form class="row g-3 needs-validation form-control bg__form" id="form" action="{{route('altera.store')}}" enctype="multipart/form-data"  method="Post" onsubmit="return validarRobo()" style="">
                    @csrf
                    <div class="container text-center text-white mt-4 mb-3 fs-4 fw-bold">Alterar Senha</div>

                    <div>

                        <div class="d-flex align-items-center">
                            <div class="col-11 col-sm-11 col-md-11 col-lg-4">
                            <label for="nome__social" class="form-label text-white">Senha Anterior</label>
                                <input type="password" id="password" class=" @error('password') is-invalid @enderror form-control input fw-bold text-dark fw-bold text-dark password pass" value="" maxlength="100" name="password">
                                @error('password')
                                    <div class="mt-2">
                                        <span style="color: #fff ; background-color: #8F0200; font-size: 13px; padding: 5px; border-radius: 3px; border: 1px solid #CA023B; margin-top: 10px;">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div class="align-self-center mt-4 ms-2">
                                <span class="show"><i class="fas fa-lg fa-eye icon" id="" style="margin-top: 10px; background-color: #FFF; padding-bottom: 11px; padding-top: 11px; padding-left: 2px; padding-right: 2px; border-radius: 100%;"></i></span>
                            </div>
                        </div>


                    </div>

                    <div>

                        <div class="d-flex align-items-center">
                            <div class="col-11 col-sm-11 col-md-11 col-lg-4">
                            <label for="nome__social" class="form-label text-white">Nova Senha</label>
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <input type="password" id="password1" class="form-control input fw-bold text-dark fw-bold text-dark password1 pass" onKeyUp="verificaForcaSenha();"   value="" maxlength="100" name="password1">
                                <!--@error('password1')-->
                                <!--    <span class="text-danger">{{ $message }}</span>-->
                                <!--@enderror-->
                            </div>

                            <div class="align-self-center mt-4 ms-2" >
                                <span class="show1" ><i class="fas fa-lg fa-eye icon1" style="margin-top: 10px; background-color: #FFF; padding-bottom: 11px; padding-top: 11px; padding-left: 2px; padding-right: 2px; border-radius: 100%;"></i></span>
                            </div>

                            
                        </div>

                            <div class="mt-2 mb-2">
                                <span class="" id="password-status"></span>
                            </div>

                            <div class="progress col-11 col-sm-11 col-md-11 col-lg-4 mb-1" style="height: 3px;" id="progressBar">
                                <div class="progress-bar"  role="progressbar" style="width: 0%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" ></div>
                            </div>


                                <div class="d-flex align-items-center">
                                    <div class="col-11 col-sm-11 col-md-11 col-lg-4">
                                    <label for="nome__social" class="form-label text-white">Confirme sua senha</label>
                                    <input type="password" id="password2" class="form-control input fw-bold text-dark fw-bold text-dark password2 pass" onblur="validarSenha()" value="" maxlength="100" name="password2">
                                    <!--@error('password2')-->
                                    <!--    <span class="text-danger">{{ $message }}</span>-->
                                    <!--@enderror-->
                                    </div>

                                    <div class="align-self-center mt-4 ms-2">
                                        <span class="show2"><i class="fas fa-lg fa-eye icon2" style="margin-top: 10px; background-color: #FFF; padding-bottom: 11px; padding-top: 11px; padding-left: 2px; padding-right: 2px; border-radius: 100%;"></i></span>
                                    </div>
                                </div>
                                    <div class="mt-2">
                                        <span class="span" id="span" style=" "></span>
                                    </div>

                    </div>      
                            
                                <div class="g-recaptcha" data-sitekey="6LdiO0weAAAAAOGNW_HBvCWhIlxCh7TIPm0iS2Ea" style="transform:scale(0.85);-webkit-transform:scale(0.85);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>

                                <div id="msgrecap"></div>


                            <div class="col-md-4">
                                <button type="submit" id="alterar" class="btn botao__alteracao">Alterar</button>
                            </div>
                    
                    </form>
                </div>

            </section>

            @stop