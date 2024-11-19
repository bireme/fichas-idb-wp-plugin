<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

$plugin = new CC_Plugin(); // Instancia o plugin

// Lista de indicadores com códigos
$indicadores = [
    ['codigo' => 'A.1', 'link' => 'a-demografico/ficha?code=014DM'],
    ['codigo' => 'A.2', 'link' => 'a-demografico/ficha?code=008DM'],
    ['codigo' => 'A.3', 'link' => 'a-demografico/ficha?code=015DM'],
    ['codigo' => 'A.4', 'link' => 'a-demografico/ficha?code='],
    ['codigo' => 'A.13', 'link' => 'a-demografico/ficha?code=004DM'],
    ['codigo' => 'A.14', 'link' => 'a-demografico/ficha?code=005DM'],
    ['codigo' => 'A.15', 'link' => 'a-demografico/ficha?code=006DM'],
    ['codigo' => 'A.16', 'link' => 'a-demografico/ficha?code=007DM'],
    ['codigo' => 'A.5', 'link' => 'a-demografico/ficha?code='],
    ['codigo' => 'A.6', 'link' => 'a-demografico/ficha?code='],
    ['codigo' => 'A.7', 'link' => 'a-demografico/ficha?code=011DM'],
    ['codigo' => 'A.8', 'link' => 'a-demografico/ficha?code='],
    ['codigo' => 'A.9', 'link' => 'a-demografico/ficha?code='],
    ['codigo' => 'A.10', 'link' => 'a-demografico/ficha?code=001DM'],
    ['codigo' => 'A.11', 'link' => 'a-demografico/ficha?code=002DM'],
    ['codigo' => 'A.12', 'link' => 'a-demografico/ficha?code=003DM'],
    ['codigo' => 'A.XX', 'link' => 'a-demografico/ficha?code=009DM'],
    ['codigo' => 'A.XX', 'link' => 'a-demografico/ficha?code=010DM'],
    ['codigo' => 'A.XX', 'link' => 'a-demografico/ficha?code=012DM'],
    ['codigo' => 'A.XX', 'link' => 'a-demografico/ficha?code=013DM'],
];

// Função para obter dados da API com cache
function get_cached_api_data($param_code, $plugin) {
    $cache_key = 'api_data_' . $param_code; // Gera uma chave única para o cache
    $cache_duration = 12 * HOUR_IN_SECONDS; // Define o tempo de cache em 12 horas

    // Verifica se os dados já estão no cache
    $data = get_transient($cache_key);

    if ($data === false) {
        // Se não houver dados no cache, faz a requisição à API
        $data = $plugin->fetch_api_data($param_code);

        // Armazena os dados no cache
        set_transient($cache_key, $data, $cache_duration);
    }

    return $data;
}
?>

<!-- Inclua a fonte Inter do Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">

<!-- Banner de Cabeçalho -->
<div class="header-banner">
    Demográfico
</div>
</br>
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
    <h2 class="green-title"><b>A. Indicadores Demográficos</b></h2>
        <?php foreach ($indicadores as $indicador): ?>
            <?php
                // Obtenha o código diretamente da query string da URL
                $param_code = isset($indicador['link']) ? explode('code=', $indicador['link'])[1] : '';

                // Obtém os dados do cache ou faz uma requisição à API, se necessário
                $data = get_cached_api_data($param_code, $plugin);
                
                // Use o título retornado pela API, ou mostre uma mensagem de erro caso não haja
                $titulo = isset($data['titulo']) ? $data['titulo'] : '';

                // Remove os primeiros caracteres redundantes, se o título começar com o código
                if (strpos($titulo, $indicador['codigo']) === 0) {
                    // O número 4 é apenas um exemplo, ajuste conforme o tamanho típico dos códigos
                    $titulo = substr($titulo, strlen($indicador['codigo']) + 1);
                }

                // Construa o link da página ou utilize o código padrão
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
