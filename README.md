# SeoTitan
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
# Kullanım
App/Controllers/Frontend/Index.php dosyası içeriği;
```php
<?php
// --- [+] /App/Controllers/Frontend/Index.php --- //

namespace App\Controllers\Frontend;

use System\Kernel\Controller;
use View, Seo, Sitemap;

class Index extends Controller
{
	public function index()
	{
	    $data['meta']    = Seo::Meta('başlık', 'açıklama', 'yazar_ismi');
	    $data['og']      = Seo::OpenGraph('tip, 'başlık', 'açıklama', 'site_ismi', 'url', 'resim_url', 'locale', 'yayınlama_zamanı', 'yazar_ismi');
	    $data['twitter'] = Seo::TwitterCard('site_ismi', 'başlık', 'açıklama', 'resim_url');
	    View::render('frontend.index.index', $data);
	}
}
?>
```

App/Views/frontend.blade.php içeriği;
```html
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width"/>
    @if(isset($meta))
       @foreach($meta as $item)
       {!! $item !!}
       @endforeach
    @endif
```

# Dokümantasyon
Daha fazla kullanım için http://www.msbeden.com/makale/seotitan adresini ziyaret edebilirsiniz.

# Lisans
SeoTitan is released under the MIT license.
