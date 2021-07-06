CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
verificar_venta (pid_var int, tid_var int)

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$

-- declaramos las variables a utilizar si es que es necesario
-- DECLARE
-- variable1;
-- variable2;

-- definimos nuestra función
BEGIN

    -- control de flujo
    IF pid_var IN (SELECT pid FROM Productos WHERE Productos.tid=tid_var) THEN
        RETURN TRUE;
    
    ELSE
        RETURN FALSE;

    END IF;

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql