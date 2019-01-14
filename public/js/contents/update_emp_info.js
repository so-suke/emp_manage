var app = new Vue({
  el: '#app',
  data: {
    update_emp_no: '',
    // isInputedEmpNo: false,
    componentLoaded: false,
  },
  mounted() {
    this.componentLoaded = true;
  },
  methods: {
    showUpdateEmpModal: function(e) {
      $('#updateEmpModal').modal('show');
    },
    updateEmpInfo: function(e) {
      //formのhiddenに設定してからform送信させる。
      this.update_emp_no = this.$refs.willUpdateEmpNo.value;
      //なぜか、非同期にしないと、hiddenに設定した社員番号が送信されないので、このようにしています。
      setTimeout(() => {
        this.$refs.updateEmpInfoForm.submit();
      }, 1);
    },
  },
  computed: {
    isInputedEmpNo: function() {
			if(this.componentLoaded !== true) return false;
      return this.$refs.willUpdateEmpNo.value !== '';
    }
  }
});
