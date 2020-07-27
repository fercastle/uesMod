<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf8">
    <meta lang="es">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $parameters['title']?></title>
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/fontawesome/css/all.css">
    
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/menu.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/tabla.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/paginacion.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/notificacion.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/formularios.css">
    
    
    <!-- <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/formularios.css"> -->

</head>

<body>
    <div class="container" id="blur">
        <div class="contenedor active" id="contenedor">

            <!-- Trabajando con el encabezado del archivo menu -->
            <header class="header">
                <div class="contenedor-logo">
                    <button id="boton-menu" class="boton-menu"><span class="fas fa-bars"></span></button>
                    <a href="#" class="logominsal"><img src="<?php echo ROUTE_URL?>/img/minsal.png" alt="UCSF"></a>
                </div>

                <!-- dibujamos la barra de busqueda si estamos en usuarios -->
                <?php if (isset($parameters['rutaContrBusqueda'])):?>

                    <div class="barra-busqueda">
                        <form action="<?php echo $parameters['rutaContrBusqueda']?>" method="post" accept-charset="utf-8">
                            <input type="text" placeholder="Buscar" name="busqueda"
                                value="<?php echo $var = (isset($parameters['busqueda']))? $parameters['busqueda'] : ''?>">
                            <button type="submit" name="buscar" value="Consultar"><i class="fas fa-search"></i>
                        </form>
                    </div>

              <?php endif?>

                <div class="botones-header">
                <p class="menuCSS3"><a style="color: white; :hover{color : #000;}"href="<?php echo  ROUTE_URL?>/login/logout"><?php print_r($_SESSION['user']->username)?> <i class="fas fa-walking" style="font-size: 170%;"></i></a></p>     
                </div>

            </header>

            <nav class="menu-lateral">
                <a href="<?php echo ROUTE_URL?>/index"
                    class="<?php echo $var = ($parameters['menu'] == 'Inicio')? 'active': ''?>"><i
                        class="fas fa-home"></i>Inicio</a>
                <a href="#"><i class="fas fa-hand-paper"></i>Manipúlador</a>
                <a href="#"><i class="fas fa-warehouse"></i>Establecimiento</a>
                <a href="#"><i class="fas fa-user-secret"></i>Inspección</a>
                <a href="#"><i class="fas fa-clipboard-check"></i>Reporte</a>
                <!-- llamando al controlador -->
                <a href="<?php echo ROUTE_URL?>/usuarios"
                    class="<?php echo $var=($parameters['menu'] == 'usuarios')? 'active': ''?>"><i
                        class="fas fa-users-cog"></i>Usuario</a>

            </nav>

            <main class="main">