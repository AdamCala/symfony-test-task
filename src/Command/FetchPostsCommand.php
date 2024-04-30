<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;

#[AsCommand(
    name: 'app:fetch-posts',
    description: 'Add a short description for your command',
)]
class FetchPostsCommand extends Command
{
    private $httpClient;
    private $entityManager;

    public function __construct(HttpClientInterface $httpClient, EntityManagerInterface $entityManager)
    {
        $this->httpClient = $httpClient;
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('Fetch posts and associated users');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $postsUrl = 'https://jsonplaceholder.typicode.com/posts';
        $usersUrl = 'https://jsonplaceholder.typicode.com/users';
        $postsResponse = $this->httpClient->request('GET', $postsUrl);
        $usersResponse = $this->httpClient->request('GET', $usersUrl);
        $postsData = $postsResponse->toArray();
        $usersData = $usersResponse->toArray();

        $userMap = [];
        foreach ($usersData as $user) {
            $userMap[$user['id']] = $user;
        }

        $consolidatedPosts = [];

        foreach ($postsData as $post) {
            $userId = $post['userId'];
            if (isset($userMap[$userId])) {
                $user = $userMap[$userId];
                $post['user_name'] = $user['name'];
            }
            $consolidatedPosts[] = $post;
        }

        $output->writeln(sprintf('Fetched %d posts.', count($consolidatedPosts)));

        foreach ($consolidatedPosts as $consolidatedPost) {
            $newPost = new Post();
            $newPost->setUserId($consolidatedPost['userId']); // Ustawienie user_id
            $newPost->setUserName($consolidatedPost['user_name']);
            $newPost->setTitle($consolidatedPost['title']);
            $newPost->setBody($consolidatedPost['body']);

            $this->entityManager->persist($newPost);
        }

        $this->entityManager->flush();

        return Command::SUCCESS;
    }
}
