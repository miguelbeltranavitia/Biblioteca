let scanner = new Instascan.Scanner({
    video: document.getElementById('preview')
});
scanner.addListener('scan', function(content) {
    console.log(content);
    var elemento = document.getElementById('matricula')
    elemento.value = content;     
    elemento.readOnly = true;
    getUsuario();
    play();
});

Instascan.Camera.getCameras().then(function(cameras) {
    if (cameras.length > 0) {
        scanner.start(cameras[0]);
    } else {
        console.error('No cameras found.');
    }
}).catch(function(e) {
    console.error(e);
});


function play(){
    var audio = document.getElementById("audio");
    audio.play();
}