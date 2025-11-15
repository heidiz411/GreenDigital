
/* global $, Chart */
$(function(){
  if ($('#chartWasteByType').length) {
    $.getJSON('?r=/api/chart/waste-by-type', function(res){
      new Chart($('#chartWasteByType'), { type:'doughnut', data:{ labels:res.labels, datasets:[{ data:res.data, backgroundColor:res.colors }] }, options:{ responsive:true } });
    });
  }
  if ($('#chartWasteByMonth').length) {
    $.getJSON('?r=/api/chart/waste-by-month', function(res){
      new Chart($('#chartWasteByMonth'), { type:'line', data:{ labels:res.labels, datasets:[{ label:'น้ำหนักรวม (kg)', data:res.data, borderColor:'#28a745', fill:false }] }, options:{ responsive:true } });
    });
  }
  if ($('#adminNotifyBadge').length) {
    function poll(){ $.getJSON('?r=/api/admin/notify', function(r){ $('#adminNotifyBadge').text(r.total>0?r.total:'').toggle(r.total>0); }); }
    poll(); setInterval(poll, 30000);
  }
});
