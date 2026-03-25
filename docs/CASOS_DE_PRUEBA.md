# TECH SOLUTIONS SAS
## DOCUMENTACIÓN DE CASOS DE PRUEBA

---

## MÓDULO COLABORADORES

---

## TEST 1
### 1. Informacion general
- **ID del caso de prueba:** CP-COL-001
- **Titulo de la prueba:** Crear un nuevo colaborador 
- **Módulo / Característica:** Colaboradores / Creación 

### 2. Descripción
Esta prueba verifica que se pueda crear un nuevo colaborador exitosamente

### 3. Precondiciones
- El usuario debe estar registrado y autenticado
- El número de documento no debe existir previamente

### 4. Pasos para la Ejecución
1. Usuario autenticado con rol "Gestor RRHH"
2. El usuario debe dirigirse a la sección Colaboradores
3. El usuario debe crear colaborador

### 5. Datos de entrada
- **Nombre:** Carlos
- **Apellidos:** Díaz
- **Tipo de documento:** CC
- **Número de documento:** 1193377447
- **Fecha de nacimiento:** 15/05/2000
- **Email:** carlos.diaz@email.com
- **Número de celular:** 3015840445
- **Dirección:** Cra 3 # 17A - 33

### 6. Resultado esperado
El sistema debe crear exitosamente un nuevo registro en la tabla collaborators

### 7. Resultado Real
(Para ser completado durante la ejecución)

### 8. Estado 
- (Pasa / Falla)

---

## TEST 2
### 1. Informacion general
- **ID del caso de prueba:** CP-COL-002
- **Titulo de la prueba:** Rechazar creación con documento duplicado
- **Módulo / Característica:** Colaboradores / Validación de datos únicos

### 2. Descripción
Esta prueba verifica que el sistema rechace la creación de un colaborador cuando el número de documento ya existe

### 3. Precondiciones
- El usuario debe estar registrado y autenticado
- El número de documento ya debe existir en la tabla collaborators

### 4. Pasos para la Ejecución
1. El usuario debe iniciar sesión
2. El usuario debe intentar crear un colaborador con documento ya existente

### 5. Datos de entrada
- **Nombre:** Carlos
- **Apellidos:** Díaz 
- **Tipo de documento:** CC
- **Número de documento:** 1193377447 (DUPLICADO)
- **Fecha de nacimiento:** 15/05/2000
- **Email:** otro.email@email.com
- **Número de celular:** 3015840445
- **Dirección:** Cra 3 # 17A - 33

### 6. Resultado esperado
El sistema debe rechazar la creación y mostrar error de validación por documento duplicado

### 7. Resultado Real
(Para ser completado durante la ejecución)

### 8. Estado 
- (Pasa / Falla)

---

## TEST 3
### 1. Informacion general
- **ID del caso de prueba:** CP-COL-003
- **Titulo de la prueba:** Actualizar un colaborador existente
- **Módulo / Característica:** Colaboradores / Actualización

### 2. Descripción
Esta prueba verifica que el usuario pueda actualizar la información de un colaborador existente

### 3. Precondiciones
- El usuario debe estar registrado y autenticado
- Debe existir al menos un colaborador en la base de datos

### 4. Pasos para la Ejecución
1. El usuario debe iniciar sesión
2. El usuario debe dirigirse a la edición de un colaborador
3. El usuario debe actualizar los datos

### 5. Datos de entrada (actualizados)
- **Nombre:** Carlos Alberto
- **Apellidos:** Díaz Sanchez
- **Tipo de documento:** CC
- **Número de documento:** 1193377447
- **Fecha de nacimiento:** 15/05/2000
- **Email:** carlos.alberto@email.com
- **Número de celular:** 3015840000
- **Dirección:** Cra 22 # 15 - 64

### 6. Resultado esperado
El sistema debe actualizar la información del colaborador en la base de datos

### 7. Resultado Real
(Para ser completado durante la ejecución)

### 8. Estado 
- (Pasa / Falla)

---

## TEST 4
### 1. Informacion general
- **ID del caso de prueba:** CP-COL-004
- **Titulo de la prueba:** Obtener listado de colaboradores 
- **Módulo / Característica:** Colaboradores / Listar todos los colaboradores

### 2. Descripción
Esta prueba verifica que el usuario pueda listar todos los colaboradores existentes

### 3. Precondiciones
- El usuario debe estar registrado y autenticado
- Debe existir al menos un colaborador en la base de datos

### 4. Pasos para la Ejecución
1. El usuario debe iniciar sesión
2. El usuario debe dirigirse a la sección Colaboradores
3. El sistema debe mostrar la lista de colaboradores

### 5. Resultado esperado
El sistema debe mostrar una lista de todos los colaboradores registrados

### 6. Resultado Real
(Para ser completado durante la ejecución)

### 7. Estado 
- (Pasa / Falla)

---

## TEST 5
### 1. Informacion general
- **ID del caso de prueba:** CP-COL-005
- **Titulo de la prueba:** Eliminar (soft delete) un colaborador 
- **Módulo / Característica:** Colaboradores / Eliminación de colaborador

### 2. Descripción
Esta prueba verifica que se pueda eliminar (soft delete) un colaborador, marcándolo como eliminado sin borrarlo físicamente

### 3. Precondiciones
- El usuario debe estar registrado y autenticado
- Debe existir al menos un colaborador en la base de datos

### 4. Pasos para la Ejecución
1. El usuario debe iniciar sesión
2. El usuario debe eliminar un colaborador existente

### 5. Resultado esperado
- El registro NO se elimina físicamente de la tabla
- El campo deleted_at se actualiza con la fecha actual
- El registro persiste en la base de datos pero marcado como eliminado

### 6. Resultado Real
(Para ser completado durante la ejecución)

### 7. Estado 
- (Pasa / Falla)

---

## MÓDULO CONTRATOS

---

## TEST 1
### 1. Informacion general
- **ID del caso de prueba:** CP-CON-001
- **Titulo de la prueba:** Crear contrato asociado a colaborador existente
- **Módulo / Característica:** Contratos / Creación de contratos

### 2. Descripción
Esta prueba verifica que se pueda crear un contrato y asociarlo a un colaborador existente

### 3. Precondiciones
- El usuario debe estar registrado y autenticado
- Debe existir al menos un colaborador en la base de datos

### 4. Pasos para la Ejecución
1. El usuario debe iniciar sesión
2. El usuario debe crear un nuevo contrato

### 5. Datos de entrada
- **ID del colaborador:** 1
- **Tipo de contrato:** Fijo
- **Fecha de inicio:** 01/03/2026
- **Fecha de fin:** 01/03/2027
- **Cargo:** Desarrollador de Software
- **Salario:** 3500000
- **Estado:** Activo

### 6. Resultado esperado
El sistema debe crear un nuevo registro en la tabla contracts asociado al colaborador

### 7. Resultado Real
(Para ser completado durante la ejecución)

### 8. Estado 
- (Pasa / Falla)

---

## TEST 2
### 1. Informacion general
- **ID del caso de prueba:** CP-CON-002
- **Titulo de la prueba:** Rechazar contrato para colaborador inexistente
- **Módulo / Característica:** Contratos / Validación de integridad referencial

### 2. Descripción
Esta prueba verifica que el sistema rechace crear un contrato para un colaborador que no existe

### 3. Precondiciones
- El usuario debe estar registrado y autenticado
- El ID del colaborador no debe existir

### 4. Pasos para la Ejecución
1. El usuario debe iniciar sesión
2. El usuario debe intentar crear un contrato con colaborador inexistente

### 5. Datos de entrada
- **ID del colaborador:** 999 (INEXISTENTE)
- **Tipo de contrato:** Fijo
- **Fecha de inicio:** 01/03/2026
- **Fecha de fin:** 01/03/2027
- **Cargo:** Desarrollador
- **Salario:** 3500000
- **Estado:** Activo

### 6. Resultado esperado
El sistema debe rechazar la creación con error de validación

### 7. Resultado Real
(Para ser completado durante la ejecución)

### 8. Estado 
- (Pasa / Falla)

---

## TEST 3
### 1. Informacion general
- **ID del caso de prueba:** CP-CON-003
- **Titulo de la prueba:** Validar fechas y salario correctamente
- **Módulo / Característica:** Contratos / Validaciones de negocio

### 2. Descripción
Esta prueba verifica que el sistema valide que la fecha de fin sea posterior a la fecha de inicio y que el salario sea un valor positivo

### 3. Precondiciones
- El usuario debe estar registrado y autenticado
- Debe existir al menos un colaborador

### 4. Pasos para la Ejecución
1. El usuario debe iniciar sesión
2. El usuario debe intentar crear contrato con datos inválidos

### 5. Datos de entrada
- **ID del colaborador:** 1
- **Tipo de contrato:** Fijo
- **Fecha de inicio:** 01/03/2027
- **Fecha de fin:** 01/03/2026 (ERROR: menor)
- **Cargo:** Desarrollador
- **Salario:** -500000 (ERROR: negativo)
- **Estado:** Activo

### 6. Resultado esperado
El sistema debe rechazar con errores en fecha y salario

### 7. Resultado Real
(Para ser completado durante la ejecución)

### 8. Estado 
- (Pasa / Falla)

---

## TEST 4
### 1. Informacion general
- **ID del caso de prueba:** CP-CON-004
- **Titulo de la prueba:** Actualizar contrato existente
- **Módulo / Característica:** Contratos / Actualización

### 2. Descripción
Esta prueba verifica que se pueda actualizar un contrato existente

### 3. Precondiciones
- El usuario debe estar registrado y autenticado
- El contrato debe estar asociado a un colaborador existente

### 4. Pasos para la Ejecución
1. Usuario inicia sesión
2. Usuario actualiza contrato

### 5. Datos de entrada (actualizados)
- **ID del colaborador:** 1
- **Tipo contrato:** Indefinido
- **Fecha de inicio:** 01/03/2026
- **Fecha fin:** null
- **Cargo:** Desarrollador Senior
- **Salario:** 4800000
- **Estado:** Activo

### 6. Resultado esperado
Contrato actualizado correctamente

### 7. Resultado Real
(Para ser completado durante la ejecución)

### 8. Estado 
- (Pasa / Falla)

---

## MÓDULO PRÓRROGAS

---

## TEST 1
### 1. Informacion general
- **ID del caso de prueba:** CP-EXT-001
- **Titulo de la prueba:** Añadir prórroga de tiempo o valor a contrato
- **Módulo / Característica:** Prórrogas / Creación de extensiones

### 2. Descripción
Esta prueba verifica que se pueda añadir una prórroga (de tiempo o valor) a un contrato de tipo "Fijo" o "Prestación de Servicios"

### 3. Precondiciones
- El usuario debe estar registrado y autenticado
- Debe existir un contrato activo de tipo "Fijo"
- Debe existir un contrato activo de tipo "Prestación de Servicios"
- Los contratos no deben estar terminados o finalizados

### 4. Pasos para la Ejecución
1. Usuario inicia sesión
2. Usuario añade prórroga de tiempo
3. Usuario añade prórroga de valor

### 5. Datos de entrada
##### Prórroga de Tiempo
- **ID contrato:** 1
- **Tipo de prórroga:** Tiempo
- **Nueva fecha fin:** 01/03/2028
- **Valor adicional:** (null)
- **Descripción:** Prórroga por 1 año adicional

##### Prórroga de valor
- **ID contrato:** 2
- **Tipo de prórroga:** valor
- **Nueva fecha fin:** (null)
- **Valor adicional:** (2000000)
- **Descripción:** Adición presupuestal por nuevos alcances

### 6. Resultado esperado
- El sistema debe crear registros en la tabla contract_extensions para ambos contratos
- La fecha de fin del contrato ID = 1 debe actualizarse a 01/03/2028
- La fecha de fin del contrato ID = 2 NO debe modificarse

### 7. Resultado Real
(Para ser completado durante la ejecución)

### 8. Estado 
- (Pasa / Falla)

---

## TEST 2
### 1. Informacion general
- **ID del caso de prueba:** CP-EXT-002
- **Titulo de la prueba:** Actualizar fecha de finalización con prórroga de tiempo
- **Módulo / Característica:** Prórrogas / Actualización de fecha

### 2. Descripción
Esta prueba verifica que la fecha de finalización del contrato se actualiza correctamente al añadir una prórroga de tiempo

### 3. Precondiciones
- El usuario debe estar registrado y autenticado
- Debe existir un contrato activo de tipo "Fijo"
- La fecha de fin actual del contrato

### 4. Pasos para la Ejecución
1. Usuario inicia sesión
2. El usuario añade una prórroga de tiempo
3. El sistema debe actualizar la fecha de fin del contrato

### 5. Datos de entrada
- **ID contrato:** 1
- **Tipo:** Tiempo
- **Nueva fecha de fin:** 01/03/2028
- **Descripción:** Extensión por 1 año

### 6. Resultado esperado
- El sistema crea un registro en contract_extensions
- La fecha de fin del contrato
- El resto de datos del contrato permanecen igual

### 7. Resultado Real
(Para ser completado durante la ejecución)

### 8. Estado 
- (Pasa / Falla)

---

## TEST 3
### 1. Informacion general
- **ID del caso de prueba:** CP-EXT-003
- **Titulo de la prueba:** Rechazar prórroga para contrato terminado
- **Módulo / Característica:** Prórrogas / Validaciones

### 2. Descripción
Esta prueba verifica que el sistema rechace añadir una prórroga a un contrato con estado "Terminado" o "Finalizado"

### 3. Precondiciones
- El usuario debe estar registrado y autenticado
- Debe existir un contrato y un estado Terminado
- Debe existir un contrato y un estado Finalizado

### 4. Pasos para la Ejecución
1. Usuario inicia sesión
2. El usuario intenta añadir una prórroga al contrato terminado
3. El usuario intenta añadir una prórroga al contrato finalizado

### 5. Resultado esperado
- **ID del contrato:** 1 (Terminado)
- **Tipo de prórroga:** Tiempo
- **Nueva fecha de fin:** 01/03/2028
- **Descripción:** Intento de prórroga
- **ID del contrato:** 2 (Finalizado)
- **Tipo de prórroga:** Valor
- **Valor adicional:** 1000000
- **Descripción:** Intento de adición

### 6. Resultado Real
El sistema debe rechazar ambas solicitudes y no se pueden añadir prórrogas a contratos terminados o finalizados

### 7. Estado 
- (Pasa / Falla)

---

## MÓDULO TERMINACIONES

---

## TEST 1
### 1. Informacion general
- **ID del caso de prueba:** CP-TER-001
- **Titulo de la prueba:** Cambiar estado de contrato a "Terminado"
- **Módulo / Característica:** Terminaciones / Finalización anticipada

### 2. Descripción
Esta prueba verifica que se pueda cambiar el estado de un contrato activo a "Terminado" mediante una terminación anticipada

### 3. Precondiciones
- El usuario debe estar registrado y autenticado
- ebe existir un contrato activo
- El contrato debe tener fecha de fin posterior a la fecha actual

### 4. Pasos para la Ejecución
1. Usuario inicia sesión
2. El usuario registra una terminación anticipada
3. El sistema debe cambiar el estado del contrato

### 5. Datos de entrada
- **ID contrato:** 1
- **Fecha terminación:** 15/06/2026
- **Motivo:** Renuncia voluntaria del colaborador

### 6. Resultado esperado
- El sistema debe crear un registro en la tabla contract_terminations
- El estado del contrato debe cambiar de "Activo" a "Terminado"

### 7. Resultado Real
(Para ser completado durante la ejecución)

### 8. Estado 
- (Pasa / Falla)

---

## TEST 2
### 1. Informacion general
- **ID del caso de prueba:** CP-TER-002
- **Titulo de la prueba:** Registrar fecha y motivo de terminación correctamente
- **Módulo / Característica:** Terminaciones / Registro de información

### 2. Descripción
Esta prueba verifica que el sistema registre correctamente la fecha y el motivo al terminar un contrato anticipadamente

### 3. Precondiciones
- El usuario debe estar registrado y autenticado
- Debe existir un contrato activo 

### 4. Pasos para la Ejecución
1. Usuario autenticado e inicia sesión
2. El usuario registra una terminación con fecha y motivo específicos
3. El sistema debe guardar ambos datos correctamente

### 5. Datos de entrada
- **ID del contrato:** 1
- **Fecha de terminación:** 30/06/2026
- **Motivo:** Renuncia voluntaria del colaborador

### 6. Resultado esperado
- El sistema debe crear un registro en contract_terminations
- La fecha guardada debe ser exactamente 30/06/2026
- El motivo guardado debe ser exactamente "Renuncia voluntaria del colaborador"

### 7. Resultado Real
(Para ser completado durante la ejecución)

### 8. Estado 
- (Pasa / Falla)

---

## TEST 3
### 1. Informacion general
- **ID del caso de prueba:** CP-TER-003
- **Titulo de la prueba:** Rechazar terminación de contrato ya finalizado
- **Módulo / Característica:** Terminaciones / Validaciones de estado

### 2. Descripción
Esta prueba verifica que el sistema rechace la terminación de un contrato que ya tiene estado "Terminado" o "Finalizado"

### 3. Precondiciones
1. Usuario inicia sesión
2. Debe existir un contrato y estado = "Terminado"
3. Debe existir un contrato y estado = "Finalizado"


### 4. Pasos para la Ejecución
1. Usuario autenticado con rol "Gestor RRHH"
2. El usuario intenta terminar el contrato (ya terminado)
3. El usuario intenta terminar el contrato (ya finalizado)

### 5. Datos de entrada
##### Intento 1 (Contrato - Terminado):
- **ID del contrato:** 1
- **Fecha de terminación:** 15/07/2026
- **Motivo:** Intento de segunda terminación
##### Intento 2 (Contrato - Finalizado):
- **ID del contrato:** 2
- **Fecha de terminación:** 20/07/2026
- **Motivo:** Nuevo intento de terminación

### 6. Resultado esperado
El sistema debe rechazar ambas solicitudes y mostrar un error indicando que solo se pueden terminar contratos con estado "Activo"

### 7. Resultado Real
(Para ser completado durante la ejecución)

### 8. Estado 
- (Pasa / Falla)

---

## RESUMEN

| Módulo | Cantidad | IDs |
|--------|----------|-----|
| Colaboradores | 5 | CP-COL-001 al 005 |
| Contratos | 4 | CP-CON-001 al 004 |
| Prórrogas | 3 | CP-EXT-001 al 003 |
| Terminaciones | 3 | CP-TER-001 al 003 |
| **TOTAL** | **15** | |
