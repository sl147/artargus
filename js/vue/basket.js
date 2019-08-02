$(document).ready(function() {
	var vue_tovList = new Vue({
		el: '#basket',
		data: {
			selBasket : '../Vue/selBasket.php',
			upBasket :  '../Vue/upBasket.php?id=',
			delBasket : '../Vue/delBasket.php?id=',
			basket: [],
			num: 0,
			bas: 0
		},
		methods: {
			change: function (r) {
				//console.log("name - "+r.name+"  q="+r.q+"  id="+r.id)
				var req = this.upBasket+r.id+"&count="+r.q
				this.$http.get(req).then(function (response) {
				},function (error){
					console.log(error);
				})			
			},			
			nom: function(){
				this.num ++
				return this.num
			},
			price: function(p){
				var price = p * 1
				return price.toFixed(2)
			},
			suma: function(p,q,bas){
				var sum = p * q
				return sum.toFixed(2)
			},
			totQ: function() {
				var t = 0
				for (var bas of this.basket) {
					t += bas.q	
				}
				return t
			},
			totSuma: function() {
				var s = 0
				for (var bas of this.basket) {
					s+= bas.q * bas.price
				}
				return s.toFixed(2)
			},
			getBasket: function () {
				var req = this.selBasket
				//console.log("req - "+req)
				this.$http.get(req).then(function (response) {
					this.basket = JSON.parse(response.data)
				},function (error){
					console.log(error);
				})
			},
			clickDel: function(item) {
				var accepted = confirm('Ви дійсно хочете видалити цей запис?');
				if (accepted) {
					var del = this.delBasket + item.id
					this.$http.get(del).then(function (response) {	          
						this.basket.splice(this.basket.indexOf(item),1)
						var i=1
						for (var bas of this.basket) {
							bas.i = i
							i++
						}						
					},function (error){
						console.log(error);
					})
				}     
		},
		},
		created: function() {
			this.getBasket()
		}
	})	
})