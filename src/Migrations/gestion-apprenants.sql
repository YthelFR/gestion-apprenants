#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: promotions
#------------------------------------------------------------

CREATE TABLE promotions(
        id_promotions     Int  Auto_increment  NOT NULL ,
        nom_promotions    Varchar (255) NOT NULL ,
        debut_promotions  Date NOT NULL ,
        fin_promotions    Date NOT NULL ,
        places_promotions Int NOT NULL
	,CONSTRAINT promotions_PK PRIMARY KEY (id_promotions)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: cours
#------------------------------------------------------------

CREATE TABLE cours(
        id_cours        Int  Auto_increment  NOT NULL ,
        datedebut_cours Datetime NOT NULL ,
        datefin_cours   Datetime NOT NULL ,
        code_cours      Int NOT NULL ,
        id_promotions   Int NOT NULL
	,CONSTRAINT cours_PK PRIMARY KEY (id_cours)

	,CONSTRAINT cours_promotions_FK FOREIGN KEY (id_promotions) REFERENCES promotions(id_promotions)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: role
#------------------------------------------------------------

CREATE TABLE role(
        id_role  Int  Auto_increment  NOT NULL ,
        nom_role Varchar (255) NOT NULL
	,CONSTRAINT role_PK PRIMARY KEY (id_role)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: user
#------------------------------------------------------------

CREATE TABLE user(
        id_user        Int  Auto_increment  NOT NULL ,
        nom_user       Varchar (50) NOT NULL ,
        prenom_user    Varchar (30) NOT NULL ,
        mail_user      Varchar (100) NOT NULL ,
        password_user  Varchar (255) NOT NULL ,
        activated_user Bool NOT NULL ,
        id_role        Int
	,CONSTRAINT user_PK PRIMARY KEY (id_user)

	,CONSTRAINT user_role_FK FOREIGN KEY (id_role) REFERENCES role(id_role)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: presence
#------------------------------------------------------------

CREATE TABLE presence(
        id_cours            Int NOT NULL ,
        id_user             Int NOT NULL ,
        retard_presence     Bool NOT NULL ,
        validation_presence Bool NOT NULL
	,CONSTRAINT presence_PK PRIMARY KEY (id_cours,id_user)

	,CONSTRAINT presence_cours_FK FOREIGN KEY (id_cours) REFERENCES cours(id_cours)
	,CONSTRAINT presence_user0_FK FOREIGN KEY (id_user) REFERENCES user(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: appartient
#------------------------------------------------------------

CREATE TABLE appartient(
        id_user       Int NOT NULL ,
        id_promotions Int NOT NULL
	,CONSTRAINT appartient_PK PRIMARY KEY (id_user,id_promotions)

	,CONSTRAINT appartient_user_FK FOREIGN KEY (id_user) REFERENCES user(id_user)
	,CONSTRAINT appartient_promotions0_FK FOREIGN KEY (id_promotions) REFERENCES promotions(id_promotions)
)ENGINE=InnoDB;

