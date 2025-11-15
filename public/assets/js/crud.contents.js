/* global $, AppModal */
$(function(){
  if (!$('#contentsTable').length) return;
  var t = $('#contentsTable').DataTable({
    ajax: { url: '?r=/api/contents', dataSrc: 'data' },
    dom: 'Bfrtip', buttons: ['csvHtml5'],
    columns: [
      {data:'content_id'},{data:'title'},{data:'publish_at'},{data:'expire_at'},
      {data:'is_active', render:function(v){ return v ? 'เปิด' : 'ปิด'; }},
      {data:null, orderable:false, render:function(r){
        return '<button class="btn btn-xs btn-primary c-edit" data-id="'+r.content_id+'">แก้ไข</button> '
             + '<button class="btn btn-xs btn-danger c-del" data-id="'+r.content_id+'">ลบ</button>';
      }}
    ]
  });
  $('#btnAddContent').on('click', function(){ AppModal.open('เพิ่มเนื้อหา','?r=/admin/content/form').done(bindForm); });
  $('#contentsTable').on('click','.c-edit', function(){ var id=$(this).data('id'); AppModal.open('แก้ไขเนื้อหา','?r=/admin/content/form').done(function(){ $('[name="content_id"]').val(id); bindForm(); }); });
  function bindForm(){ $('#contentForm').on('submit', function(e){ e.preventDefault(); var fd = new FormData(this); if(!fd.get('is_active')) fd.set('is_active','0'); $.ajax({ url:'?r=/admin/content/save', method:'POST', data:fd, processData:false, contentType:false }).done(function(res){ alert(res.message||'บันทึกแล้ว'); AppModal.close(); t.ajax.reload(null,false); }).fail(function(xhr){ alert(xhr.responseJSON?.message||'บันทึกไม่สำเร็จ'); }); }); }
  $('#contentsTable').on('click','.c-del', function(){ if(!confirm('ยืนยันการลบเนื้อหา?')) return; $.post('?r=/admin/content/delete', { _csrf: $('input[name=_csrf]').val(), id: $(this).data('id') }).done(function(res){ alert(res.message||'ลบแล้ว'); t.ajax.reload(null,false); }); });
});
