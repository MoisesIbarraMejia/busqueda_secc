# Busca Secc — Sistema de Consulta de Secciones Electorales (IECM)

**Busca Secc** es una plataforma web interactiva desarrollada para el **Instituto Electoral de la Ciudad de México (IECM)** que permite a la ciudadanía localizar de manera inmediata la **Sección Electoral** a la que pertenece dentro de la Ciudad de México.

El sistema ofrece dos métodos de consulta para facilitar la ubicación de la sección electoral correspondiente:

- **Ubicación en tiempo real (GPS)**.
- **Búsqueda por calle o domicilio**.

Su objetivo es acercar la información geoelectoral a la ciudadanía de forma rápida, sencilla e intuitiva, facilitando la identificación de la sección electoral para distintos procesos organizados por el IECM.

---

# Características del Proyecto

- **Ubicación en Tiempo Real (GPS):** Obtiene la ubicación del usuario mediante la API de Geolocalización del navegador para identificar automáticamente la Sección Electoral correspondiente.

- **Búsqueda por Calle o Domicilio:** Permite localizar una Sección Electoral mediante el nombre de una calle, avenida o dirección registrada dentro de la Ciudad de México.

- **Consulta Geoespacial:** El sistema realiza consultas espaciales sobre la cartografía electoral oficial para determinar la sección donde se encuentra el usuario o el domicilio consultado.

- **Ligero y Eficiente:** Desarrollado utilizando tecnologías web nativas para ofrecer tiempos de respuesta rápidos y una interfaz sencilla.

- **Integración Institucional:** Diseñado para apoyar los procesos de difusión e información geoelectoral del Instituto Electoral de la Ciudad de México.

---

# Stack Tecnológico

El proyecto fue desarrollado utilizando tecnologías web ligeras y de fácil mantenimiento.

## Frontend

- HTML5
- CSS3
- JavaScript (Vanilla JS)

Utiliza la API nativa de Geolocalización del navegador para obtener la ubicación del usuario.

## Backend

- PHP

Responsable del procesamiento de consultas, búsqueda por calles y comunicación con la base de datos geográfica.

## Base de Datos

Base de datos geográfica que almacena:

- Secciones Electorales.
- Calles y vialidades.
- Información cartográfica utilizada para las consultas espaciales.

---

# Funcionalidades

## Consulta mediante ubicación

El usuario puede utilizar la ubicación actual de su dispositivo para conocer automáticamente la Sección Electoral donde se encuentra.

El sistema:

1. Solicita permisos de ubicación.
2. Obtiene la latitud y longitud.
3. Envía las coordenadas al servidor.
4. Determina la Sección Electoral correspondiente.
5. Devuelve la información al usuario.

---

## Consulta por calle

Permite localizar una Sección Electoral mediante la búsqueda de una calle o domicilio.

El sistema realiza búsquedas dinámicas sobre la base de datos y devuelve la información correspondiente a la ubicación consultada.

---

# Instalación

## Clonar el repositorio

```bash
git clone https://github.com/MoisesIbarraMejia/busqueda_secc.git
```

```bash
cd busqueda_secc
```

---

## Configurar servidor web

Copiar el proyecto al directorio de su servidor web.

Ejemplo:

- XAMPP → `htdocs`
- Apache → `/var/www/html`

Se requiere:

- PHP 7.4 o superior.

---

## Configurar la base de datos

Importar la base de datos utilizada por el sistema.

Posteriormente configurar los parámetros de conexión dentro del archivo correspondiente.

---

## Ejecutar

Abrir:

```
http://localhost/busqueda_secciones/home.html
```

---

# Seguridad

## HTTPS

Para utilizar la geolocalización es obligatorio desplegar el sistema mediante HTTPS en ambientes de producción.

Los navegadores modernos bloquean el acceso al GPS cuando el sitio no cuenta con un certificado SSL válido.

---

## Protección de consultas

Las consultas realizadas desde PHP deben implementarse utilizando sentencias preparadas para evitar ataques de inyección SQL.

---

# Autor

**Moisés Ibarra Mejía**

Ingeniero en Geomática

Instituto Electoral de la Ciudad de México (IECM)

Especializado en desarrollo de herramientas geoespaciales, sistemas cartográficos y aplicaciones web para información geoelectoral.