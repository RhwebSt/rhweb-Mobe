@extends('layouts.index')
@section('conteine')


            <div class="container d-flex justify-content-center flex-column align-items-center" style="margin-top: 300px">
              <img class="img-fluid" id="image" src="" alt="" srcset="" style="">
            </div>
            
            
                    <div class="float-end ms-auto p-2 bd-highlight" style="; background-color:green; color: white; padding: 20px; margin: 0px; border-top-left-radius: 10px; border-bottom-left-radius: 10px; ">
                        <div class="d-flex collumn">
                            <a class="text-white" style="cursor: pointer"><i class="fad fa-lg fa-comment-alt-smile"></i></a>
                            <a class="text-white fw-bold ms-1 text-decoration-none" id="feedback" style="font-size: 14px; cursor: pointer;">FeedBack</a>
                        </div>
                    </div>

                <!--<div class="d-flex collumn align-items-center">-->
                <!--    <div class="fixed-bottom mb-5 ms-5 align-items-end ms-auto">-->
                <!--      <button type="submit" class="btn btn-success"><i class="fas fa-comment-dots"></i></button>-->
                <!--    </div>-->
                <!--</div>-->

            <script>
                var feedbackBotao = document.querySelector("#feedback");
                
                
                feedbackBotao.addEventListener('click', function(){
                    Swal.fire({
                      title: '<h1 style="font-size: 18px; color: black;">O que você está achando do sistema?<h1>',
                      html:'<div><i id="gostou" class="fas fa-2x fa-grin-hearts" style="width: 20px; margin-right: 20px; margin-top: 10px;"></i>'+ 
                      '<i id="feliz" class="fas fa-2x fa-grin-alt" style="width: 20px; margin-right: 20px; margin-top: 10px;"></i>' + 
                      '<i id="mediano" class="fas fa-2x fa-meh" style="width: 20px; margin-right: 20px; margin-top: 10px;"></i>' + 
                      '<i id="naoGostou" class="fas fa-2x fa-frown"></i></div>' + 
                      '<textarea class="mt-3" id="feedbackText" name="story rows="6" style="font-size: 14px;" cols="40" placeholder="Deixe aqui seu recado ou sugestão.">',
                      showCloseButton: true,
                      showCancelButton: true,
                      focusConfirm: false,
                      confirmButtonText:
                        'Enviar <i class="fad fa-paper-plane"></i>',
                      confirmButtonAriaLabel: 'Thumbs up, great!',
                      confirmButtonColor: '#418D3F',
                      cancelButtonText:
                        'Sair <i class="fad fa-times-circle"></i>',
                        cancelButtonColor: '#DB2B39',
                      cancelButtonAriaLabel: 'Thumbs down'
                    })
                    var feliz = document.getElementById('feliz');
                    var gostouMuito = document.getElementById('gostou');
                    var mediano = document.getElementById('mediano');
                    var naoGostou = document.getElementById('naoGostou');
                    

                    feliz.addEventListener('click', function(){
                        feliz.classList.add("feliz");
                        gostouMuito.classList.remove("gostouMuito");
                        mediano.classList.remove("mediano");
                        gostouMuito.classList.remove("gostouMuito");
                        mediano.classList.remove("mediano");
                    });
                    
                    gostouMuito.addEventListener('click', function(){
                        gostouMuito.classList.add("gostouMuito");
                        mediano.classList.remove("mediano");
                        naoGostou.classList.remove("naoGostou");
                        feliz.classList.remove("feliz");
                    });
                    
                    mediano.addEventListener('click', function(){
                        mediano.classList.add("mediano");
                        feliz.classList.remove("feliz");
                        gostouMuito.classList.remove("gostouMuito");
                        naoGostou.classList.remove("naoGostou");
                    });
                    
                    naoGostou.addEventListener('click', function(){
                        naoGostou.classList.add("naoGostou");
                        gostouMuito.classList.remove("gostouMuito");
                        mediano.classList.remove("mediano");
                        feliz.classList.remove("feliz");
                    })
                
                
                })
            </script>
            
            <script>
            
                darkMode = localStorage.getItem("darkMode");
                var img = document.querySelector("#image");
                const darkModeToggle1 = document.querySelector('#flexSwitchCheckDefault');
                
                
                if(darkMode === 'null'){
                        img.setAttribute('src', "{{url('/imagem/logoAzul.png')}}");
                        
                    }else if(darkMode === 'enabled'){
                        img.setAttribute('src', "{{url('/imagem/logoBranca.png')}}");
                        
                    }

                darkModeToggle1.addEventListener("click", () =>{
                    if(darkMode === 'null'){
                        img.setAttribute('src', "{{url('/imagem/logoAzul.png')}}");
                        console.log('ok');
                    }else if(darkMode === 'enabled'){
                        img.setAttribute('src', "{{url('/imagem/logoBranca.png')}}");
                        
                    }
                
                })


            </script>
            
            
            
            
        
@stop