<?php
session_start();
if (isset($_SESSION['username'])) // Si no me viene el usuario como session, lo redirijo
{
    header("Location:home.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Login</title>
</head>

<body>

<div class="alert-container">
    <!-- AQUI SE INSERTARÁ EL ALERT -->
</div>
<div class="container">
    <div class="row justify-content-center pt-4 h-100 align-items-center">
        <div class="col-lg-4 col-md-8 border rounded">
            <form class="py-2" id="formData" method="POST">
                <div class="form-group">
                    <label for="username">Ingrese su usuario</label>
                    <input id="username" class="form-control" type="text" name="username" placeholder="Username ...">
                </div>
                <div class="form-group">
                    <label for="password">Ingrese su contraseña</label>
                    <input id="password" class="form-control" type="text" name="password" placeholder="Password ...">
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input id="terms" class="form-check-input" type="checkbox" name="terms" value="true">
                        <label for="terms" class="form-check-label">Acepto los términos y condiciones</label>
                    </div>
                </div>
                <input id="buttonSubmit" class="btn btn-primary mx-auto d-block" type="submit" value="Ingresar">
            </form>
        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="assets/js/validar.js"></script>
</body>

</html>