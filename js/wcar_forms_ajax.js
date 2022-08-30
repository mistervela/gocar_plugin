var $ = jQuery.noConflict();
$( document ).ready(function() {


    $( function() {
        if ($('#tabs')) {
            $( "#tabs" ).tabs();
        }
    } );






    $("#dd_brand_list").on("change", function(e) {


        $("#dd_model_list option").prop("selected", false);
        $("#dd_model_list option").children('option').show();

        var brand_id = $(this). children("option:selected").attr("bid");


        $("#dd_model_list").children('option[value!="0"]').hide();
        $("#dd_style_list").children('option[value!="0"]').hide();

        $("#dd_model_list option[bid='" + brand_id + "']").show();




    });


    $("#dd_model_list").on("change", function(e) {


        $("#dd_style_list option").prop("selected", false);
        $("#dd_style_list option").children('option').show();

        var brand_id = $(this). children("option:selected").attr("bid");
        var model_id = $(this). children("option:selected").val();

        if (model_id !== 0) {

            $("#dd_style_list").children('option[value!="0"]').hide();
            $("#dd_style_list option[bid='" + brand_id + "']").show();

        }


    });


    $("#dd_style_list").on("change", function(e) {


        $("#dd_lang_list option").prop("selected", false);
        $("#dd_lang_list option").children('option').show();

        var brand_id = $(this). children("option:selected").attr("bid");
        var style_id = $(this). children("option:selected").val();

        if (style_id !== 0) {

            $("#dd_lang_list").children('option[value!="0"]').hide();
            $("#dd_lang_list option[parent='" + brand_id + "']").show();

        }


    });




    $('#dropdown_up_button').on("click", function(e) {

        e.preventDefault();
        var opt = $('#dropdown_middle_list option:selected');

        if(opt.is(':first-child')) {
            opt.insertAfter($('#dropdown_middle_list option:last-child'));
        }
        else {
            opt.insertBefore(opt.prev());
        }

        return false;
    });

    $('#dropdown_dn_button').on("click", function(e) {

        e.preventDefault();

        var opt = $('#dropdown_middle_list option:selected');

        if(opt.is(':last-child')) {
            opt.insertBefore($('#dropdown_middle_list option:first-child'));
        }
        else {
            opt.insertAfter(opt.next());
        }

        return false;
    });




    $('#carforms_list').on("change", function(e) {

        e.preventDefault();


        var $tempElement = $("<input>");

        $("body").append($tempElement);
        var text = '[form id="'+ $(this). children("option:selected").val() + '"]';
        $tempElement.val(text).select();

        document.execCommand("Copy");
        $tempElement.remove();


        return false;
    });



    $('#custom_dropdown_up_button').on("click", function(e) {

        e.preventDefault();
        var opt = $('#custom_dropdown_middle_list option:selected');

        if(opt.is(':first-child')) {
            opt.insertAfter($('#custom_dropdown_middle_list option:last-child'));
        }
        else {
            opt.insertBefore(opt.prev());
        }

        return false;
    });

    $('#custom_dropdown_dn_button').on("click", function(e) {

        e.preventDefault();

        var opt = $('#custom_dropdown_middle_list option:selected');

        if(opt.is(':last-child')) {
            opt.insertBefore($('#custom_dropdown_middle_list option:first-child'));
        }
        else {
            opt.insertAfter(opt.next());
        }

        return false;
    });


    $("#dropdown_middle_list").on("change", function() {


        var tag_value = $(this). children("option:selected").attr('tag_value');
        var city = $(this). children("option:selected").attr('city');
        var zip = $(this). children("option:selected").attr('zip');
        var name = $(this). children("option:selected").text();

        $('#dealer_details').html(zip + " " + city + " (" + tag_value + ")" );





        return false;
    });

    $("#custom_dropdown_middle_list").on("change", function() {


        var tag_value = $(this). children("option:selected").attr('tag_value');
        var name = $(this). children("option:selected").text();

        $('#custom_drop_down_input_index').val(tag_value);


        $("#custom_drop_down_input_title").val(name);


        return false;
    });

    $("#dropdown_list").on("change", function() {

        var output = '';

        var group_id = $(this). children("option:selected"). val();
        var group_name = $(this). children("option:selected"). text();

        $.ajax({

            type: 'POST',
            url: myAjax.ajax_url,
            data: { action: 'dropdownitems', id: group_id, type: 0 },
            success: function(response) {

                $("#dropdown_middle_list").empty();
                $("#dropdown_middle_list").append(response);
                $("#group_name").val(group_name);
                $("#shortcode_wrapper").html('[dropdown id="'+ group_id +'"]');




            }

        });

        return false;
    });

    $("#custom_dropdown_list").on("change", function() {

        var group_id = $(this). children("option:selected"). val();
        var group_name = $(this). children("option:selected"). text();

        $.ajax({

            type: 'POST',
            //data: JSON,
            url: myAjax.ajax_url,
            data: { action: 'dropdownitems', id: group_id, type: 1 },
            success: function(response) {

                $("#custom_dropdown_middle_list").empty();
                $("#custom_dropdown_middle_list").append(response);
                $("#group_name").val(group_name);
                $("#shortcode_wrapper").html('[dropdown id="'+ group_id + '"]');

                $("#custom_drop_down_input_index").val('');
                $("#custom_drop_down_input_title").val('');




            }

        });

        return false;
    });



    $("#btn_clear").on("click", function(e) {
        e.preventDefault();


        $('#custom_drop_down_input_index').val('');

        $("#custom_drop_down_input_title").val('');

        return false;

    });

    $("#btn_copy").on("click", function(e) {
        e.preventDefault();

        var $tempElement = $("<input>");

        $("body").append($tempElement);
        var text = $('#shortcode_wrapper').html();
        $tempElement.val(text).select();

        document.execCommand("Copy");
        $tempElement.remove();

        $("#copied").html("&#10003;");
        $('#copied').fadeIn().delay(4000).fadeOut();


        return false;

    });


    $("#new_template").on("click", function(e) {
        e.preventDefault();

        var new_template = $("#new_template_input").val();

        var tn = encodeURIComponent(new_template);

        if(new_template !== '') {


            $.ajax({

                type: 'POST',
               url: myAjax.ajax_url,
                data: {action: 'template_new', tn: tn},
                success: function (response) {

                    var template_id = response;

                    $('#new_template_input').val('');
                    $('#tabs-1').html('');
                    $('#template_sourcecode').val('');

                    $('#template_name').val(new_template);


                    $.ajax({

                        type: 'POST',
                        url: myAjax.ajax_url,
                        data: { action: 'templates_list'},
                        success: function(response) {

                            $('#template_sourcecode').val('');

                            $('#templates_list').empty();
                            $('#templates_list').append(response);

                            $('#templates_list option[value="'+ template_id.trim() +'"]').prop("selected", true);

                            var selected_index = $('#templates_list').children("option:selected").val();
                            $('#templates_list').val(selected_index).change();

                            $('#state_notification').html('Template Created');
                            $('#state_notification').fadeIn('slow').delay(4000).hide(0);



                        }

                    });





                }

            });

        }


        return false;

    });



    $("#template_save").on("click", function(e) {
        e.preventDefault();

        var template_id = $("#templates_list"). children("option:selected"). val();
        var selected_index = $("#templates_list").prop('selectedIndex');
        var source_code = encodeURIComponent($("#template_sourcecode").val());
        var template_name = encodeURIComponent($("#template_name").val());

        $.ajax({

            type: 'POST',
            url: myAjax.ajax_url,
            data: { action: 'template_save', id: template_id, sc: source_code, tn: template_name },
            success: function(response) {


                $('#form_save_notification').html(response);
                $('#form_save_notification').fadeIn().delay(4000).fadeOut();

                $.ajax({

                    type: 'POST',
                    url: myAjax.ajax_url,
                    data: { action: 'templates_list'},
                    success: function(response) {

                        $('#templates_list').empty();
                        $('#templates_list').append(response);
                        $('#templates_list').prop("selectedIndex", selected_index).val();
                        var template_id = $("#templates_list"). children("option:selected"). val();


                        $.ajax({

                            type: 'POST',
                            data: JSON,
                            url: myAjax.ajax_url,
                            data: { action: 'templateshortcodes', id: template_id },
                            success: function(response) {

                                var jsonObj = JSON.parse(response);

                                $('#tabs-1').html(jsonObj.render);


                                $('#template_name').val(jsonObj.template_name);

                                $('#template_sourcecode').val('');
                                $('#template_sourcecode').val(jsonObj.sourcecode);



                            }

                        });


                    }

                });

            }

        });

        return false;



    });

    $("#dropdown_save").on("click", function(e) {

        e.preventDefault();

        dropdown_save ('#dropdown_list', '#dropdown_middle_list', 0 );

        return false;

    });

    $("#custom_dropdown_save").on("click", function(e) {

        e.preventDefault();


        dropdown_save ('#custom_dropdown_list', '#custom_dropdown_middle_list', 1 );

        return false;

    });


    function dropdown_save (groups_listbox, items_listbox, type) {




        var dropdown_id = $(groups_listbox). children("option:selected"). val();
        var selected_option = $(items_listbox).children("option:selected").val();
        var selected_index = $(items_listbox).prop('selectedIndex');


        var options = [];


        var items = $(items_listbox + " > option").map(function() {
            var arr = [];
            var tag_value = $(this).attr('tag_value');
            var city = $(this).attr('city');
            var zip = $(this).attr('zip');

            arr.push({"position":$(this).index(),"tag_value":tag_value, "id":$(this).val(), "title": $(this).text(), "city": city, "zip": zip });


            return arr;
        }).get();



        $.ajax({

            type: 'POST',
            data: JSON,
            url: myAjax.ajax_url,
            data: { action: 'dropdown_save', dropdown_id:dropdown_id, options:items, type:type},
            success: function(response) {

                $('#state_notification').html(response);
                $('#state_notification').fadeIn('slow').delay(4000).hide(0);

            }

        });


    }


    $("#form_save").on("click", function(e) {
        e.preventDefault();

        //alert($(this).val());

        var selected_index = $("#forms_list").prop('selectedIndex');
        var form_id = $("#forms_list").children("option:selected").val();
        var name = encodeURIComponent($("#formName_field").val());
        var brand = encodeURIComponent($("#brand").val());
        var model = encodeURIComponent($("#model").val());
        var style = encodeURIComponent($("#style").val());
        var lang = encodeURIComponent($("#lang").val());
        var fleet = $("#fleet_select").val();
        var template_id = $("#template_list"). children("option:selected"). val();

        $.ajax({

            type: 'POST',
            data: JSON,
            url: myAjax.ajax_url,
            data: { action: 'form_save', form_id: form_id, name: name, brand: brand, model: model, style:style, lang:lang, fleet:fleet, t_id:template_id },
            success: function(response) {

                $('#state_notification').html(response);
                $('#state_notification').fadeIn('slow').delay(4000).hide(0);


                $.ajax({

                    type: 'POST',
                    url: myAjax.ajax_url,
                    data: { action: 'forms_list'},
                    success: function(response) {

                        $('#forms_list').empty();
                        $('#forms_list').append(response);
                        $('#forms_list').prop("selectedIndex", selected_index).val();

                    }

                });

            }

        });

        return false;



    });



    $("#form_preview").on("click", function(e) {
        e.preventDefault();

        var tid = $("#template_list"). children("option:selected"). val();
        var home_url = 	$(this).attr("url");
        var preview_page = $(this).attr("preview_page");


        var fid = $("#forms_list"). children("option:selected"). val();


        var left  = ($(window).width()/2)-(900/2),
            top   = ($(window).height()/2)-(600/2),

            popup = window.open ( home_url + "?p=" + preview_page + "&tid="+tid + "&fid=" + fid, "popup", "width=900, height=800, top="+top+", left="+left);


        return false;

    });

    $("#form_delete").on("click", function(e) {
        e.preventDefault();

        var selected_index = $("#forms_list").prop('selectedIndex');

        var form_id = $('#forms_list'). children("option:selected"). val();

        $.ajax({

            type: 'POST',
            //data: JSON,
            url: myAjax.ajax_url,
            data: { action: 'form_delete', form_id: form_id },
            success: function(response) {

                $("#forms_list  option:selected").remove();
                $("#formName_field").val('');
                $("#brand").val('');
                $("#model").val('');
                $("#style").val('');
                $("#lang").val('');
                $("#template_list").val([]);


                $("#forms_list").prop('selectedIndex',selected_index-1);

                $("#forms_list option:selected").focus();
                $("#forms_list option:selected").click();

                $('#form_notification').html(response);
                $('#form_notification').fadeIn('slow').delay(4000).hide(0);

            }

        });



        return false;

    });



    $("#dropdown_remove").on("click", function(e) {
        e.preventDefault();

        var selected_index = $("#dropdown_middle_list").prop('selectedIndex');

        $("#dropdown_middle_list  option:selected").remove();

        $("#dropdown_middle_list").prop('selectedIndex',selected_index);

        $('#dropdown_middle_list option:selected').focus();


    });

    $("#custom_dropdown_remove").on("click", function(e) {
        e.preventDefault();

        var selected_index = $("#custom_dropdown_middle_list").prop('selectedIndex');

        $("#custom_dropdown_middle_list  option:selected").remove();

        $("#custom_dropdown_middle_list").prop('selectedIndex',selected_index);

        $('#custom_dropdown_middle_list option:selected').focus();
    });

    $("#dropdown_left_button").on("click", function(e) {
        e.preventDefault();

        return !$('#dropdown_items option:selected').appendTo('#dropdown_middle_list');
    });

    $("#dropdown_right_button").on("click", function(e) {
        e.preventDefault();
        return !$('#dropdown_middle_list option:selected').appendTo('#dropdown_items');
    });






    $("#new_form").on("click", function(e) {
        e.preventDefault();




        var form_name = $('#new_form_input').val();

        if (form_name!=='') {

            $.ajax({

                type: 'POST',
                //data: JSON,
                url: myAjax.ajax_url,
                data: {action: 'new_form', form_name: form_name},
                success: function (response) {



                    $('#shortcode_wrapper').html('');
                    $("#formName_field").val('');
                    $("#brand").val('');
                    $("#model").val('');
                    $("#style").val('');
                    $("#lang").val('');
                    $("#template_list").val([]);

                    var form_id = response;


                    $.ajax({

                        type: 'POST',
                        url: myAjax.ajax_url,
                        data: {action: 'forms_list'},
                        success: function (response) {

                            $("#forms_list").html(response);



                            $('#forms_list option[value="'+ form_id.trim() +'"]').prop("selected", true);

                            $("#forms_list option:selected").focus();
                            $("#forms_list option:selected").click();
                            //$('#forms_list').val(selected_index).change();
                            var selected_index = $("#forms_list").children("option:selected").val();
                            $('#forms_list').val(selected_index).change();

                            $('#form_notification').html('Form Created');
                            $('#form_notification').fadeIn('slow').delay(4000).hide(0);


                        }

                    });


                }

            });

        }


        return false;

    });

    $("#new_drop_down").on("click", function(e) {
        e.preventDefault();

        var new_group = $("#new_drop_down_input").val();

        $('#dropdown_list').append('<option>' + new_group + '</option>');

        return false;

    });

    $("#dropdown_delete").on("click", function(e) {

        e.preventDefault();

        dropdown_delete("#dropdown_list", "#dropdown_middle_list", 0);

        return false;

    });

    $("#custom_dropdown_delete").on("click", function(e) {

        e.preventDefault();

        dropdown_delete("#custom_dropdown_list", "#custom_dropdown_middle_list", 1);

        return false;

    });

    $("#dropdown_sort").on("click", function(e) {

        e.preventDefault();

        $("#dropdown_middle_list").append($("#dropdown_middle_list option").remove().sort(function(a, b) {
            var at = $(a).text(), bt = $(b).text();
            return (at > bt)?1:((at < bt)?-1:0);
        }));


        return false;

    });

    function dropdown_delete(dropdown_list, items_list, type) {

        var selected_index = $(dropdown_list).prop('selectedIndex');
        var group_id = $(dropdown_list). children("option:selected"). val();

        //$("#custom_dropdown_list"). children("option:selected"). val(new_name);

        $.ajax({

            type: 'POST',
            //data: JSON,
            url: myAjax.ajax_url,
            data: { action: 'dropdown_delete', id: group_id },
            success: function(response) {


                $('#state_notification').html(response);
                $('#state_notification').fadeIn('slow').delay(4000).hide(0);


                $.ajax({

                    type: 'POST',
                    data: JSON,
                    url: myAjax.ajax_url,
                    data: { action: 'dropdowns_groups', type: type },
                    success: function(response) {

                        $(dropdown_list).empty();
                        $(dropdown_list).append(response);

                        $(dropdown_list).prop('selectedIndex',selected_index-1);



                        var group_id = $(dropdown_list).children("option:selected"). val();


                        $.ajax({

                            type: 'POST',
                            //data: JSON,
                            url: myAjax.ajax_url,
                            data: { action: 'dropdownitems', id: group_id, type: type },
                            success: function(response) {

                                $(items_list).empty();
                                $(items_list).append(response);

                                $("#group_name").val(group_name);
                                $("#shortcode_wrapper").html('[dropdown id="'+ group_id + '"]');

                                $(dropdown_list).prop('selectedIndex',selected_index-1);
                                var group_id = $(dropdown_list).children("option:selected"). val();

                                $(dropdown_list + ' option:selected').focus();
                                $(dropdown_list + ' option:selected').click();



                            }

                        });


                    }

                });


            }

        });


    }

    $("#template_delete").on("click", function(e) {

        e.preventDefault();

        var selected_index = $("#templates_list").prop('selectedIndex');
        var template_id = $("#templates_list").children("option:selected"). val();





        $.ajax({

            type: 'POST',
            //data: JSON,
            url: myAjax.ajax_url,
            data: { action: 'template_delete', tid: template_id },
            success: function(response) {

                //alert(response);

                $("#templates_list  option:selected").remove();
                $("#templates_list").prop('selectedIndex',selected_index-1);
                var template_id = $("#templates_list").children("option:selected"). val();
                $('#templates_list option:selected').focus();
                $('#templates_list option:selected').click();

                $('#state_notification').html(response);
                $('#state_notification').fadeIn('slow').delay(4000).hide(0);



                var template_id = $(this). children("option:selected"). val();

                $.ajax({

                    type: 'POST',
                    data: JSON,
                    url: myAjax.ajax_url,
                    data: { action: 'templateshortcodes', id: template_id },
                    success: function(response) {

                        var jsonObj = JSON.parse(response);

                        $('#tabs-1').html(jsonObj.render);

                        $('#template_name').val(jsonObj.template_name);

                        $('#template_sourcecode').val(jsonObj.sourcecode);



                    }

                });


            }

        });

        return false;

    });



    $("#rename_drop_down").on("click", function(e) {

        e.preventDefault();

        dropdown_rename ("#dropdown_list", "#dropdown_middle_list", 0);

        return false;

    });


    $("#rename_custom_drop_down").on("click", function(e) {

        e.preventDefault();

        dropdown_rename ("#custom_dropdown_list", "#custom_dropdown_middle_list", 1);

        return false;

    });



    $("#save_settings").on("click", function(e) {


        e.preventDefault();


        var preview_page = $("#preview_page").val();
        var ajax_url = $("#ajax_url").val();


        $.ajax({

            type: 'POST',
            url: myAjax.ajax_url,
            data: { action: 'save_settings', pid: preview_page, ajax_url:ajax_url  },
            success: function(response) {


                $('#state_notification').html(response);
                $('#state_notification').fadeIn('slow').delay(4000).hide(0);

            }


        });


        return false;

    });








    function dropdown_rename (dropdown_list, items_list, type) {


        var selected_index = $(dropdown_list).prop('selectedIndex');
        var group_id = $(dropdown_list). children("option:selected"). val();
        var new_name = 	encodeURIComponent($("#group_name").val());
        //$("#custom_dropdown_list"). children("option:selected"). val(new_name);

        $.ajax({

            type: 'POST',
            //data: JSON,
            url: myAjax.ajax_url,
            data: { action: 'dropdown_rename', id: group_id, new_name:new_name },
            success: function(response) {



                $('#state_notification').html(response);
                $('#state_notification').fadeIn('slow').delay(4000).hide(0);


                $.ajax({

                    type: 'POST',
                    data: JSON,
                    url: myAjax.ajax_url,
                    data: { action: 'dropdowns_groups', id: group_id, type: type },
                    success: function(response) {

                        //alert(response);
                        $(dropdown_list).empty();
                        $(dropdown_list).append(response);
                        $(dropdown_list).prop("selectedIndex", selected_index).val();



                    }

                });


            }

        });



    }





    $("#open_csv").on("click", function(e) {
        e.preventDefault();
        $('#file').trigger('click');


        $('#file').change(function(e){
            var fileName = e.target.files[0].name;
            $('#csv_filename').html(fileName);

        });




        return false;

    });

    $('body').on('change', '#file', function() {

        $('#csv_notification').html('Processing Files...');

        var file_data = $(this).prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('action', 'import_csv');

        $.ajax({

            type: 'POST',
            //data: JSON,
            url: myAjax.ajax_url,
            //contentType: false,
            contentType: false,
            processData: false,
            data: form_data,

           success: function(response) {




                $.ajax({

                    type: 'POST',
                    //data: JSON,
                    url: myAjax.ajax_url,
                    data: { action: 'cardealers_list' },
                    success: function(response) {

                       $("#dropdown_items").empty();
                        $("#dropdown_items").append(response);
                        $("#csv_filename").html('');
                        $("#file").val(null);

                    }

                });




                $('#csv_notification').html(response);
                $('#csv_notification').fadeIn('slow').delay(4000).hide(0);


            }

        });

        return false;

    });

    $("#custom_dropdown_copy").on("click", function(e) {
        e.preventDefault();


        var selected_index = $("#custom_dropdown_list").prop('selectedIndex');
        var group_id = $("#custom_dropdown_list"). children("option:selected"). val();
        var new_name = 	encodeURIComponent($("#custom_dropdown_list"). children("option:selected"). text());

        $.ajax({

            type: 'POST',
            //data: JSON,
            url: myAjax.ajax_url,
            data: { action: 'dropdown_copy', id: group_id, type:1, new_name:new_name },
            success: function(response) {


                $('#state_notification').html(response);
                $('#state_notification').fadeIn('slow').delay(4000).hide(0);


                $.ajax({

                    type: 'POST',
                    data: JSON,
                    url: myAjax.ajax_url,
                    data: { action: 'dropdowns_groups', id: group_id, type: 1 },
                    success: function(response) {

                        //alert(response);
                        $("#custom_dropdown_list").empty();
                        $("#custom_dropdown_list").append(response);
                        var myVal = $('#custom_dropdown_list option:last').val();
                        $('#custom_dropdown_list').val(myVal);
                        $("#custom_dropdown_middle_list").empty();
                        var new_group_id = $("#custom_dropdown_list"). children("option:selected"). val();
                        $("#shortcode_wrapper").html('[dropdown id="'+ new_group_id + '"]');
                        var new_name = $("#custom_dropdown_list"). children("option:selected"). text();
                        $("#group_name").val(new_name);


                        $.ajax({

                            type: 'POST',
                            //data: JSON,
                            url: myAjax.ajax_url,
                            data: { action: 'dropdownitems', id: new_group_id, type: 1 },
                            success: function(response) {

                                $("#custom_dropdown_middle_list").empty();
                                $("#custom_dropdown_middle_list").append(response);
                                $("#group_name").val(new_name);
                                $("#shortcode_wrapper").html('[dropdown id="'+ group_id +'"]');


                            }

                        });


                    }

                });


            }

        });


        return false;

    });

    $("#new_custom_drop_down_entry").on("click", function(e) {
        e.preventDefault();

        var entry_tag_value = $("#custom_drop_down_input_index").val();
        var entry_title = $("#custom_drop_down_input_title").val();


        if(entry_tag_value!=='' && entry_title!=='') {
            $('#custom_dropdown_middle_list').append('<option tag_value="' + entry_tag_value + '" title="' + entry_title + '" city="" zip="" value="">' + entry_title + '</option>');

            $("#custom_drop_down_input_index").val('');
            $("#custom_drop_down_input_title").val('');

        }

        return false;

    });

    $("#new_drop_down").on("click", function(e) {
        e.preventDefault();

        // Pass the clicked button, the left listbox, the right listbox and the type of Drop Down
        create_dropdown ("#new_drop_down_input", "#dropdown_list", "#dropdown_middle_list", 0);

        return false;

    });

    $("#custom_dropdown_create").on("click", function(e) {
        e.preventDefault();

        // Pass the clicked button, the left listbox, the right listbox and the type of Drop Down
        create_dropdown ("#new_custom_dropdown_input", "#custom_dropdown_list", "#custom_dropdown_middle_list", 1);

        return false;

    });

    function create_dropdown (input_box, groups_listbox, details_listbox, type) {


        var entry_title = encodeURIComponent($(input_box).val());



        if (entry_title!=='') {

            $.ajax({


                type: 'POST',
                //data: JSON,
                url: myAjax.ajax_url,
                data: {action: 'dropdown_create', name: entry_title, type: type},
                success: function (response) {

                    $(details_listbox).empty();
                    var group_id = response;


                    $.ajax({

                        type: 'POST',
                        data: JSON,
                        url: myAjax.ajax_url,
                        data: {action: 'dropdowns_groups', id: group_id, type: type},
                        success: function (response) {

                            $(groups_listbox).empty();
                            $(groups_listbox).append(response);

                            $(details_listbox).empty();
                            $("#shortcode_wrapper").html('[dropdown id="' + group_id.trim() + '"]');


                            $(groups_listbox + ' option[value="'+ group_id.trim() +'"]').prop("selected", true);


                            var selected_index = $(groups_listbox).children("option:selected").val();
                            $(groups_listbox).val(selected_index).change();




                            $('#dropdown_state_notification').html('Dropdown Created');
                            $('#dropdown_state_notification').fadeIn('slow').delay(4000).hide(0);


                        }

                    });


                }

            });


        }





    }



    $("#forms_list").on("change", function() {


        var form_id = $(this). children("option:selected"). val();


        $('#formName_field').val('');
        $('#brand').val('');
        $('#shortcode_wrapper').html('');
        $('#model').val('');

        $("#fleet_select").val([]);
        $('#style').val('');
        $('#lang').val('');

        $("#template_list").val([]);


        $.ajax({

            type: 'POST',
            data: JSON,
            url: myAjax.ajax_url,
            data: { action: 'formdetails', id: form_id },
            success: function(response) {

                var jsonObj = JSON.parse(response);


                $('#formName_field').val(jsonObj.form_name);

                $('#brand').val(jsonObj.brand);
                $('#shortcode_wrapper').html('[form id="' + form_id + ']');
                $('#model').val(jsonObj.model);
                $("#fleet_select").prop('selectedIndex',jsonObj.fleet);
                $('#style').val(jsonObj.style);
                $('#lang').val(jsonObj.lang);

                $("#template_list").val(jsonObj.template_id).change();

            }

        });

        return false;
    });




    $("#templates_list").on("change", function() {

        var output = '';

        var template_id = $(this). children("option:selected"). val();

        $.ajax({

            type: 'POST',
            data: JSON,
            url: myAjax.ajax_url,
            data: { action: 'templateshortcodes', id: template_id },
            success: function(response) {

                var jsonObj = JSON.parse(response);

                $('#tabs-1').html(jsonObj.render);


                $('#template_name').val(jsonObj.template_name);

                $('#template_sourcecode').val('');
                $('#template_sourcecode').val(jsonObj.sourcecode);



            }

        });

        return false;
    });


    if ($('#forms_list').length && typeof($('#forms_list').children(':checked').val()) === 'undefined') {



        $.ajax({

            type: 'POST',
            url: myAjax.ajax_url,
            data: { action: 'forms_list' },
            success: function(response) {

                $("#forms_list").html(response);

                $("#forms_list").prop("selectedIndex", 0).val();
                var form_id = $("#forms_list").children("option:selected").val();


                $.ajax({

                    type: 'POST',
                    data: JSON,
                    url: myAjax.ajax_url,
                    data: { action: 'formdetails', id: form_id },
                    success: function(response) {

                        var jsonObj = JSON.parse(response);

                        $('#formName_field').val(jsonObj.form_name);

                        $('#shortcode_wrapper').html('[form id="' + form_id + ']');

                        $('#brand').val(jsonObj.brand);
                        $('#model').val(jsonObj.model);
                        $('#style').val(jsonObj.style);
                        $('#lang').val(jsonObj.lang);


                        $("#fleet_select").prop('selectedIndex',jsonObj.fleet);

                        $("#template_list").val(jsonObj.template_id).change();



                    }

                });



            }

        });

        return false;
    }



    if ($('#templates_list').length && typeof($('#templates_list').children(':checked').val()) === 'undefined') {




        $.ajax({

            type: 'POST',
            url: myAjax.ajax_url,
            data: { action: 'templates_list' },
            success: function(response) {

                $("#templates_list").html(response);

                $("#templates_list").prop("selectedIndex", 0).val();
                var template_id = $("#templates_list").children("option:selected").val();


                $.ajax({

                    type: 'POST',
                    data: JSON,
                    url: myAjax.ajax_url,
                    data: { action: 'templateshortcodes', id: template_id },
                    success: function(response) {

                        var jsonObj = JSON.parse(response);

                       $('#tabs-1').html(jsonObj.render);
                        $('#template_sourcecode').val('');
                        $('#template_sourcecode').val(jsonObj.sourcecode);

                        $('#template_name').val(jsonObj.template_name);



                    }

                });



            }

        });



        return false;
    }

    if ($('#dropdown_items')) {

        $.ajax({

            type: 'POST',
            //data: JSON,
            url: myAjax.ajax_url,
            data: { action: 'cardealers_list' },
            success: function(response) {

                //alert(response);
                $("#dropdown_items").empty();
                $("#dropdown_items").append(response);



            }

        });

    }




    if ($('#dropdown_list').length && typeof($('#dropdown_list').children(':checked').val()) === 'undefined') {




        $.ajax({

            type: 'POST',
            url: myAjax.ajax_url,
            data: { action: 'dropdowns_groups', type : 0 },
            success: function(response) {

                $("#dropdown_list").html(response);

                $("#dropdown_list").prop("selectedIndex", 0).val();
                var group_id = $("#dropdown_list").children("option:selected").val();
                var group_name = $("#dropdown_list"). children("option:selected"). text();


                $.ajax({

                    type: 'POST',
                    //data: JSON,
                    url: myAjax.ajax_url,
                    data: { action: 'dropdownitems', id: group_id, type: 0 },
                    success: function(response) {

                        //alert(response);
                        $("#dropdown_middle_list").empty();
                        $("#dropdown_middle_list").append(response);
                        $("#group_name").val(group_name);
                        $("#shortcode_wrapper").html('[dropdown id="'+ group_id +'"]');



                    }

                });



            }

        });

        return false;
    }



// Custom Dropdown
    if ($('#custom_dropdown_list') && typeof($('#custom_dropdown_list').children(':checked').val()) === 'undefined') {





        $.ajax({

            type: 'POST',
            url: myAjax.ajax_url,
            data: { action: 'dropdowns_groups', type:1 },
            success: function(response) {

                $("#custom_dropdown_list").html(response);

                $("#custom_dropdown_list").prop("selectedIndex", 0).val();

                var group_id = $("#custom_dropdown_list").children("option:selected").val();
                var group_name = $("#custom_dropdown_list"). children("option:selected"). text();



                $.ajax({

                    type: 'POST',
                    //data: JSON,
                    url: myAjax.ajax_url,
                    data: { action: 'dropdownitems', id: group_id, type: 1 },
                    success: function(response) {

                        //alert(response);
                        $("#custom_dropdown_middle_list").empty();
                        $("#custom_dropdown_middle_list").append(response);
                        $("#group_name").val(group_name);
                        $("#shortcode_wrapper").html('[dropdown id="' + group_id + '"]');




                    }

                });

            }


        });



        return false;
    }




});

