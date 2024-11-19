<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();

// Pega o parâmetro com identificador da ficha
$param_code = $_GET['code'];

// Instancie o plugin e obtenha os dados
$plugin = new CC_Plugin();
$data = $plugin->fetch_api_data($param_code);

// Adicione o DOI manualmente para a ficha com código 014DM como exemplo
if ($param_code === '014DM') {
    $data['doi'] = '10.5281/zenodo.7789893'; // DOI de exemplo para teste
}

// Processamento de pesquisa
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$searchYear = isset($_GET['year']) ? intval($_GET['year']) : '';

// Remove <p class="ql-align-justify"> and </p> tags from the formula_calculo field
$formula_calculo = str_replace('<p class="ql-align-justify">', '', $data['formula_calculo']);
$formula_calculo = str_replace('</p>', '', $formula_calculo);

// Remove delimitadores de fórmula LaTeX $$ caso estejam presentes
$formula_calculo = str_replace('$$', '', $formula_calculo);
?>
<div class="container-bread-indicadores">
    <div class="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url('/fichasidb'); ?>">Fichas IDB</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $data['titulo']; ?></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container">
    <div class="row">
        <!-- Primeira coluna: Exibição dos dados -->
        <div class="column-left" id="content-to-print">
            <?php if ($data): ?>
                <h2><b><?php echo $data['titulo']; ?></b></h2>
                
                <div class="data-box">
                    <p><h3>Conceituação</h3> <?php echo $data['conceituacao']; ?></p>
                </div>
                
                <div class="data-box">
                    <p><h3>Interpretação</h3> <?php echo $data['interpretacao']; ?></p>
                </div>
                
                <div class="data-box">
                    <p><h3>Usos</h3> <?php echo $data['usos']; ?></p>
                </div>
                
                <div class="data-box">
                    <p><h3>Limitações</h3> <?php echo $data['limitacoes']; ?></p>
                </div>
                
                <div class="data-box">
                    <p><h3>Fonte de Dados</h3> <?php echo $data['fonte_dados']; ?></p>
                </div>
                
                <div class="data-box">
                    <p><h3>Fórmula de Cálculo</h3> <span class="formula-latex">\\(<?php echo htmlspecialchars($formula_calculo); ?>\\)</span></p>
                </div>
                
                <div class="data-box">
                    <p><h3>Método de Cálculo</h3> <?php echo $data['metodo_calculo'] ?: 'Não informado'; ?></p>
                </div>
                
                <div class="data-box">
                    <p><h3>Categorias de Análise</h3>
                        <?php 
                        if (isset($data['CategoriasAnalise']) && is_array($data['CategoriasAnalise'])) {
                            foreach ($data['CategoriasAnalise'] as $categoria) {
                                echo '<span>' . $categoria['titulo'] . '</span><br>';
                            }
                        }
                        ?>
                    </p>
                </div>
                
                <div class="data-box">
                    <p><h3>Granularidade</h3> <?php echo $data['Granularidade']['descricao']; ?></p>
                </div>
                
                <div class="data-box">
                    <p><h3>Periodicidade de Atualização</h3> <?php echo $data['PeriodicidadeAtualizacao']['descricao']; ?></p>
                </div>
                
                <div class="data-box">
                    <p><h3>Responsabilidade Gerencial</h3> <?php echo $data['ResponsavelGerencial'] ?: 'Não informado'; ?></p>
                </div>
                
                <div class="data-box">
                    <p><h3>Notas</h3> <?php echo $data['notas']; ?></p>
                </div>
                
                <div class="data-box">
                    <p><h3>Análise Descritiva do Indicador</h3> <?php echo $data['analise_descritiva'] ?: 'Sem análise descritiva'; ?></p>
                </div>
                
                <!-- Seção Como Citar -->
                <div class="data-box">
                    <p><h3>Como Citar</h3>
                        <?php if (isset($data['doi']) && !empty($data['doi'])): ?>
                            Para citar este indicador, use o seguinte DOI: <a href="https://doi.org/<?php echo $data['doi']; ?>" target="_blank"><?php echo $data['doi']; ?></a>.
                        <?php else: ?>
                            As informações de citação não estão disponíveis para este indicador.
                        <?php endif; ?>
                    </p>
                </div>
                
                <!-- Seção Direitos Creative Commons -->
                <div class="data-box">
                    <p><h3>Direitos</h3>
                        <span style="display: flex; align-items: center; padding: 10px 0;">
                            <a href="https://creativecommons.org/licenses/by/4.0/" target="_blank" style="text-decoration: none; color: inherit; display: flex; align-items: center;">
                                <img src="<?php echo plugins_url('images/cc-by-4.0-icon.png', __FILE__); ?>" alt="cc-by-4.0 icon" style="width:80px; height:28px; margin-right: 8px;">
                                <span style="font-size: 9px; line-height: 1.2;">Creative Commons Attribution 4.0 International</span>
                            </a>
                        </span>
                    </p>
                </div>
            <?php else: ?>
                <p>Não foi possível recuperar os dados.</p>
            <?php endif; ?>
        </div>

        <!-- Segunda coluna: Botões com ícones -->
        <div class="column-right">
            <!-- Exibe o DOI na coluna direita se estiver definido para a ficha -->
            <?php if (isset($data['doi']) && !empty($data['doi'])): ?>
                <div class="data-box doi-box">
                    <p><h3>DOI</h3> <a href="https://doi.org/<?php echo $data['doi']; ?>" target="_blank"><?php echo $data['doi']; ?></a></p>
                </div>
            <?php endif; ?>
            <div class="button-box">
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

<!-- JavaScript para impressão -->
<script>
    document.getElementById('print-button')?.addEventListener('click', function() {
        var printContent = document.getElementById('content-to-print').innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    });
</script>

<!-- Importação da biblioteca jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<!-- Importação da biblioteca html2canvas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<!-- Carrega o MathJax para renderizar LaTeX -->
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
