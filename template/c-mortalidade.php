<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

$indicadores = [
    ['codigo' => 'C.1', 'nome' => 'Taxa de mortalidade infantil'],
    ['codigo' => 'C.1.1', 'nome' => 'Taxa de mortalidade neonatal precoce'],
    ['codigo' => 'C.1.2', 'nome' => 'Taxa de mortalidade neonatal tardia'],
    ['codigo' => 'C.1.3', 'nome' => 'Taxa de mortalidade pós-neonatal'],
    ['codigo' => 'C.2', 'nome' => 'Taxa de mortalidade perinatal'],
    ['codigo' => 'C.16', 'nome' => 'Taxa de mortalidade em menores de cinco anos'],
    ['codigo' => 'C.3', 'nome' => 'Razão de mortalidade materna', 'link' => 'c-mortalidade/ficha?code=C3'],
    ['codigo' => 'C.4', 'nome' => 'Mortalidade proporcional por grupos de causas'],
    ['codigo' => 'C.5', 'nome' => 'Mortalidade proporcional por causas mal definidas'],
    ['codigo' => 'C.6', 'nome' => 'Mortalidade proporcional por doença diarréica aguda em menores de 5 anos de idade'],
    ['codigo' => 'C.7', 'nome' => 'Mortalidade proporcional por infecção respiratória aguda em menores de 5 anos de idade'],
    ['codigo' => 'C.8', 'nome' => 'Taxa de mortalidade específica por doenças do aparelho circulatório'],
    ['codigo' => 'C.9', 'nome' => 'Taxa de mortalidade específica por causas externas'],
    ['codigo' => 'C.10', 'nome' => 'Taxa de mortalidade específica por neoplasias malignas'],
    ['codigo' => 'C.11', 'nome' => 'Taxa de mortalidade específica por acidentes do trabalho'],
    ['codigo' => 'C.12', 'nome' => 'Taxa de mortalidade específica por diabete melito'],
    ['codigo' => 'C.14', 'nome' => 'Taxa de mortalidade específica por aids'],
    ['codigo' => 'C.15', 'nome' => 'Taxa de mortalidade específica por afecções originadas no período perinatal'],
    ['codigo' => 'C.17', 'nome' => 'Taxa de mortalidade específica por doenças transmissíveis'],
    ['codigo' => 'C.3', 'nome' => 'Anexo I – Conceito de óbito materno'],

];
?>
<div class="container-bread-indicadores">
    <div class="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url('/fichasidb'); ?>">Fichas IDB</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a>Mortalidade</a></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container">
    <div class="row indicators-page">
        <h2>C. Indicadores de Mortalidade</h2>
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
