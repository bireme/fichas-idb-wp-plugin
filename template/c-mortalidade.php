<?php
get_header();

$plugin = new IDB_Plugin(); // Instancia o plugin
$indicadores = $plugin->fetch_api_lista_indicadores('RIPSA - Mortalidade'); // Obtém os dados da API para a categoria "Mortalidade"

if ($indicadores) {
    usort($indicadores, function ($a, $b) {
        return strnatcmp($a['titulo'], $b['titulo']);
    });
}

$dimensoes = [
    'MRT.1' => 'Mortalidade infantil e na infância',
    'MRT.2' => 'Mortalidade materna',
    'MRT.3' => 'Mortalidade geral',
    'MRT.4' => 'Mortalidade por causas externas',
    'MRT.5' => 'Mortalidade por doenças crônicas não transmissíveis',
    'MRT.6' => 'Mortalidade por doenças crônicas transmissíveis'
];

$grupos = [];
foreach ($indicadores as $indicador) {
    $titulo = $indicador['titulo'];

    // Extract the code from the title
    if (preg_match('/^([^–-]+)\s*[–-]\s*(.+)$/u', $titulo, $match_code)) {
        $codigo = trim($match_code[1]);
    }

    if (preg_match('/^(MRT\.\d)/', $codigo, $match_dim)) {
        $dimensao = $match_dim[1] ?? 'Outros';
        $grupos[$dimensao][] = $indicador;
    }
}
$category_name = "Mortalidade";
$category_image = "mortalidade.png";

include('category-page.php');

get_footer();
?>