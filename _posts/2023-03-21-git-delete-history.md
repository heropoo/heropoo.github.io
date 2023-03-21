---
layout: post
title:  "Git删除历史版本，保留当前状态"
date:   2023-03-21 15:49:00
author: "Heropoo"
categories: 
    - Git
tags:
    - Git
excerpt: "Git删除历史版本，保留当前状态"
---

> 有时候，我们误提交了某些隐私文件，使用`git rm xxx`删除后，其实版本库中是有历史记录的，想要删除这些记录，但是又不想删除仓库，重建来提交。那么就想办法删除历史记录了。
> 要删除所有提交历史记录，但将代码保持在当前状态，可以按照以下方式安全地执行此操作：

### 步骤 

1. 创建并切换到`latest_branch`分支
```sh
git checkout --orphan latest_branch
```

2. 添加所有文件
```sh
git add -A
```

3. 提交更改
```sh
git commit -am "删除历史版本记录，初始化仓库"
```

4. 删除主分支
```sh
git branch -D master
```

5. 将当前分支重命名为主分支名
```sh
git branch -m master
```

6. 强制推送到主分支
```
git push -f origin master
```