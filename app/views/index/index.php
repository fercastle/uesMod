
<?php require_once('../app/views/inc/header.php'); ?>

	
    <!-- Lo que aparece en la pagina principal va aqui -->
    <h1>Unidad Comunitaria de Salud Familiar</h1>
    <table>
	    <thead>
			<tr>
				<!-- colspan="Numero de columnas que tendra la tabla" -->
      			<th colspan="5"><?php echo $parameters['lista']?></th>
   	 		</tr>
			<tr>
				<!-- Se debe ajustar el ancho de las tablas -->
				<th width="10">Manipulador</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Edad</th>
				<th>Opciones-Editar-Eliminar</th>
				
			</tr>
		</thead>
		<tbody>
			<tr>
				<td data-label="id Estudiante">1</td>
				<td data-label="nombre Estudiante">juan</td>
				<td data-label="Apellido Estudiante">buriticá</td>
				<td data-label="edad Estudiante">21</td>
				<td data-label="Opciones">
					<a onclick="toggle()" href="#"><i class="fas fa-edit edit"></i></a>
        			<a href="#"><i class="fas fa-trash-alt delete"></i></a>
				</td>
			</tr>
			<tr>
				<td data-label="id Estudiante">2</td>
				<td data-label="nombre Estudiante">jose</td>
				<td data-label="Apellido Estudiante">castaño</td>
				<td data-label="edad Estudiante">18</td>
				<td data-label="Opciones">
					<a href="#"><i class="fas fa-edit edit"></i></a>
        			<a href="#"><i class="fas fa-trash-alt delete"></i></a>
				</td>
			</tr>	    	
			<tr>
				<td data-label="id Estudiante">3</td>
				<td data-label="nombre Estudiante">fernado</td>
				<td data-label="Apellido Estudiante">lopez</td>
				<td data-label="edad Estudiante">16</td>
				<td data-label="Opciones">
					<a href="#"><i class="fas fa-edit edit"></i></a>
        			<a href="#"><i class="fas fa-trash-alt delete"></i></a>
				</td>
			</tr>
			<tr>
				<td data-label="id Estudiante">1</td>
				<td data-label="nombre Estudiante">juan</td>
				<td data-label="Apellido Estudiante">buriticá</td>
				<td data-label="edad Estudiante">21</td>
				<td data-label="Opciones">
					<a href="#"><i class="fas fa-edit edit"></i></a>
        			<a href="#"><i class="fas fa-trash-alt delete"></i></a>
				</td>
			</tr>
			<tr>
				<td data-label="id Estudiante">2</td>
				<td data-label="nombre Estudiante">jose</td>
				<td data-label="Apellido Estudiante">castaño</td>
				<td data-label="edad Estudiante">18</td>
				<td data-label="Opciones">
					<a href="#"><i class="fas fa-edit edit"></i></a>
        			<a href="#"><i class="fas fa-trash-alt delete"></i></a>
				</td>
			</tr>	    	
			<tr>
	    		<td data-label="id Estudiante">3</td>
	    		<td data-label="nombre Estudiante">fernado</td>
				<td data-label="Apellido Estudiante">lopez</td>
				<td data-label="edad Estudiante">16</td>
				<td data-label="Opciones">
					<a href="#"><i class="fas fa-edit edit"></i></a>
        			<a href="#"><i class="fas fa-trash-alt delete"></i></a>
				</td>
			</tr>
	    </tbody>
	</table>
	<!-- Paginacion -->
	<section class="paginacion">

		<ul>
			<li class="disabled">&laquo;</li>
			<li class="Active"><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">5</a></li>
			<li><a href="#">6</a></li>
			<li><a href="#">7</a></li>
			<li><a href="#">8</a></li>
			<li><a href="#">9</a></li>
			<li><a href="#">10</a></li>
			<li><a href="#">11</a></li>
			<li><a href="#">12</a></li>
			<li><a href="#">14</a></li>
			<li><a href="#">14</a></li>
			<li><a href="#">15</a></li>
			<li><a href="#">16</a></li>
			<li><a href="#">17</a></li>
			<li><a href="#">18</a></li>
			<li><a href="#">19</a></li>
			<li><a href="#">20</a></li>
			<li><a href="#">21</a></li>
			<li><a href="#">22</a></li>
			<li><a href="#">23</a></li>
			<li><a href="#">24</a></li>
			<li><a href="#">25</a></li>
			<li><a href="#">26</a></li>
			<li><a href="#">27</a></li>
			<li><a href="#">28</a></li>
			<li><a href="#">29</a></li>
			<li><a href="#">30</a></li>
			<li><a href="#">31</a></li>
			<li><a href="#">32</a></li>
			<li><a href="#">33</a></li>
			<li><a href="#">34</a></li>
			<li><a href="#">35</a></li>
			<li><a href="#">36</a></li>
			<li><a href="#">37</a></li>
			<li><a href="#">38</a></li>
			<li><a href="#">39</a></li>
			<li><a href="#">40</a></li>
			<li><a href="#">41</a></li>
			<li><a href="#">42</a></li>
			<li><a href="#">43</a></li>
			<li><a href="#">44</a></li>
			<li><a href="#">45</a></li>
			<li><a href="#">46</a></li>
			<li><a href="#">47</a></li>
			<li><a href="#">48</a></li>
			<li><a href="#">49</a></li>
			<li><a href="#">50</a></li>
			<li><a href="#">51</a></li>
			<li><a href="#">52</a></li>
			<li><a href="#">53</a></li>
			<li><a href="#">54</a></li>
			<li><a href="#">55</a></li>
			<li><a href="#">56</a></li>
			<li><a href="#">57</a></li>
			<li><a href="#">58</a></li>
			<li><a href="#">59</a></li>
			<li><a href="#">60</a></li>
			<li><a href="#">61</a></li>
			<li><a href="#">62</a></li>
			<li><a href="#">63</a></li>
			<li><a href="#">64</a></li>
			<li><a href="#">65</a></li>
			<li><a href="#">66</a></li>
			<li><a href="#">67</a></li>
			<li><a href="#">68</a></li>
			<li><a href="#">69</a></li>
			<li><a href="#">70</a></li>
			<li><a href="#">71</a></li>
			<li><a href="#">72</a></li>
			<li><a href="#">73</a></li>
			<li><a href="#">74</a></li>
			<li><a href="#">75</a></li>
			<li><a href="#">76</a></li>
			<li><a href="#">77</a></li>
			<li><a href="#">78</a></li>
			<li><a href="#">79</a></li>
			<li><a href="#">80</a></li>		
			<li><a href="#">81</a></li>
			<li><a href="#">82</a></li>
			<li><a href="#">83</a></li>
			<li><a href="#">84</a></li>
			<li><a href="#">85</a></li>
			<li><a href="#">86</a></li>
			<li><a href="#">87</a></li>
			<li><a href="#">88</a></li>
			<li><a href="#">89</a></li>
			<li><a href="#">90</a></li>
			<li><a href="#">91</a></li>
			<li><a href="#">92</a></li>
			<li><a href="#">93</a></li>
			<li><a href="#">94</a></li>
			<li><a href="#">95</a></li>
			<li><a href="#">96</a></li>
			<li><a href="#">97</a></li>
			<li><a href="#">98</a></li>
			<li><a href="#">99</a></li>
			<li><a href="#">100</a></li>
			
			<a class="fin" href="#">&raquo;</a>
		</ul>

	</section>
<?php require_once('../app/views/inc/footer.php'); ?>

