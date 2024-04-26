<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Draw Signature</title>
<style>
    #exampleModal {
        padding: 20px;
    }

    #draw-canvas {
        border: 1px solid #CCCCCC;
        border-radius: 5px;
        cursor: crosshair;
    }

    .button {
        background: #3071a9;
        box-shadow: inset 0 -3px 0 rgba(0,0,0,.3);
        font-size: 14px;
        padding: 5px 10px;
        border-radius: 5px;
        margin: 0 15px;
        text-decoration: none;
        color: white;
    }

    .button:active {
        transform: scale(0.9);
    }

    /* Icono del botón de borrar */
    .icon-erase {
        font-size: 18px;
        color: red;
    }
</style>
</head>
<body>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Firmar <input type="hidden" id="codigoInput" name="codigo"></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <canvas id="draw-canvas" width="455" height="160">
                            No tienes un buen navegador.
                        </canvas>
                        <input type="hidden" id="codigoInput" name="codigo">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="button" class="button" id="draw-clearBtn" value="Borrar Canvas">
                        <button class="button" id="save-signature">Guardar Firma</button>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
</body>
<script>
(function() {
    var canvas = document.getElementById("draw-canvas");
    var ctx = canvas.getContext("2d");

    var clearBtn = document.getElementById("draw-clearBtn");
    var saveBtn = document.getElementById("save-signature");

    clearBtn.innerHTML = '<i class="icon-erase">🗑️</i>'; // Agregamos el icono de borrar

    clearBtn.addEventListener("click", function (e) {
        clearCanvas();
    }, false);

    saveBtn.addEventListener("click", function() {
    var dataUrl = canvas.toDataURL();
    var codigo = document.getElementById("codigoInput").value;

    // Obtener el contenido del canvas como una URL de datos (base64)
    var formData = new FormData();
    formData.append("imagen", dataUrl); // Adjuntar la URL de datos como "imagen"
    formData.append("codigo", codigo); // Adjuntar el código como "codigo"

    // Realizar una solicitud POST al archivo PHP para guardar la imagen
    fetch("saves/guardarfirma.php", {
        method: "POST",
        body: formData
    })
    
        location.reload();

});

    var drawing = false;
    var mousePos = { x:0, y:0 };
    var lastPos = mousePos;

    canvas.addEventListener("mousedown", function (e) {
        drawing = true;
        lastPos = getMousePos(canvas, e);
    }, false);

    canvas.addEventListener("mouseup", function (e) {
        drawing = false;
    }, false);

    canvas.addEventListener("mousemove", function (e) {
        mousePos = getMousePos(canvas, e);
        renderCanvas();
    }, false);

    function getMousePos(canvasDom, mouseEvent) {
        var rect = canvasDom.getBoundingClientRect();
        return {
            x: mouseEvent.clientX - rect.left,
            y: mouseEvent.clientY - rect.top
        };
    }

    function renderCanvas() {
        if (drawing) {
            ctx.strokeStyle = '#000000';
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.beginPath();
            ctx.moveTo(lastPos.x, lastPos.y);
            ctx.lineTo(mousePos.x, mousePos.y);
            ctx.stroke();
            lastPos = mousePos;
        }
    }

    function clearCanvas() {
        canvas.width = canvas.width;
    }
})();
</script>
</html>
