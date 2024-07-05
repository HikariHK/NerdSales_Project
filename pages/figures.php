<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/projeto/css/global/style.css">
    <link rel="stylesheet" href="/projeto/css/pages/sac.css">
    <link rel="icon" href="imgs/fav.png">
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
        <aside>
            <h3 style="font-size: 170%; padding-left: 5px;">Filtrar por</h3>
            <div class="sidebar-content">
                <ul>
                    <h3>Categorias</h3>
                    <li><a href="">Majo no Tabitabi</a></li>
                    <li><a href="">Bofuri</a></li>
                    <li><a href="">Tensura</a></li>
                    <li><a href="">Magic Knight Rayearth</a></li>
                    <li><a href="">Princess Connect Re:Dive</a></li>
                    <li><a href="">Cardcaptor Sakura</a></li>
                </ul>
            </div>
            <div class="sidebar-content">
                <h3>Preço</h3>
                <div class="price">
                    <label for=""><b>De</b><br>
                        <input type="number" name="min" placeholder="Min">
                    </label>
                    <label for=""><b>Até</b><br>
                        <input type="number" name="max" placeholder="Máx">
                    </label>
                </div>
            </div>
            <div class="sidebar-content">
                <h3>Gênero</h3>
                <div class="genre">
                    <form action="">
                        <label><input type="checkbox" name="fantasia">Fantasia</label>
                        <label><input type="checkbox" name="acao">Ação</label>
                        <label><input type="checkbox" name="magia">Magia</label>
                        <label><input type="checkbox" name="aventura">Aventura</label>
                    </form>
                </div>
            </div>
            
            <div class="sidebar-content">
                <h3>Tipo</h3>
                <div class="types">
                    <form action="">
                        <label><input type="checkbox" name="anime">Anime</label>
                        <label><input type="checkbox" name="hq">HQs</label>
                    </form>
                </div>
            </div>
        </aside>
        <!-- Seu conteúdo atual -->

        <section class="product-boxes">
            <h2 style="font-size: 170%; padding-left: 5px;">Action Figures</h2>
            <!-- Caixas de produtos -->
                <div class="product-box">
                    <div class="product-img">
                        <a href=""><img src="/projeto/assets/imgs/products/figures/elaina.jpg" alt=""></a>
                    </div>
                    <div class="product-text">
                        <a href="">Elaina Summer One-piece Dress</a>
                        <p>R$ 1250,49</p>
                    </div>
                </div>
                <div class="product-box">
                    <div class="product-img">
                        <a href=""><img src="imgs/pecorine.jpg" alt=""></a>
                    </div>
                    <div class="product-text">
                        <a href="">Pecorine com Onigiri</a>
                        <p>R$ 1295,40</p>
                    </div>
                </div>
                <div class="product-box">
                    <div class="product-img">
                        <a href=""><img src="imgs/rayearth.jpg" alt=""></a>
                    </div>
                    <div class="product-text">
                        <a href="">Rayearth o Gênio do Fogo</a>
                        <p>R$ 347,94</p>
                    </div>
                </div>
            <div class="product-box">
                <div class="product-img">
                    <a href=""><img src="imgs/maple.jpg" alt=""></a>
                </div>
                <div class="product-text">
                    <a href="">Maple (Black Rose Armor Ver.)</a>
                    <p>R$ 152,96</p>
                </div>
            </div>
                <div class="product-box">
                    <div class="product-img">
                        <a href=""><img src="imgs/rimuru.jpg" alt=""></a>
                    </div>
                    <div class="product-text">
                        <a href="">Rimuru Tempest</a>
                        <p>R$ 1999,99</p>
                    </div>
                </div>
                <div class="product-box">
                    <div class="product-img">
                        <a href=""><img src="imgs/kerberos.jpg" alt=""></a>
                    </div>
                    <div class="product-text">
                        <a href="">Kerberos</a>
                        <p>R$ 1771,16</p>
                    </div>
                </div>
            <!-- Adicione mais caixas de produtos conforme necessário -->
        </section>
    </main>
    <div class="whatsapp-icon">
        <?php include '..\buttons.php';?>
    </div>
    <footer>
        <div class="footer-wrapper">
            <?php include '..\footer.php';?>
        </div>
    </footer>
</body>
</html>