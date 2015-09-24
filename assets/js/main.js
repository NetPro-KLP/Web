$(document).ready(function() {
  setTimeout(function() {
      toastr.options = {
          closeButton: true,
          progressBar: true,
          showMethod: 'slideDown',
          timeOut: 1500
      };
      toastr.success('박정현 서버 관리자님 환영합니다.', 'NetPro-KLP Control Panel');
  }, 1300);
});