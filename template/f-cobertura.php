<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

$plugin = new CC_Plugin(); // Instancia o plugin

// Lista de indicadores com códigos e links
$indicadores = [
    ['codigo' => 'F.1', 'link' => 'f-cobertura/ficha?code='],
    ['codigo' => 'F.2', 'link' => 'f-cobertura/ficha?code='],
    ['codigo' => 'F.3', 'link' => 'f-cobertura/ficha?code='],
    ['codigo' => 'F.5', 'link' => 'f-cobertura/ficha?code='],
    ['codigo' => 'F.6', 'link' => 'f-cobertura/ficha?code='],
    ['codigo' => 'F.7', 'link' => 'f-cobertura/ficha?code='],
    ['codigo' => 'F.8', 'link' => 'f-cobertura/ficha?code='],
    ['codigo' => 'F.10', 'link' => 'f-cobertura/ficha?code='],
    ['codigo' => 'F.11', 'link' => 'f-cobertura/ficha?code='],
    ['codigo' => 'F.13', 'link' => 'f-cobertura/ficha?code='],
    ['codigo' => 'F.14', 'link' => 'f-cobertura/ficha?code='],
    ['codigo' => 'F.15', 'link' => 'f-cobertura/ficha?code='],
    ['codigo' => 'F.16', 'link' => 'f-cobertura/ficha?code=001CB'],
    ['codigo' => 'F.17', 'link' => 'f-cobertura/ficha?code='],
    ['codigo' => 'F.18', 'link' => 'f-cobertura/ficha?code='],
    ['codigo' => 'F.19', 'link' => 'f-cobertura/ficha?code='],
    ['codigo' => 'F1', 'link' => 'f-cobertura/ficha?code='],
    ['codigo' => 'F2', 'link' => 'f-cobertura/ficha?code='],
    ['codigo' => 'F13', 'link' => 'f-cobertura/ficha?code='],
];
?>
<div class="container-bread-indicadores">
    <div class="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url('/fichasidb'); ?>">Fichas IDB</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a>Cobertura</a></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container">
    <div class="row indicators-page">
        <h2>F. Indicadores de Cobertura</h2>
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
