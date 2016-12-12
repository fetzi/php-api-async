<?php


namespace App\Services;


use App\Models\Article;
use App\Repositories\ArticleRepository;
use GuzzleHttp\Exception\ServerException;

class ArticleService
{
    /** @var ArticleRepository */
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function get()
    {
        $articles = [];

        try {
            $data = $this->articleRepository->get();

            foreach ($data as $item) {
                $articles[] = new Article($item['title'], $item['snippet'], $item['image']);
            }
        }
        catch (ServerException $exception) {
            session()->flash("article-status", sprintf("%d: Unable to load blog articles", $exception->getCode()));
        }

        return $articles;
    }

    public function getAsync()
    {
        return $this->articleRepository->getAsync()->then(
            function($data) {
                $articles = [];

                foreach($data as $item) {
                    $articles[] = new Article($item['title'], $item['snippet'], $item['image']);
                }

                return $articles;
            },
            function($exception) {
                session()->flash("article-status", sprintf("%d: Unable to load blog articles", $exception->getCode()));
                return [];
            }
        );
    }
}