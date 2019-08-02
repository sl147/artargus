$(document).ready(function() {
var vue_tovList = new Vue({
	el: '#FAEdit',
	data: {
		show: false,
		select : '../Vue/selFAll.php',
		del: '../Vue/delDataVue.php?tab=photoalbum&nameid=id_FA&id=',
		delSef : '../Vue/delSef.php?id=',
		nameM:'',
		FAs: []	
	},
	methods: {		
		delItem: function(item) {
			let accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				let del = this.del + item.id
				this.$http.delete(del).then(function (response) {	          
					this.FAs.splice(this.FAs.indexOf(item),1)
				},function (error){
					console.log(error);
				})
				del = this.delSef + item.id+"&namelink=faChange"
				this.$http.get(del).then(function (response) {
				},function (error){
					console.log(error);
				})				
			}     
		},
		getAllFas: function () {
			this.$http.get(this.select).then(function (response) {
				this.FAs = JSON.parse(response.data)
			},function (error){
				console.log(error);
			})
		}
	},
	created: function() {
		this.getAllFas()
	}
})
})