<div class="row">
    <div class="col-sm-3">
        <div class="panel panel-primary">
            <div class="panel-heading">สมาชิกทั้งหมด</div>
            <div class="panel-body" id="cardUsers">-</div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-success">
            <div class="panel-heading">บันทึกขยะ</div>
            <div class="panel-body" id="cardRecs">-</div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-info">
            <div class="panel-heading">แจ้งเหตุใหม่ <span id="adminNotifyBadge" class="badge"></span></div>
            <div class="panel-body" id="cardReports">-</div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-warning">
            <div class="panel-heading">องค์กร</div>
            <div class="panel-body" id="cardOrgs">-</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <canvas id="chartWasteByType" height="180"></canvas>
    </div>
    <div class="col-sm-6">
        <canvas id="chartWasteByMonth" height="180"></canvas>
    </div>
</div>
<script>
    $(function () {
        $.getJSON('?r=/api/admin/stats', function (s) {
            $('#cardUsers').text(s.users);
            $('#cardRecs').text(s.records);
            $('#cardReports').text(s.reports);
            $('#cardOrgs').text(s.orgs);
        });
    });
</script>
