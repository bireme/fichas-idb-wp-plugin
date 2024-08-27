<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

$indicadores = [
    ['codigo' => 'E.1', 'nome' => 'Número de profissionais de saúde por habitante'],
    ['codigo' => 'E.2', 'nome' => 'Número de leitos hospitalares por habitante'],
    ['codigo' => 'E.3', 'nome' => 'Número de leitos hospitalares (SUS) por habitante'],
    ['codigo' => 'E.4', 'nome' => 'Gasto nacional com saúde, como percentual do produto interno bruto (PIB)', 'link' => 'e-recursos/ficha?code=E4'],
    ['codigo' => 'E.6.1', 'nome' => 'Gasto público com saúde como proporção do PIB', 'link' => '/fichasidb/fatores-risco-protecao/fichas'],
    ['codigo' => 'E.6.2', 'nome' => 'Gasto público com saúde per capita'],
    ['codigo' => 'E.7', 'nome' => 'Gasto federal com saúde como proporção do PIB'],
    ['codigo' => 'E.8', 'nome' => 'Gasto federal com saúde como proporção do gasto federal total'],
    ['codigo' => 'E.9', 'nome' => 'Despesa familiar com saúde como proporção da renda familiar'],
    ['codigo' => 'E.10', 'nome' => 'Gasto médio (SUS) por atendimento ambulatorial'],
    ['codigo' => 'E.11', 'nome' => 'Valor médio pago por internação hospitalar no SUS'],
    ['codigo' => 'E.12', 'nome' => 'Gasto público com saneamento como proporção do PIB'],
    ['codigo' => 'E.13', 'nome' => 'Gasto federal com saneamento como proporção do PIB'],
    ['codigo' => 'E.14', 'nome' => 'Gasto federal com saneamento como proporção do gasto federal total'],
    ['codigo' => 'E.15', 'nome' => 'Número de concluintes de cursos de graduação em saúde'],
    ['codigo' => 'E.16', 'nome' => 'Distribuição dos postos de trabalho de nível superior em estabelecimentos de saúde'],
    ['codigo' => 'E.17', 'nome' => 'Número de enfermeiros por leito hospitalar'],
    ['codigo' => 'E.6.1', 'nome' => 'Anexo I – Conceito de gasto público com saúde'],
    ['codigo' => 'E.7', 'nome' => 'Anexo II – Conceito de gasto federal com saúde'],
    ['codigo' => 'E.12', 'nome' => 'Anexo III – Conceito de gasto público com saneamento'],
    ['codigo' => 'E.13', 'nome' => 'Anexo IV – Conceito de gasto federal com saneamento'],
    ['codigo' => 'E.9', 'nome' => 'Anexo V – Conceito de renda familiar'],
];
?>
<div class="container-bread-indicadores">
    <div class="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url('/fichasidb'); ?>">Fichas IDB</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a>Recursos</a></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container">
    <div class="row indicators-page">
        <h2>E. Indicadores de Recursos</h2>
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
