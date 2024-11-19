<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

$plugin = new CC_Plugin(); // Instancia o plugin

// Lista de indicadores com códigos e links
$indicadores = [
    ['codigo' => 'B.1', 'link' => 'b-socioeconomicos/ficha?code=001SC'],
    ['codigo' => 'B.2', 'link' => 'b-socioeconomicos/ficha?code=002SC'],
    ['codigo' => 'B.3', 'link' => 'b-socioeconomicos/ficha?code='],
    ['codigo' => 'B.4', 'link' => 'b-socioeconomicos/ficha?code='],
    ['codigo' => 'B.5', 'link' => 'b-socioeconomicos/ficha?code='],
    ['codigo' => 'B.6', 'link' => 'b-socioeconomicos/ficha?code='],
    ['codigo' => 'B.7', 'link' => 'b-socioeconomicos/ficha?code='],
    ['codigo' => 'B.X', 'link' => 'b-socioeconomicos/ficha?code=003SC'],
    ['codigo' => 'B.X', 'link' => 'b-socioeconomicos/ficha?code=004SC'],
    ['codigo' => 'B.X', 'link' => 'b-socioeconomicos/ficha?code=005SC'],
    ['codigo' => 'B.X', 'link' => 'b-socioeconomicos/ficha?code=006SC'],
    ['codigo' => 'B.X', 'link' => 'b-socioeconomicos/ficha?code=007SC'],
];
?>

<!-- Inclua a fonte Inter do Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">

<!-- Banner de Cabeçalho -->
<div class="header-banner">
    Socioeconômicos
</div>
</br>
<div class="container-bread-indicadores">
    <div class="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <!-- Link para Home -->
                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                <!-- Link para Fichas IDB -->
                <li class="breadcrumb-item"><a href="<?php echo site_url('/fichasidb'); ?>">Fichas IDB</a></li>
                <!-- Link para indicadores Socioeconômicos -->
                <li class="breadcrumb-item active" aria-current="page"><a>Socioeconômicos</a></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container">
    <div class="row indicators-page">
        <h2 class="green-title"><b>B. Indicadores Socioeconômicos</b></h2>
        <?php foreach ($indicadores as $indicador): ?>
            <?php
                // Obtenha o código diretamente da query string da URL
                $param_code = isset($indicador['link']) ? explode('code=', $indicador['link'])[1] : '';

                // Defina uma chave de cache exclusiva para cada código de indicador
                $cache_key = 'indicador_' . $param_code;
                $cache_duration = 12 * HOUR_IN_SECONDS; // Cache por 12 horas

                // Tente obter os dados do cache
                $data = get_transient($cache_key);

                // Se o cache estiver vazio, faça a requisição à API e armazene os dados
                if ($data === false && !empty($param_code)) {
                    $data = $plugin->fetch_api_data($param_code);
                    if (!empty($data)) {
                        // Armazene o resultado da API no cache
                        set_transient($cache_key, $data, $cache_duration);
                    }
                }

                // Use o título retornado pela API, ou mostre uma mensagem de erro caso não haja
                $titulo = isset($data['titulo']) ? $data['titulo'] : '';

                // Remove os primeiros caracteres redundantes, se o título começar com o código
                if (strpos($titulo, $indicador['codigo']) === 0) {
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
