<!DOCTYPE html>
<html>
<head>
    <title>Control de LED</title>
    <script src="recursos/jquery/jquery.min.js"></script>
    <script>
        function encenderLed() {
            $.ajax({
                url: 'control_led.php',
                method: 'POST',
                data: { command: 'ON' },
                success: function(response) {
                    $("#contenedormsgphp").html(response);
                },
                error: function() {
                    alert('Error en la solicitud AJAX.');
                }
            });
        }

        function apagarLed() {
            $.ajax({
                url: 'control_led.php',
                method: 'POST',
                data: { command: 'OFF' },
                success: function(response) {
                    $("#contenedormsgphp").html(response);
                },
                error: function() {
                    alert('Error en la solicitud AJAX.');
                }
            });
        }
    </script>
</head>
<body>
    <h1>Control de LED</h1>
    <div id="contenedormsgphp">

    </div>
    <button onclick="encenderLed()">Encender</button>
    <button onclick="apagarLed()">Apagar</button>
</body>
</html>