<?php

$faker = \Faker\Factory::create();

$app->get('/user', function($request, $response, $args) use ($faker) {
    $users = [];

    for($i = 0; $i < 10; $i++) {
        $users[] = [
            "firstname" => $faker->firstName,
            "lastname" => $faker->lastName,
            "email" => $faker->email
        ];
    }

    usleep(100000);

    //return $response->withStatus(500);
    return $response->withJson($users);
});

$app->get('/blog', function($request, $response, $args) use ($faker) {
    $articles = [];

    for($i = 0; $i < 5; $i++) {
        $articles[] = [
            "title" => $faker->text(20),
            "snippet" => $faker->text(50),
            "image" => $faker->imageUrl(100, 100)
        ];
    }

    usleep(200000);

    //return $response->withStatus(500);
    return $response->withJson($articles);
});

$app->get('/proposals', function($request, $response, $args) use ($faker) {
    $articles = [];

    for($i = 0; $i < 5; $i++) {
        $articles[] = [
            "title" => $faker->text(40)
        ];
    }

    usleep(300000);

    //return $response->withStatus(500);
    return $response->withJson($articles);
});