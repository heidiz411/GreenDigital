/* global $ */
window.AppModal = (function(){
  function open(title, url) {
    $('#appModalLabel').text(title);
    $('#appModalBody').html('<p>Loading...</p>');
    $('#appModal').modal('show');
    return $.get(url).done(function(html){ $('#appModalBody').html(html); });
  }
  function close(){ $('#appModal').modal('hide'); }
  $(function(){ $('#appModal').on('hidden.bs.modal', function(){ $('#appModalBody').empty(); }); });
  return { open, close };
})();
