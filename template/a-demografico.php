<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

$indicadores = [
    ['codigo' => 'A.1', 'nome' => 'População total'],
    ['codigo' => 'A.2', 'nome' => 'Razão de sexos'],
    ['codigo' => 'A.3', 'nome' => 'Taxa de crescimento da população'],
    ['codigo' => 'A.4', 'nome' => 'Grau de urbanização', 'link' => '/fichasidb/fatores-risco-protecao/fichas'],
    ['codigo' => 'A.13', 'nome' => 'Proporção de menores de 5 anos de idade na população'],
    ['codigo' => 'A.14', 'nome' => 'Proporção de idosos na população'],
    ['codigo' => 'A.15', 'nome' => 'Índice de envelhecimento'],
    ['codigo' => 'A.16', 'nome' => 'Razão de dependência'],
    ['codigo' => 'A.5', 'nome' => 'Taxa de fecundidade total'],
    ['codigo' => 'A.6', 'nome' => 'Taxa específica de fecundidade'],
    ['codigo' => 'A.7', 'nome' => 'Taxa bruta de natalidade'],
    ['codigo' => 'A.8', 'nome' => 'Mortalidade proporcional por idade'],
    ['codigo' => 'A.9', 'nome' => 'Mortalidade proporcional por idade em menores de 1 ano de idade'],
    ['codigo' => 'A.10', 'nome' => 'Taxa bruta de mortalidade'],
    ['codigo' => 'A.11', 'nome' => 'Esperança de vida ao nascer'],
    ['codigo' => 'A.12', 'nome' => 'Esperança de vida aos 60 anos de idade'],
];
?>
<div class="container-bread-indicadores">
    <div class="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url('/fichasidb'); ?>">Fichas IDB</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a>Demográfico</a></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container">
    <div class="row indicators-page">
        <h2>A. Indicadores Demográficos</h2>
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
