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
			},function (error){
				console.log(error);
			})			
		}
	},
	created: function(){
		let get   = window.admin
		this.page = get["page"]
		this.show = get["show"]
		this.getAll()		
	}
})
})