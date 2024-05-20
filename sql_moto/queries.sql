
-- create
CREATE TABLE type_motorbike (
  id integer not null,
  name text not null
);
CREATE TABLE motorbike (
  name text not null,
  id_type integer not null,
  discontinued boolean NOT NULL
);

-- insert
INSERT INTO type_motorbike VALUES (1, 'classic');
INSERT INTO type_motorbike VALUES (2, 'cruiser');
INSERT INTO type_motorbike VALUES (3, 'sports');

INSERT INTO motorbike VALUES ('moto_cl', 1, 0);
INSERT INTO motorbike VALUES ('moto_cr', 2, 0);
INSERT INTO motorbike VALUES ('moto_sp', 3, 1);
INSERT INTO motorbike VALUES ('moto_cr1', 2, 0);
INSERT INTO motorbike VALUES ('moto_sp1', 3, 0);
INSERT INTO motorbike VALUES ('moto_sp2', 3, 1);
