<?php
session_start();
if (!isset($_SESSION['username'])) // Si no me viene el usuario como session, lo redirijo
{
    json_encode(array(
        'success' => 0,
        'message' => 'No tiene permiso para ver esta página'
    ));
}
$_POST = json_decode(file_get_contents("php://input"), true);
include 'Conexion.php';
$username = $_POST['username'];
$password = $_POST['password'];
$terms = $_POST['terms'];
$counter = 0;
if (isset($password) && isset($username) && isset($terms) && !empty($password) && !empty($username) && !empty($terms) && $terms == 'true') {
    clearInput($password);
    clearInput($username);
    clearInput($terms);
    $query = "SELECT nombre,usuario,password FROM usuarios WHERE usuario = :usuario";
    $queryPrepared = $pdo->prepare($query);
    $queryPrepared->bindValue(':usuario', $username);
    $queryPrepared->execute();
    while ($rowsUserDB = $queryPrepared->fetch(PDO::FETCH_ASSOC) ) {
        if (password_verify($password,$rowsUserDB['password'])) {
            $counter++;
            $_SESSION['fullname'] =$rowsUserDB['nombre'];
            $_SESSION['username'] =$rowsUserDB['usuario'];
        }
    }
    if ($counter > 0) { // Existe solo 1 o más usuarios con con el mismo USER y PASS iguales en la BD
        echo json_encode(array(
            'success' => 1,
            'message' => 'Validado correctamente'
        ));
    } else {
        echo json_encode(array(
            'success' => 0,
            'message' => 'Usuario y/o contraseña incorrectos'
        ));
    }
} else {
    echo json_encode(array(
        'success' => 0,
        'message' => 'Ocurrió algun error(variables vacias) o quizas el select NO es TRUE'
    ));
    header("Location: index.php");
}

function clearInput($input)
{
    $input = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $input);
    $input = trim($input);
    $input = stripslashes($input);
    $input = str_ireplace("<script>", "", $input);
    $input = str_ireplace("</script>", "", $input);
    $input = str_ireplace("<script src>", "", $input);
    $input = str_ireplace("<script type=>", "", $input);
    $input = str_ireplace("SELECT * FROM", "", $input);
    $input = str_ireplace("DELETE  FROM", "", $input);
    $input = str_ireplace("INSERT INTO", "", $input);
    $input = str_ireplace("SELECT COUNT(*) FROM", "", $input);
    $input = str_ireplace("DROP TABLE", "", $input);
    $input = str_ireplace("OR  '1'='1", "", $input);
    $input = str_ireplace('OR "1"="1"', "", $input);
    $input = str_ireplace('OR ´1´ =´1´', "", $input);
    $input = str_ireplace("is NULL; --", "", $input);
    $input = str_ireplace("LIKE '", "", $input);
    $input = str_ireplace('LIKE "', "", $input);
    $input = str_ireplace("LIKE ´", "", $input);
    $input = str_ireplace("OR 'a'='a", "", $input);
    $input = str_ireplace('OR ´a´=´a', "", $input);
    $input = str_ireplace("OR a=a", "", $input);
    $input = str_ireplace("--", "", $input);
    $input = str_ireplace("^", "", $input);
    $input = str_ireplace("[", "", $input);
    $input = str_ireplace("]", "", $input);
    $input = str_ireplace("==", "", $input);
    return $input;

}