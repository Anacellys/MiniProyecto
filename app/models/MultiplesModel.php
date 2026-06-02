<?php
/**
 * Modelo MultiplesModel
 * Gestiona la lógica para el Problema #3
 * Genera y calcula N primeros múltiplos de 4
 *@author anacelis
 */

namespace App\Models;

use App\Utilities\MathUtility;

class MultiplesModel
{
    private int $n = 0;
    private int $multiplier = 4;
    private array $multiples = [];

    
    public function __construct(int $n = 0, int $multiplier = 4)
    {
        $this->n = $n;
        $this->multiplier = $multiplier;

        if ($this->n > 0) {
            $this->generateMultiples();
        }
    }

   
    private function generateMultiples(): void
    {
        $this->multiples = MathUtility::generateMultiples($this->multiplier, $this->n);
    }

    
    public function setN(int $n): void
    {
        $this->n = $n;
        if ($this->n > 0) {
            $this->generateMultiples();
        }
    }

    
    public function getN(): int
    {
        return $this->n;
    }

    
    public function getMultiplier(): int
    {
        return $this->multiplier;
    }

   
    public function getMultiples(): array
    {
        return $this->multiples;
    }

    
    public function getFormattedMultiples(): array
    {
        $formatted = [];
        for ($i = 1; $i <= $this->n; $i++) {
            $formatted[] = "{$this->multiplier} × {$i} = " . ($this->multiplier * $i);
        }
        return $formatted;
    }

    
    public function getMultiplesInfo(): array
    {
        return [
            'n' => $this->n,
            'multiplier' => $this->multiplier,
            'multiples' => $this->multiples,
            'formatted' => $this->getFormattedMultiples(),
            'sum' => array_sum($this->multiples),
        ];
    }
}
?>
