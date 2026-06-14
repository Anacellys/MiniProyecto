# Mini Proyecto - Desarrollo Software VII

## Introducción
Este proyecto consiste en el desarrollo de aplicaciones web en **PHP 8 puro**, siguiendo estrictamente el enfoque **MVC (Model-View-Controller)**. La finalidad del trabajo es resolver diferentes problemas propuestos, manteniendo una organización clara por capas: la lógica de negocio se concentra en los **models**, el control del flujo y el manejo de solicitudes en los **controllers**, y la presentación en las **views**. Además, se aplica un conjunto de **utilidades** reutilizables para cálculos, validaciones y seguridad, con una interfaz moderna y consistente, especialmente con estilos de tonos verdes y diseño responsivo.

## Metodología
La implementación se realizó mediante una secuencia ordenada y repetible. Primero, se revisó el tipo de entrada del problema (si hay formulario o si es cálculo automático). Luego, se construyó el flujo MVC: el **controller** recibe y valida la solicitud (cuando aplica), el **model** encapsula la lógica matemática necesaria, y la **vista** muestra el formulario y los resultados. Finalmente, se integraron elementos visuales como gráficas con **Chart.js** cuando el enunciado lo exigía, asegurando una presentación coherente con Bootstrap 5 y una estética moderna.

En el proceso también se mantuvo el principio **DRY**, evitando repetir lógica en múltiples archivos. Las validaciones y sanitizaciones se delegaron a `ValidationUtility` y `SecurityUtility`, mientras que los cálculos matemáticos reutilizaron `MathUtility`. La seguridad se implementó con base en buenas prácticas tipo **OWASP**, incorporando verificación de **CSRF** en formularios y sanitización/escapado para prevenir XSS.

## Definición de Clases Utilitarias para cálculos Matemáticos, tratamiento de cadenas y de validación de datos
El proyecto utiliza utilidades estáticas para centralizar responsabilidades y reducir duplicación:

En primer lugar, `MathUtility` se encarga de operaciones matemáticas reutilizables. Allí se incluyen métodos como el cálculo de la media aritmética, la desviación estándar, mínimos y máximos, suma desde 1 hasta N y generación de múltiplos. Gracias a esta clase, los `models` no repiten fórmulas ni implementaciones y se simplifica el mantenimiento.

En segundo lugar, `ValidationUtility` concentra las validaciones. Por ejemplo, valida enteros positivos, números positivos, patrones con expresiones regulares, emails y no vacíos. Esta centralización permite que los controladores apliquen validación consistente y estricta según el problema.

Finalmente, `SecurityUtility` implementa la sanitización y protección de salida. Sus métodos basan su operación en `htmlspecialchars` para evitar inyección de HTML o ejecución de scripts maliciosos. También incluye generación y verificación de tokens CSRF con `generateCsrfToken()` y `verifyCsrfToken()`, reforzando el formulario contra solicitudes forjadas. Con esto, cada vista usa escapado correcto al mostrar mensajes o datos dinámicos y cada controller protege el procesamiento de solicitudes.

## Lecciones aprendidas o dificultades enfrentadas
Una de las principales lecciones fue comprender la importancia real de mantener la separación de responsabilidades. Al aplicar MVC con disciplina, el código se vuelve más legible, más fácil de probar y mucho más sencillo de extender para nuevos problemas. También se confirmó que el principio DRY reduce errores: al reutilizar utilidades, se evita que pequeñas diferencias en validación o sanitización terminen generando fallos difíciles de detectar.

Como dificultades, se presentó la integración progresiva de nuevos problemas sin romper el enrutamiento del proyecto, especialmente al añadir casos adicionales en `index.php` y al mantener la consistencia visual en las vistas. Otro reto fue asegurar que la seguridad se aplicara uniformemente: formularios con CSRF, sanitización de entradas y escape de salidas. En algunos puntos, fue necesario revisar cuidadosamente que las vistas no imprimieran datos sin sanitizar y que los controllers verificaran tokens antes de procesar.

## Estado actual y uso del proyecto
El proyecto ya incorpora problemas adicionales con formularios, resultados y gráficas. El menú principal permite navegar entre los diferentes módulos mediante el parámetro `action` en `index.php`. Cada problema se muestra con una interfaz moderna, tarjetas con gradientes y colores verdes, manteniendo un estilo responsivo y una experiencia visual coherente.
