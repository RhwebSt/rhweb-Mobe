console.log("entrou cadAcesso")
        $('#incluir').click(function(event){
            event.preventDefault();
            console.log("executou");
            $('#inclurIcone').removeClass('fa-save');
            $('#inclurIcone').addClass('fa-spinner-third');
            $('#inclurIcone').addClass('fa-spin');
            console.log($('#inclurIcone'));
            var teste = setTimeout(function () {
                
                $('#form').submit();
                console.log("dentro da funcão");
            }, 3000);
            

            
        })
        
        // $('#incluir').mouseover(function(){
        //     $('#inclurIcone').addClass('fa-check');
        //     $('#inclurIcone').removeClass('fad');
        //     $('#inclurIcone').removeClass('fa-save');
        //     $('#inclurIcone').addClass('fad');
        // })
        
        // $('#incluir').mouseout(function(){
        //     $('#inclurIcone').removeClass('fad');
        //     $('#inclurIcone').removeClass('fa-check');
        //     $('#inclurIcone').addClass('fad');
        //     $('#inclurIcone').addClass('fa-save');
            
        // })



        $('#usuario').val(" ");
        $('#senha').val(" ");

        $(document).ready(function(){
            
            
            
            $.ajax({
              url: "{{route('usuario.pesquisa.admin')}}", 
              type: 'get',
              success: function(data) {
              
                let nome = '';
                if (data.length >= 1) {
                    data.forEach(element => {
                      nome += `<option value="${element.name}">`
                    });
                    $('#listapesquisa').html(nome)    
                }
                
              }
            });
            function usuario(dados) {
              $.ajax({
                url: "{{url('user')}}/"+dados, 
                type: 'get',
                success: function(data) {
                  campos(data)
                }
              })
            }
            function campos(data) {
              if (data.id) {
                  $('#form').attr('action', "{{ url('user')}}/"+data.id);
                  $('#formdelete').attr('action',"{{ url('user')}}/"+data.id)
                  // $('#incluir').attr('disabled','disabled')
                  $('#atualizar').removeAttr( "disabled" )
                  $('#deletar').removeAttr( "disabled" )
                  $('#excluir').removeAttr( "disabled" )
                  $('#permicao').removeAttr( "disabled" )
                  // $('#method').val('PUT')
                  $('#nome__completo').val(data.esnome)
                  $('#cargo').val(data.cargo)
                  $('#senha').val('')
                  $('#idempresa').val(data.empresa)
              }else{
                  $('#form').attr('action', "{{ route('user.store') }}");
                  // $('#incluir').removeAttr( "disabled" )
                  $('#depedente').removeAttr( "disabled" )
                  $('#atualizar').attr('disabled','disabled')
                  $('#deletar').attr('disabled','disabled')
                  $('#permicao').attr('disabled','disabled')
                  $('#method').val(' ')
                  $('#excluir').attr( 'disabled','disabled' )
                  // $('#nome__completo').val('')
                  $('#cargo').val('')
                  $('#senha').val('')
              }
            }
            $( "#nome__completo" ).on('keyup focus',function() {
                var dados = 0;
                if ( $(this).val()) {
                  dados = $(this).val();
                }
                $.ajax({
                    url: "{{url('empresa')}}/pesquisa/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                      let nome = '';
                      // $('#mensagemtomador').text(' ')
                      // $( "#nome__completo" ).removeClass('is-invalid')
                      if (data.length >= 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.esnome}">`
                          // nome += `<option value="${element.escnpj}">`
                        });
                        $('#datalistOptions').html(nome)    
                      }
                      if(data.length === 1 && dados.length > 4){
                        $('#idempresa').val(data[0].id)
                      }else{
                        // $('#mensagemtomador').text('Não foi possível encontra o tomador!')
                        // $( "#nome__completo" ).addClass('is-invalid')
                      }
                    }
                });
            });
        });
