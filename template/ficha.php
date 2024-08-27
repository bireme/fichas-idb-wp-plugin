<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

// Pega parametro com identificador da ficha
$param_code = $_GET['code'];

// Instancie o plugin e obtenha os dados
$plugin = new CC_Plugin();
$data = $plugin->fetch_api_data($param_code);

$codigo = $data['codigo'];

// Processamento de pesquisa
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$searchYear = isset($_GET['year']) ? intval($_GET['year']) : '';

?>
<div class="container-bread-indicadores">
    <div class="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url('/fichasidb'); ?>">Fichas IDB</a></li>
                <!--li class="breadcrumb-item"><a href="<?php echo site_url('/fichasidb/ind-fatores-risco-protecao'); ?>">Fatores de Risco e Proteção</a></li-->
                <li class="breadcrumb-item active" aria-current="page"><?php echo $data['titulo'] .' - '. $param_code;?></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container">
    <div class="row">
        <!-- Primeira coluna: Exibição dos dados -->
        <div class="column-left">
        <?php
if ($data) {
    // Variável para armazenar a descrição da tag
    $descricaoTag = 'Descrição da tag não encontrada'; // Valor padrão caso a descrição não seja encontrada

    // Verifique se a chave 'Tags' está definida e é um array
    if (isset($data['Tags']) && is_array($data['Tags'])) {
        // Procure a descrição da tag desejada
        foreach ($data['Tags'] as $tag) {
            if ($tag['codigo'] == 108) { // Altere o código conforme necessário
                $descricaoTag = $tag['descricao']; // Atribua a descrição encontrada
                break; // Saia do loop após encontrar a tag correspondente
            }
        }
    }

    // Exibindo os dados
                //echo '<h6>' . htmlspecialchars($tag['descricao']) . '</h6>';

                echo '<h2>' . $data['titulo'] .' - '. $param_code . '</h2>';
                echo '<div class="data-box">';
                echo '<p><h3>Descrição</h3> ' . $data['descricao'] . '</p>';
                echo '</div>';
                echo '<div class="data-box">';
                echo '<p><h3>Método de Cálculo</h3> ' . $data['metodo_calculo'] . '</p>';
                echo '</div>';
                echo '<div class="data-box">';
                echo '<p><h3>Fórmula de Cálculo</h3> ' . $data['formula_calculo'] . '</p>';
                echo '</div>';
                echo '<div class="data-box">';
                echo '<p><h3>Fonte de Dados</h3> ' . $data['fonte_dados'] . '</p>';
                echo '</div>';
                echo '<div class="data-box">';
                echo '<p><h3>Conceituação</h3> ' . $data['conceituacao'] . '</p>';
                echo '</div>';
                echo '<div class="data-box">';
                echo '<p><h3>Interpretação</h3> ' . $data['interpretacao'] . '</p>';
                echo '</div>';
                echo '<div class="data-box">';
                echo '<p><h3>Usos</h3> ' . $data['usos'] . '</p>';
                echo '</div>';
                echo '<div class="data-box">';
                echo '<p><h3>Limitações</h3> ' . $data['limitacoes'] . '</p>';
                echo '</div>';
                echo '<div class="data-box">';
                echo '<p><h3>Notas</h3> ' . $data['notas'] . '</p>';
                echo '</div>';
            } else {
                echo 'Não foi possível recuperar os dados.';
            }
            ?>
        </div>

        <!-- Segunda coluna: Botões com ícones -->
        <div class="column-right">
            <h2>Opções</h2>
            <div class="button-box">
                <button class="btn-icon"><i class="fa-solid fa-database"></i> Bases de Dados</button>
                <!--<button class="btn-icon"><i class="fa-solid fa-book"></i> Literatura Científica em LILACS</button>-->
                <button class="btn-icon"><i class="fa-solid fa-print"></i> Imprimir</button>
                <button class="btn-icon"><i class="fa-solid fa-file-pdf"></i> PDF</button>
                <!--<button class="btn-icon"><i class="fa-solid fa-comment"></i> Comentários sobre Indicadores</button>-->
            </div>
        </div>
    </div>
</div>

<?php
// Inclua o rodapé e outras partes do template conforme necessário
get_footer();
?>