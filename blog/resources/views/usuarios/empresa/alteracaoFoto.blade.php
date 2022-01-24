@extends('layouts.index')
@section('conteine')
            <section class="mt-5">
                <div class="container d-flex justify-content-center flex-column align-items-center mt-5 p-2" >
                    <form class="row g-3 needs-validation form-control bg__form1" id="form" action="" enctype="multipart/form-data"  method="Post">
                        <h1 class="text-center text-white">Alterar Foto</h1>
                        <button class="btn botao__voltar col-5 col-sm-3 col-md-2 col-lg-2 col-xl-2 ms-5 mb-5" type="button"><i class="fas fa-arrow-circle-left"></i> Voltar</button>
                        <img src="{{url('/imagem/user1.png')}}" class="rounded mx-auto d-block back__foto" id="foto" alt="..." style="width: 200px; height: 200px;">

                        <div class="d-grid gap-2 col-8 col-sm-4 col-md-4 col-lg-2 mx-auto">
                            <button class="btn botao__alterar" type="button" onClick="BotaoAlterafoto()">Alterar foto <i class="fas fa-camera"></i></button>
                          </div>
                          <div class="alert alert-danger d-none" id="msgfoto" role="alert">
                            
                          </div>
                    </form>
                </div>
            </section>
        <script>
            
            function BotaoAlterafoto() {
                (async () => {
                    const { value: file } = await Swal.fire({
                    title: 'Select image',
                    input: 'file',
                    inputAttributes: {
                        'accept': 'image/*',
                        'aria-label': 'Upload your profile picture'
                    }
                    })

                    if (file) {
                        var ext = ['jpg','jpeg','png','svg','tiff','webp']
                        var type = file.type.split('/')
                        if (file.size < 3145728) {
                            if (ext.indexOf(type[1]) >= 1) {
                                const reader = new FileReader()
                                reader.onload = (e) => {
                                    Swal.fire({
                                    title: 'Your uploaded picture',
                                    imageUrl: e.target.result,
                                    imageAlt: 'The uploaded picture'
                                    })
                                    var myFormData = new FormData();
                                    myFormData.append('image_file', e.target.result);
                                    myFormData.append('_token','{{ csrf_token() }}')
                                    myFormData.append('empresa',"{{$user->empresa}}")
                                    $.ajax({
                                        url: "{{url('foto/editer')}}",
                                        type: 'POST',
                                        data: myFormData,
                                        cache: false,
                                        processData: false,
                                        contentType: false,
                                        beforeSend: function() {    
                                        },  
                                        complete: function() {  
                                        },              
                                        success: function(data) {
                                            $('#foto').attr('src',e.target.result)       
                                        },
                                    })
                                }
                                reader.readAsDataURL(file)
                            }else{
                                $('#msgfoto').removeClass('d-none').text('A extensão não é suportada. Apenas(jpg, png,svg,tiff,webp)')
                            }
                        } else {
                            Swal.showValidationMessage('O tamanho suportado é até 3MB')
                            $('#msgfoto').removeClass('d-none').text('O tamanho suportado é até 3MB');
                        }  
                        
                }
            })()  
            }
           
        </script>
@stop