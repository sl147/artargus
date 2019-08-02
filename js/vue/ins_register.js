$(document).ready(function() {
var vue_app = new Vue({
  el: '#register',
	data: {
		show: false,
		select: '/Vue/selReestTZ.php',
		edit:   '/Vue/editReestTZ.php?id=',
		add:    '/Vue/addReestTZ.php?name=',
		del:    '/Vue/delDataVue.php?id=',
		newname:'',
		k2: 1,
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
			let req = this.add+this.newname+"&k2="+this.k2
			this.$http.get(req).then(function (response){     
				this.getAll()
				this.show = !this.show
				this.newname = ""
				this.k2 = 1
			},function (error){
				console.log(error)
			})
		},		
		deleteElement: function(item) {
			var accepted = confirm('Ви дійсно хочете видалити цей запис?');
			if (accepted) {
				let delt = this.del + item.id+"&tab=in_chek&nameid=id"
				this.$http.get(delt).then(function (response) {	          
					this.elements.splice(this.elements.indexOf(item),1)
				},function (error){
					console.log(error)
				})
			}     
		},		
		editElement: function(item){
			let req = this.edit + item.id+"&name="+item.name+"&k2="+item.k2
			this.$http.get(req).then(function (response){
			},function (error){
				console.log(error)
			})			
		},		
		getAll: function() {
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