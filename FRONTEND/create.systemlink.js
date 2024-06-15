import fs from 'fs';
import path from 'path';

// Ruta al directorio de imágenes en Laravel
const targetDir = path.resolve('../backend/storage/app/public/imagenes');

// Ruta donde se creará el enlace simbólico en el proyecto Nuxt
const linkDir = path.resolve('public/imagenes');

// Crear el enlace simbólico
if (!fs.existsSync(targetDir)) {
    console.error(`El directorio objetivo no existe: ${targetDir}`);
    process.exit(1);
}

if (fs.existsSync(linkDir)) {
    console.log(`El enlace ya existe: ${linkDir}`);
} else {
    fs.symlinkSync(targetDir, linkDir, 'dir');
    console.log(`Enlace simbólico creado desde ${linkDir} hacia ${targetDir}`);
}
