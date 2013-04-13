<?php

class UserDataController extends Controller
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
//			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','view','layer'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
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

	public function actionLayer()
	{		
		if(isset($_REQUEST['layer']))
			echo CJavaScript::jsonEncode(UserData::model()->data($_REQUEST['layer']));
		else
			echo 'Layer not provided';
		
		Yii::app()->end();
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new UserData;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserData']))
		{
			$model->attributes=$_POST['UserData'];
			$model->user_id = Yii::app()->user->id;
			if($model->save())
			{
				if(isset($_REQUEST['ajax']))
				{
					echo CJavaScript::jsonEncode(array('error'=>0,'id'=>$model->id,'seat'=>$model->seat,'tag'=>$model->tag,'value'=>$model->value));
					Yii::app()->end();
				}
				else				
					$this->redirect(array('view','id'=>$model->id));
			}
		}

		if(isset($_REQUEST['ajax']))
		{
			echo CJavaScript::jsonEncode(array('error'=>-1));
			Yii::app()->end();
		}
		
		$layer=new Layer;
    $arr = $layer->layers();
    
		$this->render('create',array(
			'model'=>$model,
		  'seats'=>$model->seats(),
		  'layers'=>$arr,
		  'tags'=>$layer->tags($arr[0]['name']),
		));
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

		if(isset($_POST['UserData']))
		{
			$model->attributes=$_POST['UserData'];
			$model->user_id = Yii::app()->user->id;
			if($model->save())
			{
				if(isset($_REQUEST['ajax']))
				{
					echo CJavaScript::jsonEncode(array('error'=>0,'id'=>$model->id,'seat'=>$model->seat,'tag'=>$model->tag,'value'=>$model->value));
					Yii::app()->end();
				}
				else				
					$this->redirect(array('view','id'=>$model->id));
			}
		}
		
		if(isset($_REQUEST['ajax']))
		{
			echo CJavaScript::jsonEncode(array('error'=>-1));
			Yii::app()->end();
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
		if(isset($_REQUEST['ajax']))
		{
			echo CJavaScript::jsonEncode(array('error'=>0, 'id'=>$id));
			Yii::app()->end();
		}
		else
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('UserData');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UserData('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserData']))
			$model->attributes=$_GET['UserData'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return UserData the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=UserData::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param UserData $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-data-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
