<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

$plugin = new CC_Plugin(); // Instancia o plugin

// Lista de indicadores com códigos
$indicadores = [
    ['codigo' => 'A.1', 'link' => 'a-demografico/ficha?code='],
    ['codigo' => 'A.2', 'link' => 'a-demografico/ficha?code=008DM'],
    ['codigo' => 'A.3', 'link' => 'a-demografico/ficha?code='],
    ['codigo' => 'A.4', 'link' => 'a-demografico/ficha?code='],
    ['codigo' => 'A.13', 'link' => 'a-demografico/ficha?code=004DM'],
    ['codigo' => 'A.14', 'link' => 'a-demografico/ficha?code=005DM'],
    ['codigo' => 'A.15', 'link' => 'a-demografico/ficha?code=006DM'],
    ['codigo' => 'A.16', 'link' => 'a-demografico/ficha?code=007DM'],
    ['codigo' => 'A.5', 'link' => 'a-demografico/ficha?code='],
    ['codigo' => 'A.6', 'link' => 'a-demografico/ficha?code='],
    ['codigo' => 'A.7', 'link' => 'a-demografico/ficha?code='],
    ['codigo' => 'A.8', 'link' => 'a-demografico/ficha?code='],
    ['codigo' => 'A.9', 'link' => 'a-demografico/ficha?code='],
    ['codigo' => 'A.10', 'link' => 'a-demografico/ficha?code=001DM'],
    ['codigo' => 'A.11', 'link' => 'a-demografico/ficha?code=002DM'],
    ['codigo' => 'A.12', 'link' => 'a-demografico/ficha?code=003DM'],
];
?>
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
        <h2>A. Indicadores Demográficos</h2>
        <?php foreach ($indicadores as $indicador): ?>
            <?php
                // Obtenha o código diretamente da query string da URL
                $param_code = isset($indicador['link']) ? explode('code=', $indicador['link'])[1] : '';
                
                // Chame a API e obtenha os dados para o código atual da ficha
                $data = $plugin->fetch_api_data($param_code);
                
                // Use o título retornado pela API, ou mostre uma mensagem de erro caso não haja
                $titulo = isset($data['titulo']) ? $data['titulo'] : 'Título não encontrado';

                // Remove os primeiros caracteres redundantes, se o título começar com o código
                if (strpos($titulo, $indicador['codigo']) === 0) {
                    // O número 4 é apenas um exemplo, ajuste conforme o tamanho típico dos códigos
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
