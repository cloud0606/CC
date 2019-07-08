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
phone_number varchar(20),
money int
);

create table Products(
id int primary key auto_increment,
name varchar(20),
price int,
inventory int,
description varchar(200)
);

# 商品表样例
insert into Products (name,price,inventory,description)values('flag',1000,2142314,'bug this product to get flag');
insert into Products (name,price,inventory,description)values('fake flag ',1,33332423,'buy this to ...');
insert into Products (name,price,inventory,description)values('kidding....',1,2142314,'hello');


create table Orders(
orderid int primary key auto_increment,
userid int,
prodid int,
totalPrice int,
createtime  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP 
);

# 定义触发器用于在下订单是更新商品库存和用户余额
    DELIMITER $$ 
    DROP TRIGGER IF EXISTS `placeAnOrder`$$ 
    CREATE 
        TRIGGER `placeAnOrder` AFTER  INSERT ON  `Orders` 
        FOR EACH ROW BEGIN 
    update Products set inventory=inventory - 1 where id= new.prodid;
	update User set money=money - new.totalPrice where id= new.userid;
        END$$ 
    DELIMITER ; 

# 触发器测试用例
select * from Products;
select * from User;
select * from Orders;

insert into User 
(username,password,phone_number,money)
values('xh','123',321,10000);

insert into Orders 
(userid,prodid,totalPrice)
values(1,3,1000);

```

```mysql
# 开发阶段数据库开启远程连接,即把ccuser的host设置为%
use mysql;
GRANT ALL ON CC.* TO 'ccuser'@'%' IDENTIFIED BY '123';
flush privileges;

select host,user,password from user;
```

