 function BotaoAlterafoto() {
                (async () => {
                    const { value: file } = await Swal.fire({
                    title: 'Selecione sua imagem',
                    input: 'file',
                    confirmButtonText:'Enviar <i class="far fa-paper-plane"></i>',
                    inputAttributes: {
                        'accept': 'image/*',
                        'aria-label': 'Upload your profile picture', 
                        'class': 'false'
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
                                    title: 'Foto atualizada!!',
                                    imageUrl: e.target.result,
                                    imageAlt: 'Foto atualizada',
                                    confirmButtonText:'Ok',
                                    })
                                    var myFormData = new FormData();
                                    myFormData.append('image_file', e.target.result);
                                    myFormData.append('_token',`${window.Laravel.csrf}`)
                                    myFormData.append('empresa',`${window.Laravel.empresa.id}`)
                                    $.ajax({
                                        url: `${window.Laravel.empresa.foto}`,
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
                                            $('#inputfoto').val(e.target.result)       
                                        },
                                    })
                                }
                                reader.readAsDataURL(file)
                            }else{
                                $('#msgfoto').removeClass('d-none').text('A extensão não é suportada. Apenas(jpg, png,svg,tiff,webp)')
                            }
                        } else {
                            Swal.showValidationMessage('O tamanho suportado é de até 3MB')
                            $('#msgfoto').removeClass('d-none').text('O tamanho suportado é de até 3MB');
                        }  
                        
                }
            })()  
            }
           