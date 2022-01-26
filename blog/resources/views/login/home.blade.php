@extends('layouts.index')
@section('conteine')


            <div class="container d-flex justify-content-center flex-column align-items-center" style="margin-top: 300px">
              <img class="img-fluid" id="image" src="" alt="" srcset="" style="">
            </div>
            
            
            
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