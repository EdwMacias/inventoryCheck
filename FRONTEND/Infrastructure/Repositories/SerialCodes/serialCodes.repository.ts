const serialCodes = [
    { id: '1', codigo: 'SGSS' },
    { id: '2', codigo: 'SECR' },
    { id: '3', codigo: 'RECE' },
    { id: '4', codigo: 'ARCH' },
    { id: '5', codigo: 'GERE' },
    { id: '6', codigo: 'PORT' },
    { id: '7', codigo: 'CONT' },
    { id: '8', codigo: 'CAFT' },
    { id: '9', codigo: 'ACCO' } 
];

export const SerialCodeRepository = {
     getCodeById(id: string) {
        const result = serialCodes.filter(serial => serial.id == id).map(serial => serial.codigo);
        return result.length ? result[0] : undefined;
    },
}