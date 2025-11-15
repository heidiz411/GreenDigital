
<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/Report.php';
class ReportController extends Controller {
  public function __construct(){ Auth::requireLogin(); }
  public function form(): void {
    $pageTitle='แจ้งเหตุ/ข้อเสนอแนะ';
    echo '<div class="panel panel-info"><div class="panel-heading">แจ้งเหตุ</div><div class="panel-body">'
      .'<form id="reportForm"><input type="hidden" name="_csrf" value="'.Auth::csrfToken().'">'
      .'<div class="form-group"><label>รายละเอียด</label><textarea name="rep_content" class="form-control" rows="3" required></textarea></div>'
      .'<button class="btn btn-primary">ส่งรายงาน</button></form></div></div>'
      .'<script>$(function(){ $("#reportForm").on("submit", function(e){ e.preventDefault(); $.post("?r=/report/save", $(this).serialize()).done(function(r){ alert(r.message||"ส่งรายงานแล้ว"); $("#reportForm")[0].reset();});});});</script>';
  }
  public function save(): void { Auth::verifyCsrf(); $txt=trim((string)$this->input('rep_content','')); if($txt==='') $this->json(['success'=>false,'message'=>'กรุณาระบุรายละเอียด'],422); $id=(new Report())->create(['rep_content'=>$txt,'user_id'=>Auth::id()]); $this->json(['success'=>true,'message'=>'ส่งรายงานเรียบร้อย','id'=>$id]); }
}
