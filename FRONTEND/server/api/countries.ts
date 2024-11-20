import { readFileSync } from 'fs';
import { join } from 'path';

export default defineEventHandler(async (event) => {
  try {
    // Ruta al archivo JSON
    const filePath = join(process.cwd(), 'server/data/countries.json');

    // Leer el contenido del archivo JSON
    const countries = JSON.parse(readFileSync(filePath, 'utf-8'));

    // Devolver el contenido del archivo JSON
    return countries;
  } catch (error: any) {
    // Manejo de errores
    return {
      status: "error",
      message: "No se pudo cargar el archivo JSON",
      error: error.message
    };
  }
})
