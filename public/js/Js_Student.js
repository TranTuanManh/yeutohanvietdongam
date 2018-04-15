/**
 * Hàm load các sử kiện cho màn hình index
 *
 * @return void
 */
alertMessage = function (type,message,s = 3000){
    var vclass = 'alert';
    lclass = 'fa';
    if(type=='success'){
      vclass += ' alert-success';
    }else if(type=='infor'){
      vclass += ' alert-infor';
    }else if(type=='warning'){
      vclass += ' alert-warning';
    }else if(type=='danger'){
      vclass += ' alert-danger';
    }
    $("#message-alert").alert();
    $("#message-alert").removeClass();
    $("#message-alert").addClass(vclass);
    $("#message-infor").html(message);
    $("#message-alert").fadeTo(s, 500).slideUp(500, function(){
      $("#message-alert").slideUp(500);
    })
}

loadIndex = function(){
  var oForm = 'form#frmStudent_index';
  loadList();
  $(oForm).find('#btn_search').click(function(){
    loadList();
  });
  $(oForm).find('#btn_add').click(function(){
    add(oForm);
  });
  $(oForm).find('#btn_edit').click(function(){
    edit(oForm);
  });
  $(oForm).find('#btn_delete').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    onConfirm: function() {
    deletee(oForm);
    }
  });
  $('.chzn-select').chosen({ width: '100%' });
    addShortcut();
}

/**
 * Hàm load các sử kiện cho màn hình khác
 *
 * @param oForm (tên form)
 *
 * @return void
 */
loadevent = function(){

  $('form#frmAddStudent').find('#btn_update').click(function(){
    add_student('form#frmAddStudent', 1);
  });

  $('form#frmAddStudent').find('#btn_save_update').click(function(){
    add_student('form#frmAddStudent', 2);
  });
  $('form#frmAddStudent').find('#btn_save').click(function(){
    update('form#frmAddStudent');
  });
}

/**
 * Hàm thiet lap lai cac su kien khi quay tro ve man hinh chinh
 *
 * @param oForm (tên form)
 *
 * @return void
 */
backIndex = function(){
  shortcut.remove("Enter");
  loadList();
}
addShortcut = function(){
  shortcut.add("Enter",function() {
    loadList();
  });
}


loadList = function(oForm){
  var url = '/loadList';
  
  var oForm = 'form#frmStudent_index';
  var currentPage = $(oForm).find('#_currentPage').val();
  currentPage = (!currentPage) ? 1 : currentPage;
  var perPage = $(oForm).find('#cbo_nuber_record_page').val();
  perPage     = (!perPage) ? 15 : perPage;

  var data = $(oForm).serialize();
  data +='&currentPage=' + currentPage;
  data +='&perPage=' + perPage;
  $.ajax({
      url: url,
      type: "POST",
      dataType: 'json',
      //cache: true,
      data:data,
      success: function(arrResult){
        // arrResult = $.parseJSON(arrResult);
        var $html = '', data;
        data = arrResult.Dataloadlist;
        dem = 1;
        if(data) {
          for(x in data) {
            $html += '<tr>';
            $html += '<td align="center"><input ondblclick="" onclick="{select_checkbox_row(this);}" name="chk_item_id" value="' + data[x].id + '" type="checkbox"></td>';
            $html += '<td class="data" ondblclick="" onclick="{select_row(this);}" align="center">' + (dem++) + '</td>';
            $html += '<td class="data" ondblclick="" onclick="{select_row(this);}" align="center">' + data[x].tuHanViet + '</td>';
            $html += '<td class="data" ondblclick="" onclick="{select_row(this);}" align="center">' + data[x].chuHan + '</td>';
            $html += '<td class="data" ondblclick="" onclick="{select_row(this);}" align="center">' + data[x].yNghia + '</td>';
            $html += '<td class="data" ondblclick="" onclick="{select_row(this);}" align="center">' + data[x].tuDongAm + '</td>';
            $html += '</tr>';
          }
        }
        $('#table-data tbody').html($html);
        $('#pagination').html(arrResult.pagination);
        $(oForm).find('.main_paginate .pagination a').click(function(){
          $(oForm).find('#_currentPage').val($(this).attr('page'));
          loadList();
        });
        $(oForm).find('#cbo_nuber_record_page').change(function(){
          loadList();
        });
        $(oForm).find('#cbo_nuber_record_page').val(arrResult.perPage);
      }
  }); 
}

add = function (oForm) {
  var url = '/add';
  var data = $(oForm).serialize();
  $.ajax({
      url: url,
      type: "POST",
      data:data,
      success: function(arrResult){
         $('#addStudentModal').html(arrResult);   
         $('#addStudentModal').modal('show');
         $('#btn_save').hide();
         loadevent();
         validateAddForm($('#frmAddStudent'));
      }
  }); 
}

add_student = function(oForm, type){
  var url = '/tuhanviet_add';
  if($(oForm).valid()) {
  // if(1==1) {
    var data = $(oForm).serialize();
    $.ajax({
        url: url,
        type: "POST",
        dataType: 'json',
        //cache: true,
        data:data,
        success: function(arrResult){  
            if(arrResult['success']){
              if(type == 1){
                $('#addStudentModal').modal('hide');
              }
              else{
                $("input").val("");
                $("textarea").val("");
              }
                loadList(oForm);
                alertMessage('success',arrResult['message']);
            }else{
                alertMessage('danger',arrResult['message']);
            }
        },
        error: function(arrResult) {
            alertMessage('warning',arrResult.responseJSON[Object.keys(arrResult.responseJSON)[0]]);
        }
    }); 
  }
}

deletee = function(oForm){
  var url = '/delete';
  var data = $(oForm).serialize();
  var p_chk_obj = $('#table-data').find('input[name="chk_item_id"]');
  var listitem = '';
  var i =0;
  $(p_chk_obj).each(function() {
      if ($(this).is(':checked')) {
        if(listitem!==''){
          listitem +=  ','+$(this).val();
        }else{
          listitem = $(this).val();
        }
        i++;
      }
  });
  data +='&listitem=' + listitem;
    $.ajax({
        url: url,
        type: "POST",
        //cache: true,
        dataType: 'json',
        data:data,
        success: function(arrResult){
          loadList(oForm);
        }
    });

}

edit = function(oForm){
  var url = '/edit';
  var data = $(oForm).serialize();
  var p_chk_obj = $('#table-data').find('input[name="chk_item_id"]');
  var listitem = '';
  var i =0;
  $(p_chk_obj).each(function() {
      if ($(this).is(':checked')) {
        if(listitem!==''){
          listitem +=  ','+$(this).val();
        }else{
          listitem = $(this).val();
        }
        i++;
      }
  });
  if(listitem == ''){
     alertMessage('danger',"Bạn chưa chọn danh mục cần sửa");
     return false;
  }
  if(i>1){
     alertMessage('danger',"Bạn chỉ được chọn một danh mục để sửa");
     return false;
  }
  data +='&itemId=' + listitem;
  $.ajax({
      url: url,
      type: "POST",
      //cache: true,
      data:data,
      success: function(arrResult){
           $('#addStudentModal').html(arrResult);   
           $('#addStudentModal').modal('show');
           $('#btn_update').hide();
           $('#btn_save_update').hide();
           $('input[name="username"]').prop('disabled', true);
           $('form#frmAddStudent').find('#btn_save').click(function(){
              update('form#frmAddStudent', listitem);
           });
           upload_image();     
      }
  }); 
}

update = function(oForm, listitem){
  var url = 'update';
  if($(oForm).valid()) {   
    var data = $(oForm).serialize();
    data +='&itemId=' + listitem;
    $.ajax({
        url: url,
        type: "POST",
        dataType: 'json',
        //cache: true,
        data:data,
        success: function(arrResult){  
            if(arrResult['success']){
                $('#addStudentModal').modal('hide');
                loadList(oForm);
                alertMessage('success',arrResult['message']);
            }else{
                alertMessage('danger',arrResult['message']);
            }
        },
        error: function(arrResult) {
            alertMessage('warning',arrResult.responseJSON[Object.keys(arrResult.responseJSON)[0]]);
        }
    }); 
  }
}
