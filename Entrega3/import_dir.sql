CREATE OR REPLACE FUNCTION

import_dir (d_id int, dir_calle VARCHAR(100), dir_comuna VARCHAR(100))

RETURNS BOOLEAN AS $$

BEGIN 

    IF d_id NOT IN (SELECT did FROM direcciones) THEN
        
        INSERT INTO direcciones values(d_id, dir_calle, dir_comuna);
        RETURN TRUE;
    ELSE
        RETURN FALSE;
    END IF;
END
$$ language plpgsql


        