# DesignPatterns
# 通过想象来学习设计模式 
所谓 **设计模式** 就是人们将开发中**反复遇到的问题总结出来的解决方法**。

设计源自生活，一切设计模式都可以用现实可以想象的世界来构造。如何将其中的概念、原理使用通俗易懂，更形象的话来描述，是我的初衷。
# 模式分类
<br />

| 范围\目的 |                            创建型                            |                            结构型                            |                            行为型                            |
| :-------: | :----------------------------------------------------------: | :----------------------------------------------------------: | :----------------------------------------------------------: |
|  类模式   |                         工厂方法模式                         |                        (类)适配器模式                        |             解释器模式 <br />模板方法模式<br />              |
| 对象模式  | 抽象工厂模式<br />建造者模式<br />原型模式<br />单例模式<br /> | (对象)适配器模式 桥接模式<br />组合模式<br />装饰模式<br />外观模式<br />享元模式<br />代理模式<br /> | 职责链模式<br />命令模式<br />迭代器模式<br />中介者模式<br />备忘录模式<br />观察者模式<br />状态模式<br />策略模式<br />访问者模式<br /> |

<br />

## 根据目的用途分类
根据目的、用途的不同，这些模式大体上可以分成三类。

### 1.创建型
创建型设计模式 就是一些关于 **<span style="color:red;">创建对象的方式</span>**。你可以根据实际情况来选择使用合适的方式来创建对象。

传统的对象创建方式 new class 可能会带来一些设计问题，或者增加设计的复杂度。

使用合适的创建型设计模式你就可以解决这个问题。
### 2.结构型
结构型设计模式 就是描述 **<span style="color:red;">如何将类和对象组合在一起形成更大的结构</span>**。

就像 <span style="color:orange;">搭积木</span>，你可用通过将简单积木进行组合从而形成复杂的、功能更强大的结构。
### 3.行为型
行为型设计模式 就是描述 **<span style="color:red;">类或对象的交互以及职责分配</span>**。
## 根据处理范围分类
根据处理范围不同，设计模式又可以分为类模式和对象模式。
### 1.类模式
类模式 **<span style="color:red;">处理类和子类的关系</span>**，通过处理这些关系来建立继承，属于 **<span style="color:red;">静态关系</span>**，在编译时候确定下来。
### 2.对象模式
对象模式 **<span style="color:red;">处理对象之间的关系</span>**，运行时发生变化，属于 **<span style="color:red;">动态关系</span>**。

# 一、创建型

## [简单工厂模式（Simple Factory）](https://github.com/qqqwed/DesignPatterns/tree/master/Creational/SimpleFactory)
>可以根据参数的不同返回不同类的实例。
## 抽象工厂模式（Abstract Factory）
## 工厂方法模式（Factory Method）
## 单例模式（Singleton）
## 建造者模式（Builder）
## 原型模式（Prototype）
## 
## 多例模式（Multiton）
## 对象池模式（Pool）


# 二、结构型

## 适配器模式（Adapter）
## 桥梁模式（Bridge）
## 组合模式（Composite）
## 装饰模式（Decorator）
## 门面模式（Facade）
## 享元模式（Flyweight）
## 代理模式（Proxy）
## 

## 数据映射模式（Data Mapper）
## 依赖注入模式（Dependency Injection）
## 代理模式（Proxy）

# 三、行为型

## 责任链模式（Chain Of Responsibilities）
## 命令行模式（Command）
## 迭代器模式（Iterator）
## 中介者模式（Mediator）
## 备忘录模式（Memento）
## 观察者模式（Observer）
## 状态模式（State）
## [策略模式（Strategy）](https://github.com/qqqwed/DesignPatterns/tree/master/Behavioral/Strategy)
>对象有某个行为，但是在不同的场景下，该行为有不同的实现算法。
## 模板方法模式（Template Method）
## 访问者模式（Visitor）
## 
## 空对象模式（Null Object）
## 规格模式（Specification）
## 

四、更多类型

## 委托模式（Delegation）
## 服务定位器模式（Service Locator）
## 资源库模式（Repository）
## 实体属性值模式（EAV 模式）