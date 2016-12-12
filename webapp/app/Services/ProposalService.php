<?php


namespace App\Services;


use App\Models\Proposal;
use App\Repositories\ProposalRepository;
use GuzzleHttp\Exception\ServerException;

class ProposalService
{
    /** @var ProposalRepository */
    private $proposalRepository;

    public function __construct(ProposalRepository $proposalRepository)
    {
        $this->proposalRepository = $proposalRepository;
    }

    public function get()
    {
        $proposals = [];

        try {
            $data = $this->proposalRepository->get();

            foreach ($data as $item) {
                $proposals[] = new Proposal($item['title']);
            }
        }
        catch(ServerException $exception) {
            session()->flash("proposal-status", sprintf("%d: Unable to load proposals", $exception->getCode()));
        }

        return $proposals;
    }

    public function getAsync()
    {
        return $this->proposalRepository->getAsync()->then(
            function($data) {
                $proposals = [];

                foreach($data as $item) {
                    $proposals[] = new Proposal($item['title']);
                }

                return $proposals;
            },
            function($exception) {
                session()->flash("proposal-status", sprintf("%d: Unable to load proposals", $exception->getCode()));
                return [];
            }
        );
    }
}