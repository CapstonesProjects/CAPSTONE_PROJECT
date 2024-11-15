<?php
include('../config/db_connection.php');

// Fetch all cases where Sanction includes Suspension
$query = "SELECT * FROM tblcases WHERE Sanction LIKE '%Suspension%'";
$result = mysqli_query($conn, $query);



$cases = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cases[] = $row;
}


mysqli_close($conn);
?>

<link href="https://unpkg.com/tippy.js@6/dist/tippy.css" rel="stylesheet">
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
                    <input type="search" class="searchbar form-control me-2 w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium" placeholder="Search..." x-model="search">
                </form>
                <div class="absolute top-0 left-0 inline-flex items-center p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                        <circle cx="10" cy="10" r="7" />
                        <line x1="21" y1="21" x2="15" y2="15" />
                    </svg>
                </div>
            </div>

            <div class="shadow rounded-lg flex justify-center items-center space-x-4">
                <button :class="{ 'bg-blue-500 text-white': selectedStatus === 'all' }" class="px-4 py-2 rounded" @click="selectedStatus = 'all'">All</button>
                <button :class="{ 'bg-blue-500 text-white': selectedStatus === 'suspension completed' }" class="px-4 py-2 rounded" @click="selectedStatus = 'suspension completed'">Completed</button>
                <button :class="{ 'bg-blue-500 text-white': selectedStatus === 'pending suspension' }" class="px-4 py-2 rounded" @click="selectedStatus = 'pending suspension'">Pending</button>
                <button :class="{ 'bg-blue-500 text-white': selectedStatus === 'active suspension' }" class="px-4 py-2 rounded" @click="selectedStatus = 'active suspension'">Active</button>
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
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-hidden relative" style="height: 720px; margin-top: 10px;">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-center bg-gray-200 text-gray-600">
                        <th class="sticky top-0 border-b border-gray-300 px-6 py-2 font-bold tracking-wider uppercase text-xs text-center">Case ID</th>
                        <th class="sticky top-0 border-b border-gray-300 px-6 py-2 font-bold tracking-wider uppercase text-xs text-center">Student ID</th>
                        <th class="sticky top-0 border-b border-gray-300 px-6 py-2 font-bold tracking-wider uppercase text-xs text-center">Name</th>
                        <th class="sticky top-0 border-b border-gray-300 px-6 py-2 font-bold tracking-wider uppercase text-xs text-center">Start Date</th>
                        <th class="sticky top-0 border-b border-gray-300 px-6 py-2 font-bold tracking-wider uppercase text-xs text-center">End Date</th>
                        <th class="sticky top-0 border-b border-gray-300 px-6 py-2 font-bold tracking-wider uppercase text-xs text-center">Status</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-3 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center flex items-center justify-center space-x-2">
                            <span>Action</span>
                            <button type="button" class="hover:bg-gray-700 text-black font-bold text-sm py-2 px-1 rounded transition duration-300 ease-in-out transform hover:scale-105 flex items-center justify-center" style="width: 24px; height: 24px;" data-tippy-content="
        <div class='text-left'>
            <div class='flex items-center space-x-2'>
                <i class='bx bx-show text-lg' style='background-color: #3b82f6; padding: 5px; border-radius: 5px; color: white;'></i>
                <span>View Button Icon: View case details</span>
            </div>
            <div class='flex items-center space-x-2 mt-2'>
                <i class='bx bx-calendar text-lg' style='background-color: #f59e0b; padding: 5px; border-radius: 5px; color: white;'></i>
                <span>Schedule Suspension Button: Schedule the suspension for the case</span>
            </div>
            <div class='flex items-center space-x-2 mt-2'>
                <i class='bx bx-up-arrow-alt text-lg' style='background-color: #10b981; padding: 5px; border-radius: 5px; color: white;'></i>
                <span>Lift Suspension Button: Lift the suspension for the case</span>
            </div>
        </div>
    ">
                                <i class='bx bx-info-circle'></i> <!-- Information Icon -->
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="caseItem in filteredCases()" :key="caseItem.StudentID">
                        <tr class="text-center hover:bg-gray-100 cursor-pointer">
                            <td class="border-dashed border-t border-gray-300 px-6 py-3" x-text="caseItem.CaseID"></td>
                            <td class="border-dashed border-t border-gray-300 px-6 py-3" x-text="caseItem.StudentID"></td>
                            <td class="border-dashed border-t border-gray-300 px-6 py-3" x-text="caseItem.FullName"></td>
                            <td class="border-dashed border-t border-gray-300 px-6 py-3 truncate-hover" x-text="caseItem.StartDate"></td>
                            <td class="border-dashed border-t border-gray-300 px-6 py-3 truncate-hover" x-text="caseItem.EndDate"></td>
                            <td class="border-dashed border-t border-gray-300 px-6 py-3">
                                <span
                                    :class="{
            'bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold': getStatus(caseItem.Status, caseItem.StartDate, caseItem.EndDate).text === 'Suspension Completed',
            'bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-semibold': getStatus(caseItem.Status, caseItem.StartDate, caseItem.EndDate).text === 'Pending Suspension',
            'bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-semibold': getStatus(caseItem.Status, caseItem.StartDate, caseItem.EndDate).text === 'Active Suspension',
            'bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs font-semibold': !['Suspension Completed', 'Pending Suspension', 'Active Suspension'].includes(getStatus(caseItem.Status, caseItem.StartDate, caseItem.EndDate).text)
        }"
                                    class="cursor-pointer status-container">
                                    <span
                                        x-text="getStatus(caseItem.Status, caseItem.StartDate, caseItem.EndDate).text">
                                    </span>
                                </span>
                            </td>


                            <td class="border-dashed border-t border-gray-300 px-6 py-3">
                                <div class="flex justify-center items-center space-x-2">
                                    <button @click="window.location.href = '../OSA/OSA_MonitoringView.php?caseID=' + caseItem.CaseID" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 text-sm rounded flex items-center justify-center" style="width: 40px; height: 40px;">
                                        <i class='bx bx-show'></i> <!-- View Icon -->
                                    </button>

                                    <template x-if="caseItem.CaseResolution && !caseItem.StartDate">
                                        <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-3 rounded text-sm flex items-center justify-center" data-bs-toggle="modal" :data-bs-target="'#scheduleSuspensionModal' + caseItem.CaseID" @click="openScheduleSuspensionModal(caseItem.CaseID)" style="width: 40px; height: 40px;">
                                            <i class='bx bx-calendar'></i> <!-- Schedule Suspension Icon -->
                                        </button>
                                    </template>

                                    <template x-if="caseItem.StartDate && getStatus(caseItem.Status, caseItem.StartDate, caseItem.EndDate).text !== 'Suspension Completed'">
                                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-3 rounded text-sm flex items-center justify-center" data-bs-toggle="modal" :data-bs-target="'#liftSuspensionModal' + caseItem.CaseID" @click="liftSuspension(caseItem.CaseID)" style="width: 40px; height: 40px;">
                                            <i class='bx bx-up-arrow-alt'></i> <!-- Lift Suspension Icon -->
                                        </button>
                                    </template>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <!-- Modals -->
        <?php include('../modals/ViewCaseModal.php') ?>
        <?php foreach ($cases as $caseItem): ?>
            <?php include('../modals/ScheduleSuspensionModal.php'); ?>
            <?php include('../modals/LiftSuspensionModal.php'); ?>
        <?php endforeach; ?>
        <?php include('../alerts/suspension_date.php') ?>
    </div>

    <script>
        function filteredCases() {
            return {
                selectedStatus: 'all',
                selectedSchoolYear: '',
                selectedSemester: 'all',
                search: '',
                cases: <?php echo json_encode($cases); ?>,
                filteredCases() {
                    let filtered = this.cases;

                    // Filter by status
                    if (this.selectedStatus !== 'all') {
                        filtered = filtered.filter(caseItem => {
                            const status = this.getStatus(caseItem.Status, caseItem.StartDate, caseItem.EndDate).text.toLowerCase();
                            return status === this.selectedStatus;
                        });
                    }

                    // Filter by school year
                    if (this.selectedSchoolYear) {
                        filtered = filtered.filter(caseItem => caseItem.SchoolYear === this.selectedSchoolYear);
                    }

                    // Filter by semester
                    if (this.selectedSemester !== 'all') {
                        filtered = filtered.filter(caseItem => caseItem.Semester === this.selectedSemester);
                    }

                    // Filter by search term
                    if (this.search) {
                        filtered = filtered.filter(caseItem => {
                            return Object.values(caseItem).some(value =>
                                String(value).toLowerCase().includes(this.search.toLowerCase())
                            );
                        });
                    }

                    // Filter out cases without "Suspension" in the sanction
                    filtered = filtered.filter(caseItem => caseItem.Sanction && caseItem.Sanction.toLowerCase().includes('suspension'));

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

                    // Check if the status in the database is 'Resolved'
                    if (dbStatus.toLowerCase() === 'resolved') {
                        console.log('Status: Suspension Completed (dbStatus is resolved)');
                        return {
                            text: 'Suspension Completed',
                            isActive: false
                        };
                    }

                    // Check if the status in the database is 'Suspended'
                    if (dbStatus.toLowerCase() === 'suspended') {
                        console.log('Status: Active Suspension (dbStatus is suspended)');
                        return {
                            text: 'Active Suspension',
                            isActive: true
                        };
                    }

                    if (!start || !end) {
                        console.log('Status: Pending Suspension (missing start or end date)');
                        return {
                            text: 'Pending Suspension',
                            isActive: false
                        };
                    }

                    if (currentDate < start) {
                        console.log('Status: Pending Suspension (current date is before start date)');
                        return {
                            text: 'Pending Suspension',
                            isActive: false
                        };
                    }

                    if (currentDate.toDateString() === start.toDateString()) {
                        console.log('Status: Active Suspension (current date is the start date)');
                        return {
                            text: 'Active Suspension',
                            isActive: true
                        };
                    }

                    if (currentDate >= start && currentDate <= end) {
                        console.log('Status: Active Suspension (current date is between start and end date)');
                        return {
                            text: 'Active Suspension',
                            isActive: true
                        };
                    }

                    console.log('Status: Pending Suspension (default case)');
                    return {
                        text: 'Pending Suspension',
                        isActive: false
                    };
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            tippy('[data-tippy-content]', {
                allowHTML: true,
                theme: 'light-border',
            });
        });
    </script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>