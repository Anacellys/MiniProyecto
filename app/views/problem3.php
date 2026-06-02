<?php
/**
 * Vista del Problema #3
 * Formulario para ingreso de N (cantidad de múltiplos)
 *
 * @author Desarrollador Senior PHP
 * @version 1.0
 */

use App\Utilities\SecurityUtility;

include VIEWS_PATH . 'header.php';
?>

<div class="card">
    <div class="card-header">
        <h2>Problema #3: N Primeros Múltiplos de 4</h2>
        <p class="mb-0" style="font-size: 0.9rem;">
            Ingresa un valor N para generar los N primeros múltiplos de 4
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
            <div class="mb-4">
                <label for="n" class="form-label">
                    <strong>Cantidad de múltiplos (N):</strong>
                </label>
                <input
                    type="number"
                    class="form-control form-control-lg"
                    id="n"
                    name="n"
                    placeholder="Ingresa un número entero positivo"
                    required
                    value="<?php echo isset($formData['n']) ? SecurityUtility::sanitizeOutput($formData['n']) : ''; ?>"
                    min="1"
                >
                <small class="text-muted">Ingresa un número entero positivo (ej: 10, 15, 20)</small>
            </div>

            <button type="submit" class="btn btn-primary-custom btn-lg w-100">
                Generar Múltiplos
            </button>
        </form>

        <?php if ($result !== null): ?>
            <hr class="my-4">

            <div class="alert alert-success-custom">
                <strong>✓ Múltiplos generados exitosamente</strong>
            </div>

            <div class="result-section">
                <div class="result-title">Información</div>
                <div class="result-item">
                    <span class="result-label">Cantidad solicitada:</span>
                    <span class="result-value"><?php echo $result['n']; ?></span>
                </div>
                <div class="result-item">
                    <span class="result-label">Multiplicador:</span>
                    <span class="result-value"><?php echo $result['multiplier']; ?></span>
                </div>
                <div class="result-item">
                    <span class="result-label">Suma de múltiplos:</span>
                    <span class="result-value"><?php echo number_format($result['sum'], 0, '.', ','); ?></span>
                </div>
            </div>

            <div class="result-section">
                <div class="result-title">Múltiplos Generados</div>
                <div style="background: white; padding: 15px; border-radius: 5px; max-height: 400px; overflow-y: auto;">
                    <?php foreach ($result['formatted'] as $index => $multiple): ?>
                        <div class="result-item">
                            <span><?php echo $index + 1; ?>.</span>
                            <span class="result-value"><?php echo SecurityUtility::sanitizeOutput($multiple); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<a href="?action=menu" class="link-back">← Volver al Menú Principal</a>

<?php include VIEWS_PATH . 'footer.php'; ?>
