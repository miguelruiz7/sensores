//Carga cualquier evento 

 // Para que la vista se actualize cada 5 segundos
 setInterval(function() {

  compruebaRuta('espacios_mst.php',function(){
    cargarEspacios();
  })

  compruebaRuta('pl_mst.php',function(){
    cargarPlacas();
  })
  
  compruebaRuta('disp_mst.php',function(){
    cargarDispositivos();
  })

  compruebaRuta('usuarios_mst.php',function(){
    cargarUsuarios();
  })

  compruebaRuta('secciones_mst.php',function(){
    cargarSecciones();
  })

  compruebaRuta('productos_mst.php',function(){
    cargarProductos();
  })

  compruebaRuta('roles_mst.php',function(){
    cargarRoles();
  })

  compruebaRuta('administrador_mst.php',function(){
    cargarAdministrador();
  })

  compruebaRuta('tipos_esp_mst.php',function(){
    cargarTiposEspacio();
  })

  compruebaRuta('dum_mst.php',function(){
    cargarUnidadesMedida();
  })

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

  function cargarPlacas(){
    verificaConectividad(function() {
      $.ajax({
        url: 'pl_det.php', // Ruta al archivo que quieres cargar
        type: 'GET', // Método de la petición (GET, POST, etc.)
        dataType: 'html', // Tipo de datos esperados en la respuesta
  
        success: function(data) {
          $('#placas').html(data); // Insertar el contenido en el contenedor con ID 'espacio'
        },
        error: function() {
          //alert('Ha ocurrido un error al cargar el archivo.');
        }
      });
      });   
    }


    function cargarDispositivos(){
      verificaConectividad(function() {
        $.ajax({
          url: 'disp_det.php', // Ruta al archivo que quieres cargar
          type: 'GET', // Método de la petición (GET, POST, etc.)
          dataType: 'html', // Tipo de datos esperados en la respuesta
    
          success: function(data) {
            $('#dispositivos').html(data); // Insertar el contenido en el contenedor con ID 'espacio'
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

    function cargarRoles(){
      verificaConectividad(function() {
        $.ajax({
          url: 'roles_det.php', // Ruta al archivo que quieres cargar
          type: 'GET', // Método de la petición (GET, POST, etc.)
          dataType: 'html', // Tipo de datos esperados en la respuesta
    
          success: function(data) {
            $('#roles').html(data); // Insertar el contenido en el contenedor con ID 'espacio'
          },
          error: function() {
            //alert('Ha ocurrido un error al cargar el archivo.');
          }
        });
        });   
      }

      function cargarAdministrador(){
        verificaConectividad(function() {
          $.ajax({
            url: 'administrador_det.php', // Ruta al archivo que quieres cargar
            type: 'GET', // Método de la petición (GET, POST, etc.)
            dataType: 'html', // Tipo de datos esperados en la respuesta
      
            success: function(data) {
              $('#administrador').html(data); // Insertar el contenido en el contenedor con ID 'espacio'
            },
            error: function() {
              //alert('Ha ocurrido un error al cargar el archivo.');
            }
          });
          });   
        }

        function cargarTiposEspacio(){
          verificaConectividad(function() {
            $.ajax({
              url: 'tipos_esp_det.php', // Ruta al archivo que quieres cargar
              type: 'GET', // Método de la petición (GET, POST, etc.)
              dataType: 'html', // Tipo de datos esperados en la respuesta
        
              success: function(data) {
                $('#tipos_espacios').html(data); // Insertar el contenido en el contenedor con ID 'espacio'
              },
              error: function() {
                //alert('Ha ocurrido un error al cargar el archivo.');
              }
            });
            });   
          }


          function cargarUnidadesMedida(){
            verificaConectividad(function() {
              $.ajax({
                url: 'dum_det.php', // Ruta al archivo que quieres cargar
                type: 'GET', // Método de la petición (GET, POST, etc.)
                dataType: 'html', // Tipo de datos esperados en la respuesta
          
                success: function(data) {
                  $('#unidades_medida').html(data); // Insertar el contenido en el contenedor con ID 'espacio'
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



    function obtenerURL() {
      var ruta = window.location.pathname;
      var archivo = ruta.split('/').pop();
      return archivo;
    }



    function compruebaRuta(url,funcion){
     var archivobase =  obtenerURL()
    // console.log(archivobase);
     if(url === archivobase){
       funcion();
     }
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


  function formAgregarProd(){
    verificaConectividad(function() {
          var formulario = 'agregarProducto';
          $.ajax({
                  url: "productos.php",
                  type: "POST",
                  data: {formulario:formulario},
                  success: function(contenido){
                      $("#formularios_contenedor").html(contenido);
                  }
              });
      });   
    }


    function agregarProducto(seccion) {
      verificaConectividad(function() {
          verificarllenosForm("agregarProducto", "notificacionesform",function() {
              var nombre = $("#txt_prod_nom").val();
              var descripcion = $("#txt_prod_desc").val();
              var funcion = $("#funcion").val();
      
              $.ajax({
                      url: "../backend/productos.php",
                      type: "POST",
                      data: {nombre:nombre,
                              seccion:seccion,
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


            
    function formModificarProd(producto){
      verificaConectividad(function() {
            var formulario = 'modificarProducto';
            $.ajax({
                    url: "productos.php",
                    type: "POST",
                    data: {producto:producto,
                      formulario:formulario},
                    success: function(contenido){
                        $("#formularios_contenedor").html(contenido);
                    }
                });
        });   
      }

      function modificarProducto(producto) {
        verificaConectividad(function() {
            verificarllenosForm("modificarProducto", "notificacionesform",function() {
                var nombre = $("#txt_prod_nom").val();
                var descripcion = $("#txt_prod_desc").val();
               
                var funcion = $("#funcion").val();
        
                $.ajax({
                        url: "../backend/productos.php",
                        type: "POST",
                        data: {nombre:nombre,
                                producto:producto,
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


      function eliminarProducto(producto) {
        verificaConectividad(function() {
          var funcion = "eliminarProducto";
                $.ajax({
                        url: "../backend/productos.php",
                        type: "POST",
                        data: {producto:producto, funcion:funcion},
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



    function formPlacas(producto){
      verificaConectividad(function() {
            var formulario = 'placasProducto';
            $.ajax({
                    url: "productos.php",
                    type: "POST",
                    data: {producto:producto,
                      formulario:formulario},
                    success: function(contenido){
                        $("#formularios_contenedor").html(contenido);
                    }
                });
        });   
      }


      function formAgregarPlaca(producto){
        verificaConectividad(function() {
              var formulario = 'agregarPlaca';
              $.ajax({
                      url: "productos.php",
                      type: "POST",
                      data: {producto:producto,
                        formulario:formulario},
                      success: function(contenido){
                          $("#formularios_contenedor").html(contenido);
                      }
                  });
          });   
        }
  

        function agregarPlaca(producto) {
          verificaConectividad(function() {
              verificarllenosForm("agregarPlaca", "notificacionesform",function() {
                  var placa = $("#txt_pl_pl_id").val();
                  var descripcion = $("#txt_pl_desc").val();
                  var ip = $("#txt_pl_ip").val();
                  var funcion = $("#funcion").val();
          
                  $.ajax({
                          url: "../backend/productos.php",
                          type: "POST",
                          data: {placa:placa,
                                  producto:producto,
                                  descripcion:descripcion,
                                  ip:ip,
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
    
        
      function formModificarPlaca(placa){
        verificaConectividad(function() {
              var formulario = 'modificarPlaca';
              $.ajax({
                      url: "productos.php",
                      type: "POST",
                      data: {placa:placa,
                        formulario:formulario},
                      success: function(contenido){
                          $("#formularios_contenedor").html(contenido);
                      }
                  });
          });   
        }



        function modificarPlaca(placa) {
          verificaConectividad(function() {
              verificarllenosForm("modificarPlaca", "notificacionesform",function() {
                  var descripcion = $("#txt_pl_desc").val();
                  var ip = $("#txt_pl_ip").val();
                  var producto = $("#txt_pl_prod_id").val();
                  var funcion = $("#funcion").val();
          
                  $.ajax({
                          url: "../backend/productos.php",
                          type: "POST",
                          data: { placa:placa,
                                  producto:producto,
                                  descripcion:descripcion,
                                  ip:ip,
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


        function eliminarPlaca(placa, producto) {
          verificaConectividad(function() {
            var funcion = "eliminarPlaca";
                  $.ajax({
                          url: "../backend/productos.php",
                          type: "POST",
                          data: {placa:placa, producto:producto, funcion:funcion},
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


        function formDispositivos(producto){
          verificaConectividad(function() {
                var formulario = 'dispositivosProducto';
                $.ajax({
                        url: "productos.php",
                        type: "POST",
                        data: {producto:producto,
                          formulario:formulario},
                        success: function(contenido){
                            $("#formularios_contenedor").html(contenido);
                        }
                    });
            });   
          }

          
        function formAgregarDispositivos(producto){
          verificaConectividad(function() {
                var formulario = 'agregarDispositivo';
                $.ajax({
                        url: "productos.php",
                        type: "POST",
                        data: {producto:producto,
                          formulario:formulario},
                        success: function(contenido){
                            $("#formularios_contenedor").html(contenido);
                        }
                    });
            });   
          }
          

          function agregarDispositivo(producto) {
            verificaConectividad(function() {
                verificarllenosForm("agregarDispositivo", "notificacionesform",function() {
                    var dispositivo = $("#txt_disp_disp_id").val();
                    var placa = $("#txt_disp_pl_id").val();   
        
                    var funcion = $("#funcion").val();
            
                    $.ajax({
                            url: "../backend/productos.php",
                            type: "POST",
                            data: {dispositivo:dispositivo,
                                    producto:producto,                   
                                    placa:placa,
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
          

                    
        function formModificarDispositivos(dispositivo,producto){
          verificaConectividad(function() {
                var formulario = 'modificarDispositivo';
                $.ajax({
                        url: "productos.php",
                        type: "POST",
                        data: {dispositivo:dispositivo,
                               producto:producto,
                          formulario:formulario},
                        success: function(contenido){
                            $("#formularios_contenedor").html(contenido);
                        }
                    });
            });   
          }


          function modificarDispositivo(dispositivo, producto) {
            verificaConectividad(function() {
                verificarllenosForm("modificarDispositivo", "notificacionesform",function() {
                    var placa = $("#txt_disp_pl_id").val();   
                    var funcion = $("#funcion").val();
            
                    $.ajax({
                            url: "../backend/productos.php",
                            type: "POST",
                            data: { dispositivo:dispositivo,
                                    producto:producto,
                                    placa:placa, 
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

          
        function eliminarDispositivo(dispositivo,producto) {
          verificaConectividad(function() {
            var funcion = "eliminarDispositivo";
                  $.ajax({
                          url: "../backend/productos.php",
                          type: "POST",
                          data: {dispositivo:dispositivo, producto:producto, funcion:funcion},
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


       function form_disp_historico(dispositivo){
        verificaConectividad(function() {
          var formulario = 'form_disp_historico';
          $.ajax({
                  url: "productos.php",
                  type: "POST",
                  data: {
                    dispositivo:dispositivo,
                    formulario:formulario},
                  success: function(contenido){
                      $("#formularios_contenedor").html(contenido);
                  }
              });
      });   
       }


       function func_disp_historico(formulario,dispositivo) {
        verificaConectividad(function() {
            verificarllenosForm(formulario, "notificacionesform",function() {
                var inicio = $("#txt_disp_his_inicio").val();
                var final = $("#txt_disp_his_final").val();         
                var url = 'g.php?disp='+dispositivo+'&txtInicio='+inicio+'&txtFinal='+final+''; // Ruta al archivo que quieres cargar
                document.getElementById('historico').src = url;

            });
        });    
      }

      function func_disp_historicov2(formulario,dispositivo) {
        verificaConectividad(function() {
            verificarllenosForm(formulario, "notificacionesform",function() {
                var inicio = $("#txt_disp_his_inicio").val();
                var final = $("#txt_disp_his_final").val();         
                var url = 'g2.php?disp='+dispositivo+'&txtInicio='+inicio+'&txtFinal='+final+''; // Ruta al archivo que quieres cargar
                document.getElementById('historico').src = url;

            });
        });    
      }
    


        // ADMINISTRADOR


        function form_rol_agregar(){
          verificaConectividad(function() {
                var formulario = 'form_rol_agregar';
                $.ajax({
                        url: "admin.php",
                        type: "POST",
                        data: {
                          formulario:formulario},
                        success: function(contenido){
                            $("#formularios_contenedor").html(contenido);
                        }
                    });
            });   
          }

          function func_rol_agregar(formulario) {
            verificaConectividad(function() {
                verificarllenosForm(formulario, "notificacionesform",function() {
                    var nombre = $("#txt_usrol_nom").val();
                    var descripcion = $("#txt_usrol_desc").val();

                    var gral_lectura = $("#txt_usrol_gral_lec").val();   
                    var gral_escritura =  $("#txt_usrol_gral_esc").val();

                    var esp_lectura = $("#txt_usrol_esp_lec").val();   
                    var esp_escritura =  $("#txt_usrol_esp_esc").val();
                    
                    var sec_lectura = $("#txt_usrol_sec_lec").val();   
                    var sec_escritura =  $("#txt_usrol_sec_esc").val();
                       
                    var prod_lectura = $("#txt_usrol_prod_lec").val();   
                    var prod_escritura =  $("#txt_usrol_prod_esc").val();
                    
                    var disp_lectura = $("#txt_usrol_disp_lec").val();   
                    var disp_escritura =  $("#txt_usrol_disp_esc").val();

                   
            
                    $.ajax({
                            url: "../backend/admin.php",
                            type: "POST",
                            data: {nombre:nombre,
                              descripcion:descripcion,
                              gral_lectura:gral_lectura,
                              gral_escritura:gral_escritura,
                              esp_lectura:esp_lectura,
                              esp_escritura:esp_escritura,
                              sec_lectura:sec_lectura,
                              sec_escritura:sec_escritura,
                              prod_lectura:prod_lectura,
                              prod_escritura:prod_escritura,
                              disp_lectura:disp_lectura,
                              disp_escritura:disp_escritura,
                                    funcion:formulario},
                            success: function(errores){
                                $("#notificaciones").html(errores);       
                            }
                        });
      
                });
            });    
          }

          function form_rol_modificar(usrol){
            verificaConectividad(function() {
                  var formulario = 'form_rol_modificar';
                  $.ajax({
                          url: "admin.php",
                          type: "POST",
                          data: {
                            usrol:usrol,
                            formulario:formulario},
                          success: function(contenido){
                              $("#formularios_contenedor").html(contenido);
                          }
                      });
              });   
            }

            function func_rol_modificar(formulario,usrol) {
              verificaConectividad(function() {
                  verificarllenosForm(formulario, "notificacionesform",function() {
                      var nombre = $("#txt_usrol_nom").val();
                      var descripcion = $("#txt_usrol_desc").val();
                      var estado = $("#txt_usrol_estado").val();
  
                      var gral_lectura = $("#txt_usrol_gral_lec").val();   
                      var gral_escritura =  $("#txt_usrol_gral_esc").val();
  
                      var esp_lectura = $("#txt_usrol_esp_lec").val();   
                      var esp_escritura =  $("#txt_usrol_esp_esc").val();
                      
                      var sec_lectura = $("#txt_usrol_sec_lec").val();   
                      var sec_escritura =  $("#txt_usrol_sec_esc").val();
                         
                      var prod_lectura = $("#txt_usrol_prod_lec").val();   
                      var prod_escritura =  $("#txt_usrol_prod_esc").val();
                      
                      var disp_lectura = $("#txt_usrol_disp_lec").val();   
                      var disp_escritura =  $("#txt_usrol_disp_esc").val();
  
                     
              
                      $.ajax({
                              url: "../backend/admin.php",
                              type: "POST",
                              data: {
                                usrol:usrol,
                                nombre:nombre,
                                descripcion:descripcion,
                                estado:estado,
                                gral_lectura:gral_lectura,
                                gral_escritura:gral_escritura,
                                esp_lectura:esp_lectura,
                                esp_escritura:esp_escritura,
                                sec_lectura:sec_lectura,
                                sec_escritura:sec_escritura,
                                prod_lectura:prod_lectura,
                                prod_escritura:prod_escritura,
                                disp_lectura:disp_lectura,
                                disp_escritura:disp_escritura,
                                      funcion:formulario},
                              success: function(errores){
                                  $("#notificaciones").html(errores);       
                              }
                          });
        
                  });
              });    
            }
                
        function func_rol_eliminar(rol) {
          verificaConectividad(function() {
            var funcion = "func_rol_eliminar";
                  $.ajax({
                          url: "../backend/admin.php",
                          type: "POST",
                          data: {rol:rol,
                                 funcion:funcion},
                          success: function(contenido){
                            $("#notificaciones").html(contenido);
                          }
                      });
          });    
        }


        function form_esp_tipo_agregar(){
          verificaConectividad(function() {
            var formulario = 'form_esp_tipo_agregar';
            $.ajax({
                    url: "admin.php",
                    type: "POST",
                    data: {
                      formulario:formulario},
                    success: function(contenido){
                        $("#formularios_contenedor").html(contenido);
                    }
                });
        });  
        }




        function func_esp_tipo_agregar(formulario) {
          verificarllenosForm(formulario, "notificacionesform",function() {
            verificaConectividad(function() {
                      var nombre = $("#txt_esp_tipo_nom").val()
                      var descripcion = $("#txt_esp_tipo_desc").val()

                      $.ajax({
                              url: "../backend/admin.php",
                              type: "POST",
                              data: {nombre:nombre,
                                descripcion:descripcion,
                                      funcion:formulario},
                              success: function(errores){
                                  $("#notificaciones").html(errores);       
                              }
                          });
            });   
      });    
    }



    function form_esp_tipo_modificar(variable){
      verificaConectividad(function() {
        var formulario = 'form_esp_tipo_modificar';
        $.ajax({
                url: "admin.php",
                type: "POST",
                data: {
                  variable:variable,
                  formulario:formulario},
                success: function(contenido){
                    $("#formularios_contenedor").html(contenido);
                }
            });
    });  
    }


    function func_esp_tipo_modificar(formulario, tipoEspacio) {
      verificarllenosForm(formulario, "notificacionesform",function() {
        verificaConectividad(function() {
                  var nombre = $("#txt_esp_tipo_nom").val()
                  var descripcion = $("#txt_esp_tipo_desc").val()
                  var estado = $("#txt_esp_tipo_estado").val();

  
                  $.ajax({
                          url: "../backend/admin.php",
                          type: "POST",
                          data: {tipoEspacio:tipoEspacio,
                            nombre:nombre,
                            descripcion:descripcion,
                            estado:estado,
                                  funcion:formulario},
                          success: function(errores){
                              $("#notificaciones").html(errores);       
                          }
                      });
        });   
  });    
}

          
function func_esp_tipo_eliminar(tipoEspacio) {
  verificaConectividad(function() {
    var funcion = "func_esp_tipo_eliminar";
          $.ajax({
                  url: "../backend/admin.php",
                  type: "POST",
                  data: {tipoEspacio:tipoEspacio,
                         funcion:funcion},
                  success: function(contenido){
                    $("#notificaciones").html(contenido);
                  }
              });
  });    
}



function form_dum_agregar(){
  verificaConectividad(function() {
    var formulario = 'form_dum_agregar';
    $.ajax({
            url: "admin.php",
            type: "POST",
            data: {
              formulario:formulario},
            success: function(contenido){
                $("#formularios_contenedor").html(contenido);
            }
        });
});  
}

function func_dum_agregar(formulario) {
  verificarllenosForm(formulario, "notificacionesform",function() {
    verificaConectividad(function() {
              var nombre = $("#txt_dum_nom").val()
              var siglas = $("#txt_dum_sigl").val()

              $.ajax({
                      url: "../backend/admin.php",
                      type: "POST",
                      data: {nombre:nombre,
                        siglas:siglas,
                              funcion:formulario},
                      success: function(errores){
                          $("#notificaciones").html(errores);       
                      }
                  });
    });   
});    
}

function form_dum_modificar(unidad){
  verificaConectividad(function() {
    var formulario = 'form_dum_modificar';
    $.ajax({
            url: "admin.php",
            type: "POST",
            data: {
              unidad:unidad,
              formulario:formulario},
            success: function(contenido){
                $("#formularios_contenedor").html(contenido);
            }
        });
});  
}


function func_dum_modificar(formulario, unidad) {
  verificarllenosForm(formulario, "notificacionesform",function() {
    verificaConectividad(function() {
              var nombre = $("#txt_dum_nom").val()
              var siglas = $("#txt_dum_sigl").val()
              var estado = $("#txt_dum_estado").val();


              $.ajax({
                      url: "../backend/admin.php",
                      type: "POST",
                      data: {unidad:unidad,
                        nombre:nombre,
                        siglas:siglas,
                        estado:estado,
                              funcion:formulario},
                      success: function(errores){
                          $("#notificaciones").html(errores);       
                      }
                  });
    });   
});    
}




function func_dum_eliminar(unidad) {
  verificaConectividad(function() {
    var funcion = "func_dum_eliminar";
          $.ajax({
                  url: "../backend/admin.php",
                  type: "POST",
                  data: {unidad:unidad,
                         funcion:funcion},
                  success: function(contenido){
                    $("#notificaciones").html(contenido);
                  }
              });
  });    
}




// Administracion de usuarios, placas y dispositivos simplificacion de codigo  (v1.2)

          function form_usr_agregar(){
            verificaConectividad(function() {
              var formulario = 'form_usr_agregar';
              $.ajax({
                      url: "usuarios.php",
                      type: "POST",
                      data: {
                        formulario:formulario},
                      success: function(contenido){
                          $("#formularios_contenedor").html(contenido);
                      }
                  });
          });   
          }

          function func_usr_agregar(formulario) {
            verificarllenosForm(formulario, "notificacionesform",function() {
              verificaConectividad(function() {

                      var nombre = $("#txt_usr_nom").val();
                      var rol = $("#txt_usr_defadmin").val();
                      var usuario = $("#txt_usr_usu").val();
                      var contrasena = $("#txt_usr_con").val();
                      var contrasenacon = $("#txt_usr_con_con").val(); 
                  
                      $.ajax({
                              url: "../backend/usuarios.php",
                              type: "POST",
                              data: {nombre:nombre,
                                rol:rol,
                            usuario:usuario,
                            contrasena:contrasena,
                            contrasenacon:contrasenacon,
                                funcion:formulario},
                              success: function(contenido){
                                $("#notificaciones").html(contenido);
                                console.log('Los datos que fueron enviados desde el formulario "'+formulario+'" fueron: ' + nombre, descripcion)
                              }
                    });
              });   
          });    
          }


          function form_usr_modificar_con(usuario){
            verificaConectividad(function() {
              var formulario = "form_usr_modificar_con";
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

          function func_usr_modificar_con(formulario, usuario) {
            verificaConectividad(function() {
                verificarllenosForm(formulario, "notificacionesform",function() {
                    var contrasena = $("#txt_usr_con").val();
                    var contrasenacon = $("#txt_usr_con_con").val();
                 
            
                    $.ajax({
                            url: "../backend/usuarios.php",
                            type: "POST",
                            data: { usuario:usuario, 
                                    contrasena:contrasena,
                                    contrasenacon:contrasenacon,
                                    funcion:formulario},
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


          
                      function form_usr_modificar_datos(usuario){
                        verificaConectividad(function() {
                          var formulario = "form_usr_modificar_datos"; 
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


                      function func_usr_modificar_datos(formulario, usuario) {
                        verificaConectividad(function() {
                            verificarllenosForm(formulario, "notificacionesform",function() {
                                 var nombre = $("#txt_usr_nom").val();
                                
                        
                                $.ajax({
                                        url: "../backend/usuarios.php",
                                        type: "POST",
                                        data: { usuario:usuario, 
                                                nombre:nombre,
                                                funcion:formulario},
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




              function func_usr_eliminar(usuario) {
                verificaConectividad(function() {
                  var funcion = "func_usr_eliminar";
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
               

              
          function form_usr_admin(){
            verificaConectividad(function() {
              var formulario = 'form_usr_admin';
              $.ajax({
                      url: "admin.php",
                      type: "POST",
                      data: {
                        formulario:formulario},
                      success: function(contenido){
                          $("#formularios_contenedor").html(contenido);
                      }
                  });
          });   
          }


          function func_usr_admin(formulario) {
              verificaConectividad(function() {
                      var usuario = $("#txt_usr_id").val();
                
                      $.ajax({
                              url: "../backend/admin.php",
                              type: "POST",
                              data: {usuario:usuario,
                                funcion:formulario},
                              success: function(contenido){
                                $("#notificaciones").html(contenido);
                                console.log('Los datos que fueron enviados desde el formulario "'+formulario+'" fueron: ' + usuario)
                              }
                    });
              });   
          }



              function pruebaalerta(usuario) {
                mensajeconfirmacion('Esto es una prueba de confirmacion', function(){

                 alert("Aqui continua la lógica del negocio");

                })
                 
              }


          

        function form_pl_agregar(){
          verificaConectividad(function() {
            var formulario = 'form_pl_agregar';
            $.ajax({
                    url: "pl.php",
                    type: "POST",
                    data: {
                      formulario:formulario},
                    success: function(contenido){
                        $("#formularios_contenedor").html(contenido);
                    }
                });
        });   
        }


        function form_pl_modificar(placa){
          verificaConectividad(function() {
            var formulario = 'form_pl_modificar';
            $.ajax({
                    url: "pl.php",
                    type: "POST",
                    data: {
                      placa:placa,
                      formulario:formulario},
                    success: function(contenido){
                        $("#formularios_contenedor").html(contenido);
                    }
                });
        });   
        }
    

        function func_pl_agregar(formulario) {
              verificarllenosForm(formulario, "notificacionesform",function() {
                verificaConectividad(function() {
                          var nombre = $("#txt_pl_nom").val()
                          var descripcion = $("#txt_pl_desc").val()

                        $.ajax({
                                url: "../backend/admin.php",
                                type: "POST",
                                data: {nombre:nombre,
                                  descripcion:descripcion,
                                  funcion:formulario},
                                success: function(contenido){
                                  $("#notificaciones").html(contenido);
                                  console.log('Los datos que fueron enviados desde el formulario "'+formulario+'" fueron: ' + nombre, descripcion)
                                }
                      });
                });   
          });    
        }


        function func_pl_modificar(formulario, placa) {
          verificarllenosForm(formulario, "notificacionesform",function() {
            verificaConectividad(function() {
                      var nombre = $("#txt_pl_nom").val()
                      var descripcion = $("#txt_pl_desc").val()

                    $.ajax({
                            url: "../backend/admin.php",
                            type: "POST",
                            data: {placa:placa,
                              nombre:nombre,
                              descripcion:descripcion,
                              funcion:formulario},
                            success: function(contenido){
                              $("#notificaciones").html(contenido);
                              console.log('Los datos que fueron enviados desde el formulario "'+formulario+'" fueron: ' + placa, nombre, descripcion)
                            }
                  });
            });   
      });    
    }


        function func_pl_eliminar(placa) {
            verificaConectividad(function() {
              funcion = 'func_pl_eliminar'
                    $.ajax({
                            url: "../backend/admin.php",
                            type: "POST",
                            data: {placa:placa,
                              funcion:funcion},
                            success: function(contenido){
                              $("#notificaciones").html(contenido);
                              console.log('Los datos que fueron enviados fueron: ' + placa)
                            }
                  });
          }); 
    }


    
    function form_disp_agregar(){
      verificaConectividad(function() {
        var formulario = 'form_disp_agregar';
        $.ajax({
                url: "disp.php",
                type: "POST",
                data: {
                  formulario:formulario},
                success: function(contenido){
                    $("#formularios_contenedor").html(contenido);
                }
            });
    });   
    }
    
    function form_disp_modificar(dispositivo){
      verificaConectividad(function() {
        var formulario = 'form_disp_modificar';
        $.ajax({
                url: "disp.php",
                type: "POST",
                data: {
                  dispositivo:dispositivo,
                  formulario:formulario},
                success: function(contenido){
                    $("#formularios_contenedor").html(contenido);
                }
            });
    });   
    }


    function func_disp_agregar(formulario) {
      verificarllenosForm(formulario, "notificacionesform",function() {
        verificaConectividad(function() {
                  var nombre = $("#txt_disp_nom").val()
                  var descripcion = $("#txt_disp_desc").val()
                  var unidad = $("#txt_disp_dum_id").val()
                  var tipo = $("#txt_disp_disp_tipo_id").val();

                $.ajax({
                        url: "../backend/admin.php",
                        type: "POST",
                        data: {nombre:nombre,
                          descripcion:descripcion,
                          unidad:unidad,
                          tipo:tipo,
                          funcion:formulario},
                        success: function(contenido){
                          $("#notificaciones").html(contenido);
                          console.log('Los datos que fueron enviados desde el formulario "'+formulario+'" fueron: ' + nombre, descripcion, unidad, tipo)
                        }
              });
        });   
  });    
}

function func_disp_modificar(formulario, dispositivo) {
  verificarllenosForm(formulario, "notificacionesform",function() {
    verificaConectividad(function() {

                var nombre = $("#txt_disp_nom").val()
                var descripcion = $("#txt_disp_desc").val()
                var unidad = $("#txt_disp_dum_id").val()
                var tipo = $("#txt_disp_disp_tipo_id").val();

            $.ajax({
                    url: "../backend/admin.php",
                    type: "POST",
                    data: {dispositivo:dispositivo,
                      nombre:nombre,
                      descripcion:descripcion,
                      unidad:unidad,
                      tipo:tipo,
                      funcion:formulario},
                    success: function(contenido){
                      $("#notificaciones").html(contenido);
                      console.log('Los datos que fueron enviados desde el formulario "'+formulario+'" fueron: ' + nombre, descripcion, unidad, tipo)
                    }
          });
    });   
});    
}


function func_disp_eliminar(dispositivo) {
  verificaConectividad(function() {
    funcion = 'func_disp_eliminar'
          $.ajax({
                  url: "../backend/admin.php",
                  type: "POST",
                  data: {dispositivo:dispositivo,
                    funcion:funcion},
                  success: function(contenido){
                    $("#notificaciones").html(contenido);
                    console.log('Los datos que fueron enviados fueron: ' + dispositivo)
                  }
        });
}); 
}







//Funciones generales del sistema que son muy importantes

function cerrarSesion() {
  verificaConectividad(function() {
    
          muestraMensajes("Se cerrará la sesión",'')
        window.setTimeout(function() {
             location.href = '../backend/cerrarSesion.php';
         }, 3500);
  });   
  ocultarCanvas('menuOffcanvas'); 
}

//Obsoleto
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

function obtenerIdForm(){
  var form = document.querySelector('form');
  var id = form.getAttribute('id');
  return id;
}


function desabilitaFormBtn(){
  var btn = document.getElementById('btn_form');
  btn.disabled = true;
}


function habilitaFormBtn(){
  var btn = document.getElementById('btn_form');
  btn.disabled = false;
}

function mensajeconfirmacion(alerta, funcion){
  var mensaje = confirm(alerta)

  if(mensaje){
    funcion();
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
                      habilitaFormBtn();
                     // muestraMensajesFormularios(alerta,notificacionform,'error');
                     muestraMensajes(alerta);
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
                                                  

      



     