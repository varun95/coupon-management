import $ from "jquery";

/**
 * Desc - Validates input
 *
 * @param form_data
 * @returns {boolean}
 */
export function validateInputs(form_data) {

    if (form_data.name === undefined || form_data.name === null || form_data.name === '') {
        $('.coupon_name_error').show();
        return false;
    } else {
        $('.coupon_name_error').hide();
    }
    if (form_data.description === undefined || form_data.description === null || form_data.description === '') {
        $('.coupon_description_error').show();
        return false;
    } else {
        $('.coupon_description_error').hide();
    }
    if (form_data.start_date === undefined || form_data.start_date === null || form_data.start_date === '') {
        $('.start_date_error').show();
        return false;
    } else {
        $('.start_date_error').hide();
    }
    if (form_data.end_date === undefined || form_data.end_date === null || form_data.end_date === '') {
        $('.end_date_error').show();
        return false;
    } else {
        $('.end_date_error').hide();
    }
    if (form_data.max_redeem === undefined || form_data.max_redeem === null || form_data.max_redeem === '') {
        $('.max_redeem_error').show();
        return false;
    } else {
        $('.max_redeem_error').hide();
    }
    if (form_data.max_redeem_per_user === undefined || form_data.max_redeem_per_user === null || form_data.max_redeem_per_user === '') {
        $('.max_redeem_per_user_error').show();
        return false;
    } else {
        $('.max_redeem_per_user_error').hide();
    }
    if (form_data.amount === undefined || form_data.amount === null || form_data.amount === '') {
        $('.amount_error').show();
        return false;
    } else {
        $('.amount_error').hide();
    }

    let formattedStartDate = new Date(form_data.start_date);
    let formattedEndDate = new Date(form_data.end_date);
    console.log(formattedStartDate);
    console.log(formattedEndDate);
    if (formattedEndDate <= formattedStartDate) {
        $('.date_constraint_error').show();
        return false;
    } else {
        $('.date_constraint_error').hide();
    }

    if (form_data.max_redeem_per_user > form_data.max_redeem) {
        $('.max_redeem_constraint_error').show();
        return false;
    } else {
        $('.max_redeem_constraint_error').hide();
    }

    return true;
}

/**
 * Desc - Sends form submit request.
 *
 * @param form_data
 * @param ajax_url
 */
export function sendFormSubmitRequest(form_data, ajax_url) {
    // Sends form submit ajax.
    $.ajax({
        type: "POST",
        url: ajax_url,
        dataType: 'JSON',
        data: JSON.stringify(form_data),
        contentType: "application/json; charset=utf-8",
        async: true,
        success: function (result) {
            console.log(result);
            bootbox.dialog({
                title: "<b>Success</b>",
                message: "Coupon successfully saved.",
                buttons: {
                    ok: {
                        label: 'Ok',
                        className: 'btn btn-success',
                        callback: function () {
                            // Reload window.
                            location.reload();
                        }
                    }
                },
                onEscape: function () {
                    // Reload window.
                    location.reload();
                }
            });
        },
        beforeSend: function () {
            $('#circularG').show();
            $('.layer').show();
        },
        complete: function () {
            $('#circularG').hide();
            $('.layer').hide();
        },
        error: function (xhr, status, error, result) {
            bootbox.alert({
                title: "<b>Error</b>",
                message: "Sorry there\'s some problem in processing your request. Please try after sometime."
            });
        }
    });
}

/**
 * Desc - Sends coupon update status request.
 *
 * @param coupon_id
 * @param ajax_url
 * @param action
 */
export function sendCouponStatusUpdateRequest(coupon_id, ajax_url, action) {
    let data = {id: coupon_id, action: action};
    // Sends form submit ajax.
    $.ajax({
        type: "POST",
        url: ajax_url,
        dataType: 'JSON',
        data: JSON.stringify(data),
        contentType: "application/json; charset=utf-8",
        async: true,
        success: function (result) {
            console.log(result);
            bootbox.dialog({
                title: "<b>Success</b>",
                message: "Successfully " + action +" coupon.",
                buttons: {
                    ok: {
                        label: 'Ok',
                        className: 'btn btn-success',
                        callback: function () {
                            // Reload window.
                            location.reload();
                        }
                    }
                },
                onEscape: function () {
                    // Reload window.
                    location.reload();
                }
            });
        },
        beforeSend: function () {
            $('#circularG').show();
            $('.layer').show();
        },
        complete: function () {
            $('#circularG').hide();
            $('.layer').hide();
        },
        error: function (xhr, status, error, result) {
            bootbox.alert({
                title: "<b>Error</b>",
                message: "Sorry there\'s some problem in processing your request. Please try after sometime."
            });
        }
    });
}