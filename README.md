## Amaçlar

- Temiz kod Yapısı
- Temiz Uygulamalar
- Temiz Sistem
- Okunabilir Kod Yapısı
- Geliştirilebilir Kod Yapısı
- AŞK


## Basit Başlangıç

Basit `Controller`:

```php
class home
{

	public function home(){

      // This is function __construct();

	}
    
    public function index(){

        echo "Merhaba";

    }

}
```

## Minimum Gereksinimler

 - `php 5.4` Genel Gereksinim

## Otomatik Kurulum

 - Dosya kurulum işlemini konsoldan yada terminalden yapabilirsiniz.
 - Composer kurulu olması lazımdır dosya kurulum işlemini yapmanız için

```sh
composer create-project --dev fixframework/beta:dev-master
```

## Manuel Kurulum

Şimdi yapmanız geren işlem [FİX FRAMWORK](https://github.com/FixFramework/) girmek ve istediginiz sümü indirmek.


## Creator

### Creator ile uygulama oluşturma

 - Ana dizindeki index.php açınız.
 
```php
    /* System Application Creator true | false */
    define("FIX_CREATOR",false);
	
	/* System Application Creator Access IP */
    define("FIX_CREATOR_IP","95.7.97.100");
	
```	
	
 -  `FIX_CREATOR` Parametresinin değerini true yapınız.
 -	Şimdi uygulama oluşturacagınız ip yada url giriniz url adresinden sonra `/creator` yani `http://xxxxx.xx/creator` bu ekilde bir adrese erişeceksiniz.
 - 	Çalışma alanınız `127.0.0.1` ise `FIX_CREATOR_IP` değeri 	`127.0.0.1`. 
 - 	Çalışma alanınız `localhost` ise `FIX_CREATOR_IP` değeri 	`::1`.
 - 	Çalışma alanınız `xxxxx` ise `FIX_CREATOR_IP` değeri 	`ip numaranız olacaktır`. 
 
 ### Creator Tanıtım Adımlar
 
 - `Application` yazan yer sizin kurulum yapacgınız `uygulama` yada `web sitesi` bu alana karışmıyoruz.
 - `Default Controller` yazan yere kendi ana `controller` isminizi giriniz ve türkçe ve özel karekter kullanmadan.
 - `Default Function` yazan yere kendi ana `function` isminizi giriniz ve türkçe ve özel karekter kullanmadan.
	- `NOT:` Bu `function` ismi `controller` ismi ile aynı olmayacaktır.
 - `Error Page` bu default olacak `/` yani anasayfa'ya yönlendirilmiştir ama kendi hata sayfanızı oluşturup yönlendirebilirsiniz.
 - Uygulama değer alma methodu `Default`  `GET`'dir çünkü genel bir kapsayıcıdır. Uygulama içerisindeki tüm uygulamaları etkiler eğer `config.json` dosyasındaki  `receiver` degerini değiştirirseniz url yapılandırmasını `index.php?receiver_degeri=` olarak kullanırsınız böyle kullanılmasını istemiyorsanız `.htaccess` içerisndeki `url` receiver` degerini değiştirdiğiniz `receiver` degeri yapınız.
 - Veritabanı Bilğilerinizi giriniz.
 - Değerleri girdikten sonra `CREATE` tıklayınız ve ardından uygulama dosyanız oluşacaktır.
 - Diğer tüm ayarları uygulama dosyası içerisinde bulunan `config.json` açarak yapabilirsiniz.
 - `NOT` : her bir ayar hendi uygulaması için geçerlidir yani tüm uygulamalar bireyseldir.
 
 
```json
{
"controller":"home",
"function":"index",
"arguments":[],
"error":"\/",
"receiver":"url",
"method":"get",
"database":{
	"pdo":{
		"host":"",
		"username":"",
		"password":"",
		"table":"",
		"charset":"utf8"
	}
},
"maintenance_mode":[],
"maintenance_mode_url":[],
"forbidden":[],
"forbidden_mode_url":[]
}
``` 



## Manuel


 - Aşşağıdaki şekilde klasör yapısını oluşturunuz.
 
 - `Application`
	- Uygulama ismi ` URL - IP`
		- `cache` 
		- `controllers`
			- `Ana Controller`
				- `Ana Class ve Function`
		- `hooks`
		- `models`
		- `storage`
		- `views`
		- `config.json`


 # `controller` oluşturun. 
	
```php
<?php

/*
*	Adding Library
*/
use System\Fix\Fix;


/*
*	Start home Master Controller 
*/
class home
{

	public function home(){

      // This is function __construct();

	}


    public function index(){

        /*
         *
         * Welcome Fix Framework
         * Write For Yourself
         * Code Love
         * Code Life
         *
         * */
        echo Fix::show();

    }


}
```
 - Bu dosyayı `Applications/uygulama_adı/controllers/` klasörüne `home.php` isimde kaydediniz
 
 # Uygulama ayar dosyası olan config.json oluşturun 
 ```json
{
"controller":"home",
"function":"index",
"arguments":[],
"error":"\/",
"receiver":"url",
"method":"get",
"database":{
	"pdo":{
		"host":"",
		"username":"",
		"password":"",
		"table":"",
		"charset":"utf8"
	}
},
"maintenance_mode":[],
"maintenance_mode_url":[],
"forbidden":[],
"forbidden_mode_url":[]
}
``` 

 - Bu dosyayı `Applications/uygulama_adı/` klasörüne `config.json` isimde kaydediniz
