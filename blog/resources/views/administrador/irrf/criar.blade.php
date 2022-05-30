@extends('administrador.layouts.index')
@section('titulo','Rhweb - Cadastrar Tabela IRRF')
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
        <input type="hidden" name="user" value="">
        @csrf
        <input type="hidden" id="method" name="_method" value="">
        
        <section class="section__botao--voltar--acesso">
            
            <div class="d-flex justify-content-start align-items-start div__voltar">
                <a class="btn botao__voltar" href="{{route('irrf.index')}}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
            </div>
            
            <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                <button type="submit" id="incluir" class="btn botao">
                    <i class="fad fa-save"></i> Incluir
                </button>
            </div>
        </section>
        

        <h1 class="text__title">Cadastrar Tabela - IRRF</h1>


        

        <div class="col-12 col-md-6 mt-1">
            <label for="ano" class="form-label">Ano</label>
            <input type="text" class="form-control @error('irsano') is-invalid @enderror" name="irsano" value="  {{ old('ano')}}" id="ano">
            @error('irsano')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-12 col-md-6 mt-1">
            <label for="ded__dependente" class="form-label">Valor de Dedução (dependente)</label>
            <input type="text" class="form-control padrao" name="ded__dependente" id="ded__dependente">
        </div>



        <div id="container" class="row m-0 p-0">
            <div class=" col-12 col-md-4 mt-2">
                <label for="valor__final" class="form-label">Valor Final</label>
                <input type="text" class="form-control padrao" name="valor__final01" id="valor__final01">
            </div>

            <div class="col-12 col-md-3 mt-2">
                <label for="indice" class="form-label">Indíce %</label>
                <input type="text" class="form-control padrao resultado" name="indice01" id="indice01">
            </div>

            <div class="col-12 col-md-4 mt-2">
                <label for="fator__reducao" class="form-label">Fator de Redução</label>
                <input type="text" class="form-control padrao" name="fator__reducao01" id="fator__reducao01">
            </div>
            <div class="col-md-1 mt-3">
                <a>  
                    <i class="fad fa-lg fa-lock btn" style="color:white; margin-top:25px"></i>
                </a>
            </div>
        </div>


        
        <input type="hidden" id="quantidade" name="quantidade" value="1">
    </form>
    <button id="adicionar" class="btn botao">
        <i class="fad fa-plus"></i> Adicionar
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
                    <div class="col-md-4 mt-3 campo${quantidade + 1}">
                        <label for="valor__final" class="form-label">Valor Final</label>
                        <input type="text" class="form-control padrao" name="valor__final0${quantidade + 1}" id="valor__final0${quantidade + 1}">
                    </div>

                    <div class="col-md-3 mt-3 campo${quantidade + 1}">
                        <label for="indice" class="form-label">Indíce %</label>
                        <input type="text" class="form-control padrao resultado" name="indice0${quantidade + 1}" id="indice0${quantidade + 1}">
                    </div>

                    <div class="col-md-4 mt-3 campo${quantidade + 1}">
                        <label for="indice" class="form-label">Fator de Redução <i class="fa-solid fa-lock"></i></label>
                        <input type="text" class="form-control padrao" name="fator0${quantidade + 1}" id="fator0${quantidade + 1}" >
                    </div>
                    <div class="col-md-1 mt-3 campo${quantidade + 1}">
                        <a onclick="remove(${quantidade + 1})">  
                            <i class="fas fa-times btn" style="color:white; background-color:Darkred; margin-top:35px"></i>
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