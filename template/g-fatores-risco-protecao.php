<?php
get_header();

$plugin = new IDB_Plugin(); // Instancia o plugin
$indicadores = $plugin->fetch_api_lista_indicadores('RIPSA - Fatores de risco e proteção'); // Obtém os dados da API para a categoria "Fatores de risco e proteção"

if ($indicadores) {
    usort($indicadores, function ($a, $b) {
        return strnatcmp($a['titulo'], $b['titulo']);
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

    // Extract the code from the title
    if (preg_match('/^([^–-]+)\s*[–-]\s*(.+)$/u', $titulo, $match_code)) {
        $codigo = trim($match_code[1]);
    }

    if (preg_match('/^(FRP\.\d)/', $codigo, $match_dim)) {
        $dimensao = $match_dim[1] ?? 'Outros';
        $grupos[$dimensao][] = $indicador;
    }
}
$category_name = "Fatores de risco e proteção";
$category_image = "fatores_de_risco.png";

include('category-page.php');

get_footer();
?>
<!-- Remover links-->
<script>
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_MJN"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_MZM"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_MK7"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_04Y"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_LZC"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_M1P"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=RIPSA007FR"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_8QG"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_78V"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_FXD"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_AU5"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_R5H"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_KVK"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_V5F"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_16V"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_EUQ"]').attr('href', '#!');
</script>