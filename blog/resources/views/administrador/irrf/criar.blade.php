@extends('administrador.layouts.index')
@section('titulo','Rhweb - Irrf')
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
    <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('irrf.store')}}">

        <h1 class="container text-center mt-4 mb-2 fs-4 fw-bold">Faixa de Cálculos - IRRF</h1>

        <div class="row">
            <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                <button type="submit" id="incluir" class="btn botao">
                    <i class="fad fa-save"></i> Incluir
                </button>

                <a class="btn botao" href="{{route('irrf.index')}}" role="button"><i class="fad fa-sign-out-alt"></i> Sair</a>
            </div>
        </div>

        <input type="hidden" name="user" value="">
        @csrf
        <input type="hidden" id="method" name="_method" value="">
        <div class="container block">
            <div class="col-md-3">
                <label for="ano" class="form-label">Ano
                    <span id="refre" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpar todos os campos" style="background-color:#A71113; padding: 0.6px 4px; border: 1px solid #DF1619; border-radius: 20px;"><i class="fad fa-sync-alt " style="color: #fff"></i></span>
                </label>
                <input type="text" class="form-control @error('irsano') is-invalid @enderror" name="irsano" value="  {{ old('ano')}}" id="ano">
                @error('irsano')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="container block">
            <div class="col-md-3">
                <label for="ded__dependente" class="form-label">Dedução por Dependente</label>
                <input type="text" class="form-control padrao" name="ded__dependente" id="ded__dependente">
            </div>
        </div>


        <div id="container" class="row">
            <div class="col-md-4">
                <label for="valor__final" class="form-label">Valor Final</label>
                <input type="text" class="form-control padrao" name="valor__final01" id="valor__final01">
            </div>

            <div class="col-md-4 ">
                <label for="indice" class="form-label">Indíce %</label>
                <input type="text" class="form-control padrao resultado" name="indice01" id="indice01">
            </div>

            <div class="col-md-4">
                <label for="fator__reducao" class="form-label">Fator de Redução</label>
                <input type="text" class="form-control padrao" name="fator__reducao01" id="fator__reducao01">
            </div>
        </div>


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



        <input type="hidden" id="quantidade" name="quantidade" value="1">
    </form>
    <button id="adicionar" class="btn">
        <i class="fad fa-save"></i> Adicionar
    </button>
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
<script>
    function remove(index) {
        $(`.campo${index}`).remove();
        let quantidade = parseInt($('#quantidade').val());
        $('#quantidade').val(quantidade - 1);
    }

    $(document).ready(function() {

        $('.padrao').mask('000.000.000.000.000,00', {
            reverse: true
        });
        $('#adicionar').click(function() {

            let quantidade = parseInt($('#quantidade').val());
            if (quantidade <= 4) {
                let campos = `
                <div class="col-md-4 campo${quantidade + 1}">
                        <label for="valor__final" class="form-label">Valor Final</label>
                        <input type="text" class="form-control padrao" name="valor__final0${quantidade + 1}" id="valor__final0${quantidade + 1}">
                    </div>

                    <div class="col-md-4 campo${quantidade + 1}">
                        <label for="indice" class="form-label">Indíce %</label>
                        <input type="text" class="form-control padrao resultado" name="indice0${quantidade + 1}" id="indice0${quantidade + 1}">
                    </div>

                    <div class="col-md-4 campo${quantidade + 1}">
                        <label for="indice" class="form-label">Fator de Redução <i class="fa-solid fa-lock"></i></label>
                        <input type="text" class="form-control padrao" name="fator0${quantidade + 1}" id="fator0${quantidade + 1}" >
                    </div>
                    <div class="col-md-1 campo${quantidade + 1}">
                    <a onclick="remove(${quantidade + 1})">  
                            <i class="fas fa-times btn" style="color:white; background-color:Darkred; padding-top: 8px; padding-bottom: 8px; padding-left:10px; padding-right:10px; border-radius: 30%; border: 1px solid red;"></i>
                    </a>
                    </div>`
                $('#quantidade').val(quantidade + 1);
                $('#container').append(campos)
                $('.padrao').mask('000.000.000.000.000,00', {
                    reverse: true
                });

            } else {
                alert('off')
            }

            // $( "#ano" ).keyup(function() {
            //     var dados = $( this ).val();
            //     $.ajax({
            //         url: "{{url('irrf')}}/"+dados,
            //         type: 'get',
            //         contentType: 'application/json',
            //         success: function(data) {

            //             if (data[0].user) {
            //                 $('#form').attr('action', "{{ url('irrf')}}/"+data[0].user);
            //                 // $('#formdelete').attr('action',"{{ url('inss')}}/"+data.user)
            //                 $('#incluir').attr('disabled','disabled')
            //                 $('#atualizar').removeAttr( "disabled" )
            //                 $('#deletar').removeAttr( "disabled" )
            //                 // $('#excluir').removeAttr( "disabled" )
            //                 $('#method').val('PUT')

            //             }
            //             else{
            //                 $('#form').attr('action', "{{ route('inss.store') }}");
            //                 $('#incluir').removeAttr( "disabled" )
            //                 $('#depedente').removeAttr( "disabled" )
            //                 $('#atualizar').attr('disabled','disabled')
            //                 $('#deletar').attr('disabled','disabled')
            //                 $('#method').val(' ')
            //                 // $('#excluir').attr( "disabled" )
            //             }
            //             data.forEach((element,index) => {
            //                 $('#valor__inicial0'+(index+1)).val(element.irsvalorinicial)
            //                 $('#valor__final0'+(index+1)).val(element.irsvalorfinal)
            //                 $('#indice0'+(index+1)).val(element.irsindece)
            //                 $('#id0'+(index+1)).val(element.id)
            //                 $('#fator__reducao0'+(index+1)).val(element.irsreducao)
            //             }); 
            //             $('#ded__dependente').val(data[0].irdepedente)
            //         }
            //     });
            // });
            // $('.resultado').keyup(function () {
            //     let indice = $(this).attr('name')
            //     indice = indice.split('')
            //     let valor = $(`#valor__final${indice[6]}${indice[7]}`).val().replace(/\./g,"").replace(/,/g,".")

            //     let resultado = (parseFloat($(this).val().toString().replace(",", ".")) / 100) *  parseFloat(valor);

            //     if (resultado > 0) { 
            //         $(`#fator__reducao${indice[6]}${indice[7]}`).val(resultado.toFixed(2).replace(".", ","))
            //     }
            // })
        });
    });
</script>
@stop