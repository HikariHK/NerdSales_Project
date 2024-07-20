<?php 
require_once __DIR__ . "/../painel/functions.php";

// Atualizar contato se o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["atualizarContato"])) {
    atualizarContato($connect);
}

// Buscar dados de contato
$query = "SELECT * FROM contato WHERE id = 1"; // Considerando que só há um registro de contato
$result = mysqli_query($connect, $query);
$contactData = mysqli_fetch_assoc($result);

$endereco = $contactData['endereco'] ?? '';
$email = $contactData['email'] ?? '';
$telefone = $contactData['telefone'] ?? '';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo url('css/global/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('css/pages/sac.css'); ?>">
    <link rel="icon" href="<?php echo url('assets/imgs/fav.png'); ?>">
    <title>NerdSales</title>
</head>
<body>
    <!--- <script type="text/javascript" src="js/script.js"></script>-->
    <header>
        <nav class="navbar">
            <div class="nav-left">
                <?php require '..\layout\nav-left2.php';?>
            </div>
            <div class="nav-center">
                <?php require '..\layout\nav-center.php';?>
            </div>
            <div class="nav-right">
                <?php require '..\layout\nav-right.php';?>
            </div>
        </nav>
    </header>
    <main id="main-content"> <!-- Coloque seu código da sua página aqui com cuidado -->
        <section class="section1">
            <h1 class="titulosac">SAC</h1>
            <h4 class="subtitulosac">tire suas dúvidas</h4>
        </section>
        <section>
            <div>
                <h3 class="tituloduvidas">Dúvidas Frequentes:</h3>
            </div>
            <div class="boxduvidas">

            <div class="accordion">
                <input type="checkbox" id="expand-toggle1">
                <label for="expand-toggle1">Quais são as formas de pagamento?</label>
                    <div class="content">
                        <p>Aceitamos diversas opções de pagamento para proporcionar conveniência e segurança aos nossos clientes.</p>
                        <p>Pague com tranquilidade usando cartões de crédito e débito, emissão de boletos ou a agilidade do Pix.</p>
                    </div>
                </div>
            <div class="accordion">
                <input type="checkbox" id="expand-toggle2">
                <label for="expand-toggle2">Como funciona a devolução?</label>
                    <div class="content">
                        <p>Garantimos uma política de devolução descomplicada. Se, por qualquer motivo, você não estiver satisfeito com seu produto aceitamos devoluções dentro de 20 dias após o recebimento.</p>
                        <p>Sua satisfação é nossa prioridade.</p>
                    </div>
                </div>
            <div class="accordion">
                <input type="checkbox" id="expand-toggle3">
                <label for="expand-toggle3">O que fazer em caso de atraso no recebimento?</label>
                    <div class="content">
                        <p>Em caso de atraso no seu pedido, entre em contato com nossa equipe pelo e-mail ajudadiw@gmail.com.</p>
                        <p>Estamos aqui para ajudar!</p>
                    </div>
                </div>
        </section>
        <section class="contact-wrapper">
            <div class="paginacontato">
                <div class="dadoscontato">
                    <div class="endereco">
                        <h5 class="texto">Nosso Endereço</h5>
                        <a class="texto" href="https://maps.app.goo.gl/QhnvC6o5B4Y9VYxA6"><?echo "$endereco";?></br>
                            <br>CEP - 90800-041</br>
                        </a>
                        <p class="texto"></p>
                        <p class="texto"></p>
                    </div>
                
                    <div class="email">
                        <h5 class="texto">E-mail</h5>
                        <a class="texto" href="mailto:ajudadiw@gmail.com?subject=&body="><?echo "$email";?></a>
                    </div>

                    <div class="telefone">
                        <h5 class="texto">Nosso Número</h5>
                        <p class="texto"><?echo "$telefone"?></p>
                        <a class="texto" href="https://wa.me/5532456214562">Nos chame no whatsapp!</a>
                    </div>
                </div>
        </section>

    </main>
    <div class="whatsapp-icon">
        <?php include '..\layout\buttons.php';?>
    </div>
    <footer>
        <div class="footer-wrapper">
            <?php include '..\layout\footer.php';?>
        </div>
    </footer>
</body>
</html>