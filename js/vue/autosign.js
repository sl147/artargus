$(document).ready(function() {
	var vue_sign = new Vue({
		el: '#sign',
		data: {
			selRegion : '../Vue/selRegion.php',
			regionName: '',
			regionKod:'',
			lookKod: false,
			lookName:false,
			prTxt: false,
			prKod: false,
			regView: '',
			nameView: '',
			single_option: [],
			symbols: [],
			getRegtxt:[],
			options_region: [
				{ text: 'АР Крим',          value: 'КК' },
				{ text: 'АР Крим',          value: 'АК' },
				{ text: 'Вінницька',        value: 'КВ' },
				{ text: 'Вінницька',        value: 'АВ' },
				{ text: 'Волинська',        value: 'КС' },
				{ text: 'Волинська',        value: 'АС' },
				{ text: 'Дніпропетровська', value: 'КЕ' },
				{ text: 'Дніпропетровська', value: 'АЕ' },
				{ text: 'Донецька',         value: 'КН' },
				{ text: 'Донецька',         value: 'АН' },
				{ text: 'Житомирська',      value: 'КМ' },
				{ text: 'Житомирська',      value: 'АМ' },
				{ text: 'Закарпатська',     value: 'КО' },
				{ text: 'Закарпатська',     value: 'АО' },
				{ text: 'Запоріжська',      value: 'КР' },
				{ text: 'Запоріжська',      value: 'АР' },
				{ text: 'Івано-Франківська',value: 'КТ' },
				{ text: 'Івано-Франківська',value: 'АТ' },
				{ text: 'Київська',         value: 'КI' },
				{ text: 'Київська',         value: 'АI' },
				{ text: 'м.Київ',           value: 'АА' },
				{ text: 'м.Київ',           value: 'КА' },
				{ text: 'Кіровоградська',   value: 'НА' },
				{ text: 'Кіровоградська',   value: 'ВА' },
				{ text: 'Луганська',        value: 'НВ' },
				{ text: 'Луганська',        value: 'ВВ' },
				{ text: 'Львівська',        value: 'НС' },
				{ text: 'Львівська',        value: 'ВС' },
				{ text: 'Миколаївська',     value: 'НЕ' },
				{ text: 'Миколаївська',     value: 'ВЕ' },
				{ text: 'Одеська',          value: 'НН' },
				{ text: 'Одеська',          value: 'ВН' },
				{ text: 'Полтавська',       value: 'НІ' },
				{ text: 'Полтавська',       value: 'ВІ' },
				{ text: 'Рівненська',       value: 'НК' },
				{ text: 'Рівненська',       value: 'ВК' },
				{ text: 'Сумська',          value: 'НМ' },
				{ text: 'Сумська',          value: 'ВМ' },
				{ text: 'м.Севастополь',    value: 'ІН' },
				{ text: 'м.Севастополь',    value: 'СН' },
				{ text: 'Тернопільська',    value: 'НО' },
				{ text: 'Тернопільська',    value: 'ВО' },
				{ text: 'Харьківська',      value: 'КХ' },
				{ text: 'Харьківська',      value: 'АХ' },
				{ text: 'Херсонська',       value: 'НТ' },
				{ text: 'Херсонська',       value: 'ВТ' },
				{ text: 'Хмельницька',      value: 'НХ' },
				{ text: 'Хмельницька',      value: 'ВХ' },
				{ text: 'Черкаська',        value: 'ІА' },
				{ text: 'Черкаська',        value: 'СА' },
				{ text: 'Чернігівска',      value: 'ІВ' },
				{ text: 'Чернігівска',      value: 'СВ' },
				{ text: 'Чернівецька',      value: 'ІЕ' },
				{ text: 'Чернівецька',      value: 'СЕ' },
				{ text: 'Загальнодержавний',value: 'ІІ' },
			],
		},
		methods: {
			getRegionText: function(txt) {
				this.getRegtxt = _.filter(this.options_region, function (item) {
				return item.text == txt;
				})				
			},
			getRegionKod: function(txt) {
				this.getRegtxt = _.filter(this.options_region, function (item) {
				return item.value == txt;
				})				
			}			
		},
		computed: {
			reg1: function(){
				var regTxt = ''
				for (var order of this.getRegtxt) {
					console.log("computed - "+order.text+"   value - "+order.value)
					this.regionName = order.text
					this.regionKod = order.value
					regTxt = regTxt + order.value+' '
					console.log('regTxt1:'+order.value)
				}
				regTxt = regTxt + this.regionName
				console.log('regTxt:'+regTxt)				
				//return this.regionKod+" "+this.regionName;
				return regTxt
			}			
		},
		watch: {
			regionKod: function() {
				this.lookKod = true
				this.lookName = false
				console.log("regionKod:"+this.regionKod)
				this.getRegionKod(this.regionKod)
				this.regView = 'Код регіону:'
				for (var order of this.getRegtxt) {
					//console.log("text - "+order.text+"   value - "+order.value)
					//this.regionName = ''//order.text
					this.nameView = order.text
					//this.regionKod = order.value
					this.regView += order.value + ' '
				}
				console.log('regkod:'+this.regView)
			},
			regionName: function() {
				console.log("regionName:"+this.regionName)
				this.getRegionText(this.regionName)
				this.regView = 'Коди регіону:'
				for (var order of this.getRegtxt) {
					console.log("text - "+order.text+"   value - "+order.value)
					//this.regionKod = ''
					this.nameView = order.text
					this.regView += order.value + ' '
				}
				console.log('regTxt:'+this.regView)
			},
			},
			created: function() {
				for (var order of this.options_region) {
					if (!this.single_option.includes(order.text)) {
						this.single_option.push(order.text)
					}
					this.symbols.push(order.value)
				}
				this.symbols.sort();
			}		
	})
})