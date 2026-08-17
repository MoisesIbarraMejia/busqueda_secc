<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Búsqueda por Ubicación — SCMGPC</title>
<link rel="icon" type="image/png" href="logoiecm.png">
<link rel="apple-touch-icon" href="logoiecm.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCw42oKA6idOiNV51RXLHzRwYwn7MerDBI&libraries=marker"></script>
<script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
<style>
/* ── Reset & Base ─────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
    --morado:        #8A3880;
    --morado-oscuro: #6b2a63;
    --morado-claro:  #f5eef8;
    --morado-mid:    #d1bfdb;
    --verde:         #00616b;
    --verde-claro:   #e6f4f5;
    --texto:         #2c3345;
    --texto-suave:   #5a6478;
    --borde:         #dde1ea;
    --fondo:         #f7f8fc;
    --blanco:        #ffffff;
    --sombra:        0 2px 16px rgba(44,51,69,.10);
    --sombra-lg:     0 8px 40px rgba(44,51,69,.16);
    --radio:         10px;
    --radio-lg:      16px;
    --transicion:    .22s ease;
}

body::before,
body::after{
content:'';
position:fixed;
border-radius:50%;
filter:blur(90px);
z-index:-1;
pointer-events:none;
}

body::before{
width:480px;
height:480px;
background:var(--morado);
opacity:.14;
top:-160px;
left:-140px;
animation:float1 14s ease-in-out infinite;
}

body::after{
width:520px;
height:520px;
background:var(--verde);
opacity:.10;
bottom:-200px;
right:-160px;
animation:float2 16s ease-in-out infinite;
}

@keyframes float1{
0%,100%{ transform:translate(0,0); }
50%{ transform:translate(40px,30px); }
}

@keyframes float2{
0%,100%{ transform:translate(0,0); }
50%{ transform:translate(-30px,-40px); }
}

html, body {
    font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
    font-size: 15px;
    background: var(--fondo);
    color: var(--texto);
    min-height: 100vh;
    overflow-x: hidden;
}

/* ── Header ──────────────────────────────────────────── */
.header {
background: var(--blanco);
color: var(--texto);
padding: 20px 20px;
display: flex;
align-items: center;
gap: 16px;
border-bottom: 1px solid var(--borde);
position: relative;
z-index: 1;
}
.header-icon {
width: 48px; height: 48px;
background: linear-gradient(135deg, rgba(138,56,128,.10), rgba(0,97,107,.10));
border-radius: 50%;
display: flex; align-items: center; justify-content: center;
font-size: 22px;
flex-shrink: 0;
}
.header-text h1 {
font-size: 1.25rem;
font-weight: 700;
letter-spacing: -.01em;
background: linear-gradient(120deg, var(--morado-oscuro), var(--morado));
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
}
.header-text p { font-size: .82rem; color: var(--texto-suave); margin-top: 2px; }

/* ── Main container ──────────────────────────────────── */
.container {
    max-width: 860px;
    margin: 0 auto;
    padding: 28px 20px 48px;
}

/* ── Card ─────────────────────────────────────────────── */
.card {
    background: var(--blanco);
    border-radius: var(--radio-lg);
    box-shadow: var(--sombra);
    border: 1px solid var(--borde);
    overflow: hidden;
    margin-bottom: 20px;
}
.card-body { padding: 24px 28px; }

/* ── Instrucción ─────────────────────────────────────── */
.instruccion {
    display: flex;
    gap: 14px;
    align-items: flex-start;
    background: var(--verde-claro);
    border-left: 4px solid var(--verde);
    border-radius: 0 var(--radio) var(--radio) 0;
    padding: 14px 18px;
    margin-bottom: 24px;
    font-size: .88rem;
    color: var(--verde);
    line-height: 1.55;
}
.instruccion-icon { font-size: 1.3rem; flex-shrink: 0; margin-top: 1px; }

.nota-geolocalizacion{
    margin-top:8px; 
    font-size:10px; 
    opacity:0.7;
}

@media(max-width:768px){
    .nota-geolocalizacion{
        font-size:8px; 
    }
    .instruccion {
        font-size: .68rem;
    }
}

/* ── Botón ────────────────────────────────────────────── */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    padding: 12px 26px;
    border: none;
    border-radius: var(--radio);
    font-family: inherit;
    font-size: .93rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transicion);
    text-decoration: none;
}
.btn-primary {
    background: linear-gradient(135deg, var(--morado), var(--morado-oscuro));
    color: #fff;
    box-shadow: 0 4px 14px rgba(138,56,128,.35);
}
.btn-primary:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(138,56,128,.45);
}
.btn-primary:disabled { opacity: .55; cursor: not-allowed; transform: none; }
.btn-icon { font-size: 1.1rem; }

/* ── Status ──────────────────────────────────────────── */
.status-box {
    display: flex; align-items: center; gap: 10px;
    padding: 12px 16px;
    border-radius: var(--radio);
    font-size: .88rem;
    margin-top: 16px;
    animation: fadeSlide .3s ease;
}
.status-info  { background: #eef4ff; color: #2563eb; border: 1px solid #bfdbfe; }
.status-error { background: #fff1f1; color: #c0392b; border: 1px solid #fecaca; }
.status-ok    { background: var(--verde-claro); color: var(--verde); border: 1px solid #a7d7db; }
@keyframes fadeSlide { from { opacity:0; transform:translateY(6px); } to { opacity:1; transform:translateY(0); } }

/* ── Spinner ─────────────────────────────────────────── */
.spinner {
    width: 18px; height: 18px;
    border: 2.5px solid rgba(37,99,235,.25);
    border-top-color: #2563eb;
    border-radius: 50%;
    animation: spin .7s linear infinite;
    flex-shrink: 0;
}
@keyframes spin { to { transform: rotate(360deg); } }

/* ── Tabla de resultados ─────────────────────────────── */
.resultado-card {
    background: var(--blanco);
    border-radius: var(--radio-lg);
    box-shadow: var(--sombra);
    border: 1px solid var(--borde);
    overflow: hidden;
    margin-top: 20px;
    animation: fadeSlide .4s ease;
}
.resultado-header {
    background: linear-gradient(90deg, var(--morado), var(--morado-oscuro));
    color: #fff;
    padding: 14px 22px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: .95rem;
    font-weight: 600;
}
.resultado-header span { font-size: 1.2rem; }
.table-wrap { overflow-x: auto; }
#tabladem {
    width: 100%;
    border-collapse: collapse;
    font-size: .82rem;
}
#tabladem thead th {
    background: #2c3345;
    color: #fff;
    padding: 10px 14px;
    font-weight: 600;
    font-size: .78rem;
    letter-spacing: .04em;
    text-transform: uppercase;
    text-align: left;
    white-space: nowrap;
}
#tabladem tbody td {
    padding: 10px 14px;
    border-bottom: 1px solid var(--borde);
    color: var(--texto);
}
#tabladem tbody tr:last-child td { border-bottom: none; }
#tabladem tbody tr:hover { background: var(--morado-claro); transition: background .15s; }
#tabladem tbody td:first-child { font-family: 'Courier New', monospace; font-weight: 700; color: var(--morado); }

/* ── Mapa ─────────────────────────────────────────────── */
.mapa-wrap {
    margin-top: 20px;
    border-radius: var(--radio-lg);
    overflow: hidden;
    box-shadow: var(--sombra-lg);
    border: 1px solid var(--borde);
    animation: fadeSlide .5s ease;
}
#map_ubicacion { width: 100%; height: 520px; display: block; }

/* ── Tooltip / InfoWindow custom ─────────────────────── */

/* ── Hover panel (tooltip flotante sobre el polígono) ── */
#hover-panel {
    display: none;
    position: fixed;
    background: rgba(44,51,69,.93);
    color: #fff;
    border-radius: 8px;
    padding: 8px 14px;
    font-size: .8rem;
    font-family: 'Inter', sans-serif;
    pointer-events: none;
    z-index: 9999;
    box-shadow: 0 4px 16px rgba(0,0,0,.3);
    max-width: 240px;
    line-height: 1.5;
    backdrop-filter: blur(4px);
    border: 1px solid rgba(255,255,255,.12);
    transform: translate(12px, -50%);
}
#hover-panel strong { display: block; font-size: .85rem; margin-bottom: 2px; color: #e8d5f0; }

/* ── Footer ─────────────────────────────────────────── */
.footer {
    text-align: center;
    font-size: .78rem;
    color: var(--texto-suave);
    padding: 20px;
    border-top: 1px solid var(--borde);
    margin-top: 8px;
}

.btn-home{
position:fixed;
top:24px;
right:24px;
padding:10px 22px;
border-radius:30px;
background:linear-gradient(135deg, #6b004b, #3d0054);
color:white;
font-weight:600;
text-decoration:none;
box-shadow:0 6px 20px rgba(0,0,0,.2);
transition:.25s;
z-index:9999;
}

.btn-home:hover{
transform:translateY(-2px);
box-shadow:0 10px 30px rgba(0,0,0,.35);
}

.header-logo img {
width: 85px;
height: auto;
object-fit: contain;
filter: brightness(0) saturate(100%) invert(20%) sepia(45%) saturate(1200%) hue-rotate(270deg);
}

/* Hover sutil */
/* .header-logo img:hover {
    filter:
        drop-shadow(0 0 6px rgba(255,255,255,1))
        drop-shadow(0 0 14px rgba(255,255,255,0.8))
        drop-shadow(0 0 24px rgba(255,255,255,0.6));

    transform: scale(1.05);
} */
.header-logo {
    position: absolute;
    left: 30px;
}

/* Centro real del header */
.header-center {
    margin: 0 auto;
    display: flex;
    align-items: center;
    gap: 14px;
}

/*************************************************************************************************************/

/* =========================================
   RESPONSIVE REAL (sin cambiar diseño)
========================================= */

html, body{
min-height:100dvh;
}

/* MAPA RESPONSIVO */
#map_ubicacion{
height:520px;
}

/* =========================
   TABLET
========================= */
@media(max-width:1024px){

.container{
padding:24px 18px 40px;
}

#map_ubicacion{
height:450px;
}

.header{
flex-wrap:wrap;
justify-content:center;
text-align:center;
gap:0px;
}

.header-logo{
position:relative;
left:0;
}

.header-center{
flex-direction:column;
gap:0px;
}

}


/* =========================
   MÓVIL
========================= */
@media(max-width:768px){

body{
min-height:100dvh;
overflow-x:hidden;
}

/* Header más limpio */
.header{
justify-content:center;
padding:12px 10px;
}

/* Icono más chico */
.header-icon{
width:30px;
height:30px;
margin:0 auto 4px;
}

/* Centro ocupa espacio real */
.header-center{
margin:0 auto;
text-align:center;
max-width:75%;
}

.container{
padding:20px 15px 30px;
}

.header-logo img{
width:45px;
}
.card-body{
padding:20px;
}

/* Logo fijo a la izquierda */
.header-logo{
position:absolute;
left:10px;
top:50%;
transform:translateY(-50%);
}

#map_ubicacion{
height:380px;
}

/* botón arriba no estorbe */
.btn-home{
top:5px;
right:15px;
padding:8px 16px;
font-size:10px;
}

/* tabla scrolleable */
.table-wrap{
overflow-x:auto;
}

/* Texto compacto */
.header-text h1{
font-size:.85rem;
line-height:1.2;
}

.header-text p{
font-size:.6rem;
}

}


/* =========================
   MÓVIL PEQUEÑO
========================= */
@media(max-width:480px){

.container{
padding:18px 12px 25px;
}

.card-body{
padding:16px;
}

#map_ubicacion{
height:320px;
}

.btn{
width:100%;
justify-content:center;
}

}



/* MARCADOR PERSONALIZADO */
.user-marker{
position:relative;
display:flex;
flex-direction:column;
align-items:center;
}

/* IMAGEN */
.user-marker img{
width:35px;
height:35px;
border-radius:50%;
border:3px solid #8A3880;
box-shadow:0 0 12px rgba(138,56,128,0.7);
background:white;
}

/* TEXTO */
.user-label{
position:absolute;
bottom:55px;
background:#8A3880;
color:white;
padding:6px 10px;
border-radius:12px;
font-size:12px;
white-space:nowrap;
opacity:0;
transform:translateY(10px);
animation:showUserLabel 5s ease forwards;
}

/* ANIMACIÓN */
@keyframes showUserLabel{
0%{opacity:0; transform:translateY(10px);}
10%{opacity:1; transform:translateY(0);}
80%{opacity:1;}
100%{opacity:0;}
}

/* =========================
   MODAL FULLSCREEN
========================= */

.modal-overlay{
position:fixed;
top:0;
left:0;
width:100%;
height:100dvh;
background:rgba(0,0,0,0.6);
display:flex;
align-items:center;
justify-content:center;
z-index:99999;
opacity:0;
pointer-events:none;
transition:.3s;
}

.modal-overlay.active{
opacity:1;
pointer-events:auto;
}

.modal-box{
background:white;
padding:30px;
border-radius:16px;
max-width:420px;
width:90%;
text-align:center;
box-shadow:0 20px 60px rgba(0,0,0,.3);
animation:modalIn .3s ease;
}

.modal-box h2{
margin-bottom:10px;
font-size:20px;
}

.modal-box p{
font-size:14px;
margin-bottom:20px;
line-height:1.5;
}

.modal-link{
display:inline-block;
margin-bottom:15px;
font-size:14px;
text-decoration:none;
font-weight:600;
color:#8A3880;
}

.modal-btn{
padding:10px 20px;
border:none;
border-radius:25px;
background:#8A3880;
color:white;
cursor:pointer;
font-weight:600;
}

/* ANIMACIÓN */
@keyframes modalIn{
from{transform:scale(.9);opacity:0;}
to{transform:scale(1);opacity:1;}
}


/* 📱 MOBILE */
@media(max-width:480px){

.modal-box{
padding:22px 18px;
}

.modal-box h2{
font-size:17px;
}

.modal-box p{
font-size:13px;
}

.modal-btn{
width:100%;
}

}

/* ── Lista de UTs ────────────────────────────────────── */
.lista-uts-wrap {
    display: flex;
    flex-direction: column;
    gap: 12px;
    padding: 16px;
}

.ut-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 16px;
    background: var(--morado-claro);
    border: 2px solid var(--morado-mid);
    border-radius: var(--radio);
    cursor: pointer;
    transition: var(--transicion);
}

.ut-item:hover {
    background: var(--morado);
    color: white;
    border-color: var(--morado-oscuro);
}

.ut-item:hover .ut-clave {
    background: rgba(0,0,0,.2);
    color: white;
}

.ut-item strong {
    flex: 1;
    font-weight: 600;
    font-size: .95rem;
}

.ut-clave {
    background: rgba(138,56,128,.3);
    padding: 4px 10px;
    border-radius: 6px;
    font-family: 'Courier New', monospace;
    font-size: .78rem;
    font-weight: 700;
    white-space: nowrap;
}

/* DESKTOP - dentro del contenedor del mapa */
.btn-confirmar-container{
padding: 20px;
text-align: center;
background: var(--fondo);
}

/* TABLET Y MÓVIL */
@media(max-width:768px){

.btn-confirmar-container{
position:fixed;
bottom:20px;
left:50%;
transform:translateX(-50%);
z-index:9999;
width:90%;
display:flex;
justify-content:center;
background:none;
}

.btn-confirmar-container button{
width:100%;
max-width:320px;
}
}



/* ── Marcador de Mesa ─────────────────────────────── */
.mesa-tag {
    display: flex;
    flex-direction: column;   
    align-items: center;     
    justify-content: center;
    gap: 4px;                

    border-radius: 10px;
    color: #ffffff;
    font-size: 11px;
    font-weight: 700;
    padding: 6px 6px;        
    position: relative;
    white-space: nowrap;
    box-shadow: 0 2px 8px rgba(0,0,0,.25);
    letter-spacing: .03em;
    transform: translateY(-8px);
    cursor: pointer;
}
.mesa-tag img {
    width: 18px;
    height: 18px;
    object-fit: contain;
}
.mesa-tag {
    border-radius: 50px 50px 35px 35px;
}
.mesa-tag::after {
    content: '';
    position: absolute;
    left: 50%;
    top: 100%;
    transform: translate(-50%, 0);
    width: 0;
    height: 0;
    border-left: 7px solid transparent;
    border-right: 7px solid transparent;
}
/* Colores por número de mesa */
.mesa-m1 { background: #8A3880; }
.mesa-m1::after { border-top: 7px solid #8A3880; }
.mesa-m2 { background: #00616b; }
.mesa-m2::after { border-top: 7px solid #00616b; }
.mesa-m3 { background: #2563eb; }
.mesa-m3::after { border-top: 7px solid #2563eb; }
.mesa-m4 { background: #b45309; }
.mesa-m4::after { border-top: 7px solid #b45309; }
.mesa-m5 { background: #0f766e; }
.mesa-m5::after { border-top: 7px solid #0f766e; }
.mesa-m6 { background: #7c3aed; }
.mesa-m6::after { border-top: 7px solid #7c3aed; }

/* ── InfoWindow de Mesa ───────────────────────────── */


.user-label {
    position: absolute;
    bottom: 52px;
    left: 50%;
    transform: translateX(-50%) translateY(6px);
    background: rgba(44, 51, 69, 0.82);
    color: #fff;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 500;
    white-space: nowrap;
    letter-spacing: .02em;
    backdrop-filter: blur(4px);
    border: 1px solid rgba(255,255,255,.15);
    opacity: 0;
    animation: showUserLabel 6s ease forwards;
    pointer-events: none;
}

@keyframes showUserLabel {
    0%   { opacity: 0; transform: translateX(-50%) translateY(6px); }
    12%  { opacity: 1; transform: translateX(-50%) translateY(0); }
    75%  { opacity: 1; transform: translateX(-50%) translateY(0); }
    100% { opacity: 0; transform: translateX(-50%) translateY(0); }
}

/* ── Nota informativa mesas ──────────────────────── */
.nota-mesas {
    background: linear-gradient(135deg, #f5eef8, #eef4ff);
    border: 1px solid var(--morado-mid);
    border-left: 4px solid var(--morado);
    border-radius: 0 var(--radio) var(--radio) 0;
    padding: 0 18px;
    margin-top: 0;
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    transition: max-height .35s ease, opacity .35s ease, padding .35s ease, margin-top .35s ease;
}

.nota-mesas.visible {
    max-height: 200px;
    opacity: 1;
    padding: 14px 18px;
    margin-top: 16px;
}


.nota-mesas-titulo {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: .82rem;
    font-weight: 700;
    color: var(--morado);
    margin-bottom: 6px;
    letter-spacing: .02em;
    text-transform: uppercase;
}

.nota-mesas-texto {
    font-size: .82rem;
    color: var(--texto-suave);
    line-height: 1.65;
}

.nota-mesas-texto strong {
    color: var(--texto);
}

@media (max-width: 480px) {
    .nota-mesas.visible {
        padding: 12px 14px;
        max-height: 250px;
    }
    .nota-mesas-texto {
        font-size: .78rem;
    }
}


/* ── InfoWindow custom ───────────────────────────────── */
.iw-custom {
    font-family: 'Inter', sans-serif;
    min-width: 220px;
    max-width: 300px;
}
.iw-custom h4 {
    font-size: .95rem; font-weight: 700;
    color: var(--morado);
    margin-bottom: 8px; padding-bottom: 8px;
    border-bottom: 2px solid var(--morado-mid);
}
.iw-custom table { width: 100%; border-collapse: collapse; font-size: .8rem; }
.iw-custom table tr:nth-child(odd)  td { background: var(--morado-claro); }
.iw-custom table tr:nth-child(even) td { background: #faf8fb; }
.iw-custom table td { padding: 5px 8px; }
.iw-custom table td:first-child { font-weight: 600; color: var(--texto-suave); white-space: nowrap; }

/* ── InfoWindow de Mesa ───────────────────────────── */
.iw-mesa {
    font-family: 'Inter', sans-serif;
    min-width: 200px;
    max-width: 280px;
}
.iw-mesa h4 {
    font-size: .9rem; font-weight: 700;
    color: var(--morado);
    margin-bottom: 8px; padding-bottom: 6px;
    border-bottom: 2px solid var(--morado-mid);
}
.iw-mesa table { width: 100%; border-collapse: collapse; font-size: .78rem; }
.iw-mesa table tr:nth-child(odd)  td { background: var(--morado-claro); }
.iw-mesa table tr:nth-child(even) td { background: #faf8fb; }
.iw-mesa table td { padding: 5px 8px; }
.iw-mesa table td:first-child { font-weight: 600; color: var(--texto-suave); white-space: nowrap; }

/* ── Overrides Google InfoWindow en móvil ────────── */
@media (max-width: 768px) {

    /* Contenedor principal del infowindow de Google */
    .gm-style .gm-style-iw-c {
        max-width: calc(100vw - 48px) !important;
        max-height: 52vh !important;
        padding: 10px 10px 10px 10px !important;
        border-radius: 12px !important;
    }

    /* Área scrolleable interna */
    .gm-style .gm-style-iw-d {
        max-height: calc(52vh - 40px) !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        -webkit-overflow-scrolling: touch;
    }

    /* Botón de cierre más grande y accesible */
    .gm-style .gm-style-iw-chr {
        height: 32px !important;
    }
    .gm-style button.gm-ui-hover-effect {
        width: 32px !important;
        height: 32px !important;
        top: 4px !important;
        right: 4px !important;
    }
    .gm-style button.gm-ui-hover-effect span {
        width: 18px !important;
        height: 18px !important;
        margin: 7px !important;
    }

    /* iw-custom en móvil — compacto */
    .iw-custom {
        min-width: unset;
        max-width: 100%;
        width: 100%;
    }
    .iw-custom h4 {
        font-size: .85rem;
        margin-bottom: 6px;
        padding-bottom: 6px;
    }
    .iw-custom table { font-size: .72rem; }
    .iw-custom table td { padding: 3px 6px; }
    .iw-custom table td:first-child { white-space: normal; max-width: 110px; }

    /* iw-mesa en móvil */
    .iw-mesa {
        min-width: unset;
        max-width: 100%;
        width: 100%;
    }
    .iw-mesa h4 { font-size: .82rem; }
    .iw-mesa table { font-size: .72rem; }
    .iw-mesa table td { padding: 3px 6px; }

}

@media (max-width: 480px) {

    .gm-style .gm-style-iw-c {
        max-height: 45vh !important;
        padding: 8px 8px 8px 8px !important;
    }

    .gm-style .gm-style-iw-d {
        max-height: calc(45vh - 36px) !important;
    }

    .iw-custom table { font-size: .68rem; }
    .iw-custom table td { padding: 3px 4px; }

    .iw-mesa table { font-size: .68rem; }
    .iw-mesa table td { padding: 3px 4px; }

}

</style>

<a href="home.html" class="btn-home">
    ⬅ Volver al inicio
</a>
</head>
<!-- MODAL FUERA DE ÁREA -->
<div id="modal-fuera" class="modal-overlay">
    <div class="modal-box">
        <h2>Ubicación fuera de cobertura</h2>
        <p>
            Tu ubicación no pertenece a los límites del actual Marco Geográfico 
            de Participación Ciudadana.
        </p>

        <a href="https://scmgpc.iecm.mx/#" target="_blank" class="modal-link">
            Consultar más información
        </a>

        <button onclick="cerrarModal()" class="modal-btn">
            Entendido
        </button>
    </div>
</div>
<body>

<!-- Tooltip de hover (fuera del mapa, controlado por JS) -->
<div id="hover-panel"></div>

<!-- Header -->
<div class="header">

    <!-- Logo IECM -->
    <div class="header-logo">
        <img src="../imagenes/logo-footer.png" alt="IECM Logo">
    </div>

    <div class="header-center">
        <div class="header-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="#8A3880" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5
                         c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5
                         s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/>
            </svg>
        </div>

        <div class="header-text">
            <h1>Búsqueda por Ubicación en Tiempo Real</h1>
            <p>Sistema de Consulta del Marco Geográfico de Participación Ciudadana de la Ciudad de México</p>
        </div>
    </div>
</div>
        

<!-- Contenido -->
<div class="container">

    <div class="card">
        <div class="card-body">

            <div class="instruccion">
                <span class="instruccion-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="#8A3880" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5
                                c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5
                                s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/>
                    </svg>
                </span>
                <div>
                    Presiona el botón para que el navegador detecte tu ubicación actual. El sistema encontrará automáticamente la 
                    <strong>Seccion Electoral</strong> a la que perteneces y mostrará su polígono en el mapa.
                    
                    <p class="nota-geolocalizacion">
                        Nota: Si abriste este enlace desde Facebook o Instagram, es posible que la geolocalización no funcione. 
                        Desde tu celular, toca el menú de opciones (⋮) (⋯) , generalmente en la parte superior derecha, y selecciona
                        <strong>“Abrir en navegador”</strong> o <strong>“Abrir en navegador externo”</strong>.
                    </p>
                </div>
            </div>

            <button class="btn btn-primary" id="btnDetectar" onclick="buscarPorUbicacion()">
                <span class="btn-icon"></span>
                Detectar mi ubicación
            </button>

            <div id="ubicacion_status"></div>

        </div>
    </div>

    <!-- Resultado: tabla -->
    <div id="resultado_wrap" style="display:none;">
        <div class="resultado-card">
            <div class="resultado-header">
                <span></span> Seccion Electoral encontrada
            </div>
            <div class="table-wrap">
                <div id="tabla_ubicacion"></div>
            </div>
        </div>
    </div>

    <!-- Nota informativa -->
    <div id="nota_mesas" class="nota-mesas">
        <div class="nota-mesas-titulo">
            <span>💡</span> ¿En qué Mesa Receptora de Votación y Opinión puedo participar?
        </div>
        <div class="nota-mesas-texto">
            Al <strong>Confirmar tu Ubicación y ver MRVyO</strong>, el mapa mostrará las mesas que corresponden a tu Seccion Electoral. Toca cualquier <strong>marcador</strong> para ver las secciones electorales que atiende esa mesa. La que incluya tu sección electoral —indicada en el frente de tu Credencial para Votar— es a la que debes acudir a participar.
        </div>
    </div>

    <!-- Resultado: mapa -->
    <div id="mapa_wrap" class="mapa-wrap" style="display:none;">
        <div id="map_ubicacion"></div>
    </div>

</div>

<div class="footer">
    Instituto Electoral de la Ciudad de México &nbsp;·&nbsp; Sistema de Consulta del Marco Geográfico de Participación Ciudadana de la Ciudad de México
</div>

<script>
var isTouchDevice = ('ontouchstart' in window) || (navigator.maxTouchPoints > 0);
/* ── Config ──────────────────────────────────────────── */

const API_PROXY_URL = '/api-proxy.php';              // Desarrollo/Producción
// const API_PROXY_URL = '/dev_caracteristicas_UnidadesTerritoriales/api-proxy_local.php'; // Local
var TABLE    = 'secciones';      // ajusta si tu tabla tiene otro nombre en la API
var TABLE_MESAS = 'mesas_2396';
var MOSTRAR_MESAS = false;
var UTS_EXCEPCION_MESAS = ['15-034', '15-027']; // estas UTs muestran mesas aunque MOSTRAR_MESAS sea false

function mesasHabilitadas(claveUT) {
    return MOSTRAR_MESAS || UTS_EXCEPCION_MESAS.indexOf(claveUT) !== -1;
}

/* ── Helpers UI ─────────────────────────────────────── */
function setStatus(tipo, msg, conSpinner) {
    var spinner = conSpinner ? '<div class="spinner"></div>' : '';
    if (tipo === 'ok') spinner = '';
    document.getElementById('ubicacion_status').innerHTML =
        '<div class="status-box status-' + tipo + '">' + spinner + ' ' + msg + '</div>';
}

function apiGet(endpoint, params, cb) {
    // Construir query string con los parámetros adicionales
    var query = Object.keys(params).map(function(k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(params[k]);
    }).join('&');

    // El proxy recibe el endpoint como parámetro GET
    var url = API_PROXY_URL + '?endpoint=' + encodeURIComponent(endpoint);
    if (query) url += '&' + query;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) cb(xhr.status, xhr.responseText);
    };
    xhr.open('GET', url, true);
    xhr.send();
}

/* ── Búsqueda por ubicación ─────────────────────────── */
function buscarPorUbicacion() {
    if (!navigator.geolocation) {
        setStatus('error', 'Tu navegador no soporta geolocalización.');
        return;
    }
    var btn = document.getElementById('btnDetectar');
    btn.disabled = true;
    document.getElementById('resultado_wrap').style.display = 'none';
    document.getElementById('mapa_wrap').style.display      = 'none';
    document.getElementById('nota_mesas').classList.remove('visible');
    setStatus('info', 'Obteniendo tu ubicación...', true);

    _mesaMarkers.forEach(function(m) { m.map = null; });
    _mesaMarkers = [];

    navigator.geolocation.getCurrentPosition(
        function(pos) {
            var lat = pos.coords.latitude;
            var lon = pos.coords.longitude;
            // var lat = 19.384239295284697;
            // var lon = -99.0433560633633;
            setStatus('info', 'Coordenadas: ' + lat + ', ' + lon + ' — Consultando la API...', true);

            // Usar endpoint /contains/ de la API CON BUFFER de 50m
            apiGet('contains/' + TABLE, { lat: lat, lon: lon, buffer: 50 }, function(status, responseText) {
                btn.disabled = false;
                try {
                    var resp = JSON.parse(responseText);
                    
                    if (status !== 200 || resp.error) {
                        setStatus('error', resp.error || 'Tu ubicación está fuera del área de cobertura.');
                        mostrarModalFuera();
                        fetch("contador.php?tipo=fuera").catch(function(){});
                        return;
                    }
                    
                    if (!resp.features || resp.features.length === 0) {
                        setStatus('error', 'Tu ubicación está fuera del área de cobertura.');
                        mostrarModalFuera();
                        fetch("contador.php?tipo=fuera").catch(function(){});
                        return;
                    }
                    
                    setStatus('ok', 'Se encontraron ' + resp.count + ' unidad(es) territorial(es).');
                    
                    // Mostrar lista de UTs encontradas
                    mostrarListaUTs(resp.features, lat, lon);
                    
                } catch(e) {
                    setStatus('error', 'Error al procesar la respuesta del servidor: ' + e.message);
                }
            });
        },
        function(err) {
            btn.disabled = false;
            var msgs = {
                1: 'Permiso denegado. Activa la geolocalización en tu navegador.',
                2: 'No se pudo determinar tu posición.',
                3: 'Se agotó el tiempo de espera.'
            };
            setStatus('error', msgs[err.code] || 'Error desconocido de geolocalización.');
        },
        { enableHighAccuracy: true, timeout: 12000, maximumAge: 0 }
    );
}

/* ── Render tabla ───────────────────────────────────── */
function renderTabla(feature) {
    var p = feature.properties || {};
    var campos = [
        ['Clave UT',      p.cve_ut     || '—'],
        ['Nombre',        p.nombre     || '—'],
        ['Demarcación',   p.dem_territ || '—'],
        ['Distrito Local',p.dtto_loc   || '—'],
        ['Secciones Completas',     p.secciones  || '—'],
        ['Secciones Parciales',p.secciones1 || '—'],
        ['Tipo UT',       p.tipo_ut    || '—'],
    ];
    
    // Crear la tabla HTML
    var tablaHTML = '<table id="tabladem"><thead><tr>' +
        campos.map(function(r){ return '<th>' + r[0] + '</th>'; }).join('') +
        '</tr></thead><tbody><tr>' +
        campos.map(function(r){ return '<td>' + r[1] + '</td>'; }).join('') +
        '</tr></tbody></table>';

    // Crear o limpiar el contenedor
    var resultadoDiv = document.getElementById('resultado_wrap');
    resultadoDiv.innerHTML = 
        '<div class="resultado-card">' +
        '<div class="resultado-header"><span></span> Seccion Electoral</div>' +
        '<div class="table-wrap">' + tablaHTML + '</div>' +
        '</div>';
    
    // Mostrar el contenedor
    resultadoDiv.style.display = 'block';
}

/* ── Mostrar lista de UTs para seleccionar ─────────── */
function mostrarListaUTs(features, initialLat, initialLon) {
    var html = '<div class="lista-uts-wrap">';
    
    features.forEach(function(feature, idx) {
        var p = feature.properties || {};
        html += '<div class="ut-item" onclick="seleccionarUT(' + idx + ', ' + initialLat + ', ' + initialLon + ')">' +
                    '<strong>' + (p.nombre || '—') + '</strong>' +
                    '<span class="ut-clave">' + (p.cve_ut || '—') + '</span>' +
                '</div>';
    });
    
    html += '</div>';
    
    document.getElementById('resultado_wrap').innerHTML = 
        '<div class="resultado-card">' +
        '<div class="resultado-header"><span></span> Selecciona una Seccion Electoral</div>' +
        html +
        '</div>';
    
    document.getElementById('resultado_wrap').style.display = 'block';
    
    // Guardar features globalmente para después
    window.utFeatures = features;

    // Métricas: si solo hay 1 UT, se registra directo (no hay selección posterior)
    if (features.length === 1) {
        seleccionarUT(0, initialLat, initialLon);
    }

    // console.log('[UTs]', features.length, 'lat:', initialLat, 'lon:', initialLon);
}

/* ── Seleccionar una UT y mostrar mapa ─────────────── */
function seleccionarUT(idx, lat, lon) {
    var feature = window.utFeatures[idx];
    
    // OCULTAR la lista de UTs
    document.getElementById('resultado_wrap').style.display = 'none';
    
    // MOSTRAR la tabla de datos de la UT seleccionada
    renderTabla(feature);

    window._utIdActual = feature.id;
    var id = window._utIdActual;
    if (id) registrarMetrica(id, 'busquedas_ubicacion');
    
    // MOSTRAR el mapa con mensaje de precisión
    document.getElementById('mapa_wrap').style.display = 'block';
    pintarMapa(feature, 'map_ubicacion', 'mapa_wrap', lat, lon);
}

/* ── MARCADOR ARRASTRA BLE SIMPLE Y FUNCIONAL ─────────── */
function SimpleMarker(position, icon, map) {
    this.position = position;
    this.icon = icon;
    this.map = map;
    this.listeners = {};
    this.isDragging = false;
    this.setMap(map);
}

SimpleMarker.prototype = Object.create(google.maps.OverlayView.prototype);

SimpleMarker.prototype.onAdd = function() {
    var self = this;
    
    var div = document.createElement('div');
    div.className = 'user-marker';
    
    var img = document.createElement('img');
    img.src = this.icon;
    img.onerror = function() { img.style.display = 'none'; };
    img.alt = 'Mi ubicación';

    // ── Leyenda sutil ──
    var label = document.createElement('div');
    label.className = 'user-label';
    label.textContent = 'Tu ubicación';

    div.appendChild(label); // ← primero el label (queda arriba por position:absolute)
    div.appendChild(img);
    this.div = div;
    
    div.appendChild(img);
    this.div = div;
    
    var panes = this.getPanes();
    panes.overlayMouseTarget.appendChild(div);
    
    // Eventos de mouse
    div.addEventListener('mousedown', function(e) {
        self.startDrag(e);
    });

    // Eventos táctiles para móviles
    div.addEventListener('touchstart', function(e) {
        self.startDrag(e);
    }, { passive: false });
};

SimpleMarker.prototype.startDrag = function(e) {
    var self = this;
    this.isDragging = true;
    this.div.style.zIndex = 999999;
    this.div.style.cursor = 'grabbing';
    
    e.preventDefault();
    e.stopPropagation();
    
    // Detectar si es touch o mouse
    var isTouch = e.type === 'touchstart';
    var startX = isTouch ? e.touches[0].clientX : e.clientX;
    var startY = isTouch ? e.touches[0].clientY : e.clientY;
    var startPos = this.position;
    
    var onMove = function(moveEvent) {
        if (!self.isDragging) return;
        
        moveEvent.preventDefault();
        moveEvent.stopPropagation();
        
        var isTouchMove = moveEvent.type === 'touchmove';
        var clientX = isTouchMove ? moveEvent.touches[0].clientX : moveEvent.clientX;
        var clientY = isTouchMove ? moveEvent.touches[0].clientY : moveEvent.clientY;
        
        var deltaX = clientX - startX;
        var deltaY = clientY - startY;
        
        var projection = self.getProjection();
        if (!projection) return;
        
        var startPixel = projection.fromLatLngToDivPixel(
            new google.maps.LatLng(startPos.lat, startPos.lng)
        );
        
        var newPixel = new google.maps.Point(
            startPixel.x + deltaX,
            startPixel.y + deltaY
        );
        
        var newLatLng = projection.fromDivPixelToLatLng(newPixel);
        
        self.position = {
            lat: newLatLng.lat(),
            lng: newLatLng.lng()
        };
        
        self.draw();
        self.notify('position_changed');
    };
    
    var onEnd = function() {
        self.isDragging = false;
        self.div.style.zIndex = 'auto';
        self.div.style.cursor = 'grab';
        
        // Remover eventos de mouse
        document.removeEventListener('mousemove', onMove);
        document.removeEventListener('mouseup', onEnd);
        
        // Remover eventos táctiles
        document.removeEventListener('touchmove', onMove);
        document.removeEventListener('touchend', onEnd);
    };
    
    // Agregar eventos de mouse
    document.addEventListener('mousemove', onMove, true);
    document.addEventListener('mouseup', onEnd, true);
    
    // Agregar eventos táctiles
    document.addEventListener('touchmove', onMove, { passive: false, capture: true });
    document.addEventListener('touchend', onEnd, true);
};

SimpleMarker.prototype.draw = function() {
    var projection = this.getProjection();
    if (!projection) return;
    
    var position = projection.fromLatLngToDivPixel(
        new google.maps.LatLng(this.position.lat, this.position.lng)
    );
    
    if (this.div) {
        this.div.style.left = (position.x - 14) + 'px';
        this.div.style.top = (position.y - 14) + 'px';
        this.div.style.position = 'absolute';
    }
};

SimpleMarker.prototype.onRemove = function() {
    if (this.div && this.div.parentNode) {
        this.div.parentNode.removeChild(this.div);
        this.div = null;
    }
};

SimpleMarker.prototype.getPosition = function() {
    return this.position;
};

SimpleMarker.prototype.setPosition = function(position) {
    this.position = position;
    this.draw();
};

SimpleMarker.prototype.addListener = function(event, callback) {
    if (!this.listeners[event]) {
        this.listeners[event] = [];
    }
    this.listeners[event].push(callback);
};

SimpleMarker.prototype.notify = function(event) {
    if (this.listeners[event]) {
        this.listeners[event].forEach(function(callback) {
            callback();
        });
    }
};

/* ── Pintar mapa ─────────────────────────────────── */
function pintarMapa(feature, mapId, wrapId, userLat, userLon) {
    var mapDiv = document.getElementById(mapId);
    var wrapDiv = document.getElementById(wrapId);
    wrapDiv.style.display = 'block';
    void mapDiv.offsetHeight;

    var mapaUT = new google.maps.Map(mapDiv, {
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: { lat: 19.432608, lng: -99.133209 },
        zoom: 14,
        styles: [{ featureType: 'poi', stylers: [{ visibility: 'off' }] }],
        mapId: "f783d4767a5c1988"
    });

    // Guardar referencia del mapa para accederlo después
    mapDiv.__gmap = mapaUT;

    // MARCADOR DE USUARIO ARRASTRA BLE
    var userMarker = null;
    var currentLat = userLat;
    var currentLon = userLon;
    
    if (userLat && userLon) {
        userMarker = new SimpleMarker(
            { lat: userLat, lng: userLon },
            '../imagenes/iconoub.png',
            mapaUT
        );

        userMarker.addListener('position_changed', function() {
            var pos = userMarker.getPosition();
            currentLat = pos.lat;
            currentLon = pos.lng;
            // console.log(' Posición:', currentLat.toFixed(5), currentLon.toFixed(5));
        });

        setStatus('info', 'Puedes arrastrar el marcador para ajustar tu ubicación. Presiona "Confirmar ubicación" cuando esté en el lugar correcto.');
    }

    mapaUT.data.setStyle({
        fillColor:    '#956BB0',
        fillOpacity:  0.4,
        strokeColor:  '#6b2a63',
        strokeOpacity: 0.9,
        strokeWeight: 2.5
    });

    mapaUT.data.addGeoJson({ type: 'FeatureCollection', features: [feature] });

    // Centrar en el polígono
    google.maps.event.addListenerOnce(mapaUT, 'idle', function() {
        var bounds = new google.maps.LatLngBounds();
        mapaUT.data.forEach(function(f) {
            f.getGeometry().forEachLatLng(function(latlng) { bounds.extend(latlng); });
        });
        if (!bounds.isEmpty()) mapaUT.fitBounds(bounds);
    });

    var p = feature.properties || {};

    // ── InfoWindow ──
    var iwContent =
        '<div class="iw-custom">' +
        '<h4>' + (p.nombre || '—') + '</h4>' +
        '<table>' +
        '<tr><td>Entidad</td><td>'            + (p.entidad    ||'—') + '</td></tr>' +
        '<tr><td>Cve. Demarcación</td><td>'   + (p.cve_demarc ||'—') + '</td></tr>' +
        '<tr><td>Demarcación</td><td>'        + (p.dem_territ ||'—') + '</td></tr>' +
        '<tr><td>Distrito Local</td><td>'     + (p.dtto_loc   ||'—') + '</td></tr>' +
        '<tr><td>Cve. UT</td><td>'            + (p.cve_ut     ||'—') + '</td></tr>' +
        '<tr><td>Seccion Electoral</td><td>' + (p.nombre     ||'—') + '</td></tr>' +
        '<tr><td>Secciones Completas</td><td>'          + (p.secciones  ||'—') + '</td></tr>' +
        '<tr><td>Secciones Parciales</td><td>'     + (p.secciones1 ||'—') + '</td></tr>' +
        '<tr><td>Tipo UT</td><td>'            + (p.tipo_ut    ||'—') + '</td></tr>' +
        '</table></div>';

    var infoWindow = new google.maps.InfoWindow({
        content: iwContent,
        disableAutoPan: false
    });

    // Guardar referencia del infowindow
    mapDiv.__infoWindow = infoWindow;

    mapaUT.data.addListener('click', function(event) {
        infoWindow.close();
        infoWindow.setOptions({ position: event.latLng });
        infoWindow.open(mapaUT);
    });

    google.maps.event.addListenerOnce(mapaUT, 'idle', function() {
        infoWindow.open(mapaUT);
    });

    // ── Botón de confirmar ubicación ──
    // Eliminar botón anterior si existe
    var btnAnterior = wrapDiv.querySelector('.btn-confirmar-container');
    if (btnAnterior) {
        btnAnterior.remove();
    }

    var btnContainer = document.createElement('div');
    btnContainer.className = 'btn-confirmar-container';

    var btnConfirmar = document.createElement('button');
    btnConfirmar.className = 'btn btn-primary';
    // btnConfirmar.textContent = '✓ Confirmar Ubicación y ver MRVyO';
    btnConfirmar.textContent = '✓ Confirmar Ubicación';
    btnConfirmar.style.cssText = 'cursor: pointer;';


    btnConfirmar.onclick = function() {
        confirmarUbicacion(currentLat, currentLon);
    };

    btnContainer.appendChild(btnConfirmar);
    wrapDiv.appendChild(btnContainer);

    var hoverPanel = document.getElementById('hover-panel');

    mapaUT.data.addListener('mouseover', function(event) {
        mapaUT.data.overrideStyle(event.feature, {
            strokeColor:  '#32215C',
            strokeWeight: 4,
            fillOpacity:  0.05
        });
        if (isTouchDevice) return;
        hoverPanel.innerHTML =
            '<strong>' + (p.nombre || '—') + '</strong>' +
            'Clave: ' + (p.cve_ut    || '—') + '<br>' +
            'Demarcación: '  + (p.dem_territ || '—') + '<br>' +
            'Tipo: '  + (p.tipo_ut    || '—');
        hoverPanel.style.display = 'block';
    });

    mapaUT.data.addListener('mousemove', function(event) {
        if (isTouchDevice) return;
        var e = event.domEvent;
        if (e) {
            hoverPanel.style.left = (e.clientX + 14) + 'px';
            hoverPanel.style.top  = e.clientY + 'px';
        }
    });

    mapaUT.data.addListener('mouseout', function() {
        mapaUT.data.revertStyle();
        if (isTouchDevice) return;
        hoverPanel.style.display = 'none';
    });
}


/* ── Confirmar ubicación final ────────────────────── */
function confirmarUbicacion(lat, lon) {
    setStatus('info', 'Confirmando ubicación...', true);


    
    // Hacer consulta SIN buffer y SIN redondeo
    apiGet('contains/' + TABLE, { lat: lat, lon: lon }, function(status, responseText) {
        try {
            var resp = JSON.parse(responseText);
            
            if (status !== 200) {
                setStatus('error', 'Error del servidor: ' + status);
                mostrarModalFuera();
                fetch("contador.php?tipo=fuera").catch(function(){});
                return;
            }
            
            if (resp.error) {
                setStatus('error', resp.error);
                mostrarModalFuera();
                fetch("contador.php?tipo=fuera").catch(function(){});
                return;
            }
            
            if (!resp.features || resp.features.length === 0) {
                setStatus('error', 'Esta ubicación no pertenece a ninguna UT.');
                mostrarModalFuera();
                fetch("contador.php?tipo=fuera").catch(function(){});
                return;
            }
            
            setStatus('ok', 'Ubicación confirmada correctamente.');
            
            // Mostrar la UT confirmada en la tabla
            var feature = resp.features[0];
            var claveUT = (feature.properties || {}).cve_ut || '';
            window._utIdActual = feature.id; // AGREGA ESTA LÍNEA
            registrarMetrica(feature.id, 'busquedas_ubicacion'); // AGREGA ESTA LÍNEA
            renderTabla(feature);
            // if (MOSTRAR_MESAS) {
            //     document.getElementById('nota_mesas').classList.add('visible');
            // }
            if (mesasHabilitadas(claveUT)) {
                document.getElementById('nota_mesas').classList.add('visible');
            } else {
                document.getElementById('nota_mesas').classList.remove('visible');
            }


            // ACTUALIZAR EL MAPA CON EL NUEVO POLÍGONO
            var mapDiv = document.getElementById('map_ubicacion');

            _mesaMarkers.forEach(function(m) { m.map = null; });
            _mesaMarkers = [];
            if (window._mesaClusterer) {
                window._mesaClusterer.clearMarkers();
                window._mesaClusterer = null;
            }

            if (mapDiv && mapDiv.__gmap) {
                var map = mapDiv.__gmap;
                
                // 1. CERRAR Y ELIMINAR INFOWINDOW ANTERIOR
                if (mapDiv.__infoWindow) {
                    mapDiv.__infoWindow.close();
                    mapDiv.__infoWindow = null;
                }
                
                // 2. ELIMINAR TODOS LOS LISTENERS ANTERIORES DEL DATA
                google.maps.event.clearListeners(map.data, 'click');
                google.maps.event.clearListeners(map.data, 'mouseover');
                google.maps.event.clearListeners(map.data, 'mousemove');
                google.maps.event.clearListeners(map.data, 'mouseout');
                
                // 3. LIMPIAR TODOS LOS DATOS ANTERIORES
                map.data.forEach(function(feature) {
                    map.data.remove(feature);
                });
                
                // 4. AGREGAR EL NUEVO POLÍGONO
                map.data.addGeoJson({ type: 'FeatureCollection', features: [feature] });
                
                // 5. CENTRAR EN EL NUEVO POLÍGONO
                var bounds = new google.maps.LatLngBounds();
                map.data.forEach(function(f) {
                    f.getGeometry().forEachLatLng(function(latlng) { 
                        bounds.extend(latlng); 
                    });
                });
                if (!bounds.isEmpty()) {
                    map.fitBounds(bounds);
                }
                
                // 6. CREAR NUEVO INFOWINDOW CON LOS DATOS ACTUALIZADOS
                var p = feature.properties || {};
                var iwContent =
                    '<div class="iw-custom">' +
                    '<h4>' + (p.nombre || '—') + '</h4>' +
                    '<table>' +
                    '<tr><td>Entidad</td><td>'            + (p.entidad    ||'—') + '</td></tr>' +
                    '<tr><td>Cve. Demarcación</td><td>'   + (p.cve_demarc ||'—') + '</td></tr>' +
                    '<tr><td>Demarcación</td><td>'        + (p.dem_territ ||'—') + '</td></tr>' +
                    '<tr><td>Distrito Local</td><td>'     + (p.dtto_loc   ||'—') + '</td></tr>' +
                    '<tr><td>Cve. UT</td><td>'            + (p.cve_ut     ||'—') + '</td></tr>' +
                    '<tr><td>Seccion Electoral</td><td>' + (p.nombre     ||'—') + '</td></tr>' +
                    '<tr><td>Secciones Completas</td><td>'          + (p.secciones  ||'—') + '</td></tr>' +
                    '<tr><td>Secciones Parciales</td><td>'     + (p.secciones1 ||'—') + '</td></tr>' +
                    '<tr><td>Tipo UT</td><td>'            + (p.tipo_ut    ||'—') + '</td></tr>' +
                    '</table></div>';
                
                var newInfoWindow = new google.maps.InfoWindow({
                    content: iwContent,
                    disableAutoPan: false
                });
                
                // Guardar referencia del nuevo infowindow
                mapDiv.__infoWindow = newInfoWindow;
                
                // 7. REASIGNAR EVENTOS DEL MAPA CON LOS NUEVOS DATOS
                var hoverPanel = document.getElementById('hover-panel');
                
                // Click event
                map.data.addListener('click', function(event) {
                    newInfoWindow.close();
                    newInfoWindow.setOptions({ position: event.latLng });
                    newInfoWindow.open(map);
                });
                
                // Mouseover event
                map.data.addListener('mouseover', function(event) {
                    map.data.overrideStyle(event.feature, {
                        strokeColor:  '#32215C',
                        strokeWeight: 4,
                        fillOpacity:  0.1
                    });
                    if (isTouchDevice) return;
                    hoverPanel.innerHTML =
                        '<strong>' + (p.nombre || '—') + '</strong>' +
                        'Clave: ' + (p.cve_ut    || '—') + '<br>' +
                        'Demarcación: '  + (p.dem_territ || '—') + '<br>' +
                        'Tipo: '  + (p.tipo_ut    || '—');
                    hoverPanel.style.display = 'block';
                });
                
                // Mousemove event
                map.data.addListener('mousemove', function(event) {
                    if (isTouchDevice) return;
                    var e = event.domEvent;
                    if (e) {
                        hoverPanel.style.left = (e.clientX + 14) + 'px';
                        hoverPanel.style.top  = e.clientY + 'px';
                    }
                });
                
                // Mouseout event
                map.data.addListener('mouseout', function() {
                    map.data.revertStyle();
                    if (isTouchDevice) return;
                    hoverPanel.style.display = 'none';
                });
                
                // 8. MOSTRAR EL NUEVO INFOWINDOW
                setTimeout(function() {
                    newInfoWindow.open(map);
                }, 300);

                // if (MOSTRAR_MESAS && claveUT) {
                //     cargarMesas(map, claveUT, lat, lon);
                // }
                if (claveUT && mesasHabilitadas(claveUT)) {
                    cargarMesas(map, claveUT, lat, lon);
                }


                // console.log('✓ Polígono actualizado:', p.nombre);
            }
            
        } catch(e) {
            setStatus('error', 'Error al confirmar ubicación: ' + e.message);
        }
    });
}

function mostrarModalFuera(){
    document.getElementById('modal-fuera').classList.add('active');
}

function cerrarModal(){
    document.getElementById('modal-fuera').classList.remove('active');
}


var _mesaMarkers = [];

function getMesaClass(mesa) {
    var num = parseInt((mesa || '').replace(/\D/g, '')) || 1;
    return 'mesa-m' + Math.min(num, 6);
}

// function cargarMesas(map, claveUT, userLat, userLon) {
//     _mesaMarkers.forEach(function(m) { m.map = null; });
//     _mesaMarkers = [];

//     apiGet('filter_2/' + TABLE_MESAS, { claveut: claveUT }, function(status, responseText) {
//         try {
//             var resp = JSON.parse(responseText);
//             if (!resp.features || resp.features.length === 0) {
//                 setStatus('ok', '✓ Ubicación confirmada. No se encontraron mesas para esta UT.');
//                 document.getElementById('nota_mesas').classList.remove('visible');
//                 return;
//             }

//             setStatus('ok', '✓ Ubicación confirmada. Se encontraron ' + resp.features.length + ' mesa(s).');
//             document.getElementById('nota_mesas').classList.add('visible');

//             resp.features.forEach(function(f) {
//                 var coords = f.geometry && f.geometry.coordinates;
//                 if (!coords) return;

//                 var mp = f.properties || {};
//                 var mesaLabel = mp.mesa || '—';
//                 var colorClass = getMesaClass(mesaLabel);

//                 var tag = document.createElement('div');
//                 tag.className = 'mesa-tag ' + colorClass;
//                 tag.textContent = mesaLabel;

//                 google.maps.importLibrary('marker').then(function(lib) {
//                     var marker = new lib.AdvancedMarkerElement({
//                         position: { lat: coords[1], lng: coords[0] },
//                         map: map,
//                         content: tag,
//                         title: mesaLabel
//                     });

//                     var iwMesa = new google.maps.InfoWindow({
//                         content:
//                             '<div class="iw-mesa">' +
//                             '<h4>' + (mp.mesa || '—') + ' — ' + (mp.nombreut || '—') + '</h4>' +
//                             '<table>' +
//                             '<tr><td>Distrito</td><td>'  + (mp.dt        || '—') + '</td></tr>' +
//                             '<tr><td>Clave UT</td><td>'  + (mp.claveut   || '—') + '</td></tr>' +
//                             '<tr><td>Secciones</td><td>' + (mp.secss     || '—') + '</td></tr>' +
//                             '<tr><td>Mesa</td><td>'      + (mp.mesa      || '—') + '</td></tr>' +
//                             '<tr><td>Lugar</td><td>'     + (mp.lugar     || '—') + '</td></tr>' +
//                             '<tr><td>Domicilio</td><td>' + (mp.domicilio || '—') + '</td></tr>' +
//                             '</table>' +
//                             // ── Botón de ruta ──
//                             '<a href="https://www.google.com/maps/dir/?api=1' +
//                                 '&origin=' + userLat + ',' + userLon +
//                                 '&destination=' + coords[1] + ',' + coords[0] +
//                                 '&travelmode=driving" ' +
//                                 'target="_blank" ' +
//                                 'style="' +
//                                     'display:flex;align-items:center;gap:8px;' +
//                                     'margin-top:10px;padding:9px 14px;' +
//                                     'background:linear-gradient(135deg,#8A3880,#6b2a63);' +
//                                     'color:white;border-radius:8px;text-decoration:none;' +
//                                     'font-size:.82rem;font-weight:600;justify-content:center;' +
//                                     'box-shadow:0 2px 8px rgba(138,56,128,.35);' +
//                                 '">' +
//                                 'Cómo llegar a esta mesa' +
//                             '</a>' +
//                             '</div>'
//                     });

//                     marker.addListener('gmp-click', function() {
//                         iwMesa.open({ map: map, anchor: marker });
//                     });

//                     _mesaMarkers.push(marker);
//                 });
//             });

//         } catch(e) {
//             setStatus('error', 'Error al cargar mesas: ' + e.message);
//         }
//     });
// }
function cargarMesas(map, claveUT, userLat, userLon) {
    _mesaMarkers.forEach(function(m) { m.map = null; });
    _mesaMarkers = [];

    // Limpiar clusterer anterior si existe
    if (window._mesaClusterer) {
        window._mesaClusterer.clearMarkers();
        window._mesaClusterer = null;
    }

    apiGet('filter_2/' + TABLE_MESAS, { claveut: claveUT }, function(status, responseText) {
        try {
            var resp = JSON.parse(responseText);

            if (!resp.features || resp.features.length === 0) {
                setStatus('ok', '✓ Ubicación confirmada. No se encontraron mesas para esta UT.');
                document.getElementById('nota_mesas').classList.remove('visible');
                return;
            }

            if (window._utIdActual) registrarMetrica(window._utIdActual, 'total_mesas_mostradas');

            setStatus('ok', '✓ Ubicación confirmada. Se encontraron ' + resp.features.length + ' mesa(s).');
            document.getElementById('nota_mesas').classList.add('visible');

            google.maps.importLibrary('marker').then(function(lib) {
                var promises = resp.features.map(function(f) {
                    return new Promise(function(resolve) {
                        var coords = f.geometry && f.geometry.coordinates;
                        if (!coords) { resolve(null); return; }

                        var mp = f.properties || {};
                        var mesaLabel = mp.mesa || '—';
                        var colorClass = getMesaClass(mesaLabel);

                        var tag = document.createElement('div');
                        tag.className = 'mesa-tag ' + colorClass;

                        // Insertamos la imagen y el texto
                        tag.innerHTML = `
                            <img src="../imagenes/mesas.png">
                            <span>${mesaLabel}</span>
                        `;

                        var marker = new lib.AdvancedMarkerElement({
                            position: { lat: coords[1], lng: coords[0] },
                            content: tag,
                            title: mesaLabel
                            // sin map aquí — lo maneja el clusterer
                        });

                        var iwMesa = new google.maps.InfoWindow({
                            content:
                                '<div class="iw-mesa">' +
                                '<h4>' + (mp.mesa || '—') + ' — ' + (mp.nombreut || '—') + '</h4>' +
                                '<table>' +
                                '<tr><td>Distrito</td><td>'  + (mp.dtto      || '—') + '</td></tr>' +
                                '<tr><td>Demarcación</td><td>'  + (mp.dt     || '—') + '</td></tr>' +
                                '<tr><td>Clave UT</td><td>'  + (mp.claveut   || '—') + '</td></tr>' +
                                '<tr><td>Secciones</td><td>' + (mp.secss     || '—') + '</td></tr>' +
                                '<tr><td>Mesa</td><td>'      + (mp.mesa      || '—') + '</td></tr>' +
                                '<tr><td>Lugar</td><td>'     + (mp.lugar     || '—') + '</td></tr>' +
                                '<tr><td>Domicilio</td><td>' + (mp.domicilio || '—') + '</td></tr>' +
                                '</table>' +
                                '<a href="https://www.google.com/maps/dir/?api=1' +
                                    '&origin=' + userLat + ',' + userLon +
                                    '&destination=' + coords[1] + ',' + coords[0] +
                                    '&travelmode=walking" ' +
                                    'target="_blank" ' +
                                    'style="display:flex;align-items:center;gap:8px;margin-top:10px;padding:9px 14px;background:linear-gradient(135deg,#8A3880,#6b2a63);color:white;border-radius:8px;text-decoration:none;font-size:.82rem;font-weight:600;justify-content:center;box-shadow:0 2px 8px rgba(138,56,128,.35);">' +
                                    'Cómo llegar a esta mesa' +
                                '</a>' +
                                '</div>'
                        });

                        marker.addListener('gmp-click', function() {
                            iwMesa.open({ map: map, anchor: marker });
                        });

                        _mesaMarkers.push(marker);
                        resolve(marker);
                    });
                });

                Promise.all(promises).then(function(markers) {
                    var validMarkers = markers.filter(Boolean);

                    // Crear clusterer con estilo personalizado
                    window._mesaClusterer = new markerClusterer.MarkerClusterer({
                        map: map,
                        markers: validMarkers,
                        renderer: {
                            render: function(cluster) {
                                var count = cluster.count;
                                var div = document.createElement('div');
                                
                                // Estilo del contenedor (tipo pastilla/pill)
                                div.style.cssText = `
                                    background: linear-gradient(135deg, #8A3880, #6b2a63);
                                    color: white;
                                    border-radius: 25px; 
                                    padding: 4px 12px 4px 6px; /* Menos padding a la izquierda para la imagen */
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    gap: 8px;
                                    font-weight: 700;
                                    font-size: 15px;
                                    box-shadow: 0 3px 10px rgba(0,0,0,0.3);
                                    border: 2px solid white;
                                    cursor: pointer;
                                    transform: translate(-50%, -50%);
                                `;

                                // Insertamos la imagen y el número
                                div.innerHTML = `
                                    <img src="../imagenes/mesas.png" 
                                        style="width: 28px; height: 28px; object-fit: contain; display: block;" 
                                        alt="Icono">
                                    <span>${count}</span>
                                `;

                                return new lib.AdvancedMarkerElement({
                                    position: cluster.position,
                                    content: div
                                });
                            }
                        }
                        // renderer: {
                        //     render: function(cluster) {
                        //         var count = cluster.count;
                        //         var div = document.createElement('div');
                                
                        //         // Estilo del contenedor: ahora es una "pastilla" (pill) para que quepa el SVG y el número
                        //         div.style.cssText = `
                        //             background: linear-gradient(135deg, #8A3880, #6b2a63);
                        //             color: white;
                        //             border-radius: 25px; 
                        //             padding: 5px 12px 5px 8px;
                        //             display: flex;
                        //             align-items: center;
                        //             justify-content: center;
                        //             gap: 6px;
                        //             font-weight: 700;
                        //             font-size: 14px;
                        //             box-shadow: 0 3px 12px rgba(138,56,128,0.5);
                        //             border: 2px solid white;
                        //             cursor: pointer;
                        //             transform: translate(-50%, -50%); /* Centra el cluster sobre el punto */
                        //         `;

                        //         // Inyectamos el SVG de la urna y el contador
                        //         div.innerHTML = `
                        //             <svg width="24" height="24" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" style="display:block;">
                        //                 <rect x="10" y="24" width="44" height="30" rx="6" fill="#ffffff" fill-opacity="0.2""")/>>
                        //                 <rect x="10" y="24" width="44" height="30" rx="6" stroke="#ffffff" stroke-width="2" fill="none""")/>>
                        //                 <rect x="14" y="18" width="36" height="10" rx="3" fill="#ffffff""")/>>
                        //                 <rect x="22" y="21" width="20" height="3" rx="1.5" fill="#8A3880""")/>>
                        //                 <rect x="26" y="8" width="12" height="12" rx="2" fill="#ffffff" transform="rotate(12 32 14)""")/>>
                        //                 <path d="M29 14 L31 16 L35 12" stroke="#8A3880" stroke-width="3" fill="none" stroke-linecap="round""")/>>
                        //             </svg>
                        //             <span>${count}</span>
                        //         `;

                        //         return new lib.AdvancedMarkerElement({
                        //             position: cluster.position,
                        //             content: div
                        //         });
                        //     }
                        // }
                    });
                });
            });

        } catch(e) {
            setStatus('error', 'Error al cargar mesas: ' + e.message);
        }
    });
}

function registrarMetrica(id, campo) {
    // console.log('[registrarMetrica INICIO]', id, campo); // <-- agrega esto
    var urlGet = API_PROXY_URL + '?endpoint=' + encodeURIComponent('feature/TABLE/' + id);

    fetch(urlGet)
        .then(function(r){ return r.json(); })
        .then(function(data) {
            var props = data.properties || {};
            var valorActual = parseInt(props[campo]) || 0;
            var body = { properties: {} };
            body.properties[campo] = valorActual + 1;
            if (campo === 'busquedas_ubicacion') body.properties['ultima_busqueda_ubicacion'] = new Date().toISOString().slice(0,19).replace('T',' ');
            if (campo === 'busquedas_domicilio')  body.properties['ultima_busqueda_domicilio']  = new Date().toISOString().slice(0,19).replace('T',' ');
            if (campo === 'total_mesas_mostradas') {} // sin timestamp

            var urlPatch = API_PROXY_URL + '?endpoint=' + encodeURIComponent('patch/TABLE/' + id) + '&modo=escritura';
            return fetch(urlPatch, { method: 'PATCH', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(body) });
        })
        .catch(function(){});
}
</script>
<script>
fetch("contador.php?tipo=ubicacion")
.then(res => res.json())
.then(data => {
    // console.log("Conteo ubicación:", data.conteo_ubi);
});
</script>
</body>
</html>

