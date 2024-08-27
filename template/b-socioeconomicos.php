<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

$indicadores = [
    ['codigo' => 'B.1', 'nome' => 'Taxa de analfabetismo', 'link' => 'b-socioeconomicos/ficha?code=B1'],
    ['codigo' => 'B.2', 'nome' => 'Níveis de escolaridade'],
    ['codigo' => 'B.3', 'nome' => 'Produto Interno Bruto (PIB) per capita'],
    ['codigo' => 'B.4', 'nome' => 'Razão de renda'],
    ['codigo' => 'B.5', 'nome' => 'Proporção de pobres'],
    ['codigo' => 'B.6', 'nome' => 'Taxa de desemprego'],
    ['codigo' => 'B.7', 'nome' => 'Taxa de trabalho infantil'],
];
?>
<div class="container-bread-indicadores">
    <div class="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url('/fichasidb'); ?>">Fichas IDB</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a>Socioeconômicos</a></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container">
    <div class="row indicators-page">
        <h2>B. Indicadores Socioeconômicos</h2>
        <?php foreach ($indicadores as $indicador): ?>
                <button class="btn-indicator" 
                        onclick="window.location.href='<?php echo isset($indicador['link']) ? $indicador['link'] : '#'; ?>';">
                    <div class="indicator-code"><?php echo $indicador['codigo']; ?></div>
                    <div class="indicator-name"><?php echo $indicador['nome']; ?></div>
                </button>
        <?php endforeach; ?>
    </div>
</div>

<?php
// Inclua o rodapé e outras partes do template conforme necessário
get_footer();
?>
