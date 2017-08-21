<?php
require_once $_SERVER['DOCUMENT_ROOT']."/mystory/vendor/autoload.php";

use \Classes\Member\MemberRepository;
use \Classes\Story\StoryService;
use \Classes\Validation\Input;
$app = new \Slim\App;


$app->post('/like/story/{storyId}', function ($request, $response, $args) {

    if ($request->hasHeader('Authorization')) {
        $apiKey = $request->getHeader('Authorization')[0];
        $bodyData = $request->getParsedBody();

        $objStoryService = new StoryService();
        $objMemberRepository = new MemberRepository();
        if ($user_id = $objMemberRepository->isValidApiKey($apiKey)) {
            if (count($bodyData)) {
                if ($objStoryService->countStoryLikeByUser($args['storyId'], $bodyData['userId'])) {
                    $objStoryService->removeStoryLikeOfUser($args['storyId'], $bodyData['userId']);

                    $count = $objStoryService->countStoryLikes($args['storyId']);
                    $data = [
                        'error' => false,
                        'likeCount' => $count,
                        'liked' => false
                    ];
                    return $response->withJson($data);

                }
                $objStoryService->likeStory($args['storyId'], $bodyData['userId']);
                $count = $objStoryService->countStoryLikes($args['storyId']);
                $data = [
                    'error' => false,
                    'likeCount' => $count,
                    'liked' => true
                ];
                return $response->withJson($data);
            }
        }
    }

    $data = [
        'error' => true,
        'message' => 'Failed to like'
    ];
    return $response->withJson($data);

});




$app->post('/like/comment/{commentId}', function ($request, $response, $args) {
    if ($request->hasHeader('Authorization')) {
        $apiKey = $request->getHeader('Authorization')[0];
        $bodyData = $request->getParsedBody();

        $objStoryService = new StoryService();
        $objMemberRepository = new MemberRepository();
        if ($user_id = $objMemberRepository->isValidApiKey($apiKey)) {
            if (count($bodyData)) {
                if ($objStoryService->countCommentLikeByUser($bodyData['storyId'], $bodyData['userId'], $args['commentId'])) {
                    $objStoryService->removeCommentLikeOfUser($bodyData['storyId'], $bodyData['userId'], $args['commentId']);

                    $count = $objStoryService->countCommentLikes($bodyData['storyId'], $args['commentId']);
                    $data = [
                        'error' => false,
                        'likeCount' => $count,
                        'liked' => false
                    ];
                    return $response->withJson($data);

                }
                $objStoryService->likeComment($bodyData['storyId'], $bodyData['userId'], $args['commentId']);
                $count = $objStoryService->countCommentLikes($bodyData['storyId'], $args['commentId']);
                $data = [
                    'error' => false,
                    'likeCount' => $count,
                    'liked' => true
                ];
                return $response->withJson($data);
            }
        }
    }

    $data = [
        'error' => true,
        'message' => 'Failed to like'
    ];
    return $response->withJson($data);

});


$app->post('/like/reply/{replyId}', function ($request, $response, $args) {
    if ($request->hasHeader('Authorization')) {
        $apiKey = $request->getHeader('Authorization')[0];
        $bodyData = $request->getParsedBody();

        $objStoryService = new StoryService();
        $objMemberRepository = new MemberRepository();
        if ($user_id = $objMemberRepository->isValidApiKey($apiKey)) {
            if (count($bodyData)) {
                if ($objStoryService->countReplyLikeByUser($bodyData['storyId'], $bodyData['userId'], $bodyData['commentId'], $args['replyId'])) {
                    $objStoryService->removeReplyLikeOfUser($bodyData['storyId'], $bodyData['userId'], $bodyData['commentId'], $args['replyId']);

                    $count = $objStoryService->countReplyLikes($bodyData['storyId'], $bodyData['commentId'], $args['replyId']);
                    $data = [
                        'error' => false,
                        'likeCount' => $count,
                        'liked' => false
                    ];
                    return $response->withJson($data);

                }
                $objStoryService->likeReply($bodyData['storyId'], $bodyData['userId'], $bodyData['commentId'], $args['replyId']);
                $count = $objStoryService->countReplyLikes($bodyData['storyId'], $bodyData['commentId'], $args['replyId']);
                $data = [
                    'error' => false,
                    'likeCount' => $count,
                    'liked' => true
                ];
                return $response->withJson($data);
            }
        }
    }

    $data = [
        'error' => true,
        'message' => 'Failed to like'
    ];
    return $response->withJson($data);

});

