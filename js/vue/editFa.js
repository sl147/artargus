$(document).ready(function() {
var vue_tovList = new Vue({
	el: '#FAEdit',
	data: {
		select : '../Vue/selFAll.php?page=',
		del: '../Vue/delDataVue.php?tab=photoalbum&nameid=id_FA&id=',
		delSef : '../Vue/delSef.php?id=',
		nameM:'',
		page:1,
		show:1,
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
			let sel = this.select+this.page+'&show='+this.show
			this.$http.get(sel).then(function (response) {
				this.FAs = JSON.parse(response.data)
			},function (error){
				console.log(error);
			})
		}
	},
	created: function() {
		let get   = window.pageFA
		this.page = get["page"]
		this.show = get["show"]
		this.getAllFas()
	}
})
})