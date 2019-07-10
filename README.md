
# 信息安全综合实践

## built it

### 基本信息

小组名：CC

组员：cloud0606（组长），Wzy-CC

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

- API设计

  登录注册:

  - /signup 用户注册
  - /loginbypw 用户名密码登录
  - /loginbyvc 手机验证码登录（验证码为4位数字）
  - /login 用户登出

   商城相关:

  - /query 查询订单（存在SQL注入）

  - /buy 购买
### 漏洞利用链
  1. /query 存在SQL注入，获取vip用户的手机号
  2. /loginbyvc 使用vip手机号登录，爆破验证码成功登录vip用户账号

### 人员分工

- 基本功能设计：Wzy-CC、cloud0606
- 漏洞利用链设计：Wzy-CC、cloud0606
- 代码实现：Wzy-CC，cloud0606
- exp脚本编写：Wzy-CC
- checker脚本编写：cloud0606

- docker技术支持：Wzy-CC
- 演示视频录制：cloud0606 
- ppt书写：Wzy-CC
