<?php

namespace backend\controllers;

use Yii;
use backend\models\CompanyProject;
use backend\models\CompanyProjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanyProjectController implements the CRUD actions for CompanyProject model.
 */
class CompanyProjectController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all CompanyProject models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->view->title = 'Proyek';
        $searchModel = new CompanyProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $totalActiveProjects = $dataProvider->getTotalCount();
        $limitMaxProjects = Yii::$app->user->identity->company->companyLimitation->max_project;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'totalActiveProjects' => $totalActiveProjects,
            'limitMaxProjects' => $limitMaxProjects,
        ]);
    }

    /**
     * Displays a single CompanyProject model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerCompanyProjectAttendance = new \yii\data\ArrayDataProvider([
            'allModels' => $model->companyProjectAttendances,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerCompanyProjectAttendance' => $providerCompanyProjectAttendance,
        ]);
    }

    /**
     * Creates a new CompanyProject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompanyProject();

        $model->company_id = Yii::$app->user->identity->company_id;

        $searchModel = new CompanyProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $totalActiveProjects = $dataProvider->getTotalCount();
        $limitMaxProjects = Yii::$app->user->identity->company->companyLimitation->max_project;

        if ($model->loadAll(Yii::$app->request->post()) && ($model->validate() && $model->validateTotalProject())) {
            if ($model->saveAll()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'totalActiveProjects' => $totalActiveProjects,
                'limitMaxProjects' => $limitMaxProjects,
            ]);
        }
    }

    /**
     * Updates an existing CompanyProject model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->company_id = Yii::$app->user->identity->company_id;

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CompanyProject model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }
    
    /**
     * 
     * Export CompanyProject information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);
        $providerCompanyProjectAttendance = new \yii\data\ArrayDataProvider([
            'allModels' => $model->companyProjectAttendances,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerCompanyProjectAttendance' => $providerCompanyProjectAttendance,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_CORE,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }

    
    /**
     * Finds the CompanyProject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompanyProject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyProject::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for CompanyProjectAttendance
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddCompanyProjectAttendance()
    {
        /*if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('CompanyProjectAttendance');
            if (!empty($row)) {
                $row = array_values($row);
            }
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formCompanyProjectAttendance', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }*/
    }
}
