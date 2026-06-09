<?php
/**
 * Controlador Problem5Controller
 * Estación del Año
 */

namespace App\Controllers;

use App\Models\SeasonModel;
use App\Utilities\SecurityUtility;
use App\Utilities\ValidationUtility;

class Problem5Controller
{
    private const DATE_REGEX_DD_MM = '/^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[0-2])$/';
    private const DATE_REGEX_Y_M_D = '/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/';


    public function handle(): void
    {
        $result = null;
        $errors = [];
        $formData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->processForm($errors, $formData);
        }

        include VIEWS_PATH . 'problem5.php';
    }

    private function processForm(array &$errors, array &$formData): ?array
    {
        $csrfToken = isset($_POST['csrf_token']) ? (string) $_POST['csrf_token'] : '';
        if (!SecurityUtility::verifyCsrfToken($csrfToken)) {
            $errors[] = 'Solicitud no válida. Intenta nuevamente.';
            return null;
        }

        $inputDate = $_POST['date'] ?? null;
        $dateRaw = $this->sanitizeDateInput($inputDate);
        $formData['date'] = $dateRaw;

        if (!ValidationUtility::isNotEmpty($dateRaw)) {
            $errors[] = 'La fecha no puede estar vacía.';
            return null;
        }

        // Compatibilidad con el date-picker (formato YYYY-MM-DD) y el formato original DD/MM
        if (ValidationUtility::validateWithRegex($dateRaw, self::DATE_REGEX_Y_M_D)) {
            [$day, $month] = $this->parseYearMonthDay($dateRaw);
            $normalized = sprintf('%02d/%02d', $day, $month);
            $dateRaw = $normalized;
        } else {
            if (!ValidationUtility::validateWithRegex($dateRaw, self::DATE_REGEX_DD_MM)) {
                $errors[] = 'Formato inválido. Usa DD/MM (ej: 21/12) o selecciona una fecha en el calendario.';
                return null;
            }
            [$day, $month] = $this->parseDayMonth($dateRaw);
        }


        if (!$this->validateDateRange($day, $month)) {
            $errors[] = 'La fecha ingresada no es válida.';
            return null;
        }

        $model = new SeasonModel($day, $month);
        $seasonInfo = $model->getSeasonInfo();

        return [
            'inputDate' => $dateRaw,
            'seasonInfo' => $seasonInfo,
        ];
    }

    private function sanitizeDateInput($input): string
    {
        return SecurityUtility::sanitizeInput($input);
    }

    private function parseDayMonth(string $date): array
    {
        $parts = explode('/', $date);
        $day = (int) ($parts[0] ?? 0);
        $month = (int) ($parts[1] ?? 0);

        return [$day, $month];
    }

    private function parseYearMonthDay(string $date): array
    {
        // YYYY-MM-DD
        $parts = explode('-', $date);
        $day = (int) ($parts[2] ?? 0);
        $month = (int) ($parts[1] ?? 0);

        return [$day, $month];
    }


    private function validateDateRange(int $day, int $month): bool
    {
        // Asegura días y meses en rangos válidos (sin validar meses con diferentes días por simplicidad).
        // El regex ya controla rangos: día 01..31 y mes 01..12.
        if ($month < 1 || $month > 12) {
            return false;
        }
        if ($day < 1 || $day > 31) {
            return false;
        }
        return true;
    }
}
?>

