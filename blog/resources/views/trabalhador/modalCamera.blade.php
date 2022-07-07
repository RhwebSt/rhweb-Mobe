
<div class="modal fade" id="modalCamera" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header header__modal">
                <h5 class="modal-title" id="staticBackdropLabel1"><i class="fad fa-camera"></i> Tirar Foto</h5>
                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            
            <div class="modal-body body__modal">
                <div class="alert alert-warning alert__camera d-none" id="alertaCamera" role="alert">
                   Não temos a permissão para acessar a sua camera. Para dar permissão é necessário ir nas configurações do navegador e permitir o acesso a câmera. <i class="fas fa-exclamation-triangle"></i></a>
                </div>
                <video class="videoFoto" autoplay id="videoFoto"></video>
                <canvas id="canvasFoto"></canvas>
                <div>
                    <button id="botaoFoto" class="botaoTirarFoto btn"><i class="fad fa-camera"></i> Tirar foto</button>
                    <a id="botaoBaixar" class="botaoTirarFoto btn"><i class="fad fa-download"></i> Baixar</a>
                    <button id="resetarFoto" class="botaoTirarFoto btn"><i class="fad fa-undo-alt"></i> Resetar</button>
                </div>
                
            </div>
            
            <div class="modal-footer">
            </div>
            
        </div>
    </div>
</div>



<script>
    var video = document.querySelector('#videoFoto');

    navigator.mediaDevices.getUserMedia({video:true})
    .then(stream => {
        video.srcObject = stream;
        video.play();
    })
    .catch(error => {
        console.log(error);
        $("#alertaCamera").removeClass('d-none');
        $("#videoFoto").addClass('d-none');
        $("#botaoFoto").addClass('d-none');
        $("#botaoBaixar").addClass('d-none');
        $("#resetarFoto").addClass('d-none');

    })

    document.querySelector('#botaoFoto').addEventListener('click', () => {
        var canvas = document.querySelector('#canvasFoto');
        canvas.style.display = "block";
        canvas.height = video.videoHeight;
        canvas.width = video.videoWidth;
        var context = canvas.getContext('2d');
        context.drawImage(video, 0, 0);
        var botaoBaixar = document.querySelector('#botaoBaixar');
        video.style.display = "none";
        botaoBaixar.href = canvas.toDataURL();
        botaoBaixar.download = 'foto.png';
        const music = new Audio('../sons/somCamera.wav');
        music.play();

    });
    
    $('#resetarFoto').click(() => {
        var canvas = document.querySelector('#canvasFoto');
        canvas.style.display = 'none';
        video.style.display = "block";
    })
</script>