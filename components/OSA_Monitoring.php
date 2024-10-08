<?php
include('../config/db_connection.php');

// Fetch data from tblcases
$query = "SELECT * FROM tblcases WHERE Status LIKE '%suspended%'";
$result = mysqli_query($conn, $query);

$cases = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cases[] = $row;
}

mysqli_close($conn);
?>

<!-- component -->
<div class="antialiased sans-serif h-screen ml-0 m-3">
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
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a 1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z'/%3e%3c/svg%3e");
            border-color: transparent;
            background-color: currentColor;
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
        }

        @media (min-width: 900px) {
            .container {
                max-width: 1700px;
                width: 1575px;
                margin-left: -7px;
            }
        }
    </style>

    <div class="container py-3 px-1 ml-12 overflow-hidden" x-data="filteredCases()">
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-3xl">Suspended Students</h1>
        </div>

        <div class="mb-4 flex justify-between items-center space-x-4">
            <div class="relative md:w-1/4">
                <form action="" method="post">
                    <input type="search" class="searchbar form-control me-2 w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium" placeholder="Search...">
                </form>
                <div class="absolute top-0 left-0 inline-flex items-center p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                        <circle cx="10" cy="10" r="7" />
                        <line x1="21" y1="21" x2="15" y2="15" />
                    </svg>
                </div>
            </div>
<!-- 
            <div class="shadow rounded-lg flex justify-center items-center space-x-4">
                <select x-model="selectedSchoolYear" class="form-select block w-full mt-1 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium">
                    <option value="">Select School Year</option>
                    <option value="2021-2022">2021-2022</option>
                    <option value="2022-2023">2022-2023</option>
                    <option value="2023-2024">2023-2024</option>
                    <option value="2024-2025">2024-2025</option>
                </select>
            </div> -->
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-hidden relative" style="height: 720px; margin-top: 10px;">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-center">
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Case ID</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Student ID</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Name</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">School Year</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="caseItem in filteredCases()" :key="caseItem.StudentID">
                        <tr class="text-center hover:bg-gray-300">
                            <td class="border-dashed border-t border-gray-200 px-6 py-3" x-text="caseItem.CaseID"></td>
                            <td class="border-dashed border-t border-gray-200 px-6 py-3" x-text="caseItem.StudentID"></td>
                            <td class="border-dashed border-t border-gray-200 px-6 py-3" x-text="caseItem.FullName"></td>
                            <td class="border-dashed border-t border-gray-200 px-6 py-3 truncate-hover" x-text="caseItem.SchoolYear"></td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <!-- Modals -->
        <?php include('../modals/ViewCaseModal.php') ?>
    </div>

    <script>
        function filteredCases() {
            return {
                selectedSchoolYear: '',
                cases: <?php echo json_encode($cases); ?>,
                filteredCases() {
                    let filtered = this.cases;

                    // Filter for suspended cases
                    filtered = filtered.filter(caseItem => caseItem.Status.toLowerCase().includes('suspended'));

                    if (this.selectedSchoolYear) {
                        filtered = filtered.filter(caseItem => caseItem.SchoolYear === this.selectedSchoolYear);
                    }

                    return filtered;
                }
            }
        }
    </script>
</div>