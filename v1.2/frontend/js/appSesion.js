
  function iniciar() {
    verificaConectividad(function() {
        verificarllenos("login", function() {
            var usuario = $("#usuario").val();
            var contrasena = $("#contrasena").val();

            $.ajax({
                url: "../backend/acceso.php",
                type: "POST",
                data: {usuario: usuario, contrasena: contrasena},
                success: function(errores) {
                    $("#notificaciones").html(errores);
                }
            });
            window.setTimeout(function() {
                $(".alert").fadeTo(200, 0).slideUp(200, function() {
                    $(this).remove(); 
                });
            }, 2500);
        });
    });    
}


// Fix: Cuando se da boton enter debe ir a la función iniciar
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('login').addEventListener("keydown", function(event) {
      if (event.keyCode === 13) {
        event.preventDefault(); 
        iniciar(); // 
      }
    });
  });

  //Muestra los mensajes mediante una alerta
  function muestraMensajes(alerta){
    var spinner = "<div class='alert spinner-grow text-dark' role='status'></div>";
    var mensaje = ""+ spinner +"<div class='container'><div class='alert text-dark'>"+ alerta +"</div></div>";
    document.getElementById("notificaciones").innerHTML = mensaje;
    window.setTimeout(function() {
        $(".alert").fadeTo(200, 0).slideUp(200, function(){
            $(this).remove(); 
        });
    }, 2500);  
  }

//Verifica la conectividad
  function verificaConectividad(funcion) {
    if (navigator.onLine) {
      fetch('usuarios_mst.php', { method: 'GET' })
        .then(function(response) {
          if (!response.ok) {
            throw Error(response.statusText);
          }
  
          if (response.ok) {
            // Función de inicio de sesion
            funcion();
            return response;
          }
        })
        .then(function(response) {})
        .catch(function(error) {
          var alerta = 'Sin conexion a red';
          muestraMensajes(alerta);
        });
    } else {
      var alerta = 'Sin conexion a red';
      muestraMensajes(alerta);
    }
  }

  //Verifica que todos los datos de acceso sean llenados
  function verificarllenos(formulario,funcion) {
    const form = document.getElementById(formulario);
                      // Obtener todos los campos del formulario
                      const fields = form.querySelectorAll("input, textarea, select");
                    
                      // Recorrer los campos y verificar si están llenos
                      let allFieldsFilled = true;
                      fields.forEach((field) => {
                        if (field.value.trim() === "") {
                          allFieldsFilled = false;
                        }
                      });
                    
                      // Si todos los campos están llenos, enviar el formulario
                      if (allFieldsFilled) {
                        funcion();
                      }else{
                        var alerta = 'Rellena los campos';
                        muestraMensajes(alerta);
                      }
  }