# API 接口设计说明

> URI、功能描述、请求参数说明、请求方法说明、响应值说明等；

## API 目录结构

```bash
├── src
│   ├── config
│   │   └── db.php # 数据库链接配置
│   ├── object
│   │   ├── order.php # 订单相关操作
│   │   ├── product.php # 商品相关操作
│   │   └── user.php # 用户相关操作
│   ├── order
│   │   ├── getOrderInfo.php # 查询订单信息
│   │   └── placeAnOrder.php # 下订单
│   ├── product
│   │   └── getProductsInfo.php # 获取商品信息
│   └── user
│       ├── getCurrentUser.php # 获取单钱登录用户信息
│       ├── login.php # 用户登录
│       ├── logout.php # 用户登出
│       ├── register.php # 用户注册 
│       ├── sendVerifyCode.php # 发送验证码
│       └── verifyPhoneVc.php # 验证验证码正确性
```

## 接口说明

- register.php 

  描述 : 通过用户名和密码注册账号

  ```
  uri: http://localhost/src/user/register.php
  method: GET
  params:
  	username 用户名
  	password 密码
  response:
  	{
          status: false, # 请求状态,可选false和true
          data: "xxx"    # 状态描述信息
      }
  ```
- login.php 

  描述 : 通过用户名和密码登录账号

  ```
  uri: http://localhost/src/user/login.php
  method: GET
  params:
  	username 用户名
  	password 密码
  response:
  	{
          status: false, # 请求状态,可选false和true
          data: "xxx   " # 状态描述信息
      }
  ```

- logout.php 

  描述 :  当前已登录账号登出

  ```
  uri: http://localhost/src/user/logout.php
  method: GET
  params:
  response:
  	登出成功返回 OK
  	不成功无返回信息
  ```

- sendVerifyCode.php 

  描述 : 发送验证码到手机号(未真正模拟发送验证码到手机号)

  ```
  uri: http://localhost/src/user/sendVerifyCode.php
  method: GET
  params:
  	phonenumber 用户手机号
  response:
  	{
          status: false, # 请求状态,可选false和true
          data: "xxx"    # 状态描述信息
      }
  ```
- verifyPhoneVc.php 

  描述 : 验证验证码的正确性

  ```
  uri: http://localhost/src/user/verifyPhoneVc.php
  method: GET
  params:
  	phonenumber 用户手机号
  	verifycode 验证码
  response:
  	{
          status: false, # 请求状态,可选false和true
          data: "xxx"    # 状态描述信息
      }
  ```

- getCurrentUser.php 

  描述 : 获取当前登录用户的信息

  ```
  uri: http://localhost/src/user/verifyPhoneVc.php
  method: GET
  params:
  response:
      {
          status: false,    # 请求状态,可选false和true
          data: {
              username: "", # 用户名
              userbalance: "" # 账户余额
              }
      }
  ```

- getOrderInfo.php 

  描述 : 根据订单编号查询订单信息

   ```
  uri: http://localhost/src/order/getOrderInfo.php
  method: GET
  params:
  	orderId 订单id
  response:
  	{
          status: false, # 请求状态,可选false和true
          data: "xxx"    # 状态描述信息
      }
   ```

- placeAnOrder.php 

  描述 : 购买指定id的商品

  ```
  uri: http://localhost/src/order/placeAnOrder.php
  method: GET
  params:
  	prodid 商品id
  response:
  	{
          status: false, # 请求状态,可选false和true
          data: "xxx"    # 状态描述信息
      }
  ```

- getProductsInfo.php 

  描述 : 通过用户名和密码注册账号

  ```
  uri: http://localhost/src/product/getProductsInfo.php
  method: GET
  params:
  response:
  	{
          status: "true",  # 请求状态,可选false和true
          sum: "3",        # 商品总数
          rows: [          # 商品id
              {
              id: "1",
              name: "flag",
              price: "1000",
              inventory: "2142307",
              description: "bug this product to get flag"
              },
              ]
      }
  ```
