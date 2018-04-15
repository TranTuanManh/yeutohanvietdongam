<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Lang;
use Cache;
use DB;
use Uuid;

class TiengHanVietModel extends Model
{
    protected $table = "tuhanviet";

    public function _getAll($params) {
          $query       = $this->query();
          $currentPage = $params['currentPage'];
          $perPage     = $params['perPage'];
          $searchString = $params['searchString'];
          Paginator::currentPageResolver(function() use ($currentPage) {
               return $currentPage;
          });
             // if($search){
             //     $query->where('code', 'LIKE','%' . $search .'%')->orWhere('name', 'LIKE','%' . $search .'%');
             // }
          if($params['searchString']) {
            $query->where(function ($query1) use($searchString) {
              $query1->where('tuHanViet', 'LIKE','%' . $searchString .'%')->orWhere('chuHan', 'LIKE','%' . $searchString .'%');
            });
          }
          $query->select('id', 'tuHanViet', 'chuHan', 'yNghia','tuDongAm');
          $query->orderBy('tuHanViet');
          return $query->paginate($perPage);      
    }

    public function _delete($listitem){
        $arrListitem = explode(',', $listitem);
        DB::beginTransaction();
        try {
            $this->whereIn('id',$arrListitem)->delete();
            DB::commit();
            return array('success'=> true,'message' =>Lang::get('Thành công'));
        } catch (\Exception $e) {
            DB::rollback();
            return array('success'=> false,'message' => (string) $e->getMessage());
        }       
    }
}
