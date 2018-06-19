CREATE SCHEMA IF NOT EXISTS `eonline` DEFAULT CHARACTER SET utf8;
USE `eonline`;

CREATE TABLE `eonline`.`config_site` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome_site` VARCHAR(100) NOT NULL,
  `logo` VARCHAR(100) NOT NULL,
  `titulo_site` VARCHAR(100) NOT NULL,
PRIMARY KEY (`id`)) 
ENGINE=InnoDB;

CREATE TABLE `eonline`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `nomemeio` VARCHAR(30),
  `sobrenome` VARCHAR(60) NOT NULL,
  `data_nasc` DATETIME,
  `usuario` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  `imagem_perfil` VARCHAR(255) NOT NULL,
  `permissao` INT NOT NULL,
  `status` CHAR(1) NOT NULL,
  `aluno` CHAR(1),
  `professor` CHAR(1),
  `celular` VARCHAR(17),
  `data_registro` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `chave_temporaria` VARCHAR(32),
  `data_solic_senha` DATETIME,
  `req_troca_senha` VARCHAR(26),
PRIMARY KEY (`id`),
  UNIQUE INDEX `usuario_UNIQUE` (`usuario` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)) 
ENGINE=InnoDB;

CREATE TABLE `eonline`.`aluno_exp` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `aluno_id` INT NOT NULL,
  `exp` INT NOT NULL,
  `nivel` INT NOT NULL,
  PRIMARY KEY (`id`, `nivel`),
  UNIQUE INDEX `aluno_id_UNIQUE` (`aluno_id` ASC),
  CONSTRAINT `fk_aluno_exp_aluno_id`
   FOREIGN KEY (`aluno_id`)
   REFERENCES `eonline`.`usuario` (`id`)
   ON DELETE NO ACTION
   ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE `eonline`.`matriz_exp` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nivel_base` INT NOT NULL,
  `exp_padrao` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE `eonline`.`conquista` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(30) NOT NULL,
  `descricao` VARCHAR(100) NOT NULL,
  `icone` VARCHAR(50) NOT NULL,
  `pontos` INT NOT NULL,
  `status` CHAR(1) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE `eonline`.`aluno_conquista` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `aluno_id` INT NOT NULL,
  `conquista_id` INT NOT NULL,
  `status` CHAR(1) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_aluno_conquista_aluno_id`
  FOREIGN KEY (`aluno_id`)
  REFERENCES `eonline`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  CONSTRAINT `fk_aluno_conquista_conquista_id`
  FOREIGN KEY (`conquista_id`)
  REFERENCES `eonline`.`conquista` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE `eonline`.`config_pontos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(30) NOT NULL,
  `icone` VARCHAR(50) NOT NULL,
  `plural` BOOL NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE `eonline`.`aluno_pontos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `aluno_id` INT NOT NULL,
  `pontos` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_aluno_pontos_aluno_id`
  FOREIGN KEY (`aluno_id`)
  REFERENCES `eonline`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`calendario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(35) NOT NULL,
  `descricao` VARCHAR(100) NOT NULL,
  `ano` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`calendario_datas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `calendario_id` INT NOT NULL,
  `data` DATETIME NOT NULL,
  `letivo` CHAR(1) NOT NULL,
  `feriado` CHAR(1) NOT NULL,
  `reposicao` CHAR(1) NOT NULL,
  `semestre` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`usuario_log` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario_id` INT NOT NULL,
  `data_hora` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `ip` VARCHAR(50) NOT NULL,
  `acao` VARCHAR(50) NOT NULL,
  `msg` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_usuario_log_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `eonline`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`turma` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `turno_desc` VARCHAR(15) NOT NULL,
  `turno` INT NOT NULL,
  `ciclo` INT NOT NULL,
  `serie` INT NOT NULL,
  `codigo` VARCHAR(15) NOT NULL,
  `ano` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`disciplina` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(15) NOT NULL,
  `sigla` CHAR(3) NOT NULL,
  `status` CHAR(1) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`disciplina_turma` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `disciplina_id` INT NOT NULL,
  `turma_id` INT NOT NULL,
  `status` CHAR(1) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_disciplina_turma_disciplina_id`
  FOREIGN KEY (`disciplina_id`)
  REFERENCES `eonline`.`disciplina` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  CONSTRAINT `fk_disciplina_turma_turma_id`
  FOREIGN KEY (`turma_id`)
  REFERENCES `eonline`.`turma` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`horario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `turma_id` INT NOT NULL,
  `disciplina_id` INT NOT NULL,
  `professor_id` INT NOT NULL,
  `dia_semana` INT NOT NULL,
  `ordem` INT NOT NULL,
  `posicao` INT NOT NULL,
  `status` CHAR(1) NOT NULL,
  PRIMARY KEY (`id`, `turma_id`),
  CONSTRAINT `fk_horario_turma_id`
  FOREIGN KEY (`turma_id`)
  REFERENCES `eonline`.`turma` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  CONSTRAINT `fk_horario_disciplina_id`
  FOREIGN KEY (`disciplina_id`)
  REFERENCES `eonline`.`disciplina` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  CONSTRAINT `fk_horario_professor_id`
  FOREIGN KEY (`professor_id`)
  REFERENCES `eonline`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`professor_escala` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `professor_id` INT NOT NULL,
  `turno` CHAR(1) NOT NULL,
  `status` CHAR(1) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_professor_disciplina_turma_id`
  FOREIGN KEY (`professor_id`)
  REFERENCES `eonline`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`professor_disciplina` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `professor_id` INT NOT NULL,
  `disciplina_id` INT NOT NULL,
  `status` CHAR(1) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_professor_disciplina_professor_id`
  FOREIGN KEY (`professor_id`)
  REFERENCES `eonline`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  CONSTRAINT `fk_professor_disciplina_disciplina_id`
  FOREIGN KEY (`disciplina_id`)
  REFERENCES `eonline`.`disciplina` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`prof_resp_turma` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `turma_id` INT NOT NULL,
  `professor_id` INT NOT NULL,
  `status` CHAR(1) NOT NULL,
  `ano` INT NOT NULL, 
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_prof_resp_turma_turma_id`
  FOREIGN KEY (`turma_id`)
  REFERENCES `eonline`.`turma` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  CONSTRAINT `fk_prof_resp_turma_professor_id`
  FOREIGN KEY (`professor_id`)
  REFERENCES `eonline`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`turma_alunos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `aluno_id` INT NOT NULL,
  `turma_id` INT NOT NULL,
  `status` CHAR(1) NOT NULL,
  `ano` INT NOT NULL, 
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_turma_alunos_turma_id`
  FOREIGN KEY (`turma_id`)
  REFERENCES `eonline`.`turma` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  CONSTRAINT `fk_turma_alunos_aluno_id`
  FOREIGN KEY (`aluno_id`)
  REFERENCES `eonline`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`escala_professor` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `professor_id` INT NOT NULL,
  `turno` VARCHAR(15) NOT NULL,
  `ano` INT NOT NULL, 
  `status` CHAR(1) NOT NULL, 
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_escala_professor_professor_id`
  FOREIGN KEY (`professor_id`)
  REFERENCES `eonline`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`chamada` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `aluno_id` INT NOT NULL,
  `turma_id` INT NOT NULL,
  `disciplina_id` INT NOT NULL,
  `data` DATETIME NULL,
  `ano` INT NOT NULL, 
  `status` CHAR(1) NOT NULL, 
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_chamada_aluno_id`
  FOREIGN KEY (`aluno_id`)
  REFERENCES `eonline`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  CONSTRAINT `fk_chamada_turma_id`
  FOREIGN KEY (`turma_id`)
  REFERENCES `eonline`.`turma` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
    CONSTRAINT `fk_chamada_disciplina_id`
  FOREIGN KEY (`disciplina_id`)
  REFERENCES `eonline`.`disciplina` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `config_site` (`nome_site`, `logo`, `titulo_site`) VALUES
('E-Online', 'logo.png', 'Escola Online');

INSERT INTO `usuario` (`nome`, `nomemeio`, `sobrenome`, `usuario`, `senha`, `data_nasc`, `email`, `imagem_perfil`, `permissao`, `status`, `aluno`, `professor`) VALUES
('Administrador', '', 'do Sistema', 'admin', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste1@teste.com.br', 'default-profile.png', 1, 'A', 'N', 'N'),
('Dulcinara', '', 'Rezende', 'valeria.andrade', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste-1@teste.com.br', 'default-profile.png', 2, 'A', 'N', 'S'),
('Saulo', '', 'Oliveira', 'saulo.oliveira', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste-2@teste.com.br', 'default-profile.png', 2, 'A', 'N', 'S'),
('César', '', 'Duarte', 'cesar.duarte', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste-3@teste.com.br', 'default-profile.png', 2, 'A', 'N', 'S'),
('Mirtes', '', 'Rocha', 'mirtes.rocha', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste-4@teste.com.br', 'default-profile.png', 2, 'A', 'N', 'S'),
('Adilson', '', 'Lourenço', 'adilson.lourenco', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste-5@teste.com.br', 'default-profile.png', 2, 'A', 'N', 'S'),
('Rita', '', 'Ambrósio', 'rita.ambrosio', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste-6@teste.com.br', 'default-profile.png', 2, 'A', 'N', 'S'),
('Paulo', 'Cardoso', 'Melo', 'paulo.melo', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste-7@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Raissa', 'Melo', 'Souza', 'raissa.souza', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste-8@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Samuel', 'Silva', 'Rocha', 'samuel.rocha', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste5@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Daniel', 'Pereira Fernandes', 'Moura', 'daniel.moura', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste6@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Giovanna', 'Araujo', 'Rodrigues', 'giovanna.rodrigues', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste7@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Pedro', 'Sousa Cavalcanti', 'Schein', 'pedro.schein', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste8@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Emily', 'Melo', 'Carvalho', 'emily.carvalho', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste9@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Tânia', 'Gomes', 'Azevedo', 'tania.azevedo', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste10@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Renan', 'Lima', 'Rocha', 'renan.rocha', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste11@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Luiz', 'Carvalho', 'Cunha', 'luiz.cunha', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste12@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Joao', 'Costa', 'Sousa', 'joao.souza', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01',  'teste13@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Camila', 'Fernandes', 'Castro', 'camilla.castro', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste14@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Marina', 'Lima Castro', 'Silva', 'marina.silva', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste15@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Beatrice', 'Fernandes', 'Gomes', 'beatrice.gomes', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste16@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Kaua', 'Ferreira', 'Goncalves', 'kaua.goncalves', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste17@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Laura', 'Pinto', 'Alves', 'laura.alves', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste18@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('João', 'Felipe', 'Ferreira', 'joao.ferreira', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste19@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Marcel', '', 'Duarte', 'marcel.duarte', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste20@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Daniel', '', 'Maneteyer', 'daniel.maneteyer', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste21@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Eduardo', '', 'Rezende', 'eduardo.rezende', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste22@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('André', '', 'Napoleão', 'andre.napoleao', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste23@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Clayton', '', 'Philippe', 'clayton.phillipe', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste24@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N');

INSERT INTO `disciplina` (`nome`, `sigla`, `status`) VALUES
('Artes', 'ART', 'A'),
('Ciências', 'CIE', 'A'),
('Estudos Sociais', 'EST', 'A'),
('Matematica', 'MAT', 'A'),
('Português', 'POR', 'A'),
('Educação Física', 'EDF', 'A');

INSERT INTO `professor_disciplina` (`professor_id`, `disciplina_id`, `status`) VALUES
(2, 1, 'A'),
(3, 2, 'A'),
(4, 3, 'A'),
(5, 4, 'A'),
(6, 5, 'A'),
(7, 6, 'A');

INSERT INTO `escala_professor` (`professor_id`, `turno`, `ano`, `status`) VALUES
(2, 1, 2018, 'A'),
(3, 1, 2018, 'A'),
(4, 1, 2018, 'A'),
(5, 1, 2018, 'A'),
(6, 1, 2018, 'A'),
(7, 1, 2018, 'A');

INSERT INTO `turma` (`turno_desc`, `turno`, `ciclo`, `serie`, `codigo`, `ano`) VALUES
('Tarde', 2, 1, 2, 'A', 2018),
('Tarde', 2, 3, 6, 'A', 2018),
('Manhã', 1, 4, 7, 'A', 2018),
('Manhã', 1, 4, 9, 'B', 2018);

INSERT INTO `prof_resp_turma` (`turma_id`, `professor_id`, `ano`, `status`) VALUES
(1, 2, 2018, 'A'),
(2, 3, 2018, 'A'),
(3, 4, 2018, 'A'),
(4, 5, 2018, 'A');

INSERT INTO `turma_alunos` (`turma_id`, `aluno_id`, `status`, `ano`) VALUES
(1, 8, 'A', 2018),
(1, 9, 'A', 2018),
(1, 10, 'A', 2018),
(1, 11, 'A', 2018),
(1, 12, 'A', 2018),
(2, 13, 'A', 2018),
(2, 14, 'A', 2018),
(2, 15, 'A', 2018),
(2, 16, 'A', 2018),
(2, 17, 'A', 2018),
(3, 18, 'A', 2018),
(3, 19, 'A', 2018),
(3, 20, 'A', 2018),
(3, 21, 'A', 2018),
(3, 22, 'A', 2018),
(3, 23, 'A', 2018),
(4, 24, 'A', 2018),
(4, 25, 'A', 2018),
(4, 26, 'A', 2018),
(4, 27, 'A', 2018),
(4, 28, 'A', 2018),
(4, 29, 'A', 2018);

INSERT INTO `calendario` (`nome`, `descricao`, `ano`) VALUES
('CALTESTE2018', 'Calendário Teste 2018', 2018);

INSERT INTO `calendario_datas` (`data`, `calendario_id`, `letivo` ,`feriado`, `reposicao`, `semestre`) VALUES
('2018-01-01', 1, 'N', 'N', 'N', 1), 
('2018-01-02', 1, 'N', 'N', 'N', 1), 
('2018-01-03', 1, 'N', 'N', 'N', 1), 
('2018-01-04', 1, 'N', 'N', 'N', 1), 
('2018-01-05', 1, 'N', 'N', 'N', 1), 
('2018-01-06', 1, 'N', 'N', 'N', 1), 
('2018-01-07', 1, 'N', 'N', 'N', 1), 
('2018-01-08', 1, 'N', 'N', 'N', 1), 
('2018-01-09', 1, 'N', 'N', 'N', 1), 
('2018-01-10', 1, 'N', 'N', 'N', 1), 
('2018-01-11', 1, 'N', 'N', 'N', 1), 
('2018-01-12', 1, 'N', 'N', 'N', 1), 
('2018-01-13', 1, 'N', 'N', 'N', 1), 
('2018-01-14', 1, 'N', 'N', 'N', 1), 
('2018-01-15', 1, 'N', 'N', 'N', 1), 
('2018-01-16', 1, 'N', 'N', 'N', 1), 
('2018-01-17', 1, 'N', 'N', 'N', 1), 
('2018-01-18', 1, 'N', 'N', 'N', 1), 
('2018-01-19', 1, 'N', 'N', 'N', 1), 
('2018-01-20', 1, 'N', 'N', 'N', 1), 
('2018-01-21', 1, 'N', 'N', 'N', 1), 
('2018-01-22', 1, 'N', 'N', 'N', 1), 
('2018-01-23', 1, 'N', 'N', 'N', 1), 
('2018-01-24', 1, 'N', 'N', 'N', 1), 
('2018-01-25', 1, 'N', 'N', 'N', 1), 
('2018-01-26', 1, 'N', 'N', 'N', 1), 
('2018-01-27', 1, 'N', 'N', 'N', 1), 
('2018-01-28', 1, 'N', 'N', 'N', 1), 
('2018-01-29', 1, 'N', 'N', 'N', 1), 
('2018-01-30', 1, 'N', 'N', 'N', 1), 
('2018-01-31', 1, 'N', 'N', 'N', 1), 
('2018-02-01', 1, 'N', 'N', 'N', 1), 
('2018-02-02', 1, 'N', 'N', 'N', 1), 
('2018-02-03', 1, 'N', 'N', 'N', 1), 
('2018-02-04', 1, 'N', 'N', 'N', 1), 
('2018-02-05', 1, 'N', 'N', 'N', 1), 
('2018-02-06', 1, 'N', 'N', 'N', 1), 
('2018-02-07', 1, 'N', 'N', 'N', 1), 
('2018-02-08', 1, 'N', 'N', 'N', 1), 
('2018-02-09', 1, 'N', 'N', 'N', 1), 
('2018-02-10', 1, 'N', 'N', 'N', 1), 
('2018-02-11', 1, 'N', 'N', 'N', 1), 
('2018-02-12', 1, 'S', 'N', 'N', 1), 
('2018-02-13', 1, 'S', 'N', 'N', 1), 
('2018-02-14', 1, 'S', 'N', 'N', 1), 
('2018-02-15', 1, 'S', 'N', 'N', 1), 
('2018-02-16', 1, 'S', 'N', 'N', 1), 
('2018-02-17', 1, 'S', 'N', 'N', 1), 
('2018-02-18', 1, 'S', 'N', 'N', 1), 
('2018-02-19', 1, 'S', 'N', 'N', 1), 
('2018-02-20', 1, 'S', 'N', 'N', 1), 
('2018-02-21', 1, 'S', 'N', 'N', 1), 
('2018-02-22', 1, 'S', 'N', 'N', 1), 
('2018-02-23', 1, 'S', 'N', 'N', 1), 
('2018-02-24', 1, 'S', 'N', 'N', 1), 
('2018-02-25', 1, 'S', 'N', 'N', 1), 
('2018-02-26', 1, 'S', 'N', 'N', 1), 
('2018-02-27', 1, 'S', 'N', 'N', 1), 
('2018-02-28', 1, 'S', 'N', 'N', 1), 
('2018-03-01', 1, 'S', 'N', 'N', 1), 
('2018-03-02', 1, 'S', 'N', 'N', 1), 
('2018-03-03', 1, 'S', 'N', 'N', 1), 
('2018-03-04', 1, 'S', 'N', 'N', 1), 
('2018-03-05', 1, 'S', 'N', 'N', 1), 
('2018-03-06', 1, 'S', 'N', 'N', 1), 
('2018-03-07', 1, 'S', 'N', 'N', 1), 
('2018-03-08', 1, 'S', 'N', 'N', 1), 
('2018-03-09', 1, 'S', 'N', 'N', 1), 
('2018-03-10', 1, 'S', 'N', 'N', 1), 
('2018-03-11', 1, 'S', 'N', 'N', 1), 
('2018-03-12', 1, 'S', 'N', 'N', 1), 
('2018-03-13', 1, 'S', 'N', 'N', 1), 
('2018-03-14', 1, 'S', 'N', 'N', 1), 
('2018-03-15', 1, 'S', 'N', 'N', 1), 
('2018-03-16', 1, 'S', 'N', 'N', 1), 
('2018-03-17', 1, 'S', 'N', 'N', 1), 
('2018-03-18', 1, 'S', 'N', 'N', 1), 
('2018-03-19', 1, 'S', 'N', 'N', 1), 
('2018-03-20', 1, 'S', 'N', 'N', 1), 
('2018-03-21', 1, 'S', 'N', 'N', 1), 
('2018-03-22', 1, 'S', 'N', 'N', 1), 
('2018-03-23', 1, 'S', 'N', 'N', 1), 
('2018-03-24', 1, 'S', 'N', 'N', 1), 
('2018-03-25', 1, 'S', 'N', 'N', 1), 
('2018-03-26', 1, 'S', 'N', 'N', 1), 
('2018-03-27', 1, 'S', 'N', 'N', 1), 
('2018-03-28', 1, 'S', 'N', 'N', 1), 
('2018-03-29', 1, 'S', 'N', 'N', 1), 
('2018-03-30', 1, 'S', 'N', 'N', 1), 
('2018-03-31', 1, 'S', 'N', 'N', 1), 
('2018-04-01', 1, 'S', 'N', 'N', 1), 
('2018-04-02', 1, 'S', 'N', 'N', 1), 
('2018-04-03', 1, 'S', 'N', 'N', 1), 
('2018-04-04', 1, 'S', 'N', 'N', 1), 
('2018-04-05', 1, 'S', 'N', 'N', 1), 
('2018-04-06', 1, 'S', 'N', 'N', 1), 
('2018-04-07', 1, 'S', 'N', 'N', 1), 
('2018-04-08', 1, 'S', 'N', 'N', 1), 
('2018-04-09', 1, 'S', 'N', 'N', 1), 
('2018-04-10', 1, 'S', 'N', 'N', 1), 
('2018-04-11', 1, 'S', 'N', 'N', 1), 
('2018-04-12', 1, 'S', 'N', 'N', 1), 
('2018-04-13', 1, 'S', 'N', 'N', 1), 
('2018-04-14', 1, 'S', 'N', 'N', 1), 
('2018-04-15', 1, 'S', 'N', 'N', 1), 
('2018-04-16', 1, 'S', 'N', 'N', 1), 
('2018-04-17', 1, 'S', 'N', 'N', 1), 
('2018-04-18', 1, 'S', 'N', 'N', 1), 
('2018-04-19', 1, 'S', 'N', 'N', 1), 
('2018-04-20', 1, 'S', 'N', 'N', 1), 
('2018-04-21', 1, 'S', 'N', 'N', 1), 
('2018-04-22', 1, 'S', 'N', 'N', 1), 
('2018-04-23', 1, 'S', 'N', 'N', 1), 
('2018-04-24', 1, 'S', 'N', 'N', 1), 
('2018-04-25', 1, 'S', 'N', 'N', 1), 
('2018-04-26', 1, 'S', 'N', 'N', 1), 
('2018-04-27', 1, 'S', 'N', 'N', 1), 
('2018-04-28', 1, 'S', 'N', 'N', 1), 
('2018-04-29', 1, 'S', 'N', 'N', 1), 
('2018-04-30', 1, 'S', 'N', 'N', 1), 
('2018-05-01', 1, 'S', 'N', 'N', 1), 
('2018-05-02', 1, 'S', 'N', 'N', 1), 
('2018-05-03', 1, 'S', 'N', 'N', 1), 
('2018-05-04', 1, 'S', 'N', 'N', 1), 
('2018-05-05', 1, 'S', 'N', 'N', 1), 
('2018-05-06', 1, 'S', 'N', 'N', 1), 
('2018-05-07', 1, 'S', 'N', 'N', 1), 
('2018-05-08', 1, 'S', 'N', 'N', 1), 
('2018-05-09', 1, 'S', 'N', 'N', 1), 
('2018-05-10', 1, 'S', 'N', 'N', 1), 
('2018-05-11', 1, 'S', 'N', 'N', 1), 
('2018-05-12', 1, 'S', 'N', 'N', 1), 
('2018-05-13', 1, 'S', 'N', 'N', 1), 
('2018-05-14', 1, 'S', 'N', 'N', 1), 
('2018-05-15', 1, 'S', 'N', 'N', 1), 
('2018-05-16', 1, 'S', 'N', 'N', 1), 
('2018-05-17', 1, 'S', 'N', 'N', 1), 
('2018-05-18', 1, 'S', 'N', 'N', 1), 
('2018-05-19', 1, 'S', 'N', 'N', 1), 
('2018-05-20', 1, 'S', 'N', 'N', 1), 
('2018-05-21', 1, 'S', 'N', 'N', 1), 
('2018-05-22', 1, 'S', 'N', 'N', 1), 
('2018-05-23', 1, 'S', 'N', 'N', 1), 
('2018-05-24', 1, 'S', 'N', 'N', 1), 
('2018-05-25', 1, 'S', 'N', 'N', 1), 
('2018-05-26', 1, 'S', 'N', 'N', 1), 
('2018-05-27', 1, 'S', 'N', 'N', 1), 
('2018-05-28', 1, 'S', 'N', 'N', 1), 
('2018-05-29', 1, 'S', 'N', 'N', 1), 
('2018-05-30', 1, 'S', 'N', 'N', 1), 
('2018-05-31', 1, 'S', 'N', 'N', 1), 
('2018-06-01', 1, 'S', 'N', 'N', 1), 
('2018-06-02', 1, 'S', 'N', 'N', 1), 
('2018-06-03', 1, 'S', 'N', 'N', 1), 
('2018-06-04', 1, 'S', 'N', 'N', 1), 
('2018-06-05', 1, 'S', 'N', 'N', 1), 
('2018-06-06', 1, 'S', 'N', 'N', 1), 
('2018-06-07', 1, 'S', 'N', 'N', 1), 
('2018-06-08', 1, 'S', 'N', 'N', 1), 
('2018-06-09', 1, 'S', 'N', 'N', 1), 
('2018-06-10', 1, 'S', 'N', 'N', 1), 
('2018-06-11', 1, 'S', 'N', 'N', 1), 
('2018-06-12', 1, 'S', 'N', 'N', 1), 
('2018-06-13', 1, 'S', 'N', 'N', 1), 
('2018-06-14', 1, 'S', 'N', 'N', 1), 
('2018-06-15', 1, 'S', 'N', 'N', 1), 
('2018-06-16', 1, 'S', 'N', 'N', 1), 
('2018-06-17', 1, 'S', 'N', 'N', 1), 
('2018-06-18', 1, 'S', 'N', 'N', 1), 
('2018-06-19', 1, 'S', 'N', 'N', 1), 
('2018-06-20', 1, 'S', 'N', 'N', 1), 
('2018-06-21', 1, 'S', 'N', 'N', 1), 
('2018-06-22', 1, 'S', 'N', 'N', 1), 
('2018-06-23', 1, 'S', 'N', 'N', 1), 
('2018-06-24', 1, 'S', 'N', 'N', 1), 
('2018-06-25', 1, 'S', 'N', 'N', 1), 
('2018-06-26', 1, 'S', 'N', 'N', 1), 
('2018-06-27', 1, 'S', 'N', 'N', 1), 
('2018-06-28', 1, 'S', 'N', 'N', 1), 
('2018-06-29', 1, 'S', 'N', 'N', 1), 
('2018-06-30', 1, 'S', 'N', 'N', 1), 
('2018-07-01', 1, 'S', 'N', 'N', 2), 
('2018-07-02', 1, 'S', 'N', 'N', 2), 
('2018-07-03', 1, 'S', 'N', 'N', 2), 
('2018-07-04', 1, 'S', 'N', 'N', 2), 
('2018-07-05', 1, 'S', 'N', 'N', 2), 
('2018-07-06', 1, 'S', 'N', 'N', 2), 
('2018-07-07', 1, 'S', 'N', 'N', 2), 
('2018-07-08', 1, 'S', 'N', 'N', 2), 
('2018-07-09', 1, 'S', 'N', 'N', 2), 
('2018-07-10', 1, 'S', 'N', 'N', 2), 
('2018-07-11', 1, 'S', 'N', 'N', 2), 
('2018-07-12', 1, 'S', 'N', 'N', 2), 
('2018-07-13', 1, 'S', 'N', 'N', 2), 
('2018-07-14', 1, 'S', 'N', 'N', 2), 
('2018-07-15', 1, 'S', 'N', 'N', 2), 
('2018-07-16', 1, 'S', 'N', 'N', 2), 
('2018-07-17', 1, 'S', 'N', 'N', 2), 
('2018-07-18', 1, 'S', 'N', 'N', 2), 
('2018-07-19', 1, 'S', 'N', 'N', 2), 
('2018-07-20', 1, 'S', 'N', 'N', 2), 
('2018-07-21', 1, 'S', 'N', 'N', 2), 
('2018-07-22', 1, 'S', 'N', 'N', 2), 
('2018-07-23', 1, 'S', 'N', 'N', 2), 
('2018-07-24', 1, 'S', 'N', 'N', 2), 
('2018-07-25', 1, 'S', 'N', 'N', 2), 
('2018-07-26', 1, 'S', 'N', 'N', 2), 
('2018-07-27', 1, 'S', 'N', 'N', 2), 
('2018-07-28', 1, 'S', 'N', 'N', 2), 
('2018-07-29', 1, 'S', 'N', 'N', 2), 
('2018-07-30', 1, 'S', 'N', 'N', 2), 
('2018-07-31', 1, 'S', 'N', 'N', 2), 
('2018-08-01', 1, 'S', 'N', 'N', 2), 
('2018-08-02', 1, 'S', 'N', 'N', 2), 
('2018-08-03', 1, 'S', 'N', 'N', 2), 
('2018-08-04', 1, 'S', 'N', 'N', 2), 
('2018-08-05', 1, 'S', 'N', 'N', 2), 
('2018-08-06', 1, 'S', 'N', 'N', 2), 
('2018-08-07', 1, 'S', 'N', 'N', 2), 
('2018-08-08', 1, 'S', 'N', 'N', 2), 
('2018-08-09', 1, 'S', 'N', 'N', 2), 
('2018-08-10', 1, 'S', 'N', 'N', 2), 
('2018-08-11', 1, 'S', 'N', 'N', 2), 
('2018-08-12', 1, 'S', 'N', 'N', 2), 
('2018-08-13', 1, 'S', 'N', 'N', 2), 
('2018-08-14', 1, 'S', 'N', 'N', 2), 
('2018-08-15', 1, 'S', 'N', 'N', 2), 
('2018-08-16', 1, 'S', 'N', 'N', 2), 
('2018-08-17', 1, 'S', 'N', 'N', 2), 
('2018-08-18', 1, 'S', 'N', 'N', 2), 
('2018-08-19', 1, 'S', 'N', 'N', 2), 
('2018-08-20', 1, 'S', 'N', 'N', 2), 
('2018-08-21', 1, 'S', 'N', 'N', 2), 
('2018-08-22', 1, 'S', 'N', 'N', 2), 
('2018-08-23', 1, 'S', 'N', 'N', 2), 
('2018-08-24', 1, 'S', 'N', 'N', 2), 
('2018-08-25', 1, 'S', 'N', 'N', 2), 
('2018-08-26', 1, 'S', 'N', 'N', 2), 
('2018-08-27', 1, 'S', 'N', 'N', 2), 
('2018-08-28', 1, 'S', 'N', 'N', 2), 
('2018-08-29', 1, 'S', 'N', 'N', 2), 
('2018-08-30', 1, 'S', 'N', 'N', 2), 
('2018-08-31', 1, 'S', 'N', 'N', 2), 
('2018-09-01', 1, 'S', 'N', 'N', 2), 
('2018-09-02', 1, 'S', 'N', 'N', 2), 
('2018-09-03', 1, 'S', 'N', 'N', 2), 
('2018-09-04', 1, 'S', 'N', 'N', 2), 
('2018-09-05', 1, 'S', 'N', 'N', 2), 
('2018-09-06', 1, 'S', 'N', 'N', 2), 
('2018-09-07', 1, 'S', 'N', 'N', 2), 
('2018-09-08', 1, 'S', 'N', 'N', 2), 
('2018-09-09', 1, 'S', 'N', 'N', 2), 
('2018-09-10', 1, 'S', 'N', 'N', 2), 
('2018-09-11', 1, 'S', 'N', 'N', 2), 
('2018-09-12', 1, 'S', 'N', 'N', 2), 
('2018-09-13', 1, 'S', 'N', 'N', 2), 
('2018-09-14', 1, 'S', 'N', 'N', 2), 
('2018-09-15', 1, 'S', 'N', 'N', 2), 
('2018-09-16', 1, 'S', 'N', 'N', 2), 
('2018-09-17', 1, 'S', 'N', 'N', 2), 
('2018-09-18', 1, 'S', 'N', 'N', 2), 
('2018-09-19', 1, 'S', 'N', 'N', 2), 
('2018-09-20', 1, 'S', 'N', 'N', 2), 
('2018-09-21', 1, 'S', 'N', 'N', 2), 
('2018-09-22', 1, 'S', 'N', 'N', 2), 
('2018-09-23', 1, 'S', 'N', 'N', 2), 
('2018-09-24', 1, 'S', 'N', 'N', 2), 
('2018-09-25', 1, 'S', 'N', 'N', 2), 
('2018-09-26', 1, 'S', 'N', 'N', 2), 
('2018-09-27', 1, 'S', 'N', 'N', 2), 
('2018-09-28', 1, 'S', 'N', 'N', 2), 
('2018-09-29', 1, 'S', 'N', 'N', 2), 
('2018-09-30', 1, 'S', 'N', 'N', 2), 
('2018-10-01', 1, 'S', 'N', 'N', 2), 
('2018-10-02', 1, 'S', 'N', 'N', 2), 
('2018-10-03', 1, 'S', 'N', 'N', 2), 
('2018-10-04', 1, 'S', 'N', 'N', 2), 
('2018-10-05', 1, 'S', 'N', 'N', 2), 
('2018-10-06', 1, 'S', 'N', 'N', 2), 
('2018-10-07', 1, 'S', 'N', 'N', 2), 
('2018-10-08', 1, 'S', 'N', 'N', 2), 
('2018-10-09', 1, 'S', 'N', 'N', 2), 
('2018-10-10', 1, 'S', 'N', 'N', 2), 
('2018-10-11', 1, 'S', 'N', 'N', 2), 
('2018-10-12', 1, 'S', 'N', 'N', 2), 
('2018-10-13', 1, 'S', 'N', 'N', 2), 
('2018-10-14', 1, 'S', 'N', 'N', 2), 
('2018-10-15', 1, 'S', 'N', 'N', 2), 
('2018-10-16', 1, 'S', 'N', 'N', 2), 
('2018-10-17', 1, 'S', 'N', 'N', 2), 
('2018-10-18', 1, 'S', 'N', 'N', 2), 
('2018-10-19', 1, 'S', 'N', 'N', 2), 
('2018-10-20', 1, 'S', 'N', 'N', 2), 
('2018-10-21', 1, 'S', 'N', 'N', 2), 
('2018-10-22', 1, 'S', 'N', 'N', 2), 
('2018-10-23', 1, 'S', 'N', 'N', 2), 
('2018-10-24', 1, 'S', 'N', 'N', 2), 
('2018-10-25', 1, 'S', 'N', 'N', 2), 
('2018-10-26', 1, 'S', 'N', 'N', 2), 
('2018-10-27', 1, 'S', 'N', 'N', 2), 
('2018-10-28', 1, 'S', 'N', 'N', 2), 
('2018-10-29', 1, 'S', 'N', 'N', 2), 
('2018-10-30', 1, 'S', 'N', 'N', 2), 
('2018-10-31', 1, 'S', 'N', 'N', 2), 
('2018-11-01', 1, 'S', 'N', 'N', 2), 
('2018-11-02', 1, 'S', 'N', 'N', 2), 
('2018-11-03', 1, 'S', 'N', 'N', 2), 
('2018-11-04', 1, 'S', 'N', 'N', 2), 
('2018-11-05', 1, 'S', 'N', 'N', 2), 
('2018-11-06', 1, 'S', 'N', 'N', 2), 
('2018-11-07', 1, 'S', 'N', 'N', 2), 
('2018-11-08', 1, 'S', 'N', 'N', 2), 
('2018-11-09', 1, 'S', 'N', 'N', 2), 
('2018-11-10', 1, 'S', 'N', 'N', 2), 
('2018-11-11', 1, 'S', 'N', 'N', 2), 
('2018-11-12', 1, 'S', 'N', 'N', 2), 
('2018-11-13', 1, 'S', 'N', 'N', 2), 
('2018-11-14', 1, 'S', 'N', 'N', 2), 
('2018-11-15', 1, 'S', 'N', 'N', 2), 
('2018-11-16', 1, 'S', 'N', 'N', 2), 
('2018-11-17', 1, 'S', 'N', 'N', 2), 
('2018-11-18', 1, 'S', 'N', 'N', 2), 
('2018-11-19', 1, 'S', 'N', 'N', 2), 
('2018-11-20', 1, 'S', 'N', 'N', 2), 
('2018-11-21', 1, 'S', 'N', 'N', 2), 
('2018-11-22', 1, 'S', 'N', 'N', 2), 
('2018-11-23', 1, 'S', 'N', 'N', 2), 
('2018-11-24', 1, 'S', 'N', 'N', 2), 
('2018-11-25', 1, 'S', 'N', 'N', 2), 
('2018-11-26', 1, 'S', 'N', 'N', 2), 
('2018-11-27', 1, 'S', 'N', 'N', 2), 
('2018-11-28', 1, 'S', 'N', 'N', 2), 
('2018-11-29', 1, 'S', 'N', 'N', 2), 
('2018-11-30', 1, 'S', 'N', 'N', 2), 
('2018-12-01', 1, 'S', 'N', 'N', 2), 
('2018-12-02', 1, 'S', 'N', 'N', 2), 
('2018-12-03', 1, 'S', 'N', 'N', 2), 
('2018-12-04', 1, 'S', 'N', 'N', 2), 
('2018-12-05', 1, 'S', 'N', 'N', 2), 
('2018-12-06', 1, 'S', 'N', 'N', 2), 
('2018-12-07', 1, 'S', 'N', 'N', 2), 
('2018-12-08', 1, 'S', 'N', 'N', 2), 
('2018-12-09', 1, 'S', 'N', 'N', 2), 
('2018-12-10', 1, 'S', 'N', 'N', 2), 
('2018-12-11', 1, 'S', 'N', 'N', 2), 
('2018-12-12', 1, 'S', 'N', 'N', 2), 
('2018-12-13', 1, 'S', 'N', 'N', 2), 
('2018-12-14', 1, 'S', 'N', 'N', 2), 
('2018-12-15', 1, 'N', 'N', 'N', 2), 
('2018-12-16', 1, 'N', 'N', 'N', 2), 
('2018-12-17', 1, 'N', 'N', 'N', 2), 
('2018-12-18', 1, 'N', 'N', 'N', 2), 
('2018-12-19', 1, 'N', 'N', 'N', 2), 
('2018-12-20', 1, 'N', 'N', 'N', 2), 
('2018-12-21', 1, 'N', 'N', 'N', 2), 
('2018-12-22', 1, 'N', 'N', 'N', 2), 
('2018-12-23', 1, 'N', 'N', 'N', 2), 
('2018-12-24', 1, 'N', 'N', 'N', 2), 
('2018-12-25', 1, 'N', 'N', 'N', 2), 
('2018-12-26', 1, 'N', 'N', 'N', 2), 
('2018-12-27', 1, 'N', 'N', 'N', 2), 
('2018-12-28', 1, 'N', 'N', 'N', 2), 
('2018-12-29', 1, 'N', 'N', 'N', 2), 
('2018-12-30', 1, 'N', 'N', 'N', 2), 
('2018-12-31', 1, 'N', 'N', 'N', 2);

INSERT INTO `horario` (`turma_id`, `disciplina_id`, `professor_id`, `dia_semana`, `ordem`, `status`, `posicao`) VALUES
(1, 1, 2, 1, 1, 'A', 1),
(1, 2, 2, 1, 2, 'A', 2),
(1, 3, 2, 1, 3, 'A', 3),
(1, 4, 2, 1, 4, 'A', 4),
(1, 5, 2, 1, 5, 'A', 5),
(1, 4, 2, 2, 1, 'A', 6),
(1, 3, 2, 2, 2, 'A', 7),
(1, 2, 2, 2, 3, 'A', 8),
(1, 1, 2, 2, 4, 'A', 9),
(1, 5, 2, 2, 5, 'A', 10),
(1, 4, 2, 3, 1, 'A', 11),
(1, 3, 2, 3, 2, 'A', 12),
(1, 2, 2, 3, 3, 'A', 13),
(1, 1, 2, 3, 4, 'A', 14),
(1, 2, 2, 3, 5, 'A', 15),
(1, 3, 2, 4, 1, 'A', 16),
(1, 4, 2, 4, 2, 'A', 17),
(1, 5, 2, 4, 3, 'A', 18),
(1, 2, 2, 4, 4, 'A', 19),
(1, 3, 2, 4, 5, 'A', 20);

INSERT INTO `matriz_exp` (`nivel_base`, `exp_padrao`) VALUES 
(1 ,0),
(2 ,35),
(3 ,80),
(4 ,150),
(5 ,240),
(6 ,350),
(7 ,500),
(8 ,660),
(9 ,830),
(10 ,1000),
(11 ,1200),
(12 ,1420),
(13 ,1650),
(14 ,1900),
(15 ,2150),
(16 ,2400),
(17 ,2700),
(18 ,3100),
(19 ,3800),
(20 ,5000);

INSERT INTO `aluno_exp` (`aluno_id`, `exp`, `nivel`) VALUES 
(15, 0 , 1);

INSERT INTO `conquista` (`nome`, `descricao`, `icone`, `pontos`, `status`) VALUES 
("Simplesmente 10!",  "Consiga uma nota equivalente a 10 pontos numa avaliação", "default-icon.png", 100, "A"),
("O início da Jornada",  "Não obtenha faltas no período de 3 dias", "default-icon.png", 50, "A"),
("Esse é o meu poder",  "Compartilhe o resultado de uma avaliação numa rede social", "default-icon.png", 30, "A"),
("Nada a temer!",  "Mantenha se livre de eventos negativos durante sete dias", "default-icon.png", 30, "A"),
("Colaborador(a)",  "Participe de um trabalho em grupo", "default-icon.png", 30, "A"),
("Primeiro lugar",  "Consiga a nota mais alta da turma em uma atividade", "default-icon.png", 30, "A"),
("Focado(a)",  "Não receba faltas no período de um mês", "default-icon.png", 30, "A"),
("Teste",  "Teste", "default-icon.png", 30, "A"),
("Determinação",  "Não receba faltas no semestre", "default-icon.png", 30, "A");

INSERT INTO `aluno_conquista` (`aluno_id`, `conquista_id`, `status`) VALUES 
(15, 2, 'A'),
(15, 4, 'A'),
(15, 6, 'A'),
(15, 9, 'A');

INSERT INTO `config_pontos` (`nome`, `icone`, `plural`) VALUES 
('Unx', 'default-point-icon', FALSE);

INSERT INTO `aluno_pontos` (`aluno_id`, `pontos`) VALUES 
(15, 3453);

CREATE USER IF NOT EXISTS 'root'@'%' IDENTIFIED BY '';
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;