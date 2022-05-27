<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\ReportModel;
use App\Models\UserLogModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class Report extends BaseController
{
    use ResponseTrait;
    protected $report_model = null;
    protected $user_model = null;
    protected $user_log_model = null;

    public function __construct()
    {
        $this->report_model = new ReportModel();
        $this->user_model = new UserModel();
        $this->user_log_model = new UserLogModel();
    }

    public function index()
    {
        $data = [
            'header_title' => 'Report | Kantin STIS',
            'active' => 'Report',
            'nav' => [
                [
                    'title' => 'Laporan',
                    'url' => 'Admin/Report'
                ],
            ],
            'plugins' => ['datatable'],
            'styles' => 'admin/report/index',
            'visitor' => count($this->user_log_model->getVisitor()),
            'scripts' => 'admin/report/index',
        ];
        return view('admin/report/index' , $data);  
    }
    public function details()
    {
        $reported_id = $this->request->getGet('reported_id');
        $data = [
            'header_title' => 'Detail Report | Kantin STIS',
            'active' => 'Report',
            'nav' => [
                [
                    'title' => 'Laporan',
                    'url' => 'Admin/Report'
                ],
                [
                    'title' => 'Detail Laporan',
                    'url' => 'Admin/Report/details/' . $reported_id
                ],
            ],
            'plugins' => ['datatable'],
            'styles' => 'admin/report/details',
            'visitor' => count($this->user_log_model->getVisitor()),
            'scripts' => 'admin/report/details',
        ];
        return view('admin/report/details' , $data);  
    }

    public function getReport()
    {
        $scope = $this->request->getGet('scope');
        if($scope=='global'){
            $report = $this->report_model
            ->select('report.reported as reported , 
            report.comment as comment , 
            report.cleaning as cleaning ,
            count(reported) as penalty_count ,
            users.name as reported_user_name,
            users.id as reported_user_id')
            ->join('users' , 'users.id=report.reported')
            ->where('cleaning' , 0)
            ->groupBy('reported')
            ->get()->getResultArray();
            return $this->respond($report);
        }else{
            $user = $this->user_model->findAll();
            $report = $this->report_model->findAll();
            return $this->respond(['user' => $user , 'report' => $report]);
        }
        
    }

    public function forgive()
    {
        $reported_id = $this->request->getPost('reported');
        $report_id = $this->request->getPost('id');
        if($report_id){
            $reported = $this->report_model->where('id' , $report_id)->where('reported' , $reported_id)
            ->get()->getRowArray();
            if($reported){
                $this->report_model->set('cleaning' , 1)->where('id' , $report_id)->where('reported' , $reported_id)->update();
                return $this->respond('oke');
            }
            return $this->respond('no');
        }
        $reported = $this->report_model->where('reported' , $reported_id)
        ->get()->getResultArray();
        if($reported){
            $this->report_model->set('cleaning' , 1)->where('reported' , $reported_id)->update();
            return $this->respond('oke');
        }
        return $this->respond('no');

    }

    public function ban()
    {
        $reported_id = $this->request->getPost('reported');
        $reported = $this->report_model->where('reported' , $reported_id)
        ->get()->getResultArray();
        if($reported){
            $this->report_model->set('cleaning' , 1)->where('reported' , $reported_id)->update();
            $this->user_model->set('status' , 0)->where('id' , $reported_id)->update();
            return $this->respond('oke');
        }
        return $this->respond('no');
    }
}