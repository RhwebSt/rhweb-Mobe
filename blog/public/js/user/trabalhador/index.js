// faz com que quando algum campo que está dentro do accordion não for preenchido//
// ele abra e não deixe enviar o formulário até que tudo esteje preenchido.//
function verificaCampoObrigatorioAccordion(){

    $('#incluir').click(function(e){
        var cep = $('#cep').val();
        var logradouro = $('#logradouro').val();
        var numero = $('#numero').val();
        var bairro = $('#bairro').val();
        var localidade = $('#localidade').val();
        var uf = $('#uf').val();
        
        let div = document.querySelector("#divEndereco");
        let divCoordenadas = div.getBoundingClientRect();
        
        var valorBottom = divCoordenadas.y;
        var valorTop = divCoordenadas.x;

        if(cep, logradouro, numero, bairro, localidade, uf != ""){
            $('#localResidencia').removeClass('show');
            $('#localResidencia').removeClass('collapse');
            event.defaultPrevented;
            

        }else{
            e.preventDefault(); 
            $('#localResidencia').addClass('show');
            $('#localResidencia').addClass('collapse');
            window.scrollTo(valorTop, valorBottom);
            
            
        }

    });
    
    
}



verificaCampoObrigatorioAccordion();
// fim da verificação do accordion//

// definir nome social como principal//
var radio = document.getElementById("radio");
    var radioResult = radio.value;


    radio.addEventListener('click', function() {

    if (radio.checked) {

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
  });

// fim do definição do nome social//




  function encodeImageFileAsURL(element) {
    var file = element.files[0];
    var ext = ['jpg', 'jpeg', 'png', 'svg', 'tiff', 'webp']
    var type = file.type.split('/')
    if (file.size < 3145728) {
      if (ext.indexOf(type[1]) >= 1) {
        foto(file)
      } else {
        $('#msgfoto').text('A extensão não é suportada. Apenas(jpg, png,svg,tiff,webp)')
      }
    } else {
      $('#msgfoto').text('O tamanho suportado é até 3MB')
    }
  }

  function foto(file) {
    var reader = new FileReader();
    reader.onloadend = function() {
      $('#foto').val(reader.result)
      $('#trabfoto').attr('src', reader.result)
    }
    reader.readAsDataURL(file);
  }

  $(document).ready(function() {
    let paisnascimento = ''
    let cbolist = ''
    let categorialist = ''

    $('#pais__nacionalidade,#pais__nascimento').on('keyup focus', function() {
      if (!$(this).val()) {
        paisnascimento = ''
        paisnascimentolista(pais__nascimento)
      }
    })

    function paisnascimentolista(pais__nascimento) {
      pais__nascimento.forEach(element => {
        paisnascimento += `<option value="${element}">`
      });
      $('#pais_nascimento_list').html(paisnascimento)
      $('#pais_nacionalidade_list').html(paisnascimento)
    }
    paisnascimentolista(pais__nascimento)


    $('.form-check-input').click(function() {
      if ($(this).val() === 'option1') {
        $('#formrelatorioempresa').attr('action', "")
      } else if ($(this).val() === 'option2') {
        $('#formrelatorioempresa').attr('action', "")
      }
    })
    // $('#cbo').on('keyup focus', function() {
    //   // if (!$(this).val()) {
    //   //   cbolista(cbo);
    //   // }
    // })
    $.ajax({
      url: "{{route('administrador.cbo.pesquisa')}}",
      type: 'get',
      contentType: 'application/json',
      success: function(data) {
          let nome = ''
          data.forEach(element => {
              nome += `<option value="${element.cscodigo}-${element.csdescricao}">`
              // nome += `<option value="${element.csdescricao}">`
          });
          $('#cbo_list').html(nome)
      }
    })
    $.ajax({
        url: "{{route('administrador.categoria.pesquisa')}}",
        type: 'get',
        contentType: 'application/json',
        success: function(data) {
            let nome = ''
            data.forEach(element => {
                nome += `<option value="${element.codigo}-${element.descricao}">`
                // nome += `<option value="${element.descricao}">`
            });
            $('#categoria_list').html(nome)
        }
    })
    // $('#categoria').on('keyup focus', function() {
    //   if (!$(this).val()) {
    //     listacategoria(categoriatrabalhador);
    //   }
    // })

    // function cbolista(cbo) {
    //   cbo.forEach(element => {
    //     cbolist += `<option value="${element.code} - ${element.name}">`
    //   });
    //   $('#cbo_list').html(cbolist)
    // }
    // cbolista(cbo)

    // function listacategoria(categoriatrabalhador) {
    //   categoriatrabalhador.forEach(element => {
    //     categorialist += `<option value="${element}">`
    //   });
    //   $('#categoria_list').html(categorialist);
    // }
    // listacategoria(categoriatrabalhador)
    // $("#pesquisa").on('keyup focus', function() {
    //   let dados = '0'
    //   if ($(this).val()) {
    //     dados = $(this).val()
    //     if (dados.indexOf('  ') !== -1) {
    //       dados = monta_dados(dados);
    //     }
    //   }
    //   $('#icon').addClass('d-none').next().removeClass('d-none')
      
    // });
    $.ajax({
        url: "{{url('trabalhador')}}/pesquisa/"+0, 
        type: 'get',
        contentType: 'application/json',
        success: function(data) {
        //   $('#trabfoto').removeAttr('src')
          $('#refres').addClass('d-none').prev().removeClass('d-none')
          let nome = ''
          if (data.length >= 1) {
            data.forEach(element => {
              nome += `<option value="${element.tsnome}">`
              // nome += `<option value="${element.tsmatricula}">`
              nome += `<option value="${element.tscpf}">`
            });
            $('#listapesquisa').html(nome)
          }
          // if(data.length === 1 && dados.length >= 4){
          //   buscaItem(dados)
          // }else{
          //   campo()
          // }              
        }
      });

    function monta_dados(dados) {
      let novodados = dados.split('  ')
      return novodados[1];
    }

    function buscaItem(dados) {
      $('#carregamento').removeClass('d-none')
      $.ajax({
        url: "{{url('trabalhador')}}/" + dados,
        type: 'get',
        contentType: 'application/json',
        success: function(data) {
          localStorage.setItem('hdHlKMtd', btoa(data.trabalhador));
          trabalhador(data)
          $('#carregamento').addClass('d-none')
        }
      });
    }
    // if (localStorage.getItem('hdHlKMtd')) {
    //   buscaItem(atob(localStorage.getItem('hdHlKMtd')))
    // }
    function campo() {
      $('#relatoriotrabalhador').addClass('disabled')
      $('#imprimir').addClass('disabled')
      $('#fichaepi').addClass('disabled')
      $('#depedente').addClass('disabled')
      $('#form').attr('action', "{{ route('trabalhador.cadastra') }}");
      $('#incluir').removeAttr("disabled")
      $('#depedente').removeAttr("disabled")
      $('#atualizar').attr('disabled', 'disabled')
      $('#deletar').attr('disabled', 'disabled')
      $('#method').val(' ')
      $('#excluir').attr('disabled', 'disabled')
      for (let index = 0; index < $('.input').length; index++) {
        $('.input').eq(index).val(' ')
      }
    }

    function trabalhador(data) {
      if (data.trabalhador) {
        $('#form').attr('action', "{{ url('trabalhador')}}/" + data.trabalhador);
        $('#formdelete').attr('action', "{{ url('trabalhador')}}/" + data.trabalhador)
        $('#depedente').removeClass('disabled')
        $('#depedente').attr('href', "{{ url('depedente')}}/" + data.trabalhador + '/mostrar')
        $('#incluir').attr('disabled', 'disabled')
        $('#atualizar').removeAttr("disabled")
        $('#deletar').removeAttr("disabled")
        $('#excluir').removeAttr("disabled")

        $('#method').val('PUT')
        $('#recibopagamento').removeClass('disabled')
        $('#relatoriotrabalhador').removeClass('disabled')
        $('#imprimir').removeClass('disabled').attr('href', "{{url('ficha/registro/trabalhador')}}/" + btoa(data.trabalhador))
        $('#fichaepi').removeClass('disabled').attr('href', "{{url('epi')}}/" + btoa(data.trabalhador))
        $('#cracha').removeClass('disabled').attr('href', "{{url('cracha/trabalhador')}}/" + btoa(data.trabalhador))
        $('#declaracao__adm').removeClass('disabled').attr('href', "{{url('declaracao/admissao/trabalhador')}}/" + btoa(data.trabalhador))
        $('#declaracao__afas').removeClass('disabled').attr('href', "{{url('declaracao/afastamento/trabalhador')}}/" + btoa(data.trabalhador))
        $('#devolucao__ctps').removeClass('disabled').attr('href', "{{url('devolucao/ctps/trabalhador')}}/" + btoa(data.trabalhador))
        $('#trabalhador').val(data.trabalhador)
      } else {
        $('#relatoriotrabalhador').addClass('disabled')
        $('#imprimir').addClass('disabled')
        $('#fichaepi').addClass('disabled')
        $('#depedente').addClass('disabled')
        $('#form').attr('action', "{{ route('trabalhador.cadastra') }}");
        $('#incluir').removeAttr("disabled")
        $('#depedente').removeAttr("disabled")
        $('#atualizar').attr('disabled', 'disabled')
        $('#deletar').attr('disabled', 'disabled')
        $('#recibopagamento').addClass('disabled')
        $('#method').val(' ')
        $('#excluir').attr('disabled', 'disabled')
      }
      $('#nome__completo').val(data.tsnome).next().text(' ')
      $('#nome__social').val(data.tsnomesocial).next().text(' ')
      $('#foto').val(data.tsfoto)
      $('#trabfoto').attr('src', data.tsfoto)
      $('#cpf').val(data.tscpf).next().text(' ')
      $('#matricula').val(data.tsmatricula).next().text(' ')
      $('#matricularid').val(data.tsmatricula).next().text(' ')
      $('#pis').val(data.dspis).next().text(' ')
      $('#data_nascimento').val(data.nsnascimento).next().text(' ')
      $('#telefone').val(data.tstelefone).next().text(' ')
      $('#pais__nascimento').val(data.nsnaturalidade).next().text(' ')
      $('#pais__nacionalidade').val(data.nsnacionalidade).next().text(' ')
      $('#nome__mae').val(data.tsmae).next().text(' ')
      $('#cep').val(data.escep).next().text(' ')
      $('#logradouro').val(data.eslogradouro).next().text(' ')
      $('#uf').val(data.esuf).next().text(' ')
      $('#numero').val(data.esnum).next().text(' ')
      $('#complemento').val(data.escomplemento).next().text(' ')
      $('#bairro').val(data.esbairro).next().text(' ')
      $('#localidade').val(data.esmunicipio).next().text(' ')
      $('#uf').val(data.esuf).next().text(' ')
      $('#data__admissao').val(data.csadmissao).next().text(' ')
      $('#categoria').val(data.cscategoria).next().text(' ')
      $('#cbo').val(data.cbo).next().text(' ')

      $('#ctps').val(data.dsctps).next().text(' ')
      $('#serie__ctps').val(data.dsserie).next().text(' ')
      $('#uf__ctps').val(data.dsuf).next().text(' ')
      $('#situacao__contrato').val(data.cssituacao).next().text(' ')
      $('#data__afastamento').val(data.csafastamento).next().text(' ')
      $('#nome__conta').val(data.bstitular).next().text(' ')
      $('#banco').val(data.bsbanco).next().text(' ')
      $('#agencia').val(data.bsagencia).next().text(' ')
      $('#operacao').val(data.bsoperacao).next().text(' ')
      $('#conta').val(data.bsconta).next().text(' ')
      $('#pix').val(data.bspix).next().text(' ')
      $('#bsdefaltor').val(data.deflator).next().text(' ')
      $('#endereco').val(data.eiid).next().text(' ')
      $('#bancario').val(data.biid).next().text(' ')

      for (let index = 0; index < $('#situacao__contrato option').length; index++) {
        if (data.cssituacao == $('#situacao__contrato option').eq(index).text()) {
          $('#situacao__contrato option').eq(index).attr('selected', 'selected')
        } else {
          $('#situacao__contrato option').eq(index).removeAttr('selected')
        }
      }
      for (let index = 0; index < $('#sexo option').length; index++) {
        if (data.tssexo == $('#sexo option').eq(index).text()) {
          $('#sexo option').eq(index).attr('selected', 'selected')
        } else {
          $('#sexo option').eq(index).removeAttr('selected')
        }
      }
      for (let index = 0; index < $('#complemento__endereco option').length; index++) {
        if (data.escomplemento == $('#complemento__endereco option').eq(index).text()) {
          $('#complemento__endereco option').eq(index).attr('selected', 'selected')
        } else {
          $('#complemento__endereco option').eq(index).removeAttr('selected')
        }
      }
      for (let index = 0; index < $('#estado__civil option').length; index++) {
        if (data.nscivil === $('#estado__civil option').eq(index).text()) {
          $('#estado__civil option').eq(index).attr('selected', 'selected')
        } else {
          $('#estado__civil option').eq(index).removeAttr('selected')
        }
      }
      for (let index = 0; index < $('#raca option').length; index++) {
        if (data.nsraca === $('#raca option').eq(index).text()) {
          $('#raca option').eq(index).attr('selected', 'selected')
        } else {
          $('#raca option').eq(index).removeAttr('selected')
        }
      }
      for (let index = 0; index < $('#grau__instrucao option').length; index++) {
        if (data.tsescolaridade === $('#grau__instrucao option').eq(index).text()) {
          $('#grau__instrucao option').eq(index).attr('selected', 'selected')
        } else {
          $('#grau__instrucao option').eq(index).removeAttr('selected')
        }
      }

    }
  });
