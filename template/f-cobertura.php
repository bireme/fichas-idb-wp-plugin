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
<!-- Remover links-->
<script>
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_95P"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_4IU"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_0BX"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_4R8"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_KB4"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_Y2R"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_EKR"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_ZWD"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_1MW"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=RIPSA003CB"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=RIPSA004CB"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=RIPSA005CB"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_TXL"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=RIPSA001CB"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_5E8"]').attr('href', '#!');
</script>