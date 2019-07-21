
# 信息安全综合实践

### 基本信息

项目名称：CC在线购物网站

小组名：CC

组员：cloud0606（组长），Wzy-CC

### 环境

- 宿主机：ubuntu 18.04
- docker 18.09
- docker image:tutum/lamp
  - php 5.5
  - mysql 5.5
  - apache2.4.7
  - ubuntu 14.04 

### 镜像编译与启动

```bash
# 进入到docker文件夹下
docker-compose up -d --build # 镜像编译 与 后台启动
docker-compose down # 停止容器并删除
```

### 时间结点

7月4日~7月9日（6天）

- 第1天 ： 【设计】设计基本功能与漏洞利用链，搭建基本的开发环境 
- 第2，3天： 【实现】功能实现，埋漏洞
- 第4，5天：【测试】测试编写exp,checker脚本，录制演示视频
- 第6天：【演示】做ppt

### 功能设计

[API设计文档](Doc/API.md)

### 漏洞利用链
  1. 查询订单页面存在SQL注入，获取vip用户的手机号
  2. 使用vip手机号，通过爆破验证码成功登录vip用户账号，使用vip账号购买flag

### 人员分工

- 基本功能设计：Wzy-CC、cloud0606
- 漏洞利用链设计：Wzy-CC、cloud0606
- 前端代码实现：Wzy-CC
- 后端代码实现：cloud0606
- exp、check脚本编写：cloud0606
- docker技术支持：cloud0606
- 演示视频录制、文档、ppt制作：Wzy-CC
