<?php include("header.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zapatos Masculinos</title>
    <link rel="stylesheet" href="Promociones.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="Contactanos.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>


    <div class="hero">
    <h3>
            ¿Quienes somos?
        </h3>
        <p>En Exclusive Wear, somos más que una tienda de zapatos; somos un destino para aquellos que buscan calidad, estilo y comodidad en cada paso. Desde nuestra fundación en 2024, nos hemos dedicado a ofrecer una amplia selección de calzado que combina las últimas tendencias con los clásicos que nunca pasan de moda.

        Cada par de zapatos que ofrecemos es seleccionado cuidadosamente, asegurando que nuestros clientes reciban productos que no solo se ven bien, sino que también brindan el confort y la durabilidad que merecen. Trabajamos con las mejores marcas y diseñadores para traer lo mejor del mundo del calzado a tu alcance.

        Nuestro equipo apasionado y experto está aquí para ayudarte a encontrar el par perfecto, ya sea que busques algo para el día a día, una ocasión especial o simplemente quieras darte un gusto. Creemos que los zapatos son una extensión de tu personalidad, y estamos comprometidos a ayudarte a expresarla de la mejor manera posible.

        En Exclusive Wear, cada paso cuenta, y estamos aquí para asegurarnos de que los tuyos te lleven a donde quieres ir.</p>

        <a href=""><img src="" alt=""></a>
        <a href=""><img src="" alt=""></a>
        <a href=""><img src="" alt=""></a>
    </div>

    <!-- formulario para contacto -->

    <form id="formIndex" action="#" method="POST">
        <h2>Contáctanos</h2>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="message" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit">Enviar</button>
        </div>
        
    </form>




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

const form = document.getElementById('formIndex');
form.addEventListener('submit', sendEmail);

const serviceId = 'service_kl3065j';
const templateId = 'template_v98joke';
const apiKey = '6LC59AszJuZqQ4oF9';

function sendEmail(event) {
    event.preventDefault();

    emailjs.init(apiKey);
    
    emailjs.sendForm(serviceId, templateId, form)
        .then(result => {
            Swal.fire("Su mensaje se ha enviado con éxito");
            clearForm();
        })
        .catch((error) => {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Hubo un error al enviar el mensaje, inténtelo más tarde"
            });
        });
}

function clearForm() {
    form.reset();
}

    </script>