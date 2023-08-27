<?php

namespace App\Controllers;

use App\Models\UserModel;

class ManajemenUserController extends BaseController
{
    protected $manajemenuser;

    function __construct()
    {
        helper('form');
        $this->manajemenuser = new UserModel();
    }

    public function index()
    {
        $data['manajemenusers'] = $this->manajemenuser->findAll();
        
        return view('/manajemenuser_view', $data);
    }
    

    public function edit($id)
    {
        $dataForm = $this->manajemenuser->find($id);
        
        $dataForm = [
            'id' => $this->request->getPost('id'),
            'username' => $this->request->getPost('username'),
            
            'role' => $this->request->getPost('role'),
            
            'is_aktif' => $this->request->getPost('is_aktif')
        ];

        $this->manajemenuser->update($id, $dataForm);
        return redirect('manajemenuser')->with('success', 'Data Berhasil Diubah');
    }


    public function delete($id)
    {
        $this->manajemenuser->delete($id);
        return redirect('manajemenuser')->with('success', 'Data Berhasil Dihapus');
    }
}
