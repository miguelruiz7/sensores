//Carga cualquier evento 

 // Para que la vista se actualize cada 5 segundos
 setInterval(function() {
  cargarEspacios();
  cargarUsuarios();
  cargarSecciones();
  cargarProductos();

}, 1000);


function cargarMenu(){
  verificaConectividad(function() {
    $.ajax({
      url: 'menu_lateral.php', // Ruta al archivo que quieres cargar
      type: 'GET', // Método de la petición (GET, POST, etc.)
      dataType: 'html', // Tipo de datos esperados en la respuesta

      success: function(data) {
        $('#contenedorMenu').html(data); // Insertar el contenido en el contenedor con ID 'espacio'
      },
      error: function() {
        //alert('Ha ocurrido un error al cargar el archivo.');
      }
    });
    });   
  }
  

  function cargarMenuAdmin(){
    verificaConectividad(function() {
      $.ajax({
        url: 'menu_lateral_admin.php', // Ruta al archivo que quieres cargar
        type: 'GET', // Método de la petición (GET, POST, etc.)
        dataType: 'html', // Tipo de datos esperados en la respuesta
  
        success: function(data) {
          $('#contenedorMenuAdmin').html(data); // Insertar el contenido en el contenedor con ID 'espacio'
        },
        error: function() {
          //alert('Ha ocurrido un error al cargar el archivo.');
        }
      });
      });   
    }

function cargarEspacios(){
  verificaConectividad(function() {
    $.ajax({
      url: 'espacios_det.php', // Ruta al archivo que quieres cargar
      type: 'GET', // Método de la petición (GET, POST, etc.)
      dataType: 'html', // Tipo de datos esperados en la respuesta

      success: function(data) {
        $('#espacios').html(data); // Insertar el contenido en el contenedor con ID 'espacio'
      },
      error: function() {
        //alert('Ha ocurrido un error al cargar el archivo.');
      }
    });
    });   
  }

  function cargarUsuarios(){
    verificaConectividad(function() {
      $.ajax({
        url: 'usuarios_det.php', // Ruta al archivo que quieres cargar
        type: 'GET', // Método de la petición (GET, POST, etc.)
        dataType: 'html', // Tipo de datos esperados en la respuesta
  
        success: function(data) {
          $('#usuarios').html(data); // Insertar el contenido en el contenedor con ID 'espacio'
        },
        error: function() {
          //alert('Ha ocurrido un error al cargar el archivo.');
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
        //alert('Ha ocurrido un error al cargar el archivo.');
      }
    });
    });   
  }


  function cargarProductos(){
    verificaConectividad(function() {
      $.ajax({
        url: 'productos_det.php', // Ruta al archivo que quieres cargar
        type: 'GET', // Método de la petición (GET, POST, etc.)
        dataType: 'html', // Tipo de datos esperados en la respuesta
  
        success: function(data) {
          $('#productos').html(data); // Insertar el contenido en el contenedor con ID 'espacio'
        },
        error: function() {
          //alert('Ha ocurrido un error al cargar el archivo.');
        }
      });
      });   
    }

 function cargarSeccionesEspacio(espacio){
  verificaConectividad(function() {
    var funcion = "cargarSeccion";
          $.ajax({
                  url: "../backend/secciones.php",
                  type: "POST",
                  data: {espacio:espacio, funcion:funcion},
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

  function cargarProductosSeccion(seccion){
    verificaConectividad(function() {
      var funcion = "cargarProductos";
            $.ajax({
                    url: "../backend/productos.php",
                    type: "POST",
                    data: {seccion:seccion, funcion:funcion},
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


  function admincargarUsuarios(){
    verificaConectividad(function() {
      $.ajax({
        url: 'admin_usr_det.php', // Ruta al archivo que quieres cargar
        type: 'GET', // Método de la petición (GET, POST, etc.)
        dataType: 'html', // Tipo de datos esperados en la respuesta
  
        success: function(data) {
          $('#adminUsuarios').html(data); // Insertar el contenido en el contenedor con ID 'espacio'
        },
        error: function() {
          //alert('Ha ocurrido un error al cargar el archivo.');
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
                url: "espacios.php",
                type: "POST",
                data: {formulario:formulario},
                success: function(contenido){
                    $("#formularios_contenedor").html(contenido);
                }
            });
    });   
  }

  function formModificarEsp(id){
    verificaConectividad(function() {
          var formulario = 'modificarEspacio';
          $.ajax({
                  url: "espacios.php",
                  type: "POST",
                  data: {id:id, formulario:formulario},
                  success: function(contenido){
                      $("#formularios_contenedor").html(contenido);
                  }
              });
      });   
    }



    function formModificarSec(id){
      verificaConectividad(function() {
            var formulario = 'modificarSeccion';
            $.ajax({
                    url: "secciones.php",
                    type: "POST",
                    data: {id:id, formulario:formulario},
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
                  url: "../backend/espacio.php",
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
                  url: "../backend/espacio.php",
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


  
function modificarEspacio(id) {
  verificaConectividad(function() {
      verificarllenosForm("modificaEspacio", "notificacionesform",function() {
          var nombre = $("#txt_esp_nom").val();
          var tipoespacio = $("#txt_esp_espt_id").val();
          var descripcion = $("#txt_esp_desc").val();
          var area = $("#txt_esp_area").val();
          var ubicacion = $("#txt_esp_geo").val();
          var funcion = $("#funcion").val();
  
          $.ajax({
                  url: "../backend/espacio.php",
                  type: "POST",
                  data: { id:id, 
                          nombre:nombre,
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


function agregarSeccion(espacio) {
  verificaConectividad(function() {
      verificarllenosForm("agregarSeccion", "notificacionesform",function() {
          var nombre = $("#txt_sec_nom").val();
          var descripcion = $("#txt_sec_desc").val();
          var funcion = $("#funcion").val();
  
          $.ajax({
                  url: "../backend/secciones.php",
                  type: "POST",
                  data: {nombre:nombre,
                          espacio:espacio,
                          descripcion:descripcion,
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


  
function modificarSeccion(id) {
  verificaConectividad(function() {
      verificarllenosForm("modificaSeccion", "notificacionesform",function() {
          var nombre = $("#txt_sec_nom").val();
          var descripcion = $("#txt_sec_desc").val();
          var funcion = $("#funcion").val();
  
          $.ajax({
                  url: "../backend/secciones.php",
                  type: "POST",
                  data: { id:id, 
                          nombre:nombre,
                          descripcion:descripcion,
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

function eliminarSeccion(id) {
  verificaConectividad(function() {
    var funcion = "eliminarSeccion";
          $.ajax({
                  url: "../backend/secciones.php",
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


function eliminarUsuario(usuario) {
  verificaConectividad(function() {
    var funcion = "eliminarUsuario";
          $.ajax({
                  url: "../backend/espacio.php",
                  type: "POST",
                  data: {usuario:usuario, funcion:funcion},
                  success: function(contenido){
                    $("#notificaciones").html(contenido);
                  }
              });
      
              window.setTimeout(function() {
                  $(".alert").fadeTo(200, 0).slideUp(200, function(){
                      $(this).remove(); 
                  });
              }, 2500);
  });    
}


function formModificaUsr(usuario,espacio){
  verificaConectividad(function() {
    var formulario = "modificarUsuario";
          $.ajax({
                  url: "espacios.php",
                  type: "POST",
                  data: {usuario:usuario,espacio:espacio,formulario:formulario},
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


function modificarUsuario(id,espacio) {
  verificaConectividad(function() {
      verificarllenosForm("modificaUsuario", "notificacionesform",function() {
          var nombre = $("#txt_usr_nom").val();
          var rol = $("#txt_esp_usrol_id").val();
          var funcion = $("#funcion").val();
  
          $.ajax({
                  url: "../backend/espacio.php",
                  type: "POST",
                  data: { id:id, 
                          nombre:nombre,
                          rol:rol,
                          espacio:espacio,
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

function formModificarCon(usuario){
  verificaConectividad(function() {
    var formulario = "modificarContrasena";
          $.ajax({
                  url: "usuarios.php",
                  type: "POST",
                  data: {usuario:usuario,
                    formulario:formulario},
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

function formModificarDatos(usuario){
  verificaConectividad(function() {
    var formulario = "modificarDatos"; 
          $.ajax({
                  url: "usuarios.php",
                  type: "POST",
                  data: {usuario:usuario,
                    formulario:formulario},
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

function modificarContrasena(usuario) {
  verificaConectividad(function() {
      verificarllenosForm("modificarContrasena", "notificacionesform",function() {
          var contrasena = $("#txt_usr_con").val();
          var contrasenacon = $("#txt_usr_con_con").val();
          var funcion = $("#funcion").val();
  
          $.ajax({
                  url: "../backend/usuarios.php",
                  type: "POST",
                  data: { usuario:usuario, 
                          contrasena:contrasena,
                          contrasenacon:contrasenacon,
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

function modificarDatos(usuario) {
  verificaConectividad(function() {
      verificarllenosForm("modificarDatos", "notificacionesform",function() {
           var nombre = $("#txt_usr_nom").val();
          var funcion = $("#funcion").val();
  
          $.ajax({
                  url: "../backend/usuarios.php",
                  type: "POST",
                  data: { usuario:usuario, 
                          nombre:nombre,
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

function eliminarUsuario_(usuario) {
  verificaConectividad(function() {
    var funcion = "eliminarUsuario";
          $.ajax({
                  url: "../backend/usuarios.php",
                  type: "POST",
                  data: {usuario:usuario, funcion:funcion},
                  success: function(contenido){
                    $("#notificaciones").html(contenido);
                  }
              });
      
              window.setTimeout(function() {
                  $(".alert").fadeTo(200, 0).slideUp(200, function(){
                      $(this).remove(); 
                  });
              }, 2500);
  });    
}


function asignausuarioEspacio(espacio){
  verificaConectividad(function() {
    var formulario = "asignausuarioEspacio";
          $.ajax({
                  url: "espacios.php",
                  type: "POST",
                  data: {espacio:espacio,
                    formulario:formulario},
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

function asignarUsuario(espacio) {
  verificaConectividad(function() {
      verificarllenosForm("asignaUsuario", "notificacionesform",function() {
          var nombre = $("#txt_usr_nom").val();
          var rol = $("#txt_esp_usrol_id").val();
          var funcion = $("#funcion").val();
  
          $.ajax({
                  url: "../backend/espacio.php",
                  type: "POST",
                  data: { nombre:nombre,
                          rol:rol,
                          espacio:espacio,
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


//Formulario para agregar una seccion
function formAgregarSec(){
  verificaConectividad(function() {
        var formulario = 'agregarSeccion';
        $.ajax({
                url: "secciones.php",
                type: "POST",
                data: {formulario:formulario},
                success: function(contenido){
                    $("#formularios_contenedor").html(contenido);
                }
            });
    });   
  }


  //Ve a todos los usuarios
function formUsuariosEsp(id){
  verificaConectividad(function() {
        var formulario = 'verUsuarios';
        $.ajax({
                url: "espacios.php",
                type: "POST",
                data: {id:id, formulario:formulario},
                success: function(contenido){
                    $("#formularios_contenedor").html(contenido);
                }
            });
    });   
  }

  
  //Nuevo usuario
function nuevoUsuario(){
  verificaConectividad(function() {
        var formulario = 'nuevoUsuario';
        $.ajax({
                url: "usuarios.php",
                type: "POST",
                data: {formulario:formulario},
                success: function(contenido){
                    $("#formularios_contenedor").html(contenido);
                }
            });
    });   
  }

  function agregarUsuario(id,espacio) {
    verificaConectividad(function() {
        verificarllenosForm("agregarUsuario", "notificacionesform",function() {
            var nombre = $("#txt_usr_nom").val();
            var rol = $("#txt_usr_defadmin").val();
            var usuario = $("#txt_usr_usu").val();
            var contrasena = $("#txt_usr_con").val();
            var contrasenacon = $("#txt_usr_con_con").val(); 
            var funcion = $("#funcion").val();
    
            $.ajax({
                    url: "../backend/usuarios.php",
                    type: "POST",
                    data: { id:id, 
                            nombre:nombre,
                            rol:rol,
                            usuario:usuario,
                            contrasena:contrasena,
                            contrasenacon:contrasenacon,
                            espacio:espacio,
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





function cerrarSesion() {
  verificaConectividad(function() {
    
          muestraMensajes("Se cerrará la sesión",'')
        window.setTimeout(function() {
             location.href = '../backend/cerrarSesion.php';
         }, 3500);
  });   
  ocultarCanvas('menuOffcanvas'); 
}

function muestraMensajesold(alerta, tipo){
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

function muestraMensajes(alerta){
  //Se establece el mensaje en la etiqueta
  $("#mensaje").html(alerta);  

  $('.toast').toast('show');
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
    fetch('espacios_det.php', { method: 'GET' })
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

      function revertirFormulario(){
        var spinner = '<div class="container text-center"><div class="spinner-border text-light text-center" role="status" data-bs-dismiss="modal" aria-label="Close"></div></div>';
        $("#formularios_contenedor").html(spinner);
      }


window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
  });
}, 2500);



       /* global bootstrap: false */
(() => {
  'use strict'
  const tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  tooltipTriggerList.forEach(tooltipTriggerEl => {
    new bootstrap.Tooltip(tooltipTriggerEl)
  })
})()
                                                  

      



     