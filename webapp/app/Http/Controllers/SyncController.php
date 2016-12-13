<?php


namespace App\Http\Controllers;

use App\Services\ArticleService;
use App\Services\ProposalService;
use App\Services\UserService;

class SyncController extends Controller
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

    public function sync()
    {
        session()->flush();
        $start = $this->microtime_float();

        $users = $this->userService->get();
        $articles = $this->articleService->get();
        $proposals = $this->proposalService->get();

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