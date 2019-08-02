$(document).ready(function() {
let vue_app = new Vue({
  el: '#vue2el',
	data: {
		show: false,
		select: '/Vue/select2el.php?tab=',
		edit:   '/Vue/edit2el.php?id=',
		add:    '/Vue/add2el.php?name=',
		del:    '/Vue/delDataVue.php?id=',
		nameElement:'',
		table:'',
		elements: []	
	},
	methods: {
		add2el: function () {
			let req = this.add+this.nameElement+"&tab="+this.table
			this.$http.get(req).then(function (response){     
				this.getAll()
				this.show = !this.show
				this.nameElement = ""
			},function (error){
				console.log(error)
			})
		},		
		del2el: function(item) {
			let accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				let delt = this.del + item.id+"&tab="+this.table+"&nameid=id"
				this.$http.delete(delt).then(function (response) {	          
					this.elements.splice(this.elements.indexOf(item),1)
				},function (error){
					console.log(error)
				})
			}     
		},		
		edit2el: function(item){
			let req = this.edit + item.id+"&name="+item.name+"&tab="+this.table
			this.$http.get(req).then(function (response){
			},function (error){
				console.log(error)
			})			
		},		
		getAll: function () {
			let req = this.select+this.table
			this.$http.get(req).then(function (response) {
				this.elements = JSON.parse(response.data)
			},function (error){
				console.log(error)
			})
		}
	},
	created: function() {
		let get = window.table
		this.table = get["table"]
		this.getAll()
	}	
  })
})