@extends('administrador.layouts.index')
@section('titulo','Rhweb - Inss')
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
    <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('inss.store')}}">

        <h1 class="container text-center mt-4 mb-2 fs-4 fw-bold">INSS</h1>

        <input type="hidden" name="user" value="">
        @csrf
        <input type="hidden" id="method" name="_method" value="">

        <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
            <button type="submit" id="incluir" class="btn botao">
                <i class="fad fa-save"></i> Incluir
            </button>


            <a class="btn botao" href="{{route('inss.index')}}" role="button"><i class="fad fa-sign-out-alt"></i> Sair</a>
        </div>

        <div class="container block" >
            <div class="col-md-1">
                <label for="ano" class="form-label">Ano
                    <span id="refre" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpar todos os campos" style="background-color:#A71113; padding: 0.6px 4px; border: 1px solid #DF1619; border-radius: 20px;"><i class="fad fa-sync-alt " style="color: #fff"></i></span>
                </label>
                <input type="text" class="form-control @error('isano') is-invalid @enderror" name="isano" value="  {{ old('ano')}}" id="ano">
                @error('isano')
                <span class="text-danger">{{ $message }}</span>
                @enderror
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

            <div class="col-md-4 ">
                <label for="indice" class="form-label">Fator de Redução <i class="fa-solid fa-lock"></i></label>
                <input type="text" class="form-control padrao" name="fator01" id="fator01" readonly>
            </div>
        </div>


        <!-- <div class="col-md-4">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final02" id="valor__final02">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control resultado" name="indice02" id="indice02">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Fator de Redução <i class="fa-solid fa-lock"></i></label>
                    <input type="text" class="form-control" name="fator02" id="fator02" readonly>
                </div>


                <div class="col-md-4">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final03" id="valor__final03">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control resultado" name="indice03" id="indice03">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Fator de Redução <i class="fa-solid fa-lock"></i></label>
                    <input type="text" class="form-control" name="fator03" id="fator03" readonly>
                </div>


                <div class="col-md-4">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control resultado" name="valor__final04" id="valor__final04">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control resultado" name="indice04" id="indice04">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Fator de Redução <i class="fa-solid fa-lock"></i></label>
                    <input type="text" class="form-control " name="fator04" id="fator04" readonly>
                </div>


                <div class="col-md-4">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final05" id="valor__final05">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control resultado" name="indice05" id="indice05">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Fator de Redução <i class="fa-solid fa-lock"></i></label>
                    <input type="text" class="form-control" name="fator05" id="fator05" readonly>
                </div> -->
        <input type="hidden" id="quantidade" name="quantidade" value="1">
    </form>
    <button id="adicionar" class="btn">
        <i class="fad fa-save"></i> Adicionar
    </button>
</div>
<script>
    // function validaInputQuantidade(idCampo,QuantidadeCarcteres){
    //     var telefone = document.querySelector(idCampo);

    //     telefone.addEventListener('input', function(){
    //         var telefone = document.querySelector(idCampo);
    //         var result = telefone.value;
    //         if(result > " " && result.length >= QuantidadeCarcteres){
    //           telefone.classList.add('is-valid');  
    //         }else{
    //             telefone.classList.remove('is-valid');
    //         }

    //     });
    // }

    // var ano = validaInputQuantidade("#ano",4);
    // var valorFinal01 = validaInputQuantidade("#valor__final01",1);
    // var indice01 = validaInputQuantidade("#indice01",1);
    // var valorFinal02 = validaInputQuantidade("#valor__final02",1);
    // var indice01 = validaInputQuantidade("#indice02",1);
    // var valorFinal03 = validaInputQuantidade("#valor__final03",1);
    // var indice03 = validaInputQuantidade("#indice03",1);
    // var valorFinal04 = validaInputQuantidade("#valor__final04",1);
    // var indice04 = validaInputQuantidade("#indice04",1);
    // var valorFinal05 = validaInputQuantidade("#valor__final05",1);
    // var indice05 = validaInputQuantidade("#indice05",1);
    // var botaolimpaCampos = document.querySelector("#refre");

    // botaolimpaCampos.addEventListener('click', function(){
    //     var ano = document.querySelector("#ano").value='';
    //     var valorFinal01 = document.querySelector("#valor__final01").value='';
    //     var indice01 = document.querySelector("#indice01").value='';
    //     var fator01 = document.querySelector("#fator01").value='';
    //     var valorFinal02 = document.querySelector("#valor__final02").value='';
    //     var indice02 = document.querySelector("#indice02").value='';
    //     var fator02 = document.querySelector("#fator02").value='';
    //     var valorFinal03 = document.querySelector("#valor__final03").value='';
    //     var indice03 = document.querySelector("#indice03").value='';
    //     var fator03 = document.querySelector("#fator03").value='';
    //     var valorFinal04 = document.querySelector("#valor__final04").value='';
    //     var indice04 = document.querySelector("#indice04").value='';
    //     var fator04 = document.querySelector("#fator04").value='';
    //     var valorFinal05 = document.querySelector("#valor__final05").value='';
    //     var indice05 = document.querySelector("#indice05").value='';
    //     var fator05 = document.querySelector("#fator05").value='';
    // });


    function remove(index) {
            $(`.campo${index}`).remove();
            let quantidade = parseInt($('#quantidade').val());
            $('#quantidade').val(quantidade - 1);
    }

    $(document).ready(function() {
        $('.padrao').mask('000.000.000.000.000,00', {reverse: true});
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
                        <input type="text" class="form-control padrao" name="fator0${quantidade + 1}" id="fator0${quantidade + 1}" readonly>
                    </div>
                    <div class="col-md-1 campo${quantidade + 1}">
                    <a onclick="remove(${quantidade + 1})">  
                            <i class="fas fa-times btn" style="color:white; background-color:Darkred; padding-top: 8px; padding-bottom: 8px; padding-left:10px; padding-right:10px; border-radius: 30%; border: 1px solid red;"></i>
                    </a>
                    </div>`
                $('#quantidade').val(quantidade + 1);
                $('#container').append(campos)
                $('.padrao').mask('000.000.000.000.000,00', {reverse: true});
                $('.resultado').keyup(function() {
                    let indice = $(this).attr('name')
                    indice = indice.split('')
                    let valor = $(`#valor__final${indice[6]}${indice[7]}`).val().replace(/\./g, "").replace(/,/g, ".")
                    let resultado = (parseFloat($(this).val().toString().replace(",", ".")) / 100) * parseFloat(valor);
                    if (resultado > 0) {
                        $(`#fator${indice[6]}${indice[7]}`).val(resultado.toFixed(2).replace(".", ","))
                    }
                })
            }else{
                alert('off')
            }
        })
  
        // $( "#ano" ).change(function() {
        //     var dados = $( this ).val();
        //     $.ajax({
        //         url: "{{url('inss')}}/"+dados,
        //         type: 'get',
        //         contentType: 'application/json',
        //         success: function(data) {

        //             if (data[0].user) {
        //                 $('#form').attr('action', "{{ url('inss')}}/"+data[0].user);
        //                 $('#formdelete').attr('action',"{{ url('inss')}}/"+data[0].isano)
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
        //                 $('#valor__inicial0'+(index+1)).val(element.isvalorinicial)
        //                 $('#valor__final0'+(index+1)).val(element.isvalorfinal)
        //                 $('#indice0'+(index+1)).val(element.isindece)
        //                 $('#fator0'+(index+1)).val(element.isreducao)
        //                 $('#id0'+(index+1)).val(element.id)
        //             });
        //         }
        //     });
        // });
        $('.resultado').keyup(function() {
            let indice = $(this).attr('name')
            indice = indice.split('')
            let valor = $(`#valor__final${indice[6]}${indice[7]}`).val().replace(/\./g, "").replace(/,/g, ".")
            let resultado = (parseFloat($(this).val().toString().replace(",", ".")) / 100) * parseFloat(valor);
            if (resultado > 0) {
                $(`#fator${indice[6]}${indice[7]}`).val(resultado.toFixed(2).replace(".", ","))
            }
        })
    });
</script>
@stop