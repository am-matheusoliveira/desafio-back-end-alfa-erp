
-- HORARIO - BRASIL SÃO PAULO
SET TIMEZONE TO 'America/Sao_Paulo';
SELECT NOW(); -- Horário oficial de Brasília/São Paulo


-- CRIANDO O BANCO DE DADOS
DROP DATABASE IF EXISTS estrategia_wms;

CREATE DATABASE estrategia_wms
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    LOCALE_PROVIDER = 'libc'
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;


-- CRIANDO TABELAS
CREATE TABLE tb_estrategia_wms (
    cd_estrategia_wms SERIAL PRIMARY KEY,
    ds_estrategia_wms VARCHAR(100),
    nr_prioridade     INTEGER,
    dt_registro       TIMESTAMP DEFAULT NOW(),
    dt_modificado     TIMESTAMP
);

CREATE TABLE tb_estrategia_wms_horario_prioridade (
    cd_estrategia_wms_horario_prioridade SERIAL PRIMARY KEY,
    cd_estrategia_wms                    INTEGER,
    -- cd_estrategia_wms                    INTEGER REFERENCES tb_estrategia_wms (cd_estrategia_wms)
    ds_horario_inicio                    VARCHAR(10), -- (hh:mm)
    ds_horario_final                     VARCHAR(10), -- (hh:mm)
    nr_prioridade                        INTEGER,
    dt_registro                          TIMESTAMP DEFAULT NOW(),
    dt_modificado                        TIMESTAMP  
);

-- CRIANDO A FOREIGN KEY
ALTER TABLE tb_estrategia_wms_horario_prioridade
ADD CONSTRAINT fk_tb_estrategia_wms_horario_prioridade_tb_estrategia_wms 
FOREIGN KEY (cd_estrategia_wms) REFERENCES tb_estrategia_wms (cd_estrategia_wms) ON DELETE RESTRICT;


-- INSERINDO REGISTROS
INSERT INTO tb_estrategia_wms(ds_estrategia_wms, nr_prioridade, dt_modificado) VALUES('RETIRA', 10, NOW());

INSERT INTO tb_estrategia_wms_horario_prioridade(cd_estrategia_wms, ds_horario_inicio, ds_horario_final, nr_prioridade, dt_modificado) VALUES(1, '11:01', '12:00', 20, NOW());
INSERT INTO tb_estrategia_wms_horario_prioridade(cd_estrategia_wms, ds_horario_inicio, ds_horario_final, nr_prioridade, dt_modificado) VALUES(1, '10:01', '11:00', 30, NOW());
INSERT INTO tb_estrategia_wms_horario_prioridade(cd_estrategia_wms, ds_horario_inicio, ds_horario_final, nr_prioridade, dt_modificado) VALUES(1, '09:00', '10:00', 40, NOW());

-- SELECT
SELECT * FROM tb_estrategia_wms;
SELECT * FROM tb_estrategia_wms_horario_prioridade;

-- SELECT - ROTAS

-- BUSCAR REGISTRO POR ID
SELECT * FROM tb_estrategia_wms
WHERE 
    cd_estrategia_wms = 1;

-- BUSCAR REGISTRO POR ID, HORA INICIO, HORA FIM & RETORNA A 'nr_prioridade'
SELECT nr_prioridade FROM tb_estrategia_wms_horario_prioridade
WHERE 
    cd_estrategia_wms = 1
AND TO_TIMESTAMP(ds_horario_inicio, 'HH24:MI')::TIME <= '11:01'::TIME
AND TO_TIMESTAMP(ds_horario_final, 'HH24:MI')::TIME >= '11:01'::TIME;

-- SE A CONSULTA ACIMA RETORNA 0 - REOTRNAR O VALOR PAI
SELECT nr_prioridade FROM tb_estrategia_wms
WHERE 
    cd_estrategia_wms = 1;