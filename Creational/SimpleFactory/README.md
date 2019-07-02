## 简单工厂模式（Simple Factory）
**<span style="color:red;">注意：被认为是反模式</span>**
### 意图
可以根据参数的不同返回不同类的实例。
### 适用性
* 工厂类负责创建的对象比较少
* 客户端只知道传入工厂类的参数，对于如何创建对象不关心：客户端既不需要关心创建细节，甚至连类名都不需要记住，只需要知道类型所对应的参数。

### 实现方式
1. 定义一个工厂类来负责创建其他类的实例。被创建的实例通常都具有共同的父类或者有一些相同的特性。
2. 实现各个具体的类。

### 代码
* 以 <span style="color:orange">计算器</span> 为例
>你只需要输入"+-x/"符号，就能进入相应的计算模式，然后你输入数据就能得到结果，你并不需要关心它是怎么做到的。

* 以 <span style="color:orange">支付方式</span> 为例
>你只要在用户端选择支付方式,就能使用相应支付平台的支付

具体的测试可通过/Tests下的测试用例查看

这里以 <span style="color:orange">计算器</span> 为例，你只需要输入"+-x/"符号，就能进入相应的计算模式，然后你输入数据就能得到结果，你并不需要关心它是怎么做到的。


你可以在  [GitHub](https://github.com/qqqwed/DesignPatterns/tree/master/Creational/SimpleFactory) 查看这段代码。


```
### 缺点
简单工厂模式最大的问题在于<span style="color:red;font-weight:bold">工厂类的职责相对过重</span>，增加新的产品需要修改工厂类的判断逻辑，这一点<span style="color:red;font-weight:bold">与开闭原则是相违背的</span>。