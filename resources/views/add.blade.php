<form id="frmAddStudent" role="form" action="" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input class="form-control" name="id" type="hidden" value="">
<div class="modal-dialog modal-lg full-modal">
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  	@if($arrStudent)
		  		<h4 class="modal-title">Sửa thông tin từ Hán Việt</h4>
		  	@else
		  		<h4 class="modal-title">Thêm từ Hán Việt</h4>
		  	@endif

		</div>
		<div class="modal-body">
			<div class="main-tab">
		    	<!-- Tab panes -->
		        <!-- Tab panes -->
		    		<!-- Thong tin co ban cua nguoi dung -->
			        <div role="tabpanel" class="tab-pane active" id="infor">
				    	<div class="row form-group">
				    		<label class="col-md-2 control-label required">Từ Hán Việt/Thành ngữ gốc hán:</label>
				    		<div class="col-md-8">
				    		@if($arrStudent)
				    			<input class="form-control input-lg" type="text" id="tuHanViet" name="tuHanViet" value="{{$arrStudent['tuHanViet']}}">
				    		@else
				    			<input class="form-control input-lg" type="text" id="tuHanViet" name="tuHanViet" value="">
				    		@endif
				    		</div>
				    	</div>

				    	<div class="row form-group">
				    		<label class="col-md-2 control-label required">Chữ Hán:</label>
				    		<div class="col-md-8">
				    		@if($arrStudent)
				    			<input class="form-control input-lg" type="text" id="chuHan" name="chuHan" value="{{$arrStudent['chuHan']}}">
				    		@else
				    			<input class="form-control input-lg" type="text" id="chuHan" name="chuHan" value="">
				    		@endif
				    		</div>
				    	</div><br>

				    	<div class="row form-group">
				    		<label class="col-md-2 control-label required">Ý nghĩa:</label>
				    		<div class="col-md-8">
				    		@if($arrStudent)
				    			<textarea class="form-control input-lg" type="text" id="yNghia" name="yNghia" value="" style="height: 120px">{{$arrStudent['yNghia']}}</textarea>
				    		@else
				    			<textarea class="form-control input-lg" type="text" id="yNghia" name="yNghia" value="" style="height: 120px"></textarea>
				    		@endif
				    		</div>
				    	</div><br>

				    	<div class="row form-group">
				    		<label class="col-md-2 control-label required">Từ đồng âm:</label>
				    		<div class="col-md-8">
				    		@if($arrStudent)
				    			<input class="form-control input-lg" type="text" id="tuDongAm" name="tuDongAm" value="{{$arrStudent['tuDongAm']}}">
				    		@else
				    			<input class="form-control input-lg" type="text" id="tuDongAm" name="tuDongAm" value="">
				    		@endif
				    		</div>
				    	</div><br>

				    	<div class="row form-group">
				    		<label class="col-md-2 control-label">Tầm nguyên chữ Hán:</label>
				    		<div class="col-md-8">
				    		@if($arrStudent)
				    			<textarea class="form-control input-lg" type="text" id="tamnguyen" name="tamnguyen" value="" style="height: 120px">{{$arrStudent['tamnguyen']}}</textarea>
				    		@else
				    			<textarea class="form-control input-lg" type="text" id="tamnguyen" name="tamnguyen" value="" style="height: 120px"></textarea>
				    		@endif
				    		</div>
				    	</div><br>

				    	<div class="row form-group">
				    		<label class="col-md-2 control-label">Thành ngữ Hán Việt:</label>
				    		<div class="col-md-8">
				    		@if($arrStudent)
				    			<input class="form-control input-lg" type="text" id="thanhngu" name="thanhngu" value="{{$arrStudent['thanhngu']}}">
				    		@else
				    			<input class="form-control input-lg" type="text" id="thanhngu" name="thanhngu" value="">
				    		@endif
				    		</div>
				    	</div><br>

				    	<div class="row form-group">
				    		<label class="col-md-2 control-label">Đồng âm nôm(từ thuần Việt):</label>
				    		<div class="col-md-8">
				    		@if($arrStudent)
				    			<input class="form-control input-lg" type="text" id="dongAmNom" name="dongAmNom" value="{{$arrStudent['dongAmNom']}}">
				    		@else
				    			<input class="form-control input-lg" type="text" id="dongAmNom" name="dongAmNom" value="">
				    		@endif
				    		</div>
				    	</div><br>

				    	<div class="row form-group">
				    		<label class="col-md-2 control-label">Chú thích:</label>
				    		<div class="col-md-8">
				    		@if($arrStudent)
				    			<textarea class="form-control input-lg" type="text" id="chuThich" name="chuThich" value="" style="height: 120px">{{$arrStudent['chuThich']}}</textarea>
				    		@else
				    			<textarea class="form-control input-lg" type="text" id="chuThich" name="chuThich" value="" style="height: 120px"></textarea>
				    		@endif
				    		</div>
				    	</div><br>

				    	<div class="row form-group">
				    		<label class="col-md-2 control-label">Trạng thái:</label>
				    		<div class="col-md-8">
			                <select id="status" name="status" class="form-control chzn-select input-sm" message="">
                                <option value="true">Hiển thị</option>
                                <option value="false">Ẩn</option>
                            </select>
                        	</div>
			            </div><br>
			            <div class="row form-group">
			            <label class="col-md-8 control-label" style="color: red">Lưu ý: những mục đánh dấu (*) bắt buộc phải điền</label>
			        	</div>
				</div>
			</div>
		</div>
	<div class="modal-footer">
		<button id='btn_update' class="btn btn-primary btn-flat" type="button"><i class="fa fa-save" style="width: 80px; height: 25px; font-size: 20px"> Ghi</i></button>
		<button id='btn_save_update' class="btn btn-primary btn-flat" type="button"><i class="fa fa-save" style="height: 25px; font-size: 20px"> Ghi và thêm tiếp</i></button>
		<button id='btn_save' class="btn btn-primary btn-flat" type="button"><i class="fa fa-save" style="width: 80px; height: 25px; font-size: 20px"> Lưu</i></button>
		<button type="input" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove" style="width: 80px; height: 25px; font-size: 20px"> Thoát</i></button>
	 </div>
  </div>
</div>
</form>
<style>
.radio-container label.error{
	float: right;
}
</style>
<script>
	function checkallper(obj, name) {
        if (obj.checked) {
            $('input[name="' + name + '"]').prop('checked', true);
        } else {
            $('input[name="' + name + '"]').prop('checked', false);
        }
    }
</script>