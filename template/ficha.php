<?php
// Inclua o cabeçalho e outras partes do template conforme necessário
get_header();
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.22/dist/katex.min.css"
integrity="sha384-5TcZemv2l/9On385z///+d7MSYlvIEw9FuZTIdZ14vJLqWphw7e7ZPuOiCHJcFCP"
crossorigin="anonymous">

<?php
// Pega o parâmetro com identificador da ficha
$codigo_api = $_GET['code'];

// Instancie o plugin e obtenha os dados
$plugin = new IDB_Plugin();
$data = $plugin->fetch_api_indicador($codigo_api);

$titulo = $data['titulo'];
$codigo_indicador = $data['prefixo'];

// Diretório base para PDFs na pasta uploads
$upload_dir = wp_upload_dir();
$pdf_file_url = null;
$pdf_dir = '/fichasidb/2024/';
$pdf_base_path = $upload_dir['basedir'] . $pdf_dir;
$pdf_base_url = $upload_dir['baseurl'] . $pdf_dir;

$pdf_file_name = $codigo_indicador . '.pdf';
$pdf_file_path = $pdf_base_path . $pdf_file_name;

if (file_exists($pdf_file_path)) {
    $pdf_file_url = $pdf_base_url . $codigo_indicador . '.pdf';

    // Extrai o DOI do nome do arquivo (parte após o "_")
    if (preg_match('/' . preg_quote($codigo_indicador, '/') . '_([\w]+)\.pdf$/', $pdf_file_name, $matches)) {
        $pdf_doi_suffix = $matches[1]; // Sufixo do DOI
        $pdf_file_url = $pdf_base_url . $pdf_file_name; // URL completa do PDF
        $data['doi'] = '10.5281/zenodo.' . $pdf_doi_suffix; // DOI gerado dinamicamente
    }
}

// Remove <p class="ql-align-justify"> and </p> tags from the formula_calculo field
$formula_calculo = str_replace('<p class="ql-align-justify">', '', $data['formula_calculo']);
$formula_calculo = str_replace('</p>', '', $formula_calculo);
$formula_calculo = str_replace('$$', '', $formula_calculo);

// Função para formatar bullets
function format_bullets($content)
{
    $content = trim($content);
    $content = ltrim($content, '•');
    $content = preg_replace('/(?:•\s*)/', '</li><li>', $content);
    if (strpos($content, '</li><li>') !== false) {
        $content = '<ul><li>' . $content . '</li></ul>';
    }
    $content = nl2br($content);
    return $content;
}
?>
<div class="container-bread-indicadores">
    <div class="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url($idb_plugin_slug); ?>">Fichas IDB</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $data['titulo']; ?></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container">
    <h2><b><?php echo $data['prefixo'] . ' - ' . $data['titulo']; ?></b></h2>
</div>
<div class="container">
    <div class="row">
        <!-- Primeira coluna: Exibição dos dados -->
        <?php if ($data): ?>
            <div class="column-left" id="content-to-print">
                <div class="data-box">
                    <h3>Conceituação</h3>
                    <?php echo format_bullets($data['conceituacao']); ?>
                </div>

                <div class="data-box">
                    <h3>Interpretação</h3>
                    <?php echo format_bullets($data['interpretacao']); ?>
                </div>

                <div class="data-box">
                    <h3>Usos</h3>
                    <?php echo format_bullets($data['usos']); ?>
                </div>

                <div class="data-box">
                    <h3>Limitações</h3>
                    <?php if (!empty($data['limitacoes'])): ?>
                        <p><?php echo nl2br($data['limitacoes']); ?></p>
                    <?php else: ?>
                        <p>Não informado</p>
                    <?php endif; ?>
                </div>

                <div class="data-box">
                    <h3>Fonte de Dados</h3>
                    <?php echo format_bullets($data['fonte_dados']); ?>
                </div>
                <div class="data-box">
                    <h3>Fórmula de Cálculo</h3>

                    <?php
                    // Verifica se existe conteúdo na fórmula de cálculo
                    if (!empty($formula_calculo)) {
                        // Procura por "Nota:" e "Onde:" e separa o conteúdo
                        $parts = explode('Nota:', $formula_calculo);
                        $formula_and_others = trim($parts[0]); // Fórmula e possíveis textos adicionais
                        $nota = isset($parts[1]) ? trim($parts[1]) : ''; // Nota, se existir

                        // Procura por "Onde:" na parte principal
                        $subparts = explode('Onde:', $formula_and_others);
                        $formula = trim($subparts[0]); // Apenas a fórmula LaTeX
                        $onde = isset($subparts[1]) ? trim($subparts[1]) : ''; // Parte "Onde", se existir
                        ?>
                        <!-- Exibe a fórmula -->
                        <p class="formula-latex" id="formula"><?php echo $formula; ?></p>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                if (typeof katex !== 'undefined') {
                                    var formulaElement = document.getElementById('formula');
                                    katex.render(formulaElement.textContent, formulaElement, {
                                        throwOnError: false,
                                        displayMode: true
                                    });
                                }
                            });
                        </script>

                        <!-- Exibe a frase "Onde", se existir -->
                        <?php if (!empty($onde)): ?>
                            <p class="onde-calc"><strong>Onde:</strong> <?php echo $onde; ?></p>
                        <?php endif; ?>

                        <!-- Exibe a nota formatada, se existir -->
                        <?php if (!empty($nota)): ?>
                            <p class="nota-calc"><strong>Nota:</strong> <?php echo $nota; ?></p>
                        <?php endif; ?>
                    <?php } else { ?>
                        <p>Fórmula de cálculo não disponível.</p>
                    <?php } ?>
                </div>

                <div class="data-box">
                    <h3>Método de Cálculo</h3>
                    <p><?php echo $data['metodo_calculo'] ?? 'Não informado'; ?></p>
                </div>
                <!-- Novas seções -->
                <div class="data-box">
                    <h3>Categorias de Análise</h3>
                    <p>
                        <?php
                        if (!empty($data['CategoriasAnalise'])):
                            echo '<ul>';
                            foreach ($data['CategoriasAnalise'] as $cat_analise){
                                echo '<li>' . $cat_analise['titulo'] . '</li>';
                            }
                            echo '<ul>';
                        else:
                            echo 'Não informado';
                        endif;
                        ?>
                    </p>
                </div>

                <div class="data-box">
                    <h3>Granularidade</h3>
                    <p><?php echo !empty($data['Granularidade']['descricao']) ? $data['Granularidade']['descricao'] : 'Não informado'; ?>
                </p>
            </div>

            <div class="data-box">
                <h3>Periodicidade de Atualização</h3>
                <p><?php echo !empty($data['PeriodicidadeAtualizacao']['descricao']) ? $data['PeriodicidadeAtualizacao']['descricao'] : 'Não informado'; ?>
            </p>
        </div>

        <div class="data-box">
            <h3>Responsabilidade Gerencial</h3>
            <p>
                <?php
                if (!empty($data['ResponsavelGerencial'])):
                    $responsaveisGerenciais = array_map(function ($responsavelGerencial) {
                        $sigla = $responsavelGerencial['sigla'] ?? 'Sigla não informada';
                        $nome = $responsavelGerencial['nome'] ?? 'Nome não informado';
                        return "$sigla - $nome";
                    }, $data['ResponsavelGerencial']);
                    echo implode(', ', $responsaveisGerenciais);
                else:
                    echo 'Não informado';
                endif;
                ?>
            </p>
        </div>

        <!-- Fim das novas seções -->
        <?php if (!empty($data['notas'])): ?>
            <div class="data-box">
                <h3>Notas</h3>
                <?php echo $data['notas']; ?>
            </div>
        <?php endif; ?>

        <div class="data-box">
            <h3>Análise Descritiva do Indicador</h3>
            <?php
            if (!empty($data['analise'])) {
        // Substitui \r\n antes de "|"
                $analise = preg_replace('/\r\n\|/', '|', $data['analise']);

        // Remove espaços e quebras de linha extras no início e no fim
                $analise = preg_replace('/(\r\n|\n|\r)+$/', '', $analise);

        // Remove múltiplas quebras de linha consecutivas
                $analise = preg_replace('/(\r\n|\n|\r){2,}/', "\n", $analise);

        // Transforma tabelas em HTML
                if (preg_match('/\|.*\|/', $analise)) {
                    $linhas = explode("\n", $analise);
                    $tabela_html = '<table border="1">';
                    foreach ($linhas as $linha) {
                        if (strpos($linha, '|') !== false) {
                            $tabela_html .= '<tr>';
                            $colunas = array_map('trim', explode('|', trim($linha, '|')));
                            foreach ($colunas as $coluna) {
                                $tabela_html .= '<td>' . htmlspecialchars($coluna) . '</td>';
                            }
                            $tabela_html .= '</tr>';
                        }
                    }
                    $tabela_html .= '</table>';
                    $analise = $tabela_html;
                }

        // Remove qualquer espaço ou quebra de linha adicional
                $analise = trim($analise);

        // Exibe o conteúdo processado
                echo $analise;
            } else {
                echo '<p>Sem análise descritiva.</p>';
            }
            ?>
        </div>

        <!-- Referências Bibliográficas -->
        <?php if (!empty($data['referencia_bibliografica'])): ?>
            <div class="data-box">
                <h3>Referências</h3>
                <?php echo $data['referencia_bibliografica']; ?>
            </div>
        <?php endif; ?>

        <!-- Seção Como Citar -->
        <div class="data-box citation">
            <h3>Como Citar</h3>
            <?php
            $temas = [
                'a-demografico' => 'Demográfico',
                'b-socioeconomicos' => 'Socioeconômico',
                'c-mortalidade' => 'Mortalidade',
                'd-morbidade' => 'Morbidade',
                'e-recursos' => 'Recursos',
                'f-cobertura' => 'Cobertura',
                'g-fatores-risco-protecao' => 'Fatores de Risco e Proteção'
            ];
            $current_alias = '';
            if (preg_match('/\/fichasidb\/([^\/]+)\//', $_SERVER['REQUEST_URI'], $matches)) {
                $current_alias = $matches[1];
            }
            $tema = $temas[$current_alias] ?? 'Indefinido';
            $titulo = $data['titulo'] ?? 'Título não disponível';
            $doi = isset($data['doi']) && !empty($data['doi']) ? $data['doi'] : 'DOI não disponível';
            $site_url = site_url();
            $url = '<a href="https://www.ripsa.org.br/fichasidb" target="_blank">https://www.ripsa.org.br/fichasidb</a>';

    // Determina o número de páginas do PDF
            $numero_paginas = 'não informado';
            if (!empty($pdf_file_path)) {
                if (file_exists($pdf_file_path)) {
            $pdf_content = file_get_contents($pdf_file_path); // Lê o conteúdo do PDF
            preg_match_all("/\/Type\s*\/Page\b/", $pdf_content, $matches); // Encontra todas as ocorrências de '/Type /Page'
            $numero_paginas = count($matches[0]); // Conta as ocorrências
        }
    }

    // Gera a citação
    $citacao = "Rede Interagencial de Informações para a Saúde. Comitê de Gestão de Indicadores $tema. $titulo. In: Ficha de Qualificação do Indicador. Brasília: Ripsa; 2025. Disponível em: $url. doi:$doi.";
    ?>
    <p><?php echo $citacao; ?></p>
</div>

<!-- Seção Direitos Creative Commons -->
<div class="data-box">
    <p>
        <span style="display: flex; align-items: center; padding: 10px 0;">
            <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/" target="_blank"
            style="text-decoration: none; color: inherit; display: flex; align-items: center;">
            <img src="<?php echo plugins_url('images/by-nc-sa.png', __FILE__); ?>" alt="cc-by-4.0 icon"
            style="width:80px; height:28px; margin-right: 8px;">
            <span style="font-size: 9px; line-height: 1.2;">Esta obra está sob a licença </br>Creative
            Commons Attribution – NonCommercial – ShareAlike – 4.0 International</span>
        </a>
    </span>
</p>
</div>
<?php else: ?>
    <p>Não foi possível recuperar os dados.</p>
<?php endif; ?>
</div>
</div>

<!-- Segunda coluna: Botões com ícones -->
<div class="column-right">

    <div class="box-container">
        <!-- Adiciona a nova caixa -->
        <?php if (isset($data['doi']) && !empty($data['doi'])): ?>
        <div class="data-box doi-box">
            <h3>DOI</h3> <a href="https://doi.org/<?php echo $data['doi']; ?>"
                target="_blank"><?php echo $data['doi']; ?></a>
            </div>
        <?php endif; ?>

        <!-- Botão para baixar PDF -->
        <?php if ($pdf_file_url): ?>
            <div class="button-box">
                <a href="<?php echo $pdf_file_url; ?>" class="btn-icon" target="_blank" download>
                    <i class="fa-solid fa-file-pdf"></i> PDF
                </a>
            </div>
        <?php endif; ?>

        <div class="button-box">
            <a href="<?php echo 'http://tabnet2.datasus.gov.br/cgi/dhx3.py?idb2025/' . strtolower($codigo_indicador) . '.def'; ?>" class="btn-icon" target="_blank">
                <i class="fa-solid fa-table"></i> TABNET<sub>BD</sub>
            </a>
        </div>
    </div>

</div>
</div>
</div>

<?php
// Inclua o rodapé e outras partes do template conforme necessário
get_footer();
?>

<script>
    document.getElementById('print-button')?.addEventListener('click', function() {
        var printContent = document.getElementById('content-to-print').innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    });
</script>