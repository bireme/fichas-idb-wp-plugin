<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

$indicadores = [
    ['codigo' => 'B.1', 'nome' => 'Taxa de analfabetismo', 'link' => 'b-socioeconomicos/ficha?code=001SC'],
    ['codigo' => 'B.2', 'nome' => 'Níveis de escolaridade', 'link' => 'b-socioeconomicos/ficha?code=002SC'],
    ['codigo' => 'B.3', 'nome' => 'Produto Interno Bruto (PIB) per capita'],
    ['codigo' => 'B.4', 'nome' => 'Razão de renda'],
    ['codigo' => 'B.5', 'nome' => 'Proporção de pobres'],
    ['codigo' => 'B.6', 'nome' => 'Taxa de desemprego'],
    ['codigo' => 'B.7', 'nome' => 'Taxa de trabalho infantil'],
    ['codigo' => 'B.X', 'nome' => 'Proporção de pessoas desocupadas na força de trabalho', 'link' => 'b-socioeconomicos/ficha?code=003SC'],
    ['codigo' => 'B.X', 'nome' => 'Proporção de pessoas com força de trabalho subutilizada na força de trabalho ampliada', 'link' => 'b-socioeconomicos/ficha?code=004SC'],
    ['codigo' => 'B.X', 'nome' => 'Proporção de pessoas ocupadas na força de trabalho que não contribuíam para a previdência social', 'link' => 'b-socioeconomicos/ficha?code=005SC'],
    ['codigo' => 'B.X', 'nome' => 'Proporção na população de jovens de 15 a 29 anos de idade que não estudam e não trabalham', 'link' => 'b-socioeconomicos/ficha?code=006SC'],
    ['codigo' => 'B.X', 'nome' => 'Proporção de crianças e adolescentes de 5 a 17 anos de idade em situação de trabalho infantil', 'link' => 'b-socioeconomicos/ficha?code=007SC'],
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
