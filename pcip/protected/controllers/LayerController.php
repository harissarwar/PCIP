<?php

class LayerController extends Controller
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
				'actions'=>array('layers','tags','tagshtml'),
				'users'=>array('@'),
//				'deniedCallback' => function() 
//					{ 
//						Yii::app()->controller->redirect(array ('/home/index')); 
//					}
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('admin'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create', 'addTag', 'update'),
				'users'=>array('admin'),
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
	 * Sends Layers in jason response.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionLayers()
	{
		echo CJavaScript::jsonEncode(Layer::model()->layers());
		Yii::app()->end();
	}

	/**
	 * Sends tags in jason response.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionTags()
	{
		if(isset($_REQUEST['layer']))
		{
			echo CJavaScript::jsonEncode(Layer::model()->tags($_REQUEST['layer']));
			Yii::app()->end();
		}
	}
	
	public function actionTagshtml()
	{
		if(isset($_REQUEST['layer']))
		{
			$data=Layer::model()->tags($_REQUEST['layer']);
	    $data=CHtml::listData($data,'tag','tag');
	    foreach($data as $value=>$name)
	    {
	        echo CHtml::tag('option',
	                   array('value'=>$value),CHtml::encode($name),true);
	    }
		}		
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Layer;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Layer']))
		{
			$model->attributes=$_POST['Layer'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionAddTag()
	{
		$model=new Layer;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Layer']))
		{
			$model->attributes=$_POST['Layer'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('addTag',array(
			'model'=>$model, 'layers'=>$model->layers()
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

		if(isset($_POST['Layer']))
		{
			$model->attributes=$_POST['Layer'];
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
		$dataProvider=new CActiveDataProvider('Layer');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Layer('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Layer']))
			$model->attributes=$_GET['Layer'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Layer the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Layer::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Layer $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='layer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
