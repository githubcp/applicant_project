<?php



class PostsController extends AppController
{
	public $helpers = array('Form');
    
    public function index()
    {
    	$this->set('posts', $this->Post->find('all'));
    }
	
	public function view($id = null)
	{
		$post = $this->Post->findById($id);
		$this->set('post', $post);
	}
}
?>