$(document).ready(function() {
var vue_tovList = new Vue({
	el: '#maker',
	data: {
		show: false,
		select : '../Vue/selMaker.php',
		add: '../Vue/add2el.php?name=',
		del: '../Vue/delDataVue.php?tab=emaker&nameid=id&id=',
		nameM:'',
		makers: []	
	},
	methods: {
		addItem: function () {
			const req = this.add+this.nameM+"&tab='emaker'"
			this.$http.get(req).then(function (response){     
				this.getAllMakers()
				this.show = false
				this.nameM = ""
			},function (error){
				console.log(error);
			})
		},		
		delItem: function(item) {
			let accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				let dl = this.del + item.id
				this.$http.delete(dl).then(function (response) {	          
					this.makers.splice(this.makers.indexOf(item),1)
				},function (error){
					console.log(error);
				})
			}     
		},	
		getAllMakers: function () {
			this.$http.get(this.select).then(function (response) {
				this.makers = JSON.parse(response.data)
			},function (error){
				console.log(error);
			})
		}
	},
	created: function() {
		this.getAllMakers()
	}
})
})