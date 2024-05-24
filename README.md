## PHP常用开发工具包

受 [Hutool](https://hutool.cn/) 启发，于是整理一个PHP开发工具包，欢迎大家共建，完善。

### 使用

```
composer require shayvmo/shayvmo-utils
```

### 日期时间 DateUtil 类

#### 返回DateTime

```
// 返回DateTime
DateUtil::date(); // 返回当前时间
DateUtil::date(time()); // 也可以指定时间戳
```

#### 格式化日期

```
// 返回常用格式日期 Y-m-d H:i:s
DateUtil::format(); // 返回当前时间
DateUtil::format(time()); // 也可以指定时间戳

// 自定义格式化日期
DateUtil::formatCustom(time(), "c");// 2024-05-23T18:23:56+08:00
DateUtil::formatDate();// Y-m-d
DateUtil::formatTime();// H:i:s
DateUtil::formatISO();// 2024-05-23T18:23:56+08:00

```

#### 开始和结束时间

```
// 一天开始和结束时间
DateUtil::beginOfDay(time());// 2024-05-24 00:00:00
DateUtil::endOfDay(time());// 2024-05-24 23:59:59
```

#### 日期时间偏移

```
// 一年后
DateUtil::offset("2024-05-24 10:00:00", DateField::YEAR, 1);

// 一天后
DateUtil::offsetDay("2024-05-24 10:00:00", 1);

//昨天
DateUtil.yesterday();
//明天
DateUtil.tomorrow();
//上周
DateUtil.lastWeek();
//下周
DateUtil.nextWeek();
//上个月
DateUtil.lastMonth();
//下个月
DateUtil.nextMonth();
```

#### 日期时间差

有时候我们希望看到易读的时间差，比如XX天XX小时XX分XX秒，此时使用`DateUtil::formatBetween`方法

```
// 相差天数
DateUtil::between(strtotime("2024-05-01"), strtotime("2024-05-03"), DateUnit::DAY);

// DateLevel::SECOND 表示精确到秒
DateUtil::formatBetween(500, DateLevel::SECOND);// 8分钟19秒
```
