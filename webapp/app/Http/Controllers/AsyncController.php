<?php


namespace App\Http\Controllers;

use App\Services\ArticleService;
use App\Services\ProposalService;
use App\Services\UserService;

class AsyncController extends Controller
{
    /** @var UserService */
    private $userService;

    /** @var ArticleService */
    private $articleService;

    /** @var ProposalService */
    private $proposalService;

    public function __construct(UserService $userService, ArticleService $articleService, ProposalService $proposalService)
    {
        $this->userService = $userService;
        $this->articleService = $articleService;
        $this->proposalService = $proposalService;
    }

    public function async()
    {
        session()->flush();

        $start = $this->microtime_float();
        $userPromise = $this->userService->getAsync();
        $articlePromise = $this->articleService->getAsync();
        $proposalPromise = $this->proposalService->getAsync();

        $userPromise->then(function($data) use (&$users) {
            $users = $data;
        });

        $articlePromise->then(function($data) use (&$articles) {
            $articles = $data;
        });

        $proposalPromise->then(function($data) use (&$proposals) {
            $proposals = $data;
        });

        $this->wait($userPromise, $articlePromise, $proposalPromise);

        $end = $this->microtime_float();
        $duration = round($end - $start, 2);

        return view('welcome', compact('users', 'articles', 'proposals', 'duration'));
    }

    private function microtime_float()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
}