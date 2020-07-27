
<?php
    function capitalizar_todo($data_cruda){

        return capitalizar_arreglo($data_cruda, array(), TRUE);
    }

    function capitalizar_arreglo($data_cruda, $campos_capitlizar = array(), $todos = FALSE){

        $data_lista = $data_cruda;

        foreach ($data_cruda as $nombre_campo => $valor_campo) {
            
            //Verifica si existe en el arreglo
            if ( in_array($nombre_campo, array_values($campos_capitlizar)) OR $todos) {
                $data_lista[$nombre_campo] = strtoupper($valor_campo);
            }

        }

        return $data_lista;
    }

    
    function validaText($text){

        return trim(filter_var($text, FILTER_SANITIZE_STRING));
    }

    function validaId($numero, $campo){
        
        $error = FALSE;
        $valor[$campo] = $numero;
        
        if ($numero == '' || NULL) {

            $error = TRUE;
            $mensajeError['r'.$campo] = ucwords($campo). ' es requerido';
            
        }elseif (!is_numeric($numero)) {
            
                $error = TRUE;
                $mensajeError['r'.$campo] = ucwords($campo) .' No es valido';
    

        }
        
        
        if(!$error){
            $mensajeError['r'.$campo] = '';
            $valor[$campo] = (int)validaText($numero);
            http_response_code(200);
        }
        else {
            
            http_response_code(404);            
            

        }



        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo], 'error' => $error];
    }
    
    function validaNumero($numero, $campo, $min = 18, $max = 75){
        
        $error = FALSE;
        $valor[$campo] = $numero;
        
        if ($numero == '' || NULL) {

            $error = TRUE;
            $mensajeError['r'.$campo] = 'Este campo es requerido';
            
        }elseif (is_numeric($numero)) {
            
            
            if($numero < $min){
    
                $error = TRUE;
                $mensajeError['r'.$campo] = 'Se necesita mínimo '.(string)$min;
    
            }else if($numero > $max){
    
                $error = TRUE;
                $mensajeError['r'.$campo] = 'No debe exceder los '.(string)$max;
    
            }
        }else{
            $error = TRUE;
            $mensajeError['r'.$campo] = 'Este campo debe ser un numero';
        }
        
        
        if(!$error){
            $mensajeError['r'.$campo] = '';
            $valor[$campo] = (int)validaText($numero);
            http_response_code(200);
        }
        else {
            
            http_response_code(404);            
            

        }



        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo], 'error' => $error];
    }

    function validaCorreo($correo, $campo){
        
        $error = FALSE;
        
        $valor[$campo] = $correo;
        
        if ($correo == '' || NULL) {

            $error = TRUE;
            $mensajeError['r'.$campo] = 'El '. $campo. ' es requerido';
            
        }else if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){

            $error = TRUE;
            $mensajeError['r'.$campo] = 'Formato de '. $campo .' no es correcto';

        }
        
        if(!$error){
         
            $mensajeError['r'.$campo] = '';
            $valor[$campo] = validaText($correo);
            http_response_code(200);
        }else{
            http_response_code(404);
            
        }



        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo], 'error' => $error];
    }

    function validaNombre($text, $min = 3, $max = 50){
        
        //quita los caracteres especiales del texto
        $text = preg_replace('([^A-Za-z ])', '', $text);
        $error = FALSE;

        $mensajeError = '';
        
        if ($text == '' || NULL) {
            
            $error = 'error';
            $mensajeError = 'Este campo es requerido';
            
        }else if(strlen($text) < $min){

            $error = 'error';
            $mensajeError = 'Se necesita mínimo '.(string)$min.' caracteres';

        }else if(strlen($text) > $max){

            $error = 'error';
            $mensajeError = 'No debe exceder los '.(string)$max.' caracteres';

        }else if(is_numeric($text)){
            $error = 'error';
            $mensajeError = 'No se admiten números en este campo';
        }
        
        
        if($error == FALSE &&  $mensajeError == ''){
            $error = 'success';
            $text = validaText($text);
            
        }
        //se envia campo del formulario, mensaje de error y error (True - False)
        return ['form-control' => $error, 'text' => $text, 'small' => $mensajeError];

    }

    function validaStr($text, $min = 3, $max = 50, $model = null){
            
        
        $mensajeError = "";
        $error =  FALSE;

        if ($model != null && $model > 0) {

            $error = 'error';
            $mensajeError = 'El usuario ya existe';

        }else if ($text == '' || NULL) {

            $error = 'error';
            $mensajeError = 'Este campo es requerido';
            
        }else if(strlen($text) < $min){

            $error = 'error';
            $mensajeError = 'Se necesita mínimo '.(string)$min.' caracteres';

        }else if(strlen($text) > $max){

            $error = 'error';
            $mensajeError = 'No debe exceder los '.(string)$max.' caracteres';

        }else if(is_numeric($text)){
            $error = 'error';
            $mensajeError = 'No se admiten números en este campo';
        }
        

        if($error == FALSE && $mensajeError == ''){
            
            $error = 'success';
            $text = validaText(ucwords(strtolower($text)));
            
        }

        return ['form-control' => $error, 'text' => $text, 'small' => $mensajeError];

    }

    function validafecha($fecha){

        
        $mensajeError = '';
        $error = FALSE;

        if($fecha == '' || NULL){

            $error = 'error';
            $mensajeError = 'Este campo es requerido';

        }

        if($error == FALSE && $mensajeError == ''){
            $error = 'success';
            $fecha = validaText($fecha);
            
        }

        return ['form-control' => $error, 'text' => $fecha, 'small' => $mensajeError];
       
    }
    
    function validatelefono($telefono){

        $mensajeError = "";
        $error = FALSE;

        if($telefono == '' || NULL){

            $error = 'error';
            $mensajeError = 'Este campo es requerido';
            
        }else if (!preg_match('/^([0-9]{4}\-[0-9]{4})$/', $telefono)){

            $error = 'error';
            $mensajeError = 'El formato de debe ser 7777-7777';

        } 
        
        if($error == FALSE && $mensajeError == ''){
            
            $error = 'success';
            $telefono = validaText($telefono);
            
        }

        return ['form-control' => $error, 'text' => $telefono, 'small' => $mensajeError];
       
    }

    function validaDui($dui, $model = null){

        $mensajeError = "";
        $error = FALSE;
        if ($model != null && $model > 0) {

            $error = 'error';
            $mensajeError = 'El DUI ya existe';

        }
        if($dui == '' || NULL){
            $error = 'error';
            $mensajeError = 'Este campo es requerido';
        }else if (!preg_match('/^([0-9]{8}\-[0-9]{1})$/', validaText($dui))){

            $error = 'error';
            $mensajeError = 'El formato debe ser 12345678-0';
            
        } 
        
        if($error == FALSE && $mensajeError == ''){
            
            $error = 'success';
            $dui = validaText($dui);
            
        }

        return ['form-control' => $error, 'text' => $dui, 'small' => $mensajeError];
       
    }

    function validaPassword($pass = null, $pass2 = null){

        
        $mensajeError = "";
        $error = FALSE;
        
        if ($pass == '' || $pass == null) {
            $error = 'error';
            $mensajeError = 'Este campo es requerido';
        }

        elseif ($pass2 == '' || $pass2 == null) {
            $error = 'error';
            $mensajeError = 'Repita contraseña';
        }

        elseif ($pass != $pass2) {
            $error = 'error';
            $mensajeError = 'Las Contraseñas no coinciden';
        }

        
        if($error == FALSE && $mensajeError == ""){

            $error = 'success';
            
        }

        return ['form-control' => $error, 'text' => $pass, 'small' => $mensajeError];

    }
?>