<?php
/**
 * Vista del Problema #5
 * Estación del Año
 */

use App\Utilities\SecurityUtility;

include VIEWS_PATH . 'header.php';

$csrfToken = SecurityUtility::generateCsrfToken();
?>

<div class="card">
    <div class="card-header">
        <h2>Problema #5: Estación del Año</h2>
        <p class="mb-0" style="font-size: 0.9rem;">
            Ingresa una fecha (día y mes) y obtén la estación según el calendario.
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

        <form method="POST" action="" class="season-form">
            <input type="hidden" name="csrf_token" value="<?php echo SecurityUtility::escapeAttribute($csrfToken); ?>" />

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="date" class="form-label">
                        <strong>Fecha (DD/MM)</strong>
                    </label>
                    <input
                        type="date"
                        class="form-control form-control-lg"
                        id="date"
                        name="date"
                        required
                        value="<?php echo isset($formData['date']) ? SecurityUtility::sanitizeOutput($formData['date']) : ''; ?>"
                        autocomplete="off"
                    />
                    <div class="text-muted" style="margin-top: 6px; font-size: 0.85rem;">
                        Selecciona un día y mes (año ignorado).
                    </div>

                </div>

                <div class="col-md-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary-custom btn-lg w-100">
                        Determinar Estación
                    </button>
                </div>
            </div>
        </form>

        <?php if ($result !== null):
            $seasonInfo = $result['seasonInfo'];
            $seasonName = SecurityUtility::sanitizeOutput($seasonInfo['season']);
        ?>
            <hr class="my-4">

            <div class="result-section" style="background: linear-gradient(135deg, rgba(39,174,96,0.18), rgba(255,255,255,0.8)); border-left-color: var(--success-color);">
                <div class="result-title" style="color: var(--success-color);">Resultado</div>

                <div class="result-item">
                    <span class="result-label">Fecha ingresada:</span>
                    <span class="result-value"><?php echo SecurityUtility::sanitizeOutput($result['inputDate']); ?></span>
                </div>

                <div class="result-item">
                    <span class="result-label">Estación:</span>
                    <span class="result-value" style="font-size: 1.35rem;">
                        <?php echo $seasonName; ?>
                    </span>
                </div>

                <?php
                    $seasonKey = $seasonInfo['season'];
                    $imgSrc = '';
                    switch ($seasonKey) {
                        case \App\Models\SeasonModel::SEASON_WINTER:
                            $imgSrc = 'public/recursos/estaciones/invierno.jpg';
                            break;
                        case \App\Models\SeasonModel::SEASON_SUMMER:
                            $imgSrc = 'public/recursos/estaciones/verano.jpg';
                            break;
                        case \App\Models\SeasonModel::SEASON_SPRING:
                            $imgSrc = 'public/recursos/estaciones/primavera.jpg';
                            break;
                        case \App\Models\SeasonModel::SEASON_AUTUMN:
                            $imgSrc = 'public/recursos/estaciones/otono.jpg';
                            break;
                        default:
                            $imgSrc = 'public/recursos/estaciones/primavera.jpg';
                            break;
                    }
                ?>

                <div class="mt-3" style="text-align: center;">
                    <img
                        src="<?php echo SecurityUtility::sanitizeOutput($imgSrc); ?>"
                        alt="Imagen representativa de la estación"
                        style="width: 100%; max-width: 520px; height: auto; border-radius: 12px; box-shadow: 0 10px 25px rgba(39,174,96,0.15); border: 1px solid rgba(39,174,96,0.25);"
                    />
                </div>


                <div class="mt-3" style="background: rgba(255,255,255,0.75); padding: 14px; border-radius: 10px; border: 1px solid rgba(39,174,96,0.25);">
                    <p class="mb-0" style="color: #2d3436; font-size: 0.95rem;">
                        Rangos usados (sin depender del año):
                        <br>
                        <span style="color: var(--secondary-color); font-weight: 700;">21 Dic–20 Mar</span> Verano,
                        <span style="color: var(--secondary-color); font-weight: 700;">21 Mar–21 Jun</span> Otoño,
                        <span style="color: var(--secondary-color); font-weight: 700;">22 Jun–22 Sep</span> Invierno,
                        <span style="color: var(--secondary-color); font-weight: 700;">23 Sep–20 Dic</span> Primavera.
                    </p>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<a href="?action=menu" class="link-back">← Volver al Menú Principal</a>

<?php include VIEWS_PATH . 'footer.php'; ?>

