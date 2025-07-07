<?php
get_header();

$plugin_path = plugin_dir_url(__FILE__) . 'images/icons/';

$indicadores = [
    ['letra' => 'F', 'icone' => 'cobertura.png', 'nome' => 'Cobertura', 'link' => 'f-cobertura'],
    ['letra' => 'DEM', 'icone' => 'demografico.png', 'nome' => 'Demográfico', 'link' => 'a-demografico'],
    ['letra' => 'G', 'icone' => 'fatores_de_risco.png', 'nome' => 'Fatores de Risco e Proteção', 'link' => 'g-fatores-risco-protecao'],
    ['letra' => 'D', 'icone' => 'morbidade.png', 'nome' => 'Morbidade', 'link' => 'd-morbidade'],
    ['letra' => 'C', 'icone' => 'mortalidade.png', 'nome' => 'Mortalidade', 'link' => 'c-mortalidade'],
    ['letra' => 'E', 'icone' => 'recursos.png', 'nome' => 'Recursos', 'link' => 'e-recursos'],
    ['letra' => 'B', 'icone' => 'socioeconomico.png', 'nome' => 'Socioeconômico', 'link' => 'b-socioeconomicos'],
];
?>

<!-- Estilos -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f5f7fa;
        color: #1a1a1a;
    }

    .breadcrumb {
        background-color: #f5f7fa;
    }

    .header-banner {
        text-align: center;
        font-size: 28px;
        font-weight: 700;
        margin: 40px 0 20px;
        color: #ffffff;
    }

    .indicators-section {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px 60px;
        display: flex;
        flex-direction: column;
        gap: 50px;
    }

    .indicators-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px;
    }

    .indicators-row:last-child {
        margin-top: 40px;
        gap: 40px;
    }

    .indicator-card {
        width: 220px;
        text-align: center;
        text-decoration: none;
        transition: transform 0.2s ease;
    }

    .indicator-card:hover {
        transform: translateY(-4px);
    }

    .indicator-icon-circle {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 4px solid #2e7d32;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
        background-color: white;
    }

    .indicator-card.active .indicator-icon-circle {
        border-color: #2e318f;
    }

    .indicator-icon-circle img {
        width: 72px;
        height: 72px;
        object-fit: contain;
    }

    .indicator-label {
        background-color: #2e7d32;
        color: white;
        border-radius: 30px;
        padding: 10px 16px;
        font-size: 14px;
        font-weight: 600;
        display: inline-block;
        transition: background-color 0.3s ease;
        white-space: nowrap;
        max-width: 100%;
        text-align: center;
    }

    .indicator-card:hover .indicator-label,
    .indicator-card.active .indicator-label {
        background-color: #2e318f;
    }

    /* Último indicador: força o texto inteiro em uma linha */
    .last-indicator .indicator-label {
        white-space: nowrap;
        overflow: visible;
        text-overflow: unset;
        font-size: 15px;
        max-width: 260px;
        text-align: center;
    }

    @media (max-width: 768px) {
        .indicator-card {
            width: 100%;
        }

        .indicator-label {
            font-size: 14px;
        }

        .last-indicator .indicator-label {
            font-size: 14px;
        }
    }
</style>

<!-- Conteúdo -->
<div class="header-banner">Fichas de Qualificação dos Indicadores (FQI)</div>

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

<div class="indicators-section">
    <div class="indicators-row">
        <?php foreach (array_slice($indicadores, 0, 4) as $indicador): ?>
            <?php $is_active = $indicador['letra'] === $indicador_ativo; ?>
            <a href="<?php echo site_url($idb_plugin_slug . '/' . $indicador['link']); ?>" class="indicator-card <?php echo $is_active ? 'active' : ''; ?>">
                <div class="indicator-icon-circle">
                    <img src="<?php echo $plugin_path . $indicador['icone']; ?>" alt="<?php echo $indicador['nome']; ?>" />
                </div>
                <div class="indicator-label"><?php echo $indicador['nome']; ?></div>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="indicators-row">
        <?php foreach (array_slice($indicadores, 4) as $i => $indicador): ?>
            <?php
                $is_active = $indicador['letra'] === $indicador_ativo;
                $is_last = $i === 2 ? 'last-indicator' : '';
            ?>
            <a href="<?php echo site_url($idb_plugin_slug . '/' . $indicador['link']); ?>" class="indicator-card <?php echo $is_active ? 'active' : ''; ?> <?php echo $is_last; ?>">
                <div class="indicator-icon-circle">
                    <img src="<?php echo $plugin_path . $indicador['icone']; ?>" alt="<?php echo $indicador['nome']; ?>" />
                </div>
                <div class="indicator-label"><?php echo $indicador['nome']; ?></div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<?php get_footer(); ?>
