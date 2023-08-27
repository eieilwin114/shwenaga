$('#division').on('change',function(){
    $.ajax({
    url: "shops/township-by-division",
    type: "GET",
    data: {
        id: $(this).val(),
    },
    success: function (response) {
        $("#township").html('<option value="">Choose...</option>');
        $.each(response, function (key, value) {
            $("#township").append(
                '<option value="' + value.id + '">' + value.township + "</option>"
            );
        });
    },
    });
});
$('#division_shop').on('change',function(){
    $.ajax({
    url: "shops/get_all_townships_by_div",
    type: "GET",
    data: {
        id: $(this).val(),
    },
    success: function (response) {
        $("#township_shop").html('<option value="">Choose...</option>');
        $.each(response, function (key, value) {
            $("#township_shop").append(
                '<option value="' + value.id + '">' + value.township + "</option>"
            );
        });
    },
    });
});

$('#shop').on('change', function () {
    console.log('value is', $(this).val());
    $.ajax({
    url: "/admin/user-by-shop",
    type: "GET",
    data: {
        id: $(this).val(),
    },
    success: function (response) {
        $("#name").html('<option value="">Choose...</option>');
        $.each(response, function (key, value) {
            $("#name").append(
                '<option value="' + value.id + '">' + value.name + "</option>"
            );
        });
    },
    });
});

$('#shop-division').on('change', function () {
    console.log('shop division');
    $.ajax({
    url: "/admin/shops-by-division",
    type: "GET",
    data: {
        id: $(this).val(),
    },
    success: function (response) {
        $("#shop-name").html('<option value="">Choose...</option>');
        $.each(response, function (key, value) {
            $("#shop-name").append(
                '<option value="' + value.id + '">' + value.name + "</option>"
            );
        });
    },
    });
});

$('#shop-name').on('change', function () {
    console.log('value is', $(this).val());
    $.ajax({
    url: "/admin/user-by-shop",
    type: "GET",
    data: {
        id: $(this).val(),
    },
    success: function (response) {
        $("#name").html('<option value="">Choose...</option>');
        $.each(response, function (key, value) {
            $("#name").append(
                '<option value="' + value.id + '">' + value.name + "</option>"
            );
        });
    },
    });
});