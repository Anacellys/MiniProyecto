<?php
/**
 * Vista resultado del Problema #4
 * Suma de números pares e impares del 1 al 200
 *

 */

use App\Utilities\SecurityUtility;

include VIEWS_PATH . 'header.php';
?>

<div class="card">
    <div class="card-header">
        <h2>Problema #4: Suma de Pares e Impares</h2>
        <p class="mb-0" style="font-size: 0.9rem;">
            Cálculo de sumas independientes usando ciclo for
        </p>
    </div>
    <div class="card-body">
        <div class="alert alert-success-custom">
            <strong>✓ Cálculo completado exitosamente</strong>
        </div>

        <div class="result-section">
            <div class="result-title">Configuración del Cálculo</div>
            <div class="result-item">
                <span class="result-label">Rango inicial:</span>
                <span class="result-value"><?php echo $completeInfo['range']['start']; ?></span>
            </div>
            <div class="result-item">
                <span class="result-label">Rango final:</span>
                <span class="result-value"><?php echo $completeInfo['range']['end']; ?></span>
            </div>
            <div class="result-item">
                <span class="result-label">Tipo de ciclo:</span>
                <span class="result-value">FOR con IF</span>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Números Pares -->
            <div class="col-md-6">
                <div class="result-section" style="background-color: #e8f4f8; border-left-color: #3498db;">
                    <div class="result-title" style="color: #3498db;">
                        Números Pares
                    </div>
                    <div class="result-item">
                        <span class="result-label">Cantidad:</span>
                        <span class="result-value"><?php echo $completeInfo['evenCount']; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Suma total:</span>
                        <span class="result-value" style="font-size: 1.3rem;">
                            <?php echo number_format($completeInfo['evenSum'], 0, '.', ','); ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Números Impares -->
            <div class="col-md-6">
                <div class="result-section" style="background-color: #f0e8f8; border-left-color: #9b59b6;">
                    <div class="result-title" style="color: #9b59b6;">
                        Números Impares
                    </div>
                    <div class="result-item">
                        <span class="result-label">Cantidad:</span>
                        <span class="result-value"><?php echo $completeInfo['oddCount']; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Suma total:</span>
                        <span class="result-value" style="font-size: 1.3rem;">
                            <?php echo number_format($completeInfo['oddSum'], 0, '.', ','); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total -->
        <div class="result-section mt-4" style="background-color: #e8f8e8; border-left-color: var(--success-color);">
            <div class="result-title" style="color: var(--success-color);">
                Totales
            </div>
            <div class="result-item">
                <span class="result-label">Suma de pares + impares:</span>
                <span class="result-value" style="font-size: 1.2rem;">
                    <?php echo number_format($completeInfo['totalSum'], 0, '.', ','); ?>
                </span>
            </div>
        </div>

        <!-- Listados Detallados -->
        <hr class="my-4">

        <div class="row">
            <div class="col-md-6">
                <div class="result-section">
                    <div class="result-title" style="color: #3498db;">
                        Listado de Pares
                    </div>
                    <div style="background: white; padding: 10px; border-radius: 5px; max-height: 300px; overflow-y: auto;">
                        <small>
                            <?php
                            $evenFormatted = implode(', ', $completeInfo['evenNumbers']);
                            echo SecurityUtility::sanitizeOutput($evenFormatted);
                            ?>
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="result-section">
                    <div class="result-title" style="color: #9b59b6;">
                        Listado de Impares
                    </div>
                    <div style="background: white; padding: 10px; border-radius: 5px; max-height: 300px; overflow-y: auto;">
                        <small>
                            <?php
                            $oddFormatted = implode(', ', $completeInfo['oddNumbers']);
                            echo SecurityUtility::sanitizeOutput($oddFormatted);
                            ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 p-3" style="background-color: #f5f5f5; border-radius: 5px;">
            <p class="mb-2">
                <strong>Estructura del código:</strong>
            </p>
            <pre style="background: #fff; padding: 10px; border-radius: 3px; font-size: 0.85rem;"><code>for ($i = 1; $i <= 200; $i++) {
    if ($i % 2 === 0) {
        evenSum += $i;  // Es par
    } else {
        oddSum += $i;   // Es impar
    }
}</code></pre>
        </div>
    </div>
</div>

<a href="?action=menu" class="link-back">← Volver al Menú Principal</a>

<?php include VIEWS_PATH . 'footer.php'; ?>
