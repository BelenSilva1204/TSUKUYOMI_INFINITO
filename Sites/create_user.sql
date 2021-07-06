CREATE OR REPLACE FUNCTION

create_user(unombre varchar(100), urut VARCHAR(25), uedad int, usexo varchar(10), udir_calle varchar(100), udir_comuna varchar(100))

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$


-- declaramos las variables a utilizar si es que es necesario
DECLARE
uidmax int;
udidmax int;

-- definimos nuestra función
BEGIN

    IF urut IN (SELECT rut FROM usuarios) THEN
        RETURN FALSE;
    END IF;

    SELECT did INTO udidmax 
    FROM direcciones
    WHERE dir_calle == udir_calle 
    AND dir_comuna == udir_comuna;

    SELECT INTO uidmax
    MAX(uid)
    FROM usuarios;

    insert into usuarios values(uidmax + 1, nombre, rut, edad, sexo, udidmax);
    RETURN TRUE;

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql