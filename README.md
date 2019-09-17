SWStudio官网源码基于ThinkCMF 5.1.2
========================

### SWStudio功能介绍
* 导师介绍：展示导师的照片，职称，简介
* 关于硕闻：此处介绍硕闻工作室的历史
* 加入硕闻：进入报名流程，提交的表单信息直接提交到后台，由管理员审核。后台可设置相应的提示信息、报名时间段等设置

### 图文安装教程
https://blog.csdn.net/qq_41138935/article/details/100921862

### 介绍与使用
https://blog.csdn.net/qq_41138935/article/details/100921881

### 二次开发参考文档
http://www.kancloud.cn/thinkcmf/doc5_1

### 环境推荐
> php7.1

> mysql 5.6+

> 打开rewrite


### 最低环境要求
> php5.6+

> mysql 5.5+ (mysql5.1安装时选择utf8编码，不支持表情符)

> 打开rewrite


### 完整版目录结构
~~~
SWStudio  根目录
├─api                     api目录
│  ├─demo                 演示应用api目录
│  │  ├─controller        控制器目录
│  │  ├─model             模型目录
│  │  └─ ...              更多类库目录
├─app                    应用目录
│  ├─admin                后台应用目录
│  │  ├─controller        控制器目录
│  │  ├─model             模型目录
│  │  └─ ...              更多类库目录
│  ├─ join               加入硕闻
│  ├─ portal            首页
│  ├─ teachermes   导师介绍
│  ├─ workabout    关于硕闻
│  ├─app.php              应用(公共)配置文件[可选]
│  ├─command.php          命令行工具配置文件[可选]
│  ├─common.php           应用公共(函数)文件[可选]
│  ├─database.php         数据库配置文件[可选]
│  ├─tags.php             应用行为扩展定义文件[可选]
├─data                    数据目录（可写）
│  ├─config               动态配置目录（可写）
│  ├─route                动态路由目录（可写）
│  ├─runtime              应用的运行时目录（可写）
│  └─ ...                 更多
├─public                  WEB 部署目录（对外访问目录）
│  ├─plugins              插件目录
│  ├─static               官方静态资源存放目录(css,js,image)，勿放自己项目文件
│  ├─themes               前后台主题目录
│  │  ├─admin_simpleboot3 后台默认主题
│  │  └─default           前台默认主题
│  ├─upload               文件上传目录
│  ├─api.php              API入口
│  ├─index.php            入口文件
│  ├─robots.txt           爬虫协议文件
│  ├─router.php           快速测试文件
│  └─.htaccess            apache重写文件
├─extend                  扩展类库目录[可选]
├─vendor                  第三方类库目录（Composer）
│  ├─thinkphp             ThinkPHP目录
│  └─...             
├─composer.json           composer 定义文件
├─LICENSE                 授权说明文件
├─README.md               README 文件
├─think                   命令行入口文件
~~~

### 声明
本项目为重庆电子工程职业学院在校学生自主开发，与学校和工作室无任何关系，纯属个人行为。

欢迎使用本项目，遇到任何问题请邮箱联系我。

### 感谢
ThinkPHP、ThinkCMF



