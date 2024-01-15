<?php
// Conexión a la base de datos
$servidor="localhost";
    $usuario="root";
    $contraseña="";
    $basededatos="jaime";

    // Conexión a la base de datos (ajusta los datos de conexión)
    $mysqli = new mysqli($servidor, $usuario,  $contraseña,  $basededatos);
        
    // Verifica la conexión
    if ($mysqli->connect_error) {
        die("Error de conexión a la base de datos: " . $mysqli->connect_error);
    }


// Verificar si se recibe el parámetro de email para modificar
if (isset($_GET["email"])) {
    $emailviejo = $_GET["email"];

// Consultar los datos del registro específico a modificar
$sql = "SELECT * FROM alumno WHERE email = '$emailviejo'";
$result = $mysqli->query($sql);
$alumno = array(); // Crea la variable $alumno y se le asigna un array vacío
// (Si la consulta no devuelve ningún resultado, la función por lo menos va a retornar un array vacío)

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre = $row["nombre"];
    $email = $row["email"];
    $intereses=explode(", ",$row["interes"]);
    $asignatura=explode(", ",$row["asignatura"]);    
    
    echo'
    <!DOCTYPE html>
<html>
<head>
    <title>Formulario con Checkbox y Select Múltiples</title>
</head>

<style>
   
*{box-sizing:border-box;}

form{
	width:30%;
	padding:16px;
	border-radius:10px;
	margin:auto;
	background-color:#ccc;
    box-shadow: 3px 4px 3px 4px darkgray;
}

form label{
	width:72px;
	font-weight:bold;
	display:inline-block;
    font-size: 18px;
}

form input[type="text"],
form input[type="email"]{
	width:180px;
	padding:3px 10px;
	border:1px solid #f6f6f6;
	border-radius:3px;
	background-color:#f6f6f6;
	margin:8px 0;
	display:inline-block;
}

form input[type="submit"]{
	width:100%;
	padding:8px 16px;
	margin-top:32px;
	border:1px solid darkgreen;
	border-radius:5px;
	display:block;
	color:#fff;
	background-color:darkgreen;
} 

form input[type="submit"]:hover{
	cursor:pointer;
}

textarea{
	width:100%;
	height:100px;
	border:1px solid #f6f6f6;
	border-radius:3px;
	background-color:#f6f6f6;			
	margin:8px 0;
	/*resize: vertical | horizontal | none | both*/
	resize:none;
	display:block;
}

a {
    color: white;
    text-decoration: none;
}
button{
    width:100%;
	padding:8px 16px;
	margin-top:32px;
	border:1px solid darkblue;
	border-radius:5px;
	display:block;
	color:#fff;
	background-color: darkblue;
}
</style>
<body>
    <form action="procesa_modifica_registro.php" method="post"><label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="'.$nombre.'"><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="'.$email.'"><br><br>

    <label for="intereses">Intereses:</label><br>
    <input type="checkbox" id="deporte" name="intereses[]" value="Deporte" ' .(in_array("Deporte", $intereses)?" checked":""). '>
    <label for="deporte">Deporte</label><br>
    <input type="checkbox" id="musica" name="intereses[]" value="Musica" ' .(in_array("Musica", $intereses)?" checked":""). '>
    <label for="musica">Musica</label><br>
    <input type="checkbox" id="lectura" name="intereses[]" value="Lectura" ' .(in_array("Lectura", $intereses)?" checked":""). '>
    <label for="lectura">Lectura</label><br><br>

    <label for="opciones">Selecciona opciones:</label><br>
    <select id="opciones" name="asignaturas[]" multiple>
        <option value="mates" '.(in_array("mates", $asignatura)?" selected":"").'>mates</option>
        <option value="historia" '.(in_array("historia", $asignatura)?" selected":"").'>historia</option>
        <option value="ciencias" '.(in_array("ciencias", $asignatura)?" selected":"").'>ciencias</option>
        <option value="quimica" '.(in_array("quimica", $asignatura)?" selected":"").'>quimica</option>
    </select><br><br>
    <input type="hidden" id="emailviejo" name="emailviejo" value="'.$emailviejo.'">
    <button><a href="muestra_datos.php">Volver a la Lista</a></button>
    <input type="submit" value="Guardar Cambios">
    </form>
</body>
</html>';
} else {
    echo "No se encontró el registro para modificar.";
}
} else {
    echo "No se proporcionó un email válido para modificar.";
}

$mysqli->close();
?>

