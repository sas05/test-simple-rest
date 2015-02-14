CREATE TABLE customers (
  id   INTEGER PRIMARY KEY AUTOINCREMENT,
  name VARCHAR NOT NULL
);

CREATE TABLE items (
  id          INTEGER PRIMARY KEY AUTOINCREMENT,
  name        VARCHAR NOT NULL,
  description VARCHAR NOT NULL,
  price       INTEGER NOT NULL
);

CREATE TABLE cart (
  id          INTEGER PRIMARY KEY AUTOINCREMENT,
  customer_id INTEGER NOT NULL,
  item_id     INTEGER NOT NULL
);

insert into customers (name) values('Saeed');

