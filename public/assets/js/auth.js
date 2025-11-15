/* global $, window */
$(function(){
  $('#loginForm').on('submit', function(e){ e.preventDefault();
    $.post('?r=/do-login', $(this).serialize())
      .done(function(res){ if(res.success){ window.location='?r=/'; } else { alert(res.message); }})
      .fail(function(xhr){ alert(xhr.responseJSON?.message||'เข้าสู่ระบบไม่สำเร็จ'); });
  });
  $('#registerForm').on('submit', function(e){ e.preventDefault();
    $.post('?r=/do-register', $(this).serialize())
      .done(function(res){ alert(res.message||'สมัครสำเร็จ'); if(res.success) window.location='?r=/login'; })
      .fail(function(xhr){ alert(xhr.responseJSON?.message||'สมัครไม่สำเร็จ'); });
  });
  $('#profileForm').on('submit', function(e){ e.preventDefault();
    $.post('?r=/profile/save', $(this).serialize())
      .done(function(res){ alert(res.message||'บันทึกแล้ว'); })
      .fail(function(xhr){ alert(xhr.responseJSON?.message||'บันทึกไม่สำเร็จ'); });
  });
  $('#changePassForm').on('submit', function(e){ e.preventDefault();
    $.post('?r=/profile/change-password', $(this).serialize())
      .done(function(res){ alert(res.message||'เปลี่ยนรหัสผ่านสำเร็จ'); $('#changePassForm')[0].reset(); })
      .fail(function(xhr){ alert(xhr.responseJSON?.message||'เปลี่ยนรหัสผ่านไม่สำเร็จ'); });
  });
  $('#forgotForm').on('submit', function(e){ e.preventDefault();
    $.post('?r=/forgot-verify', $(this).serialize())
      .done(function(res){ if(res.success){ $('#resetUserId').val(res.user_id); $('#resetSection').show(); } else { alert(res.message); }});
  });
  $('#resetForm').on('submit', function(e){ e.preventDefault();
    $.post('?r=/reset-password', $(this).serialize())
      .done(function(res){ alert(res.message||'ตั้งรหัสผ่านใหม่สำเร็จ'); if(res.success){ window.location='?r=/login'; }});
  });
});
