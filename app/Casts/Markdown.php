<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\HtmlString;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;

class Markdown implements CastsAttributes
{
    /**
     * Method get
     *
     * @param $model $model [explicite description]
     * @param string $key [explicite description]
     * @param $markdownContent $markdownContent [explicite description]
     * @param array $attributes [explicite description]
     *
     * @return string
     */
    public function get($model, string $key, $markdownContent, array $attributes): string
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
        return $htmlContent;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @param  string                              $key
     * @param  mixed                               $value
     * @param  array                               $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }

    /**
     * Method replacePublicImagePath
     *
     * @param string $htmlContent [explicite description]
     *
     * @return String
     */
    private function replacePublicImagePath(string $htmlContent): string
    {
        return str_replace("public_img_path/", URL::asset('img') . '/', $htmlContent);
    }

    /**
     * Method overrideAsideHtmlBlock
     *
     * @param string $content [explicite description]
     *
     * @return string
     */
    private function overrideAsideHtmlBlock($content): string
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
