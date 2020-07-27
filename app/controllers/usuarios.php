<?php

class Usuarios extends MainController
{

	public $error; 
	
	function __construct()
	{
		$this->error = FALSE;
		// para probar ponemos sesionStart aca
		sessionAdmin();
		// ModeloUsuarios es donde estan todas las consultas cpn la base de datos
		 $this->ModeloUsuarios = $this->model('ModeloUsuarios');
	}

	public function verUsuario($id, $estado){

		$usuario = $this->ModeloUsuarios->obtenerUsuario1($id, $estado);	
		
		
		$parameters = [

			'error' => FALSE,
			'mensaje' => 'No se admite editar usuario',		
			'menu' => 'usuarios',
			'usuario' => $usuario
		];
		$this->view('usuarios/ver_usuario', $parameters);
	}
	public function actualizarUsuario($id = 0){
			
		//comprobando si el usuario existe a traves del id
		if (!$this->ModeloUsuarios->obtenerUsuario($id, '1')) {
			$errores['pass']['pass'] = '';

			$parameters = [

				'error' => TRUE,
				'mensaje' => 'Este registro ya no existe',
				'errores' => [],
				'menu' => 'usuarios',
	
			];
						
			$this->view('usuarios/actualizar_usuario', $parameters);
		}

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
			// ----------------- guardando los datos enviados por el formulario como propiedades --------------------
			$data = $this->ModeloUsuarios->set_datos($_POST);
			
			// ------------------- Validando los campos del formulario ----------------------------
			$errores['nombre'] = validaNombre($data->nombreusuario);
			$this->error = ($errores['nombre']['form-control'] == 'error')? TRUE : $this->error;
		
			$errores['apellido'] = validaNombre($data->apellidousuario);
			$this->error = ($errores['apellido']['form-control'] == 'error')? TRUE : $this->error;

			$errores['fechaNacimiento'] = validafecha($data->fechanacimientousuario);
			$this->error = ($errores['fechaNacimiento']['form-control'] == 'error')? TRUE :$this->error;
			
			if ($_POST['duiusuario1'] != $_POST['duiusuario']) {

				$errores['dui1']['text'] = $_POST['duiusuario1'];
				$errores['dui'] = validaDui($data->duiusuario, $this->ModeloUsuarios->busquedaDui($data->duiusuario));
				$this->error = ($errores['dui']['form-control'] == 'error')? TRUE :$this->error;
			
			}else{

				$errores['dui1']['text'] = $_POST['duiusuario1'];
				$errores['dui']['form-control'] = 'success';
				$errores['dui']['text'] = $data->duiusuario;
				
			}


			$errores['telefono'] = validatelefono($data->telefonousuario);
			$this->error = ($errores['telefono']['form-control'] == 'error')? TRUE :$this->error;

			$errores['direccion'] = validaStr($data->direccionusuario, 5, 100);
			$this->error = ($errores['direccion']['form-control'] == 'error')? TRUE :$this->error;

			if ($_POST['username1'] != ucwords($_POST['username'])) {
				
				$errores['usuario1']['text'] = $_POST['username1'];
				$errores['usuario'] = validaStr($data->username, 5, 15,  $this->ModeloUsuarios->busquedausuario(ucwords($data->username)));				
				$this->error = ($errores['usuario']['form-control'] == 'error')? TRUE :$this->error;

			}else{
				
				$errores['usuario1']['text'] = $_POST['username1'];
				$errores['usuario']['form-control'] = 'success';
				$errores['usuario']['text'] = $data->username;

			}
			
			$errores['pass'] = validaPassword($data->password, $_POST['password2']);
			$this->error = ($errores['pass']['form-control'] == 'error')? TRUE :$this->error;
		
			$errores['sexo'] = $data->sexousuario;
			$errores['tipo'] = $data->idtipousuario;
			$errores['fecharegistro'] = $data->fecharegistro;

			if ($this->error == TRUE) {

				$parameters = [

					'error' => $this->error,
					'mensaje' => 'Revise los campos de entrada',
					'errores' => $errores,
					'menu' => 'usuarios',
					'usuario' => $id,
				];


				$this->view('usuarios/actualizar_usuario', $parameters);

			}else{

				$errores['pass']['text'] = hash('sha512', $errores['pass']['text']);
				if ($this->ModeloUsuarios->actualizarUsuario($id, $errores, $_SESSION['user']->username)) {

					$errores['pass']['text'] = '';

					$parameters = [

						'error' => FALSE,
						'mensaje' => 'Se actualizo el registro correctamente',
						'menu' => 'usuarios',
						'errores' => $errores,
						'menu' => 'usuarios',
	
					];
					$this->view('usuarios/actualizar_usuario', $parameters);

				}else{

					echo 'No se puedo actualizar el registro';
					die();

				}
			}

		}else{
		
				$user = $this->ModeloUsuarios->obtenerUsuario($id, '1');
		
				$errores['nombre']['text'] = $user->nombreusuario;
				
				$errores['apellido']['text'] = $user->apellidousuario;
				
				$errores['fechaNacimiento']['text'] = $user->fechanacimientousuario;
				
				$errores['dui']['text'] = $user->duiusuario;
				$errores['dui1']['text'] = $user->duiusuario;

				$errores['telefono']['text'] = $user->telefonousuario;
				
				$errores['direccion']['text'] = $user->direccionusuario;
				
				$errores['usuario']['text'] = $user->username;
				$errores['usuario1']['text'] = $user->username;
				
				$errores['pass']['text'] = '';
				
				$errores['fecharegistro'] = $user->fecharegistro;
				$errores['sexo'] = $user->sexousuario;
				$errores['tipo'] = $user->idtipousuario;

		$parameters = [

			'error' => 2,
			'mensaje' => 'Edite los campos de entrada',
			'errores' => $errores,
			'menu' => 'usuarios',
			'usuario' => $id,
		];
		
		
		$this->view('usuarios/actualizar_usuario', $parameters);
		}
	}

	// ----------------- Crear nuevo usuario--------------------
	public function nuevoUsuario(){

		// ----------------- Recibiendo datos del formulario --------------------
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			// ----------------- guardando los datos enviados por el formulario como propiedades --------------------
			$data = $this->ModeloUsuarios->set_datos($_POST);
			
			// ------------------- Validando los campos del formulario ----------------------------
				$errores['nombre'] = validaNombre($data->nombreusuario);
				$this->error = ($errores['nombre']['form-control'] == 'error')? TRUE : $this->error;
				// print_r($errores['nombre']);
				// die();
				$errores['apellido'] = validaNombre($data->apellidousuario);
				$this->error = ($errores['apellido']['form-control'] == 'error')? TRUE : $this->error;

				$errores['fechaNacimiento'] = validafecha($data->fechanacimientousuario);
				$this->error = ($errores['fechaNacimiento']['form-control'] == 'error')? TRUE :$this->error;
			
				$errores['dui'] = validaDui($data->duiusuario, $this->ModeloUsuarios->busquedaDui($data->duiusuario));
				$this->error = ($errores['dui']['form-control'] == 'error')? TRUE :$this->error;


				$errores['telefono'] = validatelefono($data->telefonousuario);
				$this->error = ($errores['telefono']['form-control'] == 'error')? TRUE :$this->error;

				$errores['direccion'] = validaStr($data->direccionusuario, 5, 100);
				$this->error = ($errores['direccion']['form-control'] == 'error')? TRUE :$this->error;

				$errores['usuario'] = validaStr($data->username, 5, 15,  $this->ModeloUsuarios->busquedausuario(ucwords($data->username)));				
				$this->error = ($errores['usuario']['form-control'] == 'error')? TRUE :$this->error;
			
				$errores['pass'] = validaPassword($data->password, $_POST['password2']);
				$this->error = ($errores['pass']['form-control'] == 'error')? TRUE :$this->error;
		
				$errores['sexo'] = $data->sexousuario;
				$errores['tipo'] = $data->idtipousuario;
				
				if ($this->error == TRUE) {

					$parameters = [

						'error' => $this->error,
						'mensaje' => 'Revise los campos de entrada',
						'errores' => $errores,
						'menu' => 'usuarios',

					];

					$this->view('usuarios/nuevo_usuario', $parameters);

				}else{
					$errores['pass']['text'] = hash('sha512', $errores['pass']['text']);
			
					if ($this->ModeloUsuarios->nuevoUsuario($errores, $_SESSION['user']->username)) {

						$parameters = [

							'error' => FALSE,
							'mensaje' => 'Se guardo el registro con exito',
							'menu' => 'usuarios',
							'errores' => [],
						];
						$this->view('usuarios/nuevo_usuario', $parameters);

					}else{
						echo 'No se puedo guardar el registro';
						die();
					}
				}

		}
					
		$parameters = [
			'error' => $this->error,
			'mensaje' => 'Complete los campos para realizar el registro.',
			'menu' => 'usuarios',
			'title' => 'Nuevo Usuario',
			'menu' => 'usuarios',
			'errores' => [],
		];
		
		$this->view('usuarios/nuevo_usuario', $parameters);

	}
	public function usuarios(){
		
		if (isset($_GET['eliminar'])) {
			
			echo $_GET['Eliminar'];
		}
		// ruta de este controllador para manejar la busqueda
		$rutaContrBusqueda = ROUTE_URL.'/usuarios';
		$busqueda = null;
		//variable que optiene el id del registro a eliminar
		$idEliminar = null;
		$usuario = null;
		$realizado = false;
							
		//Para eliminar un registro
		if(isset($_GET['eliminar']) and $_GET['eliminar'] != 0){
			$idEliminar = $_GET['eliminar'];
			$usuario = $this->ModeloUsuarios->obtenerUsuario($idEliminar);
			if (!$usuario) {
				header("location:".ROUTE_URL."usuarios/index");
			}
		}elseif (isset($_GET['id']) and $_GET['id'] != 0) {
			
			$this->ModeloUsuarios->desactivar($_GET['id']);
			$realizado = true;
		}

		
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['busqueda']) and $_POST['busqueda'] != '')  {
			
		
			$busqueda = sanitize(strtolower($_POST['busqueda']));

		}
		elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['busqueda']) and $_GET['busqueda'] != '') {

			$busqueda = sanitize(strtolower($_GET['busqueda']));

		}

		$cantElementPorPag = 10;

		$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	
		$inicio = ($pagina > 1) ? $pagina * $cantElementPorPag - $cantElementPorPag : 0;

		if ($busqueda != null) {
			
		// // Verificando si existe algun espacio dentro de la busqueda
			if (strpos($busqueda, ' ') == true) {
				
				$busquedaNombre = explode(' ', $busqueda);
				
		// 		// agregando los %% a cada elemento del arreglo
				for($i = 0; $i < count($busquedaNombre); $i++){
					$busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
				}
		// 		// convirtiendo el arreglo a str
				$busquedaNombre = implode($busquedaNombre);
				
				$totalArticulos = $this->ModeloUsuarios->TotalPaginacionUsuariosBusquedaNombre($busquedaNombre);

				$usuarios = $this->ModeloUsuarios->obtnerUsuariosBusquedaNombre($busquedaNombre, $inicio, $cantElementPorPag);
		
			}
			else {
				
				$totalArticulos = $this->ModeloUsuarios->TotalPaginacionUsuariosBusqueda($busqueda);

				$usuarios = $this->ModeloUsuarios->obtnerUsuariosBusqueda($busqueda, $inicio, $cantElementPorPag);

		}
		}
		else{

			//obteniendo rango de registro por pagina son los registros
			$usuarios = $this->ModeloUsuarios->optenerUsuriosPost($inicio, $cantElementPorPag);
			
			//obteniendo el total de registros de la tabla
			$totalArticulos = $this->ModeloUsuarios->TotalPaginacion();
		}

		// obtener formato de edad de 1990-04-19 a 30
		$usuarios = formatoEdad($usuarios);

		// Numero de paginas
		$numeroPaginas = ceil($totalArticulos / $cantElementPorPag);

		//rango final para el id
		$finNumId =  ($pagina + 1) * $cantElementPorPag - $cantElementPorPag;

		//capturando los rangos del id
		$numIds = range($inicio, $finNumId);

		// si no encuentra ningun usuario se va a la pagina principal
			
		if (isset($_GET['id']) and $_GET['id'] != 0) {
			
			if (count($usuarios) == 0) {
			
				$parameters = [
					//numero de paginas para la paginacion
					'numeroPaginas' => $numeroPaginas,
					'numIds' => $numIds,
					'menu' => 'usuarios',
					'title' => 'UCSF',
					'usuario' => $usuario,
					'usuarios' => $usuarios,
					'pagina' => $pagina,
					'busqueda' => $busqueda,
					'rutaContrBusqueda' => $rutaContrBusqueda,
					'totalArticulos' => $totalArticulos,
					'idEliminar' => $idEliminar,
					'realizado' => $realizado
				];
		
				$this->view('usuarios/index', $parameters);
			}
		}
		
	
		$parameters = [
			//numero de paginas para la paginacion
			'numeroPaginas' => $numeroPaginas,
			'numIds' => $numIds,
			'menu' => 'usuarios',
			'title' => 'UCSF',
			'usuario' => $usuario,
			'usuarios' => $usuarios,
			'pagina' => $pagina,
			'busqueda' => $busqueda,
			'rutaContrBusqueda' => $rutaContrBusqueda,
			'totalArticulos' => $totalArticulos,
			'idEliminar' => $idEliminar,
			'realizado' => $realizado
		];

		$this->view('usuarios/index', $parameters);

	
}

	public function usuariosDesactivados($pagina = 1, $id = 0, $idE = 0, $busqueda = null, $pos_pagina = 5){
		
		$rutaContrBusqueda = ROUTE_URL.'/usuarios/usuariosDesactivados';
		$usuario = null;
		$usuarios = null;

		if ($id > 0 && $this->ModeloUsuarios->obtenerUsuario($id)) {
			
			$usuario = $this->ModeloUsuarios->obtenerUsuario($id);	

		}
		if ($idE == 1 && $this->ModeloUsuarios->obtenerUsuario($id)) {
			
			$this->ModeloUsuarios->activar($id);
			$usuario = null;
		}

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$busqueda = ( $_POST['busqueda'] != '') ? sanitize(strtolower($_POST['busqueda'])) : null;

		}elseif ($busqueda != '') {
			$busqueda = str_replace('_', ' ',$busqueda);
			$busqueda = strtolower($busqueda);

		}

		$cuantosRegistros = $this->ModeloUsuarios->numeroRegistros($busqueda, '2');

		$respuesta = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);

		if (!$respuesta['error']) {

			$usuarios = $this->ModeloUsuarios->usuariosPorLimite($pos_pagina, $respuesta['desde'], $busqueda, '2');
			$usuarios = formatoEdad($usuarios);
		}

			$parameters = [

				'respuesta' => $respuesta,
				'usuarios' => $usuarios,
				'usuario' => $usuario,
				'menu' => 'usuarios',
				'rutaContrBusqueda' => $rutaContrBusqueda,
				'busqueda' => $busqueda,

			];


		$this->view('usuarios/usuariosDesactivados', $parameters);
	}

	public function index($pagina = 1, $id = 0, $idE = 0, $busqueda = null, $pos_pagina = 10){


		$rutaContrBusqueda = ROUTE_URL.'/usuarios/index'; 
		$usuario = null;
		$usuarios = null;

		// die();
		if ($id > 0 && $this->ModeloUsuarios->obtenerUsuario($id, '1')) {
			
			$usuario = $this->ModeloUsuarios->obtenerUsuario($id, '1');	

		}
		if ($idE == 1 && $this->ModeloUsuarios->obtenerUsuario($id, '1')) {
			
			$this->ModeloUsuarios->desactivar($id);
			$usuario = null;
		}

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$busqueda = ( $_POST['busqueda'] != '') ? sanitize(strtolower($_POST['busqueda'])) : null;

		}elseif ($busqueda != '') {
			$busqueda = str_replace('_', ' ',$busqueda);
			$busqueda = strtolower($busqueda);

		}

		$cuantosRegistros = $this->ModeloUsuarios->numeroRegistros($busqueda, '1');

		$respuesta = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);

		if (!$respuesta['error']) {

			$usuarios = $this->ModeloUsuarios->usuariosPorLimite($pos_pagina, $respuesta['desde'], $busqueda, '1');
			$usuarios = formatoEdad($usuarios);
		}

			$parameters = [

				'respuesta' => $respuesta,
				'usuarios' => $usuarios,
				'usuario' => $usuario,
				'menu' => 'usuarios',
				'rutaContrBusqueda' => $rutaContrBusqueda,
				'busqueda' => $busqueda,

			];


		$this->view('usuarios/usuarios', $parameters);
		// $rutaContrBusqueda = ROUTE_URL.'/usuarios/index'; 

		// echo "estoy aca"; 
		// // $busqueda = null;

		// if ( $_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['busqueda'] != '' ) { 

		// 	$busqueda = sanitize(strtolower($_POST['busqueda']));	
			
		// }elseif($busqueda != null){

		// 	$busqueda = sanitize(strtolower($busqueda));
			
		// }else{

		// 	//obteniendo el numero total de registros
		// 	$cuantosRegistros = $this->ModeloUsuarios->numeroRegistros();

		// }

		// if ($busqueda != null) {

		// 	$cuantosRegistros = $this->ModeloUsuarios->numeroRegistrosBusqueda($busqueda);
		// 	$respuesta  = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);

			
		// 	if ($cuantosRegistros == 0) {
		// 		$error = [];
		// 		$error['error'] = TRUE;
		// 		$parameters = [
		// 			'rutaContrBusqueda' => $rutaContrBusqueda,
		// 			'respuesta' => $respuesta,
		// 			'busqueda' => $busqueda,	
		// 		];

		// 		$this->view('usuarios/usuarios', $parameters);
		// 	}

			
		// }
		// // echo 'Pagina: '.$pagina;
		// // echo ' cuantos Registros: '. $cuantosRegistros;
		// // echo ' Pos Pagina: '. $pos_pagina;
		// //devuelve 
		// /* 
		// 	-"total_paginas"
		// 	-"pagina_actual"
        // 	-"pagina_siguiente"
        // 	-"pagina_anterior"
        // 	-"desde" ====> que seria el limite de registro o hasta donde trae los registros
		// */

		// $respuesta  = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);

		
		
		// if ($cuantosRegistros > 0 and $busqueda != null) {
			
		// 	$usuarios = $this->ModeloUsuarios->usuariosPorLimiteBusqueda($pos_pagina, $respuesta['desde'], $busqueda);
					
		// }else{
			
		// 	//traemos los registros para esta pagina
		// 	$usuarios = $this->ModeloUsuarios->usuariosPorLimite($pos_pagina, $respuesta['desde']);

		// }
		
		
		// //eliminando un campo de la respuesta
		// // unset($respuesta['desde']);
		// $parameters = [
		// 	'respuesta' => $respuesta,
		// 	'usuarios' => $usuarios,
		// 	'menu' => 'usuarios',
		// 	'rutaContrBusqueda' => $rutaContrBusqueda,
		// 	'busqueda' => $busqueda,
		// ];

		
		// $this->view('usuarios/usuarios', $parameters);
	}
	
	public function desactivandoUsuario($pagina = 1, $id = null, $idE = null , $busqueda = '', $pos_pagina = 5){
		$rutaContrBusqueda = ROUTE_URL.'/usuarios';
		$busqueda = str_replace('_', ' ',$busqueda);
		
		// echo 'Desactivando Usuarios: '. $busqueda;
		// die();
		if ($id != null) {
			
			$idEliminar = $id;
			
			$usuario = $this->ModeloUsuarios->obtenerUsuario($idEliminar);
			
			// print_r($usuario);
			// die();
			if (!$usuario) {

				
				$cuantosRegistros = $this->ModeloUsuarios->numeroRegistros();
				$usuarios = $this->ModeloUsuarios->usuariosPorLimite($pos_pagina, $respuesta['desde']);
				$respuesta  = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);
				$parameters = [

					'respuesta' => $respuesta,
					'usuarios' => $usuarios,
					'menu' => 'usuarios',

				];
				$this->view('usuarios/usuarios', $parameters);
			}
			
		}

		if ($idE != 'borrar') {
			
			$usuario = null;
			$idEliminar = null;
			$this->ModeloUsuarios->desactivar($id);
			
		}
		// $busqueda = null;
		
		
		// echo 'sin nada';
		//obteniendo el numero total de registros
		
		
		
		if ($busqueda != '' ) {
			
			// echo $busqueda;
			// echo $busqueda;
			// die();
			
			$cuantosRegistros = $this->ModeloUsuarios->numeroRegistrosBusqueda($busqueda);
			
			
			// if ($cuantosRegistros == 0) {
				// 	header('location:usuarios/usuarios');
				// }
				// echo $cuantosRegistros;
				// echo 'Cuantos Registros: ' . $cuantosRegistros;
				// die();
			
		}else{
			
			$cuantosRegistros = $this->ModeloUsuarios->numeroRegistros();
		}
		// echo 'Pagina: '.$pagina;
		// echo ' cuantos Registros: '. $cuantosRegistros;
		// echo ' Pos Pagina: '. $pos_pagina;
		//devuelve 
		/* 
			-"total_paginas"
			-"pagina_actual"
        	-"pagina_siguiente"
        	-"pagina_anterior"
        	-"desde" ====> que seria el limite de registro o hasta donde trae los registros
		*/

		$respuesta  = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);

		// print_r($respuesta);
		// die();
		if ($cuantosRegistros == 0) {
			
			$usuarios = null;

		}elseif ($cuantosRegistros > 0 and $busqueda != '') {
			// echo 'busqueda limite';
			$usuarios = $this->ModeloUsuarios->usuariosPorLimiteBusqueda($pos_pagina, $respuesta['desde'], $busqueda);
			
			// print_r($usuarios);
			// die();
		}else{
			
			// echo 'Solo limite';
			//traemos los registros para esta pagina
			$usuarios = $this->ModeloUsuarios->usuariosPorLimite($pos_pagina, $respuesta['desde']);

		}
		
		
		//eliminando un campo de la respuesta
		// unset($respuesta['desde']);
		$parameters = [
			'respuesta' => $respuesta,
			'usuarios' => $usuarios,
			'menu' => 'usuarios',
			'rutaContrBusqueda' => $rutaContrBusqueda,
			'busqueda' => $busqueda,
			'usuario' => $usuario,
			'idEliminar' => $idEliminar,
		];

		
		$this->view('usuarios/usuarios', $parameters);
	}


}


?>