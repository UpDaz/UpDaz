<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\HtmlString;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;

class Markdown implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $markdownContent, array $attributes)
    {
        $environment = new Environment([
            'allow_unsafe_links' => false,
        ]);

        $environment->addExtension(new CommonMarkCoreExtension);
        $environment->addExtension(new TableExtension);

        $converter = new MarkdownConverter($environment);

        $markdownContent = $this->overrideAsideHtmlBlock($markdownContent);
        $htmlContent = new HtmlString($converter->convert($markdownContent)->getContent());
        $htmlContent = $this->replacePublicImagePath($htmlContent);
        return $htmlContent;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }

    private function replacePublicImagePath($htmlContent)
    {
        return str_replace("public_img_path/", URL::asset('img') . '/', $htmlContent);
    }

    private function overrideAsideHtmlBlock($content)
    {
        return str_replace([
            '<aside>', 
            '</aside>',
        ],
        [
            '<p class="aside">',
            '</p>',
        ], $content);
    }
}
