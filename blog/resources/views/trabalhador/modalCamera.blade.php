<div class="modal fade" id="modalCamera" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header header__modal">
                <h5 class="modal-title" id="staticBackdropLabel1"><i class="fad fa-camera"></i> Tirar Foto</h5>
                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            
            <div class="modal-body body__modal">
                
                <video class="videoFoto" autoplay id="videoFoto"></video>
                <canvas id="canvasFoto"></canvas>
                <button id="botaoFoto" class="botao btn">Tirar foto</button>
                <button id="resetarFoto" class="botao btn">Reset</button>
                
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
    })
    
    document.querySelector('#botaoFoto').addEventListener('click', () => {
        var canvas = document.querySelector('#canvasFoto');
        canvas.height = video.videoHeight
        canvas.width = video.videoWidth
        var context = canvas.getContext('2d');
        context.drawImage(video, 0, 0);
        var link = document.createElement('a');
        link.download = 'foto.png';
        link.href = canvas.toDataURL();
        link.textContent = 'Clique para baixar a imagem';
        document.body.appendChild(link);
    });
    
    $('#resetarFoto').click(function(){
        var canvas = document.querySelector('#canvasFoto');
        // canvas.clearRect(0, 0, canvas.width, canvas.height);
    })
</script>