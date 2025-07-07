<?php
/*
Plugin Name: Fichas de Qualificação do Indicador (FQI)
Plugin URI: https://github.com/bireme/fichas-idb-wp-plugin/
Description: FQI RIPSA WordPress plugin
Author: BIREME/OPAS/OMS
Version: 2.0
*/

define('IDB_VERSION', '2.0' );
define('IDB_PLUGIN_PATH',  plugin_dir_path(__FILE__) );
define('IDB_PLUGIN_URL',   plugin_dir_url(__FILE__) );
define('IDB_PLUGIN_DIR',   plugin_basename( IDB_PLUGIN_PATH ) );

require_once(IDB_PLUGIN_PATH . '/settings.php');
require_once(IDB_PLUGIN_PATH . '/template-functions.php');

if(!class_exists('IDB_Plugin')) {
    class IDB_Plugin {

        private $plugin_slug = 'fichas-idb';
        private $api_url = 'http://mgdi-api:8001/api/';
        private $ripsa_tag_code = '21'; // Código da categoria Ripsa

        /**
         * Construct the plugin object
         */
        public function __construct() {
            // register actions

            add_action( 'init', array(&$this, 'load_translation'));
            add_action( 'admin_menu', array(&$this, 'admin_menu'));
            add_action( 'plugins_loaded', array(&$this, 'plugin_init'));
            add_action( 'template_redirect', array(&$this, 'theme_redirect'));
            add_action( 'widgets_init', array(&$this, 'register_sidebars'));
            add_action( 'after_setup_theme', array(&$this, 'title_tag_setup'));
            add_filter( 'get_search_form', array(&$this, 'search_form'));
            add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array(&$this, 'settings_link') );
            add_filter( 'document_title_separator', array(&$this, 'title_tag_sep') );
            add_filter( 'document_title_parts', array(&$this, 'theme_slug_render_title'));
            add_filter( 'wp_title', array(&$this, 'theme_slug_render_wp_title'));
            add_action( 'wp_ajax_centers_show_more_clusters', array($this, 'centers_show_more_clusters'));
            add_action( 'wp_ajax_nopriv_centers_show_more_clusters', array($this, 'centers_show_more_clusters'));

        } // END public function __construct

        /**
         * Activate the plugin
         */
        public static function activate()
        {
            // Do nothing
        } // END public static function activate

        /**
         * Deactivate the plugin
         */
        public static function deactivate()
        {
            // Do nothing
        } // END public static function deactivate

        function load_translation(){
		    // load internal plugin translations
		    load_plugin_textdomain('idb', false,  IDB_PLUGIN_DIR . '/languages');
            // load plugin translations
            $site_language = strtolower(get_bloginfo('language'));
            $lang = substr($site_language,0,2);
		}

		function plugin_init() {
		    $idb_config = get_option('idb_config');


		    if ( $idb_config && $idb_config['plugin_slug'] != ''){
		        $this->plugin_slug = $idb_config['plugin_slug'];
                $this->api_url = array_key_exists('mgdi_api_url', $idb_config) ? $idb_config['mgdi_api_url'] : $this->api_url;
		    }

		}

		function admin_menu() {

		    add_submenu_page( 'options-general.php', __('IDB Settings', 'idb'), __('IDB', 'idb'), 'manage_options', 'idb', 'IDB_page_admin');

		    //call register settings function
		    add_action( 'admin_init', array(&$this, 'register_settings') );

		}

        function theme_redirect() {
            global $wp, $idb_plugin_slug;
            $pagename = '';

            // Check if request contains plugin slug string
            $pos_slug = strpos($wp->request, $this->plugin_slug);
            if ($pos_slug !== false) {
                $pagename = substr($wp->request, $pos_slug);
            }

            if (is_404() && $pos_slug !== false) {
                $idb_plugin_slug = $this->plugin_slug;

                add_action('wp_enqueue_scripts', array(&$this, 'page_template_styles_scripts'));

                if ($this->startsWith($pagename, $this->plugin_slug)) {
                    if ($pagename == $this->plugin_slug) {
                        $template = IDB_PLUGIN_PATH . '/template/indicadores.php'; // Mude isso para a página inicial desejada
                    } elseif ($pagename == $this->plugin_slug . '/listas') {
                        $template = IDB_PLUGIN_PATH . '/template/listas.php';
                    } elseif ($pagename == $this->plugin_slug . '/a-demografico') {
                        $template = IDB_PLUGIN_PATH . '/template/a-demografico.php';
                    } elseif ($pagename == $this->plugin_slug . '/b-socioeconomicos') {
                        $template = IDB_PLUGIN_PATH . '/template/b-socioeconomicos.php';
                    } elseif ($pagename == $this->plugin_slug . '/c-mortalidade') {
                        $template = IDB_PLUGIN_PATH . '/template/c-mortalidade.php';
                    } elseif ($pagename == $this->plugin_slug . '/d-morbidade') {
                        $template = IDB_PLUGIN_PATH . '/template/d-morbidade.php';
                    } elseif ($pagename == $this->plugin_slug . '/f-cobertura') {
                        $template = IDB_PLUGIN_PATH . '/template/f-cobertura.php';
                    } elseif ($pagename == $this->plugin_slug . '/e-recursos') {
                        $template = IDB_PLUGIN_PATH . '/template/e-recursos.php';
                    } elseif ($pagename == $this->plugin_slug . '/g-fatores-risco-protecao') {
                        $template = IDB_PLUGIN_PATH . '/template/g-fatores-risco-protecao.php';
                    // Verifica se a pagina termina com a string 'ficha'
                    } elseif ( substr($pagename, -strlen('ficha')) === 'ficha') {
                        $template = IDB_PLUGIN_PATH . '/template/ficha.php';
                    } else {
                        $template = IDB_PLUGIN_PATH . '/template/detail.php';
                    }
                    // Force status to 200 - OK
                    status_header(200);

                    // Redirect to page and finish execution
                    include($template);
                    die();
                }
            }
        }

		function register_sidebars(){
		    $args = array(
		        'name' => 'IDB Sidebar',
		        'id'   => 'idb-home',
		        'description' => __('IDB Area', 'idb'),
		        'before_widget' => '<section id="%1$s" class="row-fluid widget %2$s">',
		        'after_widget'  => '</section>',
		        'before_title'  => '<h2 class="widgettitle">',
		        'after_title'   => '</h2>',
		    );
		    register_sidebar( $args );

            $args2 = array(
                'name' => 'IDB Header',
                'id'   => 'idb-header',
                'description' => __('IDB Header', 'idb'),
                'before_widget' => '<section id="%1$s" class="row-fluid widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<header class="row-fluid border-bottom marginbottom15"><h1 class="h1-header">',
                'after_title'   => '</h1></header>',
            );
            register_sidebar( $args2 );
		}

        function title_tag_sep(){
            return '|';
        }

        function theme_slug_render_title($title) {
            global $wp, $idb_plugin_title;
            $pagename = '';

            // check if request contains plugin slug string
            $pos_slug = strpos($wp->request, $this->plugin_slug);
            if ( $pos_slug !== false ){
                $pagename = substr($wp->request, $pos_slug);
            }

            if ( is_404() && $pos_slug !== false ){
                $idb_config = get_option('idb_config');

                if ( function_exists( 'pll_the_languages' ) ) {
                    $current_lang = pll_current_language();
                    $idb_plugin_title = $idb_config['plugin_title_' . $current_lang];
                }else{
                    $idb_plugin_title = $idb_config['plugin_title'];
                }
                $title['title'] = $idb_plugin_title . " | " . get_bloginfo('name');
            }

            return $title;
        }

        function theme_slug_render_wp_title($title) {
            global $wp, $idb_plugin_title;
            $pagename = '';

            // check if request contains plugin slug string
            $pos_slug = strpos($wp->request, $this->plugin_slug);
            if ( $pos_slug !== false ){
                $pagename = substr($wp->request, $pos_slug);
            }

            if ( is_404() && $pos_slug !== false ){
                $idb_config = get_option('idb_config');

                if ( function_exists( 'pll_the_languages' ) ) {
                    $current_lang = pll_current_language();
                    $idb_plugin_title = $idb_config['plugin_title_' . $current_lang];
                }else{
                    $idb_plugin_title = $idb_config['plugin_title'];
                }

                if ( $idb_plugin_title )
                    $title = $idb_plugin_title . ' | ';
                else
                    $title = '';
            }

            return $title;
        }

        function title_tag_setup() {
            add_theme_support('title-tag');
        }

		function page_title(){
		    global $wp;
		    $pagename = $wp->query_vars["pagename"];

		    if ( strpos($pagename, $this->plugin_slug) === 0 ) { //pagename starts with plugin slug
		        return __('IDB', 'idb') . ' | ';
		    }
		}

		function search_form( $form ) {
		    global $wp;
		    $pagename = $wp->query_vars["pagename"];

		    if ($pagename == $this->plugin_slug || preg_match('/detail\//', $pagename)) {
		        $form = preg_replace('/action="([^"]*)"(.*)/','action="' . home_url($this->plugin_slug) . '"',$form);
		    }

		    return $form;
		}

        function page_template_styles_scripts(){
            wp_enqueue_style('bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
            wp_enqueue_style('style-centers', IDB_PLUGIN_URL . 'template/css/style.css');
            wp_enqueue_style('accessibility', IDB_PLUGIN_URL . 'template/css/accessibility.css');
            wp_enqueue_style('fontawesome', '//use.fontawesome.com/releases/v5.8.1/css/all.css');
            wp_enqueue_style('fontgoogle', '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,900');

            wp_enqueue_script('bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery'), '4.0.0', true);
            wp_enqueue_script('cookie',  IDB_PLUGIN_URL . 'template/js/cookie.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('accessibility', IDB_PLUGIN_URL . 'template/js/accessibility.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('functions', IDB_PLUGIN_URL . 'template/js/functions.js', array('jquery'), '1.0.0', true);


            wp_enqueue_script('jquery');

            wp_add_inline_script('jquery', 'const IDB_script_vars = ' . json_encode( array(
                    'ajaxurl' => admin_url( 'admin-ajax.php' ),
                    'ajaxnonce' => wp_create_nonce( 'ajax_post_validation' )
            )), 'before');
        }

		function register_settings(){
            register_setting('idb-settings-group', 'idb_config');
            wp_enqueue_style ('idb', IDB_PLUGIN_URL . 'template/css/admin.css');
            wp_enqueue_script('jquery-ui-sortable');
		}

        function settings_link($links) {
            $settings_link = '<a href="options-general.php?page=idb.php">Settings</a>';
            array_unshift($links, $settings_link);
            return $links;
        }

        function startsWith ($string, $startString) {
            $len = strlen($startString);
            return (substr($string, 0, $len) === $startString);
        }

        function fetch_api_indicador($indicator) {

            $api_url = $this->api_url . 'indicador/' . $indicator;
            $response = wp_remote_get($api_url);

            if (is_wp_error($response)) {
                return false;
            }

            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return false;
            }

            return $data;
        }

        function fetch_api_lista_indicadores($categoria_code) {
            $cache_key = 'api_lista_indicadores'; // Gera uma chave única para o cache
            $cache_duration = 12 * HOUR_IN_SECONDS; // Define o tempo de cache em 12 horas
            $indicadores = [];

            // Verifica se os dados já estão no cache
            $data = get_transient($cache_key);

            if ($data === false) {
                // Se não houver dados no cache, faz a requisição à API
                $api_url = $this->api_url . 'tag-categoria/' . $this->ripsa_tag_code;
                $response = wp_remote_get($api_url);

                if (!is_wp_error($response)) {

                    $body = wp_remote_retrieve_body($response);
                    $data = json_decode($body, true);

                    if (!empty($data) && isset($data['Tags'])) {
                        // Armazena os dados no cache
                        set_transient($cache_key, $data, $cache_duration);
                    }else{
                        // Se a resposta não contiver dados válidos, retorna um array vazio
                        return [];
                    }
               }
            }

            $tags = $data['Tags'] ?? [];
            // Filter to categoria_code
            if ($tags && $categoria_code) {
                $categoria = array_filter($tags, function ($tag) use ($categoria_code) {
                    return isset($tag['codigo']) && $tag['codigo'] == $categoria_code;
                });

                $indicadores = $categoria[0]['Indicadores'] ?? [];
            }

            return $indicadores;
        }

	} // END class IDB_Plugin
} // END if(!class_exists('IDB_Plugin'))

if(class_exists('IDB_Plugin'))
{
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('IDB_Plugin', 'activate'));
    register_deactivation_hook(__FILE__, array('IDB_Plugin', 'deactivate'));

    // Instantiate the plugin class
    $wp_plugin_template = new IDB_Plugin();
}

?>
