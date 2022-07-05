// faz com que quando algum campo que está dentro do accordion não for preenchido//
// ele abra e não deixe enviar o formulário até que tudo esteje preenchido.//
function verificaCampoObrigatorioAccordion(){

    $('#atualizar').click(function(e){
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


// modal de colocar o nome social com obrigatório//
var radio = document.getElementById("radio");
  var radioResult = radio.value;
  if ('{{$trabalhador->tssocial}}' === 'on') {
    radio.checked = true;
  }

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
  
//fim do nome social//


$.ajax({
  url: `${window.Laravel.administrador.cbo}`, 
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
    url: `${window.Laravel.administrador.categoria}`,
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
    function animarBotaoAtualizar(){

    $('#atualizar').mouseover(function(){
        console.log("funcionou");
        $('#animacaoAtualizar').addClass('fa-spin');
    })
    
    $('#atualizar').mouseout(function(){
        console.log("tirou");
        $('#animacaoAtualizar').removeClass('fa-spin');
    });
    
    }

    animarBotaoAtualizar();

  let paisnascimento = ''
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
  
  // $("#pesquisa").on('keyup focus', function() {
  //     let dados = '0'
  //     if ($(this).val()) {
  //       dados = $(this).val()
  //       if (dados.indexOf('  ') !== -1) {
  //         dados = monta_dados(dados);
  //       }
  //     }
  //     $('#icon').addClass('d-none').next().removeClass('d-none')
      
  //   });
    // $.ajax({
    //     url: "{{url('trabalhador')}}/pesquisa/" + 0,
    //     type: 'get',
    //     contentType: 'application/json',
    //     success: function(data) {
    //     //   $('#trabfoto').removeAttr('src')
    //       $('#refres').addClass('d-none').prev().removeClass('d-none')
    //       let nome = ''
    //       if (data.length >= 1) {
    //         data.forEach(element => {
    //           nome += `<option value="${element.tsnome}">`
    //           // nome += `<option value="${element.tsmatricula}">`
    //           nome += `<option value="${element.tscpf}">`
    //         });
    //         $('#listapesquisa').html(nome)
    //       }
    //       // if(data.length === 1 && dados.length >= 4){
    //       //   buscaItem(dados)
    //       // }else{
    //       //   campo()
    //       // }              
    //     }
    //   });
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
    paisnascimentolista(pais__nascimento);