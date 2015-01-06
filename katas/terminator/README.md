Kata Terminator
==================

Kata propuesta en el grupo local de Symfony Valencia



## Enunciado

### Introducción

Estamos en el año 2300 y el mundo se ha convertido en un lugar peligroso. Escondidos entre las sombras, políticos, tertulianos y portavoces de la CEOE esperan su momento para asaltar al transeúnte incauto y convertirlo en un buen ciudadano. Afortunadamente existen desarrolladores capaces de impedirlo. Has conseguido un ejemplar de T-1000 que espera a ser reprogramado. Utilizando una nueva tecnología que permite detectar un asalto instantes antes de que se produzca, se te ha encomendado la labor de desarrollar un software que permita al T-1000 recibir la señal, acudir lo antes posible al lugar del incidente y neutralizar al objetivo.

El T-1000 es un conjunto de componentes:
+ Un patron de enrutado
+ Cero o más rutinas neuronales
+ Módulos de combate (en esta kata solo utilizaremos el de ataque aéreo)
+ Cualquier otro componente que consideres necesario

Las señales que puede recibir un T-1000 son:
NUEVO OBJETIVO (posición)
OBJETIVO PERDIDO (posición)

Intenta desarrollar software desacoplado y orientado a objetos. Al final de la kata, debes ser capaz de construir modelos de T-1000 con distintas configuraciones.


### Objetivos, rutinas y componentes

1.- Rutina neuronal "Traslado al objetivo":  Calcula la ruta en linea recta hasta el objetivo y acciona las piernas del T-1000 para desplazarlo.

2.- Patrón de enrutado CRONOLÓGICO: Programa al T-1000 para que atienda varios objetivos, en el orden en que éstos le han sido comunicados.

3.- Rutina neuronal "Abandonar objetivo perdido": Esta es una rutina de comportamiento. Si el T-1000 recibe la señal de OBJETIVO PERDIDO en un trayecto, se encaminará de inmediato hasta el siguiente objetivo.

5.- Patrón de enrutado MÁS CERCANO: Programa al T-1000 para que atienda siempre los objetivos en orden de cercanía (más cercanos primero).

6.- Patrón de enrutado MÁS URGENTE: Indicando la urgencia de un objetivo, programa al T-1000 para que atienda siempre los objetivos en orden de urgencia (más urgentes primero).

7.-Rutina neuronal "Nuevo objetivo": El T-1000 puede recibir en cualquier momento una señal de NUEVO OBJETIVO. Esta rutina entrará en acción y recalculará la lista de objetivos en función del patrón de enrutado.

8.- Rutina neuronal "Análisis de señal": Los amos del sistema no te lo van a poner tan fácil. Esta rutina es capaz de procesar una señal de NUEVO OBJETIVO y averiguar si es una trampa. Si el resultado es positivo, el T-1000 ignorará la señal.

9.- Rutina neuronal "Machaca al tramposo": Si el T-1000 está equipado con un módulo de ataque aéreo, esta rutina lo utilizará para bombardear al objetivo cuando una señal sea detectada como trampa. Esta rutina no tendrá efecto si no hay equipado un módulo de ataque aéreo, o si la rutina "Análisis de señal" no está instalada.

10.- Rutina neuronal "Purifica la zona": Si el T-1000 está equipado con un módulo de ataque aéreo, esta rutina lo utilizará para bombardear al objetivo cuando se reciba una señal de OBJETIVO PERDIDO. Esta rutina no tendrá efecto si no hay equipado un módulo de ataque aéreo, o si la rutina "Análisis de señal" no está instalada.

