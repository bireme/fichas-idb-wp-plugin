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

<!-- Remover links-->
<script>
  jQuery('a[href="a-demografico/ficha?code=RIPSA019MB"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=RIPSA007MB"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=RIPSA006MB"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=RIPSA010MB"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_YP0"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=RIPSA013MB"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_OYL"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=RIPSA011MB"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=RIPSA005MB"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=RIPSA012MB"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_SVJ"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=RIPSA003MB"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_ES1"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_TYC"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_TOJ"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_JNS"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_MQG"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_BHC"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_V6R"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_F8A"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=RIPSA014MB"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_5KV"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_NHM"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_5IN"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_O5I"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_BPG"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_JS6"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=RIPSA017MB"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_C16"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_GR2"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_EAJ"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_BST"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_R58"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_XI4"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_NVN"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_KM8"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_QU3"]').attr('href', '#!');
</script>