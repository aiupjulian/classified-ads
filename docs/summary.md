# PHP summary

## Functions

By default parameters are passed by value

To pass parameter by reference use &:
`function example(&$variableByReference)``

- To test if variable is defined: isset($variable)
- getdate()
- foreach(expresion_array as $key => $value) sentencia
- `<form action="lo_que_sea.php" method="post/get">`

## Session variables

`session_start ()`

`$_SESSION["nombre _variable"]`

`session_destroy()`

## PHP variables

- `$_GET`: Se usa para recoger los valores de un formulario con method = "get".

- `$_POST`: Se utiliza para recoger los valores de un formulario con method = "post".

## Array

$invierno = array ("Enero", "Febrero", "Marzo");

### Two types of arrays:

- INDEXADA: aquella cuyo acceso a INDEXADA: aquella cuyo acceso a los elementos se realiza por la los elementos se realiza por la posición que ocupan dentro de la estructura (se inician siempre desde l n que ocupan dentro de la estructura (se inician siempre desde la posición 0).

`$invierno = array ("Enero", "Febrero", "Marzo");`

`echo ("Uno de ".$invierno[0].", dos de ".$invierno[1].", tres de ".$invierno[2]."...");`

- ASOCIATIVA: es aquella en la que los elementos est ASOCIATIVA: es aquella en la que los elementos están formados por n formados por partes clave partes clave-valor y el acceso se realiza proporcionando una valor y el acceso se realiza proporcionando una determinada clave.

`$ficha = array(nombre=>"Gonso", direccion=>"Alamillos", telefono=>"10494676", edad=>"24“);`

### Multidimensional:

`$agenda = array(
array( nombre=>"Gonso",
direccion=>"Alamillos",
telefono=>"10494676",
edad=>"24"),
array( nombre=>"Peggy",
direccion=>"Don Sancho",
telefono=>"10494665",
edad=>"22"),
array( nombre=>"Cremy",
direccion=>"Don Sancho",
telefono=>"1214665",
edad=>"25")
);`

`echo $agenda[1][telefono];`

## MySQL

- connect

`$nombreConexion = mysqli_connect($hostname, $nombreUsuario, $contraseña, $dbname);`

- query

`$result = mysqli_query($nombreConexion, "Consulta aquí");`

- close

`mysqli_close($nombreConexión);`

- array of results

`mysqli_data_seek ($result, numeroDeFila);`

`$extraido = mysqli_fetch_array($result);`

OR

`mysqli_fetch_assoc($result)`

- numbers of rows array of results

`mysqli_num_rows($result)`
