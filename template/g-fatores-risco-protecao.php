<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

$indicadores = [
    ['codigo' => 'G.1', 'nome' => 'Prevalência de sedentarismo'],
    ['codigo' => 'G.2', 'nome' => 'Prevalência de consumo abusivo de álcool'],
    ['codigo' => 'G.3', 'nome' => 'Taxa de obesidade'],
    ['codigo' => 'G.4', 'nome' => 'Prevalência de tabagismo', 'link' => 'g-fatores-risco-protecao/ficha?code=G4A'],
    ['codigo' => 'G.5', 'nome' => 'Consumo de sal'],
    ['codigo' => 'G.6', 'nome' => 'Consumo de gorduras saturadas'],
    ['codigo' => 'G.7', 'nome' => 'Prevalência de hipertensão arterial'],
    ['codigo' => 'G.8', 'nome' => 'Prevalência de diabetes mellitus'],
    ['codigo' => 'G.9', 'nome' => 'Prevalência de colesterol elevado'],
    ['codigo' => 'G.10', 'nome' => 'Proporção de pessoas com dieta inadequada'],
    ['codigo' => 'G.11', 'nome' => 'Proporção de pessoas que não consomem frutas e hortaliças'],
    ['codigo' => 'G.12', 'nome' => 'Prevalência de fatores de risco ocupacionais'],
    ['codigo' => 'G.13', 'nome' => 'Prevalência de fatores de risco ambientais'],
];
?>
<div class="container-bread-indicadores">
    <div class="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url('/fichasidb'); ?>">Fichas IDB</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a>Fatores de Risco e Proteção</a></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container">
    <div class="row indicators-page">
        <h2>G. Indicadores de Fatores de Risco e Proteção</h2>
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
