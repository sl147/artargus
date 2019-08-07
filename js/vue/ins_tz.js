$(document).ready(function() {
var vue_app = new Vue({
  el: '#tz',
	data: {
		show: false,
		select: '/Vue/selTZ.php',
		edit:   '/Vue/editTZ.php?id=',
		add:    '/Vue/addTZ.php?name=',
		del:    '/Vue/delDataVue.php?id=',
		newname:'',
		type: '',
		k1: 1,
		elements: [],
	},
	methods: {
		beforeEnter: function (el) {
		      el.style.opacity = 0		      
		},
		enter: function (el, done) {
/*	      Velocity(el, { opacity: 1, fontSize: '1.4em' }, { duration: 300 })
	      velocity(el, { fontSize: '1em' }, { complete: done })*/
	      el.style.animationDuration = "4.5s"
	      el.style.animationDirection = "reverse"
	      el.style.opacity = 1
	     done()
	      console.log('enter')
	    },

		add2el: function () {
			let req = this.add+this.newname+"&type="+this.type+"&k1="+this.k1
			this.$http.get(req).then(function (response){     
				this.getAll()
				this.show = !this.show
				this.newname = ""
				this.type = ""
				this.k1 = 1
			},function (error){
				console.log(error)
			})
		},		
		deleteElement: function(item) {
			var accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				let delt = this.del + item.id+"&tab=in_type&nameid=id"
				this.$http.get(delt).then(function (response) {	          
					this.elements.splice(this.elements.indexOf(item),1)
				},function (error){
					console.log(error)
				})
			}     
		},		
		editElement: function(item){
			let req = this.edit + item.id+"&type="+item.type+"&name="+item.name+"&k1="+item.k1
			this.$http.get(req).then(function (response){
			},function (error){
				console.log(error)
			})			
		},		
		getAll: function() {
			//console.log('here;'+this.select)
			this.$http.get(this.select).then(function (response) {
				this.elements = JSON.parse(response.data)			
			},function (error){
				console.log(error)
			})
		}
	},
	created: function() {
		this.getAll()
	}	
  })
})