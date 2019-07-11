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
phonenumber varchar(20),
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
insert into Products (name,price,inventory,description)values('kidding....',0,2142314,'hello');


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
values(1,2,1000);

```

```mysql
# 开发阶段数据库开启远程连接,即把ccuser的host设置为%
use mysql;
GRANT ALL ON CC.* TO 'ccuser'@'%' IDENTIFIED BY '123';
flush privileges;

select host,user,password from user;
```

```sql
# 数据库需要如下信息用于checker验证
# 需要一个手机号为13300001111的 vip用户
# 需要一个用户名为testReg的用户
# 订单id=0的存在
  
# 商品表样例
insert into Products (name,price,inventory,description)values('flag',1000,2142314,'bug this product to get flag');
insert into Products (name,price,inventory,description)values('fake flag ',1,33332423,'buy this to ...');
insert into Products (name,price,inventory,description)values('kidding....',0,2142314,'hello');

# 用户
insert into User (username,password,phonenumber,money) values('TEST_REGISTER','123',null,0);
insert into User (username,password,phonenumber,money) values('VIP_FIND_MY_PHONE','wzdcd132re',13300001111,1000000000);
  
# 订单
insert into Orders (userid,prodid,totalPrice) values('2','1',1000);
```

