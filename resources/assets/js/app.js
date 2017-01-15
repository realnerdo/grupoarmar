$(function(){
    var $body = $('body');
    var base_url = window.location.origin;

    // Select2
    var selectable = $('.select2');
    if(selectable.length){
        selectable.select2({
            width: '100%',
            language: 'es'
        });
    }

    var selectable_equipment = $('.select2-equipment');
    if(selectable_equipment.length){

        function formatEquipmentSelection(equipment){
            return equipment.title || equipment.text
        }

        function formatEquipment(equipment) {
            if (!equipment.id) { return equipment.text; }
            var $equipment = $(
                '<span class="equipment-result">'+
                '<div class="equipment-photo"><img src="'+equipment.picture+'" class="img" /></div>'+
                '<div class="equipment-meta">'+
                '<h4 class="equipment-title">'+equipment.title+'</h4>'+
                '<h5 class="equipment-serial"><b>Núm. Serie:</b> <i>'+equipment.serial+'</i></h5>'+
                '<h5 class="equipment-brand"><b>Marca:</b> <i>'+equipment.brand+'</i></h5>'+
                '<h5 class="equipment-group"><b>Grupo:</b> <i>'+equipment.group+'</i></h5>'+
                '</div>'+
                '<div class="equipment-description">'+equipment.description+'</div>'+
                '<div class="equipment-stock"><b>Disponibles</b> <p>'+equipment.stock+'</p></div>'+
                '</span>'
            );
            return $equipment;
        }

        selectable_equipment.select2({
            width: '100%',
            language: 'es',
            data: function(params){
                return {
                    q: params.term, // search term
                    page: params.page
                }
            },
            ajax: {
                url: base_url+'/equipos/getEquipments',
                dataType: 'json',
                delay: 250,
                processResults: function(data, params){
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    }
                }
            },
            cache: true,
            minimumInputLength: 1,
            escapeMarkup: function (markup) { return markup; },
            templateResult: formatEquipment,
            templateSelection: formatEquipmentSelection
        });
    } // End selectable_equipment

    var selectable_add = $('.select2-add');
    if(selectable_add.length){
        selectable_add.select2({
            width: '100%',
            language: 'es',
            tags: true
        });
    } // End selectable_add

    // Datepicker
    var dateable = $('.datepicker');
    if(dateable.length){
        dateable.datepicker({
            language: 'es-ES',
            format: 'yyyy-mm-dd',
            startDate: new Date()
        });
    } // End Datepicker

    // Autosize
    var autosizable = $('.autosizable');
    if(autosizable.length){
        autosize(autosizable);
    }

    // Notifications
    var notification = $('.notification');
    if(notification.length){
        notification.delay(4000).slideUp();
        $body.on('click', '.close-notification', function(){
            notification.slideUp();
        });
    } // End Notifications

    // Servicios
    var servicios_table = $('.services');
    if(servicios_table.length){
        var client_id = $('#client_id'),
            company = $('#company'),
            phone = $('#phone'),
            email = $('#email'),
            trade_name = $('#trade_name'),
            rfc = $('#rfc'),
            address = $('#address'),
            zipcode = $('#zipcode'),
            search_equipment = $('#search_equipment');

        client_id.on('change', function(){
            var id = $(this).val();
            $.get(base_url+'/clientes/getClientById/'+id, function(data){
                company.val(data.company);
                phone.val(data.phone);
                email.val(data.email);
                trade_name.val(data.trade_name);
                rfc.val(data.rfc);
                address.val(data.address);
                zipcode.val(data.zipcode);
            });
        });

        search_equipment.on('change', function(){
            var $this = $(this),
                id = $this.val(),
                tr = $('<tr>');
            var equipments = $('.services').find('[name="equipments['+id+'][equipment_id]"]');

            function add_equipment(id) {
                $.get(base_url+'/equipos/getEquipmentById/'+id, function(data){
                    var td_serial = $('<td>', {
                        text: data.serial
                    });

                    var div_photo = $('<div>', {
                        class: 'equipment-photo',
                        html: $('<img>', {
                            src: data.picture,
                            alt: data.title,
                            class: 'img'
                        })
                    });
                    var td_photo = $('<td>', {
                        html: div_photo
                    });

                    var h4_title = $('<h4>', {
                        class: 'equipment-title',
                        text: data.title
                    });
                    var h5_brand = $('<h5>', {
                        class: 'equipment-brand',
                        html: '<b>Marca:</b> <i>'+data.brand.title+'</i>'
                    });
                    var h5_group = $('<h5>', {
                        class: 'equipment-group',
                        html: '<b>Grupo:</b> <i>'+data.group.title+'</i>'
                    });
                    var h5_warehouse = $('<h5>', {
                        class: 'equipment-warehouse',
                        html: '<b>Almacén:</b> <i>'+data.warehouse.title+'</i>'
                    });
                    var div_description = $('<div>', {
                        class: 'equipment-description',
                        html: data.description
                    });
                    var td_equipment = $('<td>');
                    td_equipment.append(h4_title);
                    td_equipment.append(h5_brand);
                    td_equipment.append(h5_group);
                    td_equipment.append(h5_warehouse);
                    td_equipment.append(div_description);

                    var stock = (data.stock > 0) ? data.stock : 1;
                    var td_quantity = $('<td>', {
                        html: $('<input>', {
                            class: 'input qty',
                            value: 1,
                            type: 'number',
                            min: 1,
                            max: stock,
                            name: 'equipments['+data.id+'][quantity]'
                        })
                    });

                    var button_delete = $('<button>', {
                        class: 'delete-row',
                        html: '<i class="typcn typcn-delete"></i> Eliminar',
                    });
                    var equipment_hidden = $('<input>', {
                        name: 'equipments['+data.id+'][equipment_id]',
                        value: data.id,
                        type: 'hidden'
                    });
                    var td_options = $('<td>');
                    td_options.append(equipment_hidden);
                    td_options.append(button_delete);

                    tr.append(td_serial);
                    tr.append(td_photo);
                    tr.append(td_equipment);
                    tr.append(td_quantity);
                    tr.append(td_options);

                    servicios_table.find('tbody').append(tr);
                });
            }

            if(equipments.length){
                equipments.each(function(){
                    var $this = $(this),
                        existent_id = $this.val();
                    if(existent_id == id){
                        var tr = $this.closest('tr'),
                            qty = tr.find('.qty'),
                            current_qty = parseInt(qty.val());
                        qty.val(current_qty + 1);
                    }else{
                        add_equipment(id);
                    }
                });
            }else{
                add_equipment(id);
            }
            $this.val(0);
        });

        $body.on('click', '.delete-row',function(){
            var $this = $(this),
                tr = $this.closest('tr');
            tr.remove();
            return false;
        });
    }
});
