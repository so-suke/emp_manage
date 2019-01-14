const $hiredAt = $("#hiredAt");
const $birthAt = $("#birthAt");
[$hiredAt, $birthAt].forEach(($e) => {
  $e.datepicker({
    changeYear: true,
    changeMonth: true,
    duration: 300,
    showAnim: 'show',
    dateFormat: 'yy年mm月dd日',
  });
})
