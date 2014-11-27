<?php

class SalonController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Vytvoreni noveho kadernictvi. Kadernictvi muze byt vytvoreno
	 * registrovanym nebo neregistrovanym uzivatelem.
	 * 
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		
		if (!Yii::app()->user->isGuest)
		{
			$scenario = 'registeredCreate';
			$model = $this->registeredCreate();
		}
		else
		{
			$scenario = 'unregisteredCreate';
			$model = $this->unregisteredCreate();
		}

		$this->render('create',array(
			'model'=>$model,
			'scenario'=>$scenario,
		));
	}
	
	/**
	 * Vytvoreni kadernictvi registrovanym uzivatelem.
	 * Uzivatel je nastaven jako vlastnik kadernictvi.
	 * 
	 * @return Salon
	 */
	public function registeredCreate()
	{
		$model=new Salon;
		$user = User::getUserById(Yii::app()->user->id);

		if(isset($_POST['Salon']))
		{
			$model->attributes=$_POST['Salon'];
			$model->owner_user_id = $user->id; // nastaveni vlastnika
				
			if($model->save())
			{
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		
		return $model;
	}
	
	/**
	 * Vytvoreni kadernictvi neregistrovanym uzivatelem.
	 * Pokud uzivatel se zadanou emailovou adresou neexistuje,
	 * je take vytvoren.
	 * 
	 * @return multitype:RegistrationForm Salon 
	 */
	public function unregisteredCreate()
	{
		$model=new Salon;
		$user=new RegistrationForm;
		
		if(isset($_POST['Salon'], $_POST['RegistrationForm']))
		{
			$model->attributes=$_POST['Salon'];
			$user->attributes=$_POST['RegistrationForm'];
				
			$valid = $model->validate();
			$valid = $user->validate() && $valid;
				
			if($valid)
			{
				$tmp = User::getUserByEmail($user->email);
				
				// pokud uzivatel se zadanym emailem neexistuje, ulozi se a nastavi
				// se jako create_user_id
				if($tmp == null)
				{
					$user->save(false);
					$model->create_user_id = $user->getPrimaryKey();
				}
				else // pokud uzivatel se zadanym emailem existuje, nastavi se jako create_user_id
					$model->create_user_id = $tmp->id;
					
				$model->save(false);
		
				$this->redirect(array('view','id'=>$model->id));
			}

		}
		
		return array(
				'user' => $user,
				'model' => $model
		);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Salon']))
		{
			$model->attributes=$_POST['Salon'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Salon');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Salon('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Salon']))
			$model->attributes=$_GET['Salon'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Salon the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Salon::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Salon $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='salon-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
