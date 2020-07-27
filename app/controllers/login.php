<?php

class Login extends MainController
{
	
	public function __construct(){
		session_start();
        if (isset($_SESSION['user'])) {
            header('location:'.ROUTE_URL);
        }
		$this->modeloLogin = $this->model('modeloLogin');
	}

	public function index(){
        $valor1 = '';
        $valor2 = '';
        $usuario = null;
        $pass = null;
		$errores = [
            'usuario' => '',
            'pass' => '',
        ];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $usuario = $_POST['usuario'];
        $pass = $_POST['pass'];

        if ($usuario == '') {

            $valor1 = 'error';
            $errores['usuario'] ='Este campo es requerido';

        }else {

            $valor1 = 'success';

        }

        if ($pass == '') {

            $valor2 = 'error';
            $errores['pass'] ='Este campo es requerido';

        }else {

            $valor2 = 'success';

        }

        if ($usuario != '' && $pass != '') {
            $usuario = ucwords($usuario);
            $pass = sanitize(hash('sha512',  $pass));
            $user = $this->modeloLogin->login($usuario, $pass);
            if ($user) {
      
                $_SESSION['user'] = $user;
                
                    //redireccionamos al index de la pagina
                    header('location:'.ROUTE_URL.'/index');
            }else{

                $valor2 = 'error';
                $errores['pass'] ='Usuario o password incorrectos';
            }
        }

    }
    $parameters = [
        'usuario' => $usuario,
        'pass' => $pass,
        'valor1' => $valor1,
        'valor2' => $valor2,
        'errores' => $errores
    ];
    $this->view('login/index', $parameters);
    }
    
    public function logout(){
        session_destroy();
        header('location:'. ROUTE_URL);        
    }
}

?>