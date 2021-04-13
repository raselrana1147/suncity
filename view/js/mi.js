/**
 * Created by monir on 4/5/2020.
 */


(function( $ ) {

    "use strict";


    var base_url = $('#base_url').val();
    var cdn_url = $('#cdn_url').val();

    function mi_notify(type, message) {
        if (type == 'success'){
            $.toast({
                heading: 'Success!',
                text: message,
                icon: type,
                position: 'top-left',
            })
        }else{
            $.toast({
                heading: 'Error!',
                text: message,
                icon: type,
                position: 'top-left',
            })
        }
    }


    function get_current_fabric(id) {
        $.ajax({
            type:'get',
            url:'api/',
            data: {
                get_default_shirt_data: 1,
                id: id
            },
            beforeSend:function () {
                $("#loader").fadeIn();
            },
            success:function(data){
                var res = JSON.parse(data);
                $('#fabric_picture_large').attr('src', base_url+res.data.pro_img);
                $('.mi_canvas_container .fabric_title').html(res.data.title);
                $('.mi_canvas_container .fabric_tagline').html(res.data.tag_ling);
                $('.mi_canvas_container .mi_fabric_details').html(res.data.description);
                $("#loader").fadeOut('slow');
            },
            error:function () {
                mi_notify('error', "Sorry! error to purse data!");
                $("#loader").fadeOut('slow');
            }
        });
    }
    get_current_fabric(parseInt($('#default_fabric_id').val()));

    function get_fabrics(id){
        $.ajax({
            type:'post',
            url:'api/',
            data: {
                get_fabrics_data: 1,
                category: id
            },
            success:function(data){
                var res = JSON.parse(data);
                $('#mi_fabric_list_container').html(res.data);
            },
            error:function () {
                mi_notify('error', "Sorry! error to purse data!");
            }
        });
    }

    if ($('#mi_fabric_list_container').attr('mi-val').length > 0){
        get_fabrics(parseInt($('#mi_fabric_list_container').attr('mi-val')));
    }else{
        get_fabrics();
    }

    $('body').on('click', '#mi_fabric_list_container .mi-shirt-choose-element', function (e) {
        e.preventDefault();
        var id = $(this).attr('mi-id');
        get_current_fabric(id);
    });


})( jQuery );