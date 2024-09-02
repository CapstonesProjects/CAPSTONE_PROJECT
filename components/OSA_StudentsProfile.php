<!-- component -->
<div class="antialiased sans-serif h-screen ml-0 " style="width: 1500px; padding: 0;">
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

        @media (min-width: 900px) {
            .container {
                max-width: 1490px;
            }
        }
    </style>

    <div class="container py-3 px-1 ml-12 overflow-hidden" x-data="datatables()" x-cloak>
        <div style="width: 130%;">
            <h1 class="text-3xl py-3 mb-10">Students List</h1>
        </div>

        <div class="mb-4 flex justify-between items-center">
            <div class="flex-1 pr-4">
                <div class="relative md:w-1/3">
                    <input type="search" class="w-60 mr-0 pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium" placeholder="Search...">
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
                <div class="shadow rounded-lg flex justify-end mb-4" style="margin-left: 0%;">
                    <div class="relative">
                        <div class="flex justify-end">
                            <div class="flex">
                                <button class="bg-gray-200 text-gray-700 px-6 py-2 rounded" data-bs-toggle="modal" data-bs-target="#AddStudentModal">Add Student</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative" style="height: 645px; width: 1490px;">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-left">
                        <template x-for="heading in headings">
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-4 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center" x-text="heading.value" :x-ref="heading.key" :class="{ [heading.key]: true }"></th>
                        </template>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-4 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="user in users" :key="user.userId">
                        <tr>
                            <td class="border-dashed border-t border-gray-200 userId text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center" x-text="user.userId"></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 firstName text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center" x-text="user.Name"></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 emailAddress text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center" x-text="user.emailAddress"></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 gender text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center" x-text="user.Category"></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 action text-center">
                                <div class="flex justify-center space-x-2">
                                    <button class="bg-blue-100 text-blue-800 px-2 py-1 rounded border border-blue-300 hover:bg-blue-200">View</button>
                                    <button class="bg-green-100 text-green-800 px-2 py-1 rounded border border-green-300 hover:bg-green-200">Edit</button>
                                    <button class="bg-red-100 text-red-800 px-2 py-1 rounded border border-red-300 hover:bg-red-200">Delete</button>
                                </div>
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
                headings: [
                    { 'key': 'userId', 'value': 'Student ID' },
                    { 'key': 'Name', 'value': 'Name' },
                    { 'key': 'emailAddress', 'value': 'Email' },
                    { 'key': 'Category', 'value': 'Category' }
                ],
                users: [
                    { "userId": 1, "Name": "Cort Tosh", "emailAddress": "ctosh0@github.com", "Category": "Major" },
                    { "userId": 2, "Name": "Brianne Dzeniskevich", "emailAddress": "bdzeniskevich1@hostgator.com", "Category": "Minor" },
                    { "userId": 3, "Name": "Isadore Botler", "emailAddress": "ibotler2@gmpg.org", "Category": "Major" },
                    { "userId": 4, "Name": "Janaya Klosges", "emailAddress": "jklosges3@amazon.de", "Category": "Major" },
                    { "userId": 5, "Name": "Freddi Di Claudio", "emailAddress": "fdiclaudio4@phoca.cz", "Category": "Minor" },
                    { "userId": 6, "Name": "Oliy Mairs", "emailAddress": "omairs5@fda.gov", "Category": "Major" },
                    { "userId": 7, "Name": "Tabb Wiseman", "emailAddress": "twiseman6@friendfeed.com", "Category": "Major" },
                    { "userId": 8, "Name": "Joela Betteriss", "emailAddress": "jbetteriss7@msu.edu", "Category": "Major" },
                    { "userId": 9, "Name": "Alistair Vasyagin", "emailAddress": "avasyagin8@gnu.org", "Category": "Minor" },
                    { "userId": 10, "Name": "Nealon Ratray", "emailAddress": "nratray9@typepad.com", "Category": "Minor" },
                    { "userId": 11, "Name": "Annissa Kissick", "emailAddress": "akissicka@deliciousdays.com", "Category": "Major" },
                    { "userId": 12, "Name": "Nissie Sidnell", "emailAddress": "nsidnellb@freewebs.com", "Category": "Major" },
                    { "userId": 13, "Name": "Madalena Fouch", "emailAddress": "mfouchc@mozilla.org", "Category": "Major" },
                    { "userId": 14, "Name": "Rozina Atkins", "emailAddress": "ratkinsd@japanpost.jp", "Category": "Major" },
                    { "userId": 15, "Name": "Lorelle Sandcroft", "emailAddress": "lsandcrofte@google.nl", "Category": "Major" }
                ],
                selectedRows: [],
                open: false,
                toggleColumn(key) {
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
                            column.checked = true;
                            this.selectedRows.push(parseInt(column.name));
                        });
                    } else {
                        columns.forEach(column => {
                            column.checked = false;
                        });
                        this.selectedRows = [];
                    }
                }
            }
        }
    </script>
</div>