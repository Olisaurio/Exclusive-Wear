<?php
include("Crud/Conexion.php");
$conexion = conexion();
if (!$conexion) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

$sql_masculino = "SELECT * FROM productos WHERE categoria = 'masculino'";
$query_masculino = mysqli_query($conexion, $sql_masculino);


$sql_femenino = "SELECT * FROM productos WHERE categoria = 'femenino'";
$query_femenino = mysqli_query($conexion, $sql_femenino);


$sql_promociones = "SELECT * FROM productos WHERE precio < 50";
$query_promociones = mysqli_query($conexion, $sql_promociones);
?>

<?php include("header.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zapatos Masculinos</title>
    <link rel="stylesheet" href="Promociones.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="carrusel">
        <h2>Zapatos Masculinos</h2>
        <div class="carousel-container">
            <div class="carousel" id="carousel">
                <?php while ($producto = mysqli_fetch_assoc($query_masculino)): ?>
                    <div class="card">
                        <img src="<?php echo $producto['Imagen']; ?>" alt="<?php echo $producto['Nombre']; ?>">
                        <h3><?php echo $producto['Nombre']; ?></h3>
                        <p><?php echo $producto['Descripcion']; ?></p>
                        <p>Precio: $<?php echo number_format($producto['Precio'], 2); ?></p>
                        <!-- Formulario para agregar al carrito -->
                        <form method="POST" action="/api/CarritoCompras/addToCart.php">
                            <input type="hidden" name="product_id" value="<?php echo $producto['Id']; ?>">
                            <button type="submit" class="add-to-cart">Agregar al Carrito</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <div class="carrusel">
        <h2>Zapatos Femeninos</h2>
        <div class="carousel-container">
            <div class="carousel" id="deportivos-femeninos">
                <?php while ($producto = mysqli_fetch_assoc($query_femenino)): ?>
                    <div class="card">
                        <img src="<?php echo $producto['Imagen']; ?>" alt="<?php echo $producto['Nombre']; ?>">
                        <h3><?php echo $producto['Nombre']; ?></h3>
                        <p><?php echo $producto['Descripcion']; ?></p>
                        <p>Precio: $<?php echo number_format($producto['Precio'], 2); ?></p>
                        <!-- Formulario para agregar al carrito -->
                        <form method="POST" action="CarritoCompras/addToCart.php">
                            <input type="hidden" name="product_id" value="<?php echo $producto['Id']; ?>">
                            <button type="submit" class="add-to-cart">Agregar al Carrito</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <div class="carrusel">
        <h2>Promociones</h2>
        <div class="carousel-container">
            <div class="carousel" id="promociones">
                <?php while ($producto = mysqli_fetch_assoc($query_promociones)): ?>
                    <div class="card">
                        <img src="<?php echo $producto['Imagen']; ?>" alt="<?php echo $producto['Nombre']; ?>">
                        <h3><?php echo $producto['Nombre']; ?></h3>
                        <p><?php echo $producto['Descripcion']; ?></p>
                        <p>Precio: <span style="color: red;">$<?php echo number_format($producto['Precio'], 2); ?></span></p>
                        <!-- Formulario para agregar al carrito -->
                        <form method="POST" action="/api/CarritoCompras/addToCart.php">
                            <input type="hidden" name="product_id" value="<?php echo $producto['Id']; ?>">
                            <button type="submit" class="add-to-cart">Agregar al Carrito</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <!-- Mostrar mensaje de éxito si el producto se añadió al carrito -->
    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        <p style="color: green;">Producto añadido al carrito con éxito.</p>
    <?php endif; ?>

    <footer>
        <div class="container">
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

    <script>
        $(document).ready(function() {
            function setupCarousel(carouselId) {
                const carousel = $(`#${carouselId}`);
                const cards = carousel.find('.card');
                const totalCards = cards.length;
                const cardWidth = cards.first().outerWidth(true);
                let currentIndex = 0;

                const clonedCards = cards.slice(0, Math.min(totalCards, 5)).clone();
                carousel.append(clonedCards);

                function moveCarousel() {
                    currentIndex++;
                    const offset = -currentIndex * cardWidth;
                    carousel.css('transition', 'transform 0.5s ease');
                    carousel.css('transform', `translateX(${offset}px)`);

                    if (currentIndex >= totalCards) {
                        setTimeout(() => {
                            carousel.css('transition', 'none');
                            currentIndex = 0;
                            carousel.css('transform', 'translateX(0)');
                        }, 500);
                    }
                }

                setInterval(moveCarousel, 3000);
            }

            setupCarousel('carousel');
            setupCarousel('deportivos-femeninos');
            setupCarousel('promociones');
        });
    </script>
</body>

</html>