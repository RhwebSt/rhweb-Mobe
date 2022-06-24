function botaoModal (tomador){
    Swal.fire({
        title: 'Periodo',
        html:
        '<input type="date" name="inicio" id="swal-input1" class="swal2-input">' +
        '<input type="date" name="final" id="swal-input2" class="swal2-input">',
       Label: 'teste',
        confirmButtonText: 'Buscar',
        showDenyButton: true,
        denyButtonText: 'Sair',
        showConfirmButton: true,
        focusConfirm: false,
        preConfirm: () => {
            if (!document.getElementById('swal-input1').value || !document.getElementById('swal-input1').value) {
                Swal.showValidationMessage('Preencha todos os campos')   
            }else{
                let inicio =  document.getElementById('swal-input1').value
                let final = document.getElementById('swal-input2').value
                // let tomador = document.getElementById('tomador').value
                location.href=`${window.Laravel.tomador.boletim}/${tomador}/${inicio}/${final}`;
            } 
            
        }
    });
}



// modal de colocar o nome fantasia como o principal//
var radio = document.getElementById("radio");
var radioResult = radio.value;


radio.addEventListener('click', function(){
    
    if(radio.checked){
        
        Swal.fire({
        icon: 'warning',
          title: 'Deseja definir esse nome como padrão?',
          showDenyButton: true,
          allowOutsideClick: false,
          allowEscapeKey: false,
          confirmButtonText: 'Sim <i class="far fa-check-circle"></i>',
          confirmButtonColor: '#40A06B',
          denyButtonText: `Não <i class="far fa-times-circle"></i>`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            Swal.fire('Definido com sucesso!!', '', 'success');
            radio.checked = true;
          } else if (result.isDenied) {
            Swal.fire('Nada foi alterado!!', '', 'info')
            radio.checked = false;
          }
        })

    }
})

//fim do nome fantasia com o principal//


    // faz com que quando algum campo que está dentro do accordion não for preenchido
    // ele abra e não deixe enviar o formulário até que tudo esteje preenchido.
    function verificaCampoObrigatorioAccordion(){

        $('#incluir').click(function(e){
            var cep = $('#cep').val();
            var logradouro = $('#logradouro').val();
            var numero = $('#numero').val();
            var bairro = $('#bairro').val();
            var localidade = $('#localidade').val();
            var uf = $('#uf').val();
            var diasUteis = $('#dias_uteis').val();
            
            // descobri na onde a section esta posicionada na tela//
            let div = document.querySelector("#divEndereco");
            let divCoordenadas = div.getBoundingClientRect();
            // fim//
            
            var valorBottom = divCoordenadas.y;
            var valorTop = divCoordenadas.x;
            
            if(cep, logradouro, numero, bairro, localidade, uf, diasUteis != ""){
                $('#endereco__accordion').removeClass('show');
                $('#endereco__accordion').removeClass('collapse');
                $('#cartaoPonto__accoordion').removeClass('show');
                $('#cartaoPonto__accoordion').removeClass('collapse');
                event.defaultPrevented;
            }else{
                e.preventDefault(); 
                $('#endereco__accordion').addClass('show');
                $('#endereco__accordion').addClass('collapse');
                $('#cartaoPonto__accoordion').addClass('show');
                $('#cartaoPonto__accoordion').addClass('collapse');
                // caso não tiver preenchido ele leva até a section que não foi preenchida
                window.scrollTo(valorTop, valorBottom);
                //fim
            }

        });
    }
    
    verificaCampoObrigatorioAccordion();
    // fim da verificação do accordion//

    
$(document).ready(function(){
   
    // $('#pesquisa').on('keyup focus',function(){
    //     var dados = '0';
    //     if ($(this).val()) {
    //         dados = $(this).val();
    //         if (dados.indexOf('  ') !== -1) {
    //             dados = monta_dados(dados);
    //         }
    //     }
    //     $('#icon').addClass('d-none').next().removeClass('d-none')
        
    // })
    $.ajax({
            url: "{{url('tomador')}}/pesquisa/"+0,
            type: 'get',
            contentType: 'application/json', 
            success: function(data) {
                let nome = ''
                $('#refres').addClass('d-none').prev().removeClass('d-none')
                if (data.length >= 1) {
                    data.forEach(element => {
                    nome += `<option value="${element.tsnome}">`
                    // nome += `<option value="${element.tsmatricula}">`
                    // nome += `<option value="${element.tscnpj}">`
                    });
                    $('#listapesquisa').html(nome)
                } 
                // if(data.length === 1 && dados.length >= 2){
                //     tomador(dados)
                // }else if (dados.length === 14) {
                //     pesquisa(dados)
                // }else{
                //     campo()
                // }         
             }
        });
    $('#cnpj').on('change',function(){
        let dados = $(this).val();
        dados = dados.replace(/\D/g, '');
        pesquisa(dados)
    })
    function monta_dados(dados) {
      let novodados = dados.split('  ')
      return novodados[1];
    }
    function tomador(dados) {
        $('#carregamento').removeClass('d-none')
        $.ajax({
            url: "{{url('tomador')}}/"+dados,
            type: 'get',
            contentType: 'application/json', 
            success: function(data) {
                carregado(data)
                $('#carregamento').addClass('d-none')
            }
        })
    }
    function campo() {
        $('#carregamento').addClass('d-none')
        $('#relatoriotomador').addClass('disabled')
        $('#form').attr('action', "{{ route('tomador.cadastra') }}");
        $('#incluir').removeAttr( "disabled" )
        $('#atualizar').attr('disabled','disabled')
        $('#deletar').attr('disabled','disabled')
        $('#method').val(' ')
        $('#excluir').attr( "disabled",'disabled' )
        $('#tabelapreco').addClass('disabled').removeAttr('href')
        for (let index = 0; index < $('.input').length; index++) {
           $('.input').eq(index).val(' ')
        }
    }
    function carregado(data) {
        if (data.id) {
            $('#form').attr('action', "{{ url('tomador')}}/"+data.tomador);
            $('#formdelete').attr('action',"{{ url('tomador')}}/"+data.tomador) 
            $('#incluir').attr('disabled','disabled')
            $('#atualizar').removeAttr( "disabled" )
            $('#deletar').removeAttr( "disabled" )
            $('#excluir').removeAttr( "disabled" )
            $('#tabelapreco').removeClass('disabled').attr('href',"{{ url('tabelapreco')}}/ /"+btoa(data.tomador))
            $('#esocial').removeClass('disabled').attr('href',"{{ url('esocial/tomador')}}/"+btoa(data.tomador))
            $('#method').val('PUT')
            $('#tomador').val(data.tomador);
            $('#relatoriotomador').removeClass('disabled')
        }
        $('#nome__completo').val(data.tsnome)
        $('#cnpj').val(data.tscnpj)
        $('#matricula').val(data.tsmatricula).next().text(' ')
        $('#matricularid').val(data.tsmatricula).next().text(' ')
        $('#nome__fantasia').val(data.tsfantasia)
        $('#simples').val(data.tssimples)
        $('#telefone').val(data.tstelefone)
        $('#cep').val(data.escep)
        $('#logradouro').val(data.eslogradouro)
        $('#numero').val(data.esnum)
        // $('#tipo').val(data.estipo)
        $('#bairro').val(data.esbairro)
        $('#localidade').val(data.esmunicipio)
        $('#uf').val(data.esuf)
        $('#complemento').val(data.escomplemento)
        $('#taxa_adm').val(data.tftaxaadm.toFixed(2).toString().replace(".", ","))
        // $('#caixa_benef').val(data.tfbenef.toFixed(2).toString().replace(".", ","))
        // $('#ferias').val(data.tfferias.toFixed(2).toString().replace(".", ","))
        // $('#13_salario').val(data.tf13.toFixed(2).toString().replace(".", ","))
        $('#taxa__fed').val(data.tftaxafed.toFixed(2).toString().replace(".", ","))
        // $('#ferias_trab').val(data.tsferias.toFixed(2).toString().replace(".", ","))
        // $('#13__saltrab').val(data.tsdecimo13.toFixed(2).toString().replace(".", ","))
        // $('#rsr').val(data.tsrsr.toFixed(2).toString().replace(".", ","))
        $('#das').val(data.tfdas.toFixed(2).toString().replace(".", ","))
        $('#cod__fpas').val(data.psfpas)
        $('#cod__grps').val(data.psgrps)
        $('#cod__recol').val(data.psresol)
        $('#cnae').val(data.pscnae)
        $('#fap__aliquota').val(data.psfapaliquota.toFixed(2).toString().replace(".", ","))
        $('#rat__ajustado').val(data.psratajustados.toFixed(2).toString().replace(".", ","))
        $('#fpas__terceiros').val(data.psfpasterceiros)
        $('#aliq__terceiros').val(data.psaliquotaterceiros.toString().replace(".", ","))
        $('#esocial').val(data.pssocial)
        $('#alimentacao').val(data.isalimentacao.toFixed(2).toString().replace(".", ","))
        $('#transporte').val(data.istransporte.toFixed(2).toString().replace(".", ","))
        $('#epi').val(data.isepi.toFixed(2).toString().replace(".", ","))
        $('#seguro__trabalhador').val(data.isseguroportrabalhador.toString().replace(".", ","))
        // $('#indice__folha').val(data.isindecesobrefolha)
        // $('#valor__transporte').val(data.isvaletransporte.toFixed(2).toString().replace(".", ","))
        // $('#valor__alimentacao').val(data.isvalealimentacao.toFixed(2).toString().replace(".", ","))
        $('#dias_uteis').val(data.csdiasuteis)
        $('#sabados').val(data.cssabados)
        $('#domingos').val(data.csdomingos)
        // $('#inss__empresa').val(data.rsinssempresa.toFixed(2).toString().replace(".", ","))
        // $('#fgts__empresa').val(data.rsfgts.toFixed(2).toString().replace(".", ","))
        // $('#valor_fatura').val(data.rsvalorfatura.toFixed(2).toString().replace(".", ","))
        $('#nome__conta').val(data.bstitular)
        $('#banco').val(data.bsbanco)
        $('#agencia').val(data.bsagencia)
        $('#operacao').val(data.bsoperacao)
        $('#cod__fap').val(data.psconfpas)
        $('#conta').val(data.bsconta)
        $('#pix').val(data.bspix)
        $('#folhartransporte').val(data.instransporte.toFixed(2).toString().replace(".", ","))
        $('#folharalim').val(data.insalimentacao.toFixed(2).toString().replace(".", ","))
        $('#deflator').val(data.tfdefaltor)
        $('#endereco').val(data.eiid)
        $('#bancario').val(data.biid)
        for (let index = 0; index <  $('#tipo option').length; index++) {  
            if (data.tstipo == $('#tipo option').eq(index).text()) {
                $('#tipo option').eq(index).attr('selected','selected')
            }else  {
                $('#tipo option').eq(index).removeAttr('selected')
            }
        }
        for (let index = 0; index <  $('#simple option').length; index++) {  
            if (data.tssimples == $('#simple option').eq(index).text()) {
                $('#simple option').eq(index).attr('selected','selected')
            }else  {
                $('#simple option').eq(index).removeAttr('selected')
            }
        }
        for (let index = 0; index <  $('#complemento__endereco option').length; index++) {  
            if (data.escomplemento == $('#complemento__endereco option').eq(index).text()) {
                
                $('#complemento__endereco option').eq(index).attr('selected','selected')
            }else  {
                $('#complemento__endereco option').eq(index).removeAttr('selected')
            }
        }
        
        for (let index = 0; index <  $('#folhartipotrans option').length; index++) {  
            if (data.instipotrans == $('#folhartipotrans option').eq(index).text()) {
                
                $('#folhartipotrans option').eq(index).attr('selected','selected')
            }else  {
                $('#folhartipotrans option').eq(index).removeAttr('selected')
            }
        }
        for (let index = 0; index <  $('#folhartipoalim option').length; index++) {  
            if (data.instipoali == $('#folhartipoalim option').eq(index).text()) {
                
                $('#folhartipoalim option').eq(index).attr('selected','selected')
            }else  {
                $('#folhartipoalim option').eq(index).removeAttr('selected')
            }
        }
        for (let index = 0; index <  $('#retencaofgts option').length; index++) {  
            if (data.rstipofgts == $('#retencaofgts option').eq(index).text()) {
                
                $('#retencaofgts option').eq(index).attr('selected','selected')
            }else  {
                $('#retencaofgts option').eq(index).removeAttr('selected')
            }
        }
        for (let index = 0; index <  $('#retencaoinss option').length; index++) {  
            if (data.rstipoinssempresa == $('#retencaoinss option').eq(index).text()) {
                
                $('#retencaoinss option').eq(index).attr('selected','selected')
            }else  {
                $('#retencaoinss option').eq(index).removeAttr('selected')
            }
        }
        for (let index = 0; index <  $('#valorfatura option').length; index++) {  
            if (data.rsvalorfatura == $('#valorfatura option').eq(index).text()) {
                
                $('#valorfatura option').eq(index).attr('selected','selected')
            }else  {
                $('#valorfatura option').eq(index).removeAttr('selected')
            }
        }
    }
    function pesquisa(dados) {
        $.ajax({
            url: "https://brasilapi.com.br/api/cnpj/v1/"+dados,
            type: 'get',
            contentType: 'application/json',
            success: function(data) {
                // for (let index = 0; index < $('.input').length; index++) {
                //     $('.input').eq(index).val(' ')
                // }
                if (data) {
                    $('#nome__completo').val(data.razao_social)
                    $('#nome__fantasia').val(data.nome_fantasia)
                    $('#telefone').val(data.ddd_telefone_1)
                    $('#cnae').val(data.cnae_fiscal)
                    $('#cep').val(data.cep)
                    $('#cnpj').val(data.cnpj.replace(/(\d{2})?(\d{3})?(\d{3})?(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
                    $('#logradouro').val(data.logradouro)
                    $('#numero').val(data.numero)
                    $('#bairro').val(data.bairro)
                    $('#localidade').val(data.municipio)
                    $('#uf').val(data.uf)
                    $('#telefone').val(data.ddd_telefone_1)
                    $('#complemento').val(data.descricao_tipo_logradouro)
                }else{
                    $('#nome__completo').val(' ')
                    $('#nome__fantasia').val(' ')
                    $('#telefone').val(' ')
                    $('#cnae').val(' ')
                    $('#cep').val(' ')
                    // $('#cnpj').val(' ')
                    $('#logradouro').val(' ')
                    $('#numero').val(' ')
                    $('#bairro').val(' ')
                    $('#localidade').val(' ')
                    $('#uf').val(' ')
                    $('#telefone').val(' ')
                    $('#complemento').val(' ')
                }
                $("#pesquisa").removeClass('is-invalid')
                
                $('#mensagem-pesquisa').text(' ').addClass('valid-feedback',).removeClass('invalid-feedback')
            },
            error: function(data){
                // $("#pesquisa").addClass('is-invalid')
                // $('#nome__completo').val(' ')
                // $('#nome__fantasia').val('')
                // $('#cnpj').val('')
                // $('#telefone').val(' ')
                // $('#cnae').val(' ')
                // $('#mensagem-pesquisa').text( data.responseJSON.message).removeClass('valid-feedback').addClass('invalid-feedback')
                    $('#nome__completo').val(' ')
                    $('#nome__fantasia').val(' ')
                    $('#telefone').val(' ')
                    $('#cnae').val(' ')
                    $('#cep').val(' ')
                    // $('#cnpj').val(' ')
                    $('#logradouro').val(' ')
                    $('#numero').val(' ')
                    $('#bairro').val(' ')
                    $('#localidade').val(' ')
                    $('#uf').val(' ')
                    $('#telefone').val(' ')
                    $('#complemento').val(' ')
            }
        })
    }
});