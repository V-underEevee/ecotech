# 🌿 EcoTech Solutions - Primer Parcial Producción Web

Escuela de Arte Multimedial Da Vinci

- CARRERA: Análisis de Sistemas
- MATERIA: Producción Web
- TRABAJO PRÁCTICO: Primer Parcial
- PROFESOR: Carlos Ferrer
- ALUMNO: [Guerri, Bruno]
- ALUMNO: [Ramirez, Lucas]
- CUATRIMESTRE: Tercer Cuatrimestre
- AÑO: 2026
- TURNO: TARDE
- COMISIÓN: ACT3AP

---

## 🚀 Cómo ejecutar el proyecto (con vendor incluido)

Como la carpeta `vendor` ya viene incluida en la entrega, no es necesario ejecutar `composer install`.
El sistema no requiere registro previo. El carrito y los pedidos funcionan por sesión anónima.

### Pasos para ejecutar

1. Descomprimir la carpeta `ecotech` dentro de `C:\laragon\www\`
2. Iniciar Laragon
3. Abrir una terminal en `C:\laragon\www\ecotech`
4. Copiar el archivo de entorno:
   ```bash
   copy .env.example .env
5. Generar la clave de la aplicación: php artisan key:generate
6. Ejecutar las migraciones y los seeders: php artisan migrate --seed
7. Correr el servidor: php artisan serve
8. Abrir el proyecto en el navegador: http://127.0.0.1:8000