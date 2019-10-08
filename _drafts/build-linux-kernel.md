下载linux内核源代码，这里使用的是一个长期支持版`4.19`
```sh
curl -O https://cdn.kernel.org/pub/linux/kernel/v4.x/linux-4.19.78.tar.xz
```

启动一个linux docker容器，我们在容器里面编译，我使用的是`archlinux/base`这个镜像
```sh
docker run -ti archlinux/base bash
```

下面都是在容器中操作
```sh
# 使用中科大的源
echo 'Server = http://mirrors.ustc.edu.cn/archlinux/$repo/os/$arch' >  /etc/pacman.d/mirrorlist
# 使用清华大学的源 
echo 'Server = https://mirrors.tuna.tsinghua.edu.cn/archlinux/$repo/os/$arch' >> /etc/pacman.d/mirrorlist
pacman -Syy && pacman -Syu
```