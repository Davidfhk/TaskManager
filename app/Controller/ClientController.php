<?php
namespace TaskManager\Controller;
use TaskManager\Model\Client;
use TaskManager\View\View;
use TaskManager\Model\Pack;


class ClientController
{
	public function index(){
		header('location:profile/');
		die();
	}

	public function profile(){
		session_start();
		if(isset($_SESSION['mail']) && !isset($_POST['logout'])){
			$view = new View('templates/client');
			//echo "Soy un cliente";
			$client = Client::getClientByMail($_SESSION['mail']);
			$packs = Pack::listPacks();
			
			$view->render('profile.php', ['client' => $client, 'pageTitle' => $client->getName() . "'s profile", 'packs' => $packs]);
		}
		else{
			session_destroy();
			header('location:../login/');
		}
	}

	

	public function login(){
		session_start();
		
		//Comprobamos si el cliente ha introducido datos.
		if(isset($_SESSION['mail'])){
			header('location:../profile/');
			die();
		}
		if(isset ($_POST['mail'])){
			//Comprobamos si el mail introducido existe
			//en nuestra base de datos
			if(Client::isClient($_POST['mail'])){
				//Comprobamos si la contraseña coincide.
				if(Client::checkPassword($_POST['mail'], $_POST['password'])){
					
					$_SESSION['user_type'] = 'client';
					$_SESSION['mail'] = $_POST['mail'];
					header('Location:../profile/');
					die();
				}
			}
		}
		$view = new View('templates/client');
		$view->render('login.php', ['pageTitle' => 'Login client']);
	}
}



