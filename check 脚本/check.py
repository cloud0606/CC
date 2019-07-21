# 队名:CC
# 1. 检查 WEB API服务是否正常工作，关键页面能否访问
# 2. 检查关键服务是否正常运行
# 3. 检查 WEB API服务是否存在通用防护
# 4. 检查 flag 是否被修改，如无法 getshell，不检测
#
#  调用方式 ：调用方式 ：  python check.py 192.168.9.3 80
#  time ：20190709
import hashlib
import requests as req
import re
import sys
import json
import random
import time

def encrypt_string(hash_string):
    sha_signature = \
        hashlib.sha256(hash_string.encode()).hexdigest()
    return sha_signature

class exp:
    def __init__(self, ip, port):
        self.ip = ip
        self.port = port
        self.url = 'http://%s:%s' % (ip, port)
        random.seed(time.time())
        self.username = random.random()
        self.usernameForOrder = 'TEST_REGISTER'
        self.password = '123'
        self.phonenumber = 13300001111
        self.session = req.session()

    def register(self):
        '用户注册 '
        # 登录
        rs = self.session.get(self.url + '/src/user/register.php', timeout=10)
        status = json.loads(rs.text).get('status')
        data = json.loads(rs.text).get('data')
        print("  - 未输入用户名密码注册 返回信息：",data)
        rs = self.session.get(self.url + '/src/user/register.php',
                              params={'username': self.username, 'password': self.password}, timeout=10)
        status = json.loads(rs.text).get('status')
        data = json.loads(rs.text).get('data')
        print("  - 正常注册 返回信息：",data)

        rs = self.session.get(self.url + '/src/user/register.php',
                              params={'username': self.username, 'password': self.password}, timeout=10)
        status = json.loads(rs.text).get('status')
        data = json.loads(rs.text).get('data')
        print("  - 使用已注册用户名注册返回信息：", data)
        if (status == False):
            print("[+] Register Success.")
        else:
            print("[-] Register Failed.")

    def login(self):
        '用户登录 '
        rs = self.session.get(self.url + '/src/user/login.php', timeout=10)
        status = json.loads(rs.text).get('status')
        data = json.loads(rs.text).get('data')
        print("  - 未输入用户名密码登录 返回信息：",data)
        rs = self.session.get(self.url + '/src/user/login.php',params={'username': self.username, 'password': '0'},timeout=10)
        status = json.loads(rs.text).get('status')
        data = json.loads(rs.text).get('data')
        print("  - 密码错误登录 返回信息：",data)

        rs = self.session.get(self.url + '/src/user/login.php',
                              params={'username': self.username, 'password': self.password}, timeout=10)
        status = json.loads(rs.text).get('status')
        data = json.loads(rs.text).get('data')
        print("  - 正常登录 返回信息：", data)
        if (status):
            print("[+] Login Success.")
        else:
            print("[-] Login Failed.")

    def logout(self):
        '用户登出 '
        # 登录
        rs = self.session.get(self.url + '/src/user/logout.php')
        matchObj = re.search(r'ok', rs.text, re.M | re.I)
        if (matchObj ):
            print("[+] Logout Success.")
        else:
            print("[-] Logout Failed.")

    def sendVerifyCode(self):
        '发送手机验证码 '
        rs = self.session.get(self.url + '/src/user/sendVerifyCode.php', timeout=10)
        data = json.loads(rs.text).get('data')
        print("  - 未输入手机号请求发送验证码 返回信息：",data)
        rs = self.session.get(self.url + '/src/user/sendVerifyCode.php', params={'phonenumber':00},timeout=10)
        data = json.loads(rs.text).get('data')
        print("  - 输入未注册的手机号请求发送验证码 返回信息：",data)
        # 输入用户手机号发送验证码
        rs = self.session.get(self.url + '/src/user/sendVerifyCode.php',
                              params={'phonenumber': 13300001111}, timeout=10)
        status = json.loads(rs.text).get('status')
        data = json.loads(rs.text).get('data')
        print("  - 正常请求发送验证码 返回信息：", data)
        if (status):
            print("[+] Send Verify Code Success.")
        else:
            print("[-] Send Verify Code Failed.")

    def verifyPhoneVc(self):
        '验证手机验证码 '
        rs = self.session.get(self.url + '/src/user/verifyPhoneVc.php', timeout=10)
        data = json.loads(rs.text).get('data')
        print("  - 未输入手机号和验证码 返回信息：",data)
        rs = self.session.get(self.url + '/src/user/verifyPhoneVc.php', params={'phonenumber':00},timeout=10)
        data = json.loads(rs.text).get('data')
        print("  - 输入未注册的手机号 返回信息：",data)
        # 输入用户手机号发送验证码
        rs = self.session.get(self.url + '/src/user/verifyPhoneVc.php',
                              params={'phonenumber': 13300001111,'verifycode': 000}, timeout=10)
        status = json.loads(rs.text).get('status')
        data = json.loads(rs.text).get('data')
        print("  - 正常请求验证验证码(验证码随机生成) 返回信息：", data)
        time.sleep(60)
        rs = self.session.get(self.url + '/src/user/verifyPhoneVc.php',
                              params={'phonenumber': 13300001111,'verifycode': 000}, timeout=10)
        status = json.loads(rs.text).get('status')
        data = json.loads(rs.text).get('data')
        print("  - 超时请求验证验证码 返回信息：", data)
        if (status!=True): # 即验证码已经过期
            print("[+] Verify Code Verification Success.")
        else:
            print("[-] Verify Code Verification Failed.")

    def getOrderInfo(self):
        '查询订单 '
        rs = self.session.get(self.url + '/src/order/getOrderInfo.php',params={'orderId': 0}, timeout=10)
        status = json.loads(rs.text).get('status')
        data = json.loads(rs.text).get('data')

        print("  - 用户未登录查询订单 返回信息：","success" if status == True else "falied")
        # 用户登录
        rs = self.session.get(self.url + '/src/user/login.php',
                              params={'username':self.usernameForOrder, 'password':self.password }, timeout=10)
        #print(rs.text)
        rs = self.session.get(self.url + '/src/order/getOrderInfo.php', params={'orderId': 1},timeout=10)
        status1 = json.loads(rs.text).get('status')
        print("  - 用户登录后查询订单 返回信息：","success" if status == True else "falied")

        rs = self.session.get(self.url + '/src/order/getOrderInfo.php',  params={'orderId': 2},timeout=10)
        status = json.loads(rs.text).get('status')
        print("  - 用户后登录后查询其他用户订单 返回信息：","success" if status == True else "falied")

        # 用户登出
        rs = self.session.get(self.url + '/src/user/logout.php')

        if (status1): # 即验证码已经过期
            print("[+] Get Order Information Success.")
        else:
            print("[-] Get Order Information Failed.")

    def placeAnOrder(self):
        '检查用户相关的ap功能 '
        rs = self.session.get(self.url + '/src/order/placeAnOrder.php', params={'prodid': 3},timeout=10)
        status = json.loads(rs.text).get('status')
        print("  - 用户未登录下订单 返回信息：","success" if status == True else "falied")
        # 用户登录
        rs = self.session.get(self.url + '/src/user/login.php',
                              params={'username': self.username, 'password': self.password}, timeout=10)

        rs = self.session.get(self.url + '/src/order/placeAnOrder.php',params={'prodid': 3},timeout=10)
        status = json.loads(rs.text).get('status')
        print("  - 用户登录后下订单 返回信息：","success" if status == True else "falied")

        # 用户登出
        rs = self.session.get(self.url + '/src/order/logout.php')

        if (status): # 即验证码已经过期
            print("[+] Place An Order Success.")
        else:
            print("[-] Place An Order Failed.")

    def getProductsInfo(self):
        '检查用户相关的ap功能 '
        rs = self.session.get(self.url + '/src/product/getProductsInfo.php', timeout=10)
        status = json.loads(rs.text).get('status')
        # print(rs.text)
        # print(status)
        print("  - 用户未登录查询商品信息 返回信息：","success" if status == 'true' else "falied")
        # 用户登录
        rs = self.session.get(self.url + '/src/user/login.php',
                              params={'username': self.username, 'password': self.password}, timeout=10)

        rs = self.session.get(self.url + '/src/product/getProductsInfo.php', timeout=10)
        status = json.loads(rs.text).get('status')
        # print(rs.text)
        # print(status)
        print("  - 用户登录后查询商品信息 返回信息：","success" if status == 'true' else "falied")

        # 用户登出
        rs = self.session.get(self.url + '/src/user/logout.php')

        if (status): # 即验证码已经过期
            print("[+] Get Order Information Success.")
        else:
            print("[-] Get Order Information Failed.")

    def checkFlag(self,flag):
        flag = flag.replace("\n", "").replace("\r", "");
        rs = self.session.get(self.url + '/src/config/checkFlag.php', timeout=10)
        #print(flag)
        #print(rs.text)
        #print(encrypt_string(flag))
        if (rs.text) == encrypt_string(flag):
            print("[+] Flag Had Not Been changed.")
        else:
            print("[-] Flag Had Been changed.")



if __name__ == '__main__':
    if len(sys.argv) < 3:
        print("Wrong Params")
        print("example: python %s %s %s [%s]" % (sys.argv[0], '192.168.9.3', '80',"flag{}"))
        print("Python 3 is needed")
        exit(0)
    host = sys.argv[1]
    port = sys.argv[2]
    print("API about User")
    exp=exp(host,port)
    exp.register()
    exp.login()
    exp.logout()
    exp.sendVerifyCode()
    exp.verifyPhoneVc()
    print("API about Order")
    exp.getOrderInfo()
    exp.placeAnOrder()
    print("API about Products")
    exp.getProductsInfo()
    if (len(sys.argv) == 4):
        flag = sys.argv[3]
        print("Check Flag")
        exp.checkFlag(flag)