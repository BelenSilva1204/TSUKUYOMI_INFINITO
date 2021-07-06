CREATE OR REPLACE FUNCTION

import_users (nombre varchar(100), rut varchar(25), edad int, sexo varchar(10), did int)

RETURNS BOOLEAN AS $$

DECLARE
uidmax int;

BEGIN 

    /* IF 'contrasena' NOT IN (SELECT column_name FROM information_schema.columns WHERE table_name='usuarios') THEN
        ALTER TABLE usuarios ADD contrasena varchar(20);
        UPDATE usuarios SET contrasena = LTRIM(STR(RAND(uid)*(100000000-1)+1, 8));
    END IF; */
    IF 'contrasena' NOT IN (SELECT column_name FROM information_schema.columns WHERE table_name='usuarios') THEN
        ALTER TABLE usuarios ADD contrasena varchar(20);
        UPDATE usuarios SET contrasena = 1);
    END IF;

    IF rut NOT IN (SELECT rut FROM Usuarios) THEN
        
        SELECT INTO uidmax
        MAX(uid)
        FROM usuarios;

        INSERT INTO usuarios values(uidmax, nombre, rut, edad, sexo, did, LTRIM(STR(RAND()*(100000000-1)+1, 8)));
        RETURN TRUE;
    ELSE
        RETURN FALSE;
    END IF;
END

$$ language plpgsql


        