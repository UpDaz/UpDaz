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

        return $htmlContent;
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }

    private function replacePublicImagePath(string $htmlContent): string
    {
        return str_replace('public_img_path/', URL::asset('img') . '/', $htmlContent);
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
