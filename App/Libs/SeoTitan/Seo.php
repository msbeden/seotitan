<?php
/**
 * Created by PhpStorm.
 * User: mehmet
 * Date: 14.05.2019
 * Time: 09:57
 */

namespace App\Libs\SeoTitan;

class Seo
{
    public static function Meta($title, $description, $author)
    {
        $meta = [
            'title'         => '<title>'.$title.'</title>',
            'description'   => '<meta name="description" content="'.$description.'" />',
            'author'        => '<meta name="author" content="'.$author.'" />'
        ];
        return $meta;
    }

    public static function OpenGraph($type='article', $title, $description, $site_name, $url, $image, $locale='tr_TR', $published_time='', $author='')
    {
        if(is_array($image)) {
            $array_image = [];
            foreach ($image as $item)
            {
                $imageData = getimagesize($item);
                array_push($array_image, '<meta property="og:image" content="'.$item.'" />
                <meta property="og:image:width" content="'.$imageData[0].'" />
                <meta property="og:image:height" content="'.$imageData[1].'" />');
            }
        } else {
            $imageData  = getimagesize($image);
            $array_image = '<meta property="og:image" content="'.$image.'" />
            <meta property="og:image:width" content="'.$imageData[0].'" />
            <meta property="og:image:height" content="'.$imageData[1].'" />';
        }

        if($type == 'article') {
            $article = [
                'published_time'=> '<meta property="article:published_time" content="'.$published_time.'" />',
                'author'        => '<meta property="article:author" content="'.$author.'" />'
            ];
        } else {
            $article = [];
        }

        $openGraph = [
            'type'          => '<meta property="og:type" content="'.$type.'" />',
            'title'         => '<meta property="og:title" content="'.$title.'" />',
            'description'   => '<meta property="og:description" content="'.$description.'" />',
            'locale'        => '<meta property="og:locale" content="'.$locale.'" />',
            'site_name'     => '<meta property="og:site_name" content="'.$site_name.'" />',
            'url'           => '<meta property="og:url" content="'.$url.'" />',
            'image'         => $array_image,
        ];

        array_merge($openGraph, $article);
        return array_merge($openGraph, $article);
    }

    public static function TwitterCard($site, $title, $description, $image)
    {
        $twitterCard = [
            'card'          => '<meta name="twitter:card" content="summary_large_image">',
            'site'          => '<meta name="twitter:site" content="@'.$site.'">',
            'title'         => '<meta name="twitter:title" content="'.$title.'">',
            'description'   => '<meta name="twitter:description" content="'.$description.'">',
            'image'         => '<meta name="twitter:image" content="'.$image.'">'
        ];

        return $twitterCard;
    }

    public static function MicroData($headline, $description, $date, $image, $imageAlt, $author, $publisher, $publisherLogo, $publisherLogoAlt, $body)
    {
        $imageData = getimagesize($image);
        return '
        <div itemscope itemtype="http://schema.org/NewsArticle">
            <h1 itemprop="headline">'.$headline.'</h1>
            <span itemprop="datePublished" content="'.$date.'">'.$date.'</span>
            <span itemprop="description">'.$description.'</span><br>
            <div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
                <meta itemprop="height" content="'.$imageData[1].'">
                <meta itemprop="width" content="'.$imageData[0].'">
                <meta itemprop="url" content="'.$image.'">
                <img src="'.$image.'" alt="'.$imageAlt.'">
            </div>
            Author: <span itemprop="author">'.$author.'</span><br>
            <div itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
                <div itemprop="logo" itemscope itemtype="http://schema.org/ImageObject">
                    <meta itemprop="url" content="'.$publisherLogo.'">
                    <img src="'.$publisherLogo.'" alt="'.$publisherLogoAlt.'">
                </div>
                <span itemprop="name">'.$publisher.'</span>
            </div>
            <span itemprop="articleBody">'.$body.'</span>
        </div>';
    }

    public static function JSON_LD($headline, $description, $date, $image, $author, $publisher, $publisherLogo, $body)
    {
        $imageData = getimagesize($image);
        return '
        <script type="application/ld+json">
        {
          "@context": "http://schema.org/",
          "@type": "NewsArticle",
          "headline": "'.$headline.'",
          "datePublished": "'.$date.'",
          "description": "'.$description.'",
          "image": {
            "@type": "ImageObject",
            "height": "'.$imageData[1].'",
            "width": "'.$imageData[0].'",
            "url": "'.$image.'"
          },
          "author": "'.$author.'",
          "publisher": {
            "@type": "Organization",
            "logo": {
              "@type": "ImageObject",
              "url": "'.$publisherLogo.'"
            },
            "name": "'.$publisher.'"
          },
          "articleBody": "'.$body.'"
        }
        </script>';
    }
}