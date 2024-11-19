<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

// Processamento de pesquisa
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$searchYear = isset($_GET['year']) ? intval($_GET['year']) : '';

$plugin_path = plugin_dir_url(__FILE__) . 'images/icons/';

$indicadores = [
    ['letra' => 'A', 'icone' => 'demografico.png', 'nome' => 'Demográfico', 'descricao' => 'Indicadores que medem a distribuição de fatores determinantes da situação de saúde, relacionados à dinâmica populacional em uma área geográfica referida.', 'link' => 'a-demografico'],
    ['letra' => 'B', 'icone' => 'socioeconomico.png', 'nome' => 'Socioeconômicos', 'descricao' => 'Indicadores que medem a distribuição dos fatores determinantes da situação de saúde relacionados ao perfil econômico e social da população residente em uma área geográfica referida.', 'link' => 'b-socioeconomicos'],
    ['letra' => 'C', 'icone' => 'mortalidade.png', 'nome' => 'Mortalidade', 'descricao' => 'Indicadores que informam a ocorrência e distribuição das causas de óbito no perfil da mortalidade da população residente em uma área geográfica referida.', 'link' => 'c-mortalidade'],
    ['letra' => 'D', 'icone' => 'morbidade.png', 'nome' => 'Morbidade', 'descricao' => 'Indicadores que informam a ocorrência e distribuição de doenças e agravos à saúde na população residente em uma área geográfica referida.', 'link' => 'd-morbidade'],
    ['letra' => 'E', 'icone' => 'recursos.png', 'nome' => 'Recursos', 'descricao' => 'Indicadores que medem a oferta e a demanda de recursos humanos, físicos e financeiros para atendimento às necessidades básicas de saúde da população em uma área geográfica referida.', 'link' => 'e-recursos'],
    ['letra' => 'F', 'icone' => 'cobertura.png', 'nome' => 'Cobertura', 'descricao' => 'Indicadores que medem o grau de utilização dos meios oferecidos pelo setor público e pelo setor privado para atender às necessidades de saúde da população em uma área geográfica referida.', 'link' => 'f-cobertura'],
    ['letra' => 'G', 'icone' => 'fatores_de_risco.png', 'nome' => 'Fatores de Risco e Proteção', 'descricao' => 'Indicadores que medem os fatores de risco (por ex. tabaco, álcool), e/ou proteção (por ex. alimentação saudável, atividade física, aleitamento) que predispõe a doenças e agravos ou protegem das doenças e agravos.', 'link' => 'g-fatores-risco-protecao'],
];

?>

<!-- Inclua a fonte Inter do Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">

<!-- Banner de Cabeçalho -->
<div class="header-banner">
    Fichas de Indicadores de Desenvolvimento Básico
</div>
</br>
<div class="container-bread-indicadores">
    <div class="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a>Fichas IDB</a></li>
            </ol>
        </nav>
    </div>
</div>

<div class="container">
    <div class="row indicators-page">
        <?php foreach ($indicadores as $indicador): ?>
            <a href="<?php echo site_url('fichasidb/' . $indicador['link']); ?>" class="indicator-box">
                <div class="indicator-letter highlight-letter"><?php echo $indicador['letra']; ?></div>
                <div class="indicator-content">
                    <img src="<?php echo $plugin_path . $indicador['icone']; ?>" alt="<?php echo $indicador['nome']; ?>" class="indicator-icon" />
                    <div>
                        <h3><?php echo $indicador['nome']; ?></h3>
                        <p><?php echo $indicador['descricao']; ?></p>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<?php
// Inclua o rodapé e outras partes do template conforme necessário
get_footer();
?>
