<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

<div class="header-banner"><?php echo $category_name; ?></div>

<div class="container-bread-indicadores">
    <div class="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url($idb_plugin_slug); ?>">Fichas IDB</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a><?php echo $category_name; ?></a></li>
            </ol>
        </nav>
    </div>
</div>

<div class="dem-container">
    <div class="left-column">
        <div class="indicator-circle">
            <img src="<?php echo plugin_dir_url(__FILE__) . 'images/icons/' . $category_image; ?>" alt="<?php echo $category_name; ?>" class="dem-icon">
        </div>
        <div class="dem-label"><?php echo $category_name; ?></div>
        <div class="vertical-line"></div>
    </div>

    <div class="right-column">
        <div class="accordion-container">
             <?php foreach ($grupos as $key => $fichas): ?>
                <div class="accordion-item">
                    <button class="accordion-toggle">
                        <span class="circle">+</span>
                        <strong>Dimensão <?php echo explode('.', $key)[1]; ?>:</strong> <?php echo $dimensoes[$key] ?? ''; ?>
                    </button>
                    <div class="accordion-content">
                        <?php foreach ($fichas as $indicador): ?>
                        <?php
                            $titulo = $indicador['titulo'];
                            $codigo_api = $indicador['codigo'];
                            $codigo_indicador = '';
                            if (preg_match('/^([^–-]+)\s*[–-]\s*(.+)$/u', $titulo, $m)) {
                                $codigo_indicador = trim($m[1]);   // FRP.9.01
                                $titulo = trim($m[2]);   // Índice CPO-D (...)
                            }
                            // Obtenha o código diretamente da query string da URL
                            $param_code = isset($indicador['link']) ? explode('code=', $indicador['link'])[1] : '';

                            // Construa o link da página ou utilize o código padrão
                            $link = isset($indicador['link']) ? $indicador['link'] : '#';
                        ?>
                        <a href="a-demografico/ficha?code=<?php echo $codigo_api; ?>" class="btn-indicator">
                            <div class="indicator-code"><?php echo $codigo_indicador; ?></div>
                            <div class="indicator-name"><?php echo $titulo; ?></div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<style>
body { font-family: 'Inter', sans-serif; }
.header-banner {
    text-align: center; font-size: 28px; font-weight: 700;
    margin: 40px 0 10px; color: #2e318f;
}
.container-bread-indicadores {
    max-width: 1100px; margin: 0 auto 30px; padding: 0 20px;
}
.dem-container {
    display: flex; flex-direction: row; align-items: flex-start;
    max-width: 1100px; margin: 0 auto 40px; padding: 0 20px;
}
.left-column {
    text-align: center; margin-right: 40px;
}
.indicator-circle {
    width: 120px; height: 120px; background-color: white;
    border: 4px solid #2e7d32; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto;
}
.dem-icon {
    width: 64px; height: 64px;
}
.dem-label {
    background-color: #2e7d32; color: white; font-weight: bold;
    border-radius: 20px; padding: 6px 16px; margin-top: 10px;
    display: inline-block; font-size: 18px;
}
.vertical-line {
    width: 4px; height: 100%; background-color: #2e7d32;
    margin: 10px auto;
}
.right-column { flex: 1; }
.accordion-toggle {
    background-color: #2e318f; color: white; font-size: 16px;
    font-weight: bold; padding: 12px 20px; margin: 10px 0;
    border: none; border-radius: 30px; width: 100%;
    text-align: left; position: relative; cursor: pointer;
    transition: background-color 0.3s ease;
}
.accordion-toggle:hover,
.accordion-item.active .accordion-toggle,
.accordion-toggle:focus {
    background-color: #2e7d32; color: white; outline: none;
}
.accordion-toggle .circle {
    background-color: #2e7d32; border-radius: 50%;
    width: 24px; height: 24px; display: inline-block;
    color: white; font-size: 18px;
    text-align: center; line-height: 24px;
    margin-right: 10px;
}
.accordion-content { display: none; padding-left: 20px; }
.accordion-item.active .accordion-content { display: block; }
.btn-indicator {
    background-color: #ffffff; border: 1px solid #ccc;
    border-radius: 12px; padding: 10px; margin: 6px 0;
    width: 100%; text-align: left; cursor: pointer;
    transition: background-color 0.3s ease;
}
.btn-indicator:hover,
.btn-indicator:focus {
    background-color: #eee;
}
.btn-indicator.disabled {
    opacity: 0.5; cursor: not-allowed;
}
</style>

<script>
document.querySelectorAll('.accordion-toggle').forEach(button => {
    button.addEventListener('click', () => {
        const item = button.parentElement;
        item.classList.toggle('active');

        const icon = button.querySelector('.circle');
        icon.textContent = item.classList.contains('active') ? '−' : '+';
    });
});
</script>
