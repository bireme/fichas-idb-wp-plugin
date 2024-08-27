<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

$indicadores = [
    ['codigo' => 'D.1.1', 'nome' => 'Incidência de sarampo'],
    ['codigo' => 'D.1.2', 'nome' => 'Incidência de difteria'],
    ['codigo' => 'D.1.3', 'nome' => 'Incidência de coqueluche'],
    ['codigo' => 'D.1.4', 'nome' => 'Incidência de tétano neonatal', 'link' => '/fichasidb/fatores-risco-protecao/fichas'],
    ['codigo' => 'D.1.5', 'nome' => 'Incidência de tétano (exceto o neonatal)'],
    ['codigo' => 'D.1.6', 'nome' => 'Incidência de febre amarela'],
    ['codigo' => 'D.1.7', 'nome' => 'Incidência de raiva humana'],
    ['codigo' => 'D.1.8', 'nome' => 'Incidência de hepatite B'],
    ['codigo' => 'D.1.14', 'nome' => 'Incidência de hepatite C'],
    ['codigo' => 'D.1.9', 'nome' => 'Incidência de cólera'],
    ['codigo' => 'D.1.10', 'nome' => 'Incidência de febre hemorrágica da dengue'],
    ['codigo' => 'D.1.11', 'nome' => 'Incidência de sífilis congênita'],
    ['codigo' => 'D.1.12', 'nome' => 'Incidência de rubéola'],
    ['codigo' => 'D.1.13', 'nome' => 'Incidência de síndrome da rubéola congênita'],
    ['codigo' => 'D.1.15', 'nome' => 'Incidência de doença meningocócica'],
    ['codigo' => 'D.1.17', 'nome' => 'Incidência de leptospirose', 'link' => 'd-morbidade/ficha?code=D117'],
    ['codigo' => 'D.2.1', 'nome' => 'Taxa de incidência de aids'],
    ['codigo' => 'D.2.2', 'nome' => 'Taxa de incidência de tuberculose'],
    ['codigo' => 'D.2.3', 'nome' => 'Taxa de incidência de dengue'],
    ['codigo' => 'D.2.4', 'nome' => 'Taxa de incidência de leishmaniose tegumentar americana'],
    ['codigo' => 'D.2.5', 'nome' => 'Taxa de incidência de leishmaniose visceral'],
    ['codigo' => 'D.3', 'nome' => 'Taxa de detecção de hanseníase'],
    ['codigo' => 'D.4', 'nome' => 'Índice parasitário anual (IPA) de malária'],
    ['codigo' => 'D.5', 'nome' => 'Taxa de incidência de neoplasias malignas'],
    ['codigo' => 'D.6', 'nome' => 'Taxa de incidência de doenças relacionadas ao trabalho'],
    ['codigo' => 'D.7', 'nome' => 'Taxa de incidência de acidentes do trabalho típicos'],
    ['codigo' => 'D.8', 'nome' => 'Taxa de incidência de acidentes do trabalho de trajeto'],
    ['codigo' => 'D.9', 'nome' => 'Taxa de prevalência de hanseníase'],
    ['codigo' => 'D.10', 'nome' => 'Taxa de prevalência de diabete melito'],
    ['codigo' => 'D.12', 'nome' => 'Índice CPO-D'],
    ['codigo' => 'D.28', 'nome' => 'Proporção de crianças de 5 – 6 anos de idade com índice ceo-d = 0'],
    ['codigo' => 'D.13', 'nome' => 'Proporção de internações hospitalares (SUS) por grupos de causas'],
    ['codigo' => 'D.14', 'nome' => 'Proporção de internações hospitalares (SUS) por causas externas'],
    ['codigo' => 'D.23', 'nome' => 'Proporção de internações hospitalares (SUS) por afecções originadas no período perinatal'],
    ['codigo' => 'D.22', 'nome' => 'Taxa de prevalência de pacientes em diálise (SUS)'],
    ['codigo' => 'D.15', 'nome' => 'Proporção de nascidos vivos por idade materna'],
    ['codigo' => 'D.16', 'nome' => 'Proporção de nascidos vivos de baixo peso ao nascer'],
    ['codigo' => 'D.17', 'nome' => 'Taxa de prevalência de déficit ponderal para a idade em crianças menores 
de cinco anos de idade'],
    ['codigo' => 'D.19', 'nome' => 'Taxa de prevalência de aleitamento materno'],
    ['codigo' => 'D.20', 'nome' => 'Taxa de prevalência de aleitamento materno exclusivo'],
    ['codigo' => 'D.21', 'nome' => 'Taxa de prevalência de fumantes regulares de cigarros'],
    ['codigo' => 'D.24', 'nome' => 'Taxa de prevalência de excesso de peso'],
    ['codigo' => 'D.25', 'nome' => 'Taxa de prevalência de consumo excessivo de álcool'],
    ['codigo' => 'D.26', 'nome' => 'Taxa de prevalência de atividade física insuficiente'],
    ['codigo' => 'D.27', 'nome' => 'Taxa de prevalência de hipertensão arterial'],
];
?>
<div class="container-bread-indicadores">
    <div class="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url('/fichasidb'); ?>">Fichas IDB</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a>Morbidade</a></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container">
    <div class="row indicators-page">
        <h2>D. Indicadores de Morbidade</h2>
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
