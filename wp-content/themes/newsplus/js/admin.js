/**
 * admin.js
 *
 * used in theme options panel
 * @package NewsPlus
 * @since 1.0.0
 * @version 3.0
 */
jQuery(document).ready(function ($) {
    $('.tabbed').hide();
    $('.nav-tab-wrapper a:first').addClass('nav-tab-active');
    $('.tabbed:first').show();
    $('.nav-tab-wrapper > a').click(function () {
        $('.nav-tab-wrapper > a').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('.tabbed').hide();
        var currentTab = $(this).attr('href');
        $(currentTab).show();
        return false;
    });
});


// Media uploader
jQuery(function ($) {

    'use strict';

    // Media uploader
    $(document).on('ready panelsopen widget-updated', function () {
        // Set all variables to be used in scope
        var frame,
            widget = $('.ss_wrap'),
            addImgLink = widget.find('.upload_image_btn'),
            delImgLink = widget.find('.delete_image_btn'),
            imgContainer = widget.find('.image-preview'),
            imgIdInput = widget.find('.image-url');

        // ADD IMAGE LINK
        addImgLink.on('click', function (event) {
            event.preventDefault();

            // If the media frame already exists, reopen it.
            if (frame) {
                frame.open();
                return;
            }

            // Create a new media frame
            frame = wp.media({
                title: np_localize.media_upload_text,
                button: {
                    text: np_localize.media_button_text
                },
                multiple: false // Set to true to allow multiple files to be selected
            });


            // When an image is selected in the media frame...
            frame.on('select', function () {

                // Get media attachment details from the frame state
                var attachment = frame.state().get('selection').first().toJSON();

                // Send the attachment URL to our custom image input field.
                imgContainer.append('<img class="user-image" src="' + attachment.url + '" alt="" />');
                imgContainer.find('img.dummy-image').hide();

                // Send the attachment id to our hidden input
                imgIdInput.val(attachment.url);

                // Hide the add image link
                addImgLink.addClass('hidden');

                // Unhide the remove image link
                delImgLink.removeClass('hidden');
            });

            // Finally, open the modal on click
            frame.open();
        });


        // DELETE IMAGE LINK
        delImgLink.on('click', function (event) {

            event.preventDefault();

            // Clear out the preview image
            imgContainer.find('img.user-image').remove();

            imgContainer.find('img.dummy-image').show();

            // Un-hide the add image link
            addImgLink.removeClass('hidden');

            // Hide the delete image link
            delImgLink.addClass('hidden');

            // Delete the image id from the hidden input
            imgIdInput.val('');

        });
    });

    // Media uploader for the page options panel
    function newsplus_theme_options_media_uploader() {
        // Set all variables to be used in scope
        var frame,
            metaBox = $('#newsplus-page-options'),
            addImgLink = metaBox.find('.upload-custom-img'),
            delImgLink = metaBox.find('.delete-custom-img'),
            imgContainer = metaBox.find('.banner-img-container'),
            imgURL = metaBox.find('.banner-url');

        // Add image link
        addImgLink.on('click', function (e) {

            e.preventDefault();

            // If the media frame already exists, reopen it.
            if (frame) {
                frame.open();
                return;
            }

            // Create a new media frame
            frame = wp.media({
                title: np_localize.media_uploader_title,
                button: {
                    text: np_localize.media_button_text
                },
                multiple: false // Set to true to allow multiple files to be selected
            });


            // When an image is selected in the media frame...
            frame.on('select', function () {

                // Get media attachment details from the frame state
                var attachment = frame.state().get('selection').first().toJSON();

                // Send the attachment URL to our custom image input field.
                imgContainer.append('<img src="' + attachment.url + '" alt="" style="max-width:100%;"/>');

                // Send the attachment URL to input
                imgURL.val(attachment.url);

                // Hide the add image link
                addImgLink.addClass('hidden');

                // Unhide the remove image link
                delImgLink.removeClass('hidden');
            });

            // Finally, open the modal on click
            frame.open();
        });


        // Delete image link
        delImgLink.on('click', function (event) {

            event.preventDefault();

            // Clear out the preview image
            imgContainer.html('');

            // Un-hide the add image link
            addImgLink.removeClass('hidden');

            // Hide the delete image link
            delImgLink.addClass('hidden');

            // Delete the image id from the hidden input
            imgURL.val('');

        });
    }

    newsplus_theme_options_media_uploader();

    $('.np-color-picker').wpColorPicker();
});