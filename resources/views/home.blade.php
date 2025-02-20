<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Car Test</title>

		<!-- In a production situation these would probably pulled into the project by NPM instead of a CDN -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
		<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    </head>

    <body class="container">
		<div class="p-4 bg-secondary-subtle">

			<!-- In a production situation this would probably be a separate vue template file -->
			<h1>Car Auction Test</h1>
			<div id="app">
				<div>  
					<label for="amount" class="form-label">Bid Amount</label>
					<input id="amount" v-model="amount" class="form-control form-control-lg" type="text" placeholder="Bid Amount" aria-label="Bid Amount">
				</div>
				<div>  
					<label for="type" class="form-label">Vehicle Type</label>
					<select id="type" v-model="type"  @change="updatePrice()" class="form-select" aria-label="Vehicle Type">
						<option v-for="option in options" :value="option.value">
						@{{option.text}}
						</option>
					</select>
				</div>

				<table class="table mt-4">
					<tr class="row">
						<td class="col">Base Price:</td>
						<td class="col">$@{{amount}}</td>
					</tr>
					<tr class="row">
						<td class="col">Basic Buyer Fee:</td>
						<td class="col">$@{{costs.basic}}</td>
					</tr>
					<tr class="row">
						<td class="col">Seller's Special Fee:</td>
						<td class="col">$@{{costs.special}}</td>
					</tr>
					<tr class="row">
						<td class="col">Association Fee:</td>
						<td class="col">$@{{costs.association}}</td>
					</tr>
					<tr class="row">
						<td class="col">Storage Fee:</td>
						<td class="col">$@{{costs.storage}}</td>
					</tr>
					<tr class="row">
						<td class="col">Total Price:</td>
						<td class="col">$@{{costs.total}}</td>
					</tr>
				</table>
			</div>
		</div>

		<!-- In a production situation this would probably be a separate vue module file -->
		<script>
			const { createApp, ref } = Vue
			createApp({
				data() {
					return {
						amount: 1000,
						type: 'common',
						options: [
							{ text: 'Common', value: 'common' },
							{ text: 'Luxury', value: 'luxury' },
						],
						costs: { 
							basic: 0, 
							special: 0,
							association: 0,
							storage: 0,
							total: 0,
						},
					}
				},
				beforeMount() {
					this.updatePrice();
				},
				watch: {
					amount(val) {
						this.updatePrice();
					}
				},
				methods: {
					async updatePrice() {
						try {
							const {data} = await axios.get('/api/carPrice?price='+this.amount+'&type='+this.type);
							this.costs = data;}
						catch (e){
							console.log(e);
						}
 					}
				},
			}).mount('#app')
		  </script>
    </body>
</html>
