define( [
    'jquery',
    'mage/url'
], function ( $, url ) {
    'use strict';

    return function ( DynamicRows ) {
        return DynamicRows.extend( {
            /**
             * Processing pages before deleteRecord
             *
             * @param {Number|String} index - element index
             * @param {Number|String} recordId
             * @param {Number|String} entityId
             */
            deleteRecordAndSlider: function (index, recordId, entityId) {
                this.deleteRecord(index, recordId);
                let deleteUrl = window.deleteUrl;
                console.log(deleteUrl)
                $.ajax({
                    url: deleteUrl,
                    cache: false,
                    method: 'POST',
                    beforeSend: function(xhr){
                        //Empty to remove magento's default handler
                    },
                    data: {form_key: window.FORM_KEY, slide_id: entityId},
                })
                    .always(function (response) {
                        console.log(response.message)
                    })
            }

        } );
    }
} );
