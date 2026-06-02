# 📚 Talleres Desarrollo Web VII - Universidad Tecnológica de Panamá

## Descripción del Proyecto

Este proyecto implementa **4 problemas de desarrollo web** utilizando **PHP 8 puro** con el **patrón MVC** (Model-View-Controller), siguiendo estándares de seguridad y buenas prácticas de programación.

---

## 📁 Estructura de Carpetas

```
MiniProyec/
├── index.php                          # Front Controller - Punto de entrada
├── app/
│   ├── Autoloader.php                # Autocarga de clases PSR-4
│   ├── controllers/
│   │   ├── Problem1Controller.php     # Controlador Problema #1
│   │   ├── Problem2Controller.php     # Controlador Problema #2
│   │   ├── Problem3Controller.php     # Controlador Problema #3
│   │   └── Problem4Controller.php     # Controlador Problema #4
│   ├── models/
│   │   ├── StatisticsModel.php        # Modelo Problema #1
│   │   ├── SeriesModel.php            # Modelo Problema #2
│   │   ├── MultiplesModel.php         # Modelo Problema #3
│   │   └── EvenOddModel.php           # Modelo Problema #4
│   ├── views/
│   │   ├── header.php                 # Encabezado reutilizable
│   │   ├── footer.php                 # Pie de página reutilizable
│   │   ├── menu.php                   # Menú principal
│   │   ├── problem1.php               # Vista Problema #1 (con formulario)
│   │   ├── problem3.php               # Vista Problema #3 (con formulario)
│   │   ├── results/
│   │   │   ├── problem2_result.php    # Vista Problema #2 (resultados)
│   │   │   └── problem4_result.php    # Vista Problema #4 (resultados)
│   └── utilities/
│       ├── ValidationUtility.php      # Utilidades de validación
│       ├── SecurityUtility.php        # Utilidades de seguridad OWASP
│       └── MathUtility.php            # Utilidades matemáticas
└── README.md                          # Este archivo

```

---

## 🏗️ Patrones y Principios Implementados

### 1. **Patrón MVC (Model-View-Controller)**

#### ✅ **Models** (Capa de Datos y Lógica)
- **StatisticsModel.php**: Gestiona cálculos estadísticos (media, desviación estándar, mín, máx)
- **SeriesModel.php**: Gestiona la suma de series numéricas (1 al 1000)
- **MultiplesModel.php**: Gestiona generación de múltiplos
- **EvenOddModel.php**: Gestiona separación de números pares e impares

```php
// Ejemplo: Separación de responsabilidades
$model = new StatisticsModel($numbers);
$mean = $model->getMean();
$stdDev = $model->getStandardDeviation();
```

#### ✅ **Controllers** (Capa de Control)
- Reciben las solicitudes HTTP
- Validan entrada de datos
- Coordinan entre Models y Views

```php
// Ejemplo: Procesamiento de formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $this->processForm($errors, $formData);
}
```

#### ✅ **Views** (Capa de Presentación)
- HTML/Bootstrap 5
- Variables seguras con `SecurityUtility::sanitizeOutput()`
- Reutilización de header.php y footer.php

---

### 2. **Principio DRY (Don't Repeat Yourself)**

#### ✅ **Utilities (Métodos Estáticos Reutilizables)**

```php
// ValidationUtility.php - Métodos estáticos para validaciones
public static function isPositiveNumber($value): bool
public static function isPositiveInteger($value): bool
public static function validateWithRegex(string $value, string $pattern): bool
public static function isValidEmail(string $email): bool
```

**Reutilización:**
```php
// En Problem1Controller
if (!ValidationUtility::isPositiveNumber($value)) { ... }

// En Problem3Controller
if (!ValidationUtility::isPositiveInteger($value)) { ... }
```

#### ✅ **MathUtility - Métodos Estáticos para Operaciones Matemáticas**

```php
// Métodos reutilizables
MathUtility::calculateMean($numbers)
MathUtility::calculateStandardDeviation($numbers)
MathUtility::getMin($numbers)
MathUtility::getMax($numbers)
MathUtility::sumFromOneToN($n)
MathUtility::generateMultiples($multiplier, $count)
```

#### ✅ **Header y Footer Reutilizables**

```php
// Incluidos en cada vista
include VIEWS_PATH . 'header.php';
// ... contenido específico ...
include VIEWS_PATH . 'footer.php';
```

**Beneficios:**
- ✓ Una sola actualización de estilos afecta todas las páginas
- ✓ Fecha dinámica actualizada automáticamente en el footer
- ✓ Navegación consistente en todo el sitio

---

### 3. **Seguridad OWASP**

#### ✅ **Protección contra XSS (Cross-Site Scripting)**

**SecurityUtility.php - Métodos de Sanitización:**

```php
// htmlspecialchars() convierte caracteres especiales
public static function sanitizeOutput($value, int $flags = ENT_QUOTES): string
{
    return htmlspecialchars((string)$value, $flags, 'UTF-8');
}

// Uso en vistas
<?php echo SecurityUtility::sanitizeOutput($userInput); ?>
```

**Ejemplo de protección:**
```php
// Entrada maliciosa: <script>alert('XSS')</script>
// Salida sanitizada: &lt;script&gt;alert(&#039;XSS&#039;)&lt;/script&gt;
```

#### ✅ **Validación de Entrada (Input Validation)**

Utilizando `filter_var()` y `preg_match()`:

```php
// Validación con filter_var()
filter_var($value, FILTER_VALIDATE_FLOAT) !== false

// Validación con preg_match()
preg_match($pattern, $value) === 1

// Validación de email
filter_var($email, FILTER_VALIDATE_EMAIL) !== false
```

#### ✅ **Sanitización de Entrada**

```php
public static function sanitizeInput($input): string
{
    return htmlspecialchars(trim((string)$input), ENT_QUOTES, 'UTF-8');
}
```

#### ✅ **Token CSRF (Adicional)**

```php
public static function generateCsrfToken(): string { ... }
public static function verifyCsrfToken(string $token): bool { ... }
```

---

### 4. **Nomenclatura PSR-1**

#### ✅ **Clases en StudlyCaps**
```php
class StatisticsModel    // ✓ Correcto
class ValidationUtility  // ✓ Correcto
class Problem1Controller // ✓ Correcto
```

#### ✅ **Métodos en camelCase**
```php
public function calculateMean()       // ✓ Correcto
public function getStandardDeviation() // ✓ Correcto
public function setNumbers()          // ✓ Correcto
```

#### ✅ **Variables en camelCase**
```php
$formData        // ✓ Correcto
$errors          // ✓ Correcto
$numberOfItems   // ✓ Correcto
```

#### ✅ **Constantes en UPPER_CASE**
```php
define('BASE_PATH', __DIR__ . DIRECTORY_SEPARATOR);
define('APP_PATH', BASE_PATH . 'app' . DIRECTORY_SEPARATOR);
```

---

### 5. **Programación Orientada a Objetos (POO)**

#### ✅ **Encapsulación**
```php
private array $numbers = [];

public function setNumbers(array $numbers): void { ... }
public function getNumbers(): array { ... }
```

#### ✅ **Métodos de Instancia**
```php
$model = new StatisticsModel($numbers);
$mean = $model->getMean();
$stdDev = $model->getStandardDeviation();
```

#### ✅ **Métodos Estáticos**
```php
$isValid = ValidationUtility::isPositiveNumber($value);
$sanitized = SecurityUtility::sanitizeOutput($userInput);
$mean = MathUtility::calculateMean($array);
```

---

## 🔍 Descripción de los 4 Problemas

### **Problema #1: Estadísticas de 5 Números**
- **Entrada**: Formulario con 5 campos para números positivos
- **Validación**: `ValidationUtility::isPositiveNumber()`
- **Cálculos**: Media, desviación estándar, mínimo, máximo
- **Estructura**: Arreglos + foreach
- **Salida**: Resultados formateados en tabla

### **Problema #2: Suma de 1 al 1000**
- **Entrada**: Automática (sin formulario)
- **Estructura**: Ciclo for (1 a 1000)
- **Cálculos**: Suma acumulativa
- **Salida**: Resultado final: **500,500**

### **Problema #3: N Primeros Múltiplos de 4**
- **Entrada**: Formulario con un campo N
- **Validación**: `ValidationUtility::isPositiveInteger()`
- **Estructura**: Ciclo for
- **Salida**: Formato "4 × 1 = 4", "4 × 2 = 8", etc.

### **Problema #4: Suma de Pares e Impares (1-200)**
- **Entrada**: Automática
- **Estructura**: Ciclo for con if (i % 2 === 0)
- **Salida**: Dos sumas independientes

---

## 🚀 Cómo Ejecutar

### **Requisitos**
- WAMP64 Server (o equivalente)
- PHP 8.0 o superior
- Navegador web moderno

### **Instalación**

1. **Copiar archivos a WAMP**
   ```bash
   C:\wamp64\www\MiniProyec\
   ```

2. **Iniciar WAMP Server**
   - Hacer clic en el ícono de WAMP en la bandeja del sistema

3. **Abrir navegador**
   ```
   http://localhost/MiniProyec/
   ```

4. **Seleccionar un problema del menú principal**

---

## 📝 Características Principales

✅ **PHP 8 Puro** - Sin dependencias externas
✅ **Patrón MVC** - Separación clara de responsabilidades
✅ **DRY Principle** - Reutilización de código
✅ **OWASP Security** - Protección XSS + validación
✅ **Bootstrap 5** - Diseño responsivo
✅ **Métodos Estáticos** - Utilities reutilizables
✅ **PSR-1 Compliance** - Convenciones de código
✅ **Autoloader PSR-4** - Carga automática de clases
✅ **Fecha Dinámica** - En el footer
✅ **Comentarios Académicos** - Documentación clara

---

## 🔐 Seguridad Implementada

| Vulnerabilidad | Protección |
|---|---|
| XSS | htmlspecialchars(), ENT_QUOTES |
| Inyección HTML | SecurityUtility::sanitizeOutput() |
| Entrada inválida | filter_var(), preg_match(), ValidationUtility |
| Entrada vacía | isNotEmpty() |
| URLs maliciosas | filter_var(FILTER_SANITIZE_URL) |

---

## 📊 Ejemplos de Código

### **Validación en Problema #1**

```php
// En Problem1Controller.php
for ($i = 1; $i <= 5; $i++) {
    $fieldName = "number{$i}";
    
    if (isset($_POST[$fieldName])) {
        $value = SecurityUtility::sanitizeInput($_POST[$fieldName]);
        
        if (!ValidationUtility::isPositiveNumber($value)) {
            $errors[] = "El número {$i} debe ser positivo.";
        } else {
            $numbers[] = (float)$value;
        }
    }
}
```

### **Cálculo de Estadísticas**

```php
// En StatisticsModel.php
public function getStandardDeviation(): float
{
    $mean = $this->getMean();
    $sumSquaredDifferences = 0;

    foreach ($this->numbers as $number) {
        $sumSquaredDifferences += pow($number - $mean, 2);
    }

    $variance = $sumSquaredDifferences / count($this->numbers);
    return sqrt($variance);
}
```

### **Ciclo FOR en Problema #4**

```php
// En EvenOddModel.php
for ($i = $this->start; $i <= $this->end; $i++) {
    if ($i % 2 === 0) {
        $this->evenSum += $i;
        $this->evenNumbers[] = $i;
    } else {
        $this->oddSum += $i;
        $this->oddNumbers[] = $i;
    }
}
```

---

## 📞 Contacto y Autor

**Universidad Tecnológica de Panamá**
Desarrollo Web VII - Taller de Proyectos

---

## 📄 Licencia

Proyecto educativo - Uso libre para propósitos académicos.

