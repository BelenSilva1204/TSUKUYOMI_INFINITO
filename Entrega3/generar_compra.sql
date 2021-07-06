CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
generar_compra (us_id int, pid int, tienda int, cantidad int)

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE
rut_user varchar(50);
boleta_var int;
compra_var int;
direccion_var int;
comuna_var varchar(50);
-- variable2;

-- definimos nuestra función
BEGIN

    -- control de flujo
    SELECT INTO rut_user usuarios.nombre FROM usuarios WHERE usuarios.uid=us_id LIMIT 1;
    SELECT INTO direccion_var usuarios.did FROM usuarios WHERE usuarios.uid=us_id LIMIT 1;
    SELECT INTO comuna_var 
    direcciones.dir_comuna FROM usuarios, direcciones  
    WHERE usuarios.uid=us_id AND usuarios.did=direcciones.did LIMIT 1;
    IF comuna_var IN (SELECT despachos.dir_comuna FROM despachos WHERE despachos.tid=tienda) THEN
        SELECT INTO boleta_var
        MAX(boleta)
        FROM compras;
        SELECT INTO compra_var
        MAX(compra_id)
        FROM compras;

        INSERT INTO compras VALUES(boleta_var + 1, compra_var + 1, tienda, rut_user, pid, direccion_var, cantidad);
        -- SE INSERTA EN LA TABLA COMPRAS
        -- Retorna TRUE para poder indicarle al usuario que todo funcionó correctamente.
        RETURN TRUE;
    
    ELSE
        RETURN FALSE;

    END IF;

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql