<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

$plugin = new CC_Plugin(); // Instancia o plugin

// Lista de indicadores com códigos e links
$indicadores = [
    ['codigo' => 'E.1', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.2', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.3', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.4', 'link' => 'e-recursos/ficha?code=002RC'],
    ['codigo' => 'E.6.1', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.6.2', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.7', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.8', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.9', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.10', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.11', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.12', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.13', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.14', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.15', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.16', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.17', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.22', 'link' => 'e-recursos/ficha?code=001RC'],
    ['codigo' => 'E.6.1', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.7', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.12', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.13', 'link' => 'e-recursos/ficha?code='],
    ['codigo' => 'E.9', 'link' => 'e-recursos/ficha?code='],
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
            <?php
                // Obtenha o código diretamente da query string da URL, se existir
                $param_code = isset($indicador['link']) ? explode('code=', $indicador['link'])[1] : '';
                
                // Chame a API e obtenha os dados para o código atual da ficha, caso o código exista
                $data = !empty($param_code) ? $plugin->fetch_api_data($param_code) : null;
                
                // Use o título retornado pela API, ou mostre uma mensagem de erro caso não haja
                $titulo = isset($data['titulo']) ? $data['titulo'] : 'Título não encontrado';

                // Remova os primeiros caracteres redundantes, se o título começar com o código
                if (strpos($titulo, $indicador['codigo']) === 0) {
                    $titulo = substr($titulo, strlen($indicador['codigo']) + 1);
                }

                // Construa o link da página ou utilize o link padrão
                $link = isset($indicador['link']) ? $indicador['link'] : '#';
            ?>
            <button class="btn-indicator" 
                    onclick="window.location.href='<?php echo $link; ?>';">
                <div class="indicator-code"><?php echo $indicador['codigo']; ?></div>
                <div class="indicator-name"><?php echo $titulo; ?></div>
            </button>
        <?php endforeach; ?>
    </div>
</div>

<?php
// Inclua o rodapé e outras partes do template conforme necessário
get_footer();
?>
