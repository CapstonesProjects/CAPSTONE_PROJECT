<?php
include('../config/db_connection.php');

// Fetch all cases
$query = "SELECT * FROM tblcases";
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
            <h1 class="text-3xl font-bold text-gray-800">Suspended Students</h1>
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
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-hidden relative" style="height: 720px; margin-top: 10px;">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-center bg-gray-200 text-gray-600">
                        <th class="sticky top-0 border-b border-gray-300 px-6 py-2 font-bold tracking-wider uppercase text-xs text-center">Case ID</th>
                        <th class="sticky top-0 border-b border-gray-300 px-6 py-2 font-bold tracking-wider uppercase text-xs text-center">Student ID</th>
                        <th class="sticky top-0 border-b border-gray-300 px-6 py-2 font-bold tracking-wider uppercase text-xs text-center">Name</th>
                        <th class="sticky top-0 border-b border-gray-300 px-6 py-2 font-bold tracking-wider uppercase text-xs text-center">School Year</th>
                        <th class="sticky top-0 border-b border-gray-300 px-6 py-2 font-bold tracking-wider uppercase text-xs text-center">Status</th>
                        <th class="sticky top-0 border-b border-gray-300 px-6 py-2 font-bold tracking-wider uppercase text-xs text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="caseItem in filteredCases()" :key="caseItem.StudentID">
                        <tr class="text-center hover:bg-gray-100 cursor-pointer">
                            <td class="border-dashed border-t border-gray-300 px-6 py-3" x-text="caseItem.CaseID"></td>
                            <td class="border-dashed border-t border-gray-300 px-6 py-3" x-text="caseItem.StudentID"></td>
                            <td class="border-dashed border-t border-gray-300 px-6 py-3" x-text="caseItem.FullName"></td>
                            <td class="border-dashed border-t border-gray-300 px-6 py-3 truncate-hover" x-text="caseItem.SchoolYear"></td>
                            <td class="border-dashed border-t border-gray-300 px-6 py-3">
                                <span
                                    :class="{
            'bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold': getStatus(caseItem.Status, caseItem.StartDate, caseItem.EndDate) === 'Suspension Completed',
            'bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-semibold': getStatus(caseItem.Status, caseItem.StartDate, caseItem.EndDate) === 'Pending Suspension',
            'bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-semibold': getStatus(caseItem.Status, caseItem.StartDate, caseItem.EndDate) === 'Active Suspension',
            'bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs font-semibold': !['Suspension Completed', 'Pending Suspension', 'Active Suspension'].includes(getStatus(caseItem.Status, caseItem.StartDate, caseItem.EndDate))
        }"
                                    class="cursor-pointer status-container">
                                    <span
                                        x-text="getStatus(caseItem.Status, caseItem.StartDate, caseItem.EndDate)">
                                    </span>
                                </span>
                            </td>


                            <td class="border-dashed border-t border-gray-300 px-6 py-3">
                                <button @click="window.location.href = '../OSA/OSA_MonitoringView.php?caseID=' + caseItem.CaseID" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    View
                                </button>

                                <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded" data-bs-toggle="modal" :data-bs-target="'#scheduleSuspensionModal' + caseItem.CaseID" @click="openScheduleSuspensionModal(caseItem.CaseID)">
                                    Schedule Suspension
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <!-- Modals -->
        <?php include('../modals/ViewCaseModal.php') ?>
        <?php include('../modals/ScheduleSuspensionModal.php') ?>
    </div>

    <script>
        function filteredCases() {
            return {
                selectedSchoolYear: '',
                cases: <?php echo json_encode($cases); ?>,
                filteredCases() {
                    let filtered = this.cases;

                    // Filter for cases with specific statuses
                    filtered = filtered.filter(caseItem => {
                        const status = this.getStatus(caseItem.Status, caseItem.StartDate, caseItem.EndDate).toLowerCase();
                        return status.includes('active suspension') || status.includes('pending suspension') || status.includes('suspension completed');
                    });

                    if (this.selectedSchoolYear) {
                        filtered = filtered.filter(caseItem => caseItem.SchoolYear === this.selectedSchoolYear);
                    }

                    return filtered;
                },
                getStatus(dbStatus, startDate, endDate) {
                    const currentDate = new Date();
                    const start = startDate ? new Date(startDate) : null;
                    const end = endDate ? new Date(endDate) : null;

                    console.log(`Current Date: ${currentDate}`);
                    console.log(`Start Date: ${start}`);
                    console.log(`End Date: ${end}`);
                    console.log(`DB Status: ${dbStatus}`);

                    if (dbStatus.toLowerCase() !== 'Suspended') {
                        return 'Active Suspension';
                    }

                    if (!start || !end) {
                        return 'Active Suspension';
                    }

                    if (currentDate < start) {
                        return 'Pending Suspension';
                    }

                    if (currentDate.toDateString() === start.toDateString()) {
                        return 'Active Suspension';
                    }

                    if (currentDate >= start && currentDate <= end) {
                        return 'Active Suspension';
                    }

                    if (currentDate > end) {
                        return 'Suspension Completed';
                    }

                    return 'Pending Suspension';
                }
            }
        }
    </script>