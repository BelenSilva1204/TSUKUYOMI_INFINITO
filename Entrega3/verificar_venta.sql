CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
verificar_venta (pid int, tid int)

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$

-- declaramos las variables a utilizar si es que es necesario
-- DECLARE
-- variable1;
-- variable2;

-- definimos nuestra función
BEGIN

    -- control de flujo
    IF pid IN (SELECT pid FROM Productos WHERE Productos.tid=tid) THEN
        RETURN TRUE;
    
    ELSE
        RETURN FALSE;

    END IF;

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql