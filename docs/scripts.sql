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
    FOREIGN KEY(id_perfil) REFERENCES perfil(id_usua)
);

INSERT INTO usuario_perfil VALUES (1, 1);
--