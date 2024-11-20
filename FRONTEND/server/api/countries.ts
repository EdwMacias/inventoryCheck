import { readFileSync } from 'fs';
import { join } from 'path';

export default defineEventHandler(async (event) => {
  try {
    // Ruta al archivo JSON
    const filePath = join(process.cwd(), 'server/data/Countries.json');

    // Leer el contenido del archivo JSON
    const Countries = JSON.parse(readFileSync(filePath, 'utf-8'));

    // Devolver el contenido del archivo JSON
    return Countries ;
  } catch (error: any) {
    // Manejo de errores
    return {
      status: "error",
      message: "No se pudo cargar el archivo JSON",
      error: error.message
    };
  }
})
