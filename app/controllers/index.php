<?php

    // lo primero que se hace siempre es poner le nombre 

    class Index extends MainController{

        function __construct(){
            sessionUser();
            $this->modeloUsuarios = $this->model('modeloUsuarios');
        }

        function index(){

            $parameters = [
                'title'=> 'Pagina de inicio',
                'menu' => 'Inicio',
                'lista'=> 'Lista de Manipuladores'
            ];



            $this->view('index/index', $parameters);
        }
    }
?>