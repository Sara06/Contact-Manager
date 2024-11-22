-- create the tables
CREATE TABLE categories (
  categoryID       INT(11)    NOT NULL,
  categoryName     VARCHAR(255)   NOT NULL,
  PRIMARY KEY (categoryID)
);

CREATE TABLE contacts (
  contactID    INT(11)        NOT NULL AUTO_INCREMENT,
  categoryID   INT(11)        NOT NULL,
  firstName    VARCHAR(255)   NOT NULL,
  lastName     VARCHAR(255)   NOT NULL,
  emailAddress VARCHAR(255)   NOT NULL,
  phone        VARCHAR(12)    NOT NULL,
  PRIMARY KEY (contactID)
);


-- insert data into the database
INSERT INTO categories VALUES
('1', 'School'),
('2', 'Doctor'),
('3', 'Shop'),
('4', 'Restaurant');

INSERT INTO contacts VALUES
(1, '1', 'John', 'Doe', 'john@doe.com', '040-324-3456'),
(2, '1', 'Jane', 'Doe', 'jane@doe.com', '042-456-2890'),
(3, '2', 'John', 'Smith', 'john@smith.com', '056-345-1256'),
(4, '2', 'Jane', 'Smith', 'jane@smith.com', '789-567-3467'),
(5, '3', 'John', 'Doe', 'john@doe.com', '567-786-2890'),
(6, '3', 'Jane', 'Smith', 'jane@smith.com', '050-227-0985');














