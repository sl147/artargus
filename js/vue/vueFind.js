$(document).ready(function() {
var vue_app = new Vue({
  el: '#find',
    data: {
      searchString: "",
      searchStringold: "",
      endpoint: '../Vue/findAjax.php?str=',
      articles: [],
      sortingArticles: [],
      massage: "Hello",
      blocking: false,
      showList: false
    },
    methods: {
      getAllPosts: function () {
        var req = this.endpoint + this.searchString
        console.log("req - "+req)
        this.$http.get(req).then(function (response){
          this.articles = JSON.parse(response.data);
        for (var order of this.articles) {
          console.log("name - "+order.name+"   id - "+order.id)
        }
        },function (error){
          console.log(error);
        })
      },
      clickMethod: function(value) {
        this.showList = false
        this.blocking = true;
        this.searchString = value;
        console.log("click  searchString = "+value);
      },      
      hovMethod: function(value) {
        this.blocking = true;
        this.searchString = value;
        console.log("hovMethod searchString = "+value);
      },
      focusMethod: function() {       
        if(this.searchString.length > 1) {
          this.blocking = false;
          this.showList = true;
          console.log('focus  length '+this.searchString+"  blocking - "+this.blocking+"  showList - "+this.showList+"  articles = "+this.articles.length)                        
//          console.log('focus '+this.searchString+"  blocking - "+this.blocking+"  showList - "+this.showList)
          this.getAllPosts()
        }
      }           
    },
    watch: {
      searchString: function(value) {
        if(this.searchString.length < 2) {
          console.log("here")
        }
        else {
          console.log('w', value)
          this.showList = true
          if (!this.blocking) this.getAllPosts()
        }
      }
    },
    created: function() {
      console.log("is cr")
    }
  })
})