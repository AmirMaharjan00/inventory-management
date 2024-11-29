function suggetion() {

    /**
     * For Suggestions
     * 
     * @since 1.0.0
     */
    $('#sug_input').keyup(function(e) {

        var formData = {
            'product_name': $('input[name=title]').val()
        };
        if (formData['product_name']) {
            // process the form
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: formData,
                dataType: 'json',
                encode: true,
            })
            .done(function(data) {
                // console.log(data);
                $('#result').html(data).fadeIn();
                $('#result li').click(function() {

                    $('#sug_input').val($(this).text());
                    $('#result').fadeOut(500);

                });

                $("#sug_input").blur(function() {
                    $("#result").fadeOut(500);
                });

            });
            
            /* Live Search Logic */
            $('#sales-table .product-title').each(function(){
                let _this = $(this)
                if( _this.text().toLowerCase().includes(formData.product_name.toLowerCase()) ) {
                    _this.parents('tr').show()
                } else {
                    _this.parents('tr').hide()
                }
            })

        } else {
            $("#result").hide();
            $('#product_info #s_name').each(function(){
                $(this).parents('tr').show()
            })
        };

        e.preventDefault();
    });
}

function total() {
    /* Price */
    $('#product_info input[name=price]').change(function(e) {
        let _this = $(this), value = _this.val()
        let quantityValue = _this.parents('.form-wrapper').find('input[name=quantity]').val()
        _this.parents('.form-wrapper').find('input[name=total]').val( quantityValue * value )
        _this.parents('.form-wrapper').find('input[name=total_indicator]').val( quantityValue * value )
    });
    /* Quantity */
    $('#product_info input[name=quantity]').change(function(e) {
        let _this = $(this), value = _this.val()
        let priceValue = _this.parents('.form-wrapper').find('input[name=price]').val()
        _this.parents('.form-wrapper').find('input[name=total]').val( priceValue * value )
        _this.parents('.form-wrapper').find('input[name=total_indicator]').val( priceValue * value )
    });
}

$(document).ready(function($) {

    //tooltip
    $('[data-toggle="tooltip"]').tooltip();

    $('.submenu-toggle').click(function() {
        $(this).parent().children('ul.submenu').toggle(200);
    });
    //suggetion for finding product names
    suggetion();
    // Callculate total ammont
    total();

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true
    });


    /**
     * download report in pdf
     */
    $('#download-report').on('click', function (event) {
        event.preventDefault()
        var content = $('.table.table-border').html();
        var styles = $('link[rel="stylesheet"]').toArray().map(link => link.outerHTML).join('');
        var printWindow = window.open('', '_blank');
        printWindow.document.open();
        printWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>Print Preview</title>
                ${styles}
            </head>
            <body>${content}</body>
            </html>
        `);
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    })
    
    /**
     * product live search
     */
    $('#product_search_input').keyup(function(e) {
        let _this = $(this), value = _this.val().toLowerCase()
        $('.product-table .product-title').each(function(){
            let current = $(this)
            if( current.text().toLowerCase().includes(value) ) {
                current.parents('tr').show()
            } else {
                current.parents('tr').hide()
            }
        })
    })
});