## K-means

k-means算法是一种很常见的聚类算法，它的基本思想是：通过迭代寻找k个聚类的一种划分方案，使得用这k个聚类的均值来代表相应各类样本时所得的总体误差最小。

k-means算法的基础是最小误差平方和准则。其代价函数是：
$J(c,\mu )=\sum_{i=1}^{k}\left \| x^{(i)}-\mu _{c^{(i)}} \right \|^{2}$

<div>
<script type="text/javascript" async src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
</div>

* 公式编辑[https://www.codecogs.com/latex/eqneditor.php](https://www.codecogs.com/latex/eqneditor.php)
