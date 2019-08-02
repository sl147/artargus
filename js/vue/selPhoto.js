$(document).ready(function() {
var vue = new Vue({
	el: '#selPhoto',
	data: {
		idFA:'',
		selFA : '../Vue/selFA.php?id=',
		upFA :  '../Vue/upFA.php?id=',
		del: '../Vue/delDataVue.php?tab=photoInAlbum&nameid=id_foto&id=',
		photos: [],
		subscribe:''
	},
	methods: {
		change: function (item) {
		    let req = this.upFA+item.id+"&subscribe="+item.subscribe
		    this.$http.get(req).then(function (response) {
		            this.getPhotos()
		    },function (error){
		            console.log(error)
		    })			
		},
		delItem: function(item) {
		    let accepted = confirm('Ви дійсно хочете видалити цей запис?')
		    if (accepted) {
		    	let delt = this.del + item.id
		        this.$http.delete(delt).then(function (response) {	          
					this.photos.splice(this.photos.indexOf(item),1)
		        },function (error){
		            console.log(error);
		        })
		    }     
		},            
		getPhotos: function () {
		    let req = this.selFA+this.idFA
		    this.$http.get(req).then(function (response) {
				this.photos = JSON.parse(response.data)
		    },function (error){
				console.log(error);
		    })			
		}
	},
	created: function() {
		let get   = window.idFA
		this.idFA = get["id"]
		this.getPhotos()
	}
})
})