CREATE TABLE "registry" (
  "id" int NOT NULL AUTO_INCREMENT,
  "name" varchar(1000) NOT NULL,
  "value" varchar(1000) NOT NULL,
  "created_at" timestamp not null default CURRENT_TIMESTAMP,
  "updated_at" timestamp not null default CURRENT_TIMESTAMP,
  PRIMARY KEY ("id")
);