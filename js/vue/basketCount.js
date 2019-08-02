$(document).ready(function() {
	var vue_tovList = new Vue({
		el: '.menuCount',
		data: {
			selBasket : '../Vue/selBasketCount.php',
			basket: [],
			count: 0
		},
		methods: {
			getBasket: function () {
				var req = this.selBasket
				//console.log("req - "+req)
				this.$http.get(req).then(function (response) {
					this.basket = JSON.parse(response.data)
					for (var count of this.basket) {
						this.count = count.count
						console.dir("count - "+this.count)
						var c2=document.getElementById("sid")
						if (c2) c2.innerHTML =this.count
					}
				},function (error){
					console.log(error);
				})
			},			
		},
		created: function() {
			this.getBasket()
		}
	})	
})