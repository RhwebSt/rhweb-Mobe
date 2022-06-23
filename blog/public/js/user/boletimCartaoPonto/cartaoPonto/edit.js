 var semana = ["Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado"];
    $('.horas').keyup(function() {
        
        index()
    });
    function index() {
        let diurno = manhao() + tarde()
        let noturno = noite() + madrugada()
        // horaextra()
        // adnoturno(noturno)
        if ("{{$feriado}}" === 'Sim') {
            $('#horas_normais').val(horas(diurno))
            horaextra()
            adnoturno(noturno)
            $('#horas__cem').val(horas(diurno))
            $('#horas_normais').val('00:00')
            console.log('1');
        }else if (verificardata(0) === 'feriador nacional' ) {
            horaextra()
            adnoturno(noturno)
            $('#horas__cem').val(horas(diurno))
            $('#horas_normais').val('00:00')
            console.log('2');
        }else if (verificardata(0) === 'dia normal') {
            $('#horas_normais').val(horas(diurno))
            $('#horas__cem').val('00:00')
            adnoturno(noturno)
            horaextra()
            if (noite() || madrugada()) {
                if (verificardata(1) === 'feriador nacional') {
                    $('#horas__cem').val(horas(diurno))
                    $('#horas_normais').val('00:00')
                    horaextra()
                    adnoturno(noturno)
                }
            }
            console.log('3');
        }else if (verificardata(0) === 'sabado' &&  $('#sabado').val() !== '0') {
            if (noite() || madrugada()) {
                domingo(diurno)
                adnoturno(noturno)
            }else{
                $('#horas_normais').val(horas(diurno))
                $('#horas__cem').val('00:00')
                sabado();
            }
            console.log('5');
        }else if (verificardata(0) === 'domingo' && $('#domingo').val() ||  
        $('#domingo').val() === '0' || $('#sabado').val() === '0' || $('#diasuteis').val() === '0') {
            // $('#horas__cem').val(horas(diurno))
            domingo(diurno)
            adnoturno(noturno)
            console.log('4');
        }
        totalgeral()
    }
    function verificardata(valor) {
        var data = '{{$data}}'
        var dias = '';
        data = data.split('-')
        dias = new Date(`${data[0]}-${data[1]}-${ parseInt(data[2]) + valor} 08:24:30`);
        dias = dias.getDay();
        let resultador = ''
        semana.forEach((element,index) => {
            if (dias == index) {
                if (element === 'Domingo') {
                    resultador =  'domingo'
                }else if (element === 'Sábado') {
                    resultador =  'sabado'
                }
                let novadata = `${data[0]}-${data[1]}-${ parseInt(data[2]) + valor}`
                if (feriador_nacionais(novadata)) {
                    resultador = 'feriador nacional'
                }else if (element !== 'Domingo' && element !== 'Sábado') {
                    resultador =  'dia normal'
                }
            }
        })
        return resultador
    }
    function noite() {
        let noite1 = 0;
        let noite2  = 0;
        let resultado = 0;
        if ($("input[name='entrada3']").val() && $("input[name='saida3']").val()) {
            noite1 = segundos($("input[name='entrada3']").val())
            noite2 = segundos($("input[name='saida3']").val())
        } 
        if (noite1 >= 79200 && noite1 < 86400 && noite2 >= 79200 &&  noite2 < 86400) {
            resultado = (86400 - noite1) - (86400 - noite2);
        }else if (noite1 >= 79200 && noite2 >= 0 && noite2 <= 18000) {
            resultado = (86400 - noite1) + noite2
        }else if (noite1 >= 0 &&  noite2 <= 18000) {
            resultado = noite2 - noite1
        }
        return resultado;
    }
    function madrugada() {
        let madrugada1 = 0;
        let madrugada2  = 0;
        let resultado = 0;
        if ($("input[name='entrada4']").val() && $("input[name='saida4']").val()) {
            madrugada1 = segundos($("input[name='entrada4']").val())
            madrugada2 = segundos($("input[name='saida4']").val())
        } 
        if (madrugada1 >= 79200 && madrugada1 < 86400 && madrugada2 >= 79200 &&  madrugada2 < 86400) {
            resultado = (86400 - madrugada1) - (86400 - madrugada2);
        }else{
            resultado = madrugada2 - madrugada1;
        }
        return resultado;
    }
    function manhao() {
        let manhao1 = 0;
        let manhao2  = 0;
        let resultado = 0;
        if ($("input[name='entrada1']").val() && $("input[name='saida']").val()) {
            manhao1 = segundos($("input[name='entrada1']").val())
            manhao2 = segundos($("input[name='saida']").val())
        }
        if (manhao1 >= 18000 && manhao2 <= 64800) {
            resultado = manhao2 - manhao1
        }
        return resultado
    }
    function tarde() {
        let tarde1 = 0;
        let tarde2  = 0;
        let resultado = 0;
        if ($("input[name='entrada2']").val() && $("input[name='saida2']").val()) {
            tarde1 = segundos($("input[name='entrada2']").val())
            tarde2 = segundos($("input[name='saida2']").val())
        } 
        if (tarde1 >= 43200 && tarde2 <= 79200) {
            resultado = tarde2 - tarde1
        }
        return resultado
    }
    function feriador_nacionais(dados) {
        var verifica = false;
        $.ajax({
            url: "https://brasilapi.com.br/api/feriados/v1/2021",
            type: 'get',
            contentType: 'application/json',
            async: false,
            success:(data) => {
                data.forEach(element => {
                    if (element.date === dados) {
                        verifica = true;
                    }
                });
            }  
        })
        return verifica;
    }
    
    
    function segundos(segundo) {
       
        if (segundo) {
            let tempos = segundo.split(':');
            let calc = parseInt(tempos[0])*3600+parseInt(tempos[1])*60
            return calc;
        }
    }
    function horas(valor) {
        let horas = Math.floor(valor / 3600);
        let minutos = Math.floor((valor - (horas * 3600)) / 60);
        let segundos = Math.floor(valor % 60);
        return `${horas}:${minutos < 10 ? '0':''}${minutos}`
    }
    function adnoturno(noturno) {
        let acresimo = (noturno/3150)
        $('#adc__noturno').val(horasnotunas(acresimo.toString()))
    }
    function horasnotunas(acresimo) {
        let novoacresimo = acresimo.split('.')
        let novoacresimo1 = 0
        if (novoacresimo.length > 1) {
            novoacresimo1 = `0.${novoacresimo[1]}`
        }
        novoacresimo1 = novoacresimo1 * 0.6
        novoacresimo1 = novoacresimo1.toFixed(2)
        novoacresimo1 = (novoacresimo1 * 1) + parseInt(novoacresimo[0])
        novoacresimo1 =  novoacresimo1.toString()
        let novoacresimo2 = novoacresimo1.split('.')
        if (novoacresimo2.length > 1) {
            novoacresimo2 = `${novoacresimo2[0]}:${novoacresimo2[1]}`
        }else{
            novoacresimo2 = `${novoacresimo2[0]}:00`
        }
         return `${novoacresimo2[0]}` != "NaN" ? novoacresimo2:'00:00'
    }
    function totalgeral() {
        let horas_normais = segundos($('#horas_normais').val());
        let horas_extra =  segundos($('#hora__extra').val());
        let noturno = segundos($('#adc__noturno').val());
        let horas_cem = segundos($('#horas__cem').val());
        let total = 0
        if (horas_normais > 0) {
            total += horas_normais
        }
        if (horas_extra > 0) {
            total += horas_extra
        }
        if (noturno > 0) {
            total += noturno
        }
        if (horas_cem) {
            total += horas_cem
        }
        console.log(total);
        $('#total').val(horas(total))
    }
    
    function sabado() {
        let total = $('#horas_normais').val();
        let sabado = $('#sabado').val()
        let result = '';
        if (segundos(sabado) <  segundos(total)) {
            result = (parseInt(segundos(sabado)) - parseInt(segundos(total))) * (-1);
            $('#hora__extra').val(horas(result))
            $('#horas_normais').val(horas(segundos(total) - result))
        }else{
            $('#hora__extra').val("0:00")
        }
    }
    function horaextra() {
        let total = $('#horas_normais').val();
        let diasuteis = $('#diasuteis').val()
        let adc__noturno = $('#adc__noturno').val()
        let sabado = $('#sabado').val();
        let domingo =  $('#domingo').val();
        let dias_uteis = $('#diasuteis').val();
        let result = '';
        
        if (segundos(diasuteis) < segundos(total)) {
            result = (parseInt(segundos(diasuteis)) - parseInt(segundos(total))) * (-1);
            $('#hora__extra').val(horas(result))
            $('#horas_normais').val(horas(segundos(total) - result))
        }else{
            $('#hora__extra').val("0:00")
        }
        if (segundos(sabado) < segundos(adc__noturno)) {
            sabado =  segundos(adc__noturno) - segundos(sabado)
            $('#hora__extra').val(horas(result - sabado))
        }else if (segundos(dias_uteis) < segundos(adc__noturno)) {
            dias_uteis =  segundos(adc__noturno) - segundos(dias_uteis)
            $('#hora__extra').val(horas(result + dias_uteis))
        }else if (segundos(domingo) < segundos(adc__noturno)) {
            domingo =  segundos(adc__noturno) - segundos(domingo)
            $('#hora__extra').val(horas(result - domingo))
        }
        
    }
    
    function domingo(horas_normais) {
        // let horas_normais = segundos($('#horas_normais').val())
        if (horas_normais > 0) {
            $('#horas_normais').val(' ')
            $('#horas__cem').val(horas( horas_normais))
        }
    }
       
                $( "#nome__completo" ).on('keyup focus',function() {
                    var dados = '0';
                    if ($(this).val()) {
                        dados = $(this).val()
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
                            //nome += `<option value="${element.tsmatricula}">`
                              nome += `<option value="${element.tscpf}">`
                            });
                            $('#datalistOptions').html(nome)
                            
                          }
                          if(data.length === 1 && dados.length > 4){
                            $('#trabalhador').val(data[0].id)
                            $('#matricula').val(data[0].tsmatricula)
                            boletim(dados)
                          }else{
                            campos()
                          }              
                        }
                    });
                });
                function monta_dados(dados) {
                  let novodados = dados.split('  ')
                  return novodados[1];
                }
                function campos() {
                    $('#form').attr('action', "{{route('boletimcartaoponto.store')}}");
                    $('#atualizar').attr('disabled','disabled')
                    $('#method').val(' ')
                    $('#incluir').removeAttr( "disabled" )
                    $('#trabalhador').val(' ')
                    $('#matricula').val(' ')
                    $('#entrada1').val(' ')
                    $('#saida').val(' ')
                    $('#entrada2').val(' ')
                    $('#saida2').val(' ')
                    $('#entrada3').val(' ')
                    $('#saida3').val(' ')
                    $('#entrada4').val(' ')
                    $('#saida4').val(' ')
                    $('#horas_normais').val(' ')
                    $('#total').val(' ')
                    $('#hora__extra').val(' ')
                    $('#horas__cem').val(' ')
                    $('#adc__noturno').val(' ')
                }
                function boletim(dados) {
                    $('#carregamento').removeClass('d-none')
                    $.ajax({
                        url: `{{url('boletim/cartao/ponto')}}/${dados}/${$('#lancamento').val()}/{{$data}}`,
                        type: 'get',
                        contentType: 'application/json',
                        success: function(data) {
                            $('#carregamento').addClass('d-none')
                            if (data.id) {
                                $('#form').attr('action', "{{ url('boletimcartaoponto')}}/"+data.id);
                                $('#formdelete').attr('action',"{{ url('boletimcartaoponto')}}/"+data.id)
                                $('#incluir').attr('disabled','disabled')
                                $('#atualizar').removeAttr( "disabled" )
                                // $('#deletar').removeAttr( "disabled" )
                                $('#excluir').removeAttr( "disabled" )
                                $('#method').val('PUT')
                                $('#trabalhador').val(data.trabalhador)
                                $('#matricula').val(data.tsmatricula)
                                $('#entrada1').val(data.bsentradamanhao)
                                $('#saida').val(data.bssaidamanhao)
                                $('#entrada2').val(data.bsentradatarde)
                                $('#saida2').val(data.bssaidatarde)
                                $('#entrada3').val(data.bsentradanoite)
                                $('#saida3').val(data.bssaidanoite)
                                $('#entrada4').val(data.bsentradamadrugada)
                                $('#saida4').val(data.bssaidamadrugada)
                                $('#horas_normais').val(data.horas_normais)
                                $('#total').val(data.bstotal)
                                $('#hora__extra').val(data.bshoraex)
                                $('#horas__cem').val(data.bshoraexcem)
                                $('#adc__noturno').val(data.bsadinortuno)
                                index()
                            }
                        }
                    });
                }