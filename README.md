
![Material Screenshot](http://docs.fixframework.com/assets/images/fwbgone.png)

## Hakkında ? 

FIX FRAMEWORK Türkiye'nin ilk yerli kod çatılarından biridir. FIX Framework'ün temel prensibi geliştirici deneyimini en basit ve kolay şekilde okunabilir kod çatısı altında toplamaktır ayrıca sistemin rest api sistemleri ile uyumlu olması sayesinde her türlü uygulama ve prjede alt yapı olarak kullanılabilir. Genel olarak PSR Standartlarına uyum sağlamaya çalışmış olsada kendi düzeni ile öne çıkması amaç alınır bu sayede bu alt yapıyı daha kolay ogrenilmesi ve kolay geliştirilmesi amaç olur. Sistem geliştirme açısında çok başarılıdır genel olarak frameworklerde kernel temel alınır ama bu yapıda kernel tek yapı olmaktan çıkmış olması ile her uygulama kendi hatalarını ve sonuçlarını bireyleştirmiştir. 


## Çıkış Noktası

FIX Framework 2015 yılına uzanmaktadır ilk sürümü Geliştiricimiz `Cengiz AKCAN`'ın Yazılım GELİŞTİRİCİ Oldugu bir ajansta boş bir gününde ilk framework'ü yazması ile başladı bu sistemi benimsedi ve önemsedi çünki genel olarak internet üzerinde yayında olan hali hazırdaki platformlar `çok karışık yapılar`, `profesyonellik gereksinimleri` ve  `Sistem yoran ve bağımsız` olmayanlar ile dolu olması üzerine FIX Framework'ü geliştirme kararı alır bunun üzerine `2017`'de Tekrar başlar ve şuan beta sürümü ile tam bağımsız olarak sizlerle. 


## Katkılarınız

Projenin gelişmesinde katkınızın olmasını istiyorsanız temel basitlik ilkesine ön görüp temiz kod yapısı ile sistem geliştirmesinde destek verebilirsiniz ve bu verdiginiz katkı kullanıcı kitlesine `ücretsiz` sunulur.

 - Güncel PHP yenilikleri takip edilerek geliştirilmektedir.
 - EIP ve MVC Mimarileri Üzerine İnşa Edilmiştir.
 - EIP ve MVC Mimarileri Üzerine İnşa Edilmiştir.
 - Çoklu Uygulama(Multi Application) Geliştirilebilir.
 - Sunucu yada Hosta Bağlı Çoklu Uygulama Kullanımı için Ortak (Bireysel) Platform Kullanımı Sağlar.
 - Farklı Hosting Hesapları ile Uyumludur ve Hiçbir Ayar Gereksinimi Yoktur. 
 - SEO Uyumlu URL Yapısını Destekler.
 - Güçlü Autoloader(Otomatik Yükleme) Sistemine Sahiptir.
 - Kütüphanelere Erişim Oldukça Kolaydır ve Dahil Edilme Gerektirmez.
 - Sistem Saf Olarak Sunuculur Kullanılan Kütüphabeler Tanımlama Yapılır ve Kullanılacak Fonksiyonlar Çağrılır.
 - Güvenlik Önlemleri Alınmıştır.

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