<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\HtmlString;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;

class Markdown implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $markdownContent, array $attributes): string
    {
        $environment = new Environment(
            [
                'allow_unsafe_links' => false,
            ]
        );

        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new TableExtension());

        $converter = new MarkdownConverter($environment);

        $markdownContent = $this->overrideAsideHtmlBlock($markdownContent);
        $htmlContent = new HtmlString($converter->convert($markdownContent)->getContent());
        $htmlContent = $this->replacePublicImagePath($htmlContent);

        return $this->optimizeImages($htmlContent);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }

    private function replacePublicImagePath(string $htmlContent): string
    {
        return str_replace('public_img_path/', URL::asset('img') . '/', $htmlContent);
    }

    /**
     * Serves the WebP sibling of local images when one exists, sizes them to avoid layout shifts
     * and lazy-loads every image except the first one, which may be the LCP element.
     */
    private function optimizeImages(string $htmlContent): string
    {
        $localImageUrl = URL::asset('img') . '/';
        $imageIndex = 0;

        return preg_replace_callback('/<img\s[^>]*>/i', function (array $matches) use ($localImageUrl, &$imageIndex): string {
            $imageTag = $matches[0];
            $isFirstImage = $imageIndex++ === 0;

            if (! preg_match('/\ssrc="([^"]+)"/i', $imageTag, $sourceMatch)) {
                return $imageTag;
            }

            $source = $sourceMatch[1];

            if (str_starts_with($source, $localImageUrl)) {
                $imagePath = public_path('img/' . substr($source, strlen($localImageUrl)));
                $webpPath = preg_replace('/\.(png|jpe?g|gif)$/i', '.webp', $imagePath);

                if ($webpPath !== $imagePath && is_file($webpPath)) {
                    $imageTag = str_replace($source, preg_replace('/\.(png|jpe?g|gif)$/i', '.webp', $source), $imageTag);
                    $imagePath = $webpPath;
                }

                $imageSize = is_file($imagePath) ? @getimagesize($imagePath) : false;

                if ($imageSize && ! preg_match('/\swidth=/i', $imageTag)) {
                    $imageTag = preg_replace('/^<img/i', "<img width=\"{$imageSize[0]}\" height=\"{$imageSize[1]}\"", $imageTag);
                }
            }

            if (! $isFirstImage && ! preg_match('/\sloading=/i', $imageTag)) {
                $imageTag = preg_replace('/^<img/i', '<img loading="lazy" decoding="async"', $imageTag);
            }

            return $imageTag;
        }, $htmlContent);
    }

    private function overrideAsideHtmlBlock(string $content): string
    {
        return str_replace(
            [
                '<aside>',
                '</aside>',
            ],
            [
                '<p class="aside">',
                '</p>',
            ],
            $content
        );
    }
}
