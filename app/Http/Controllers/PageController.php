<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TiengHanVietModel;
use DB;
use URL;
use Uuid;

class PageController extends Controller
{
	public function index()
	{
		return view("index");
	}

    public function loadList(Request $request)
	{
		$TiengHanVietModel  = new TiengHanVietModel;
        $currentPage = $request->currentPage;
        $perPage = $request->perPage;
        $search = $request->search;
        $params = array(
                'searchString' => $request->search_string,
                'currentPage'  => $request->currentPage,
                'perPage'      => $request->perPage,
            );
        $objResult = $TiengHanVietModel->_getAll($params);
        $arrResult = $objResult->toArray();
        $data = $arrResult['data'];
        if($data) {
            for($i = 0; $i < count($data); $i++) {
                if(is_null($data[$i]['tamnguyen'])){
                    $data[$i]['tamnguyen'] = "";
                }

                if(is_null($data[$i]['thanhngu'])){
                    $data[$i]['thanhngu'] = "";
                }

                if(is_null($data[$i]['dongAmNom'])){
                    $data[$i]['dongAmNom'] = "";
                }

                if(is_null($data[$i]['chuThich'])){
                    $data[$i]['chuThich'] = "";
                }
            }
        }   
        return \Response::JSON(array(
               'Dataloadlist'  => $data, 
               'pagination' => (string) $objResult->links('pagination'),
               'perPage' => $perPage,
        ));
	}

	public function add(Request $request){
		$data['arrStudent'] = null;
        return view('add', $data);
    }

    public function add_tuhanviet(Request $request)
    {
        $id = $request->id;
        $TiengHanVietModel = new TiengHanVietModel;

        $TiengHanVietModel->tuHanViet = $request->tuHanViet;
        $TiengHanVietModel->chuHan = $request->chuHan;
        $TiengHanVietModel->yNghia = $request->yNghia;
        $TiengHanVietModel->tuDongAm = $request->tuDongAm;
        $TiengHanVietModel->tamnguyen = $request->tamnguyen;
        $TiengHanVietModel->thanhngu = $request->thanhngu;
        $TiengHanVietModel->dongAmNom = $request->dongAmNom;
        $TiengHanVietModel->chuThich = $request->chuThich;
        $TiengHanVietModel->save();
        return array('success' => true, 'message' => 'Cập nhật thành công');
    }

    public function edit(Request $request){
        $itemid = $request->input('itemId');
        $TiengHanVietModel = TiengHanVietModel::find($itemid);
        $arrStudent['tuHanViet']  = $TiengHanVietModel->tuHanViet;
        $arrStudent['chuHan']  = $TiengHanVietModel->chuHan;
        $arrStudent['yNghia']  = $TiengHanVietModel->yNghia;
        $arrStudent['tuDongAm']  = $TiengHanVietModel->tuDongAm;
        $arrStudent['tamnguyen']  = $TiengHanVietModel->tamnguyen;
        $arrStudent['thanhngu']  = $TiengHanVietModel->thanhngu;
        $arrStudent['dongAmNom']  = $TiengHanVietModel->dongAmNom;
        $arrStudent['chuThich']  = $TiengHanVietModel->chuThich;
        $data['arrStudent'] = $arrStudent;
        return view('add',$data);
    }

    public function update(Request $request)
    {
        $id = $request->input('itemId');
        $TiengHanVietModel = TiengHanVietModel::find($id);
        $TiengHanVietModel->tuHanViet = $request->tuHanViet;
        $TiengHanVietModel->chuHan = $request->chuHan;      
        $TiengHanVietModel->yNghia = $TiengHanVietModel->yNghia;
        $TiengHanVietModel->tuDongAm = $request->tuDongAm;
        $TiengHanVietModel->tamnguyen = $request->tamnguyen;
        $TiengHanVietModel->thanhngu = $request->thanhngu;
        $TiengHanVietModel->dongAmNom = $request->dongAmNom;
        $TiengHanVietModel->chuThich = $request->chuThich;
        $TiengHanVietModel->save();
        return array('success' => true, 'message' => 'Cập nhật thành công');
    }

    public function delete(Request $request){
        $TiengHanVietModel = new TiengHanVietModel;
        $listitem = $request->input('listitem');
        $arrResult = $TiengHanVietModel->_delete($listitem);

        return \Response::JSON($arrResult);
    }
}
