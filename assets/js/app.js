/*
 * Main JavaScript file.
 */

// Less
import '../css/app.less';

// jQuery
import $ from 'jquery';
global.$ = global.jQuery = $;

// Bootstrap
require("bootstrap/dist/css/bootstrap.min.css");
require('bootstrap');

// Font-awesome
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

// BootboxJS
import bootbox from 'bootbox';
global.bootbox = bootbox;

import moment from 'moment';
global.moment = moment;

// Import other JS Files.
import {validateInputs, sendFormSubmitRequest, sendCouponStatusUpdateRequest} from './data_handle';

// DOM Ready...
$(document).ready(function () {
    // Constants.
    const display_date_format = 'DD/MM/YYYY HH:mm A';
    const formatted_date_format = 'YYYY-MM-DD HH:mm:ss';
    const update_coupon_action = "update";

    // Datetime pickers.
    $('#start_date').datetimepicker({
        showClose: true,
        showClear: true,
        format: display_date_format,
        icons: {
            time: "fas fa-clock",
            date: "fas fa-calendar",
            up: "fas fa-arrow-up",
            down: "fas fa-arrow-down"
        }
    });
    $('#end_date').datetimepicker({
        showClose: true,
        showClear: true,
        format: display_date_format,
        icons: {
            time: "fas fa-clock",
            date: "fas fa-calendar",
            up: "fas fa-arrow-up",
            down: "fas fa-arrow-down"
        }
    });

    // Form submit.
    $("#add_coupon_submit").click(function () {
        let data = {
            name: $('#coupon_name').val(),
            description: $('#coupon_description').val(),
            start_date: ($("#start_date").find("input").val() ? moment($("#start_date").find("input").val(),
                [display_date_format]).format(formatted_date_format) : ''),
            end_date: ($("#end_date").find("input").val() ? moment($("#end_date").find("input").val(),
                [display_date_format]).format(formatted_date_format) : ''),
            max_redeem: $('#max_redeem').val(),
            max_redeem_per_user: $('#max_redeem_per_user').val(),
            amount: $('#coupon_amount').val()
        };
        let success = validateInputs(data);
        if (success) {
            let form_submit_url = $('#form_submit_url').data('url');
            sendFormSubmitRequest(data, form_submit_url);
        }
    });

    // Coupon update status.
    $('.coupon_update_status').click(function () {
        let coupon_id = $(this).data('id');
        let url = $(this).data('update-status-coupon-url');
        let action = $(this).data('status-action');
        sendCouponStatusUpdateRequest(coupon_id, url, action);
    });
});
