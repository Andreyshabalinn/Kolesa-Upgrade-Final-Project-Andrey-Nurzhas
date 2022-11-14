create database Services;
use Services;

create table users
(
    id          INTEGER PRIMARY KEY AUTO_INCREMENT,
    name        varchar(255),
    telegram_id INT,
    first_name  varchar(255),
    last_name   varchar(255),
    chat_id     INT,
    created_at  datetime default CURRENT_TIMESTAMP,
    updated_at  datetime,
    deleted_at  datetime
);

#сюда добавь код для создания таблицы messages
create table messages
(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    message varchar(250)
);