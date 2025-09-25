<?php
get_header();

$plugin = new IDB_Plugin(); // Instancia o plugin
$indicadores = $plugin->fetch_api_lista_indicadores('RIPSA - Fatores de risco e proteção'); // Obtém os dados da API para a categoria "Fatores de risco e proteção"

if ($indicadores) {
    usort($indicadores, function ($a, $b) {
        return strnatcmp($a['prefixo'], $b['prefixo']);
    });
}

$dimensoes = [
    'FRP.1' => 'Doenças crônicas',
    'FRP.2' => 'Consumo de álcool',
    'FRP.3' => 'Tabagismo',
    'FRP.4' => 'Atividade física',
    'FRP.5' => 'Estado nutricional',
    'FRP.6' => 'Consumo alimentar',
    'FRP.7' => 'Parto',
    'FRP.8' => 'Violência',
    'FRP.9' => 'Saúde bucal'
];

$grupos = [];
foreach ($indicadores as $indicador) {
    $titulo = $indicador['titulo'];
    $prefixo = $indicador['prefixo'];

    if (preg_match('/^(FRP\.\d)/', $prefixo, $match_dim)) {
        $dimensao = $match_dim[1] ?? 'Outros';
        $grupos[$dimensao][] = $indicador;
    }
}
$category_name = "Fatores de risco e proteção";
$category_image = "fatores_de_risco.png";

include('category-page.php');

get_footer();
?>