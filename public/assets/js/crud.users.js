
/* global $, AppModal */
$(function(){
  if (!$('#usersTable').length) return;
  var t = $('#usersTable').DataTable({
    ajax: { url: '?r=/api/users', dataSrc: 'data' },
    dom: 'Bfrtip', buttons: ['csvHtml5'],
    columns: [
      {data:'user_id'},{data:'email'},{data:'full_name'},{data:'role'},{data:'create_at'},
      {data:null, orderable:false, render:function(r){
        return '<button class="btn btn-xs btn-primary u-edit" data-id="'+r.user_id+'">แก้ไข</button> '
             + '<button class="btn btn-xs btn-danger u-del" data-id="'+r.user_id+'">ลบ</button>';
      }}
    ]
  });
  $('#btnAddUser').on('click', function(){ AppModal.open('เพิ่มสมาชิก','?r=/admin/user/form').done(bindForm); });
  $('#usersTable').on('click','.u-edit', function(){ var id=$(this).data('id'); AppModal.open('แก้ไขสมาชิก','?r=/admin/user/form').done(function(){ $('[name="user_id"]').val(id); bindForm(); }); });
  function bindForm(){ $('#userForm').on('submit', function(e){ e.preventDefault(); $.post('?r=/admin/user/save', $(this).serialize()).done(function(res){ alert(res.message||'บันทึกแล้ว'); AppModal.close(); t.ajax.reload(null,false); }).fail(function(xhr){ alert(xhr.responseJSON?.message||'บันทึกไม่สำเร็จ'); }); }); }
  $('#usersTable').on('click','.u-del', function(){ if(!confirm('ยืนยันการลบสมาชิก?')) return; $.post('?r=/admin/user/delete', { _csrf: $('input[name=_csrf]').val(), id: $(this).data('id') }).done(function(res){ alert(res.message||'ลบแล้ว'); t.ajax.reload(null,false); }); });
});
