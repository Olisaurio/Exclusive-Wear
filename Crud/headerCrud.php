<!-- Archivo: headerCrud.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión CRUD</title>
    <style>
        /* Estilos básicos para los botones y el encabezado */
        body {
            background-image: url(./Imagenes/Fondo/blurry-gradient-haikei.svg);
            font-family: Arial, sans-serif;
        }
        header {
            background-color: #333;
            padding: 15px;
            text-align: center;
        }
        header a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #555;
            margin: 0 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        header a:hover {
            background-color: #777;
        }
        header a.active {
            background-color: #007BFF;
        }
    </style>
</head>
<body>
    <header>
        <!-- Botón de Inicio -->
        <a href="/index.php" class="active">Inicio</a>
        
        <!-- Botones para cada CRUD -->
        <a href="usuarios.php">Usuarios</a>
        <a href="productos.php">Productos</a>
        <a href="proveedores.php">Proveedores</a>
    </header>
</body>
</html>
