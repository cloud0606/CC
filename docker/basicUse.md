
```bash
# 导出已运行容器中当前数据库的表
docker exec -it lamp mysqldump -usmsuser -p123SMSzgcmdx SMS > schema.sql

# 编写dockerfile内容如下
FROM tutum/lamp # 声明基础镜像
RUN rm -rf /var/www/html/* # 拷贝文件
COPY config/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY config/apache2.conf  /etc/apache2/apache2.conf
COPY mysql-setup.sh mysql-setup.sh
COPY schema.sql schema.sql
COPY privileges.sql privileges.sql
COPY --chown=www-data:www-data html /var/www/html
CMD /run.sh # 容器启动时执行语句


# 根据dockerfile构建镜像
docker build -t sms/lamp .
# 运行镜像
# docker run -d -p 80:80 -p 3306:3306 --name test1 cloud0606/lamp
docker run -d -p 80:80 --name test1 sms/lamp
# 删除镜像
docker rmi <image id>
# 删除容器
docker rm <container id>

# 进入docker
sudo docker exec -it test1 /bin/bash

# 查看容器日志
docker logs bc60f788c347

# 查看mysqld状态
/usr/sbin/mysqld status
```

