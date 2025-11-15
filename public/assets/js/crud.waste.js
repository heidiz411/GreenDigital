
/* global $, AppModal */
$(function(){
  // Types
  if ($('#wasteTypesTable').length) {
    var tTypes = $('#wasteTypesTable').DataTable({
      ajax:{ url:'?r=/api/waste/types', dataSrc:'data' },
      dom:'Bfrtip', buttons:['csvHtml5'],
      columns:[
        {data:'type_id'},{data:'type_name'},{data:'type_unit'},{data:'type_cash'},
        {data:null, orderable:false, render:function(r){
          return '<button class="btn btn-xs btn-primary wt-edit" data-id="'+r.type_id+'">แก้ไข</button> '
               + '<button class="btn btn-xs btn-danger wt-del" data-id="'+r.type_id+'">ลบ</button>';
        }}
      ]
    });
    $('#btnAddType').on('click', function(){ AppModal.open('เพิ่มประเภทขยะ','?r=/waste/type/form').done(bindTypeForm); });
    $('#wasteTypesTable').on('click','.wt-edit', function(){ var id=$(this).data('id'); AppModal.open('แก้ไขประเภท','?r=/waste/type/form').done(function(){ $('[name="type_id"]').val(id); bindTypeForm(); }); });
    $('#wasteTypesTable').on('click','.wt-del', function(){ if(!confirm('ยืนยันการลบ?')) return; $.post('?r=/waste/type/delete', { _csrf: $('input[name=_csrf]').val(), id: $(this).data('id') }).done(function(res){ alert(res.message||'ลบแล้ว'); tTypes.ajax.reload(null,false); }); });
    function bindTypeForm(){ $('#typeForm').on('submit', function(e){ e.preventDefault(); $.post('?r=/waste/type/save', $(this).serialize()).done(function(res){ alert(res.message||'บันทึกแล้ว'); AppModal.close(); tTypes.ajax.reload(null,false); }).fail(function(xhr){ alert(xhr.responseJSON?.message||'บันทึกไม่สำเร็จ'); }); }); }
  }
  // Records
  if ($('#wasteRecTable').length) {
    function buildUrl(){ var p=$.param({ from: $('#fltFrom').val()||'', to: $('#fltTo').val()||'', org_id: $('#fltOrg').val()||'', q: $('#fltQ').val()||'' }); return '?r=/api/waste/records' + (p?('&'+p):''); }
    var tRecs = $('#wasteRecTable').DataTable({
      ajax:{ url: buildUrl(), dataSrc:'data' }, dom:'Bfrtip', buttons:['csvHtml5'],
      columns:[ {data:'rec_id'},{data:'user_id'},{data:'org_id'},{data:'type_name'}, {data:'weight'},{data:'status'},{data:'create_at'}, {data:null, orderable:false, render:function(r){ return '<button class="btn btn-xs btn-primary wr-edit" data-id="'+r.rec_id+'">แก้ไข</button> ' + '<button class="btn btn-xs btn-danger wr-del" data-id="'+r.rec_id+'">ลบ</button>'; }} ]
    });
    $('#btnFilter').on('click', function(){ tRecs.ajax.url(buildUrl()).load(); var p=$.param({ from:$('#fltFrom').val(), to:$('#fltTo').val(), org_id:$('#fltOrg').val(), q:$('#fltQ').val() }); $('#btnExport').attr('href','?r=/export/waste.csv'+(p?('&'+p):'')); }).trigger('click');
    $('#btnAddWasteRec').on('click', function(){ AppModal.open('บันทึกขยะ','?r=/waste/record/form').done(bindRecForm); });
    $('#wasteRecTable').on('click','.wr-edit', function(){ var id=$(this).data('id'); AppModal.open('แก้ไขบันทึก','?r=/waste/record/form').done(function(){ $('[name="rec_id"]').val(id); bindRecForm(); }); });
    $('#wasteRecTable').on('click','.wr-del', function(){ if(!confirm('ยืนยันการลบ?')) return; $.post('?r=/waste/record/delete', { _csrf: $('input[name=_csrf]').val(), id: $(this).data('id') }).done(function(res){ alert(res.message||'ลบแล้ว'); tRecs.ajax.reload(null,false); }).fail(function(){ alert('ลบไม่สำเร็จ'); }); });
    function bindRecForm(){ $('#recForm').on('submit', function(e){ e.preventDefault(); var fd=new FormData(this); $.ajax({ url:'?r=/waste/record/save', method:'POST', data:fd, processData:false, contentType:false }).done(function(res){ alert(res.message||'บันทึกแล้ว'); AppModal.close(); tRecs.ajax.reload(null,false); }).fail(function(xhr){ alert(xhr.responseJSON?.message||'บันทึกไม่สำเร็จ'); }); }); }
  }
});
