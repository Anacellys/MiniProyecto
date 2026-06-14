<?php
/**
 * Vista del Problema #7
 * Presupuesto Hospitalario
 */

use App\Utilities\SecurityUtility;

include VIEWS_PATH . 'header.php';
?>

<div class="card">
    <div class="card-header">
        <h2>Problema #7: Presupuesto Hospitalario</h2>
        <p class="mb-0" style="font-size: 0.9rem;">
            Repartición del presupuesto con porcentajes fijos (40% / 35% / 25%).
        </p>
    </div>

    <div class="card-body">
        <?php
            $csrfToken = SecurityUtility::generateCsrfToken();
            $hasErrors = !empty($errors);
            $hasResult = $result !== null;
        ?>

        <?php if ($hasErrors): ?>
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
                <div class="col-md-7">
                    <label for="budget_total" class="form-label">
                        <strong>Presupuesto total</strong>
                    </label>
                    <input
                        type="number"
                        class="form-control form-control-lg"
                        id="budget_total"
                        name="budget_total"
                        min="0"
                        step="any"
                        required
                        value="<?php echo isset($formData['budget_total']) ? SecurityUtility::sanitizeOutput($formData['budget_total']) : ''; ?>"
                    />
                    <div class="text-muted" style="margin-top: 6px; font-size: 0.85rem;">
                        Ingrese un valor positivo. Si es 0 se mostrará un mensaje informativo.
                    </div>
                </div>

                <div class="col-md-5 d-grid">
                    <button type="submit" class="btn btn-primary-custom btn-lg">
                        Calcular distribución
                    </button>
                </div>
            </div>
        </form>

        <?php if ($hasResult):
            $distribution = $result['distribution'];
            $budgets = $distribution['budgets'];
            $total = (float) $distribution['total'];
            $percentages = $distribution['percentages'];

            $chartLabels = $result['chart']['chartLabels'];
            $chartDataValues = $result['chart']['chartData'];
            $chartColors = $result['chart']['chartColors'];
        ?>

            <hr class="my-4" />

            <div class="row g-3">
                <div class="col-12 col-lg-4">
                    <div class="result-section" style="background: #ffffff; border-left-color: #16a34a;">
                        <div class="result-title" style="margin-bottom: 10px;">
                            <span>🩺</span> Ginecología (40%)
                        </div>
                        <div class="result-item">
                            <span class="result-label">Presupuesto:</span>
                            <span class="result-value">$<?php echo SecurityUtility::sanitizeOutput(number_format((float)$budgets['Ginecología'], 2, '.', ',')); ?></span>
                        </div>
                        <div class="result-item">
                            <span class="result-label">Participación:</span>
                            <span class="result-value"><?php echo SecurityUtility::sanitizeOutput(number_format((float)$percentages['Ginecología'], 2, '.', ',')); ?>%</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="result-section" style="background: #ffffff; border-left-color: #2ecc71;">
                        <div class="result-title" style="margin-bottom: 10px;">
                            <span>🦴</span> Traumatología (35%)
                        </div>
                        <div class="result-item">
                            <span class="result-label">Presupuesto:</span>
                            <span class="result-value">$<?php echo SecurityUtility::sanitizeOutput(number_format((float)$budgets['Traumatología'], 2, '.', ',')); ?></span>
                        </div>
                        <div class="result-item">
                            <span class="result-label">Participación:</span>
                            <span class="result-value"><?php echo SecurityUtility::sanitizeOutput(number_format((float)$percentages['Traumatología'], 2, '.', ',')); ?>%</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="result-section" style="background: #ffffff; border-left-color: #27ae60;">
                        <div class="result-title" style="margin-bottom: 10px;">
                            <span>👶</span> Pediatría (25%)
                        </div>
                        <div class="result-item">
                            <span class="result-label">Presupuesto:</span>
                            <span class="result-value">$<?php echo SecurityUtility::sanitizeOutput(number_format((float)$budgets['Pediatría'], 2, '.', ',')); ?></span>
                        </div>
                        <div class="result-item">
                            <span class="result-label">Participación:</span>
                            <span class="result-value"><?php echo SecurityUtility::sanitizeOutput(number_format((float)$percentages['Pediatría'], 2, '.', ',')); ?>%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="result-section" style="margin-top: 18px; background-color: #f7f9fb; border-left-color: #16a34a;">
                <div class="result-title">Total anual</div>
                <div class="result-item">
                    <span class="result-label">Suma total:</span>
                    <span class="result-value" style="font-size: 1.5rem;">$<?php echo SecurityUtility::sanitizeOutput(number_format($total, 2, '.', ',')); ?></span>
                </div>
            </div>

            <div class="result-section" style="margin-top: 18px;">
                <div class="result-title">Gráfica de distribución</div>
                <div style="position: relative; height: 360px;">
                    <canvas id="budgetChart" aria-label="Gráfica del presupuesto por área" role="img"></canvas>
                </div>
                <p class="text-muted mb-0" style="font-size: 0.85rem;">
                    Visualización responsiva con paleta verde.
                </p>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
            <script>
                (function() {
                    const ctx = document.getElementById('budgetChart');
                    if (!ctx) return;

                    const labels = <?php echo json_encode($chartLabels, JSON_UNESCAPED_UNICODE); ?>;
                    const data = <?php echo json_encode($chartDataValues, JSON_NUMERIC_CHECK); ?>;
                    const colors = <?php echo json_encode($chartColors, JSON_UNESCAPED_UNICODE); ?>;

                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: labels,
                            datasets: [{
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
                                legend: { position: 'bottom' },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const v = context.parsed;
                                            const val = (typeof v === 'number') ? v : context.raw;
                                            return ` $${val.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                                        }
                                    }
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


