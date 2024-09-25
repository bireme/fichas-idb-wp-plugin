<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

$indicadores = [
    ['codigo' => 'F.1', 'nome' => 'Número de consultas médicas (SUS) por habitante'],
    ['codigo' => 'F.2', 'nome' => 'Número de procedimentos diagnósticos por consulta médica (SUS)'],
    ['codigo' => 'F.3', 'nome' => 'Número de internações hospitalares (SUS) por habitante'],
    ['codigo' => 'F.5', 'nome' => 'Proporção de internações hospitalares (SUS) por especialidade', 'link' => '/fichasidb/fatores-risco-protecao/fichas'],
    ['codigo' => 'F.6', 'nome' => 'Cobertura de consultas de pré-natal'],
    ['codigo' => 'F.7', 'nome' => 'Proporção de partos hospitalares'],
    ['codigo' => 'F.8', 'nome' => 'Proporção de partos cesáreos'],
    ['codigo' => 'F.10', 'nome' => 'Razão entre nascidos vivos informados e estimados'],
    ['codigo' => 'F.11', 'nome' => 'Razão entre óbitos informados e estimados'],
    ['codigo' => 'F.13', 'nome' => 'Cobertura vacinal'],
    ['codigo' => 'F.14', 'nome' => 'Proporção da população feminina em uso de métodos anticonceptivos'],
    ['codigo' => 'F.15', 'nome' => 'Cobertura de planos de saúde'],
    ['codigo' => 'F.16', 'nome' => 'Cobertura de planos privados de saúde', 'link' => 'f-cobertura/ficha?code=001CB'],
    ['codigo' => 'F.17', 'nome' => 'Cobertura de redes de abastecimento de água'],
    ['codigo' => 'F.18', 'nome' => 'Cobertura de esgotamento sanitário'],
    ['codigo' => 'F.19', 'nome' => 'Cobertura de coleta de lixo'],
    ['codigo' => 'F1', 'nome' => 'Anexo I – Procedimentos considerados como consulta médica'],
    ['codigo' => 'F2', 'nome' => 'Anexo II – Procedimentos complementares SUS'],
    ['codigo' => 'F13', 'nome' => 'Anexo III – População-alvo para o cálculo da cobertura vacinal'],
];
?>
<div class="container-bread-indicadores">
    <div class="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url('/fichasidb'); ?>">Fichas IDB</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a>Cobertura</a></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container">
    <div class="row indicators-page">
        <h2>F. Indicadores de Cobertura</h2>
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
