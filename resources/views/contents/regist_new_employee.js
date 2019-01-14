// テストデータ記載のためです。
const insertTestData = () => {
  const $empNo = $('#empNo');
  const $nameSei = $('#nameSei');
  const $nameMei = $('#nameMei');
  const $nameSeiKana = $('#nameSeiKana');
  const $nameMeiKana = $('#nameMeiKana');
  const $password = $('#password');
  const $dept = $('#dept');
  const $job = $('#job');
  const $genderMale = $('#genderMale');
  const $remarks = $('#remarks');

  $empNo.val(7);
  $nameSei.val('小林');
  $nameMei.val('太郎');
  $nameSeiKana.val('こばやし');
  $nameMeiKana.val('たろう');
  $password.val('1019');

  $dept.find('option:nth-child(2)').attr('selected', 'selected');
  $job.find('option:nth-child(2)').attr('selected', 'selected');
  $genderMale.attr('checked', 'checked');
  $hiredAt.val('2019-01-01');
  $birthAt.val('2019-01-01');
  $remarks.val('サンプル備考です。');
}

const $insertTestData = document.getElementById('insertTestData');
$insertTestData.addEventListener('click', () => {
	console.log('hello')
	insertTestData();
});
