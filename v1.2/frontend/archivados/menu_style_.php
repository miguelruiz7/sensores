<?php

session_start();
if (!isset($_SESSION['emp_id']) || !isset($_SESSION['usu_id']))
    header("location:../frontend/");
$usu_id = $_SESSION['usu_id'];
$emp_id = $_SESSION['emp_id'];
$usu_rol_id = $_SESSION['rus_rol_id'];
$cus_id = $_SESSION['cus_id'];
$cus_nombre = $_SESSION['cus_nombre'];
require '../backend/scripts/administracion/usu_mst.php';
$usu_mst = new usu_mst();
$route = '../';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/menudos.css">
    <link rel="stylesheet" href="css/awesome/font-awesome.css">
    <!--link rel="stylesheet" href="css/zoom80.css"-->
    <link rel="shorcut icon" href="css/img/icono.png"> <!-- actualizo para pestaña-->

    <title>Menu </title>
</head>

<body>
    <div id="barra-azul" style="background-color: rgb(7, 6, 105); width:100%; height:40px; position:fixed; margin-bottom:10%; z-index:2;">
        <div class="noti-hidden" id="noti"></div>
    </div>
    <div id="sidemenu" class="menu-collapsed" style="overflow-y:scroll;">
        <div id="cabecera">
            <div id="menu-btn" onclick="colapsar_menu()">
                <div class="btn-hamburguer"></div>
                <div class="btn-hamburguer"></div>
                <div class="btn-hamburguer"></div>
            </div>
        </div>
        <div id="perfil">
            <div id="imagen">
                <img src="css/img/profile.png" alt="" id="logo">
            </div>
            <div id="titulo">
                <span><?php echo $usu_id ?> </span>
            </div>
            <div id="accion">
                <a href="logout.php">
                    <i class="fa fa-times btn" id="cross"></i>
                    <button class="btn" id="cross-btn"><i class="fa fa-times"></i>Salir</button>
                </a>
            </div>
        </div>

        <div id="menu-ini">

            <?php
            $result_access = $usu_mst->access_form($emp_id, $usu_id, 161, $route);
            while ($access = $result_access->fetch_assoc()) {
                if ($access['prol_lec'] == '1') {
            ?>
                    <a class="menu-item" id="pedido" href="product_list.php" title="Capturar Pedido"> <!-- INICIO MODULO sin colapsar-->
                        <div class="icono"><i class="fa fa-shopping-cart"></i></div>
                        <div class="titulo"><span> Capturar Pedido</span></div>
                    </a>
            <?php
                }
            }
            ?>
            <?php
            $result_access = $usu_mst->access_form($emp_id, $usu_id, 162, $route);
            while ($access = $result_access->fetch_assoc()) {
                if ($access['prol_lec'] == '1') {
            ?>
                    <!-- FIN MODULO -->
                    <div class="item-separator"></div>
                    <a class="menu-item" id="pedido" href="pedidos.php" title="Mis Pedidos"> <!-- INICIO MODULO sin colapsar-->
                        <div class="icono"><i class="fa fa-suitcase"></i></div>
                        <div class="titulo"><span> Mis Pedidos</span></div>
                    </a> <!-- FIN MODULO -->
            <?php
                }
            }
            ?>

            <?php
            $result_access = $usu_mst->access_form($emp_id, $usu_id, 163, $route);
            while ($access = $result_access->fetch_assoc()) {
                if ($access['prol_lec'] == '1') {
            ?>
                    <div class="item-separator"></div>
                    <a class="menu-item" id="pedido" href="reporte_ventas.php" title="Reportes"> <!-- INICIO MODULO sin colapsar-->
                        <div class="icono"><i class="fa fa-file"></i></div>
                        <div class="titulo"><span> Reportes</span></div>
                    </a> <!-- FIN MODULO -->
            <?php
                }
            }
            ?>

            <?php
            #if ($_SESSION['rus_rol_id'] == 0 || $_SESSION['rus_rol_id'] == 1 || $_SESSION['rus_rol_id'] == 2 ) {
            ?>
            <div class="menu-item" id="item1" title="Administración" onclick="colapsar_btn('item1')"> <!-- INICIO MODULO -->
                <div class="icono"><i class="fa fa fa-desktop"></i></div>
                <div class="titulo"><span> ADMINISTRACION</span></div>
                <div class="menu-sitem-collapse" id="sitem1">

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 2, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {
                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="emp_mst.php" title="Empresas">
                                        <!--div class="icon"><i class="fa fa-shopping-cart"></i></div-->
                                        <div class="title"><span>Empresas</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>


                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 5, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="rol_mst.php" title="Roles">
                                        <!--div class="icon"><i class="fa fa-shopping-cart"></i></div-->
                                        <div class="title"><span>Roles-Perfiles</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 6, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {
                    ?>

                            <div class="s-item">
                                <li>
                                    <a href="pro_mst.php" title="Permisos X Rol de Seguridad">
                                        <!--div class="icon"><i class="fa fa-tablet"></i></div-->
                                        <div class="title"><span>Permisos X Rol de Seguridad</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 7, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="usu_mst.php" title="Usuarios">
                                        <div class="title"><span>Usuarios</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 5, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="rus_mst.php" title="Roles de Usuario">
                                        <!--div class="icon"><i class="fa fa-shopping-cart"></i></div-->
                                        <div class="title"><span>Roles de Usuario</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>






                </div>
            </div> <!-- FIN MODULO -->
            <?php
            #}
            ?>


            <!-- INICIO MODULO iNVENTARIO-->

            <?php
            #if ($_SESSION['rus_rol_id'] == 0 || $_SESSION['rus_rol_id'] == 1  || $_SESSION['rus_rol_id'] == 2 || $_SESSION['rus_rol_id'] == 4 || $_SESSION['rus_rol_id'] == 5) {
            ?>
            <div class="menu-item" id="item2" title="Inventarios" onclick="colapsar_btn('item2')">
                <div class="icono"><i class="fa fa-inbox"></i></div>
                <div class="titulo"><span> INVENTARIOS</span></div>
                <div class="menu-sitem-collapse" id="sitem2">

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 80, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {
                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="alm_mst.php" title="Almacenes">
                                        <div class="title"><span>Almacenes</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 81, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="ubi_mst.php" title="Ubicaciones">
                                        <div class="title"><span>Ubicaciones</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 82, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {
                    ?>

                            <div class="s-item">
                                <li>
                                    <a href="fam_mst.php" title="Familia de Productos">
                                        <div class="title"><span>Familia de Productos</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 83, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="sfam_mst.php" title="Subfamilia de Productos">
                                        <div class="title"><span>Subfamilia de Productos</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 84, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="prod_mst.php" id="prod_mst" title="Catálogo de Productos">
                                        <div class="title"><span>Catálogo de Productos</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>


                    <div class="s-item">
                        <br></br>
                        <a style="color:#2E9AFE">
                            <div class="title"><span> ACCIONES</span></div>
                        </a>
                    </div>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 88, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="minv_mst.php" title="Movimientos de Inventario (Kardex)">
                                        <div class="title"><span>Movimientos de Inventario(Kardex)</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <div class="s-item">
                        <br></br>
                        <a style="color:#2E9AFE">
                            <div class="title"><span> REPORTES</span></div>
                        </a>
                    </div>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 86, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="invd_mst2.php" title="Inventarios x Almacén">
                                        <div class="title"><span>Inventarios x Almacén</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 91, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="krdx.php" title="Saldos Inventario">
                                        <div class="title"><span>Saldos Inventario</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 92, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="slinv.php" title="Detalle Saldo de Inventario">
                                        <div class="title"><span>Detalle Saldo de Inventario</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                </div>
            </div> <!-- FIN MODULO INVENTARIOS-->
            <?php
            #}
            ?>


            <!-- INICIO MODULO COMPRAS-->

            <?php
            #if ($_SESSION['rus_rol_id'] == 0 || $_SESSION['rus_rol_id'] == 1  || $_SESSION['rus_rol_id'] == 2 || $_SESSION['rus_rol_id'] == 4 || $_SESSION['rus_rol_id'] == 5) {
            ?>
            <div class="menu-item" id="item3" title="Compras" onclick="colapsar_btn('item3')">
                <div class="icono"><i class="fa fa-tags"></i></div>
                <div class="titulo"><span> COMPRAS</span></div>
                <div class="menu-sitem-collapse" id="sitem3">
                    <a style="color:#2E9AFE">
                        <div class="title"><span>CATALOGOS</span></div>
                    </a>
                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 60, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {
                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="sup_mst.php" title="Proveedores">
                                        <div class="title"><span>Proveedores</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 61, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="shipf_mst.php" title="Dirección de Recogida de Proveedores">
                                        <div class="title"><span>Dirección de Recogida de Proveedores</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 62, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {
                    ?>

                            <div class="s-item">
                                <li>
                                    <a href="lprep_mst.php" title="Lista de Precios de Proveedores">
                                        <div class="title"><span>Lista de Precios de Proveedores</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>


                    <div class="s-item">
                        <br></br>
                        <a style="color:#2E9AFE">
                            <div class="title"><span> ACCIONES</span></div>
                        </a>
                    </div>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 65, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="oc_mst.php" title="Orden de Compra">
                                        <div class="title"><span>Orden de Compra</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 63, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="rec_oc_mst.php" title="Recepción de Orden de Compra">
                                        <div class="title"><span>Recepción de Orden de Compra</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 63, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="dev_oc.php" title="Devolución de Orden de Compra">
                                        <div class="title"><span>Devolución de Orden de Compra</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 66, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="facp_mst.php" title="Factura del Proveedor">
                                        <div class="title"><span>Factura del Proveedor</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 67, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="pap_mst.php" title="Pago a Provedores">
                                        <div class="title"><span>Pago a Provedores</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>



                    <div class="s-item">
                        <br></br>
                        <a style="color:#2E9AFE">
                            <div class="title"><span> REPORTES</span></div>
                        </a>
                    </div>

                    <?php
                    //FALTA AGREGAR EL FORMULARIO A PROL_MST
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 36, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="oc_mst_rp.php" title="Orden de Compra">
                                        <div class="title"><span>Orden de Compra</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php

                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 25, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="rec_oc_mst_rp.php" title="Recepción de Orden de Compra">
                                        <div class="title"><span>Recepción de Orden de Compra</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php

                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 25, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="cxa.php" title="Compras por Articulo">
                                        <div class="title"><span>Compras por Articulo</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php

                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 25, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="cxprv.php" title="Compras por Proveedor">
                                        <div class="title"><span>Compras por Proveedor</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php

                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 25, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="cpnd.php" title="Compras Pendientes/Recibidas">
                                        <div class="title"><span>Compras Pendientes/Recibidas</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                </div>
            </div> <!-- FIN MODULO COMPRAS-->
            <?php
            #}
            ?>





            <!-- INICIO MODULO ventas-->

            <?php
            #if ($_SESSION['rus_rol_id'] == 0 || $_SESSION['rus_rol_id'] == 1 || $_SESSION['rus_rol_id'] == 2 || $_SESSION['rus_rol_id'] == 3 || $_SESSION['rus_rol_id'] == 4 || $_SESSION['rus_rol_id'] == 5) {
            ?>
            <div class="menu-item" id="item4" title="Ventas" onclick="colapsar_btn('item4')">
                <div class="icono"><i class="fa fa-exchange"></i></div>
                <div class="titulo"><span> VENTAS</span></div>
                <div class="menu-sitem-collapse" id="sitem4">

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 20, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {
                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="presa_mst.php" title="Presupuestos Anuales">
                                        <div class="title"><span>Presupuestos Anuales</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 21, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {
                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="presh_mst.php" title="Presupuestos Mensuales">
                                        <div class="title"><span>Presupuestos Mensuales</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 23, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="ven_mst_insert.php" title="Vendedores">
                                        <div class="title"><span>Vendedores</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 24, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="cus_mst.php" title="Clientes">
                                        <div class="title"><span>Clientes</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 27, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="ship_mst.php" title="Direccion de Envio a Clientes">
                                        <div class="title"><span>Direccion de Envio a Clientes</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 25, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {
                    ?>

                            <div class="s-item">
                                <li>
                                    <a href="lprec_mst.php" title="Lista de Precios a Clientes(Hospitales)">
                                        <div class="title"><span>Lista de Precios a Clientes</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>


                    <div class="s-item">
                        <br></br>
                        <a style="color:#2E9AFE">
                            <div class="title"><span> ACCIONES</span></div>
                        </a>
                    </div>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 32, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="cot_mst.php" title="Cotización a Clientes">
                                        <div class="title"><span>Cotización a Clientes</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 33, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="ov_mst.php" title=" Orden de Venta">
                                        <div class="title"><span>Orden de Venta</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 34, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="em_ov_mst.php" title="Embarque de Orden de Ventas">
                                        <div class="title"><span>Embarque de Orden de Venta</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 35, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="fac_mst.php" title="Remision a Clientes">
                                        <div class="title"><span>Remision a Clientes</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 36, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="pac_mst.php" title="Pagos de Clientes">
                                        <div class="title"><span>Pagos de Clientes</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <div class="s-item">
                        <br></br>
                        <a style="color:#2E9AFE">
                            <div class="title"><span> REPORTES</span></div>
                        </a>
                    </div>

                    <?php
                    //FALTA AGREGAR EL FORMULARIO A PROL_MST
                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 36, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <a href="ov_report.php" title="Orden de Ventas">
                                        <div class="title"><span>Órden de Ventas</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php

                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 25, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>
                                    <!--a href="reportes/ventas/r_fac/index.php" title="Remision"-->
                                    <a href="pedidosall.php" title="Pedidos">
                                        <div class="title"><span>Pedidos</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php

                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 25, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>

                                    <a href="vxa.php" title="Ventas por Articulo">
                                        <div class="title"><span>Ventas por Articulo</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php

                    $result_access = $usu_mst->access_form($emp_id, $usu_id, 25, $route);
                    while ($access = $result_access->fetch_assoc()) {
                        if ($access['prol_lec'] == '1') {

                    ?>
                            <div class="s-item">
                                <li>

                                    <a href="vxc.php" title="Ventas por Cliente">
                                        <div class="title"><span>Ventas por Cliente</span></div>
                                    </a>
                                </li>
                            </div>
                    <?php
                        }
                    }
                    ?>




                </div>
            </div> <!-- FIN MODULO VENTAS-->
            <?php
            #}
            ?>

            <div class="item-separator"></div>

            <!--div class="menu-item" id="item5" onclick="colapsar_btn('item5')">
                <div class="icono"><i class="fa fa-suitcase"></i></div>
                <div class="titulo"><span>otros </span></div>
                <div class="menu-sitem-collapse" id="sitem5">
                    <div class="s-item">
                        <a href="#">
                            <div class="icon"><i class="fa fa-shopping-cart"></i></div>
                            <div class="title"><span>Pedidos</span></div>
                        </a>
                    </div>
                    <div class="s-item">
                        <a href="#">
                            <div class="icon"><i class="fa fa-shopping-cart"></i></div>
                            <div class="title"><span>Busqueda</span></div>
                        </a>
                    </div>
                </div>
            </div-->
        </div>
    </div>

    <script src="bootstrap/js/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cross-btn').hide()
            $('#cross').hover(function() {
                $('#cross-btn').show()
                $('#cross').hide()
            }, function() {
                $('#cross-btn').hide()
                $('#cross').show()
            })

        })

        function colapsar_btn(id) {
            let id_sitem = "#s" + id;
            //console.log(id_sitem)
            let item = document.querySelector(id_sitem)
            item.classList.toggle('menu-sitem')
            item.classList.toggle('menu-sitem-collapse')
        }

        function colapsar_menu() {
            let menu = document.querySelector('#sidemenu')
            menu.classList.toggle('menu-expanded')
            menu.classList.toggle('menu-collapsed')
            document.querySelector('body').classList.toggle('body-expanded')
        }

        function notificacion(tipo, mensaje) {
            console.log(mensaje)
            let objeto = document.querySelector("#noti")
            let clase = "noti-" + tipo
            objeto.classList.toggle(clase)
            objeto.classList.toggle("noti-hidden")
            $('#noti').text(mensaje)
        }
    </script>
</body>

</html>