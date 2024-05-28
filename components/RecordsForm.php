<!-- component -->
<div class="antialiased sans-serif  h-screen">


	<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
	<style>
		[x-cloak] {
			display: none;
		}

		[type="checkbox"] {
			box-sizing: border-box;
			padding: 0;
		}

		.form-checkbox {
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			/* -webkit-print-color-adjust: exact; */
			/* color-adjust: exact; */
			display: inline-block;
			vertical-align: middle;
			background-origin: border-box;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			flex-shrink: 0;
			color: currentColor;
			background-color: #fff;
			border-color: #e2e8f0;
			border-width: 1px;
			border-radius: 0.25rem;
			height: 1.2em;
			width: 1.2em;
		}

		.form-checkbox:checked {
			background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z'/%3e%3c/svg%3e");
			border-color: transparent;
			background-color: currentColor;
			background-size: 100% 100%;
			background-position: center;
			background-repeat: no-repeat;
		}
	</style>

	<div class="container mx-auto py-6 px-4" x-data="datatables()" x-cloak>
		<div style="width: 130%;">
			<h1 class="text-3xl py-4 border-b mb-10">Records</h1>
		</div>

		<div class="mb-4 flex justify-between items-center">
			<div class="flex-1 pr-4">
				<div class="relative md:w-1/3">
					<input type="search" class="w-60 pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium" placeholder="Search...">
					<div class="absolute top-0 left-0 inline-flex items-center p-2">
						<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<rect x="0" y="0" width="24" height="24" stroke="none"></rect>
							<circle cx="10" cy="10" r="7" />
							<line x1="21" y1="21" x2="15" y2="15" />
						</svg>
					</div>
				</div>
			</div>
			<div>
				<div class="shadow rounded-lg flex justify-between mb-4">
					<div class="relative">
						<div style="width: 600px;" class="flex justify-between">
							<div x-data="{ selected: 'all' }" class="flex justify-center items-center space-x-4">
								<button :class="{ 'bg-blue-500 text-white': selected === 'all' }" class="px-10 py-2 rounded" @click="selected = 'all'">All</button>
								<button :class="{ 'bg-blue-500 text-white': selected === 'ongoing' }" class="px-10 py-2 rounded" @click="selected = 'ongoing'">Ongoing</button>
								<button :class="{ 'bg-blue-500 text-white': selected === 'resolved' }" class="px-10 py-2 rounded" @click="selected = 'resolved'">Resolved</button>
								<button :class="{ 'bg-blue-500 text-white': selected === 'pending' }" class="px-10 py-2 rounded" @click="selected = 'pending'">Pending</button>
							</div>
							<div class="flex ml-56">
							<button class="bg-green-500 text-white px-10 py-0 rounded" data-bs-toggle="modal" data-bs-target="#AddCasesModal">Add Cases</button>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative" style="height: 645px; width: 1500px;">
			<table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
				<thead>
					<tr class="text-left">
						<!-- <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">
							<label
								class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
								<input type="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline" @click="selectAllCheckbox($event);">
							</label>
						</th> -->
						<template x-for="heading in headings">
							<th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs" x-text="heading.value" :x-ref="heading.key" :class="{ [heading.key]: true }"></th>
						</template>
					</tr>
				</thead>
				<tbody>
					<template x-for="user in users" :key="user.userId">
						<tr>
							<!-- <td class="border-dashed border-t border-gray-200 px-3">
								<label
									class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
									<input type="checkbox" class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline" :name="user.userId"
											@click="getRowDetail($event, user.userId)">
								</label>
							</td> -->
							<td class="border-dashed border-t border-gray-200 userId">
								<span class="text-gray-700 px-6 py-3 flex items-center" x-text="user.userId"></span>
							</td>
							<td class="border-dashed border-t border-gray-200 firstName">
								<span class="text-gray-700 px-6 py-3 flex items-center" x-text="user.Name"></span>
							</td>
							<!-- <td class="border-dashed border-t border-gray-200 lastName">
								<span class="text-gray-700 px-6 py-3 flex items-center" x-text="user.lastName"></span>
							</td> -->
							<td class="border-dashed border-t border-gray-200 emailAddress">
								<span class="text-gray-700 px-6 py-3 flex items-center" x-text="user.emailAddress"></span>
							</td>
							<td class="border-dashed border-t border-gray-200 gender">
								<span class="text-gray-700 px-6 py-3 flex items-center" x-text="user.Category"></span>
							</td>
							<td class="border-dashed border-t border-gray-200 phoneNumber">
								<span class="text-gray-700 px-6 py-3 flex items-center" x-text="user.Status"></span>
							</td>
						</tr>
					</template>
				</tbody>
			</table>
		</div>
	</div>

	<script>
		function datatables() {
			return {
				headings: [{
						'key': 'userId',
						'value': 'Student ID'
					},
					{
						'key': 'Name',
						'value': 'Name'
					},
					// {
					// 	'key': 'lastName',
					// 	'value': 'Lastname'
					// },
					{
						'key': 'emailAddress',
						'value': 'Email'
					},
					{
						'key': 'Category',
						'value': 'Category'
					},
					{
						'key': 'Status',
						'value': 'Status'
					}
				],
				users: [{
					"userId": 1,
					"Name": "Cort Tosh",
					"lastName": "Tosh",
					"emailAddress": "ctosh0@github.com",
					"Category": "Major",
					"Status": "Pending"
				}, {
					"userId": 2,
					"Name": "Brianne Dzeniskevich",
					"lastName": "Dzeniskevich",
					"emailAddress": "bdzeniskevich1@hostgator.com",
					"Category": "Minor",
					"Status": "Resolved"
				}, {
					"userId": 3,
					"Name": "Isadore Botler",
					"lastName": "Botler",
					"emailAddress": "ibotler2@gmpg.org",
					"Category": "Major",
					"Status": "Pending"
				}, {
					"userId": 4,
					"Name": "Janaya Klosges",
					"lastName": "Klosges",
					"emailAddress": "jklosges3@amazon.de",
					"Category": "Major",
					"Status": "Pending"
				}, {
					"userId": 5,
					"Name": "Freddi Di Claudio",
					"lastName": "Di Claudio",
					"emailAddress": "fdiclaudio4@phoca.cz",
					"Category": "Minor",
					"Status": "Resolved"
				}, {
					"userId": 6,
					"Name": "Oliy Mairs",
					"lastName": "Mairs",
					"emailAddress": "omairs5@fda.gov",
					"Category": "Major",
					"Status": "Pending"
				}, {
					"userId": 7,
					"Name": "Tabb Wiseman",
					"lastName": "Wiseman",
					"emailAddress": "twiseman6@friendfeed.com",
					"Category": "Major",
					"Status": "Pending"
				}, {
					"userId": 8,
					"Name": "Joela Betteriss",
					"lastName": "Betteriss",
					"emailAddress": "jbetteriss7@msu.edu",
					"Category": "Major",
					"Status": "Pending"
				}, {
					"userId": 9,
					"Name": "Alistair Vasyagin",
					"lastName": "Vasyagin",
					"emailAddress": "avasyagin8@gnu.org",
					"Category": "Minor",
					"Status": "Pending"
				}, {
					"userId": 10,
					"Name": "Nealon Ratray",
					"lastName": "Ratray",
					"emailAddress": "nratray9@typepad.com",
					"Category": "Minor",
					"Status": "Pending"
				}, {
					"userId": 11,
					"Name": "Annissa Kissick",
					"lastName": "Kissick",
					"emailAddress": "akissicka@deliciousdays.com",
					"Category": "Major",
					"Status": "Pending"
				}, {
					"userId": 12,
					"Name": "Nissie Sidnell",
					"lastName": "Sidnell",
					"emailAddress": "nsidnellb@freewebs.com",
					"Category": "Major",
					"Status": "Pending"
				}, {
					"userId": 13,
					"Name": "Madalena Fouch",
					"lastName": "Fouch",
					"emailAddress": "mfouchc@mozilla.org",
					"Category": "Major",
					"Status": "Pending"
				}, {
					"userId": 14,
					"Name": "Rozina Atkins",
					"lastName": "Atkins",
					"emailAddress": "ratkinsd@japanpost.jp",
					"Category": "Major",
					"Status": "Pending"
				}, {
					"userId": 15,
					"Name": "Lorelle Sandcroft",
					"lastName": "Sandcroft",
					"emailAddress": "lsandcrofte@google.nl",
					"Category": "Major",
					"Status": "Pending"
				}],
				selectedRows: [],

				open: false,

				toggleColumn(key) {
					// Note: All td must have the same class name as the headings key! 
					let columns = document.querySelectorAll('.' + key);

					if (this.$refs[key].classList.contains('hidden') && this.$refs[key].classList.contains(key)) {
						columns.forEach(column => {
							column.classList.remove('hidden');
						});
					} else {
						columns.forEach(column => {
							column.classList.add('hidden');
						});
					}
				},

				getRowDetail($event, id) {
					let rows = this.selectedRows;

					if (rows.includes(id)) {
						let index = rows.indexOf(id);
						rows.splice(index, 1);
					} else {
						rows.push(id);
					}
				},

				selectAllCheckbox($event) {
					let columns = document.querySelectorAll('.rowCheckbox');

					this.selectedRows = [];

					if ($event.target.checked == true) {
						columns.forEach(column => {
							column.checked = true
							this.selectedRows.push(parseInt(column.name))
						});
					} else {
						columns.forEach(column => {
							column.checked = false
						});
						this.selectedRows = [];
					}
				}
			}
		}
	</script>
</div>