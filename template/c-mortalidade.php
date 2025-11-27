<?php
get_header();

$plugin = new IDB_Plugin(); // Instancia o plugin
$indicadores = $plugin->fetch_api_lista_indicadores('RIPSA - Mortalidade'); // Obtém os dados da API para a categoria "Mortalidade"

if ($indicadores) {
    usort($indicadores, function ($a, $b) {
        return strnatcmp($a['prefixo'], $b['prefixo']);
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
    $prefixo = $indicador['prefixo'];

    if (preg_match('/^(MRT\.\d)/', $prefixo, $match_dim)) {
        $dimensao = $match_dim[1] ?? 'Outros';
        $grupos[$dimensao][] = $indicador;
    }
}
$category_name = "Mortalidade";
$category_image = "mortalidade.png";

include('category-page.php');

get_footer();
?>

<!-- Remover links-->
<script>
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_K5P"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_M8Y"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_O3O"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_3ZX"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_I8H"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_939"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_S67"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=RIPSA001MT"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_XP0"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_M96"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_Y2U"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_B9F"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_CJZ"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_7MY"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=RIPSA002MT"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_7UM"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_BBT"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_4V1"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_H0W"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_OOH"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_4TT"]').attr('href', '#!');
  jQuery('a[href="a-demografico/ficha?code=MGDI_MS_46W"]').attr('href', '#!');
</script>