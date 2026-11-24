<?php
defined( 'ABSPATH' ) || exit;

function idb_page_admin() {
    $config = get_option('idb_config');
    if ( !is_array($config) ) {
        $config = array(
            'plugin_slug' => 'fichas-idb',
            'google_analytics_code' => '',
            'plugin_title' => '',
            'home_url' => ''
        );
    }
?>
    <div class="wrap">
            <div id="icon-options-general" class="icon32"></div>
            <h2><?php esc_html_e( 'IDB Settings', 'idb' ); ?></h2>

            <form method="post" action="options.php">

                <?php settings_fields('idb-settings-group'); ?>

                <table class="form-table">
                    <tbody>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Plugin page', 'idb' ); ?>:</th>
                            <td><input type="text" name="idb_config[plugin_slug]" value="<?php echo esc_attr( $config['plugin_slug'] ?? '' ); ?>" class="regular-text code"></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Google Analytics code', 'idb' ); ?>:</th>
                            <td><input type="text" name="idb_config[google_analytics_code]" value="<?php echo esc_attr( $config['google_analytics_code'] ?? '' ); ?>" class="regular-text code"></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'MGDI API URL', 'idb' ); ?>:</th>
                            <td><input type="text" name="idb_config[mgdi_api_url]" value="<?php echo esc_attr( $config['mgdi_api_url'] ?? '' ); ?>" class="regular-text code"></td>
                        </tr>

<?php
                        if ( function_exists( 'pll_the_languages' ) ) {
                            $available_languages = pll_languages_list();
                            $available_languages_name = pll_languages_list(array('fields' => 'name'));
                            $count = 0;
                            foreach ($available_languages as $lang) {
                                $plugin_title = 'plugin_title_' . $lang;
                                $home_url = 'home_url_' . $lang;

                                echo '<tr valign="top">';
                                echo '   <th scope="row">' . esc_html__( 'Page title', 'idb' ) . ' (' . esc_html( $available_languages_name[ $count ] ?? $lang ) . '):</th>';
                                echo '   <td><input type="text" name="idb_config[' . esc_attr( $plugin_title ) . ']" value="' . esc_attr( $config[ $plugin_title ] ?? '' ) . '" class="regular-text code"></td>';
                                echo '</tr>';

                                echo '<tr valign="top">';
                                echo '    <th scope="row"> ' . esc_html__( 'Home URL', 'idb' ) . ' (' . esc_html( $available_languages_name[ $count ] ?? $lang ) . '):</th>';
                                echo '    <td><input type="text" name="idb_config[' . esc_attr( $home_url ) . ']" value="' . esc_attr( $config[ $home_url ] ?? '' ) . '" class="regular-text code"></td>';
                                echo '</tr>';

                                $count++;
                            }
                        }else{
                            echo '<tr valign="top">';
                            echo '   <th scope="row">' . esc_html__( 'Page title', 'idb' ) . ':</th>';
                            echo '   <td><input type="text" name="idb_config[plugin_title]" value="' . esc_attr( $config['plugin_title'] ?? '' ) . '" class="regular-text code"></td>';
                            echo '</tr>';

                            echo '<tr valign="top">';
                            echo '    <th scope="row"> ' . esc_html__( 'Home URL', 'idb' ) . ':</th>';
                            echo '    <td><input type="text" name="idb_config[home_url]" value="' . esc_attr( $config['home_url'] ?? '' ) . '" class="regular-text code"></td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <p class="submit">
                    <input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save changes' ); // phpcs:ignore WordPress.WP.I18n.MissingArgDomain -- string do core. ?>" />
                </p>
            </form>
        </div>
<?php
}
?>
