<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmácia Vila Boa</title>
    <link rel="stylesheet" href="../style.css">
</head>



<body>
    <header>
        <nav>
            <a class="logo" href="/">Farmácia Boa Vida</a>
            <ul class="nav-list">
                <li><a href="">Início</a></li>
                <li><a href="adicionar.php">Adicionar</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="search-container">
            <input type="text" id="search" placeholder="Pesquisar remédio...">
        </div>

        <h1>Dores</h1>
        <section id="Dores">
            <div class="dores">
                <h2>Dipirona</h2>
                <img src="../img/dipirona.jfif" alt="Dipirona">
                <p>Dores</p>
                <p>Remédio para dores e febres</p>
                <p>R$22,99</p>
            </div>

            <div class="dores">
                <h2>Paracetamol</h2>
                <img src="../img/paracetamol.jpg" alt="Paracetamol">
                <p>Dores e febres</p>
                <p>Remédio feito para suprir dores e febres</p>
                <p>R$29,99</p>
            </div>

            <div class="dores">
                <h2>Dorflex</h2>
                <img src="../img/dorflex.jpg" alt="Dorflex">
                <p>Dores de cabeça</p>
                <p>Remédio específico para dores de cabeça e enxaqueca</p>
                <p>R$29,99</p>
            </div>
        </section>

        <h1>Cólica</h1>
        <section id="Colica">
            <div class="colica">
                <h2>Buscopan</h2>
                <img src="../img/buscopan.jpg" alt="Buscopan">
                <p>Cólica</p>
                <p>Remédio feito para cólica</p>
                <p>R$39,99</p>
            </div>

            <div class="colica">
                <h2>Ibuprofeno</h2>
                <img src="../img/ibuprofeno.png" alt="Ibuprofeno">
                <p>Cólica</p>
                <p>Remédio feito para cólica</p>
                <p>R$59,99</p>
            </div>

            <div class="colica">
                <h2>Buscoduo</h2>
                <img src="../img/buscoduo.jpg" alt="Buscoduo">
                <p>Cólica</p>
                <p>Remédio feito para cólica</p>
                <p>R$29,99</p>
            </div>
        </section>
    </main>
   
    <footer>
        <div class="rodape">
            <p>©2025 FarmaciaBoaVida.com.br | Rua Mário Lobo 131 Joinville - SC - Brasil | CNPJ: 12.345.678/0001-91 | Todos os direitos reservados.</p>
        </div>
    </footer>

    <script>
        const searchInput = document.getElementById('search');
        searchInput.addEventListener('keyup', function() {
            const searchText = this.value.toLowerCase();
            const produtos = document.querySelectorAll('.dores, .colica');

            produtos.forEach(produto => {
                const nome = produto.querySelector('h2').textContent.toLowerCase();
                produto.style.display = nome.includes(searchText) ? 'block' : 'none';
            });
        });
    </script>
</body>
</html>