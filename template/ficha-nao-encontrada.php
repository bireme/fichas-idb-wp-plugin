<?php
/**
 * Página exibida (com status 404) quando a ficha solicitada é inválida ou não existe.
 * Incluída por template/ficha.php; $idb_plugin_slug vem de IDB_Plugin::theme_redirect().
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<div class="container-bread-indicadores">
    <div class="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo esc_url( home_url() ); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo esc_url( site_url( $idb_plugin_slug ) ); ?>">Fichas IDB</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ficha não encontrada</li>
            </ol>
        </nav>
    </div>
</div>
<main class="container">
    <div>
        <h2><b>Ficha não encontrada</b></h2>
        <p>A ficha de qualificação solicitada não existe ou não está disponível.</p>
        <p><a href="<?php echo esc_url( site_url( $idb_plugin_slug ) ); ?>">Voltar às Fichas IDB</a></p>
    </div>
</main>
<?php
get_footer();
