(function(){	
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	//VALIDACIONES DEL FORMULARIO REGISTRO DE USUARIOS

	//Acceso al formulario
	const form = document.getElementById('form-usuario');

	//Declarando las variables por medio de id
	const nombre = document.getElementById('nombre');
	const apellido = document.getElementById('apellido');
	//const fechaNacimiento= document.getElementById('fechaNacimiento');
	const dui = document.getElementById('dui');
	const telefono = document.getElementById('telefono');
	const direccion = document.getElementById('direccion');
	const usuario = document.getElementById('usuario');
	const password1 = document.getElementById('password1');
	const password2 = document.getElementById('password2');

	form.addEventListener('submit', e => {

		e.preventDefault();
		validarNombre();
		validarApellido();
		//validarFechaNacimiento();
		validarDui();
		validarTelefono();
		validarDireccion();

		validarUsuario();
		validarPassword1();
		validarPassword2();
		//checkInputs();
	});


	function validarNombre(){
		const nombreValue = nombre.value.trim();

		if(nombreValue == '' || nombreValue == null) 
			setErrorFor(nombre, 'Ingrese un nombre');
		else if(nombreValue.length > 50)
			setErrorFor(nombre, 'Ingrese menos de 50 caracteres');
		else 
			setSuccessFor(nombre);
	} 

	function validarApellido(){
		const apellidoValue = apellido.value.trim();

		if(apellidoValue == '' || apellidoValue == null) 
			setErrorFor(apellido, 'Ingrese un apellido');
		else if(apellidoValue.length > 50)
			setErrorFor(apellido, 'Ingrese menos de 50 caracteres');
		else 
			setSuccessFor(apellido);
	} 

	function validarFechaNacimiento(){
		const fechaNacimientoValue = fechaNacimiento.value.trim();

		if(fechaNacimientoValue == '' || fechaNacimientoValue == null) 
			setErrorFor(fechaNacimiento, 'Ingrese una fecha');
		else 
			setSuccessFor(fechaNacimiento);
	} 

	function validarDui(){
		const duiValue = dui.value.trim();

		if(duiValue == '' || duiValue == null) 
			setErrorFor(dui, 'Ingrese un dui valido');
		else if(duiValue.length > 10)
			setErrorFor(dui, 'Ingrese menos de 10 caracteres');
		else 
			setSuccessFor(dui);
	} 

	function validarTelefono(){
		const telefonoValue = telefono.value.trim();

		if(telefonoValue == '' || telefonoValue == null) 
			setErrorFor(telefono, 'Ingrese un telefono');
		else if(telefonoValue.length > 10)
			setErrorFor(telefono, 'Ingrese menos de 10 caracteres');
		else 
			setSuccessFor(telefono);
	} 

	function validarDireccion(){
		const direccionValue = direccion.value.trim();

		if(direccionValue == '' || direccionValue == null) 
			setErrorFor(direccion, 'Ingrese una direccion');
		else if(direccionValue.length > 50)
			setErrorFor(direccion, 'Ingrese menos de 50 caracteres');
		else 
			setSuccessFor(direccion);
	} 

	function validarUsuario(){
		const usuarioValue = usuario.value.trim();

		if(usuarioValue == '' || usuarioValue == null) 
			setErrorFor(usuario, 'Ingrese un usuario');
		else if(usuarioValue.length > 50)
			setErrorFor(usuario, 'Ingrese menos de 50 caracteres');
		else 
			setSuccessFor(usuario);
	}

	function validarPassword1(){
		//const password1.value = password1.value.trim();

		if(password1.value == '' || password1.value == null) 
			setErrorFor(password1, 'Ingrese una contraseña');
		/*else if(password1Value != password2Value)
			setErrorFor(password2, 'Las contraseñas no coinciden');
			*/
			else
				setSuccessFor(password1);
		} 

		function validarPassword2(){
		//const password2Value = password2.value.trim();

		if(password2.value == '' || password2.value == null) 
			setErrorFor(password2, 'Ingrese una contraseña');
		else if(password1.value != password2.value)
			setErrorFor(password2, 'Esta contrasña debe coincidir con la primera');

		else
			setSuccessFor(password2);
	} 


	function setErrorFor(input, message) {
		const formControl = input.parentElement;
		const small = formControl.querySelector('small');
		formControl.className = 'form-control error';
		small.innerText = message;
	}


	function setSuccessFor(input) {
		const formControl = input.parentElement;
		formControl.className = 'form-control success';
	}


	//Mascaras de texto usuario
	$(document).ready(function(){
		$('#dui').mask('00000000-0');
	});

	$(document).ready(function(){
		$('#telefono').mask('0000-0000');
	});

}());