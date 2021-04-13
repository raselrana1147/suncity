/**
 * Created by monir on 6/11/2020.
 */

(function( $ ) {

    "use strict";
    var base_url = $('#base_url').val();

    // -------------notify toaster-------------
    function mi_notify(message) {
        app.toast(message, {
            duration: 4000
        });
    }


    function change_status(id, type, status) {
        $.ajax({
            type:'post',
            url:'actions.php',
            data: {
                mi_update_status_request: 1,
                type: type,
                id: id,
                status: status
            },
            success:function(data){
                console.log(data);
                var res = JSON.parse(data);
                if (res.status == 'success'){
                    mi_notify(res.msg);
                }else{
                    mi_notify(res.msg);
                }
            },
            error: function () {
                console.log('Ajax not working');
            }
        });
    }


    $('.mi-status-update').on('change', function (e) {
        e.preventDefault();
        var type = $(this).attr('mitype');
        var id = $(this).attr('mid');
        var status = $(this).find('option:selected').val();
        change_status(id, type, status);
    });

    // --------------------page delete-------------------
    $('.deletePage').on('click', function(){
        var id = $(this).attr('val');
        // console.log(id);
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                type:'post',
                url:'actions.php',
                data: {
                    page_delete_request: 1,
                    id: id
                },
                success:function(data){
                    console.log(data);
                    swal(
                        'Deleted!',
                        'Page has been deleted.',
                        'success'
                    );
                    setTimeout(function () { location.reload(true); }, 1000);
                },
                error: function () {
                    console.log('Ajax not working');
                }
            });
        }, function(dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                );
            }
        })
    });

    // --------------------faq delete-------------------
    $('.deleteFaq').on('click', function(){
        var id = $(this).attr('val');
        // console.log(id);
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                type:'post',
                url:'actions.php',
                data: {
                    faq_delete_request: 1,
                    id: id
                },
                success:function(data){
                    console.log(data);
                    swal(
                        'Deleted!',
                        'FAQ has been deleted.',
                        'success'
                    );
                    setTimeout(function () { location.reload(true); }, 1000);
                },
                error: function () {
                    console.log('Ajax not working');
                }
            });
        }, function(dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                );
            }
        })
    });

    // --------------------testimonial delete-------------------
    $('.deleteTestimonial').on('click', function(){
        var id = $(this).attr('val');
        // console.log(id);
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                type:'post',
                url:'actions.php',
                data: {
                    testimonial_delete_request: 1,
                    id: id
                },
                success:function(data){
                    console.log(data);
                    swal(
                        'Deleted!',
                        'Testimonial has been deleted.',
                        'success'
                    );
                    setTimeout(function () { location.reload(true); }, 1000);
                },
                error: function () {
                    console.log('Ajax not working');
                }
            });
        }, function(dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                );
            }
        })
    });

    // --------------------category delete-------------------
    $('.deleteCategory').on('click', function(){
        var id = $(this).attr('val');
        // console.log(id);
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                type:'post',
                url:'actions.php',
                data: {
                    category_delete_request: 1,
                    id: id
                },
                success:function(data){
                    console.log(data);
                    swal(
                        'Deleted!',
                        'Testimonial has been deleted.',
                        'success'
                    );
                    setTimeout(function () { location.reload(true); }, 1000);
                },
                error: function () {
                    console.log('Ajax not working');
                }
            });
        }, function(dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                );
            }
        })
    });

       // --------------------collars delete-------------------
    $('.deleteCollar').on('click', function(){
        var id = $(this).attr('val');
        // console.log(id);
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                type:'post',
                url:'actions.php',
                data: {
                    collar_delete_request: 1,
                    id: id
                },
                success:function(data){
                    console.log(data);
                    swal(
                        'Deleted!',
                        'Testimonial has been deleted.',
                        'success'
                    );
                    setTimeout(function () { location.reload(true); }, 1000);
                },
                error: function () {
                    console.log('Ajax not working');
                }
            });
        }, function(dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                );
            }
        })
    });

    // --------------------role delete-------------------
    $('.deleteRole').on('click', function(){
        var id = $(this).attr('val');
        // console.log(id);
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                type:'post',
                url:'actions.php',
                data: {
                    role_delete_request: 1,
                    id: id
                },
                success:function(data){
                    console.log(data);
                    swal(
                        'Deleted!',
                        'Role has been deleted.',
                        'success'
                    );
                    setTimeout(function () { location.reload(true); }, 1000);
                },
                error: function () {
                    console.log('Ajax not working');
                }
            });
        }, function(dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                );
            }
        })
    });

    // --------------------thread delete-------------------
    $('.deleteThread').on('click', function(){
        var id = $(this).attr('val');
        // console.log(id);
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                type:'post',
                url:'actions.php',
                data: {
                    thread_delete_request: 1,
                    id: id
                },
                success:function(data){
                    console.log(data);
                    swal(
                        'Deleted!',
                        'Thread has been deleted.',
                        'success'
                    );
                    setTimeout(function () { location.reload(true); }, 1000);
                },
                error: function () {
                    console.log('Ajax not working');
                }
            });
        }, function(dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                );
            }
        })
    });

    // --------------------button delete-------------------
    $('.deleteButton').on('click', function(){
        var id = $(this).attr('val');
        // console.log(id);
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                type:'post',
                url:'actions.php',
                data: {
                    button_delete_request: 1,
                    id: id
                },
                success:function(data){
                    console.log(data);
                    swal(
                        'Deleted!',
                        'Button has been deleted.',
                        'success'
                    );
                    setTimeout(function () { location.reload(true); }, 1000);
                },
                error: function () {
                    console.log('Ajax not working');
                }
            });
        }, function(dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                );
            }
        })
    });

    // --------------------fabric delete-------------------
    $('.deleteFabric').on('click', function(){
        var id = $(this).attr('val');
        // console.log(id);
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                type:'post',
                url:'actions.php',
                data: {
                    fabric_delete_request: 1,
                    id: id
                },
                success:function(data){
                    console.log(data);
                    swal(
                        'Deleted!',
                        'Fabric has been deleted.',
                        'success'
                    );
                    setTimeout(function () { location.reload(true); }, 1000);
                },
                error: function () {
                    console.log('Ajax not working');
                }
            });
        }, function(dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                );
            }
        })
    });


    // --------------------fabric delete-------------------
    $('.deleteFabricContrast').on('click', function(){
        var id = $(this).val();
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                type:'post',
                url:'actions.php',
                data: {
                    fabric_contrast_delete_request: 1,
                    id: id
                },
                success:function(data){
                    swal(
                        'Deleted!',
                        'Contrast has been deleted.',
                        'success'
                    );
                    setTimeout(function () { location.reload(true); }, 1000);
                },
                error: function () {
                    console.log('Ajax not working');
                }
            });
        }, function(dismiss) {
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your contrast item is safe :)',
                    'error'
                );
            }
        })
    });

    // --------------------order delete-------------------
    $('.deleteOrder').on('click', function(){
        var id = $(this).attr('val');
        // console.log(id);
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                type:'post',
                url:'actions.php',
                data: {
                    order_delete_request: 1,
                    id: id
                },
                success:function(data){
                    console.log(data);
                    swal(
                        'Deleted!',
                        'Order has been deleted.',
                        'success'
                    );
                    setTimeout(function () {
                        window.location.href = base_url+"admin/orders.php";
                    }, 1000);
                },
                error: function () {
                    console.log('Ajax not working');
                }
            });
        }, function(dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                );
            }
        })
    });

    // --------------------order delete-------------------
    $('.deleteContact').on('click', function(){
        var id = $(this).attr('val');
        // console.log(id);
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                type:'post',
                url:'actions.php',
                data: {
                    contact_delete_request: 1,
                    id: id
                },
                success:function(data){
                    console.log(data);
                    swal(
                        'Deleted!',
                        'Contact has been deleted.',
                        'success'
                    );
                    setTimeout(function () { location.reload(true); }, 1000);
                },
                error: function () {
                    console.log('Ajax not working');
                }
            });
        }, function(dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                );
            }
        })
    });



    // --------------------order delete-------------------
    $('.removeBackup').on('click', function(){
        var id = $(this).val();
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this action!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                type:'post',
                url:'actions.php',
                data: {
                    backup_delete_request: 1,
                    file: id
                },
                success:function(data){
                    console.log(data);
                    var res = JSON.parse(data);
                    swal(
                        'Delete!',
                        res.msg,
                        res.status
                    );
                    setTimeout(function () { location.reload(true); }, 1000);
                },
                error: function () {
                    console.log('Ajax not working');
                }
            });
        });
    });

    // ---------------------------change order status----------------------
    $('.orderStatus').on('change', function () {
        var id = $(this).attr('order_id');
        var status = $(this).find('option:selected').val();
        // console.log(id);
        // console.log(status);
        $.ajax({
            type:'post',
            url:'actions.php',
            data: {
                change_status_request: 1,
                id: id,
                status: status
            },
            success:function(data){
                // console.log(data);
                // setTimeout(function () { location.reload(true); }, 1000);
                var res = JSON.parse(data);
                if (res.status == 'success'){
                    mi_notify(res.msg);
                    if (status == 5){
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    }
                }else{
                    mi_notify(res.msg);
                }
            },
            error: function () {
                console.log('Ajax not working');
            }
        });


    });

    // ----------------------cancellation accept------------------
    $('.cancellationAccept').on('click', function () {
        var id = $(this).attr('order');

        $.ajax({
            type:'post',
            url:'actions.php',
            data: {
                cancellation_accept_request: 1,
                id: id
            },
            success:function(data){
                // console.log(data);
                // setTimeout(function () { location.reload(true); }, 1000);
                var res = JSON.parse(data);
                if (res.status == 'success'){
                    mi_notify(res.msg);
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }else{
                    mi_notify(res.msg);
                }
            },
            error: function () {
                console.log('Ajax not working');
            }
        });
    });

    // ----------------------cancellation cancel------------------
    $('.cancellationCancel').on('click', function () {
        var id = $(this).attr('order');

        $.ajax({
            type:'post',
            url:'actions.php',
            data: {
                cancellation_cancel_request: 1,
                id: id
            },
            success:function(data){
                // console.log(data);
                // setTimeout(function () { location.reload(true); }, 1000);
                var res = JSON.parse(data);
                if (res.status == 'success'){
                    mi_notify(res.msg);
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }else{
                    mi_notify(res.msg);
                }
            },
            error: function () {
                console.log('Ajax not working');
            }
        });
    });

    // ---------------------------change fabric type----------------------
    $('.fabType').on('change', function () {
        var id = $(this).attr('fab_id');
        var type = $(this).find('option:selected').val();
        // console.log(id);
        // console.log(type);
        $.ajax({
            type:'post',
            url:'actions.php',
            data: {
                change_fab_type_request: 1,
                id: id,
                type: type
            },
            success:function(data){
                // console.log(data);
                // setTimeout(function () { location.reload(true); }, 1000);
                var res = JSON.parse(data);
                if (res.status == 'success'){
                    mi_notify(res.msg);
                    // setTimeout(function () {
                    //     window.location.reload();
                    // }, 4000);
                }else{
                    mi_notify(res.msg);
                }
            },
            error: function () {
                console.log('Ajax not working');
            }
        });

    });

    // ---------------------------change fabric weight----------------------
    $('.fabWeight').on('change', function () {
        var id = $(this).attr('fab_id');
        var weight = $(this).find('option:selected').val();
        // console.log(id);
        // console.log(type);
        $.ajax({
            type:'post',
            url:'actions.php',
            data: {
                change_fab_weight_request: 1,
                id: id,
                weight: weight
            },
            success:function(data){
                // console.log(data);
                // setTimeout(function () { location.reload(true); }, 1000);
                var res = JSON.parse(data);
                if (res.status == 'success'){
                    mi_notify(res.msg);
                    // setTimeout(function () {
                    //     window.location.reload();
                    // }, 4000);
                }else{
                    mi_notify(res.msg);
                }
            },
            error: function () {
                console.log('Ajax not working');
            }
        });

    });

    // ---------------------------change fabric pattern----------------------
    $('.fabPattern').on('change', function () {
        var id = $(this).attr('fab_id');
        var pattern = $(this).find('option:selected').val();
        // console.log(id);
        // console.log(type);
        $.ajax({
            type:'post',
            url:'actions.php',
            data: {
                change_fab_pattern_request: 1,
                id: id,
                pattern: pattern
            },
            success:function(data){
                // console.log(data);
                // setTimeout(function () { location.reload(true); }, 1000);
                var res = JSON.parse(data);
                if (res.status == 'success'){
                    mi_notify(res.msg);
                    // setTimeout(function () {
                    //     window.location.reload();
                    // }, 4000);
                }else{
                    mi_notify(res.msg);
                }
            },
            error: function () {
                console.log('Ajax not working');
            }
        });

    });

    // ---------------------------change button type----------------------
    $('.buttonType').on('change', function () {
        var id = $(this).attr('button_id');
        var type = $(this).find('option:selected').val();
        // console.log(id);
        // console.log(type);
        $.ajax({
            type:'post',
            url:'actions.php',
            data: {
                change_button_type_request: 1,
                id: id,
                type: type
            },
            success:function(data){
                // console.log(data);
                // setTimeout(function () { location.reload(true); }, 1000);
                var res = JSON.parse(data);
                if (res.status == 'success'){
                    mi_notify(res.msg);
                    // setTimeout(function () {
                    //     window.location.reload();
                    // }, 4000);
                }else{
                    mi_notify(res.msg);
                }
            },
            error: function () {
                console.log('Ajax not working');
            }
        });

    });






    // $('#fabric-datatable').DataTable({
    //     "processing": true,
    //     "serverSide": true,
    //     "ajax": "../actions.php"
    // });

})(jQuery);