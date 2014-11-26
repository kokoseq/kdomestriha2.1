<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	
	/**
	 * Zobrazeni stranky pro registraci
	 */
	public function actionRegister()
	{	
		$model=new RegistrationForm();
	
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	
		// collect user input data
		if(isset($_POST['RegistrationForm']))
		{
			$model->attributes=$_POST['RegistrationForm'];
			if($model->save()){
				$loginForm = new LoginForm();
				$loginForm->fakeLogin($model->email, $_POST['RegistrationForm']['password']);
				$this->redirect(array('site/index')); // automaticke prihlaseni uzivatele
				//@todo presmerovani na administraci
			}
			
		}
		// display the login form
		$this->render('register', array('model'=>$model));
	}
	
	/**
	 * Zobrazeni stranky pro obnoveni hesla.
	 * Mohou nastat dva pripady:
	 * 1) Uzivatel teprve zada o obnovu hesla. Vyplni email a system odesle informace pro obnovu (resetSubmit)
	 * 2) Uzivatel prisel pres aktivacni link. System zobrazi formular pro zadani hesla a
	 * po vyplneni spravnych udaju uzivatele rovnou prhlasi.
	 */
	public function actionResetPassword()
	{
		
		if(isset($_GET['resetKey'])) // Uzivatel prisel pres aktivacni link
		{
			$scenario = 'resetSubmit';
			$model = $this->resetSubmit($_GET['resetKey']);
		}
		else // Uzivatel teprve zada o obnovu hesla
		{
			$scenario = 'resetRequest';
			$model = $this->resetRequest();
		}	
		
		$this->render('resetPassword', array(
				'model' => $model,
				'scenario' => $scenario,
			)
		);
	}
	
	/**
	 *  Zprocesovani scenare, kdy uzivatel zada o obnovu hesla.
	 *  Uzivatel vyplni email, system overi, zda uzivatel existuje a
	 *  odesle informace pro obnovu.
	 *  
	 *  @return ResetPasswordForm
	 */
	public function resetRequest()
	{
		$model = new ResetPasswordForm('resetRequest'); // vytvoreni reset form se scenarem, kdy uzivatel zada o obnovu hesla a zadava pouze email
		
		if(isset($_POST['ResetPasswordForm']))
		{
			$model->attributes = $_POST['ResetPasswordForm'];
			
			if($model->validate()){
				$user = User::model()->findByAttributes(array('email' => $_POST['ResetPasswordForm']['email']));
				$resetKey = $this->createResetKey();
				
				$user->resetKey = $resetKey;
				if($user->saveAttributes(array('resetKey'=> $resetKey))) // ulozeni reset klice do databaze
				{ 
					MailSender::sendResetPasswordMail($user->email, $resetKey); // odeslani emailu s informaceni pro obnovu hesla
					Yii::app()->user->setFlash('resetPasswordMessage', "Prosím zkontrolujte svoji emailovou schránku. Byly vám odeslány instrukce pro obnovení hesla.");
					$this->refresh();
				}
			}
		}
		
		return $model;
	}
	
	/**
	 * Zprocesovani scenare, kdy uzivatel prijde pers aktivacni link.
	 * Uzivatel vyplni nove heslo a overeni hesla.
	 * System odesle informaci o obnove hesla na email.
	 * 
	 * @return ResetPasswordForm
	 */
	public function resetSubmit($resetKey)
	{
		$user = User::model()->findByAttributes(array('resetKey' => $resetKey)); // vyhledani uzivatele podle reset key
			
		if(isset($user)){
			$model = new ResetPasswordForm('resetSubmit'); // vytvoreni reset form se scenarem, kdy uzivatel prisel pres aktivacni link
			
			if(isset($_POST['ResetPasswordForm']))
			{
				$model->attributes = $_POST['ResetPasswordForm'];
				
				if($model->validate()){
					if($user->saveAttributes(array('password' => User::hashPassword($model->password)))) // ulozeni noveho hesla
					{
						MailSender::sendResetSubmitMail($user->email); // odeslani mailu ohledne zmeny hesla
						Yii::app()->user->setFlash('resetPasswordMessage', "Vaše heslo bylo úspěšně změněno a bylo provedeno přihlášení");
						$loginForm = new LoginForm(); // prihlaseni uzivatele
						$loginForm->fakeLogin($user->email, $model->password);
						$this->refresh(); //@todo presmerovani na administraci
					}
				}
			}
			
			return $model;
		}
		
		Yii::app()->user->setFlash('resetPasswordMessage', "Zadaný aktivační odkaz je neplatný.");
		$this->redirect(array('site/resetPassword'));
	}
	
	/**
	 * @return string aktivacni kod dlouhy 30 znaku
	 */
	public function createResetKey()
	{
		return substr(md5(microtime()), 0, -2);
	}
	
	
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}