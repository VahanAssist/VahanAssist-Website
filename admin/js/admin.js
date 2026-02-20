function deleteProduct(id) {
    //alert('test');
    var base_url = $("#base_url").val();
    var conf = confirm("Are you sure you want to delete this");
    if (conf == true) {
        var datastring = "id=" + id;
        //alert(datastring);
        $.ajax({
            url: base_url + "Insert_con/deleteProduct//" + id,
            // data: datastring,
            type: "POST",
            success: function (data) {
                // //alert(data);
                var obj = jQuery.parseJSON(data);
                if (obj.status == true) {
                    alert('Deleted Successfully');
                    location.reload();
                } else {
                    alert("Try Again");
                }
            }
        });
    }
}
function deleteSociety(id) {
    //alert('test');
    var base_url = $("#base_url").val();
    var conf = confirm("Are you sure you want to delete this");
    if (conf == true) {
        var datastring = "id=" + id;
        //alert(datastring);
        $.ajax({
            url: base_url + "Insert_con/deleteSociety//" + id,
            // data: datastring,
            type: "POST",
            success: function (data) {
                // //alert(data);
                var obj = jQuery.parseJSON(data);
                if (obj.status == true) {
                    alert('Deleted Successfully');
                    location.reload();
                } else {
                    alert("Try Again");
                }
            }
        });
    }
}
function deleteCoupon(id) {
    //alert('test');
    var base_url = $("#base_url").val();
    var conf = confirm("Are you sure you want to delete this");
    if (conf == true) {
        var datastring = "id=" + id;
        //alert(datastring);
        $.ajax({
            url: base_url + "Insert_con/deleteCoupon//" + id,
            // data: datastring,
            type: "POST",
            success: function (data) {
                // //alert(data);
                var obj = jQuery.parseJSON(data);
                if (obj.status == true) {
                    alert('Deleted Successfully');
                    location.reload();
                } else {
                    alert("Try Again");
                }
            }
        });
    }
}
function deleteUser(id) {
    //alert('test');
    var base_url = $("#base_url").val();
    var conf = confirm("Are you sure you want to delete this");
    if (conf == true) {
        var datastring = "id=" + id;
        //alert(datastring);
        $.ajax({
            url: base_url + "Insert_con/deleteUser//" + id,
            // data: datastring,
            type: "POST",
            success: function (data) {
                // //alert(data);
                var obj = jQuery.parseJSON(data);
                if (obj.status == true) {
                    alert('Deleted Successfully');
                    location.reload();
                } else {
                    alert("Try Again");
                }
            }
        });
    }
}

function deleteTestimonial(id) {

    //alert('test');

    var base_url = $("#base_url").val();

    var conf = confirm("Are you sure you want to delete this");

    if (conf == true) {

        var datastring = "id=" + id;

        //alert(datastring);

        $.ajax({



            url: base_url + "Insert_con/deleteTestimonial//" + id,

            // data: datastring,

            type: "POST",

            success: function (data) {

                // //alert(data);

                var obj = jQuery.parseJSON(data);

                if (obj.status == true) {

                    alert('Deleted Successfully');

                    location.reload();

                } else {

                    alert("Try Again");

                }

                //



            }

        });

    }

}
function deleteMultiImage(id, image) {
    //alert('test');
    var base_url = $("#base_url").val();
    var conf = confirm("Are you sure you want to delete this");
    if (conf == true) {
        var datastring = "id=" + id + "&image=" + image;
        //alert(datastring);
        $.ajax({
            url: base_url + "Insert_con/deleteMultiImage//" + id,
            data: datastring,
            type: "POST",
            success: function (data) {
                //alert(data);
                var obj = jQuery.parseJSON(data);
                if (obj.status == true) {
                    alert('Deleted Successfully');
                    location.reload();
                } else {
                    alert("Try Again");
                }
            }
        });
    }
}
function orderCreate(id) {
    //alert('test');
    var base_url = $("#base_url").val();
    var conf = confirm("Are you sure");
    if (conf == true) {
        var itemLength = $("#itemLength" + id).val();
        var itemWidth = $("#itemWidth" + id).val();
        var itemHeight = $("#itemHeight" + id).val();
        var itemWeight = $("#itemWeight" + id).val();
        var count = $("#count").val();
        var datastring = "id=" + id + "&count=" + count + "&itemLength=" + itemLength + "&itemWidth=" + itemWidth + "&itemHeight=" + itemHeight + "&itemWeight=" + itemWeight;
        //alert(datastring);
        $.ajax({
            url: base_url + "Shipment/set_order_multi//" + id,
            data: datastring,
            type: "POST",
            success: function (data) {
                alert(data);
                location.reload();

                // var obj = jQuery.parseJSON(data);
                // if(obj.status==true)
                // {
                // alert('Deleted Successfully');
                // location.reload();
                // }else{
                //     alert("Try Again");
                // }
            }
        });
    }
}



function deleteCategory(id) {

    //alert('test');

    var base_url = $("#base_url").val();

    var conf = confirm("Are you sure you want to delete this");

    if (conf == true) {

        var datastring = "id=" + id;

        //alert(datastring);

        $.ajax({



            url: base_url + "Insert_con/deleteCategory//" + id,

            // data: datastring,

            type: "POST",

            success: function (data) {

                // //alert(data);

                var obj = jQuery.parseJSON(data);

                if (obj.status == true) {

                    alert('Deleted Successfully');

                    location.reload();

                } else {

                    alert("Try Again");

                }

                //



            }

        });

    }

}

function deleteSubCategory(id) {

    //alert('test');

    var base_url = $("#base_url").val();

    var conf = confirm("Are you sure you want to delete this");

    if (conf == true) {

        var datastring = "id=" + id;

        //alert(datastring);

        $.ajax({



            url: base_url + "Insert_con/deleteSubCategory//" + id,

            // data: datastring,

            type: "POST",

            success: function (data) {



                if (data == 1000) {

                    alert('Deleted Successfully');

                    location.reload();

                } else {

                    alert("Try Again");

                }

                //



            }

        });

    }

}

$("form[name='doLogin']").submit(function (e) {
    console.log("Login form submitted");
    var base_url = $("#base_url").val();
    console.log("Base URL:", base_url);

    console.log("submit clicked");

    // alert(base_url);

    var formData = new FormData($(this)[0]);

    console.log("formdata at submit", formData);

    $.ajax({

        url: base_url + "App/adminLogin",

        type: "POST",

        data: formData,

        async: false,

        success: function (data) {

            // alert(data);

            if (data == 1000) {



                // alert("Verifier Blocked");

                window.location = base_url;

            }

            else if (data == 1002) {



                // alert("Verifier Blocked");

                window.location = base_url + "Main_con/client_dashboard";

            }

            else if (data == 1003) {



                // alert("Verifier Blocked");

                window.location = base_url + "Main_con/partner_dashboard";

            }

            else {

                alert('Please Check your credentials');

            }

        },

        cache: false,

        contentType: false,

        processData: false

    });

    e.preventDefault();

});

function getSubCatgByCatId() {

    //alert('test');

    var category_id = $("#category_id").val();

    var base_url = $("#base_url").val();



    var datastring = "category_id=" + category_id;

    //alert(datastring);

    $.ajax({



        url: base_url + "Insert_con/getSubCatgByCatId",

        data: datastring,

        type: "POST",

        success: function (data) {

            alert(data);

            $("#sub_category_id").html(data);

        }

    });



}

///////////////////////multiple image open ////////////
var abc = 0; //Declaring and defining global increement variable

$(document).ready(function () {

    //To add new input file field dynamically, on click of "Add More Files" button below function will be executed
    $('#add_more').click(function () {
        $(this).before($("<div/>", { id: 'filediv' }).fadeIn('slow').append(
            $("<input/>", { name: 'product_image1[]', type: 'file', id: 'file', class: '' }),

            $("")
        ));
    });
    $('#add_more').click(function () {
        $(this).before($("<div/>", { id: 'filediv' }).fadeIn('slow').append(
            $("<input/>", { name: 'product_image1[]', type: 'text', id: 'text', class: '' }),

            $("")
        ));
    });
    //following function will executes on change event of file input to select different file 
    $('body').on('change', '#file', function () {
        if (this.files && this.files[0]) {
            abc += 1; //increementing global variable by 1

            var z = abc - 1;
            var x = $(this).parent().find('#previewimg' + z).remove();
            $(this).before("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src='' class='img-thumbnail'/></div>");

            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);

            $(this).hide();
            $("#abcd" + abc).append($("<img/>", { id: 'img', src: 'http://profyn.com/img/del.png', alt: 'delete', class: 'deleteimg' }).click(function () {
                $(this).parent().parent().remove();
            }));
        }
    });

    //To preview image     
    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    };

    $('#upload').click(function (e) {
        var name = $(":file").val();
        if (!name) {
            alert("First Image Must Be Selected");
            e.preventDefault();
        }
    });
});
/////////////////////////multiple image close//////////////
$("form[name='updateOrder']").submit(function (e) {

    console.log("submit clicked");

    var base_url = $("#base_url").val();

    // alert(base_url);

    var formData = new FormData($(this)[0]);

    console.log("formdata at submit", formData);

    $.ajax({

        url: base_url + "Insert_con/updateOrder",

        type: "POST",

        data: formData,

        async: false,

        success: function (data) {
            ///alert(data);
            if (data == 1000) {

                alert("Customer Details Update.");

                window.location = base_url + "Main_con/orders";
            }
            else {
                alert('Please Try Again');

            }

        },

        cache: false,

        contentType: false,

        processData: false

    });

    e.preventDefault();

});
function getSlug() {
    var base_url = $("#base_url").val();
    var product_name = $("#product_name").val();
    var datastring = "product_name=" + product_name;
    $.ajax({
        url: base_url + "Insert_con/getSlug",
        data: datastring,
        type: "POST",
        success: function (data) {
            //alert(data);
            //var obj = jQuery.parseJSON(data);
            $('[name="slug"]').val(data);


        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }

    });
}
function getSlugCat() {
    var base_url = $("#base_url").val();
    var product_name = $("#category_name").val();
    var datastring = "product_name=" + product_name;
    //alert(datastring);
    $.ajax({
        url: base_url + "Insert_con/getSlug",
        data: datastring,
        type: "POST",
        success: function (data) {
            //alert(data);
            //var obj = jQuery.parseJSON(data);
            $('[name="slug"]').val(data);


        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }

    });
}
function getSubCatSlug() {
    var base_url = $("#base_url").val();
    var product_name = $("#subcategory_name").val();
    var datastring = "product_name=" + product_name;
    //alert(datastring);
    $.ajax({
        url: base_url + "Insert_con/getSlug",
        data: datastring,
        type: "POST",
        success: function (data) {
            //alert(data);
            //var obj = jQuery.parseJSON(data);
            $('[name="slug"]').val(data);


        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }

    });
}
$("form[name='updateDeliveryBoy']").submit(function (e) {
    console.log("submit clicked");
    var base_url = $("#base_url").val();
    // alert(base_url);
    var formData = new FormData($(this)[0]);
    console.log("formdata at submit", formData);
    $.ajax({
        url: base_url + "Insert_con/updateDeliveryBoy",
        type: "POST",
        data: formData,
        async: false,
        success: function (data) {
            ///alert(data);
            if (data == 1000) {
                alert("Order Asign.");
                location.reload();
            }
            else {
                alert('Please Try Again');

            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
    e.preventDefault();
});
$("form[name='updateCash']").submit(function (e) {
    console.log("submit clicked");
    var base_url = $("#base_url").val();
    // alert(base_url);
    var formData = new FormData($(this)[0]);
    console.log("formdata at submit", formData);
    $.ajax({
        url: base_url + "Insert_con/updateCash",
        type: "POST",
        data: formData,
        async: false,
        success: function (data) {
            //alert(data);
            if (data == 1000) {
                alert("Updated.");
                location.reload();
            }
            else {
                alert('Please Try Again');

            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
    e.preventDefault();
});

function getType(e) {
    console.log(e.value);
    let div1 = document.getElementById('fullPrice');
    let div2 = document.getElementById('halfPrice');
    if (e.value == 1) {
        div1.classList.remove("d-none");
    }
    else if (e.value == 2) {
        div1.classList.remove("d-none");
        div2.classList.remove("d-none");
    }
    else {
        div1.classList.add("d-none");
        div2.classList.add("d-none");
    }

}

function deleteBooking(id) {
    var base_url = $("#base_url").val();

    var conf = confirm("Are you sure you want to delete this");

    if (conf == true) {

        var datastring = "id=" + id;

        $.ajax({



            url: base_url + "Insert_con/deleteBooking//" + id,

            // data: datastring,

            type: "POST",

            success: function (data) {
                var obj = jQuery.parseJSON(data);

                if (obj.status == true) {

                    alert('Deleted Successfully');

                    location.reload();

                } else {

                    alert("Try Again");

                }


            }

        });

    }

}

function deleteUser(id) {
    var base_url = $("#base_url").val();

    var conf = confirm("Are you sure you want to delete this");

    if (conf == true) {

        var datastring = "id=" + id;

        $.ajax({



            url: base_url + "Insert_con/deleteUser//" + id,

            // data: datastring,

            type: "POST",

            success: function (data) {
                var obj = jQuery.parseJSON(data);

                if (obj.status == true) {

                    alert('Deleted Successfully');

                    location.reload();

                } else {

                    alert("Try Again");

                }


            }

        });

    }

}

function deleteBanner(id) {
    var base_url = $("#base_url").val();

    var conf = confirm("Are you sure you want to delete this");

    if (conf == true) {

        var datastring = "id=" + id;

        $.ajax({



            url: base_url + "Insert_con/deleteBanner//" + id,

            // data: datastring,

            type: "POST",

            success: function (data) {
                var obj = jQuery.parseJSON(data);

                if (obj.status == true) {

                    alert('Deleted Successfully');

                    location.reload();

                } else {

                    alert("Try Again");

                }


            }

        });

    }

}

function deleteServices(id) {
    var base_url = $("#base_url").val();

    var conf = confirm("Are you sure you want to delete this");

    if (conf == true) {

        var datastring = "id=" + id;

        $.ajax({



            url: base_url + "Insert_con/deleteServices//" + id,

            // data: datastring,

            type: "POST",

            success: function (data) {
                var obj = jQuery.parseJSON(data);

                if (obj.status == true) {

                    alert('Deleted Successfully');

                    location.reload();

                } else {

                    alert("Try Again");

                }


            }

        });

    }

}

function deleteCarBrand(id) {
    var base_url = $("#base_url").val();

    var conf = confirm("Are you sure you want to delete this");

    if (conf == true) {

        var datastring = "id=" + id;

        $.ajax({



            url: base_url + "Insert_con/deleteCarBrand//" + id,

            // data: datastring,

            type: "POST",

            success: function (data) {
                var obj = jQuery.parseJSON(data);

                if (obj.status == true) {

                    alert('Deleted Successfully');

                    location.reload();

                } else {

                    alert("Try Again");

                }


            }

        });

    }

}


function deleteCarModel(id) {
    var base_url = $("#base_url").val();

    var conf = confirm("Are you sure you want to delete this");

    if (conf == true) {

        var datastring = "id=" + id;

        $.ajax({



            url: base_url + "Insert_con/deleteCarModel//" + id,

            // data: datastring,

            type: "POST",

            success: function (data) {
                var obj = jQuery.parseJSON(data);

                if (obj.status == true) {

                    alert('Deleted Successfully');

                    location.reload();

                } else {

                    alert("Try Again");

                }


            }

        });

    }

}

function deleteVehicle(id) {
    var base_url = $("#base_url").val();

    var conf = confirm("Are you sure you want to delete this");

    if (conf == true) {

        var datastring = "id=" + id;

        $.ajax({



            url: base_url + "Insert_con/deleteVehicle//" + id,

            // data: datastring,

            type: "POST",

            success: function (data) {
                var obj = jQuery.parseJSON(data);

                if (obj.status == true) {

                    alert('Deleted Successfully');

                    location.reload();

                } else {

                    alert("Try Again");

                }


            }

        });

    }

}

function deletePackages(id) {
    var base_url = $("#base_url").val();

    var conf = confirm("Are you sure you want to delete this");

    if (conf == true) {

        var datastring = "id=" + id;

        $.ajax({



            url: base_url + "Insert_con/deletePackages//" + id,

            // data: datastring,

            type: "POST",

            success: function (data) {
                var obj = jQuery.parseJSON(data);

                if (obj.status == true) {

                    alert('Deleted Successfully');

                    location.reload();

                } else {

                    alert("Try Again");

                }


            }

        });

    }

}

function updateBlockStatus(e, val) {
    var base_url = $("#base_url").val();

    let id = e;

    var conf = confirm("Are you sure you want to Change this");

    if (conf == true) {

        var datastring = `id=${id}&status=${val.value}`;

        $.ajax({



            url: base_url + "Insert_con/updateBlockStatus//" + id,

            data: datastring,

            type: "POST",

            success: function (data) {

                console.log(data);
                var obj = jQuery.parseJSON(data);

                if (obj.status == "ok") {

                    alert('Updated Success');

                    location.reload();

                } else {

                    alert("Try Again");

                }


            }

        });

    }

}

function updateVerifyStatus(e, val) {
    var base_url = $("#base_url").val();

    let id = e;

    var conf = confirm("Are you sure you want to Change Status?");

    if (conf == true) {

        var datastring = `id=${id}&status=${val.value}`;

        $.ajax({



            url: base_url + "Insert_con/updateVerifyStatus//" + id,

            data: datastring,

            type: "POST",

            success: function (data) {

                // console.log(data);
                var obj = jQuery.parseJSON(data);

                if (obj.status == "ok") {

                    alert('Updated Success');

                    location.reload();

                } else {

                    alert("Try Again");

                }


            }

        });

    }

}

function deleteCity(id) {
    //alert('test');
    var base_url = $("#base_url").val();
    var conf = confirm("Are you sure you want to delete this City?");
    if (conf == true) {
        var datastring = "id=" + id;
        //alert(datastring);
        $.ajax({
            url: base_url + "Insert_con/deleteCity//" + id,
            // data: datastring,
            type: "POST",
            success: function (data) {
                // //alert(data);
                var obj = jQuery.parseJSON(data);
                if (obj.status == true) {
                    alert('Deleted Successfully');
                    location.reload();
                } else {
                    alert("Try Again");
                }
            }
        });
    }
}

function deleteState(id) {
    //alert('test');
    var base_url = $("#base_url").val();
    var conf = confirm("Are you sure you want to delete this State?");
    if (conf == true) {
        var datastring = "id=" + id;
        //alert(datastring);
        $.ajax({
            url: base_url + "Insert_con/deleteState//" + id,
            // data: datastring,
            type: "POST",
            success: function (data) {
                // //alert(data);
                var obj = jQuery.parseJSON(data);
                if (obj.status == true) {
                    alert('Deleted Successfully');
                    location.reload();
                } else {
                    alert("Try Again");
                }
            }
        });
    }
}


