<?php
get_header();

$plugin = new IDB_Plugin(); // Instancia o plugin
$indicadores = $plugin->fetch_api_lista_indicadores('RIPSA - Demográfico'); // Obtém os dados da API para a categoria "Demográfico"

if ($indicadores) {
    usort($indicadores, function ($a, $b) {
        return strnatcmp($a['titulo'], $b['titulo']);
    });
}

$dimensoes = [
    'DEM.1' => 'População',
    'DEM.2' => 'Fecundidade e natalidade',
    'DEM.3' => 'Mortalidade',
    'DEM.4' => 'Cobertura dos sistemas de informaçoes de nascidos vivos (Sinasc) e de mortalidade (SIM) do Ministério da Saúde'
];

$grupos = [];
foreach ($indicadores as $indicador) {
    $titulo = $indicador['titulo'];

    // Extract the code from the title
    if (preg_match('/^([^–-]+)\s*[–-]\s*(.+)$/u', $titulo, $match_code)) {
        $codigo = trim($match_code[1]);
    }

    if (preg_match('/^(DEM\.\d)/', $codigo, $match_dim)) {
        $dimensao = $match_dim[1] ?? 'Outros';
        $grupos[$dimensao][] = $indicador;
    }
}
$category_name = "Demográfico";
$category_image = "demografico.png";

include('category-page.php');

get_footer();
?>