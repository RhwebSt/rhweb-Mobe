@extends('administrador.layouts.index')
@section('titulo','Rhweb - Irrf')
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
<div class="container">

   

    <section class="section__form--irrf">

        <form class="row g-3" action="{{route('irrf.update',$id)}}" method="POST">
        <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
            <button type="submit" id="atualizar" class="btn button__atualizar--irrf"><i class="fad fa-save"></i> Atualizar</button>
            <a href="{{route('irrf.index')}}" class="btn button__sair--irrf"><i class="fad fa-sign-out"></i> Sair</a>
        </div>
        @csrf
        <input type="hidden" id="method" name="_method" value="PUT">
            <div class="container block">
                <div class="col-md-1">
                    <label for="ano" class="form-label">Ano
                        <span id="refre" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpar todos os campos" style="background-color:#A71113; padding: 0.6px 4px; border: 1px solid #DF1619; border-radius: 20px;"><i class="fad fa-sync-alt " style="color: #fff"></i></span>
                    </label>
                    <input type="text" class="form-control fw-bold" name="irsano" value="{{$irrf[0]->irsano}}" id="ano">
                    <span class="text-danger"></span>
                </div>
            </div>

            <div class="container block">
                <div class="col-md-3">
                    <label for="ded__dependente" class="form-label">Dedução por Dependente</label>
                    <input type="text" class="form-control" name="ded__dependente" id="ded__dependente" value="{{number_format((float)$irrf[0]->irdepedente, 2, ',', '')}}">
                </div>
            </div>
            @foreach($irrf as $key=>$irrfs)
                <div class="col-md-4">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control padrao" value="{{number_format((float)$irrfs->irsvalorfinal, 2, ',', '')}}" name="valor__final0{{$key + 1}}" id="valor__final0{{$key + 1}}">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control resultado padrao" name="indice0{{$key + 1}}" value="{{number_format((float)$irrfs->irsindece, 2, ',', '')}}" id="indice0{{$key + 1}}">
                </div>

                <div class="col-md-4">
                    <label for="fator__reducao" class="form-label">Fator de Redução</label>
                    <input type="text" class="form-control padrao" name="fator__reducao0{{$key + 1}}" value="{{number_format((float)$irrfs->irsreducao, 2, ',', '')}}" id="fator__reducao0{{$key + 1}}">
                </div>
            @endforeach

            @foreach($irrf as $key=>$i)
                <input type="hidden" name="id0{{$key + 1}}" id="id0{{$key + 1}}" value="{{$i->id}}">
            @endforeach

            <!-- <div class="col-md-4">
                <label for="valor__final" class="form-label">Valor Final</label>
                <input type="text" class="form-control " name="valor__final02" id="valor__final02">
            </div>

            <div class="col-md-4 ">
                <label for="indice" class="form-label">Indíce %</label>
                <input type="text" class="form-control resultado" name="indice02" id="indice02">
            </div>

            <div class="col-md-4">
                <label for="fator__reducao" class="form-label">Fator de Redução</label>
                <input type="text" class="form-control" name="fator__reducao02" id="fator__reducao02">
            </div>



            <div class="col-md-4">
                <label for="valor__final" class="form-label">Valor Final</label>
                <input type="text" class="form-control " name="valor__final03" id="valor__final03">
            </div>

            <div class="col-md-4 ">
                <label for="indice" class="form-label">Indíce %</label>
                <input type="text" class="form-control resultado" name="indice03" id="indice03">
            </div>

            <div class="col-md-4">
                <label for="fator__reducao" class="form-label">Fator de Redução</label>
                <input type="text" class="form-control" name="fator__reducao03" id="fator__reducao03">
            </div>



            <div class="col-md-4">
                <label for="valor__final" class="form-label">Valor Final</label>
                <input type="text" class="form-control " name="valor__final04" id="valor__final04">
            </div>

            <div class="col-md-4 ">
                <label for="indice" class="form-label">Indíce %</label>
                <input type="text" class="form-control resultado" name="indice04" id="indice04">
            </div>

            <div class="col-md-4">
                <label for="fator__reducao" class="form-label">Fator de Redução</label>
                <input type="text" class="form-control" name="fator__reducao04" id="fator__reducao04">
            </div>


            <div class="col-md-4">
                <label for="valor__final" class="form-label">Valor Final</label>
                <input type="text" class="form-control " name="valor__final05" id="valor__final05">
            </div>

            <div class="col-md-4 ">
                <label for="indice" class="form-label">Indíce %</label>
                <input type="text" class="form-control resultado" name="indice05" id="indice05">
            </div>

            <div class="col-md-4">
                <label for="fator__reducao" class="form-label">Fator de Redução</label>
                <input type="text" class="form-control" name="fator__reducao05" id="fator__reducao05">
            </div> -->

        </form>

    </section>


    <section>
        <div class="offcanvas off__canvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Notificações <i id="bell__notification--ofcanvas" class="fad fa-bell bell__notification--ofcanvas"></i></h5>
                <i class="fas fa-2x fa-times icon__exit--side--bar" data-bs-dismiss="offcanvas"></i>
            </div>
            <div class="offcanvas-body off__canvas--body">

                <div class="body__notification" id="notification">
                    <div class="d-flex flex-row justify-content-between header__notification">
                        {{-- cabecalho da notificação o Rhweb é fixo só muda o tempo que a mensagem foi feita --}}
                        <div class="">
                            <p class="content__header-notification">Rhweb <i id="notification__icon-no-read" class="fas fa-circle notification__icon-no-read"></i></p>
                        </div>
                        {{-- inicio da contagem do tempo que a mensagem foi postada --}}
                        <div class="">
                            <p class="content__header-notification">1s</p>
                        </div>
                        {{-- fim da contagem do tempo que a mensagem foi postada --}}
                    </div>
                    {{-- fim do cabecalho --}}

                    {{-- inicio corpo da mensagem --}}
                    <div class="teste">
                        <p class="text__body--notification">O sistema será atualizado no dia 30/03/22 as </p>
                    </div>
                    {{-- fim do corpo da mensagem --}}


                    {{-- inicio da  exclusao da notificacao --}}
                    <div class="d-flex justify-content-end footer-notification">
                        <form action=""></form>
                        <div class="content__footer-notification">
                            <a href="#"><i class="fas icone__footer-notification fa-trash"></i></a>
                        </div>
                    </div>
                    {{-- fim da exclusão da notificação --}}
                </div>


                {{-- inicio da contagem de mensagem nao lida --}}
                <div class="no__read--message">
                    <p class="no__read--message--content">20 notificações não lidas</p>
                </div>
                {{-- fim da contagem da mensagem não lida --}}


            </div>
        </div>
    </section>
</div>
<script>
    $('.padrao').mask('000.000.000.000.000,00', {reverse: true});
</script>
@stop