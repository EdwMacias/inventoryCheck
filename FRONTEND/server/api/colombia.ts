import { readFileSync } from 'fs';
import { join } from 'path';

export default defineEventHandler(async (event) => {
  try {
    // Ruta al archivo JSON
    const filePath = join(process.cwd(), 'server/data/colombia.json');
    const filePathDepartamentos = join(process.cwd(), 'server/data/departamentos.json');

    // Leer el contenido del archivo JSON
    const jsonData = JSON.parse(readFileSync(filePath, 'utf-8'));
    const jsonDataDepartamentos = JSON.parse(readFileSync(filePathDepartamentos, 'utf-8'));

    // Devolver el contenido del archivo JSON
    return jsonData ;
  } catch (error: any) {
    // Manejo de errores
    return {
      status: "error",
      message: "No se pudo cargar el archivo JSON",
      error: error.message
    };
  }
})
