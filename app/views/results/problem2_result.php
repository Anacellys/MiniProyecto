<?php
/**
 * Vista resultado del Problema #2
 * Muestra la suma de 1 al 1000 con procedimiento
 *
 * @author Desarrollador Senior PHP
 * @version 1.0
 */

use App\Utilities\SecurityUtility;

include VIEWS_PATH . 'header.php';
?>

<div class="card">
    <div class="card-header">
        <h2>Problema #2: Suma de 1 al 1000</h2>
        <p class="mb-0" style="font-size: 0.9rem;">
            Cálculo automático usando ciclo for
        </p>
    </div>
    <div class="card-body">
        <div class="alert alert-success-custom">
            <strong>✓ Cálculo completado exitosamente</strong>
        </div>

        <div class="result-section">
            <div class="result-title">Configuración del Cálculo</div>
            <div class="result-item">
                <span class="result-label">Rango:</span>
                <span class="result-value">1 hasta <?php echo $calculationInfo['limit']; ?></span>
            </div>
            <div class="result-item">
                <span class="result-label">Total de iteraciones:</span>
                <span class="result-value"><?php echo $calculationInfo['allStepsCount']; ?></span>
            </div>
            <div class="result-item">
                <span class="result-label">Tipo de ciclo:</span>
                <span class="result-value">FOR</span>
            </div>
        </div>

        <div class="result-section">
            <div class="result-title">Procedimiento Parcial</div>
            <p class="mb-3" style="color: #555; font-size: 0.9rem;">
                Mostrando pasos principales (cada 100 iteraciones):
            </p>
            <div style="background: white; padding: 15px; border-radius: 5px;">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                        <tr style="background-color: #ecf0f1;">
                            <th>Iteración</th>
                            <th>Suma Acumulada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($calculationInfo['steps'] as $step): ?>
                            <tr>
                                <td>
                                    <code><?php echo $step['number']; ?></code>
                                </td>
                                <td>
                                    <strong><?php echo number_format($step['sum'], 0, '.', ','); ?></strong>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="result-section" style="background-color: #e8f8f5; border-left-color: var(--success-color);">
            <div class="result-title" style="color: var(--success-color);">Resultado Final</div>
            <div style="text-align: center; padding: 30px 0;">
                <h1 style="color: var(--success-color); margin-bottom: 10px;">
                    <?php echo number_format($calculationInfo['sum'], 0, '.', ','); ?>
                </h1>
                <p style="color: #555;">
                    La suma de todos los números del 1 al <?php echo $calculationInfo['limit']; ?>
                </p>
            </div>
        </div>

        <div class="mt-4 p-3" style="background-color: #f5f5f5; border-radius: 5px;">
            <p class="mb-0">
                <strong>Fórmula matemática:</strong> n × (n + 1) / 2 = <?php echo $calculationInfo['limit']; ?> × (<?php echo $calculationInfo['limit']; ?> + 1) / 2
            </p>
        </div>
    </div>
</div>

<a href="?action=menu" class="link-back">← Volver al Menú Principal</a>

<?php include VIEWS_PATH . 'footer.php'; ?>
