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
  const $hiredAt = $('#hiredAt');
  const $birthAt = $('#birthAt');
  const $remarks = $('#remarks');

  $empNo.val(20);
  $nameSei.val('小林');
  $nameMei.val('太郎');
  $nameSeiKana.val('こばやし');
  $nameMeiKana.val('たろう');
  $password.val('1019');

  $dept.find('option:nth-child(2)').attr('selected', 'selected');
  $job.find('option:nth-child(2)').attr('selected', 'selected');
  $genderMale.attr('checked', 'checked');
  $hiredAt.val('2019-01-30');
  $birthAt.val('1999-01-01');
  $remarks.val('小林太郎さんのサンプル備考です。');
}

var app = new Vue({
  el: '#app',
  data: {
    employees: [], //一覧表示される社員情報
    will_delete_emp_no: null, //削除モーダルOK押下時に削除する社員の番号。
    will_delete_emp: null, //社員削除モーダルに表示される社員情報
    errs: [],
    is_regist_success: false,
  },
  methods: {
    registNewEmp: function(e) {
      //性別選択だけはラジオボタンなので、この取得方法にしています。
      let choose_gender = null;
      const $choose_gender_radio = document.querySelector('input[name="choose_gender"]:checked');
      if ($choose_gender_radio !== null) {
        choose_gender = $choose_gender_radio.value;
      }

      //ajaxパラメータの設定
      let params = new URLSearchParams();
      //削除予定の社員番号を設定
      const attr_names = ['emp_no', 'is_admin', 'name_sei', 'name_mei', 'name_sei_kana', 'name_mei_kana', 'pw', 'select_dept_id',
        'select_job_id', 'hired_at', 'birth_at', 'remarks'
      ];
      attr_names.forEach((attr_name) => {
        params.append(attr_name, this.$refs[attr_name].value);
      });
      params.append('choose_gender', choose_gender);
      //ajaxで社員番号により社員情報を削除する。
      axios.post('/emp_manage/public/ajax_q/regist_new_employee', params)
        .then(response => {
          //登録結果ステータス振り分け、エラーであればエラーメッセージ出力。
          //成功であれば成功メッセージ出力。(3秒後に消えます)
          const regist_status = response.data.status;
          if (regist_status === 'err') {
            this.errs = response.data.errs;
          } else if (regist_status === 'success') {
            this.errs = [];
            this.is_regist_success = true;
						//入力フォームの初期化
            attr_names.forEach((attr_name) => {
              this.$refs[attr_name].value = '';
            });
						$choose_gender_radio.checked = '';
            setTimeout(() => {
              this.is_regist_success = false;
            }, 3000);
          }
          //エラー時、メッセージが見えるようになどの理由のため、ページトップへスクロールさせる。
          window.scrollTo(0, 50);
        })
        .catch(e => {
          console.log(e)
        });
    },
    insertTestData: function(e) {
      insertTestData();
    },
  }
});
