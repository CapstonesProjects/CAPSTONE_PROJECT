<?php
include('../config/db_connection.php');

// Fetch data from tblcases
$query = "SELECT * FROM tblcases";
$result = mysqli_query($conn, $query);

$cases = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cases[] = $row;
}

mysqli_close($conn);

// Initialize $filteredCases
$filteredCases = $cases;

// Handle filtering
$selectedStatus = isset($_POST['status']) ? $_POST['status'] : 'all';
$selectedSchoolYear = isset($_POST['schoolYear']) ? $_POST['schoolYear'] : '';

if ($selectedStatus !== 'all' || !empty($selectedSchoolYear)) {
    $filteredCases = array_filter($cases, function ($case) use ($selectedStatus, $selectedSchoolYear) {
        $statusMatch = $selectedStatus === 'all' || strtolower($case['Status']) === strtolower($selectedStatus);
        $schoolYearMatch = empty($selectedSchoolYear) || $case['SchoolYear'] === $selectedSchoolYear;
        return $statusMatch && $schoolYearMatch;
    });
}
?>

<!-- component -->
<div class="antialiased sans-serif h-screen ml-0 m-3 ">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <style>
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

        .status-container {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .status-tooltip {
            visibility: hidden;
            width: max-content;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            /* Position the tooltip above the text */
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .status-container:hover .status-tooltip {
            visibility: visible;
            opacity: 1;
        }

        .offense-container {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .offense-tooltip {
            visibility: hidden;
            width: max-content;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            /* Position the tooltip above the text */
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .offense-container:hover .offense-tooltip {
            visibility: visible;
            opacity: 1;
        }
    </style>

    <div class="container py-3 px-1 ml-12 overflow-hidden" x-data="filteredCases()">
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-3xl">Records</h1>
            <form action="import_from_excel.php" method="POST" enctype="multipart/form-data" class="flex items-center space-x-4">
                <input type="file" name="excelFile" class="hidden" id="excelFileInput">
                <label for="excelFileInput" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V3zm2 0v12h10V3H5zm3 4a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1H9a1 1 0 01-1-1V7zm1 1v1h2V8H9z" clip-rule="evenodd" />
                    </svg>
                    Import
                </label>
                <button type="submit" class="hidden" id="importExcelButton"></button>
            </form>
        </div>

        <div class="mb-4 flex justify-between items-center space-x-4">
            <div class="relative md:w-1/4">
                <input type="search" class="searchbar form-control me-2 w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium" placeholder="Search..." x-model="search">
                <div class="absolute top-0 left-0 inline-flex items-center p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                        <circle cx="10" cy="10" r="7" />
                        <line x1="21" y1="21" x2="15" y2="15" />
                    </svg>
                </div>
            </div>

            <div class="shadow rounded-lg flex justify-center items-center space-x-4">
                <button :class="{ 'bg-blue-500 text-white': selected === 'all' }" class="px-4 py-2 rounded" @click="selected = 'all'">All</button>
                <button :class="{ 'bg-blue-500 text-white': selected === 'ongoing' }" class="px-4 py-2 rounded" @click="selected = 'ongoing'">Ongoing</button>
                <button :class="{ 'bg-blue-500 text-white': selected === 'resolved' }" class="px-4 py-2 rounded" @click="selected = 'resolved'">Resolved</button>
                <button :class="{ 'bg-blue-500 text-white': selected === 'suspended' }" class="px-4 py-2 rounded" @click="selected = 'suspended'">Suspended</button>
            </div>

            <div class="shadow rounded-lg flex justify-center items-center space-x-4">
                <select x-model="selectedSchoolYear" class="form-select block w-full mt-1 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium">
                    <option value="">Select School Year</option>
                    <option value="2021-2022">2021-2022</option>
                    <option value="2022-2023">2022-2023</option>
                    <option value="2023-2024">2023-2024</option>
                    <option value="2024-2025">2024-2025</option>
                </select>
            </div>

            <div class="shadow rounded-lg flex justify-center items-center space-x-4">
                <select x-model="selectedSemester" class="form-select block w-full mt-1 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium">
                    <option value="all">All Semesters</option>
                    <option value="1st Semester">1st Semester</option>
                    <option value="2nd Semester">2nd Semester</option>
                </select>
            </div>

            <div>
                <button class="bg-green-500 text-white px-10 py-2 rounded" data-bs-toggle="modal" data-bs-target="#AddCasesModal">Add Cases</button>
            </div>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative" style="height: 685px;">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-center">
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Student ID</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Name</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Category</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Offense</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Status</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="caseItem in filteredCases()" :key="caseItem.StudentID">
                        <tr class="text-center hover:bg-gray-300">
                            <td class="border-dashed border-t border-gray-200 px-6 py-3 text-sm" x-text="caseItem.StudentID"></td>
                            <td class="border-dashed border-t border-gray-200 px-6 py-3 text-sm" x-text="caseItem.FullName"></td>
                            <td class="border-dashed border-t border-gray-200 px-6 py-3 truncate-hover text-sm" x-text="caseItem.OffenseCategory"></td>
                            <td class="border-dashed border-t border-gray-200 px-6 py-3 relative text-sm">
                                <span class="block max-w-xl truncate hover:whitespace-normal hover:bg-white hover:overflow-visible hover:z-10 offense-container">
                                    <span x-text="caseItem.Offense"></span>
                                    <span class="offense-tooltip" x-text="caseItem.Offense"></span>
                                </span>
                            </td>

                            <td class="border-dashed border-t border-gray-200 px-6 py-3 text-sm">
                                <span :class="{
        'bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold': caseItem.Status.toLowerCase().includes('resolved'),
        'bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-semibold': caseItem.Status.toLowerCase().includes('ongoing'),
        'bg-red-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-semibold': caseItem.Status.toLowerCase().includes('pending suspension'),
        'bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs font-semibold': !['resolved', 'ongoing', 'pending suspension'].some(status => caseItem.Status.toLowerCase().includes(status))
    }" class="cursor-pointer status-container">
                                    <span x-text="caseItem.Status.toLowerCase().includes('resolved') ? 'Resolved' : caseItem.Status.toLowerCase().includes('ongoing') ? 'Ongoing' : caseItem.Status.toLowerCase().includes('suspended') ? 'Suspended' : caseItem.Status"></span>
                                    <template x-if="caseItem.Status.toLowerCase().includes('resolved')">
                                        <span class="status-tooltip" x-text="caseItem.CaseResolution"></span>
                                    </template>
                                </span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 px-6 py-3 text-center">
                                <div class="flex space-x-2">
                                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-sm py-2 px-3 rounded transition duration-300 ease-in-out transform hover:scale-105" data-bs-toggle="modal" :data-bs-target="'#ViewCasesModal' + caseItem.CaseID">
                                        View
                                    </button>
                                    <button type="button" class="transition duration-300 ease-in-out text-sm transform hover:scale-105 text-white font-bold py-2 px-2 rounded"
                                        :class="{
                'bg-gray-600 cursor-not-allowed opacity-50': ['pending', 'suspension', 'suspended', 'resolved'].some(status => caseItem.Status.toLowerCase().includes(status)),
                'bg-green-500 hover:bg-green-700': !['pending', 'suspension', 'suspended', 'resolved'].some(status => caseItem.Status.toLowerCase().includes(status))
            }"
                                        data-bs-toggle="modal"
                                        :data-bs-target="'#CaseAttachmentFileModal' + caseItem.CaseID"
                                        :disabled="['pending', 'suspension', 'suspended', 'resolved'].some(status => caseItem.Status.toLowerCase().includes(status))">
                                        <span x-text="['pending', 'suspension', 'suspended', 'resolved'].some(status => caseItem.Status.toLowerCase().includes(status)) ? 'Submitted' : 'Submit Resolution'"></span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <!-- Modals -->
        <?php include('../modals/ViewCaseModal.php') ?>
        <?php include('../modals/cases_attachment_file_modal.php') ?>
    </div>

    <script>
        function filteredCases() {
            return {
                selected: 'all',
                selectedSchoolYear: '',
                selectedSemester: 'all',
                search: '',
                cases: <?php echo json_encode($cases); ?>,
                filteredCases() {
                    let filtered = this.cases;

                    if (this.selected !== 'all') {
                        filtered = filtered.filter(caseItem => {
                            const status = caseItem.Status.toLowerCase();
                            if (this.selected === 'resolved') {
                                return status.includes('resolved');
                            } else if (this.selected === 'ongoing') {
                                return status.includes('ongoing');
                            } else if (this.selected === 'suspended') {
                                return status.includes('suspended');
                            }
                            return status === this.selected;
                        });
                    }

                    if (this.selectedSchoolYear) {
                        filtered = filtered.filter(caseItem => caseItem.SchoolYear === this.selectedSchoolYear);
                    }

                    if (this.selectedSemester !== 'all') {
                        filtered = filtered.filter(caseItem => caseItem.Semester === this.selectedSemester);
                    }

                    if (this.search) {
                        filtered = filtered.filter(caseItem => {
                            return Object.values(caseItem).some(value =>
                                String(value).toLowerCase().includes(this.search.toLowerCase())
                            );
                        });
                    }

                    return filtered;
                }
            }
        }
    </script>
</div>