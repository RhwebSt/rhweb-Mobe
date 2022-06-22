$(document).ready(function(){
    $( "#nome_tomador" ).on('keyup focus',function() {
        var dados = '0';
        if ($(this).val()) {
            dados = $(this).val();
            if (dados.indexOf('  ') !== -1) {
                dados = monta_dados(dados);
            }
        }
        $.ajax({
            url: "{{url('tomador/pesquisa')}}/"+dados,
            type: 'get',
            contentType: 'application/json',
            success: function(data) {
                let nome = ''
                if (data.length >= 1) {
                    data.forEach(element => {
                    nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                    // nome += `<option value="${element.tsmatricula}">`
                    nome += `<option value="${element.tscnpj}">`
                    });
                    $('#listatomador').html(nome)
                } 
                if(data.length === 1 && dados.length >= 2){
                    $('#idtomador').val(data[0].tomador)
                }
                if (data[0].tomador && $('#idtrabalhador').val() && $('#comissionado').val() || !data[0].tomador) {
                    $('#incluir').attr('disabled','disabled')
                }else{
                    $('#incluir').removeAttr( "disabled" )
                }
            }
        });
    });
    $( "#nome__trabalhador" ).on('keyup focus',function() {
        var dados = '0';
        if ($(this).val()) {
            dados = $(this).val();
            if (dados.indexOf('  ') !== -1) {
                dados = monta_dados(dados);
            }
        }
        $.ajax({
            url: "{{url('trabalhador/pesquisa')}}/"+dados,
            type: 'get',
            contentType: 'application/json',
            success: function(data) {
                let nome = ''
                if (data.length >= 1) {
                    data.forEach(element => {
                    nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                    // nome += `<option value="${element.tsmatricula}">`
                    nome += `<option value="${element.tscpf}">`
                    });
                    $('#listatrabalhador').html(nome)
                } 
                if(data.length === 1 && dados.length >= 2){
                    $('#idtrabalhador').val(data[0].id)
                    $('#matricula__trab').val(data[0].tsmatricula)
                    comissionador(data[0].id)
                }
                if (data[0].trabalhador && $('#idtomador').val() && $('#comissionado').val() || !data[0].trabalhador) {
                  $('#incluir').attr('disabled','disabled')
                }else{
                  $('#incluir').removeAttr( "disabled" )
                }
            }
        });
    });
    function monta_dados(dados) {
      let novodados = dados.split('  ')
      return novodados[1];
    }
    function comissionador(id) {
        $.ajax({
            url: "{{url('comisionado')}}/"+id,
            type: 'get',
            contentType: 'application/json',
            success: function(data) {
              if (data.id) {
                $('#comissionado').val(data.id);
                // $('#atualizar').removeAttr( "disabled" )
                $('#excluir').removeAttr( "disabled" )
                $('#incluir').attr('disabled','disabled')
                $('#method').val('PUT')
                $('#matricula__trab').val(data.csmatricula)
                $('#indice').val(data.csindece);
                $('#nome_tomador').val(data.tsnome)
                $('#idtomador').val(data.tomador)
                $('#form').attr('action', "{{ url('comisionado')}}/"+data.id);
              }else{
                  // $('#incluir').attr('disabled','disabled')
                //   $('#atualizar').attr('disabled','disabled')
                  $('#excluir').attr( "disabled" )
              }
            }
        })
    }
        });