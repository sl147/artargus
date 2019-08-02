/*var vue_app = new Vue({
  el: '#tovPlus',
  data: {
    show:  false,
    mas: "Hello Vue"
  },
  
})

		var vue_tovList = new Vue({
			el: '#tovList6',
			data: {
				show:  false,
				mas6: "Hello Vue",
				idb: "",
				endpoint: 'sel_order.php?orderid=',
				saveorder: 'save_order.php?orderid=',
				orderid: "",
				articles: []				
			},
methods: {
	onclick: function() {
		for (var key in this.articles) {
			var count = this.articles[key].q;
			var idb   = this.articles[key].id_tov;
			var ht    = this.saveorder + this.orderid+"&count="+count+"&idb="+idb;
			console.log("ht "+ht);
			this.$http.get(this.saveorder + this.orderid+"&count="+count+"&idb="+idb).then(function (response){
			},function (error){
				console.log("err "+error.data);
			})
			}
	},
	      getAllPosts: function () {
			console.log("getAllPosts  orderid  = "+this.endpoint+this.orderid );
			this.$http.get(this.endpoint + this.orderid).then(function (response){
				this.articles = JSON.parse(response.data);
				//var mas = JSON.parse(response.data);
				//console.log("mas  kod_t  = "+mas[0].kod_t);
			},function (error){
				console.log(error);
			})

      },
        toggleActive: function(s){
            s.active = !s.active;
        },
        suma: function(p,q){
        	suma = p * q;
        	return suma;
        },
        total: function(){
            var total = 0;

			for (var key in this.articles) {
				total+= this.articles[key].price * this.articles[key].q;
			}
			           
   //         this.orders.forEach(function(s){
            //console.log( i + ": " + s + " (массив:" + arr + ")" );             
     //               total+= s.price * s.q;             
       //     });
           return total;
        },
        totalQuantity: function(){
            var total = 0;
			for (var key in this.articles) {
				total+= this.articles[key].q*1;
			}           
           return total;
        }    
    },
    created: function() {
		var massiv = <?= $json ?>;
		this.orderid = massiv["orderid"];
		//this.articles = JSON.parse(data);
		console.log("orderid  = "+this.orderid );
		this.getAllPosts();    	
		    }		
		})*/