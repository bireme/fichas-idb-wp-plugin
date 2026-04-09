<?php
get_header();

$plugin = new IDB_Plugin(); // Instancia o plugin
$indicadores = $plugin->fetch_api_lista_indicadores('RIPSA - Cobertura'); // Obtém os dados da API para a categoria "Cobertura"

if ($indicadores) {
    usort($indicadores, function ($a, $b) {
        return strnatcmp($a['prefixo'], $b['prefixo']);
    });
}
$dimensoes = [
    'COB.1' => 'Consultas médicas e odontológicas',
    'COB.2' => 'Internações Hospitalares',
    'COB.3' => 'Saúde da mulher',
    'COB.4' => 'Assistência ao parto e saúde reprodutiva',
    'COB.5' => 'Cobertura por planos de saúde'
];

$grupos = [];
foreach ($indicadores as $indicador) {
    $titulo = $indicador['titulo'];
    $prefixo = $indicador['prefixo'];

    if (preg_match('/^(COB\.\d)/', $prefixo, $match_dim)) {
        $dimensao = $match_dim[1] ?? 'Outros';
        $grupos[$dimensao][] = $indicador;
    }
}
$category_name = "Cobertura";
$category_image = "cobertura.png";

include('category-page.php');
include('remover-links.php');

get_footer();
?>