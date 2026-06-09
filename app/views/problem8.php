<?php
/**
 * Vista del Problema #8
 * Calculadora de Datos Estadísticos
 */

use App\Utilities\SecurityUtility;

include VIEWS_PATH . 'header.php';

$csrfToken = SecurityUtility::generateCsrfToken();
?>

<div class="card">
    <div class="card-header">
        <h2>Problema #8: Calculadora de Datos Estadísticos</h2>
        <p class="mb-0" style="font-size: 0.9rem;">
            Ingresa la cantidad de notas y luego tus datos. Se calculan media, desviación estándar, mínimo y máximo.
        </p>
    </div>

    <div class="card-body">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger-custom">
                <strong>Errores encontrados:</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo SecurityUtility::sanitizeOutput($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="stats-form">
            <input type="hidden" name="csrf_token" value="<?php echo SecurityUtility::escapeAttribute($csrfToken); ?>" />

            <div class="row g-3 mb-2">
                <div class="col-md-6">
                    <label for="count" class="form-label"><strong>Cantidad de notas</strong></label>
                    <input
                        type="number"
                        class="form-control form-control-lg"
                        id="count"
                        name="count"
                        min="1"
                        step="1"
                        required
                        value="<?php echo isset($formData['count']) ? SecurityUtility::sanitizeOutput($formData['count']) : ''; ?>"
                    />
                    <div class="text-muted" style="margin-top: 6px; font-size: 0.85rem;">
                        Luego presiona “Ingresar Notas” para generar el formulario dinámico.
                    </div>
                </div>

                <div class="col-md-6 d-flex align-items-end">
                    <button type="button" class="btn btn-secondary-custom btn-lg w-100" onclick="renderNotes()">
                        Ingresar Notas
                    </button>
                </div>
            </div>

            <div id="notesContainer" class="mb-3"></div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary-custom btn-lg">
                    Calcular Estadísticas
                </button>
            </div>
        </form>

        <?php if ($result !== null):
            $stats = $result['statistics'];
            $chart = $result['chart'];
        ?>
            <hr class="my-4">

            <div class="result-section" style="background: linear-gradient(135deg, rgba(46,204,113,0.16), rgba(255,255,255,0.9)); border-left-color: var(--success-color);">
                <div class="result-title">Resultados</div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="result-item">
                            <span class="result-label">Cantidad:</span>
                            <span class="result-value"><?php echo (int)$stats['count']; ?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="result-item">
                            <span class="result-label">Media:</span>
                            <span class="result-value"><?php echo number_format((float)$stats['mean'], 4, '.', ','); ?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="result-item">
                            <span class="result-label">Desv. Est.:</span>
                            <span class="result-value"><?php echo number_format((float)$stats['standardDeviation'], 4, '.', ','); ?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="result-item">
                            <span class="result-label">Min / Max:</span>
                            <span class="result-value"><?php echo number_format((float)$stats['min'], 2, '.', ','); ?> / <?php echo number_format((float)$stats['max'], 2, '.', ','); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="result-section" style="margin-top: 20px;">
                <div class="result-title">Gráfica de distribución (Chart.js)</div>
                <div style="position: relative; height: 360px;">
                    <canvas id="notesChart" aria-label="Gráfica de distribución de notas" role="img"></canvas>
                </div>
                <p class="text-muted mb-0" style="font-size: 0.85rem;">
                    Visualización por nota (orden de ingreso).
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>

<a href="?action=menu" class="link-back">← Volver al Menú Principal</a>

<?php include VIEWS_PATH . 'footer.php'; ?>

<script>
    function renderNotes() {
        const countEl = document.getElementById('count');
        const container = document.getElementById('notesContainer');
        const count = parseInt(countEl.value || '0', 10);

        if (!count || count < 1) {
            container.innerHTML = '';
            return;
        }

        let html = '';
        for (let i = 1; i <= count; i++) {
            html += `
                <div class="mb-3">
                    <label for="note${i}" class="form-label"><strong>Nota #${i}</strong></label>
                    <input
                        type="number"
                        class="form-control form-control-lg"
                        id="note${i}"
                        name="note${i}"
                        min="0"
                        step="any"
                        required
                    />
                </div>
            `;
        }
        container.innerHTML = html;
    }

    (function() {
        const countEl = document.getElementById('count');
        if (!countEl) return;
        if (countEl.value) {
            renderNotes();
        }
    })();
</script>

<?php if ($result !== null): ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        (function() {
            const ctx = document.getElementById('notesChart');
            if (!ctx) return;

            const labels = <?php echo json_encode($chart['chartLabels'], JSON_UNESCAPED_UNICODE); ?>;
            const data = <?php echo json_encode($chart['chartData'], JSON_NUMERIC_CHECK); ?>;
            const bg = <?php echo json_encode($chart['chartBackgroundColors'], JSON_UNESCAPED_UNICODE); ?>;
            const bd = <?php echo json_encode($chart['chartBorderColors'], JSON_UNESCAPED_UNICODE); ?>;

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Notas',
                        data: data,
                        backgroundColor: bg,
                        borderColor: bd,
                        borderWidth: 1,
                        borderRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: true }
                    },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        })();
    </script>
<?php endif; ?>


