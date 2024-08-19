<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

// Instancie o plugin e obtenha os dados
$plugin = new CC_Plugin();
$data = $plugin->fetch_api_data();

$codigo = $data['codigo'];
$ultimosTresCaracteres = substr($codigo, -3); // Pega os 3 últimos caracteres

// Processamento de pesquisa
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$searchYear = isset($_GET['year']) ? intval($_GET['year']) : '';

$indicadores = [
    ['letra' => 'A', 'icone' => 'fa-users', 'nome' => 'Demográfico', 'descricao' => 'Indicadores que medem a distribuição de fatores determinantes da situação de saúde.', 'link' => 'listas'],
    ['letra' => 'B', 'icone' => 'fa-hand-holding-heart', 'nome' => 'Socioeconômicos', 'descricao' => 'Indicadores que medem a situação de saúde relacionada ao perfil econômico e social.', 'link' => 'listas'],
    ['letra' => 'C', 'icone' => 'fa-heartbeat', 'nome' => 'Morbidade', 'descricao' => 'Indicadores que informam a ocorrência e distribuição de doenças.', 'link' => 'listas'],
    ['letra' => 'D', 'icone' => 'fa-cross', 'nome' => 'Mortalidade', 'descricao' => 'Indicadores que informam a ocorrência e distribuição das causas de óbito.', 'link' => 'listas'],
    ['letra' => 'E', 'icone' => 'fa-hospital', 'nome' => 'Cobertura', 'descricao' => 'Indicadores que medem o grau de utilização dos meios oferecidos pelo setor público.', 'link' => 'listas'],
    ['letra' => 'F', 'icone' => 'fa-stethoscope', 'nome' => 'Recursos', 'descricao' => 'Indicadores que medem a oferta e demanda de recursos humanos e financeiros.', 'link' => 'listas'],
    ['letra' => 'G', 'icone' => 'fa-smoking-ban', 'nome' => 'Fatores de Risco', 'descricao' => 'Indicadores que medem os fatores de risco como tabaco e álcool.', 'link' => 'listas'],
];

?>

<div class="container">
    <div class="row indicators-page">
        <?php foreach ($indicadores as $indicador): ?>
            <a href="<?php echo site_url('indicators/' . $indicador['link']); ?>" class="indicator-box">
                <div class="indicator-letter"><?php echo $indicador['letra']; ?></div>
                <div class="indicator-content">
                    <i class="fa <?php echo $indicador['icone']; ?> fa-2x"></i>
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
