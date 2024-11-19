<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

$plugin = new CC_Plugin(); // Instancia o plugin

// Lista de indicadores com códigos e links
$indicadores = [
    ['codigo' => 'G.1', 'link' => 'g-fatores-risco-protecao/ficha?code='],
    ['codigo' => 'G.2', 'link' => 'g-fatores-risco-protecao/ficha?code='],
    ['codigo' => 'G.3', 'link' => 'g-fatores-risco-protecao/ficha?code='],
    ['codigo' => 'G.4', 'link' => 'g-fatores-risco-protecao/ficha?code=001FR'],
    ['codigo' => 'G.5', 'link' => 'g-fatores-risco-protecao/ficha?code='],
    ['codigo' => 'G.6', 'link' => 'g-fatores-risco-protecao/ficha?code='],
    ['codigo' => 'G.7', 'link' => 'g-fatores-risco-protecao/ficha?code='],
    ['codigo' => 'G.8', 'link' => 'g-fatores-risco-protecao/ficha?code='],
    ['codigo' => 'G.9', 'link' => 'g-fatores-risco-protecao/ficha?code='],
    ['codigo' => 'G.10', 'link' => 'g-fatores-risco-protecao/ficha?code='],
    ['codigo' => 'G.11', 'link' => 'g-fatores-risco-protecao/ficha?code='],
    ['codigo' => 'G.12', 'link' => 'g-fatores-risco-protecao/ficha?code='],
    ['codigo' => 'G.13', 'link' => 'g-fatores-risco-protecao/ficha?code='],
];
?>
<!-- Inclua a fonte Inter do Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">

<!-- Banner de Cabeçalho -->
<div class="header-banner">
    Fatores de Risco e Proteção
</div>
</br>
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
        <h2 class="green-title"><b>G. Indicadores de Fatores de Risco e Proteção</b></h2>
        <?php foreach ($indicadores as $indicador): ?>
            <?php
                // Obtenha o código diretamente da query string da URL, se existir
                $param_code = isset($indicador['link']) ? explode('code=', $indicador['link'])[1] : '';

                // Defina uma chave de cache única baseada no código do indicador
                $cache_key = 'indicador_' . $param_code;
                $cache_duration = 12 * HOUR_IN_SECONDS; // Cache por 12 horas

                // Tente buscar o dado do cache
                $data = get_transient($cache_key);

                // Se o cache não existir, faça a requisição à API e armazene no cache
                if ($data === false && !empty($param_code)) {
                    $data = $plugin->fetch_api_data($param_code);

                    // Armazene o resultado no cache
                    if (!empty($data)) {
                        set_transient($cache_key, $data, $cache_duration);
                    }
                }

                // Use o título retornado pela API, ou mostre uma mensagem de erro caso não haja
                $titulo = isset($data['titulo']) ? $data['titulo'] : '';

                // Remova os primeiros caracteres redundantes, se o título começar com o código
                if (strpos($titulo, $indicador['codigo']) === 0) {
                    $titulo = substr($titulo, strlen($indicador['codigo']) + 1);
                }

                // Construa o link da página ou utilize o link padrão
                $link = isset($indicador['link']) ? $indicador['link'] : '#';

                // Verifique se o código está vazio para desativar o botão
                $is_disabled = empty($param_code);
            ?>
            <button class="btn-indicator <?php echo $is_disabled ? 'disabled' : ''; ?>" 
                    onclick="<?php echo $is_disabled ? 'return false;' : "window.location.href='{$link}';"; ?>"
                    <?php echo $is_disabled ? 'disabled' : ''; ?>>
                <div class="indicator-code"><?php echo $indicador['codigo']; ?></div>
                <div class="indicator-name"><?php echo $titulo; ?></div>
            </button>
        <?php endforeach; ?>
    </div>
</div>

<style>
    .btn-indicator.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>

<?php
// Inclua o rodapé e outras partes do template conforme necessário
get_footer();
?>
