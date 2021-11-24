<?php

namespace App\Controllers\Pembeli;
use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\TopingModel;
use App\Models\TransactionMenuModel;
use App\Models\TransactionModel;
use App\Models\TransactionTopingModel;
use CodeIgniter\API\ResponseTrait;

class Pesan extends BaseController
{
    use ResponseTrait;
    protected $menu_model = null;
    protected $transaction_model = null;
    protected $transaction_menu_model = null;
    protected $toping_model = null;
    protected $transaction_toping_model = null;

    public function __construct()
    {
        $this->menu_model = new MenuModel();
        $this->transaction_model = new TransactionModel();
        $this->transaction_menu_model = new TransactionMenuModel();
        $this->transaction_toping_model = new TransactionTopingModel();
        $this->toping_model = new TopingModel();
    }

    public function index()
    {
        $data = [
            'header_title' => 'Pesan | Kantin STIS',
            'active' => 'Pesan',
            'nav' => [
                [
                    'title' => 'Pesan',
                    'url' => 'Pembeli/Pesan'
                ],
            ],
            'plugins' => [],
            'styles' => 'pembeli/Pesan/index',
            'scripts' => 'pembeli/Pesan/index'
        ];
        return view('pembeli/Pesan/index' , $data);  
    }

    public function getMenu()
    {
        $keyword = $this->request->getGet('keyword');
        $limit = $this->request->getGet('limit');
        $indeks = $this->request->getGet('indeks');
        return $this->respond($this->menu_model->getMenuPembeli($keyword,$limit,$indeks));
    }

    public function getPaginMenu()
    {
        $keyword = $this->request->getGet('keyword');
        return $this->respond($this->menu_model->getPaginMenuPembeli($keyword));
    }

    public function getMenuTransaction()
    {
        return $this->respond($this->transaction_menu_model->getMenuTransaction(session()->id));
    }

    public function addCart()
    {
        $data = [
            'status' => $this->request->getPost('status'),
            'count' => $this->request->getPost('count'),
            'menu_id' => $this->request->getPost('menu_id'),
            'user_id' => session()->id
        ];

        $transaction = $this->transaction_model->checkTransaction($data['status'] , $data['user_id']);
        
        if(!$transaction){
            $this->transaction_model->insert([
                'status' => $data['status'],
                'user_id' => $data['user_id']
            ]);
        }

        $transaction = $this->transaction_model->checkTransaction($data['status'] , $data['user_id']);

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
                $this->transaction_menu_model->delete($menu_transaction['id']);
            }else{
                $this->transaction_menu_model
                ->set('count' , $data['count'])
                ->set('price' , $data['count']*$menu['price'])
                ->where('id' , $menu_transaction['id'])
                ->update();
            }
        }
        
        return $this->respond([
            'transaction' => $transaction,
            'transaction_menu' => $this->transaction_menu_model->where('transaction_id' , $transaction['id'])->get()->getResultArray()
        ]);

    }

    public function getCartTotal()
    {
        return $this->respond($this->transaction_menu_model->getCartTotal(session()->id));
    }

    public function cart()
    {   
        if(!$this->transaction_menu_model->getCartTotal(session()->id)['total_menu']){
            return redirect()->to(base_url('Pembeli/Pesan'));
        }
        $data = [
            'header_title' => 'Keranjang | Kantin STIS',
            'active' => 'Pesan',
            'nav' => [
                [
                    'title' => 'Pesan',
                    'url' => 'Pembeli/Pesan'
                ],
                [
                    'title' => 'Keranjang',
                    'url' => 'Pembeli/cart'
                ],
            ],
            'plugins' => [],
            'styles' => 'pembeli/Pesan/cart',
            'scripts' => 'pembeli/Pesan/cart'
        ];
        return view('pembeli/Pesan/cart' , $data);  
    }

    public function getItemCart()
    {
        $menu_transaction = $this->transaction_menu_model->getItemCart(session()->id);
        foreach ($menu_transaction as $key => $value) {
            $toping = $this->toping_model->where('menu_id' , $value['menu_id'])->get()->getResultArray();
            if($toping) {
                $menu_transaction[$key]['toping'] = $toping;
            }
        }
        return $this->respond($menu_transaction);
    }

    public function setToping()
    {
        $menu_id = $this->request->getPost('menu_id');
        $toping_id = $this->request->getPost('toping_id');
        $value = $this->request->getPost('value');
        $user_id = session()->id;
        $transaction = $this->transaction_model->checkTransaction(1 , $user_id);
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
                return $this->respond($toping_transaction);
            }
        }else{
            return $this->transaction_toping_model->delete($toping_transaction['id']);
        }
    }

    public function getTopingTransaction()
    {
        $user_id = session()->id;
        return $this->respond($this->transaction_toping_model->getTopingTransaction($user_id));
    }


    // public function getTransaction($status)
    // {
    //     return $this->respond($this->transaction_menu_model->getMenuTransaction($status , session()->id));
    // }
}
