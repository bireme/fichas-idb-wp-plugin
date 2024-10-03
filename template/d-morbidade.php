<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

$plugin = new CC_Plugin(); // Instancia o plugin

// Lista de indicadores com códigos e links
$indicadores = [
    ['codigo' => 'D.1.1', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.1.2', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.1.3', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.1.4', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.1.5', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.1.6', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.1.7', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.1.8', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.1.14', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.1.9', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.1.10', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.1.11', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.1.12', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.1.13', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.1.15', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.2.1', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.2.2', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.2.3', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.2.4', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.2.5', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.3', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.4', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.5', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.6', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.7', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.8', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.9', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.10', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.12', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.28', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.13', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.14', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.23', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.22', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.15', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.16', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.17', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.19', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.20', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.21', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.24', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.25', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.26', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.27', 'link' => 'd-morbidade/ficha?code='],
    ['codigo' => 'D.XX', 'link' => 'd-morbidade/ficha?code=001MB'],
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

                // Construa o link da página ou utilize o código padrão
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
