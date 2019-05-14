# SeoTitan Fonksiyonları
Titan2 framework için yazılmış olan seo fonksiyonlarını içerir

# Kurulum
İndirilen dosyaların titan2 dizinine kopyalanması gerekir.

# Provider Tanımlama
Provider tanımlamak için, kütüphanenin namespace'i, providers anahtarına eklenir.

```php
// --- [+] /App/Config/Services.php --- //
'providers' => [
	'Seo'               => 'App\Libs\SeoTitan\Seo',
],
```
# Facade Tanımlama
Yukarıdaki örnekte oluşturulan facade sınıfına ait namespace, /App/Config/Service.php dosyasında bulunan facades anahtarında tanımlanır.
```php
// --- [+] /App/Config/Services.php --- //
'facades' => [
	'Seo'               => 'System\Facades\Seo',
],
```

# Dokümantasyon
http://www.msbeden.com/makale/seotitan 

# Lisans
SeoTitan is released under the MIT license.
