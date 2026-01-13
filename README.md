# Gestión de Residencias - ResiAdmin (PostgreSQL + Docker)

Sistema de control de residencia estudiantil: gestión de apartamentos y becados (cubanos y extranjeros), evaluaciones y listados estadísticos.  
La base de datos está implementada en **PostgreSQL** y el proyecto está preparado para ejecutarse en **Docker**.

---

## 🚀 Requisitos previos
- Tener instalado [Docker](https://docs.docker.com/get-docker/)
- Tener instalado [Docker Compose](https://docs.docker.com/compose/)

---

## ⚙️ Instalación y ejecución

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/naylanbarrera/gestion-de-residencias-ResiAdmin-PostgreSQL.git
   cd gestion-de-residencias-ResiAdmin-PostgreSQL

2. **Levantar el proyecto:**
   ```bash
   docker compose up -d

3. **Ejecutar migraciones y seed:**
   Una vez que los contenedores estén en ejecución, corre las migraciones y el seed:

4. **Iniciar sesión:**
   Puedes acceder al sistema utilizando cualquiera de estas cuentas de prueba:

   **Usuario 1** 
      - Correo: `especialista@gmail.com` 
      - Contraseña: `12345678` 
   
   **Usuario 2** 
      - Correo: `esepcialista@gmail.com` 
      - Contraseña: `12345678`