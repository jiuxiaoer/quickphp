JiuXiaoWeb 1.0
===============

**代码规范**
~~~~
类名使用 AdminUser 风格，必须遵从驼峰形式
方法名、都统一使用 getUserInfo 风格 必须遵从驼峰形式
参数名、成员变量、局部变量 使用全小写，若过长使用_隔开 如 data data_name
本套系统 业务逻辑 工整 优秀 以下的文字为 系统分析
          控制器     逻辑层   模型层   视图层
业务分层： controller business  model    view
业务开发： 逻辑公式 详情看 登陆代码admin/controller/Login->check 学习
  1.判断请求方式 get post put delete
  2.接收参数 初始化  异常参数 初始化 
  3.通过 validate层 校验参数
  4.参数校验完毕 数据发送到 逻辑层 逻辑层调用 model 层curd数据
~~~~
测试地址：jiuxiao.79xj.cn
代码交流 q 1247333542