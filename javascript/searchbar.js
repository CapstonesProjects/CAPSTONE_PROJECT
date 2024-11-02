$(document).ready(function() {
    $(".searchbar").on("keyup change", function() {
        var searchValue = $(this).val().toLowerCase();
        // console.log("Search Value:", searchValue);

        $("table tbody tr").each(function() {
            var row = $(this).text().toLowerCase();
            var match = row.indexOf(searchValue) > -1;
            // console.log("Row:", row, "Match:", match);
            $(this).toggle(match);
        });
    });
});

