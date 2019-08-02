$(document).ready(function() {
var vue_tovList = new Vue({
	el: '#group',
	data: {
		show: false,
		selGroup : '../Vue/selectGroup.php',
		editGroup : '../Vue/edit2el.php?id=',
		addGroup: '../Vue/addGroup.php?name=',
		delItem: '../Vue/delDataVue.php?tab=ecatalog&nameid=id&id=',
		nameGroup:'',
		groups: []	
	},
	methods: {
		add: function () {
			let req = this.addGroup+this.nameGroup
			this.$http.get(req).then(function (response){     
				this.getAllGroups()
				this.show = !this.show
				this.nameGroup = ""
			},function (error){
				console.log(error);
			})
		},		
		clickDel: function(item) {
			let accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				let del = this.delItem + item.id
				this.$http.delete(del).then(function (response) {	          
					this.groups.splice(this.groups.indexOf(item),1)
				},function (error){
					console.log(error);
				})
			}     
		},		
		edit: function(g){
			let req = this.editGroup + g.id+"&name="+g.name+"&tab=ecatalog"
			console.log("req="+req)
			this.$http.get(req).then(function (response){
			},function (error){
				console.log(error);
			})			
		},		
		getAllGroups: function () {
			this.$http.get(this.selGroup).then(function (response) {
				this.groups = JSON.parse(response.data)				
			},function (error){
				console.log(error);
			})
		}
	},
	created: function() {
		this.getAllGroups()
	}
})
})