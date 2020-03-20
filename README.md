# Message Board
一個具有會員系統、發表留言、回覆留言和按讚功能的留言板
## Getting Started
mysql建立資料庫
```
mysql> create database board;
```

複製env.php內容並修改資料庫參數設定：
```
cp .env.example .env
```

建置資料表：
```
php artisan migrate
```

開啟server：
```
php artisan serve
```
網址列輸入:http://localhost:8000

就會進入註冊畫面，註冊或登入成功後會自動導向主畫面
![](https://i.imgur.com/8zkSzeN.png)


主畫面：顯示所有留言
使用者可在每則留言下進行回覆或按讚，也可點選
點選右上角ADD POST可進行留言(必須先註冊或登入)
![](https://i.imgur.com/SGB3ZbF.png)



編輯留言畫面
![](https://i.imgur.com/2DoPdfg.png)


按讚後，會進入到此畫面，可以看到所有按過這篇留言讚的人，也可以在此收回讚
![](https://i.imgur.com/508Q1kH.png)



針對留言的回覆再做回覆
![](https://i.imgur.com/Gfu2IN4.png)


送出回覆後，會顯示針對這則回覆的所有回覆
![](https://i.imgur.com/DehydjX.png)



點選左上角的BACK可回到上一頁

## Author

* **阿寶** 
