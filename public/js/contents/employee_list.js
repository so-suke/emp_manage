var app = new Vue({
  el: '#app',
  data: {
    employees: [],//一覧表示される社員情報
    will_delete_emp_no: null, //削除モーダルOK押下時に削除する社員の番号。
    will_delete_emp: null,//社員削除モーダルに表示される社員情報
  },
  created: function() {
		//初回に社員一覧情報を取得
    this._getEmployees();
  },
  methods: {
		//社員一覧情報を取得
    _getEmployees: function() {
      axios.get('/emp_manage/public/ajax_q/get_employees')
        .then(response => {
					//一覧表示される社員情報の取得
          this.employees = response.data.employees;
          this.$refs.filterEmpNameSei.value = response.data.filter_name_sei;
          this.$refs.filterEmpNameMei.value = response.data.filter_name_mei;
        })
        .catch(e => {
          console.log(e)
        })
    },
    showDeleteEmpModal: function(e) {
      //削除予定の社員番号
      this.will_delete_emp_no = e.target.dataset.empNo;
      //ajaxパラメータの設定
      let params = new URLSearchParams();
      //社員番号を設定
      params.append('emp_no', this.will_delete_emp_no);
      //社員削除モーダルに表示される社員情報を取得。
      axios.post('/emp_manage/public/ajax_q/get_employee_by_emp_no', params)
        .then(response => {
          this.will_delete_emp = response.data.employee;
          $('#deleteEmpModal').modal('show');
        })
        .catch(e => {
          console.log(e)
        });
    },
    deleteEmp: function(e) {
			//ajaxパラメータの設定
      let params = new URLSearchParams();
			//削除予定の社員番号を設定
      params.append('will_delete_emp_no', this.will_delete_emp_no);
      //ajaxで社員番号により社員情報を削除する。
      axios.post('/emp_manage/public/ajax_q/delete_employee_by_emp_no', params)
        .then(response => {
          $('#deleteEmpModal').modal('hide');
          this._getEmployees();
        })
        .catch(e => {
          console.log(e)
        });

    },
    filterName: function() {
      const name_sei = this.$refs.filterEmpNameSei.value;
      const name_mei = this.$refs.filterEmpNameMei.value;

      let params = new URLSearchParams();
      params.append('name_sei', name_sei);
      params.append('name_mei', name_mei);

      //社員名の絞り込み条件をセッションに保存
      axios.post('/emp_manage/public/ajax_q/save_name_filter_val', params)
        .then(response => {
					//保存された絞り込み条件を元に社員一覧を再度取得する。
          this._getEmployees();
        })
        .catch(e => {
          console.log(e)
        })
    }
  }
});

$('#deleteEmpModal').on('hidden.bs.modal', function(e) {
  app.will_delete_emp_no = null;
  app.will_delete_emp = null;
});
