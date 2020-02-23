// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "language": {
      "infoEmpty": "Нет записей",
      "info": "Показана страница _PAGE_ из _PAGES_",
      "lengthMenu": "Показывать _MENU_ записей",
      "paginate": {
        "next": "Следующая",
        "previous": "Предыдущая"
      },
      "loadingRecords": "Загрузка...",
      "search": "Поиск",
      "zeroRecords": "Нет записей"
    }
  });
});
