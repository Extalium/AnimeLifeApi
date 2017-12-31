<?php
class MainController extends Controller{

	protected $f3;
	protected $db;

	function __construct() {

		$f3=Base::instance();
		$this->f3=$f3;

		$db = new DB\SQL (
			$f3->get('devdb'),
			$f3->get('devdbusername'),
			$f3->get('devdbpassword'),
			array( \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
		);

		$this->db=$db;
	}

	function render($f3) {
		/*$messages = new Messages($this->db);
		$msg = $messages->all()[0];

		$f3->set('msg',$msg);*/
		$template= new Template;
		echo $template->render('template.htm');
	}

	function freeContact($f3) {
		$template= new Template;
		echo $template->render('freeContact.htm');
	}

	function personalityForUser($f3) {
		$template= new Template;
		echo $template->render('personality.htm');
	}

	function créercompte($f3) {
		$template= new Template;
		echo $template->render('signup.htm');
	}

	function login($f3) {
		$template= new Template;
		echo $template->render('login.htm');
	}

	function reinitialiser($f3) {
		$template= new Template;
		echo $template->render('reset_password.htm');
	}

	function error($f3) {
		$template= new Template;
		echo $template->render('error.htm');
	}

	function render1($f3) {
		$template= new Template;
		echo $template->render('template1.htm');
	}

	function freeContact1($f3) {
		$template= new Template;
		echo $template->render('freeContact1.htm');
	}

	function personalityForUser1($f3) {
		$template= new Template;
		echo $template->render('personality1.htm');
	}

	function login1($f3) {
		$template= new Template;
		echo $template->render('login1.htm');
	}

	function getAnime($f3) {
		header("Access-Control-Allow-Origin: *");
		$anime = new Membres($this->db);
		$data = $anime->all();
		$json = array();
		$compt = array('id','title','author','email','image','date');
		$c = 0;
		foreach ($data as $row) {
			$item = array();
			foreach ($row as $key => $value) {
				$key = $compt[$c];
				$item[$key] = $value;
				$c++;
			}
			$c = 0;
			array_push($json,$item);
		}	
		$categorie = array('anime' => $json);
		

	//	$arr = array('json' => 'id' = )
		echo json_encode($categorie,3);
	}

	function deleteAnime($f3) {
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: origin, x-requested-with, content-type, accept');
		header('Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE');
		$data = $this->f3->get('PARAMS.id');
		$tab = array();
    	$tab = explode("=", $data); 
    	$id = (int) $tab[1];
		echo("test");
        $gens = new Membres($this->db);
        $this->db->exec('DELETE FROM membres WHERE id=?',$id);
     //   $gens->load(array('id=?',$id));
      //  $gens->erase();
   	//	$gens->delete($id);
	}

	function addAnime($f3) {
		header('Access-Control-Allow-Origin: *');
	//	'always_populate_raw_post_data' = -1;
		header('Access-Control-Allow-Headers: origin, x-requested-with, content-type, accept');
		header('Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT');
		$id = 1;
		$anime = new Membres($this->db);
		$post = new Membres($this->db);
        $anime->getById($id);
        while(!$anime->dry()) {
        	$anime->getById($id++);
        }
        unset($anime);
        if ($id>1) $id--;
	/*	$data = $this->f3->get('PARAMS.id');
		$tab = array();
    	$tab = explode("=", $data); 
    	$id = (int) $tab[1];*/
		echo("test");
		$data = file_get_contents("php://input");
	//	echo getcwd();
	//	$data = file_get_contents('/home/hosting/projet/kidsprofiler/test.json');
		$json = json_decode($data);
		//echo $test = $json->id;
		echo $title = $json->title;
		echo $author = $json->author;
		echo $image = $json->image;
		echo $date = $json->date;
		$this->f3->set('POST.username',$title);
		$this->f3->set('POST.password',$author);
		$this->f3->set('POST.avatar',$image);
		$this->f3->set('POST.signup_date',$date);
		$this->f3->set('POST.email','yolo');
		$this->f3->set('POST.id',$id);
		$post->add();
	//	$data = $this->f3->get('POST.title');
	//	echo $data;
    //    $gens = new Membres($this->db);
     //   $this->db->exec('DELETE FROM membres WHERE id=?',$id);
     //   $gens->load(array('id=?',$id));
      //  $gens->erase();
   	//	$gens->delete($id);
	}

	function editAnime($f3) {
		header('Access-Control-Allow-Origin: *');
	//	'always_populate_raw_post_data' = -1;
		header('Access-Control-Allow-Headers: origin, x-requested-with, content-type, accept');
		header('Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT');
		$post = new Membres($this->db);
		echo("test");
		$data = file_get_contents("php://input");
	//	echo getcwd();
	//	$data = file_get_contents('/home/hosting/projet/kidsprofiler/test.json');
		$id = $this->f3->get('PARAMS.id');
		$tab = array();
    	$tab = explode("=", $id); 
    	$id = (int) $tab[1];
		$json = json_decode($data);
		//echo $test = $json->id;
		echo $title = $json->title;
		echo $author = $json->author;
		echo $image = $json->image;	
		echo $date = $json->date;
		echo $id;
		$this->f3->set('POST.username',$title);
		$this->f3->set('POST.password',$author);
		$this->f3->set('POST.avatar',$image);
		$this->f3->set('POST.signup_date',$date);
		$this->f3->set('POST.email','yolo');
		$this->f3->set('POST.id',$id);
		$this->db->exec('UPDATE membres SET username=?, password=?,avatar=?,signup_date=?  WHERE id=?',array($title,$author,$image,$date,$id));
	//	$post->load(array('id=?',$id));
	//	$post->copyFrom('POST');
	//	$post->update();
	//	$data = $this->f3->get('POST.title');
	//	echo $data;
    //    $gens = new Membres($this->db);
     //   $this->db->exec('DELETE FROM membres WHERE id=?',$id);
     //   $gens->load(array('id=?',$id));
      //  $gens->erase();
   	//	$gens->delete($id);
	}
}
	