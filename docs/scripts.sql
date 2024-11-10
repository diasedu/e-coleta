ALTER TABLE usuario ADD tipoCadastro VARCHAR(30) NOT NULL;
ALTER TABLE usuario MODIFY senhaUsua VARCHAR(4000) NOT NULL;

create table TipoColeta (
	idTipoCol INT PRIMARY KEY AUTO_INCREMENT,
    nmTipoCol VARCHAR(30) NOT NULL,
    staTipoCol CHAR(1) NOT NULL
);