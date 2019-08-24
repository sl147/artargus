$(document).ready(function() {
var vue_tovList = new Vue({
	el: '#admin',
	data: {
		select : '../Vue/selAdmin.php?page=',
		page:1,
		show:1,
		orders: []	
	},
	methods: {
		getAll: function(){
			let sel = this.select+this.page+'&show='+this.show
			this.$http.get(sel).then(function (response) {
				this.orders = JSON.parse(response.data)
/*				for (var order of this.orders) {
		          console.log("name - "+order.name+"   id - "+order.id_ord)
		        }*/
			},function (error){
				console.log(error);
			})			
		}
	},
	created: function(){
		let get   = window.admin
		this.page = Number(get["page"])
		this.show = get["show"]
		if (isNaN(this.page)) this.page = 1
		console.log('page='+this.page);
		this.getAll()		
	}
})
})