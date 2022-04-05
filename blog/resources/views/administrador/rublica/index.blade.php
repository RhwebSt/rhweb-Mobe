@extends('layouts.index')
@section('titulo','Rhweb - Rúbricas')
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
            title: '{{ session("success") }}'
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

    
    <section class="section__form-rubrica">
        <form class="row g-3 mt-1 mb-3 mt-5" id="form" method="POST" action="{{route('rublica.store')}}">
            <input type="hidden" name="empresa" value="{{$user->empresa}}">
            <input type="hidden" id="method" name="_method" value="">
            @csrf
            <div class="row">
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                    <button type="submit" id="incluir" class="btn button__incluir--rubrica" value="Validar!"><i class="fad fa-save"></i> Incluir</button>
                    
                    <button class="btn botao dropdown-toggle" type="button" id="relatoriotrabalhador" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fad fa-file-alt"></i> Relatórios
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="relatoriotrabalhador">
                        <li class=""><a href="{{route('relatorio.rublica')}}" class="dropdown-item text-decoration-none ps-2" id="imprimir" role="button">Rol das Rúbricas</a></li>
                    </ul>
                    
                    <a class="btn button__sair--rubrica" href="#" role="button"><i class="fad fa-sign-out-alt"></i> Sair</a>
                </div>
            </div>
            <h1 class="container text-center mt-4 mb-2 fs-3 fw-bold">Rúbricas</h1>
    
            <div class="col-md-2">
                <label for="rubricas" class="form-label">Rúbricas
                    <span id="refre" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpar todos os campos" style="background-color:#A71113; padding: 0.6px 4px; border: 1px solid #DF1619; border-radius: 20px;"><i class="fad fa-sync-alt " style="color: #fff"></i></span>
                </label>
                <input type="text" class="form-control @error('rubricas') is-invalid @enderror fw-bold" name="rubricas" id="rubricas" value="{{old('rubricas')}}">
                @error('rubricas')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="col-md-6">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control @error('descricao') is-invalid @enderror fw-bold" name="descricao" id="descricao" value="{{old('descricao')}}">
                @error('descricao')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
    
            <div class="col-md-2">
                <label for="incidencia" class="form-label">Indice</label>
                <select id="incidencia" name="incidencia" class="form-select fw-bold text-dark fw-bold" value="">
                    <option selected>Sim</option>
                    <option>Não</option>
                </select>
            </div>
    
            <div class="col-md-2">
                <label for="dc" class="form-label">D/C</label>
                <select id="dc" name="dc" class="form-select fw-bold text-dark fw-bold" value="">
                    <option selected>Créditos</option>
                    <option>Descontos</option>
                </select>
            </div>
        </form>
    </section>



</div>
<script>
    $('.modal-botao').click(function() {
        localStorage.setItem("modal", "enabled");
    })

    function verficarModal() {
        var valueModal = localStorage.getItem('modal');
        if (valueModal === "enabled") {
            $(document).ready(function() {
                $("#teste").modal("show");
            });
            localStorage.setItem("modal", "disabled");
        }
    }
    verficarModal()

    function validaInputQuantidade(idCampo, QuantidadeCarcteres) {
        var telefone = document.querySelector(idCampo);

        telefone.addEventListener('input', function() {
            var telefone = document.querySelector(idCampo);
            var result = telefone.value;
            if (result > " " && result.length >= QuantidadeCarcteres) {
                telefone.classList.add('is-valid');
            } else {
                telefone.classList.remove('is-valid');
            }

        });
    }

    var rubricas = validaInputQuantidade("#rubricas", 1);
    var descricao = validaInputQuantidade("#descricao", 1);

    var botaolimpaCampos = document.querySelector("#refre");

    botaolimpaCampos.addEventListener('click', function() {
        var rubricas = document.querySelector("#rubricas").value = '';
        var descricao = document.querySelector("#descricao").value = '';
        var indice = document.querySelector("#incidencia").value = '';
        var dc = document.querySelector("#dc").value = '';
    });



    $('#pesquisa').on('focus keyup', function() {
        let dados = 0;
        if ($(this).val()) {
            dados = $(this).val()
        }
        $.ajax({
            url: "{{url('rublica/pesquisa')}}/" + dados,
            type: 'get',
            contentType: 'application/json',
            success: function(data) {
                let nome = ''
                if (data.length >= 1) {
                    data.forEach(element => {
                        nome += `<option value="${element.rsdescricao}">`
                        nome += `<option value="${element.rsrublica}">`
                    });
                    $('#listapesquisa').html(nome)
                }
                // if(data.length === 1 && dados.length >= 4){
                //     buscaItem(dados)
                // }
            }
        })
    })

    function buscaItem(dados) {
        $.ajax({
            url: "{{url('rublica')}}/" + dados,
            type: 'get',
            contentType: 'application/json',
            success: function(data) {
                campos(data);
            }
        })
    }

    function campos(data) {
        if (data.id) {
            $('#form').attr('action', "{{ url('rublica')}}/" + data.id);
            $('#formdelete').attr('action', "{{ url('rublica')}}/" + data.id)
            $('#incluir').attr('disabled', 'disabled')
            $('#atualizar').removeAttr("disabled")
            $('#deletar').removeAttr("disabled")
            $('#excluir').removeAttr("disabled")
            $('#method').val('PUT')
        } else {

            $('#form').attr('action', "{{ route('rublica.store') }}");
            $('#incluir').removeAttr("disabled")
            $('#atualizar').attr('disabled', 'disabled')
            $('#deletar').attr('disabled', 'disabled')
            $('#method').val(' ')
            $('#excluir').attr("disabled")
        }
        $('#descricao').val(data.rsdescricao)
        $('#incidencia').val(data.rsincidencia)
        $('#rubricas').val(data.rsrublica)
        for (let index = 0; index < $('#dc option').length; index++) {
            if (data.rsdc == $('#dc option').eq(index).text()) {
                $('#dc option').eq(index).attr('selected', 'selected')
            } else {
                $('#dc option').eq(index).removeAttr('selected')
            }
        }
    }
    // $( "#rubricas" ).keyup(function() {
    //     var dados = $(this).val();
    //     $.ajax({
    //         url: "{{url('rublica')}}/"+dados,
    //         type: 'get',
    //         contentType: 'application/json',
    //         success: function(data) {
    //             if (data.id) {
    //                 $('#form').attr('action', "{{ url('rublica')}}/"+data.id);
    //                 $('#formdelete').attr('action',"{{ url('rublica')}}/"+data.id)
    //                 $('#incluir').attr('disabled','disabled')
    //                 $('#atualizar').removeAttr( "disabled" )
    //                 $('#deletar').removeAttr( "disabled" )
    //                 $('#excluir').removeAttr( "disabled" )
    //                 $('#method').val('PUT')
    //             }else{

    //                 $('#form').attr('action', "{{ route('rublica.store') }}");
    //                 $('#incluir').removeAttr( "disabled" )
    //                 $('#atualizar').attr('disabled','disabled')
    //                 $('#deletar').attr('disabled','disabled')
    //                 $('#method').val(' ')
    //                 $('#excluir').attr( "disabled" )
    //             }
    //             $('#descricao').val(data[0].rsdescricao)
    //             $('#incidencia').val(data[0].rsincidencia)

    //             for (let index = 0; index <  $('#dc option').length; index++) {  
    //               if (data[0].rsdc == $('#dc option').eq(index).text()) {
    //                 $('#dc option').eq(index).attr('selected','selected')
    //               }else  {
    //                 $('#dc option').eq(index).removeAttr('selected')
    //               }
    //             }

    //         }
    //     });
    // });
</script>
@stop