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
                <li class="breadcrumb-item active" aria-current="page"><?php echo $data['titulo'] .' - '. $param_code;?></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container">
    <div class="row">
        <!-- Primeira coluna: Exibição dos dados -->
        <div class="column-left" id="content-to-print">
        <?php
if ($data) {
    echo '<h2>' . $data['titulo'] .' - '. $param_code . '</h2>';
                
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
    echo '<p><h3>Fonte de Dados</h3> ' . $data['fonte_dados'] . '</p>';
    echo '</div>';
    
    echo '<div class="data-box">';
    echo '<p><h3>Fórmula de Cálculo</h3> ' . $data['formula_calculo'] . '</p>';
    echo '</div>';
    
    echo '<div class="data-box">';
    echo '<p><h3>Método de Cálculo</h3> ' . $data['metodo_calculo'] . '</p>'; // Este campo pode estar vazio
    echo '</div>';
    
    echo '<div class="data-box">';
    echo '<p><h3>Categorias de Análise</h3> '; 
    if (isset($data['CategoriasAnalise']) && is_array($data['CategoriasAnalise'])) {
        foreach ($data['CategoriasAnalise'] as $categoria) {
            echo '<span>' . $categoria['titulo'] . '</span><br>';
        }
    }
    echo '</div>';
    
    echo '<div class="data-box">';
    echo '<p><h3>Granularidade</h3> ' . $data['Granularidade']['descricao'] . '</p>';
    echo '</div>';
    
    echo '<div class="data-box">';
    echo '<p><h3>Periodicidade de Atualização</h3> ' . $data['PeriodicidadeAtualizacao']['descricao'] . '</p>';
    echo '</div>';
    
    echo '<div class="data-box">';
    echo '<p><h3>Responsabilidade Gerencial</h3> '; 
    echo isset($data['ResponsavelGerencial']) && !empty($data['ResponsavelGerencial']) ? $data['ResponsavelGerencial'] : 'Não informado';
    echo '</div>';
    
    echo '<div class="data-box">';
    echo '<p><h3>Notas</h3> ' . $data['notas'] . '</p>';
    echo '</div>';
    
    echo '<div class="data-box">';
    echo '<p><h3>Análise Descritiva do Indicador</h3> '; 
    echo isset($data['analise_descritiva']) ? $data['analise_descritiva'] : 'Sem análise descritiva';
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
                <!-- Botão Bases de Dados (sem alterações) -->
                <button class="btn-icon"><i class="fa-solid fa-database"></i> Bases de Dados</button>
                
                <!-- Botão Imprimir -->
                <button class="btn-icon" id="print-button"><i class="fa-solid fa-print"></i> Imprimir</button>
                
                <!-- Botão Gerar PDF -->
                <button class="btn-icon" id="pdf-button"><i class="fa-solid fa-file-pdf"></i> PDF</button>
            </div>
        </div>
    </div>
</div>

<?php
// Inclua o rodapé e outras partes do template conforme necessário
get_footer();
?>

<!-- JavaScript para impressão e geração de PDF -->
<script>
    // Função para imprimir o conteúdo
    document.getElementById('print-button').addEventListener('click', function() {
        var printContent = document.getElementById('content-to-print').innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    });

    // Função para gerar PDF usando jsPDF
    document.getElementById('pdf-button').addEventListener('click', function() {
        var { jsPDF } = window.jspdf;

        var doc = new jsPDF();

        // Captura o conteúdo a ser convertido para PDF
        var content = document.getElementById('content-to-print').innerText;

        // Adiciona o conteúdo no PDF
        doc.text(content, 10, 10);

        // Salva o arquivo PDF com o nome especificado
        doc.save('indicador.pdf');
    });
</script>

<!-- Importação da biblioteca jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>