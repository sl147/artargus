$(document).ready(function() {
	var vue_sign = new Vue({
		el: '#length',
		data: {
			selectType : "../Vue/selCMeasuresType.php?type=",
			selectTypeActive : "../Vue/selCMeasuresTypeActive.php?type=",
			select : "../Vue/selCMeasures.php?tab=",
			editQ : "../Vue/editCQ.php?id=",
			elements:[],
			rob:[],
			types:[],
			typesActive:[],
			quantity: 1,
			first: 0,
			second:0,
			typeCalc: 0,
			show: false	,
			nameFirst:'',
			l:'margin-left:40px;width: 80px;border-style:none;padding-left:10px;'		
		},
		methods: {
			sort: function() {
				this.elements.sort(function(a, b){
				let nameA=a.name.toLowerCase()
				let nameB=b.name.toLowerCase()
				if (nameA < nameB) //сортуєм стрічки по зростанню
				  return -1
				if (nameA > nameB)
				  return 1
				return 0 // Ніякого сортування
				})				
			},
			getAllActive: function(type) {
				this.$http.get(this.selectTypeActive+type).then(function (response) {
					this.typesActive = JSON.parse(response.data)
					this.sort()
				},function (error){
					console.log(error)
				})
			},
			getAll: function(type) {
				this.$http.get(this.selectType+type).then(function (response) {
					this.elements = JSON.parse(response.data)
					this.sort()
				},function (error){
					console.log(error)
				})
			},
			getTypes: function() {
				this.$http.get(this.select+'typeCalculator').then(function (response) {
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
			resActive: function(t) {
				return (this.first.k > 0) ? (this.first.k/t.k * this.quantity).toFixed(5) : 0
			},
			getNameFirst: function(t){
				for (let n of this.elements) {
					if (n.id == t) {
						return n.name
					}
				}
			},
			saveQ: function(id,q) {
				q = parseInt(q) + 1
				let s = this.editQ+id+'&q='+q
				this.$http.get(s).then(function (response) {
				},function (error){
					console.log(error)
				})				
			},
			saveQuantity: function() {
				if ((this.first.k > 0) && (this.second.k > 0)) {
					this.saveQ(this.first.id,this.first.quantity)
					this.saveQ(this.second.id,this.second.quantity)
				}
			}
		},
		watch: {
			typeCalc: function() {
				if(this.typeCalc>0) {
					this.elements=[]
					this.getAll(this.typeCalc)
					this.getAllActive(this.typeCalc)					
					this.show     = true
					this.result   = ''
					this.quantity = 1
					this.first    = 0
					this.second   = 0
				}
			},
			first: function(){
				this.saveQuantity()
			},
			second: function(){
				this.saveQuantity()
			},
			quantity: function(){
				this.quantity = (this.quantity>0) ? this.quantity : 1
				let m = (this.quantity.length * 10)+50
				m = (m > 500) ? 500 : m
				this.l = 'width: '+m+'px;border-style:none;padding-left:10px;margin-left:40px;'
			}
		},		
		computed: {
			result: function() {
				return ((this.first.k > 0) && (this.second.k > 0)) ? (this.first.k/this.second.k * this.quantity).toFixed(5) : 0
			}
		},
		created: function() {			
			this.getTypes()		
		}		
	})
})