

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Pagos</title>
    <link rel="stylesheet" href="/Style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        a {
            text-decoration: none;
        }

        .container {
            width: 50%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: red;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .btn {
            background-color: red;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: darkred;
        }

        footer {
            width: 100%;
            background-color: #171718;
            color: white;
            padding: 40px 20px;
            text-align: left;
            position: absolute;
            bottom: 0;
        }

        footer #container {
            max-width: 1200px;
            margin: 0 auto;
        }

        footer h3 {
            font-size: 1.5em;
            margin-bottom: 15px;
            color: #8b0000;
        }

        footer p {
            margin-bottom: 10px;
            line-height: 1.6;
        }

        footer a {
            color: #ffffff;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        footer .col-md-4 {
            margin-bottom: 20px;
        }

        footer img {
            width: 30px;
            height: auto;
            margin-right: 10px;
        }

        @media (min-width: 768px) {
            footer .row {
                display: flex;
                justify-content: space-between;
            }
        }

        @media (max-width: 768px) {


            footer {
                padding: 30px 10px;
            }

            footer h3 {
                font-size: 20px;
            }

            footer p {
                font-size: 14px;
            }

            footer a img {
                width: 30px;
                height: 30px;
            }
        }
    </style>
</head>

<body>

<header>
    <nav>
        <div class="HeaderGeneral">
            <a href="Crud/IndexCrud.php" class="LogoHeader"><img src="./Imagenes/LOGOS/LOGO.png" alt=""></a>
            <div class="LoginCarrito">
                <?php if (isset($_SESSION['NombreUsuario'])): ?>
                    <span class="NombreUsuario"><?php echo htmlspecialchars($_SESSION['NombreUsuario']); ?></span>
                    <button class="LogoutButton">
                        <a href="./Login/CerrarSesion.php">Cerrar sesión</a>
                    </button>
                <?php else: ?>
                    <button class="LoginButton">
                        <a href="./Login/IndexLogin.php">Login</a>
                    </button>
                <?php endif; ?>

                <button class="CarritoButton">
                <a href="CarritoCompras/viewCart.php">A</a>
                </button>
            </div>
        </div>
        <a href="index.php">inicio</a>
        <a href="Masculino.php">Masculino</a>
        <a href="Femenino.php">Femenino</a>
        <a href="Promociones.php">Promociones</a>
        <a href="Contactanos.php">Contactanos</a>
    </nav>
</header>

    <div class="container">
        <h2>Formulario de Pago</h2>
        <form method="POST" action="">
            <label for="cardNumber">Número de tarjeta (16 dígitos):</label>
            <input type="text" id="cardNumber" name="cardNumber" required pattern="\d{16}" maxlength="16">

            <label for="expiryDate">Fecha de vencimiento (MM/AA):</label>
            <input type="text" id="expiryDate" name="expiryDate" required placeholder="MM/AA">

            <label for="securityCode">Código de seguridad:</label>
            <input type="text" id="securityCode" name="securityCode" required pattern="\d{3}" maxlength="3">

            <button type="submit" class="btn">Pagar</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Aquí puedes agregar la lógica para procesar el pago
            // Por ahora, solo mostramos un mensaje de éxito
            echo "<p style='color:red;'>¡Pago exitoso!</p>";
            echo "<a href=index.php>volver a la pagina principal </a>";
            exit();
        }
        ?>
    </div>

    <footer>
        <div id="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>Contactanos</h3>
                    <p>Dirección: Calle 123, Colonia, Código Postal</p>
                    <p>Teléfono: 1234-5678</p>
                    <p>Correo electrónico:
                        <a href="mailto:contact@example.com">contact@example.com</a>
                    </p>
                </div>
                <div class="col-md-4">
                    <h3>Redes sociales</h3>
                    <a href="#"><img src="./Imagenes/redes/facebook.png" alt="Facebook"></a>
                    <a href="#"><img src="./Imagenes/redes/instagram.png" alt="Instagram"></a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>