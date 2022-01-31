-- SELECTS
select id, email, nombre from clientes;

select id, rol, nombre, apellidos, telefono, dni, email, password, remember_token from users;
select codigo, user_id from operadores;
select codigo, user_id, jefe_codigo from tecnicos;
select codigo, user_id from jefes_equipos;

select id, nombre, num_puertas, peso_max, num_personas, llave, tipoaccionamiento, manual from modelos;
select * from ascensores;

select id, ascensor_ref, prioridad, fecha_creacion, fecha_finalizacion, tipo, estado, operador_codigo, tecnico_codigo from tareas;
select id, fecha_parte, tarea_id, tecnico_codigo, tarea_tipo, tarea_estado from partes;

-- COUNTS
select count(*) from clientes;
select count(*) from tareas;
select count(*) from partes;