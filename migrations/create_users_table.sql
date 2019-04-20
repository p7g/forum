CREATE TABLE users (
  id INTEGER PRIMARY KEY,
  name TEXT NOT NULL,
  email TEXT NOT NULL,
  signature TEXT NOT NULL DEFAULT '',
  date_of_birth TEXT NOT NULL
);
