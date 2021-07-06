CREATE OR REPLACE FUNCTION

import_users (userid int, nombre varchar(100), rut varchar(25), edad int, sexo varchar(10), did int)

RETURNS BOOLEAN AS $$

BEGIN 

    IF 'password' NOT IN (SELECT column_name FROM information_schema.columns WHERE table_name='usuarios') THEN
        ALTER TABLE usuarios ADD password varchar(20);
        UPDATE usuarios SET password = LTRIM(STR(RAND()*(100000000-1)+1, 8));
    END IF;

    IF rut NOT IN (SELECT rut FROM Usuarios) THEN
        
        INSERT INTO usuarios values(userid, nombre, rut, edad, sexo, did, LTRIM(STR(RAND()*(100000000-1)+1, 8)));
        RETURN TRUE;
    ELSE
        RETURN FALSE;
    END IF;
END
$$ language plpgsql


        