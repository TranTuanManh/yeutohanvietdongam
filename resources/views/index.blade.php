<!DOCTYPE html>
<html>
<head>
    <title>Tra cứu từ Hán Việt</title>
    <base href="{{asset('')}}">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-chosen.css">
    <link rel="stylesheet" type="text/css" href="css/style.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
</head>
<body>

<form action="index" method="POST" id="frmStudent_index">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<section class="content-wrapper">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-mortar-board fa-3"></i></a></li>
        <li class="active">Tra cứu từ Hán Việt</li>
    </ol>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-horizontal">
                <div class="row form-group">
                    <div class="col-md-6">
                        <div class="row ">
                            <br><label class="control-label col-md-4">{{Lang::get('Student.search')}} theo Hán Việt</label>
                            <div class="col-md-8 text-right">
                                <input name="search_string" class="form-control input-sm" placeholder="Nhập từ Hán Việt hoặc chữ Hán rồi click vào nút tìm kiếm..." type="text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group input-group-index">
                <div class="pull-left">
                    <button class="btn btn-primary btn-flat search" id="btn_search" data-loading-text="{{Lang::get('Student.search')}}..." type="button" style="font-size: 20px">
                        <i class="fa fa-search" aria-hidden="true" style="width: 25px; height: 25px; font-size: 20px"></i>
                    {{Lang::get('Student.search')}}</button>
                </div><br><br>
                <div class="pull-right">
                    <button class="btn btn-primary btn-flat" id="btn_add" type="button" data-toggle="tooltip"  data-original-title="{{Lang::get('Student.add')}}"><i class="fa fa-plus" style="width: 30px; height: 30px; font-size: 30px"></i></button>
                    <button class="btn btn-success btn-flat" id="btn_edit" type="button" data-toggle="tooltip"  data-original-title="{{Lang::get('Student.edit')}}"><i class="fa fa-pencil" style="width: 30px; height: 30px; font-size: 30px"></i></button>

                    <button class="btn btn-danger" id="btn_delete" type="button" data-toggle="confirmation" data-btn-ok-label="{{Lang::get('Student.delete')}}" data-btn-ok-icon="" data-btn-ok-class="btn-danger" data-btn-cancel-label="{{Lang::get('Student.close')}}" data-btn-cancel-icon="" data-btn-cancel-class="btn-default" data-placement="left" data-original-title="{{Lang::get('Student.delete_title')}}"><i class="fa fa-trash-o" style="width: 30px; height: 30px; font-size: 30px"></i></button>
                    </button>
                </div>
            </div>
            <!-- Màn hình danh sách -->
            <div class="row" id="table-container"></div>
                <table class="table table-striped table-bordered dataTable no-footer" align="center" id="table-data">
                    <col width="5%">
                    <col width="5%">
                    <col width="15%">
                    <col width="15%">
                    <col width="35%">
                    <col width="25%">
                    <thead class="thead-inverse">
                    <tr class="header">
                    <td align="center"><b><input name="chk_all_item_id" onclick="checkbox_all_item_id(document.forms[0].chk_item_id);" type="checkbox"></b></td>
                        <td align="center"><b>{{Lang::get('Student.stt')}}</b></td>
                        <td align="center"><b>{{Lang::get('Student.tuHanViet')}}</b></td>
                        <td align="center"><b>{{Lang::get('Student.chuHan')}}</b></td>
                        <td align="center"><b>{{Lang::get('Student.yNghia')}}</b></td>
                        <td align="center"><b>{{Lang::get('Student.tuDongAm')}}</b></td>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            <!-- Phân trang dữ liệu -->
            <div class="row" id="pagination"></div>
        </div>
    </div>
</section>
</form>
<!-- Hien thi modal -->
<div class="modal fade" id="addStudentModal" role="dialog" data-backdrop="static" data-keyboard="false">
</div>

<script src="js/jquery-3.1.1.js"></script>
<script src="js/chosen-jquery.min.js"></script>
<script src="js/jquery-comfirm.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-confirmation.js"></script>
<script src="js/app.min.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/Js_Student.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        loadIndex();
});
</script>
<style>
    
    label.title_info {
        /* color: #973226;
        color: rgb(0, 65, 104); */
        font-weight: 600 !important;
    }
</style>

</body>
</html>
