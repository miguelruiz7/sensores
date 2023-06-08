//Carga cualquier evento 
$(document).ready(function() {
  cargarEspacios();
});


$(document).ready(function() {
  cargarSecciones();
});


function cargarEspacios(){
  verificaConectividad(function() {
    $.ajax({
      url: 'espacios.php', // Ruta al archivo que quieres cargar
      type: 'GET', // Método de la petición (GET, POST, etc.)
      dataType: 'html', // Tipo de datos esperados en la respuesta

      success: function(data) {
        $('#espacios').html(data); // Insertar el contenido en el contenedor con ID 'espacio'
      },
      error: function() {
        alert('Ha ocurrido un error al cargar el archivo.');
      }
    });
    });   
  }


  
function cargarSecciones(){
  verificaConectividad(function() {
    $.ajax({
      url: 'secciones_det.php', // Ruta al archivo que quieres cargar
      type: 'GET', // Método de la petición (GET, POST, etc.)
      dataType: 'html', // Tipo de datos esperados en la respuesta

      success: function(data) {
        $('#secciones').html(data); // Insertar el contenido en el contenedor con ID 'espacio'
      },
      error: function() {
        alert('Ha ocurrido un error al cargar el archivo.');
      }
    });
    });   
  }



//Espacio
//Formulario para agregar un espacio
function formAgregarEsp(){
  verificaConectividad(function() {
        var formulario = 'agregar';
        $.ajax({
                url: "formularios.php",
                type: "POST",
                data: {formulario:formulario},
                success: function(contenido){
                    $("#formularios_contenedor").html(contenido);
                }
            });
    });   
  }

  
function agregarEspacio() {
  verificaConectividad(function() {
      verificarllenosForm("agregarEspacio", "notificacionesform",function() {
          var nombre = $("#txt_esp_nom").val();
          var tipoespacio = $("#txt_esp_espt_id").val();
          var descripcion = $("#txt_esp_desc").val();
          var area = $("#txt_esp_area").val();
          var ubicacion = $("#txt_esp_geo").val();
          var funcion = $("#funcion").val();
  
          $.ajax({
                  url: "../backend/formularios.php",
                  type: "POST",
                  data: {nombre:nombre,
                          espacio:tipoespacio,
                          descripcion:descripcion,
                          area:area,
                          ubicacion:ubicacion,
                          funcion:funcion},
                  success: function(errores){
                      $("#notificaciones").html(errores);       
                  }
              });
      
              window.setTimeout(function() {
                  $(".alert").fadeTo(200, 0).slideUp(200, function(){
                      $(this).remove(); 
                  });
              }, 2500);
      });
  });    
}


function eliminarEspacio(id) {
  verificaConectividad(function() {
    var funcion = "eliminarEspacio";
          $.ajax({
                  url: "../backend/formularios.php",
                  type: "POST",
                  data: {id:id, funcion:funcion},
                  success: function(contenido){
                    $("#formularios_contenedor").html(contenido);
                  }
              });
      
              window.setTimeout(function() {
                  $(".alert").fadeTo(200, 0).slideUp(200, function(){
                      $(this).remove(); 
                  });
              }, 2500);
  });    
}

//Formulario para agregar una seccion
function formAgregarSec(){
  verificaConectividad(function() {
        var formulario = 'agregarSeccion';
        $.ajax({
                url: "formularios.php",
                type: "POST",
                data: {formulario:formulario},
                success: function(contenido){
                    $("#formularios_contenedor").html(contenido);
                }
            });
    });   
  }



function cerrarSesion() {
  verificaConectividad(function() {
    
          muestraMensajes("Se cerrará la sesión",'')
        window.setTimeout(function() {
             location.href = 'logout';
         }, 3500);
  });   
  ocultarCanvas('menuOffcanvas'); 
}

function muestraMensajes(alerta, tipo){
  if(tipo == 'error'){
      var spinner = "<div class='spinner-grow text-light' role='status'><span class='visually-hidden'></span></div>";
      }else{
      var spinner = "<div class='spinner-border text-light' role='status'><span class='visually-hidden'></span></div>";
      }
  var mensaje = "<div class='alert mb-0 container-fluid bg-none text-center p-3 shadow rounded-0' style='background-color:#084f88'>"+ spinner +"<h5 class='fw-light text-light m-3'>"+ alerta +"</h5></div>";
  document.getElementById("notificaciones").innerHTML = mensaje;
 window.setTimeout(function() {
      $(".alert").fadeTo(200, 0).slideUp(200, function(){
          $(this).remove(); 
      });
  }, 2500);  
}


function muestraMensajesFormularios(alerta, formulario, tipo){
  if(tipo == 'error'){
  var spinner = "<div class='spinner-grow text-light' role='status'><span class='visually-hidden'></span></div>";
  }else{
  var spinner = "<div class='spinner-border text-light' role='status'><span class='visually-hidden'></span></div>";
  }
  var mensaje = "<div class='alert mb-0 container-fluid bg-none text-center p-3  rounded-0' style='background-color:transparent'>"+ spinner +"<h5 class='fw-light text-light m-3'>"+ alerta +"</h5></div>";
  document.getElementById(formulario).innerHTML = mensaje;
 window.setTimeout(function() {
      $(".alert").fadeTo(200, 0).slideUp(200, function(){
          $(this).remove(); 
      });
  }, 2500);  
}

//Carga las urls en el iframe main
function cargarURL(url) {
  var iframe = document.getElementById('main');
  iframe.onload = function() {
    document.getElementById('loader-container').style.display = 'none';
    iframe.style.display = 'block';
  };
  iframe.src = url;
  document.getElementById('loader-container').style.display = 'flex';
  iframe.style.display = 'none';
}

//Ocultar menu
function ocultarCanvas(elemento) {
  var offcanvasElement = document.getElementById(elemento);
  var offcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement); 
  offcanvas.hide(); // Oculta el offcanvas
}

//Ocultar modal
function ocultarModal(elemento) {
  var modalElement = document.getElementById(elemento);
  var modal = bootstrap.Modal.getInstance(modalElement);
  modal.hide(); // Oculta el modal
}


//Verifica la conectividad
function verificaConectividad(funcion) {
  if (navigator.onLine) {
    fetch('index.php', { method: 'GET' })
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
        muestraMensajes(alerta,'error');
      });
  } else {
    var alerta = 'Sin conexion a red';
    muestraMensajes(alerta),'error';
  }
}

//Verifica que todos los datos sean llenados
function verificarllenosForm(formulario,notificacionform,funcion) {
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
                      muestraMensajesFormularios(alerta,notificacionform,'error');
                    }
                  }

                          
      function reseteaFormularios(formulario){
           document.getElementById(formulario).reset();
      }


window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
  });
}, 2500);



                                                         

      



     