var app = new Vue({
  el: '#app',
  data: {
    employees: [],
    base_skills: [],
		input_keyword: '',
		is_open_candidate_keywords: false,
		candidate_keywords: [],
  },
  created: function() {
    this._getSkills();
  },
  methods: {
    _getSkills: function() {
      axios.post('/emp_manage/public/ajax_q/get_skills')
        .then(response => {
          this.base_skills = response.data.skills;
        })
        .catch(e => {
          console.log(e)
        })
    },
    searchCandidateKeyword: function() {
      if (this.input_keyword === '') {
        this.is_open_candidate_keywords = false;
        return;
      }

      this._filterCandidateKeywords();
      if (this.candidate_keywords.length !== 0) {
        this.is_open_candidate_keywords = true
      }
    },
    _filterCandidateKeywords: function() {
      this.candidate_keywords = this.base_skills.filter(skill => skill.keyword.startsWith(this.input_keyword.toLowerCase()));
    },
    setResult: function(result, event) {
      event.preventDefault()
      this.inputed.push(result)
      this.is_open_candidate_keywords = false;
      this.input_keyword = '';
    },
		//スキル一覧画面の実装方法が分からなくなってしまいました。今後利用するかもしれません。ひとまずコメントアウトしておきます。
    // _get_employees: function() {
    //   axios.get('/emp_manage/public/ajax_q/get_with_skill_employees')
    //     .then(response => {
    //       this.employees = response.data.employees;
    //       this.$refs.skillKeyword.value = response.data.skill_keyword;
    //     })
    //     .catch(e => {
    //       console.log(e)
    //     })
    // },
  }
});
