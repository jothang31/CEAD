/*
|---------------------------------------
| CEAD CITY DEPARTMENTS
|---------------------------------------
*/
CREATE TABLE CEAD_COUNTRY_DEPARTMENTS
(
  CCD_CODE INT,
  CCD_NAME VARCHAR(256)
);
ALTER TABLE CEAD_COUNTRY_DEPARTMENTS
ADD CONSTRAINT CCD_CODE_PK PRIMARY KEY (CCD_CODE);
/*
|---------------------------------------
| CEAD CITY DEPARTMENTS
|---------------------------------------
*/

/*
|---------------------------------------
| CEAD MUNICIPALITIES
|---------------------------------------
*/
CREATE TABLE CEAD_MUNICIPALITIES
(
  CM_CODE INT,
  CM_NAME VARCHAR(256),
  CCD_CODE INT
);
ALTER TABLE CEAD_MUNICIPALITIES
ADD CONSTRAINT CM_CODE_PK PRIMARY KEY (CM_CODE);
ALTER TABLE CEAD_MUNICIPALITIES
ADD CONSTRAINT CM_CCD_CODE_FK FOREIGN KEY (CCD_CODE) REFERENCES CEAD_COUNTRY_DEPARTMENTS (CCD_CODE)
                                                     ON UPDATE CASCADE;
/*                                                     
|---------------------------------------
| /. CEAD MUNICIPALITIES
|---------------------------------------
*/

/*
|---------------------------------------
| CEAD ZONE TYPES
|---------------------------------------
*/
CREATE TABLE CEAD_ZONE_TYPES
(
  CZT_CODE INT,
  CZT_NAME VARCHAR(256)
);
ALTER TABLE CEAD_ZONE_TYPES
ADD CONSTRAINT CZT_CODE_PK PRIMARY KEY (CZT_CODE);
/*
|---------------------------------------
| /. CEAD ZONE TYPES
|--------------------------------------- 
*/

/*
|---------------------------------------
| CEAD ZONES LEVELS
|---------------------------------------
*/
CREATE TABLE CEAD_ZONE_LEVELS
(
  CZL_CODE INT,
  CZL_NAME VARCHAR(256)
);
ALTER TABLE CEAD_ZONE_LEVELS
ADD CONSTRAINT CZL_CODE_PK PRIMARY KEY (CZL_CODE);
/*
|---------------------------------------
| /. CEAD ZONES LEVELS
|--------------------------------------- 
*/

/*
|---------------------------------------
| CEAD ZONES
|---------------------------------------
*/
CREATE TABLE CEAD_ZONES
(
  CZ_CODE INT,
  CZ_NAME VARCHAR(256),
  CZT_CODE INT,
  CZL_CODE INT,
  CM_CODE INT
);
ALTER TABLE CEAD_ZONES
ADD CONSTRAINT CZ_CODE_PK PRIMARY KEY (CZ_CODE);
ALTER TABLE CEAD_ZONES
ADD CONSTRAINT CZ_CZT_CODE_FK FOREIGN KEY (CZT_CODE)  REFERENCES CEAD_ZONE_TYPES (CZT_CODE)
                                                              ON UPDATE CASCADE;
ALTER TABLE CEAD_ZONES
ADD CONSTRAINT CZ_CZL_CODE_FK FOREIGN KEY (CZL_CODE) REFERENCES CEAD_ZONE_LEVELS (CZL_CODE)
                                      ON UPDATE CASCADE;
ALTER TABLE CEAD_ZONES
ADD CONSTRAINT CZ_CM_CODE_FK FOREIGN KEY (CM_CODE) REFERENCES CEAD_MUNICIPALITIES (CM_CODE)
                        ON UPDATE CASCADE;
/*                        
|-----------------------------------------
| /. CEAD ZONES
|-----------------------------------------
*/

/*
|-----------------------------------------
| CEAD STATUS
|-----------------------------------------
*/
CREATE TABLE CEAD_STATUS
(
  CS_CODE INT,
  CS_DESCRIPTION VARCHAR(256)
);
ALTER TABLE CEAD_STATUS
ADD CONSTRAINT CS_CODE_PK PRIMARY KEY (CS_CODE);
/*
|-----------------------------------------
| /. CEAD STATUS
|-----------------------------------------
*/

/*
|-----------------------------------------
| CEAD PROFILES
|-----------------------------------------
*/
CREATE TABLE CEAD_PROFILES
(
  CP_CODE INT,
  CP_NAME VARCHAR(256),
  CP_DESCRIPTION VARCHAR(500)
);
ALTER TABLE CEAD_PROFILES
ADD CONSTRAINT CP_CODE_PK PRIMARY KEY (CP_CODE);
/*
|-----------------------------------------
| /. CEAD PROFILES
|-----------------------------------------
*/

/*
|-----------------------------------------
| CEAD USERS
|-----------------------------------------
*/
CREATE TABLE CEAD_USERS
(
  CU_CODE INT,
  CU_ID VARCHAR(256) NOT NULL,
  CU_PASSWORD VARCHAR(256) NOT NULL,
  CU_NAME_PICTURE_PROFILE VARCHAR(256),
  CU_CREATION_DATE DATE,
  CU_LAST_ID VARCHAR(256),
  CU_LAST_PASWORD VARCHAR(256),
  CU_MODIFICATION_DATE DATE,
  CP_CODE INT,
  CS_CODE INT
);
ALTER TABLE CEAD_USERS
ADD CONSTRAINT CU_CODE_PK PRIMARY KEY (CU_CODE);
ALTER TABLE CEAD_USERS
ADD CONSTRAINT CU_ID_UQ UNIQUE (CU_ID);
ALTER TABLE CEAD_USERS
ADD CONSTRAINT CU_CP_CODE_FK FOREIGN KEY (CP_CODE) REFERENCES CEAD_PROFILES (CP_CODE)
                                      ON UPDATE CASCADE;
ALTER TABLE CEAD_USERS
ADD CONSTRAINT CU_CS_CODE_FK FOREIGN KEY (CS_CODE) REFERENCES CEAD_STATUS (CS_CODE)
                                                   ON UPDATE CASCADE;
/*
|-----------------------------------------
| /. CEAD USERS
|-----------------------------------------
*/

/*
|-----------------------------------------
| CEAD GENDERS
|-----------------------------------------
*/
CREATE TABLE CEAD_GENDERS
(
  CG_CODE INT,
  CG_DESCRIPTION VARCHAR(256)
);
ALTER TABLE CEAD_GENDERS
ADD CONSTRAINT CG_CODE_PK PRIMARY KEY (CG_CODE);
/*
|-----------------------------------------
|  CEAD GENDERS
|-----------------------------------------
*/

/*
|-----------------------------------------
| CEAD MARITAL STATUS
|----------------------------------------- 
*/
CREATE TABLE CEAD_MARITAL_STATUS
(
  CMS_CODE INT,
  CMS_NAME VARCHAR(256)
);
ALTER TABLE CEAD_MARITAL_STATUS
ADD CONSTRAINT CMS_CODE_PK PRIMARY KEY (CMS_CODE);
/*
|-----------------------------------------
| /. CEAD MARITAL STATUS
|-----------------------------------------
*/

/*
|-----------------------------------------
| CEAD USERS INFO
|-----------------------------------------
*/
CREATE TABLE CEAD_USERS_INFO
(
  CUI_CODE INT,
  CUI_FIRST_NAME VARCHAR(256),
  CUI_MIDDLE_NAME VARCHAR(256),
  CUI_LAST_NAME VARCHAR(256),
  CUI_SECOND_SURNAME VARCHAR(256),
  CMS_CODE INT,
  CG_CODE INT,
  CU_CODE INT
);
ALTER TABLE CEAD_USERS_INFO
ADD CONSTRAINT CUI_CODE_PK PRIMARY KEY (CUI_CODE);
ALTER TABLE CEAD_USERS_INFO
ADD CONSTRAINT CUI_CMS_CODE_FK FOREIGN KEY (CMS_CODE) REFERENCES CEAD_MARITAL_STATUS (CMS_CODE)
                                                      ON UPDATE CASCADE;
ALTER TABLE CEAD_USERS_INFO
ADD CONSTRAINT CUI_CG_CODE_FK FOREIGN KEY (CG_CODE) REFERENCES CEAD_GENDERS (CG_CODE)
                                                      ON UPDATE CASCADE;
ALTER TABLE CEAD_USERS_INFO
ADD CONSTRAINT CUI_CU_CODE_FK FOREIGN KEY (CU_CODE) REFERENCES CEAD_USERS (CU_CODE)
                                                    ON UPDATE CASCADE;
/*
|-----------------------------------------
| /. CEAD USERS INFO
|----------------------------------------- 
*/

/*
|-----------------------------------------
| CEAD CONTACT INFO TYPES
|-----------------------------------------
*/
CREATE TABLE CEAD_CONTACT_INFO_TYPES
(
  CCIT_CODE INT,
  CCIT_NAME VARCHAR(256)
);
ALTER TABLE CEAD_CONTACT_INFO_TYPES
ADD CONSTRAINT CCIT_CODE PRIMARY KEY (CCIT_CODE);
/*
|-----------------------------------------
| /. CEAD CONTACT INFO TYPES
|-----------------------------------------
*/

/*
|-----------------------------------------
| CEAD CONTACT INFO
|----------------------------------------- 
*/
CREATE TABLE CEAD_CONTACT_INFO
(
  CCI_CODE INT,
  CCI_EMAIL VARCHAR(256),
  CCI_ADDRESS VARCHAR(256),
  CZ_CODE INT,
  CUI_CODE INT,
  CCIT_CODE INT
);
ALTER TABLE CEAD_CONTACT_INFO
ADD CONSTRAINT CCI_CODE_PK PRIMARY KEY (CCI_CODE);
ALTER TABLE CEAD_CONTACT_INFO
ADD CONSTRAINT CCI_EMAIL_UQ UNIQUE (CCI_EMAIL);
ALTER TABLE CEAD_CONTACT_INFO
ADD CONSTRAINT CCI_CZ_CODE_FK FOREIGN KEY (CZ_CODE) REFERENCES CEAD_ZONES (CZ_CODE)
                                                    ON UPDATE CASCADE;
ALTER TABLE CEAD_CONTACT_INFO
ADD CONSTRAINT CCI_CUI_CODE_FK FOREIGN KEY (CUI_CODE) REFERENCES CEAD_USERS_INFO (CUI_CODE)
                                                      ON UPDATE CASCADE;
ALTER TABLE CEAD_CONTACT_INFO
ADD CONSTRAINT CCI_CCIT_CODE_FK FOREIGN KEY (CCIT_CODE) REFERENCES CEAD_CONTACT_INFO_TYPES (CCIT_CODE)
                                                       ON UPDATE CASCADE;
/*                                                       
|-----------------------------------------
| /. CEAD CONTACT INFO
|-----------------------------------------
*/

/*
|-----------------------------------------
| CEAD PHONE NUMBERS
|-----------------------------------------
*/
CREATE TABLE CEAD_PHONE_NUMBERS
(
  CPN_NUMBER INT,
  CCIT_CODE INT
);
ALTER TABLE CEAD_PHONE_NUMBERS
ADD CONSTRAINT CPN_CCIT_CODE_PK FOREIGN KEY (CCIT_CODE) REFERENCES CEAD_CONTACT_INFO (CCI_CODE)
                                ON UPDATE CASCADE;
/*                                
|-----------------------------------------
| /. CEAD PHONE NUMBERS
|-----------------------------------------
*/
-- ======================================================================================================================
/*
|-----------------------------------------
| CEAD USERS FOR LEADER
|-----------------------------------------
*/
CREATE TABLE CEAD_DEPENDANTS_X_LEADER
(
  CDXL_CODE INT,
  CU_CODE INT,
  CU_LEADER_CODE INT,
  CS_CODE INT,
  CDXL_DATE_CREATED DATE,
  CDXL_DATE_MODIFIED DATE
);
ALTER TABLE CEAD_DEPENDANTS_X_LEADER
ADD CONSTRAINT CDXL_CODE_PK PRIMARY KEY (CDXL_CODE);
ALTER TABLE CEAD_DEPENDANTS_X_LEADER
ADD CONSTRAINT CDXL_CU_CODE_FK FOREIGN KEY (CU_CODE) REFERENCES CEAD_USERS (CU_CODE)
                                                   ON UPDATE CASCADE;
ALTER TABLE CEAD_DEPENDANTS_X_LEADER
ADD CONSTRAINT CDXL_CU_LEADER_CODE_FK FOREIGN KEY (CU_LEADER_CODE) REFERENCES CEAD_USERS (CU_CODE)
                                                   ON UPDATE CASCADE;
ALTER TABLE CEAD_DEPENDANTS_X_LEADER
ADD CONSTRAINT CDXL_CS_CODE_FK FOREIGN KEY (CS_CODE) REFERENCES CEAD_STATUS (CS_CODE)
                                                   ON UPDATE CASCADE;
/*                                                   
|-----------------------------------------
| /. CEAD USERS FOR LEADER
|-----------------------------------------
*/

/*
|-----------------------------------------
| CEAD GROUP'S TYPES
|-----------------------------------------
*/
CREATE TABLE CEAD_GROUP_TYPES
(
  CGT_CODE INT,
  CGT_DESCRIPTION VARCHAR(256),
  CS_CODE INT
);
ALTER TABLE CEAD_GROUP_TYPES
ADD CONSTRAINT CGT_CODE_PK PRIMARY KEY(CGT_CODE);
ALTER TABLE CEAD_GROUP_TYPES
ADD CONSTRAINT CGT_CS_CODE_FK FOREIGN KEY(CS_CODE) REFERENCES CEAD_STATUS (CS_CODE)
                                                   ON UPDATE CASCADE;
/*                                                   
|-----------------------------------------
| /. CEAD GROUP'S TYPES
|-----------------------------------------
*/

/*
|-----------------------------------------
| CEAD USERS FOR GROUP
|-----------------------------------------
*/
CREATE TABLE CEAD_USERS_X_GROUP
(
  CU_CODE INT,
  CGT_CODE INT,
  CS_CODE INT
);
ALTER TABLE CEAD_USERS_X_GROUP
ADD CONSTRAINT CUXG_CU_CODE_FK FOREIGN KEY(CU_CODE) REFERENCES CEAD_USERS(CU_CODE)
                                                    ON UPDATE CASCADE;
ALTER TABLE CEAD_USERS_X_GROUP
ADD CONSTRAINT CUXG_CGT_CODE_FK FOREIGN KEY(CGT_CODE) REFERENCES CEAD_GROUP_TYPES (CGT_CODE)
                                                    ON UPDATE CASCADE;
ALTER TABLE CEAD_USERS_X_GROUP
ADD CONSTRAINT CUXG_CS_CODE_FK FOREIGN KEY(CS_CODE) REFERENCES CEAD_STATUS (CS_CODE)
                                                    ON UPDATE CASCADE;
/*                                                    
|-----------------------------------------
| /. CEAD USERS FOR GROUP
|-----------------------------------------
*/

/*
|-----------------------------------------
| CEAD CELLS
|-----------------------------------------
*/
CREATE TABLE CEAD_CELLS
(
  CC_CODE INT,
  CC_DAY DATE,
  CC_PLACE VARCHAR(256),
  CZ_CODE INT,
  CU_CODE INT
);
ALTER TABLE CEAD_CELLS
ADD CONSTRAINT CC_CODE_PK PRIMARY KEY (CC_CODE);
ALTER TABLE CEAD_CELLS
ADD CONSTRAINT CC_CZ_CODE_FK FOREIGN KEY (CZ_CODE) REFERENCES CEAD_ZONES (CZ_CODE)
                                                    ON UPDATE CASCADE;
ALTER TABLE CEAD_CELLS
ADD CONSTRAINT CC_CCU_CODE_FK FOREIGN KEY (CU_CODE) REFERENCES CEAD_USERS (CU_CODE)
                                                    ON UPDATE CASCADE;
/*                                                    
|-----------------------------------------
| /. CEAD CELLS
|-----------------------------------------
*/

/*
|-----------------------------------------
| CEAD MEETING
|-----------------------------------------
*/
CREATE TABLE CEAD_MEETING
(
  CM_BROTHERS INT,
  CM_FRIENDS INT,
  CM_ACEPTED INT,
  CM_ATTEND_THE_CHURCH INT,
  CC_DATE DATE,
  CC_CODE INT
);
ALTER TABLE CEAD_MEETING
ADD CONSTRAINT CM_CC_CODE_FK FOREIGN KEY (CC_CODE) REFERENCES CEAD_CELLS (CC_CODE)
                                                  ON UPDATE CASCADE;
/*                                                  
|-----------------------------------------
| /. CEAD MEETING
|-----------------------------------------
*/
-- ======================================================================================================================
/*
|-----------------------------------------
| CEAD LOGINS
|-----------------------------------------
*/
CREATE TABLE CEAD_LOGINS
(
  CU_ID VARCHAR(256),
  CL_SUCCESS INT,
  CL_DATE DATE
);
ALTER TABLE CEAD_LOGINS
ADD CONSTRAINT CL_CU_ID_FK FOREIGN KEY (CU_ID) REFERENCES CEAD_USERS (CU_ID)
                                               ON UPDATE CASCADE;
/*
|-----------------------------------------
| /. CEAD LOGINS
|-----------------------------------------
*/

/*
|-----------------------------------------
| CEAD BINNACLE
|-----------------------------------------
*/
CREATE TABLE CEAD_BINNACLE
(
  CU_ID VARCHAR(256),
  CB_DATE DATE,
  CB_ACTION VARCHAR(256),
  CB_ENTITY VARCHAR(256),
  CB_DESCRIPTION VARCHAR(256),
  CB_MORE_DETAIL VARCHAR(500)
);
ALTER TABLE CEAD_BINNACLE
ADD CONSTRAINT CB_CU_ID_FK FOREIGN KEY (CU_ID) REFERENCES CEAD_USERS (CU_ID)
                                               ON UPDATE CASCADE;
/*
|-----------------------------------------
| /. CEAD BINNACLE
|-----------------------------------------
*/


