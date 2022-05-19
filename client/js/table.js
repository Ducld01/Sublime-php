$(document).ready(function() {
    $("#select-all").click(function() {
        $(":checkbox").prop("checked", true);
    });
    $("#clear-all").click(function() {
        $(":checkbox").prop("checked", false);
    });
    $("#delete-hand").click(function() {
        if ($(":checked").length === 0) {
            alert("Vui lòng chọn ít nhất một mục!");
            return false;
        } else {
                if(!confirm("Confirm Delete?")){
                    e.preventDefault();
                }
        }
    });
});