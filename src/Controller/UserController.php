<?php

namespace Acme\Controller;

use Acme\Repository\UserRepository;
use Acme\Documents\User;
use Acme\Documents\BlogPost;
use \PlugRoute\Http\Request as Request;
use \PlugRoute\Http\Response as Response;
use Doctrine\ODM\MongoDB\DocumentManager;
use DateTime;

Class UserController
{	
	private $response;
    private $userRepository;
    protected $user;
    protected $blogPost;

    function __construct(UserRepository $userRepository, Response $response, User $user, BlogPost $blogPost) 
    {
    	$this->userRepository = $userRepository;
    	$this->response = $response;
    	$this->user = $user;
    	$this->blogPost = $blogPost;
    }

	public function list()
	{	
		$data = array();
		$data_post = array();
		$users = $this->userRepository->findAll();

		foreach ($users as $user) {	
			$posts = $user->getPosts()->toArray();
						
			foreach ($posts as $post) {
				$data_post = [
					"id" => $post->getId(),
					"title" => $post->getTitle(),
					"body" => $post->getBody(),
					"createdAt" => $post->getCreatedAt()
				];
			}

			$data[] = [
				"id" => $user->getId(),
				"name" => $user->getName(),
				"email" => $user->getEmail(),
				"posts" => $data_post
			];

			$posts = null;
		}

		if (count($data) > 0) {
			return $this->response->setStatusCode(200)->json($data);
		}
		return $this->response->setStatusCode(400)->json(['msg' => 'Not found users']);
	}

	public function find(Request $request)
	{
		$id = $request->parameter('id');
		$user = $this->userRepository->findById($id);

		if (!is_null($user)) {

			$posts = $user->getPosts()->toArray();
			
			foreach ($posts as $post) {
				$data_post = [
					"id" => $post->getId(),
					"title" => $post->getTitle(),
					"body" => $post->getBody(),
					"createdAt" => $post->getCreatedAt()
				];
			}

			$data = [
				"id" => $user->getId(),
				"name" => $user->getName(),
				"email" => $user->getEmail(),
				"posts" => $data_post
			];
		
			return $this->response->setStatusCode(200)->json($data);
		}
		return $this->response->setStatusCode(400)->json(['msg' => 'Not found user']);
	}

	public function storage(Request $request)
	{	
		$this->blogPost->setTitle($request->input('title'));
		$this->blogPost->setBody($request->input('body'));
		$this->blogPost->setCreatedAt(new DateTime());

		$this->user->setName($request->input('name'));
		$this->user->setEmail($request->input('email'));
		$this->user->addPost($this->blogPost);

		$this->userRepository->save($this->user);

		if (!is_null($this->user->getId())) {
			return $this->response->setStatusCode(200)->json(['msg' => "Created user id {$this->user->getId()}"]);
		}
		return $this->response->setStatusCode(400)->json(['msg' => 'Not created user']);
	}

	public function update(Request $request)
	{
		$id = $request->parameter('id');
		$this->user = $this->userRepository->findById($id);

		if (!is_null($this->user)) {
					
			$this->blogPost->setTitle($request->input('title'));
			$this->blogPost->setBody($request->input('body'));
			$this->blogPost->setCreatedAt(new DateTime());

			$this->user->setName($request->input('name'));
			$this->user->setEmail($request->input('email'));
			$this->user->addPost($this->blogPost);

			$this->userRepository->save($this->user);		

			return $this->response->setStatusCode(200)->json(['msg' => 'Update user successfully']);
		}
		return $this->response->setStatusCode(400)->json(['msg' => 'Not found user']);
	}

	public function delete(Request $request)
	{	
		$id = $request->parameter('id');
		$user = $this->userRepository->findById($id);

		if (!is_null($user)) {
			$this->userRepository->remove($user);
			return $this->response->setStatusCode(200)->json(['msg' => 'Deleted user successfully']);
		}
		return $this->response->setStatusCode(400)->json(['msg' => 'Not deleted user']);
	}
}