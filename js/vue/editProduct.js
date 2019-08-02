$(document).ready(function() {
var vue_tovList = new Vue({
	el: '#productsEdit',
	data: {
		show: false,
		selectParents : '../Vue/selParentProducts.php',
		selectGroups  : '../Vue/selGroup.php?kodTovParent=',
		del: '../Vue/delDataVue.php?tab=ecatalog&nameid=id&id=',
		delfoto: '../Vue/delFoto.php?id=',
		kodTovParent: 0,
		parents: [],
		groups: [],
		items: [],
		showGroup: '',
	},
	methods: {
		delItem: function(item) {
			let accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				let delfoto = this.delfoto + item.id
				this.$http.delete(delfoto).then(function (response) {	          
				},function (error){
					console.log(error);
				})				
				let delitem = this.del + item.id
				this.$http.get(delitem).then(function (response) {	          
					this.items.splice(this.items.indexOf(item),1)
				},function (error){
					console.log(error);
				})
			} 
		},
		delGroup: function(group) {
			let accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				let delgroup = this.del + group.id
				this.$http.delete(delgroup).then(function (response) {	          
					this.groups.splice(this.groups.indexOf(group),1)
				},function (error){
					console.log(error);
				})
			} 
		},		
		getGroupItem: function(group) {
			this.show = !this.show		
			for (let gr of this.groups) {
				gr.isPlus = (gr.id == group.id) ? !gr.isPlus : false
			}
			let req = this.selectGroups+group.kod_t
			this.$http.get(req).then(function (response){
				if (JSON.parse(response.data).length > 0) {
					this.items = JSON.parse(response.data);			                      
			    }
			},function (error){
				console.log(error);
			})							
		},		
		getGroupProducts: function () {
			let req = this.selectGroups+this.kodTovParent
			this.$http.get(req).then(function (response) {
				this.groups = JSON.parse(response.data)
			},function (error){
				console.log(error);
			})
		},
		getParents: function () {
			this.$http.get(this.selectParents).then(function (response) {
				this.parents = JSON.parse(response.data)
			},function (error){
				console.log(error);
			})
		}
	},
	watch: {		
		kodTovParent:  function (val, oldVal) {
			this.getGroupProducts()
		},
	},	
	created: function() {
		this.getParents()
	}
})
})