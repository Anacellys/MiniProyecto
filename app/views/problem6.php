<?php
/**
 * Vista del Problema #6
 * Clasificación de Edades con estadísticas y gráfica
 */

use App\Utilities\SecurityUtility;

include VIEWS_PATH . 'header.php';

$csrfToken = SecurityUtility::generateCsrfToken();
?>

<div class="card">
    <div class="card-header">
        <h2>Problema #6: Clasificación de Edades</h2>
        <p class="mb-0" style="font-size: 0.9rem;">
            Ingresa las edades de 5 personas y obtén categorías + estadísticas con gráfica.
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

        <form method="POST" action="" class="age-form">
            <input type="hidden" name="csrf_token" value="<?php echo SecurityUtility::escapeAttribute($csrfToken); ?>" />

            <div class="row g-3">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <div class="col-md-4">
                        <label for="age<?php echo $i; ?>" class="form-label">
                            <strong>Edad #<?php echo $i; ?></strong>
                        </label>
                        <input
                            type="number"
                            class="form-control form-control-lg"
                            id="age<?php echo $i; ?>"
                            name="age<?php echo $i; ?>"
                            min="0"
                            step="1"
                            required
                            value="<?php echo isset($formData["age{$i}"]) ? SecurityUtility::sanitizeOutput($formData["age{$i}"]) : ''; ?>"
                        />
                    </div>
                <?php endfor; ?>
            </div>

            <button type="submit" class="btn btn-primary-custom btn-lg w-100" style="margin-top: 18px;">
                Clasificar y Graficar
            </button>
        </form>

        <?php if ($result !== null):
            $classifications = $result['statistics']['classifications'];
            $counts = $result['statistics']['counts'];
            $chartLabels = $result['chart']['chartLabels'];
            $chartData = $result['chart']['chartData'];
            $chartColors = $result['chart']['chartColors'];
        ?>

            <hr class="my-4">

            <div class="result-section" style="background: linear-gradient(135deg, rgba(46,204,113,0.16), rgba(255,255,255,0.9)); border-left-color: var(--success-color);">
                <div class="result-title" style="color: var(--success-color);">Resultados</div>

                <div class="row">
                    <div class="col-lg-7">
                        <div class="result-section" style="background-color: #ffffff; border-left-color: var(--success-color); box-shadow: none;">
                            <div class="result-title" style="font-size: 1.05rem; margin-bottom: 10px;">Clasificación por persona</div>
                            <?php foreach ($classifications as $item): ?>
                                <div class="result-item">
                                    <span class="result-label">Persona #<?php echo (int)$item['personIndex']; ?>:</span>
                                    <span class="result-value">
                                        <?php echo SecurityUtility::sanitizeOutput($item['age']); ?> — <?php echo SecurityUtility::sanitizeOutput($item['category']); ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="result-section" style="background-color: #ffffff; border-left-color: #2ecc71; box-shadow: none;">
                            <div class="result-title" style="font-size: 1.05rem; margin-bottom: 10px;">Totales por categoría</div>

                            <?php foreach ($counts as $category => $count): ?>
                                <div class="result-item">
                                    <span class="result-label"><?php echo SecurityUtility::sanitizeOutput($category); ?>:</span>
                                    <span class="result-value"><?php echo (int)$count; ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="result-section" style="margin-top: 20px;">
                <div class="result-title">Gráfica (Chart.js)</div>
                <div style="position: relative; height: 340px;">
                    <canvas id="ageChart" aria-label="Gráfica de clasificación de edades" role="img"></canvas>
                </div>

                <p class="text-muted mb-0" style="font-size: 0.85rem;">
                    Visualización por categoría: Niño, Adolescente, Adulto y Adulto mayor.
                </p>
            </div>

        <?php endif; ?>
    </div>
</div>

<a href="?action=menu" class="link-back">← Volver al Menú Principal</a>

<?php include VIEWS_PATH . 'footer.php'; ?>

<?php if ($result !== null): ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        (function() {
            const ctx = document.getElementById('ageChart');
            if (!ctx) return;

            const labels = <?php echo json_encode($chartLabels, JSON_UNESCAPED_UNICODE); ?>;
            const data = <?php echo json_encode($chartData, JSON_NUMERIC_CHECK); ?>;
            const colors = <?php echo json_encode($chartColors, JSON_UNESCAPED_UNICODE); ?>;

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Cantidad por categoría',
                        data: data,
                        backgroundColor: colors,
                        borderColor: colors,
                        borderWidth: 1,
                        borderRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const v = context.parsed.y;
                                    return ` ${v} personas`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        }
                    }
                }
            });
        })();
    </script>
<?php endif; ?>

