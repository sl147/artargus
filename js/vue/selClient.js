$(document).ready(function() {
var vue_tovList = new Vue({
el: '#selClient',
	data: {
		show: false,
		selCl : '../Vue/selClient.php',
		select : '../Vue/selClientOne.php?id=',
		idCl:0,
		clients: [],
		status: [],
		orders: []
	},
	methods: {
		getOrders: function () {
			let req = this.select+this.idCl
			this.$http.get(req).then(function (response) {
				this.orders = JSON.parse(response.data)
			},function (error){
				console.log(error);
			})
		},
		getClients: function () {
			this.$http.get(this.selCl).then(function (response) {
				this.clients = JSON.parse(response.data)
			},function (error){
				console.log(error);
			})
		},		
	},
	watch: {		
		idCl:  function (val, oldVal) {
			this.getOrders()
		},
	},	
	created: function() {
		this.getClients()
		this.getOrders()
	}	
})	
})