---
layout: post
title:  "MySQL5.7的JSON基本操作"
date:   2018-11-18 18:11:06
author: "heropoo"
categories: 
    - MySQL
tags: 
    - MySQL
    - JSON

excerpt: "MySQL从5.7版本开始就支持的JSON格式数据的操作用起来挺方便的，做个笔记"
---
MySQL从5.7版本开始就支持的JSON格式数据的操作用起来挺方便的，做个笔记。

* 建表
在新建表时字段类型可以直接设置为json类型，比如我们创建一张表：
```
mysql> CREATE TABLE `test_user`(`id` INT PRIMARY KEY AUTO_INCREMENT, `name` VARCHAR(50) NOT NULL, `info` JSON);
```
json类型字段可以为NULL

* 插入数据：
```
mysql> INSERT INTO test_user(`name`, `info`) VALUES('xiaoming','{"sex": 1, "age": 18}');
```
json类型的字段必须时一个有效的json字符串


可以使用JSON_OBJECT()函数构造json对象：
```
mysql> INSERT INTO test_user(`name`, `info`) VALUES('xiaohua', JSON_OBJECT("sex", 0, "age", 17));
```

使用JSON_ARRAY()函数构造json数组：
```
mysql> INSERT INTO test_user(`name`, `info`) VALUES('xiaozhang', JSON_OBJECT("sex", 1, "age", 19, "tag", JSON_ARRAY(3,5,90)));
```

现在查看`test_user`表中的数据：
```
mysql> select * from test_user;
+----+-----------+------------------------------------------+
| id | name      | info                                     |
+----+-----------+------------------------------------------+
|  1 | xiaoming  | {"age": 18, "sex": 1}                    |
|  2 | xiaohua   | {"age": 17, "sex": 0}                    |
|  3 | xiaozhang | {"age": 19, "sex": 1, "tag": [3, 5, 90]} |
+----+-----------+------------------------------------------+
3 rows in set (0.02 sec)
```

