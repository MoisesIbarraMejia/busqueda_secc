# Busca-T — Sistema de Consulta Territorial (IECM)

**Busca-T** es una plataforma web interactiva desarrollada para el [Instituto Electoral de la Ciudad de México (IECM)](https://www.iecm.mx/) que permite a la ciudadanía ubicar de manera inmediata su **Unidad Territorial**, así como su **Mesa Receptora de Votación y Opinión** correspondiente al Marco Geográfico de Participación Ciudadana.

La aplicación oficial se encuentra disponible en: [geoutcdmx.iecm.mx/busquedas_ut/home.html](https://geoutcdmx.iecm.mx/busquedas_ut/home.html)

---

## Características del Proyecto

* **Ubicación en Tiempo Real (GPS)**: Permite al usuario localizar de forma automatizada su Unidad Territorial utilizando el sistema de posicionamiento global del dispositivo móvil o de escritorio.
* **Búsqueda por Atributos Alfanuméricos**: Motor de búsqueda dinámico para indexar calles, avenidas y colonias dentro de la Ciudad de México.
* **Ligero y Eficiente**: Construido con tecnologías web nativas, asegurando una carga rápida sin la sobrecarga de frameworks modernos.
* **Integración Institucional**: Diseñado específicamente para los procesos de presupuesto participativo y elecciones de las Comisiones de Participación Comunitaria (COPACO).

---

## Stack Tecnológico

El proyecto está desarrollado utilizando una arquitectura limpia y sin dependencias externas complejas:

* **Frontend**: 
  * `HTML5` para la estructura semántica.
  * `CSS3` para el diseño visual, adaptabilidad móvil (Responsive Design) y estilos de componentes.
  * `JavaScript (Vanilla JS)` para el consumo de la API de Geolocalización nativa del navegador, animaciones y manejo dinámico de la interfaz de usuario.
* **Backend**:
  * `PHP` para la lógica del servidor, procesamiento de las cadenas de búsqueda por calle/dirección y saneamiento de datos entrantes.
* **Base de Datos**:
  * Servidor relacional de base de datos para almacenar y consultar el Marco Geográfico Electoral y las delimitaciones de las Unidades Territoriales.

---

## Funcionalidades Clave

1. **Módulo "¡Ubícate al instante!"**: Consume la API de Geolocalización de JavaScript. Tras obtener el par de coordenadas `(latitud, longitud)`, ejecuta una solicitud asíncrona hacia el backend en PHP para determinar el polígono electoral respectivo.
2. **Módulo "Buscar por calle"**: Entrada de texto autocompletable mediante peticiones dinámicas que filtra la cartografía de la CDMX en la base de datos a partir del nombre de la vialidad ingresada.

---

## Instalación y Despliegue Local

Sigue estos pasos para montar un entorno de desarrollo para el sistema:

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com
   cd busca-t-iecm
   ```

2. **Configuración del Servidor Web**:
   * Asegúrate de mover los archivos a la raíz de tu servidor local (ej. `/var/www/html/` en Apache o la carpeta `htdocs` en XAMPP).
   * La base del backend requiere **PHP 7.4 o superior**.

3. **Configuración de la Base de Datos**:
   * Importa el esquema SQL de las Unidades Territoriales de la CDMX proporcionado en el directorio correspondiente.
   * Modifica los parámetros de conexión en el archivo de configuración PHP (ej. `config.php` o `conexion.php`).

4. **Acceso**:
   * Abre tu navegador preferido e ingresa a: `http://localhost/busca-t-iecm/home.html`

---

## Requisitos de Seguridad para Producción

* **Protocolo HTTPS**: Indispensable para producción. Los navegadores modernos bloquean el uso de las funciones de geolocalización por GPS (`navigator.geolocation`) si el sitio no cuenta con un certificado SSL válido.
* **Saneamiento de Inputs**: Las consultas dirigidas al buscador de calles vía PHP deben estar protegidas contra inyecciones SQL utilizando sentencias preparadas (PDO/MySQLi).

---
