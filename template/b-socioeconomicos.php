<?php
get_header();

$plugin = new IDB_Plugin(); // Instancia o plugin
$indicadores = $plugin->fetch_api_lista_indicadores('RIPSA - Socioeconômico'); // Obtém os dados da API para a categoria "Socioeconômico"

if ($indicadores) {
    usort($indicadores, function ($a, $b) {
        return strnatcmp($a['prefixo'], $b['prefixo']);
    });
}

$dimensoes = [
    'SOC.1' => 'Educação',
    'SOC.2' => 'Ocupação da força de trabalho',
    'SOC.3' => 'Renda',
    'SOC.4' => 'Saneamento',
    'SOC.5' => 'Segurança alimentar',
];

$grupos = [];
foreach ($indicadores as $indicador) {
    $titulo = $indicador['titulo'];
    $prefixo = $indicador['prefixo'];

    if (preg_match('/^(SOC\.\d)/', $prefixo, $match_dim)) {
        $dimensao = $match_dim[1] ?? 'Outros';
        $grupos[$dimensao][] = $indicador;
    }
}
$category_name = "Socioeconômico";
$category_image = "socioeconomico.png";

include('category-page.php');
include('remover-links.php');

get_footer();
?>