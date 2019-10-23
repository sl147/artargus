$(document).ready(function() {
var vue_app = new Vue({
  el: '#length',
	data: {
		show: false,
		showEdit: false,
		seltype:"../Vue/selCMeasures.php?tab=",
		select:"../Vue/selCSubMeasures.php?type=",
		edit:   '/Vue/editSubCMeasures.php?id=',
		add:    '/Vue/addCSubMeasures.php?name=',
		del:    '/Vue/delDataVue.php?id=',
		newname:'',
		k: 1,
		elements: [],
		types: [],
		rob:[],
		type:'',
		idType: 1,
		typeCalc:'',
		
	},
	methods: {
		add2el: function () {
			let req = this.add+this.newname+"&type="+this.type
			this.$http.get(req).then(function (response){     
				this.getAll(this.type)
				this.show = !this.show
				this.newname = ""
			},function (error){
				console.log(error)
			})
		},		
		deleteElement: function(item) {
			var accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				let delt = this.del + item.id+"&tab=typeSubCalculator&nameid=id"
				this.$http.get(delt).then(function (response) {	          
					this.elements.splice(this.elements.indexOf(item),1)
				},function (error){
					console.log(error)
				})
			}     
		},		
		editElement: function(item){
			let req = this.edit + item.id+"&name="+item.name+"&idCalculator="+item.idCalculator
			console.log(req)
			this.$http.get(req).then(function (response){
			},function (error){
				console.log(error)
			})			
		},
		getTypes: function() {
			this.$http.get(this.seltype+'typeCalculator').then(function (response) {
				this.rob = JSON.parse(response.data)
					for (let r of this.rob){
						if (r.type == 1) {
							this.types.push(r)
						}
					}			
			},function (error){
				console.log(error)
			})
		},			
		getAll: function(t) {
			this.$http.get(this.select+t).then(function (response) {
				this.elements = JSON.parse(response.data)			
			},function (error){
				console.log(error)
			})
		}
	},
	watch: {
		typeCalc: function() {
			console.log('type='+this.typeCalc)
			if(this.typeCalc>0) {
				this.elements=[]
				
				this.type = this.typeCalc
				this.getAll(this.typeCalc)
				this.showEdit = true
			}
		}
	},
	created: function() {		
		this.getTypes()
	}	
  })
})