<?php

class ProtectController extends Controller {

	protected $f3;
	protected $db;

	function beforeroute($f3) {
		/*if($this->f3->get('SESSION.gens') === null ) {
			$this->f3->reroute('/login');
			exit;
		}*/
	}

	function afterroute() {
		echo ' .after';
	}

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

	function home($f3) {
		$template= new Template;
		echo $template->render('home.htm');
	}

	function quizz($f3) {
		$template= new Template;
		echo $template->render('quizz.htm');
	}

	function contact($f3) {
		$template= new Template;
		echo $template->render('contact.htm');
	}

	function profil($f3) {
		$template= new Template;
		echo $template->render('profil.htm');
	}

	function liste($f3) {
		$template= new Template;
		echo $template->render('liste.htm');
	}

	function personnality($f3) {
		$template= new Template;
		echo $template->render('perso.htm');
	}

	function résultat($f3) {
		$template= new Template;
		echo $template->render('result.htm');
	}

	function logout($f3) {
		$template= new Template;
		echo $template->render('logout.htm');
	}
}
