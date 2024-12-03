<template>
  <VeeForm :validationSchema="formularioEquipoSchema" @submit="onSubmit" @invalid-submit="invalidSubmit"
    v-slot="{ meta, errors }">
    <div role="tablist" class="tabs tabs-lifted overflow-x-auto">.
      <input type="radio" name="my_tabs_2" role="tab" class="tab " aria-label="Equipo*" :checked="isTabActive == '1'"
        @click="isTabActive = '1'" />
      <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-2">
        <div
          class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-3 xl:grid-cols-4 gap-1 md:gap-2 lg:gap-3 xl:grid-cols-4 ">
          <!-- {{errors}} -->
          <div>
            <div class="form-control w-full">
              <label class="label">Nombre*</label>
              <VeeField name="equipo.name" v-model="formulario.name" placeholder="Frenometro"
                :class="`input w-full ${errors['equipo.name'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="equipo.name" class="text-error mx-2 text-sm " />
          </div>

          <div>
            <div class="form-control w-full">
              <label class="label">Fabricante*</label>
              <VeeField name="equipo.fabricante" v-model="formulario.fabricante" placeholder="Caterpillar"
                :class="`input  w-full ${errors['equipo.fabricante'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="equipo.fabricante" class="text-error mx-2 text-sm " />
          </div>

          <div>
            <div class="form-control w-full">
              <label class="label">Modelo*</label>
              <VeeField name="equipo.modelo" v-model="formulario.modelo" placeholder="2013"
                :class="`input  w-full ${errors['equipo.modelo'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="equipo.modelo" class="text-error mx-2 text-sm " />
          </div>

          <div>
            <div class="form-control w-full">
              <label class="label">Marca*</label>
              <VeeField name="equipo.marca" v-model="formulario.marca" placeholder="Caterpillar"
                :class="`input w-full ${errors['equipo.marca'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="equipo.marca" class="text-error mx-2 text-sm " />
          </div>

          <div>
            <div class="form-control w-full">
              <label class="label">Serial*</label>
              <VeeField name="equipo.serie_lote" v-model="formulario.serie_lote" placeholder="ABC123"
                :class="`input  w-full ${errors['equipo.serie_lote'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="equipo.serie_lote" class="text-error mx-2 text-sm" />
          </div>

          <div>
            <div class="form-control w-full ">
              <label class="label">Activo Fijo*</label>
              <VeeField name="equipo.activo_fijo" v-model="formulario.activo_fijo" placeholder="Maquinaria y equipo"
                :class="`input  w-full ${errors['equipo.activo_fijo'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="equipo.activo_fijo" class="text-error mx-2 text-sm" />
          </div>


          <div class="form-control w-full ">
            <label class="label">Ubicación*</label>
            <VeeField name="equipo.ubicacion" v-model="formulario.ubicacion" placeholder="Linea 1"
              :class="`input  w-full ${errors['equipo.ubicacion'] ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="equipo.ubicacion" class="text-error mx-2 text-sm" />
          </div>

          <div class="form-control w-full ">
            <label class="label">Ficha Tecnica*</label>
            <VeeField name="equipo.ficha_tecnica" v-model="formulario.ficha_tecnica" placeholder="Equipo"
              :class="`input  w-full ${errors['equipo.ficha_tecnica'] ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="equipo.ficha_tecnica" class="text-error mx-2 text-sm" />
          </div>

          <div class="form-control w-full ">
            <label class="label">Manual*</label>
            <VeeField name="equipo.manual" v-model="formulario.manual" placeholder="N.A."
              :class="`input  w-full ${errors['equipo.manual'] ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="equipo.manual" class="text-error mx-2 text-sm" />
          </div>

          <div>
            <div class="form-control w-full ">
              <label class="label">Garantia*</label>
              <VeeField name="equipo.garantia" v-model="formulario.garantia" placeholder="12 meses"
                :class="`input  w-full ${errors['equipo.garantia'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="equipo.garantia" class="text-error mx-2 text-sm" />
          </div>

          <div>
            <div class="form-control w-full ">
              <label class="label">Instr. de Operación*</label>
              <VeeField name="equipo.instruc_operacion" v-model="formulario.instruc_operacion"
                placeholder="Según el fabricante"
                :class="`input  w-full ${errors['equipo.instruc_operacion'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="equipo.instruc_operacion" class="text-error mx-2 text-sm" />
          </div>

          <div>
            <div class="form-control w-full ">
              <label class="label">Tiempo de Calibración*</label>
              <VeeField name="equipo.periodicidad_calibracion" v-model="formulario.periodicidad_calibracion"
                placeholder="ver manual de operaciones"
                :class="`input  w-full ${errors['equipo.periodicidad_calibracion'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="equipo.periodicidad_calibracion" class="text-error mx-2 text-sm" />
          </div>

          <div>
            <div class="form-control w-full ">
              <label class="label">Periodicidad de Verificación*</label>
              <VeeField name="equipo.periodicidad_verificacion" v-model="formulario.periodicidad_verificacion"
                placeholder="Ver manual de operaciones"
                :class="`input  w-full ${errors['equipo.periodicidad_verificacion'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="equipo.periodicidad_verificacion" class="text-error mx-2 text-sm" />
          </div>

          <div>
            <div class="form-control w-full ">
              <label class="label">Nombre Proveedor de venta*</label>
              <VeeField name="equipo.proveedor" v-model="formulario.proveedor" placeholder="Proveedor"
                :class="`input  w-full ${errors['equipo.proveedor'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="equipo.proveedor" class="text-error mx-2 text-sm" />
          </div>

          <div>
            <div class="form-control w-full ">
              <label class="label">Telefono Contacto del Proveedor*</label>
              <VeeField name="equipo.contacto_proveedor" v-model="formulario.contacto_proveedor"
                placeholder="+573101234567"
                :class="`input  w-full ${errors['equipo.contacto_proveedor'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="equipo.contacto_proveedor" class="text-error mx-2 text-sm" />
          </div>

          <div>
            <div class="form-control w-full ">
              <label class="label">Correo Electronico del Proveedor*</label>
              <VeeField name="equipo.email_proveedor" v-model="formulario.email_proveedor" placeholder="test@prueba.com"
                :class="`input  w-full ${errors['equipo.email_proveedor'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="equipo.email_proveedor" class="text-error mx-2 text-sm" />
          </div>
        </div>
      </div>

      <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Fotografias*"
        :checked="isTabActive == '2'" @click="isTabActive = '2'" />
      <div role="tabpanel" class="tab-content bg-base-100 border-base-200 rounded-box  p-5">
        <input type="file" accept="image/*" ref="inputFile" class="file-input file-input-bordered mb-2 w-full"
          name="resource" @change="handleFileChange" />
        <div class="w-full">
          <div  class="card  border-dashed border-2  border-indigo-600 max-w-lg p-2">
            <figure>
              <img class="" :src="itemPhoto ?? '/images/defaultimage.webp'" alt="Imagen del articulo " />
            </figure>
          </div>
        </div>
      </div>

      <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Caracteristicas"
        :checked="isTabActive == '3'" @click="isTabActive = '3'" />
      <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 lg:grid-cols-2 gap-2 md:gap-2 lg:gap-2 ">
          <div>
            <div class="form-control w-full">
              <label class="label">Resolución</label>
              <VeeField name="caracteristica.resolucion" v-model="formulario.resolucion" placeholder="ABC123"
                :class="`input  w-full ${errors['caracteristica.resolucion'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="caracteristica.resolucion" class="text-error mx-2 text-sm" />
          </div>
          <div>
            <div class="form-control w-full">
              <label class="label">Clase de exactitud</label>
              <VeeField name="caracteristica.clase_exactitud" v-model="formulario.clase_exactitud"
                placeholder="Aplicación"
                :class="`input  w-full ${errors['caracteristica.clase_exactitud'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="caracteristica.clase_exactitud" class="text-error mx-2 text-sm" />
          </div>
          <div>
            <div class="form-control w-full">
              <label class="label">Rango(s) de medición</label>
              <VeeField name="caracteristica.rango_medicion" v-model="formulario.rango_medicion"
                placeholder="Aplicación"
                :class="`input  w-full ${errors['caracteristica.rango_medicion'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="caracteristica.rango_medicion" class="text-error mx-2 text-sm" />

          </div>
          <div>
            <div class="form-control w-full">
              <label class="label">Intervalo(s) de medición</label>
              <VeeField name="caracteristica.intervalo_medicion" v-model="formulario.intervalo_medicion"
                placeholder="Aplicación"
                :class="`input  w-full ${errors['caracteristica.intervalo_medicion'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="caracteristica.intervalo_medicion" class="text-error mx-2 text-sm" />
          </div>
          <div>
            <div class="form-control w-full">
              <label class="label">Error máximo permitido</label>
              <VeeField name="caracteristica.error_maximo_permitido" v-model="formulario.error_maximo_permitido"
                placeholder="Aplicación"
                :class="`input  w-full ${errors['caracteristica.error_maximo_permitido'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="caracteristica.error_maximo_permitido" class="text-error mx-2 text-sm" />
          </div>
        </div>
      </div>

      <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Adquisición*"
        :checked="isTabActive == '4'" @click="isTabActive = '4'" />
      <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 lg:grid-cols-2 gap-2 md:gap-2 lg:gap-2 ">
          <div>
            <div>
              <label class="label">Fecha de Compra*</label>
              <VeeField name="adquisicion.fecha_adquisicion" type="date" v-model="formulario.fecha_adquisicion"
                placeholder="01/01/2023"
                :class="`input  w-full ${errors['adquisicion.fecha_adquisicion'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="adquisicion.fecha_adquisicion" class="text-error mx-2 text-sm" />
          </div>
          <div>
            <div>
              <label class="label">Precio de Compra*</label>
              <VeeField name="adquisicion.valor_adquisicion" v-model="formulario.valor_adquisicion" placeholder="0"
                :class="`input  w-full ${errors['adquisicion.valor_adquisicion'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="adquisicion.valor_adquisicion" class="text-error mx-2 text-sm" />
          </div>
          <div>
            <div>
              <label class="label">Telefono Proovedor</label>
              <input name="email_proveedor" v-model="formulario.contacto_proveedor"
                placeholder="Telefono Proporcionado por el proovedor" class="input  w-full" disabled />
            </div>
            <VeeErrorMessage name="adquisicion.telefono_proveedor" class="text-error mx-2 text-sm" />
          </div>
          <div>
            <div>
              <label class="label">Correo Electronico Proovedor</label>
              <input name="email_proveedor" v-model="formulario.email_proveedor"
                placeholder="Correo Proporcionado por el proovedor" class="input  w-full" disabled />
            </div>
          </div>
        </div>
      </div>

      <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Calibración*"
        :checked="isTabActive == '5'" @click="isTabActive = '5'" />
      <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-2 md:gap-2 lg:gap-2 ">

          <div>
            <div>
              <label class="label">Fecha de calibración actual</label>
              <VeeField name="calibracion.fecha_calibracion_actual" type="date"
                v-model="formulario.fecha_calibracion_actual"
                :class="`input  w-full ${errors['calibracion.fecha_calibracion_actual'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="calibracion.fecha_calibracion_actual" class="text-error mx-2 text-sm" />
          </div>
          <div>
            <div>
              <label class="label">Fecha próxima a calibrar</label>
              <VeeField name="calibracion.fecha_proxima_calibracion" type="date"
                v-model="formulario.fecha_proxima_calibracion"
                :class="`input  w-full ${errors['calibracion.fecha_proxima_calibracion'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="calibracion.fecha_proxima_calibracion" class="text-error mx-2 text-sm" />
          </div>
          <div>
            <div>
              <label class="label">Max. incertidumbre/calibración</label>
              <VeeField name="calibracion.maxima_incertidumbre_calibracion"
                v-model="formulario.maxima_incertidumbre_calibracion" placeholder="0.1"
                :class="`input  w-full ${errors['calibracion.maxima_incertidumbre_calibracion'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="calibracion.maxima_incertidumbre_calibracion" class="text-error mx-2 text-sm" />
          </div>
          <div>
            <div>
              <label class="label">Proveedor de calibración</label>
              <VeeField name="calibracion.proveedor_calibracion" v-model="formulario.proveedor_calibracion"
                placeholder="Empresa de Calibración"
                :class="`input  w-full ${errors['calibracion.proveedor_calibracion'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="calibracion.proveedor_calibracion" class="text-error mx-2 text-sm" />
          </div>
          <div>
            <div>
              <label class="label">Telefono del Calibrador</label>
              <VeeField name="calibracion.contacto_calibracion" v-model="formulario.contacto_calibracion"
                placeholder=" +573101234567"
                :class="`input  w-full ${errors['calibracion.contacto_calibracion'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="calibracion.contacto_calibracion" class="text-error mx-2 text-sm" />
          </div>
          <div>
            <div>
              <label class="label">Correo Electronico del Calibrador</label>
              <VeeField name="calibracion.email_calibracion" v-model="formulario.email_calibracion"
                placeholder=" example@gmail.com"
                :class="`input  w-full ${errors['calibracion.email_calibracion'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="calibracion.email_calibracion" class="text-error mx-2 text-sm" />
          </div>
          <div>
            <div>
              <label class="label">Frecuencia de Verificación*</label>
              <VeeField name="calibracion.frecuencia_verificacion" v-model="formulario.frecuencia_verificacion"
                placeholder="tiempo en meses"
                :class="`input  w-full ${errors['calibracion.frecuencia_verificacion'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="calibracion.frecuencia_verificacion" class="text-error mx-2 text-sm" />
          </div>
          <div>
            <div>
              <label class="label">Procedimiento de Verificación*</label>
              <VeeField name="calibracion.procedimiento_verificacion" v-model="formulario.procedimiento_verificacion"
                placeholder="MANTENIMIENTO"
                :class="`input  w-full ${errors['calibracion.procedimiento_verificacion'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="calibracion.procedimiento_verificacion" class="text-error mx-2 text-sm" />
          </div>
          <div>
            <div>
              <label class="label">Frecuencia de Calibración*</label>
              <VeeField name="calibracion.frecuencia_calibracion" v-model="formulario.frecuencia_calibracion"
                placeholder="Tiempo en meses"
                :class="`input  w-full ${errors['calibracion.frecuencia_calibracion'] ? 'input-error' : 'input-bordered'}`" />
            </div>
            <VeeErrorMessage name="calibracion.frecuencia_calibracion" class="text-error mx-2 text-sm" />
          </div>
        </div>
      </div>

      <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Componentes"
        :checked="isTabActive == '6'" @click="isTabActive = '6'" />
      <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
        <div class="overflow-x-auto">
          <div class="flex justify-end mb-2">
            <button type="button" class="  btn btn-sm btn-neutral rounded-full" @click="addComponent">Agregar +</button>
          </div>
          <table class="table table-zebra table-sm">
            <thead>
              <tr>
                <th>Serial</th>
                <th>Nombre*</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Cantidad*</th>
                <th>Unidad</th>
                <th>Cuidados</th>
                <th>Quitar</th>
              </tr>
            </thead>
            <tbody class="">
              <tr v-for="(x, index) in formulario.componentes.length">
                <td>
                  <VeeField :name="`componentes[${index}].serial`" v-model="formulario.componentes[index].serial"
                    placeholder="Serial"
                    :class="`input input-sm w-full ${errors[`componentes[${index}].serial`] ? 'input-error' : 'input-bordered'}`" />
                  <VeeErrorMessage :name="`componentes[${index}].serial`" class="text-error mx-2 text-sm" />
                </td>
                <td>
                  <VeeField :name="`componentes[${index}].nombre`" v-model="formulario.componentes[index].nombre"
                    placeholder="Nombre*"
                    :class="`input input-sm  w-full ${errors[`componentes[${index}].nombre`] ? 'input-error' : 'input-bordered'}`" />
                  <VeeErrorMessage :name="`componentes[${index}].nombre`" class="text-error mx-2 text-sm" />
                </td>
                <td>
                  <VeeField :name="`componentes[${index}].marca`" v-model="formulario.componentes[index].marca"
                    placeholder="Marca"
                    :class="`input input-sm  w-full ${errors[`componentes[${index}].marca`] ? 'input-error' : 'input-bordered'}`" />
                  <VeeErrorMessage :name="`componentes[${index}].marca`" class="text-error mx-2 text-sm" />
                </td>
                <td>
                  <VeeField :name="`componentes[${index}].modelo`" v-model="formulario.componentes[index].modelo"
                    placeholder="Modelo"
                    :class="`input input-sm  w-full ${errors[`componentes[${index}].modelo`] ? 'input-error' : 'input-bordered'}`" />
                  <VeeErrorMessage :name="`componentes[${index}].modelo`" class="text-error mx-2 text-sm" />
                </td>
                <td>
                  <VeeField :name="`componentes[${index}].cantidad`" v-model="formulario.componentes[index].cantidad"
                    placeholder="Cantidad*"
                    :class="`input input-sm  w-full ${errors[`componentes[${index}].cantidad`] ? 'input-error' : 'input-bordered'}`" />
                  <VeeErrorMessage :name="`componentes[${index}].cantidad`" class="text-error mx-2 text-sm" />
                </td>
                <td>
                  <VeeField :name="`componentes[${index}].unidad`" v-model="formulario.componentes[index].unidad"
                    placeholder="Unidad"
                    :class="`input input-sm  w-full ${errors[`componentes[${index}].unidad`] ? 'input-error' : 'input-bordered'}`" />
                  <VeeErrorMessage :name="`componentes[${index}].unidad`" class="text-error mx-2 text-sm" />
                </td>
                <td>
                  <VeeField :name="`componentes[${index}].cuidados`" v-model="formulario.componentes[index].cuidados"
                    placeholder="Cuidados"
                    :class="`input input-sm  w-full ${errors[`componentes[${index}].cuidados`] ? 'input-error' : 'input-bordered'}`" />
                  <VeeErrorMessage :name="`componentes[${index}].cuidados`" class="text-error mx-2 text-sm" />
                </td>
                <td><button type="button" class="btn btn-sm btn-neutral rounded-full"
                    :disabled="formulario.componentes.length <= 1" @click="deleteComponent(index)">-</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Condiciones" :checked="isTabActive == '7'"
        @click="isTabActive = '7'" />
      <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-4 md:gap-4 lg:gap-4 ">
          <div>
            <label class="label">
              <span class="block text-sm">Condición Eléctrica </span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_electrica" v-model="formulario.cond_electrica"
                class="checkbox checkbox-sm" />
              <label for="cond_electrica" class="ml-2">{{ formulario.cond_electrica == true ? 'Aplicado' :
                'No Aplicado' }}</label>
            </div>
          </div>
          <div class="form-control w-full">
            <label class="label">
              <span class="block text-sm ">Condición Mecánica</span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_mecanica" v-model="formulario.cond_mecanica"
                class="checkbox checkbox-sm" />
              <label for="cond_mecanica" class="ml-2">
                {{ formulario.cond_mecanica == true ? 'Aplicado' :
                  'No Aplicado' }}
              </label>
            </div>
          </div>
          <div class="form-control w-full">
            <label class="label">
              <span class="block text-sm">Condición de Seguridad </span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_seguridad" v-model="formulario.cond_seguridad"
                class="checkbox checkbox-sm" />
              <label for="cond_seguridad" class="ml-2"> {{ formulario.cond_seguridad == true ? 'Aplicado' :
                'No Aplicado' }}</label>
            </div>
          </div>
          <div class="form-control w-full">
            <label class="label">
              <span class="block text-sm">Condiciones Ambientales </span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_ambientales" v-model="formulario.cond_ambientales"
                class="checkbox checkbox-sm" />
              <label for="cond_ambientales" class="ml-2"> {{ formulario.cond_ambientales == true ? 'Aplicado' :
                'No Aplicado' }}</label>
            </div>
          </div>
          <div class="form-control w-full">
            <label class="label">
              <span class="block text-sm">Condiciones de Transporte </span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_transporte" v-model="formulario.cond_transporte"
                class="checkbox checkbox-sm" />
              <label for="cond_transporte" class="ml-2"> {{ formulario.cond_transporte == true ? 'Aplicado' :
                'No Aplicado' }}</label>
            </div>
          </div>
          <div class="form-control w-full">
            <label class="label">
              <span class="block text-sm">Otras Condiciones </span>
            </label>
            <div class="flex items-center">
              <input type="checkbox" id="cond_otras" v-model="formulario.cond_otras" class="checkbox checkbox-sm" />
              <label for="cond_otras" class="ml-2"> {{ formulario.cond_otras == true ? 'Aplicado' :
                'No Aplicado' }}</label>
            </div>
          </div>
        </div>
      </div>

    </div>
    <ButtonOptions @cancel="handleCancel" />
  </VeeForm>
</template>


<script lang="ts" setup>
import { EquipoEntityClass, type EquipoEntity } from '~/Domain/Models/Entities/equipo';
import { INDEX_PAGE_INVENTARIO } from '~/Infrastructure/Paths/Paths';
const handleCancel = () => router.push(INDEX_PAGE_INVENTARIO);
const isTabActive: Ref<string> = ref('1');
const { $swal } = useNuxtApp()
const router = useRouter();
const imageModal = ref();

const emits = defineEmits<{
  (event: 'callback', payload: EquipoEntity): void
}>();

const addComponent = () => {
  formulario.value.componentes.push({
    serial: '',
    cantidad: '',
    cuidados: '',
    marca: '',
    modelo: '',
    nombre: '',
    unidad: ''
  })
}
const deleteComponent = (index: number) => {
  if (formulario.value.componentes.length > 1) {
    formulario.value.componentes.splice(index, 1);
  }
}

const inputFile = ref();
const { setImagen } = useImagen();
const itemPhoto = ref();
const isModalOpen = ref(false);

function openModal(valor: boolean) {
  isModalOpen.value = valor;
}

const formulario: Ref<EquipoEntity> = ref(new EquipoEntityClass(null));

const formularioEquipoSchema = yup.object({
  equipo: yup.object().shape({
    name: yup.string().required('Este campo es requerido*'),
    fabricante: yup.string().required('Este campo es requerido*'),
    modelo: yup.string().required('Este campo es requerido*'),
    marca: yup.string().required('Este campo es requerido*'),
    serie_lote: yup.string().required('Este campo es requerido*'),
    activo_fijo: yup.string().required('Este campo es requerido*'),
    ubicacion: yup.string().required('Este campo es requerido*'),
    ficha_tecnica: yup.string().required('Este campo es requerido*'),
    manual: yup.string().required('Este campo es requerido*'),
    garantia: yup.string().required('Este campo es requerido*'),
    instruc_operacion: yup.string().required('Este campo es requerido*'),
    periodicidad_calibracion: yup.string().required('Este campo es requerido*'),
    periodicidad_verificacion: yup.string().required('Este campo es requerido*'),
    proveedor: yup.string().required('Este campo es requerido*'),
    contacto_proveedor: yup.string().required('Este campo es requerido*').matches(/^\d+$/, 'Solo se permiten números'),
    email_proveedor: yup.string().required('Este campo es requerido*').email(),
  }),
  caracteristica: yup.object().shape({
    resolucion: yup.string().nullable(),
    clase_exactitud: yup.string().nullable(),
    rango_medicion: yup.string().nullable(),
    intervalo_medicion: yup.string().nullable(),
    error_maximo_permitido: yup.string().nullable(),
  }),
  adquisicion: yup.object().shape({
    fecha_adquisicion: yup.string()
      .required('Este campo es requerido*')
      .matches(
        /^\d{4}-\d{2}-\d{2}$/,
        'Debe ser una fecha en formato YYYY-MM-DD'
      ),
    valor_adquisicion: yup
      .string()
      .required('Este campo es requerido* ')
      .matches(/^\d+$/, 'Solo se permiten números'),
  }),
  numero_factura: yup.string().nullable().matches(/^\d+$/, 'Solo se permiten números'),
  calibracion: yup.object().shape({
    frecuencia_verificacion: yup.string().required('Este campo es requerido*'),
    procedimiento_verificacion: yup.string().required('Este campo es requerido*'),
    frecuencia_calibracion: yup.string().required('Este campo es requerido*'),
    fecha_calibracion_actual: yup.string()
      .nullable()
      .matches(
        /^\d{4}-\d{2}-\d{2}$/,
        'Debe ser una fecha en formato DD-MM-YYYY'
      ),
    fecha_proxima_calibracion: yup.string()
      .nullable()
      .matches(
        /^\d{4}-\d{2}-\d{2}$/,
        'Debe ser una fecha en formato DD-MM-YYYY'
      ),
    maxima_incertidumbre_calibracion: yup.string().nullable(),
    proveedor_calibracion: yup.string().nullable(),
    contacto_calibracion: yup.string().nullable().matches(/^\d+$/, 'Solo se permiten números'),
    email_calibracion: yup.string().nullable().email(),
    telefono_calibracion: yup.string().nullable().matches(/^\d+$/, 'Solo se permiten números'),
  }),
  componentes: yup.array().of(
    yup.object({
      serial: yup.string().nullable(),
      nombre: yup.string()
        .nullable()
        .when('$anyFieldFilled', {
          is: true,
          then: schema => schema.required('El nombre es requerido*'),
        }),
      marca: yup.string().nullable(),
      modelo: yup.string().nullable(),
      cantidad: yup.string()
        .nullable()
        .matches(/^\d+$/, 'La cantidad solo puede contener números*')
        .test('no-cero', 'La Cantidad no puede ser 0*', value => !value || value !== '0')
        .when('$anyFieldFilled', {
          is: true,
          then: schema => schema.required('La Cantidad es requerida*'),
        }),
      unidad: yup.string().nullable(),
      cuidados: yup.string().nullable(),
    })
  ).test('at-least-one-field', 'Debe haber al menos un campo con datos si alguno está lleno', function (array) {
    return array?.every(obj =>
      Object.values(obj).every(value => value === null || value === undefined || value === '') ||
      (obj.nombre && obj.cantidad)
    );
  })

});

const handleFileChange = (event: Event) => {
  const reader = new FileReader();
  const file = (event.target as HTMLInputElement).files?.[0];

  if (file) {
    itemPhoto.value = URL.createObjectURL(file);
    // setImagen(file, itemPhoto);
    // setImagen(file, imageModal);
    formulario.value.resource = file;
  }
};


const onSubmit = (values: any) => {
  if (!formulario.value.resource) {
    $swal.fire({
      icon: 'info',
      title: "Falta recurso imagen",
      text: "Hubo un error por favor incluya la imagen.",
      showCancelButton: false,
      confirmButtonText: 'Aceptar',
      reverseButtons: true
    });

    isTabActive.value = '2';
    return;
  }

  const form = formulario.value;

  return emits("callback", form);
}
function containsComponent(data: Record<string, unknown>, term: string): boolean {
  const regex = new RegExp(`^${term}\\[\\d+\\]`);
  return Object.keys(data).some(key => regex.test(key));
}

function containsTerm(data: Record<string, unknown>, term: string): boolean {
  return Object.keys(data).some(key => key.includes(term));
}

const tabMapping: Record<string, string> = {
  equipo: '1',
  fotografias: '2',
  caracteristica: '3',
  adquisicion: '4',
  calibracion: '5',
  componentes: '6',
  condiciones: '7',
};

const invalidSubmit = (values: any) => {
  for (const [key, tab] of Object.entries(tabMapping)) {

    if (containsTerm(values.errors, key) || containsComponent(values.errors, key)) {
      isTabActive.value = tab;
      $swal.fire({
        icon: 'info',
        title: "Campos no diligenciados",
        text: "Rellene todos los campos obligatorios.",
        showCancelButton: false,
        confirmButtonText: 'Aceptar',
        reverseButtons: true
      });
      return;
    }
  }
}

</script>
