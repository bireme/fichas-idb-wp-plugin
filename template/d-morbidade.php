<?php
get_header();

$plugin = new IDB_Plugin(); // Instancia o plugin
$indicadores = $plugin->fetch_api_lista_indicadores('RIPSA - Morbidade'); // Obtém os dados da API para a categoria "Morbidade"

if ($indicadores) {
    usort($indicadores, function ($a, $b) {
        return strnatcmp($a['titulo'], $b['titulo']);
    });
}

$dimensoes = [
    'MRB.1' => 'Incidência de doenças transmissíveis',
    'MRB.2' => 'Taxa de incidência de doenças transmissíveis',
    'MRB.3' => 'Prevalência de exposição em doenças transmissíveis',
    'MRB.4' => 'Doenças não transmissíveis',
    'MRB.5' => 'Acidentes e doenças do trabalho',
    'MRB.6' => 'Morbidade hospitalar'
];

$grupos = [];
foreach ($indicadores as $indicador) {
    $titulo = $indicador['titulo'];

    // Extract the code from the title
    if (preg_match('/^([^–-]+)\s*[–-]\s*(.+)$/u', $titulo, $match_code)) {
        $codigo = trim($match_code[1]);
    }

    if (preg_match('/^(MRB\.\d)/', $codigo, $match_dim)) {
        $dimensao = $match_dim[1] ?? 'Outros';
        $grupos[$dimensao][] = $indicador;
    }
}
$category_name = "Morbidade";
$category_image = "morbidade.png";

include('category-page.php');

get_footer();
?>