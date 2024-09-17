import * as yup from 'yup';

yup.setLocale({
  // use constant translation keys for messages without values
  mixed: {
    required: ({ path }) => `Campo Requerido *`,
  },
  string : {
    email : "Correo no valido"
  },  
  // use functions to generate an error object that includes the value from the schema
  number: {
    min: ({ min }) => ({ key: 'field_too_short', values: { min } }),
    max: ({ max }) => ({ key: 'field_too_big', values: { max } }),
  },
});

export {yup};