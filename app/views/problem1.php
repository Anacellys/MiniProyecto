<?php
/**
 * Vista del Problema #1
 * Formulario para ingreso de 5 números positivos
 * Muestra media, desviación estándar, mínimo y máximo
 *
 * @author Anacelly 
 
 */

use App\Utilities\SecurityUtility;

include VIEWS_PATH . 'header.php';
?>

<div class="card">
    <div class="card-header">
        <h2>Problema #1: Estadísticas de 5 Números</h2>
        <p class="mb-0" style="font-size: 0.9rem;">
            Ingresa 5 números positivos para calcular media, desviación estándar, mínimo y máximo
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

        <form method="POST" action="">
            <div class="row">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <label for="number<?php echo $i; ?>" class="form-label">
                            Número <?php echo $i; ?>
                        </label>
                        <input
                            type="number"
                            step="any"
                            class="form-control"
                            id="number<?php echo $i; ?>"
                            name="number<?php echo $i; ?>"
                            placeholder="Ingresa un número positivo"
                            required
                            value="<?php echo isset($formData["number{$i}"]) ? SecurityUtility::sanitizeOutput($formData["number{$i}"]) : ''; ?>"
                        >
                    </div>
                <?php endfor; ?>
            </div>

            <button type="submit" class="btn btn-primary-custom btn-lg w-100">
                Calcular Estadísticas
            </button>
        </form>

        <?php if ($result !== null): ?>
            <hr class="my-4">

            <div class="alert alert-success-custom">
                <strong>✓ Cálculo completado exitosamente</strong>
            </div>

            <div class="result-section">
                <div class="result-title">Números Ingresados</div>
                <div class="result-item">
                    <span class="result-label">Valores:</span>
                    <span class="result-value">
                        <?php echo implode(', ', array_map(function($n) { return number_format($n, 2, '.', ','); }, $result['numbers'])); ?>
                    </span>
                </div>
            </div>

            <div class="result-section">
                <div class="result-title">Resultados</div>
                <div class="result-item">
                    <span class="result-label">Cantidad de números:</span>
                    <span class="result-value"><?php echo $result['count']; ?></span>
                </div>
                <div class="result-item">
                    <span class="result-label">Suma total:</span>
                    <span class="result-value"><?php echo number_format($result['sum'], 2, '.', ','); ?></span>
                </div>
                <div class="result-item">
                    <span class="result-label">Media (promedio):</span>
                    <span class="result-value"><?php echo number_format($result['mean'], 4, '.', ','); ?></span>
                </div>
                <div class="result-item">
                    <span class="result-label">Desviación estándar:</span>
                    <span class="result-value"><?php echo number_format($result['standardDeviation'], 4, '.', ','); ?></span>
                </div>
                <div class="result-item">
                    <span class="result-label">Valor mínimo:</span>
                    <span class="result-value"><?php echo number_format($result['min'], 2, '.', ','); ?></span>
                </div>
                <div class="result-item">
                    <span class="result-label">Valor máximo:</span>
                    <span class="result-value"><?php echo number_format($result['max'], 2, '.', ','); ?></span>
                </div>
            </div>

            <div class="mt-4">
                <p class="text-muted">
                    <strong>Fórmula de desviación estándar:</strong> √(Σ(x - media)² / n)
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>

<a href="?action=menu" class="link-back">← Volver al Menú Principal</a>

<?php include VIEWS_PATH . 'footer.php'; ?>
