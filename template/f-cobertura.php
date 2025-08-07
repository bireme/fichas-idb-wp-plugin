<?php
get_header();

$plugin = new IDB_Plugin(); // Instancia o plugin
$indicadores = $plugin->fetch_api_lista_indicadores('RIPSA - Cobertura'); // Obtém os dados da API para a categoria "Cobertura"

if ($indicadores) {
    usort($indicadores, function ($a, $b) {
        return strnatcmp($a['titulo'], $b['titulo']);
    });
}
$dimensoes = [
    'COB.1' => 'Consultas médicas e odontológicas',
    'COB.2' => 'Vacinação',
    'COB.3' => 'Internações hospitalares',
    'COB.4' => 'Saúde da mulher',
    'COB.5' => 'Assistência ao parto e saúde reprodutiva',
    'COB.6' => 'Cobertura por planos de saúde'
];

$grupos = [];
foreach ($indicadores as $indicador) {
    $titulo = $indicador['titulo'];

    // Extract the code from the title
    if (preg_match('/^([^–-]+)\s*[–-]\s*(.+)$/u', $titulo, $match_code)) {
        $codigo = trim($match_code[1]);
    }

    if (preg_match('/^(COB\.\d)/', $codigo, $match_dim)) {
        $dimensao = $match_dim[1] ?? 'Outros';
        $grupos[$dimensao][] = $indicador;
    }
}
$category_name = "Cobertura";
$category_image = "cobertura.png";

include('category-page.php');

get_footer();
?>