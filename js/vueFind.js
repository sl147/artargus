 var vue_corz = new Vue({
  //extends: vue_app,
  el: '#corzv',
  data: {
      countleft: 0

    },
   methods: {
    getCount: function() {
      //var x = document.cookie;
      // var x = GetCookie("basket");
      var cookie = " " + document.cookie;
      var search = " " + "count" + "=";
      var setStr = null;
      var offset = 0;
      var end = 0;
      if (cookie.length > 0) {
        offset = cookie.indexOf(search);
        if (offset != -1) {
          offset += search.length;
          end = cookie.indexOf(";", offset)
          if (end == -1) {
            end = cookie.length;
          }
          setStr = unescape(cookie.substring(offset, end));
        }
      }
      //alert("cookie:  "+setStr+"    x="+x)
      this.countleft = setStr
      console.log("countleft = "+setStr)
      //alert("cookie:  "+setStr)

      //return(setStr);
}    
   },
watch: {
      countleft: function(val, oldVal) {
      this.getCount()
      console.log("watch countleft = "+this.countleft+"  oldVal = "+oldVal+" val = "+val)
      deep: true
      immediate: true
        
      }
    },   
   created: function() {
    this.getCount()
   },
   updated: function() {
    this.getCount()
   }   
})

var vue_fgr3 = new Vue({
  el: '#fgr3',
  data: {
    idb: "",
    count: 1,
    countin: 1,
    endpoint: 'add2basket.php?'
  },
  methods: {
      clickMethod: function(idbf, countf) {
        //console.log("click  searchString = "+value);
        var req = this.endpoint+"idb=" + idbf+"&count="+countf
        //alert("click yere idb = "+idbf+"  count = "+countf+"  req = "+req);
       this.$http.get(this.endpoint+"idb=" + idbf+"&count="+countf).then(function (response){
          var s = JSON.parse(response.data);
          this.count += s.quantity
          alert("console  = "+s.id+"   q  = "+s.quantity);
        },function (error){
          alert(error);
        })       
      }
   }
})

var vue_app = new Vue({
  el: '#app',
  data: {
      searchString: "",
      searchStringold: "",
      endpoint: 'findAjax.php?str=',
      articles: [],
      sortingArticles: [],
      massage: "Hello",
      blocking: false,
      showList: false
    },
    methods: {
      getAllPosts: function () {
       this.$http.get(this.endpoint + this.searchString).then(function (response){
          this.articles = JSON.parse(response.data);
          //console.log("console  = "+response.data);
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
  })