--
SELECT * FROM usuario;
--
select * from acesso.usuario;

create table TipoColeta (
	idTipoCol INT PRIMARY KEY AUTO_INCREMENT,
    nmTipoCol VARCHAR(30) NOT NULL,
    staTipoCol CHAR(1) NOT NULL
);

CREATE TABLE usuario (
	id_usua INT PRIMARY KEY AUTO_INCREMENT,
    nm_usua VARCHAR(30) NOT NULL,
    sta_usua CHAR(1) NOT NULL,
    login_usua VARCHAR(30) NOT NULL,
    senha_usua VARCHAR(4000) NOT NULL,
    dt_incl DATE NOT NULL
);

CREATE TABLE perfil (
	id_perfil INT PRIMARY KEY AUTO_INCREMENT,
    desc_perfil VARCHAR(30) NOT NULL,
    sta_perfil CHAR(1) NOT NULL
);

INSERT INTO perfil (desc_perfil, sta_perfil) 
VALUES 
	('Administrador', 'A'),
    ('Solicitante', 'A'),
    ('Coletor', 'A');
--
INSERT INTO usuario (nm_usua, sta_usua, login_usua, senha_usua, dt_incl)
VALUES ('Eduardo Praxedes Dias', 'A', 'eduardodias830@gmail.com', '5981213d5fb903c6ec6ea4bbb1b8f91e', sysdate());
--
CREATE TABLE usuario_perfil (
	id_usua INT NOT NULL,
    id_perfil INT NOT NULL,
    PRIMARY KEY(id_usua, id_perfil),
    FOREIGN KEY(id_usua) REFERENCES usuario(id_usua),
    FOREIGN KEY(id_perfil) REFERENCES perfil(id_perfil)
);

INSERT INTO usuario_perfil VALUES (1, 1);
--
CREATE TABLE status_ticket (
	id_sta_ticket INT PRIMARY KEY AUTO_INCREMENT,
    nm_sta_ticket VARCHAR(30) NOT NULL
);

CREATE TABLE ticket (
	id_ticket INT NOT NULL AUTO_INCREMENT,
    nm_ticket VARCHAR(100) NOT NULL,
    desc_ticket VARCHAR(2000) NOT NULL,
    id_sta_ticket INT,
    dt_incl_ticket DATE NOT NULL,
    logradouro VARCHAR(200) NOT NULL,
    cep CHAR(9) NOT NULL,
    numero INT NOT NULL,
    complemento VARCHAR(200),
    cidade VARCHAR(200) NOT NULL,
    estado CHAR(2) NOT NULL,
    preco FLOAT(100, 2),
    id_usua_coletor INT,
    id_usua_resp INT NOT NULL,
    PRIMARY KEY (id_ticket),
    CONSTRAINT fk_status_ticket FOREIGN KEY (id_sta_ticket) REFERENCES status_ticket (id_sta_ticket),
    CONSTRAINT fk_usuario_coletor FOREIGN KEY (id_usua_coletor) REFERENCES usuario (id_usua),
    CONSTRAINT fk_usuario_resp FOREIGN KEY (id_usua_resp) REFERENCES usuario (id_usua)
);

INSERT INTO status_ticket (nm_sta_ticket)
VALUES
	('Enviado para análise'),
    ('Em andamento'),
    ('Finalizado');

ALTER TABLE status_ticket
  ADD sta_ticket CHAR(1);
--
UPDATE status_ticket SET sta_ticket = 'A';
--
ALTER TABLE status_ticket MODIFY sta_ticket CHAR(1) NOT NULL;

ALTER TABLE ticket ADD bairro VARCHAR(100);