<?php
get_header();

$plugin = new IDB_Plugin(); // Instancia o plugin
$indicadores = $plugin->fetch_api_lista_indicadores('RIPSA - Recursos'); // Obtém os dados da API para a categoria "Recursos"

if ($indicadores) {
    usort($indicadores, function ($a, $b) {
        return strnatcmp($a['titulo'], $b['titulo']);
    });
}

$dimensoes = [
    'REC.1' => 'Recursos humanos',
    'REC.2' => 'Capacidade instalada',
    'REC.3' => 'Recursos Financeiros - assistência à saúde',
    'REC.4' => 'Recursos Financeiros - despesas em saúde',
    'REC.5' => 'Recursos Financeiros - gasto com saneamento',
    'REC.6' => 'Recursos Financeiros - bens e serviços'
];

$grupos = [];
foreach ($indicadores as $indicador) {
    $titulo = $indicador['titulo'];

    // Extract the code from the title
    if (preg_match('/^([^–-]+)\s*[–-]\s*(.+)$/u', $titulo, $match_code)) {
        $codigo = trim($match_code[1]);
    }

    if (preg_match('/^(REC\.\d)/', $codigo, $match_dim)) {
        $dimensao = $match_dim[1] ?? 'Outros';
        $grupos[$dimensao][] = $indicador;
    }
}
$category_name = "Recursos";
$category_image = "recursos.png";

include('category-page.php');

get_footer();
?>