<?php
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
            <h2><?php _e('IDB Settings', 'idb'); ?></h2>

            <form method="post" action="options.php">

                <?php settings_fields('idb-settings-group'); ?>

                <table class="form-table">
                    <tbody>
                        <tr valign="top">
                            <th scope="row"><?php _e('Plugin page', 'idb'); ?>:</th>
                            <td><input type="text" name="idb_config[plugin_slug]" value="<?php echo $config['plugin_slug'] ?>" class="regular-text code"></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('Google Analytics code', 'idb'); ?>:</th>
                            <td><input type="text" name="idb_config[google_analytics_code]" value="<?php echo $config['google_analytics_code'] ?>" class="regular-text code"></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('MGDI API URL', 'idb'); ?>:</th>
                            <td><input type="text" name="idb_config[mgdi_api_url]" value="<?php echo $config['mgdi_api_url'] ?>" class="regular-text code"></td>
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
                                echo '   <th scope="row">' . __("Page title", "idb") . ' (' . $available_languages_name[$count] . '):</th>';
                                echo '   <td><input type="text" name="idb_config[' . $plugin_title . ']" value="' . $config[$plugin_title] . '" class="regular-text code"></td>';
                                echo '</tr>';

                                echo '<tr valign="top">';
                                echo '    <th scope="row"> ' . __("Home URL", "idb") . ' (' . $available_languages_name[$count] . '):</th>';
                                echo '    <td><input type="text" name="idb_config[' . $home_url . ']" value="' . $config[$home_url] . '" class="regular-text code"></td>';
                                echo '</tr>';

                                $count++;
                            }
                        }else{
                            echo '<tr valign="top">';
                            echo '   <th scope="row">' . __("Page title", "idb") . ':</th>';
                            echo '   <td><input type="text" name="idb_config[plugin_title]" value="' . $config["plugin_title"] . '" class="regular-text code"></td>';
                            echo '</tr>';

                            echo '<tr valign="top">';
                            echo '    <th scope="row"> ' . __("Home URL", "idb") . ':</th>';
                            echo '    <td><input type="text" name="idb_config[home_url]" value="' . $config['home_url'] . '" class="regular-text code"></td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <p class="submit">
                    <input type="submit" class="button-primary" value="<?php _e('Save changes') ?>" />
                </p>
            </form>
        </div>
<?php
}
?>
