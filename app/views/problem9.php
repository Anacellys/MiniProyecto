<?php
/**
 * Vista del Problema #9
 * Potencias
 */

use App\Utilities\SecurityUtility;

include VIEWS_PATH . 'header.php';

$csrfToken = SecurityUtility::generateCsrfToken();
?>

<div class="card">
    <div class="card-header">
        <h2>Problema #9: Potencias</h2>
        <p class="mb-0" style="font-size: 0.9rem;">
            Ingresa un número entre 1 y 9 para calcular sus <strong>15 primeras potencias</strong>.
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

            <div class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label for="number" class="form-label"><strong>Número (1 a 9)</strong></label>
                    <input
                        type="number"
                        class="form-control form-control-lg"
                        id="number"
                        name="number"
                        min="1"
                        max="9"
                        step="1"
                        required
                        value="<?php echo isset($formData['number']) ? SecurityUtility::sanitizeOutput($formData['number']) : ''; ?>"
                    />
                </div>

                <div class="col-md-6 d-grid">
                    <button type="submit" class="btn btn-primary-custom btn-lg">
                        Calcular Potencias
                    </button>
                </div>
            </div>
        </form>

        <?php if ($result !== null):
            $info = $result['info'];
            $base = (int) $info['base'];
            $chartLabels = $info['chart']['chartLabels'];
            $chartData = $info['chart']['chartData'];
        ?>
            <hr class="my-4" />

            <div class="result-section" style="background: linear-gradient(135deg, rgba(46,204,113,0.16), rgba(255,255,255,0.9)); border-left-color: var(--success-color);">
                <div class="result-title">Potencias</div>

                <div class="row">
                    <div class="col-12">
                        <div style="background: white; padding: 14px; border-radius: 10px; border: 1px solid rgba(39,174,96,0.18); max-height: 340px; overflow-y: auto;">
                            <?php foreach ($info['powers'] as $idx => $power):
                                $exp = $idx + 1;
                            ?>
                                <div class="result-item" style="border-bottom: 1px solid #ecf0f1;">
                                    <span class="result-label"><?php echo SecurityUtility::sanitizeOutput($base . '^' . $exp); ?></span>
                                    <span class="result-value"><?php echo SecurityUtility::sanitizeOutput(number_format((float)$power, 0, '.', ',')); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="result-section" style="margin-top: 20px; background-color: #f7f9fb;">
                <div class="result-title">Gráfica</div>
                <div style="position: relative; height: 360px; background: white; border-radius: 10px; padding: 12px;">
                    <canvas id="powersChart" aria-label="Gráfica de potencias" role="img"></canvas>
                </div>
                <p class="text-muted mb-0" style="font-size: 0.85rem;">
                    Crecimiento de <?php echo SecurityUtility::sanitizeOutput((string)$base); ?>^n para n=1..15.
                </p>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
            <script>
                (function() {
                    const ctx = document.getElementById('powersChart');
                    if (!ctx) return;

                    const labels = <?php echo json_encode($chartLabels, JSON_UNESCAPED_UNICODE); ?>;
                    const data = <?php echo json_encode($chartData, JSON_NUMERIC_CHECK); ?>;
                    const green = 'rgba(22, 163, 74, 0.80)';
                    const green2 = 'rgba(46, 204, 113, 0.85)';

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Potencias',
                                data: data,
                                borderColor: green,
                                backgroundColor: green2,
                                borderWidth: 2,
                                fill: true,
                                tension: 0.25,
                                pointRadius: 3,
                                pointHoverRadius: 5
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
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                })();
            </script>
        <?php endif; ?>
    </div>
</div>

<a href="?action=menu" class="link-back">← Volver al Menú Principal</a>

<?php include VIEWS_PATH . 'footer.php'; ?>

