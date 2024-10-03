<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

$plugin = new CC_Plugin(); // Instancia o plugin

// Lista de indicadores com códigos e links
$indicadores = [
    ['codigo' => 'C.1', 'link' => 'c-mortalidade/ficha?code='],
    ['codigo' => 'C.1.1', 'link' => 'c-mortalidade/ficha?code='],
    ['codigo' => 'C.1.2', 'link' => 'c-mortalidade/ficha?code='],
    ['codigo' => 'C.1.3', 'link' => 'c-mortalidade/ficha?code='],
    ['codigo' => 'C.2', 'link' => 'c-mortalidade/ficha?code='],
    ['codigo' => 'C.16', 'link' => 'c-mortalidade/ficha?code='],
    ['codigo' => 'C.3', 'link' => 'c-mortalidade/ficha?code=001MT'],
    ['codigo' => 'C.4', 'link' => 'c-mortalidade/ficha?code='],
    ['codigo' => 'C.5', 'link' => 'c-mortalidade/ficha?code='],
    ['codigo' => 'C.6', 'link' => 'c-mortalidade/ficha?code='],
    ['codigo' => 'C.7', 'link' => 'c-mortalidade/ficha?code='],
    ['codigo' => 'C.8', 'link' => 'c-mortalidade/ficha?code='],
    ['codigo' => 'C.9', 'link' => 'c-mortalidade/ficha?code='],
    ['codigo' => 'C.10', 'link' => 'c-mortalidade/ficha?code='],
    ['codigo' => 'C.11', 'link' => 'c-mortalidade/ficha?code='],
    ['codigo' => 'C.12', 'link' => 'c-mortalidade/ficha?code='],
    ['codigo' => 'C.14', 'link' => 'c-mortalidade/ficha?code='],
    ['codigo' => 'C.15', 'link' => 'c-mortalidade/ficha?code='],
    ['codigo' => 'C.17', 'link' => 'c-mortalidade/ficha?code='],
    ['codigo' => 'C.3', 'link' => 'c-mortalidade/ficha?code='],
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
            <?php
                // Obtenha o código diretamente da query string da URL
                $param_code = isset($indicador['link']) ? explode('code=', $indicador['link'])[1] : '';
                
                // Chame a API e obtenha os dados para o código atual da ficha, se houver código
                $data = !empty($param_code) ? $plugin->fetch_api_data($param_code) : null;

                // Use o título retornado pela API, ou mostre uma mensagem de erro caso não haja
                $titulo = isset($data['titulo']) ? $data['titulo'] : 'Título não encontrado';

                // Remove os primeiros caracteres redundantes, se o título começar com o código
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
