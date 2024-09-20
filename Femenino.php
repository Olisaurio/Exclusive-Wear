<?php
include("Crud/Conexion.php");
$conexion = conexion();
$sql = "SELECT * FROM productos WHERE categoria = 'masculino'";
$query = mysqli_query($conexion, $sql);
?>

<?php include("header.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zapatos Masculinos</title>
    <link rel="stylesheet" href="StyleMasculino.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="carrusel">
        <h2>Zapatos Masculinos</h2>
        <div class="carousel-container">
            <div class="carousel" id="carousel">
            </div>
        </div>
    </div>

    <div class="carrusel">
        <h2>Zapatos Deportivos</h2>
        <div class="carousel-container">
            <div class="carousel" id="deportivos">
            </div>
        </div>
    </div>

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
        $.ajax({
            url: 'Crud/fetch_products_femenino.php',
            method: 'GET',
            success: function(data) {
                $('#carousel').html(data);
                setupCarousel('carousel');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error al cargar los productos masculinos: ", textStatus, errorThrown);
            }
        });

        $.ajax({
            url: 'Crud/fetch_products_masculino2.php',
            method: 'GET',
            success: function(data) {
                $('#deportivos').html(data);
                setupCarousel('deportivos');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error al cargar los productos deportivos: ", textStatus, errorThrown);
            }
        });
    });

    function setupCarousel(carouselId) {
        const carousel = $(`#${carouselId}`);
        const cards = carousel.find('.card');
        const totalCards = cards.length;
        const cardWidth = cards.first().outerWidth(true);
        let currentIndex = 0;

        const clonedCards = cards.clone();
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
    setupCarousel('deportivos');
    </script>
</body>
</html>