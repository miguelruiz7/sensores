<!DOCTYPE html>
<html>
<head>
  <title>Carpeta de Productos y Clientes</title>
  <style>
    .container {
      max-width: 800px;
      margin: 0 auto;
    }

    .tabs {
      display: flex;
    }

    .tab {
      flex: 1;
      padding: 10px;
      background-color: lightgray;
      cursor: pointer;
    }

    .tab:hover {
      background-color: gray;
    }

    .tab-content {
      display: none;
    }

    .tab-content.show {
      display: block;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="tabs">
      <button class="tab" onclick="openTab(event, 'productos')">Productos</button>
      <button class="tab" onclick="openTab(event, 'clientes')">Clientes</button>
    </div>
    <div id="productos" class="tab-content">
      <h2>Lista de Productos</h2>
      <!-- Aquí se mostrarían los productos -->
    </div>
    <div id="clientes" class="tab-content">
      <h2>Lista de Clientes</h2>
      <!-- Aquí se mostrarían los clientes -->
    </div>
  </div>
  
  <script>
    function openTab(event, tabName) {
      var i, tabContent, tabButtons;
      
      tabContent = document.getElementsByClassName("tab-content");
      for (i = 0; i < tabContent.length; i++) {
        tabContent[i].style.display = "none";
      }
      
      tabButtons = document.getElementsByClassName("tab");
      for (i = 0; i < tabButtons.length; i++) {
        tabButtons[i].className = tabButtons[i].className.replace(" active", "");
      }
      
      document.getElementById(tabName).style.display = "block";
      event.currentTarget.className += " active";
    }

    // Mostrar el contenido de la pestaña "Productos" al cargar la página
    document.getElementById("productos").style.display = "block";
    document.getElementsByClassName("tab")[0].className += " active";
  </script>
</body>
</html>
