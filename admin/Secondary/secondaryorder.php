
<?php
session_start();
if(!isset($_SESSION['email']))
{
    header("location:../index.php");
}
include('../include/header.php');
include('../include/navbar.php');
include('../connect/connect.php');
$email=$_SESSION['email'];
$q=mysqli_query($conn, "SELECT UserRoles FROM users where email='$email'");
$b=mysqli_fetch_assoc($q);
$addw=$b['UserRoles'];
$array=json_decode($addw,true);
$add=$array['SecondaryOrder']['Add'];
$view=$array['SecondaryOrder']['View'];
$sr=0;
$query = "SELECT * FROM secondaryorder ";
$result = mysqli_query($conn, $query);
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <?php include('../include/profile.php');?>

        <!-- Begin Page Content -->
        <div class="container-fluid"  id="divmain" >

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Secondary Order</h1>


            <!-- DataTales Example -->
            <div class="card shadow mb-4" id="divmain2">
                <div class="card-header py-3">
            <?php
            if($add==1)
            {?>
                <button onclick="addsecondary()" class="btn btn-success"><i class="fas fa-fw fa-plus"></i></button>
            <?php
            }
            ?>


                </div>

                <div class="card-body" >
                    <div class="table-responsive"></div>
                    <?php include("secondary_table.php");?>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


    <!-- End of Content Wrapper -->
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({

                // Set the 3rd column of the
                // DataTable to ascending order
                order: [7, 'desc']
            });
        });
        function addsecondary() {
            $.ajax({
                url:     "SecondaryCRUD.php",
                data:    {action:"addorder"},
                method:  "POST",
                success:function (response) {
                    $("#divmain").html(response);
                }
            })
        }

        let duplicatecheck = {};
        var clik=0;
        var i=1;
        var count=0;
        var counter=1;
        //console.log(count);
        var j=0;
        var itemname="";
        $(document).on('click', '.btn_name', function() {
            var nameid=$(this).attr("id");
            //console.log(nameid);
            var arrayvalue=nameid.split("_");
            //console.log(arrayvalue[1]);
            clik=arrayvalue[1];
            //console.log(clik);

        });
        $(document).on('click', '#add', function() {
            i++;
            counter++;
            //console.log(counter);
            $('#counter').attr('value',counter);
            //console.log(i);
            $('#dynamic_field').append('<tr id="row' + i + '"><input type="hidden" id="itemid_' + i + '" name="itemid_' + i + '" readonly class="form-control">' +
                '<td><input type="text"  name="username_' + i + '" id="username_' + i + '" placeholder="" class="form-control username btn_name" autocomplete="off" required autocomplete="off" onkeyup="setnull(this)";   " /></td><br>\n' +
                '                        <td><input type="int" pattern="^[0-9]*$" name="quantity_' + i + '" id="quantity_' + i + '" class="form-control name_list btn_qty" required oninput="this.value = this.value.replace(/[^0-9]/g, \'\').replace(/(\\.*)\\./g, \'$1\');"  onkeyup="setTotalPricing(this);"/></td>\n' +
                '                        <td><input type="text" name="et_' + i + '"  id="et_' + i + '" readonly class="form-control name_list" /></td>\n' +
                '                        <td><input type="text" name="tax_' + i + '"  id="tax_' + i + '" readonly class="form-control name_list" /></td>\n' +
                '                        <td><input type="text" name="it_' + i + '"  id="it_' + i + '" readonly class="form-control name_list" /></td>\n' +
                '                        <td><input type="text" name="total_' + i + '" id="total_' + i + '" value="0" readonly class="form-control name_list total_field" /></td>');


        });
        $(document).on('click', '.btn_name', function() {
            var nameid=$(this).attr("id");
            //console.log(nameid);
            var arrayvalue=nameid.split("_");
            //console.log(arrayvalue[1]);
            clik=arrayvalue[1];
            //console.log(clik);
            autoCompleteList(clik);
        });



        $(document).on('click' , '.btn_remove', function() {
            if(i!=1)
            {
                var button_id = i;
                console.log(button_id);

                //console.log(button_id);
                var qty = $("#quantity_"+button_id).val();
                //console.log(qty);
                var it = $("#it_"+button_id).val();
                //console.log(it);
                var tt =qty*it;
                //console.log(tt);
                //console.log(count);
                // count=count-tt;
                // //console.log(count);
                // $("#totalprice_1").val(count);
                var total=tt;
                var totalsum=$("#totalprice_1").val();
                totalsum-=total;
                console.log("hey");
                //console.log(totalsum);
                // let totalSum = 0;
                // $.each($(".total_field"), function(i ,  obj) {
                //
                //     totalSum += parseFloat($(obj).val());
                //     console.log(totalSum);
                // })
                $("#totalprice_1").val(totalsum);
                var itemid=$("#itemid_"+button_id).val();
                var itemname=$("#username_"+button_id).val();
                //console.log(itemname);
                //console.log(itemid);
                delete duplicatecheck[itemname];
                //unset($duplicatecheck[itemname]);
                //console.log(duplicatecheck);
                counter--;
                //console.log(counter);
                i--;
                $('#row'+button_id+'').remove();

            }

        })
            function submitt() {
                return;
            }

            $(document).on('click', '.submit', function () {

                $("#form_data").submit(function () {
                    var formData = new FormData();
                    //console.log("formdata", $(this).serializeArray());
                    $.each($(this).serializeArray(), function (key, form_data) {
                        formData.append(form_data.name, form_data.value);
                    });
                    for (var pair of formData.entries()) {
                        // console.log(pair[0]+ ': '+ pair[1]);
                    }
                    swal.fire({
                        title: 'Do you want to save the changes?',
                        icon: 'info',
                        showDenyButton: true,
                        confirmButtonText: 'Yes',
                        denyButtonText: `No`,

                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "secondaryproductorder.php",
                                method: "POST",
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: async function (response) {
                                    console.log(response);
                                    if (response > 0) {
                                        window.location.href = "";
                                    } else {
                                        Swal.fire(response, '', 'error')
                                        return false;
                                    }
                                }
                            });
                        }
                        else if (result.isDenied) {

                        }
                        else
                        {
                            window.location.href="";
                        }
                    })

                    return false;
                })


                })




            $(document).on('click', '.btn_qty', function() {
                var button_id = $(this).attr("id");
                console.log(button_id);
                var arrayvalue = button_id.split("_");

                console.log(arrayvalue[1]);
                clik=arrayvalue[1];

            });
        $(document).on('click', '.username', function() {
            itemname = $(this).val();
            console.log(itemname);
        });
        function setnull(name){
            const key = event.key;
            console.log("set null",clik)
            if (key === "Backspace" || key === "Delete")
            {
                // document.getElementById(
                //     'username_'+clik).value = '';
                delete duplicatecheck[itemname];
                var total=$("#total_"+clik).val();
                //console.log("bye");
                $("#itemid_"+clik).val("");
                $("#et_"+clik).val("");
                $("#tax_"+clik).val("");
                $("#it_"+clik).val("");
                $("#total_"+clik).val(0);
                $("#quantity_"+clik).val("");
                var totalorder=$("#totalprice_1").val();
                var cal=totalorder-total;
                $("#totalprice_1").val(cal);


            }
        }

            function setTotalPricing(qtyObject){
                if($(qtyObject).val()==0)
                {
                    $(qtyObject).val("");
                }
                var it = $("#it_"+clik).val();
                var qty = $(qtyObject).val();
                if (qty.match(/^[0-9]*$/)) {
                    var tt =qty*it;
                    //console.log(tt);
                    $("#total_"+clik).val(qty*it);
                }
                else
                {
                    var arrayvalue=qty.split(".");
                    if(arrayvalue[0].match(/^[0-9]*$/))
                    {

                        $(qtyObject).val(arrayvalue[0]);
                        qty=arrayvalue[0];
                        $("#total_"+clik).val(qty*it);

                    }
                    else
                    {
                        $(qtyObject).val("");
                        qty=0;
                        $("#total_"+clik).val(qty*it);
                    }
                }
                let totalSum = 0;
                $.each($(".total_field"), function(i ,  obj) {

                    totalSum += parseFloat($(obj).val());
                });
                $("#totalprice_1").val(totalSum);
            }

            $(document).on('click', '.username', function() {
                itemname = $(this).val();
                //console.log(itemname);
            });
        function setpricing(item) {
            $("#itemid_"+clik).val(item.itemid);
            //console.log("#itemid_"+clik);
            $("#et_"+clik).val(item.et);
            $("#tax_"+clik).val(item.tax);
            $("#it_"+clik).val(item.it);
            $("#total_"+clik).val(0);
        }
        function setPrice( item ) {
            $("#itemid_1").val(item.itemid);
            $("#et_1").val(item.et);
            $("#tax_1").val(item.tax);
            $("#it_1").val(item.it);
            $("#total_1").val(0);

        }
        function setTotalPrice(qtyObject){
            //console.log("qty");
            if($(qtyObject).val()==0)
            {
                $(qtyObject).val("");
            }
            var it = $("#it_1").val();
            var qty = $(qtyObject).val();
            if (qty.match(/^[0-9]*$/)) {
                var tt =qty*it;
                //console.log(tt);
                $("#total_1").val(qty*it);
            }
            else
            {
                var arrayvalue=qty.split(".");
                if(arrayvalue[0].match(/^[0-9]*$/))
                {

                    $(qtyObject).val(arrayvalue[0]);
                    qty=arrayvalue[0];
                    $("#total_1").val(qty*it);

                }
                else
                {
                    $(qtyObject).val("");
                    qty=0;
                    $("#total_1").val(qty*it);
                }
            }


            let totalSum = 0;
            $.each($(".total_field"), function(i ,  obj) {

                totalSum += parseFloat($(obj).val());
            })
            $("#totalprice_1").val(totalSum);

        }
        function autoCompleteList(counter)
        {
            console.log(counter);

            $( "#username_"+counter ).autocomplete({
                source: function( request, response ) {
                    $.ajax( {
                        url: "getProducts.php",
                        dataType: "jsonp",
                        data: {
                            q: request.term, duplicate: JSON.stringify(duplicatecheck)
                        },
                        success: function( data ) {
                            response( data );

                        }
                    } );
                },
                minLength: 1,
                select: function( event, ui ) {

                    let itemId = ui.item
                    let id= ui.item.itemid;
                    let label = ui.item.label;
                    duplicatecheck[label] = id;
                    //console.log(duplicatecheck)
                    setpricing(ui.item);

                }
            } );
        }
        if(clik>0)
        {
            $( function() {

                $( ".username" ).autocomplete({

                    source: function( request, response ) {
                        $.ajax( {
                            url: "getProducts.php",
                            dataType: "jsonp",
                            data: {
                                q: request.term, duplicate: JSON.stringify(duplicatecheck)
                            },

                            success: function( data ) {
                                response( data );


                            }
                        } );
                    },
                    minLength: 1,
                    select: function( event, ui ) {

                        let itemId = ui.item
                        let id= ui.item.itemid;
                        //console.log(id);
                        let label = ui.item.label;
                        //console.log(label);
                        duplicatecheck[label] = id;
                        //console.log(duplicatecheck)
                        //console.log(ui.item);
                        setPrice(ui.item);

                    }
                } );
            } );
        }
        function setstoreid(item) {
            $("#storeid").val(item.storeid);

        }
        $(document).on('click','.storename',function () {
            $( function() {

                $( '.storename' ).autocomplete({

                    source: function( request, response ) {
                        $.ajax( {
                            url: "storeajax.php",
                            dataType: "jsonp",
                            data: {
                                q: request.term, duplicate: JSON.stringify(duplicatecheck)
                            },

                            success: function( data ) {
                                response( data );
                                console.log(data);

                                // alert(data);
                                // console.log(data)
                                // let id= ui.item.itemid;
                                // let label = ui.item.label;
                                // duplicatecheck[label] = id;

                            }
                        } );
                    },
                    minLength: 1,
                    select: function( event, ui ) {


                        setstoreid(ui.item);

                    }
                } );
            } );
        })






    </script>

    <?php


    include ('../include/scripts.php');
    include ('../include/footer.php');





    ?>


