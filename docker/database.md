```mysql
# 数据库建立相关表格 
mysql -u root -p
CREATE DATABASE CC DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
GRANT ALL ON CC.* TO 'ccuser'@'localhost' IDENTIFIED BY '123';
FLUSH PRIVILEGES;
EXIT;
```

```mysql
# 建表语句
create table User(
id int primary key auto_increment,
username varchar(20),
password varchar(100),
phone_number int
);

create table Product(
id int primary key auto_increment,
name varchar(20),
password varchar(100),
description varchar(200)
);


```

