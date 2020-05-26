function flash(type, message, title) {
    Command: toastr[type](message, title);
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "progressBar": true,
    };
}

/* login-form => admin_1/page_general_blog_post.php */

$("input[name='login']").on("click", function (e) {
    e.preventDefault();
    let email = $(".emailValueLogin").val();
    let password = $(".passwordValueLogin").val();
    let errorSpan = $(".errorLogin");

    if (email !== "" || password !== "") {
        $.ajax({
            url: `${window.location.origin}/PHPProject/controllers/loginControllers.php`,
            method: "post",
            data: {"email": email, "password": password},
            dataType: "json",
            success: function (result) {
                if (result.error === "error") {
                    errorSpan.text(result.message);
                    errorSpan.parent().removeClass("display-hide");
                    errorSpan.parent().css("display", "block");
                } else if (result.error === "not found") {
                    errorSpan.text(result.message);
                    errorSpan.parent().removeClass("display-hide");
                    errorSpan.parent().css("display", "block");
                } else {
                    window.location = `${window.location.origin}/PHPProject/admin_1/index.php`;
                }
            },
            error: function (error) {
                console.log(error)
            }
        });
    } else {
        errorSpan.text("You should enter email and password");
        errorSpan.parent().removeClass("display-hide");
        errorSpan.parent().css("display", "block");
    }
    setTimeout(function () {
        errorSpan.parent().addClass("display-hide");
        errorSpan.parent().css("display", "none");
    }, 5000);
});

var TableDatatablesButtons = function () {

    var initTable1 = function () {
        var table = $('#sample_1');

        var oTable = table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "_MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},


            buttons: [
                {
                    extend: 'print', className: 'btn dark btn-outline',
                    footer: false,
                    autoPrint: true,
                    title: $('h3.page-title').text(),
                    exportOptions: {
                        columns: ':not(.no-print)'
                    }
                },
                {extend: 'copy', className: 'btn red btn-outline'},
                {
                    extend: 'pdf',
                    className: 'btn green btn-outline',
                    title: $('h3.page-title').text(),
                    exportOptions: {
                        columns: ':not(.no-print)'
                    }
                },
                {
                    extend: 'excel', className: 'btn yellow btn-outline ',
                    title: $('h3.page-title').text(),
                    exportOptions: {
                        columns: ':not(.no-print)'
                    }
                },
                {
                    extend: 'csv', className: 'btn purple btn-outline ',
                    title: $('h3.page-title').text(),
                    exportOptions: {
                        columns: ':not(.no-print)'
                    }
                },
                {extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
            ],

            // setup responsive extension: http://datatables.net/extensions/responsive/
            responsive: true,

            //"ordering": false, disable column ordering
            //"paging": false, disable pagination

            "order": [
                [0, 'asc']
            ],

            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });
    }

    return {

        //main function to initiate the module
        init: function () {

            if (!jQuery().dataTable) {
                return;
            }

            initTable1();
        }

    };

}();

jQuery(document).ready(function () {
    TableDatatablesButtons.init();
});


$('.deleteProduct').click(function () {
    let that = this;
    bootbox.dialog({
        message: "Are you sure to delete this product ?",
        title: "Product",
        buttons: {
            success: {
                label: "Delete",
                className: "red",
                callback: function () {
                    let idProduct = $(that)[0].id;
                    let target = $(that).parent().parent();
                    $.ajax({
                        url: `${window.location.origin}/PHPProject/controllers/productsController.php`,
                        method: "post",
                        data: {"id": idProduct, "deleteProduct": "deleteProduct"},
                        dataType: "json",
                        success: function (result) {
                            if (result === true) {
                                target.remove();
                                flash("success", "The product is deleted successfully", "Success");
                            } else {
                                flash("error", "There is some thing wrong with delete", "Error");
                            }
                        },
                        error: function (error) {
                            console.log(error)
                        }
                    })
                }
            },
            // danger: {
            //     label: "Danger!",
            //     className: "red",
            //     callback: function() {
            //         alert("uh oh, look out!");
            //     }
            // },
            main: {
                label: "Cancel",
                className: "blue",
                callback: function () {
                    flash("info", "The delete is canceled", "Info");
                }
            }
        }
    });
});

$('.deleteUser').click(function () {
    let that = this;
    bootbox.dialog({
        message: "Are you sure to delete this user ?",
        title: "Product",
        buttons: {
            success: {
                label: "Delete",
                className: "red",
                callback: function () {
                    let idUser = $(that)[0].id;
                    let target = $(that).parent().parent();
                    $.ajax({
                        url: `${window.location.origin}/PHPProject/controllers/usersController.php`,
                        method: "post",
                        data: {"id": idUser, "deleteUser": "deleteUser"},
                        dataType: "json",
                        success: function (result) {
                            console.log(result);
                            if (result === true) {
                                target.remove();
                                flash("success", "The user is deleted successfully", "Success");
                            } else {
                                flash("error", "There is some thing wrong with delete", "Error");
                            }
                        },
                        error: function (error) {
                            console.log(error)
                        }
                    })
                }
            },
            main: {
                label: "Cancel",
                className: "blue",
                callback: function () {
                    flash("info", "The delete is canceled", "Info");
                }
            }
        }
    });
});

var FormValidationMd = function () {
    var handleValidation2 = function () {
        // for more info visit the official plugin documentation:
        // http://docs.jquery.com/Plugins/Validation
        var form1 = $('.validateProduct');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            messages: {
                product_img: {
                    accept: "The file should be Image with Ext: .png, .jpg, .jpeg",
                    filesize: "The file should be less than 1M"
                }
            },// validate all fields including form hidden input
            rules: {
                product_name: {
                    minlength: 2,
                    required: true
                },
                price: {
                    required: true,
                    digits: true
                },
                category_id: {
                    required: true
                },
                status: {
                    required: true
                },
                product_img: {
                    required: false,
                    accept: "image/jpeg, image/jpg, image/png",
                    extension: "png|jpeg|jpg",
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },

            errorPlacement: function (error, element) {
                if (element.is(':checkbox')) {
                    error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                } else if (element.is(':radio')) {
                    error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            // submitHandler: function(form) {
            //     success1.show();
            //     error1.hide();
            // }
        });
    };

    var handleValidation3 = function () {
        // for more info visit the official plugin documentation:
        // http://docs.jquery.com/Plugins/Validation
        var form1 = $('.validateUser');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            messages: {
                product_img: {
                    accept: "The file should be Image with Ext: .png, .jpg, .jpeg",
                    filesize: "The file should be less than 1M"
                }
            },// validate all fields including form hidden input
            rules: {
                user_name: {
                    minlength: 2,
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                ext: {
                    required: true
                },
                room_id: {
                    required: true
                },
                user_img: {
                    required: false,
                    accept: "image/jpeg, image/jpg, image/png",
                    extension: "png|jpeg|jpg",
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },

            errorPlacement: function (error, element) {
                if (element.is(':checkbox')) {
                    error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                } else if (element.is(':radio')) {
                    error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            // submitHandler: function(form) {
            //     success1.show();
            //     error1.hide();
            // }
        });
    };

    return {
        //main function to initiate the module
        init: function () {
            handleValidation2();
            handleValidation3();
        }
    };
}();

jQuery(document).ready(function () {
    FormValidationMd.init();
});

$(function () {
    let left = $(".left");
    // var music = $("audio");
    // setInterval(function () {
    //     music.get(0).play()
    // }, 500);
    setTimeout(function () {
        $("html").css("overflow", "auto")
    }, 1000);
    $("#users_select").on("change", function () {

        left.css("position", "relative");
        left.animate({
            top: "-150%"
        }, 600);
        left.animate({
            top: "0"
        }, 600);
        id_user = $(this).val();
        $.post(`${window.location.origin}/PHPProject/controllers/view_order.php`, {id_user: id_user}, function (data) {
            left.html(data);
            left.click();
        })
    });


// start calculate total_price

    left.on("click", function () {
        let total_price_products = 0;
        $(".product_of_user").each(function () {
            console.log($(this).children(".product_price").text());
            console.log($(this).children()[1].value);
            total_price_products += parseInt($(this).children(".product_price").text()) * $(this).children(".num_product").val();
            console.log(total_price_products);
        });
        $(".total_price_target").text(total_price_products);
        total_price_products = 0;
    });
// start click confirm to change status
    left.on("click", ".confirm_btn", function (e) {
        var order_id = $(".order_id").val();
        $.post(`${window.location.origin}/PHPProject/controllers/change_status_order.php`, {order_id: order_id}, function (data) {
            location.reload();
        })
    });
});

$(function () {
    setTimeout(function () {
        $("html").css("overflow", "auto")
    }, 1000)
    // when user does not select any product will appear that to guide him
    if ($(".users_product").children().length == 0) {
        $(".users_product").append(`<p class="no_product text-center">No Selected Product </p>`)
    }

    let count_products = [] //array to save count of products
    let id_prods = [] //array to save all id of products
    let count_product;
    let pro_id;
    $(".right").on("click", ".img_product", function () {
        product_price = $(this).siblings(".price").text();
        product_name = $(this).siblings(".product_name").text();
        product_id = $(this).attr("product_id");
        product_src = $(this).attr("src");

        $(".users_product").append(`
                  <div " class="product_of_user mt-1 p-2">
                    <input  hidden class="product_id" value="${product_id}" >
                    <span class="product_name">${product_name}</span>
                    <input class="num_product" type="number" value="0">
                    <span class="product_price">${product_price}  </span>
                    <span class="cancel"> x </span>
                   </div>

            `);
        // increase product
        counter = 0;
        $(".left .product_name").each(function () {
            if ($(this).text() === product_name) {
                // $(this).parent().remove()
                var ref_text = $(this);
                val_input = parseInt($(this).siblings(".num_product").val())
                val_input += 1;
                var nums = $(this).siblings(".num_product").val(val_input)
                $(ref_text).parent().next().remove()
            }
        });
        // start animate images to div and append in div products
        var x_div_target = $(".users_product").offset();
        var ref_img = $(this);
        copy_image = $(ref_img).clone(true);
        setTimeout(function () {
            $(ref_img).siblings(".price").after(copy_image);
            $(ref_img).remove()
        }, 2000);
        var x_img = $(this).offset();
        distx = -(x_img.left - x_div_target.left);
        disty = -(x_img.top - x_div_target.top) - 20;
        $(this).css({
            position: "relative",
            transform: "scale(.5)",
            transition: "1.5s",
            boxShadow: " 7px 7px 10px red,-7px -7px 10px blue,10px 10px 10px black"

        });

        setTimeout(function () {
            $(ref_img).css({
                transform: "  scale(.5) rotate(360deg) rotate(360deg) rotate(360deg)  ",
                transition: '1'
            });
            $(ref_img).animate({
                top: `${disty}px`,
                left: `${distx}px`
            }, 800);
            setTimeout(function () {
                $(ref_img).css({
                    opacity: ".5",
                    transition: "2s"
                })
            }, 1000);
            setTimeout(function () {
                $(".left").css({
                    animation: "rotating 1s"
                })
            }, 1600);

            setTimeout(function () {
                $(".left").css("animation", "")
            }, 2600)
        }, 400);

        // end animate images to div and append in div products
        // start collect data and append it in form
        $(".no_product").text("your Products");
        $(".product_of_user").click()
    });
    /// calculate total_price
    $(".users_product").on("click", ".product_of_user", function () {
        let total_price_products = 0
        $(".product_of_user").each(function () {
            total_price_products += parseInt($(this).children(".product_price").text()) * $(this).children(".num_product").val()
        });
        $(".total_price_target").text(total_price_products);
        total_price_products = 0;
    });
    // start send data with confirm to server
    $(".confirm").click(function (e) {
        e.preventDefault();
        let notes = $("#notes").val();
        let room_id = $("#room_id").val();
        // get count of value of product
        let num_products_arr = document.querySelectorAll(".num_product");
        for (let i = 0; i < num_products_arr.length; i++) {
            let num_products = num_products_arr[i].value
            count_products.push(num_products)
        }
        var count_productss = count_products.join();
        // get count of value of product
        let id_products_arr = document.querySelectorAll(".product_id")
        for (let i = 0; i < id_products_arr.length; i++) {
            let id_products = id_products_arr[i].value
            id_prods.push(id_products)
        }
        var id_prodss = id_prods.join();
        console.log(id_prodss,count_productss,notes,room_id);
        // send data to server with ajax
        $.post(`${window.location.origin}/PHPProject/controllers/add_order.php`, {
            id_prodss: id_prodss,
            count_productss: count_productss,
            notes: notes,
            room_id: room_id
        }, function (data) {
            console.log(data);
        })
    });
    //remove product
    $(".users_product").on("click", ".cancel", function () {
        $(this).parent().remove()
    });

    // start search
    $(".search").on("keyup", function () {
        let key_search = $(this).val();
        console.log(key_search);
        $.post(`${window.location.origin}/PHPProject/controllers/search_product.php`, {key_search: key_search}, function (data) {
            $(".product_result").html(data)
        })
    });
    $(".heart").on("click", function () {
        $("body").append(`<div  class="blur" style=' z-index:1;font-size:30px; width:100%; height:200vh;position:absolute;top:0;left:0;background:rgba(0,0,0,.8)' >
              <span class="close_team " style= " cursor:pointer;background:green;padding:10px;border-radius:50%;color:orange;position:absolute;top: 45%;left:46%;"> X </span>
             // <p style='position:absolute;top:35%;left:40%;color:green; font-size:40px;'> The Team</p>
              <p class="text-center" style="z-index:11;color:orange;position:absolute;top: 65%;left:9%;" id="typer_text"></p>
             </div>`);
        $(".team_img").css("top", "-250px");
        $(".user1").addClass("team_animation").css("left", "100px");
        $(".user2").addClass("team_animation").css("left", "300px");
        $(".user3").addClass("team_animation").css("left", "500px");
        $(".user4").addClass("team_animation").css("left", "700px");
        $(".user5").addClass("team_animation").css("left", "900px");
        setTimeout(function () {
            $(".blur").append(`
            <div class="set">
              <div><img src="../Images/leave1.png"></div>
              <div><img src="../Images/leave2.png"></div>
              <div><img src="../Images/leave3.png"></div>
              <div><img src="../Images/leave4.png"></div>
              <div><img src="../Images/leave5.png"></div>
              <div><img src="../Images/leave6.png"></div>
              <div><img src="../Images/leave1.png"></div>
              <div><img src="../Images/leave2.png"></div>
              <div><img src="../Images/leave3.png"></div>
              <div><img src="../Images/leave4.png"></div>
              <div><img src="../Images/leave5.png"></div>
              <div><img src="../Images/leave6.png"></div>
              <div><img src="../Images/leave1.png"></div>
              <div><img src="../Images/leave2.png"></div>
              <div><img src="../Images/leave3.png"></div>
              <div><img src="../Images/leave4.png"></div>
              <div><img src="../Images/leave5.png"></div>
              <div><img src="../Images/leave6.png"></div>
            </div>`);
            $("html").css("overflow", "hidden")
        }, 1800)
        var typer_text = $("#typer_text");
        var string = "This Website Created By Creative Team ----->  salah , Nora ,Hajer ,Elnagar , Ahmed Said All CopyRight And Reservsed To Us ";
        i = 0;
        typing = setInterval(function () {
            typer_text.append(string[i]);
            i++;
            if (i > string.length - 1) {
                clearInterval(typing)
            }
        }, 100);
        $(".close_team").on("click", function () {
            $("html").css("overflow", "auto");
            clearInterval(typing);
            typer_text.text("");
            $(".blur").remove();
            $(".team_img").removeClass("team_animation").css({
                top: "5%",
                left: "39%",
                transition: "1s"
            })
        })
    });
    $(document).keyup(function (e) {
        if (e.keyCode == 27) {
            $(".close_team").click()
        }
    });
    // start animation loading
    $(window).on("load", function () {
    })
});



