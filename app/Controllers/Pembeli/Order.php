<?php

namespace App\Controllers\Pembeli;
use App\Controllers\BaseController;
use App\Models\CanteenInfoModel;
use App\Models\MenuModel;
use App\Models\TopingModel;
use App\Models\TransactionMenuModel;
use App\Models\TransactionModel;
use App\Models\TransactionTopingModel;
use App\Models\UserLogModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class Order extends BaseController
{
    use ResponseTrait;
    protected $user_model = null;
    protected $menu_model = null;
    protected $transaction_model = null;
    protected $transaction_menu_model = null;
    protected $toping_model = null;
    protected $transaction_toping_model = null;
    protected $user_log_model = null;
    protected $canteen_info_model = null;

    public function __construct()
    {
        $this->user_model = new UserModel();
        $this->menu_model = new MenuModel();
        $this->transaction_model = new TransactionModel();
        $this->transaction_menu_model = new TransactionMenuModel();
        $this->transaction_toping_model = new TransactionTopingModel();
        $this->toping_model = new TopingModel();
        $this->user_log_model = new UserLogModel();
        $this->canteen_info_model = new CanteenInfoModel();
        
    }

    public function index()
    {
        $data = [
            'header_title' => 'Order | Kantin STIS',
            'active' => 'Order',
            'nav' => [
                [
                    'title' => 'Kedai',
                    'url' => 'Pembeli/Order'
                ],
            ],
            'plugins' => [],
            'styles' => 'pembeli/order/index',
            'scripts' => 'pembeli/order/index',
            'visitor' => count($this->user_log_model->getVisitor()),
            'stand' => $this->user_model->getStand()
        ];
        return view('pembeli/order/index' , $data);  
    }

    public function menu()
    {
        $stand_id = $this->request->getGet('stand');
        if(!$stand_id){
            return redirect()->to('Pembeli/Order');
        }
        $stand = $this->user_model->getStand($stand_id);
        if(!$stand){
            return redirect()->to('Pembeli/Order');
        }
        
        $data = [
            'header_title' => 'Menu | Kantin STIS',
            'active' => 'Order',
            'nav' => [
                [
                    'title' => 'Kedai',
                    'url' => 'Pembeli/Order'
                ],
                [
                    'title' => 'Menu',
                    'url' => 'Pembeli/Menu?stand='.$stand_id
                ],
            ],
            'plugins' => [],
            'styles' => 'pembeli/order/menu',
            'visitor' => count($this->user_log_model->getVisitor()),
            'scripts' => 'pembeli/order/menu'
        ];
        return view('pembeli/order/menu' , $data); 
    }

    public function getMenu()
    {   
        $user_id = session()->id;
        $menu = $this->menu_model->getMenuPembeli(
            $this->request->getGet('canteen_id'),
            $this->request->getGet('keyword'),
            $this->request->getGet('limit'),
            $this->request->getGet('indeks')
        );
        
        return $this->respond(
            [
                'menu' => $menu,
                'canteen_info' => $this->canteen_info_model->where('user_id', $this->request->getGet('canteen_id'))->get()->getRowArray(),
                'toping' => $this->toping_model->findAll(),
                'menu_transaction' => $this->transaction_menu_model->getMenuTransaction($user_id , [1]),
                'toping_transaction' => $this->transaction_toping_model->getTopingTransaction($user_id , [1]),
            ]
        );
        // return $this->respond();
    }

    public function getPaginMenu()
    {
        $keyword = $this->request->getGet('keyword');
        $stand_id = $this->request->getGet('canteen_id');
        return $this->respond($this->menu_model->getPaginMenuPembeli($keyword ,$stand_id));
    }

    public function updateCart()
    {
        $data = [
            'count' => $this->request->getPost('count'),
            'menu_id' => $this->request->getPost('menu_id'),
            'canteen_id' => $this->request->getPost('canteen_id'),
            'user_id' => session()->id
        ];
        // check request menu kurang dari 0
        if($data['count']<0){
            return $this->fail('count less than 0' , 500);
        }
        
        $transaction = $this->transaction_model->checkTransaction($data['user_id'] , $data['canteen_id'] , 1);
        
        // check apakah ada transaksi
        if(!$transaction){
            $this->transaction_model->insert([
                'status' => 1,
                'user_id' => $data['user_id'],
                'canteen_id' => $data['canteen_id']
            ]);
            $transaction = ['id' => $this->transaction_model->getInsertID()];
        }
        
        $menu_transaction = $this->transaction_menu_model->checkMenu($transaction['id'] , $data['menu_id']);
        
        $menu = $this->menu_model->find($data['menu_id']);
        if(!$menu_transaction){
            $this->transaction_menu_model->insert([
                'menu_id' => $menu['id'],
                'name' => $menu['name'],
                'count' => 1,
                'price' => $menu['price'],
                'transaction_id' => $transaction['id']
            ]);
        }else{
            if($data['count']==0){
                $this->transaction_toping_model->where('transaction_menu_id' , $menu_transaction['id'])->delete();
                $this->transaction_menu_model->delete($menu_transaction['id']);
                if(!$this->transaction_menu_model->getMenuTransaction($data['user_id'],[1])){
                    $this->transaction_model->delete($transaction['id']);
                    return $this->respond([
                        'transaksi deleted'
                    ]);
                }
            }else{
                $this->transaction_menu_model
                ->set('count' , $data['count'])
                ->set('price' , $menu['price'])
                ->where('id' , $menu_transaction['id'])
                ->update();
            }
        }

        $transaction = $this->transaction_model->checkTransaction($data['user_id'] , $data['canteen_id'] , 1);
        
        return $this->respond([
            'transaction' => $transaction,
            'transaction_menu' => $this->transaction_menu_model->where('transaction_id' , $transaction['id'])->get()->getResultArray()
        ]);


    }

    public function updateToping()
    {

        $menu_id = $this->request->getPost('menu_id');
        $toping_id = $this->request->getPost('toping_id');
        $value = $this->request->getPost('value');
        $canteen_id = $this->request->getPost('canteen_id');
        $user_id = session()->id;
        $transaction = $this->transaction_model->checkTransaction($user_id , $canteen_id , 1);
        if(!$transaction){
            return $this->fail('transaction not found' , 400);
        }

        $menu_transaction = $this->transaction_menu_model->checkMenu($transaction['id'] , $menu_id);
        $toping_transaction = $this->transaction_toping_model->checkToping($menu_transaction['id'],$toping_id);

        if($value=='true'){
            if(!$toping_transaction){
                $toping = $this->toping_model->find($toping_id);
                $toping_transaction = $this->transaction_toping_model->insert([
                    'transaction_menu_id' => $menu_transaction['id'],
                    'toping_id' => $toping['id'],
                    'price' => $toping['price']
                ]);
                return $this->respond([
                    'status' => 'add',
                    'transaction_menu_id' => $menu_transaction['id'],
                    'toping_id' => $toping['id'],
                    'price' => $toping['price']
                ]);
            }
        }else{
            $toping = $this->toping_model->find($toping_id);
            $this->transaction_toping_model->delete($toping_transaction['id']);
            return $this->respond([
                'status' => 'delete',
                'transaction_menu_id' => $menu_transaction['id'],
                'toping_id' => $toping['id'],
                'price' => $toping['price']
            ]);
        }
    }

    public function getCartTotal()
    {
        $user_id = session()->id;
        $respond = [
            'transaction' => $this->transaction_model->checkTransaction($user_id , null , 1),
            'menu_transaction' => $this->transaction_menu_model->getMenuTransaction($user_id , [1]),
            'toping_transaction' => $this->transaction_toping_model->getTopingTransaction($user_id ,[1]),
        ];
        return $this->respond($respond);
    }

    public function resetCart()
    {
        $user_id = session()->id;
        $transaction = $this->transaction_model->checkTransaction($user_id,null,1);
        foreach ($transaction as $t) {
            $this->transaction_toping_model->deleteTopingCart($t['id']);
            $this->transaction_menu_model->deleteMenuCart($t['id']);
            $this->transaction_model->delete($t['id']);
        }
    }

    // isnowbeetweentime
    private function isNowBetweenTime($start_time, $end_time)
    {
        $start_time = strtotime($start_time);
        $end_time = strtotime($end_time);
        $current_time = strtotime(date('H:i:s'));
        return (($current_time >= $start_time) && ($current_time <= $end_time));
    }


    public function sync()
    {
        $user_id = session()->id;
        $transaction = $this->transaction_model->checkTransaction($user_id,null,1);
        // periksa apakah ada transaksi
        if(!$transaction){
            return $this->respond([
                'status' => 'empty'
            ]);
        }
        $transaction_id = [];
        foreach($transaction as $key => $value){
            $transaction_id[] = $value['id'];
        }
        $transaction_menu = $this->transaction_menu_model
        ->whereIn('transaction_id' , $transaction_id)
        ->get()
        ->getResultArray();
        if(!$transaction_menu){
            return $this->respond([
                'status' => 'empty'
            ]);
        }
        $transaction_menu_id = [];
        foreach ($transaction_menu as $key => $value) {
            $transaction_menu_id[] = $value['id'];
        }
        $transaction_toping = $this->transaction_toping_model
        ->whereIn('transaction_menu_id' , $transaction_menu_id)
        ->get()
        ->getResultArray();
        $menu = $this->menu_model->where('status',1)->where('deleted_at',null)->get()->getResultArray();
        $toping = $this->toping_model->where('status',1)->where('deleted_at',null)->get()->getResultArray();
        foreach ($transaction_menu as $key => $value) {
            $temp = array_search($value['menu_id'], array_column($menu, 'id'));
            if($temp===false){
                $this->transaction_toping_model->where('transaction_menu_id',$value['id'])->delete();
                $this->transaction_menu_model->delete($value['id']);
            }
        }
        foreach ($transaction_toping as $key => $value) {
            $temp = array_search($value['toping_id'], array_column($toping, 'id'));
            if($temp===false){
                $this->transaction_toping_model->delete($value['id']);
            }
        }
        foreach ($transaction as $key => $value) {
            $temp = [];
            $canteen_info = $this->canteen_info_model->where('user_id' , $value['canteen_id'])->get()->getRowArray();
            if(!$this->isNowBetweenTime($canteen_info['open_hours'],$canteen_info['close_hours'])||$canteen_info['status']==0){
                $temp = $this->transaction_menu_model->where('transaction_id',$value['id'])->get()->getResultArray();
                $this->transaction_menu_model->where('transaction_id',$value['id'])->delete();
                $this->transaction_model->delete($value['id']);
            }
            $this->transaction_toping_model->where('transaction_menu_id',$value['id'])->delete();
        }
        return $this->respond([
            'status' => 'success'
        ]);
    }
    
}
