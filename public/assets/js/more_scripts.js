var token = jQuery('meta[name="csrf-token"]').attr("content"),
    site_url = jQuery('meta[name="site-url"]').attr("content");

function inProgress(e) {
    if (0 == e) var r = "Video function not updated yet.";
    else r = "Audio Call function not updated yet.";
    return toastr.info(r), !0
}

function LoginUser(e) {
    e.preventDefault();
    var r = jQuery("input[name=email]").val(),
        t = jQuery("input[name=password]").val(),
        o = jQuery("input[name=remember]").val(),
        s = {
            _token: token,
            email: r,
            password: t,
            remember: o
        },
        a = site_url + "/login/user";
    return jQuery.ajax({
        type: "post",
        url: a,
        data: s,
        beforeSend: function() {
            jQuery("#loader").show()
        },
        success: function(e) {
            if (console.log("response data", e), "success" == e.status) eraseCookie("user_id"), eraseCookie("username"), eraseCookie("image"), eraseCookie("profile_link"), eraseCookie("onoff"), eraseCookie("email"), toastr.success(e.message), setTimeout(function() {
                window.location.reload()
            }, 1000);
            else if ("error" == e.status) return jQuery("#login-button").show(), jQuery("#cred_error").html(e.message), !1
        },
        complete: function(e) {
            jQuery("#loader").hide()
        },
        error: function(e) {
            e && (jQuery("#email").html(e.responseJSON.validation_errors.email), jQuery("#password").html(e.responseJSON.validation_errors.password))
        }
    }), !1
}



function setCookie(e, r, t) {
    var o = new Date;
    o.setTime(o.getTime() + 24 * t * 60 * 60 * 1e3), document.cookie = e + "=" + r + ";expires=" + o.toUTCString()
}

function getCookie(e) {
    var r = document.cookie.match("(^|;) ?" + e + "=([^;]*)(;|jQuery)");
    return r ? r[2] : null
}

function eraseCookie(e) {
    setCookie(e, getCookie(e), "-1")
}

function addBuyerMessage(e) {
    var r = site_url + "/buyer/add-buyer-message",
        t = jQuery("#message_title" + e).val(),
        o = jQuery("textarea#message" + e).val();
    jQuery.ajax({
        type: "post",
        url: r,
        data: {
            _token: token,
            talent_id: e,
            message_title: t,
            message: o
        },
        success: function(e) {
            e.success && (jQuery('[id^="myModal-message"]').modal("hide"), toastr.success(e.success), setTimeout((function() {
                window.location.reload()
            }), 1e3)), e.error && toastr.error(e.error)
        },
        error: function(r) {
            r && (jQuery("#title_error" + e).html(r.responseJSON.validation_errors.message_title), jQuery("#message_error" + e).html(r.responseJSON.validation_errors.message))
        }
    })
}

function deleteBuyerProduct(e, r) {
    jQuery('[id^="myModal-del"]').modal("hide");
    var t = site_url + "/buyer/delete-buyer-product";
    jQuery.ajax({
        type: "post",
        url: t,
        data: {
            _token: token,
            id: e,
            talent_id: r
        },
        success: function(e) {
            e.success && (toastr.success(e.success), setTimeout((function() {
                window.location.reload()
            }), 1e3)), e.error && toastr.error(e.error), e.warning && toastr.warning(e.warning)
        },
        error: function(e) {
            e && toastr.error("Bad Request.")
        }
    })
}

function addRating(e) {
    var r = site_url + "/buyer/add-buyer-rating",
        t = jQuery('input[name="rating"]:checked').val(),
        o = jQuery("textarea#comment" + e).val();
    console.log(t), jQuery.ajax({
        type: "post",
        url: r,
        data: {
            _token: token,
            talent_id: e,
            award_to_talent: t,
            comment: o
        },
        success: function(e) {
            e.success && (jQuery('[id^="myModal-tro"]').modal("hide"), toastr.success(e.success), setTimeout((function() {
                window.location.reload()
            }), 1e3)), e.error && toastr.error(e.error)
        },
        error: function(r) {
            r && (jQuery("#rating" + e).html(r.responseJSON.validation_errors.award_to_talent), jQuery("#messagerating" + e).text(r.responseJSON.validation_errors.comment))
        }
    })
}

function addCommentToTalent(e) {
    var r = site_url + "/buyer/add-comment-to-talent",
        t = jQuery("textarea#leaveComment" + e).val();
    jQuery.ajax({
        type: "post",
        url: r,
        data: {
            _token: token,
            talent_id: e,
            comment: t
        },
        success: function(e) {
            e.success && (jQuery('[id^="myModal-coment"]').modal("hide"), toastr.success(e.success), setTimeout((function() {
                window.location.reload()
            }), 1e3)), e.error && toastr.error(e.error)
        },
        error: function(r) {
            r && jQuery("#commentError" + e).html(r.responseJSON.validation_errors.comment)
        }
    })
}

function downloadProduct(e) {
    var r = site_url + "/buyer/download-buyer-product";
    jQuery.ajax({
        type: "post",
        url: r,
        data: {
            _token: token,
            talent_id: e
        },
        success: function(e) {
            e.zip && (jQuery('[id^="myModal"]').modal("hide"), window.open("", "_blank").location.href = e.zip.download_url)
        },
        error: function(e) {
            e && toastr.error("Bad Request")
        }
    })
}

function editPromoteProduct(e) {
    var r = jQuery('input[name="media"]:checked').val(),
        t = jQuery("#s-title" + e).val(),
        o = jQuery("textarea#commentToShare" + e).val(),
        s = site_url + "/seller/edit-promote-product";
    jQuery.ajax({
        type: "post",
        url: s,
        data: {
            _token: token,
            promote_id: e,
            title: t,
            message: o,
            social_name: r
        },
        success: function(e) {
            e.success && (jQuery('[id^="myModal-editPromoteProduct"]').modal("hide"), toastr.success(e.success), setTimeout((function() {
                window.location.reload()
            }), 1e3)), e.error && toastr.error(e.error)
        },
        error: function(r) {
            r && (jQuery("#titleError" + e).text(r.responseJSON.validation_errors.title), jQuery("#messageError" + e).text(r.responseJSON.validation_errors.message), jQuery("#socialNameError" + e).text(r.responseJSON.validation_errors.social_name))
        }
    })
}

function postSellerContact(e) {
    var r = site_url + "/seller/post-seller-contact",
        t = jQuery("#name").val(),
        o = jQuery("input[type='email']#seller_email").val(),
        s = jQuery("textarea#seller_message").val();
    jQuery.ajax({
        type: "post",
        url: r,
        data: {
            _token: token,
            name: t,
            email: o,
            message: s
        },
        success: function(e) {
            e.success && (jQuery('[id^="myModal-product"]').modal("hide"), toastr.success(e.success), setTimeout((function() {
                window.location.reload()
            }), 1e3)), e.error && toastr.error(e.error)
        },
        error: function(e) {
            e && (jQuery("#nameError").text(e.responseJSON.validation_errors.name), jQuery("#emailError").text(e.responseJSON.validation_errors.email), jQuery("#messageError").text(e.responseJSON.validation_errors.message))
        }
    })
}

function postCustomPlan(e) {
    var r = site_url + "/seller/custom-plan",
        t = jQuery("textarea#custom_plan").val();
    jQuery.ajax({
        type: "post",
        url: r,
        data: {
            _token: token,
            custom_plan: t
        },
        success: function(e) {
            e.success && (jQuery("textarea#custom_plan").val(""), toastr.success(e.success), setTimeout((function() {
                window.location.reload()
            }), 1e3)), e.error && toastr.error(e.error)
        },
        error: function(e) {
            e && (jQuery("textarea#custom_plan").css("border-color", "red"), toastr.error(e.responseJSON.validation_errors.custom_plan))
        }
    })
}

function deleteSellerProduct(e) {
    jQuery('[id^="myModal-del"]').modal("hide");
    var r = site_url + "/seller/delete-my-product";
    jQuery.ajax({
        type: "post",
        url: r,
        data: {
            _token: token,
            talent_id: e
        },
        success: function(e) {
            e.success && (toastr.success(e.success), setTimeout((function() {
                window.location.reload()
            }), 1e3)), e.error && toastr.error(e.error), e.warning && toastr.warning(e.warning)
        },
        error: function(e) {
            e && toastr.error("Bad Request.")
        }
    })
}

function deleteSellerPromoteProduct(e) {
    jQuery('[id^="myModal-del"]').modal("hide");
    var r = site_url + "/seller/delete-promote-product";
    jQuery.ajax({
        type: "post",
        url: r,
        data: {
            _token: token,
            promote_id: e
        },
        success: function(e) {
            e.success && (toastr.success(e.success), setTimeout((function() {
                window.location.reload()
            }), 1e3)), e.error && toastr.error(e.error), e.warning && toastr.warning(e.warning)
        },
        error: function(e) {
            e && toastr.error("Bad Request.")
        }
    })
}

function filter(e) {
    if ("" != e.value) var r = site_url + "/seller/my-product/days/" + e.value;
    else r = site_url + "/seller/my-product";
    window.location.href = r
}

function filterDeletedProducts(e) {
    if ("" != e.value) var r = site_url + "/seller/my-deleted-product/days/" + e.value;
    else r = site_url + "/seller/my-deleted-product";
    window.location.href = r
}

function filterPromotedProduct(e) {
    if ("" != e.value) var r = site_url + "/seller/promote-product/days/" + e.value;
    else r = site_url + "/seller/promote-product";
    window.location.href = r
}

function awardTalent(e) {
    console.log(e), jQuery('[id^="giveAward"]').modal("hide");
    var r = site_url + "/talent-mall/give-talent-award";
    jQuery.ajax({
        type: "post",
        url: r,
        data: {
            _token: token,
            talent_id: e
        },
        success: function(e) {
            console.log("success", e), e.success && (toastr.success(e.success), setTimeout((function() {
                window.location.reload()
            }), 1e3)), e.error && toastr.error(e.error), e.info && toastr.info(e.info)
        },
        error: function(e) {
            console.log("Error Bad Request"), e && toastr.error("Bad Request.")
        }
    })
}

function addRiderToTalent(e) {
    jQuery('[id^="giveAward"]').modal("hide");
    var r = site_url + "/talent-mall/add-rider";
    jQuery.ajax({
        type: "POST",
        url: r,
        data: {
            _token: token,
            talent_id: e
        },
        success: function(e) {
            e.success && (toastr.success(e.success), setTimeout((function() {
                window.location.reload()
            }), 1e3)), e.error && toastr.error(e.error), e.info && toastr.info(e.info)
        },
        error: function(e) {
            e && toastr.error("Bad Request.")
        }
    })
}

function addBuyerContactMessage(e) {
    var r = site_url + "/talent-mall/add-buyer-contact-message",
        t = jQuery("#title").val(),
        o = jQuery("textarea#message").val();
    jQuery.ajax({
        type: "post",
        url: r,
        data: {
            _token: token,
            talent_id: e,
            message_title: t,
            message: o
        },
        success: function(e) {
            e.success && (jQuery('[id^="sendMessage"]').modal("hide"), toastr.success(e.success), setTimeout((function() {
                window.location.reload()
            }), 1e3)), e.error && toastr.error(e.error)
        },
        error: function(e) {
            e && (jQuery("#title_error").html(e.responseJSON.validation_errors.message_title), jQuery("#message_error").html(e.responseJSON.validation_errors.message))
        }
    })
}

function addToCart(e) {
    var r = site_url + "/talent-mall/add-talent-to-cart";
    jQuery.ajax({
        type: "post",
        url: r,
        data: {
            _token: token,
            talent_id: e
        },
        success: function(e) {
            e.success && (toastr.success(e.success), setTimeout((function() {
                window.location.reload()
            }), 500)), e.error && toastr.error(e.error), e.info && toastr.info(e.info)
        },
        error: function(e) {
            e && toastr.error("Bad Request.")
        }
    })
}

function openForgetPasswordModal() {
    jQuery("#login").modal("hide"), jQuery("#forgotPasswordModal").modal("show")
}

function openLoginModal() {
    jQuery("#register_my_model").modal("hide"), jQuery("#login").modal("show")
}

function forgotPassword() {
    var e = site_url + "/forgot-password",
        r = jQuery("#forget_email").val();
    jQuery.ajax({
        type: "post",
        url: e,
        data: {
            _token: token,
            email: r
        },
        success: function(e) {
            e.validation_error && toastr.warning(e.validation_error), e.success && (toastr.success(e.success), setTimeout((function() {
                window.location.reload()
            }), 1e3)), e.error && toastr.error(e.error), e.warning && toastr.warning(e.warning)
        },
        error: function(e) {
            e && toastr.error("Bad Request.")
        }
    })
}

function readURL1(e) {
    if (e.files && e.files[0]) {
        jQuery("#showImage").show();
        var r = new FileReader;
        r.onload = function(e) {
            jQuery("#showImage").attr("src", e.target.result)
        }, r.readAsDataURL(e.files[0])
    }
}

function captchaGenerator() {
    for (var e = "ABCDEFGHIJKLMNOPQRSTUVWXTZ0123456789abcdefghiklmnopqrstuvwxyz0123456789", r = "", t = 0; t < 6; t++) {
        var o = Math.floor(Math.random() * e.length);
        r += e.substring(o, o + 1)
    }
    console.log(r), jQuery(".cap-text-string").text(r), jQuery(".captcha-recall-assign").val(r), jQuery(".captcha-recall").val()
}

function readURL(e) {
    if (e.files && e.files[0]) {
        var r = new FileReader;
        r.onload = function(e) {
            jQuery("#profile-image").attr("src", e.target.result)
        }, r.readAsDataURL(e.files[0])
    }
}

function openNextTab() {
    jQuery("#account_change_modal").modal("hide"), jQuery("#account_change_modal1").modal("show")
}

function openPrevousTab() {
    jQuery("#account_change_modal1").modal("hide"), jQuery("#account_change_modal").modal("show")
}

function closeRegister() {
    jQuery("#register_my_model").modal("hide"), jQuery("#login").modal("show")
}
$(document).ready((function() {
        $("#lightSlider").lightSlider(), $('[data-toggle="tooltip"]').tooltip()
    })), lightbox.option({
        resizeDuration: 200,
        wrapAround: !0,
        fitImagesInViewport: !0,
        minHeight: 700,
        minWidth: 700
    }), jQuery('a[data-toggle="tab"]').on("click", (function(e) {
        event.preventDefault(), "#bbb" == jQuery(e.target).attr("href") && jQuery("#quick-reminder").modal("show")
    })), jQuery("#uploadBtn").change((function() {
        readURL1(this)
    })), jQuery((function() {
        jQuery("#showImage").hide()
    })), jQuery(document).on("click", "#select_all", (function() {
        jQuery(".emp_checkbox").prop("checked", this.checked), jQuery("#select_count").html(jQuery("input.emp_checkbox:checked").length + " Selected")
    })), captchaGenerator(), jQuery(document).on("click", ".emp_checkbox", (function() {
        jQuery(".emp_checkbox:checked").length == jQuery(".emp_checkbox").length ? jQuery("#select_all").prop("checked", !0) : jQuery("#select_all").prop("checked", !1), jQuery("#select_count").html(jQuery("input.emp_checkbox:checked").length + " Selected")
    })), jQuery("#delete_records").on("click", (function(e) {
        var r = [];
        if (jQuery(".emp_checkbox:checked").each((function() {
                r.push(jQuery(this).data("emp-id"))
            })), r.length <= 0) toastr.warning("Please select products to delete.");
        else if (confirm("Are you sure you want to delete " + (r.length > 1 ? "these" : "this") + " products?")) {
            var t = r.join(",");
            jQuery.ajax({
                type: "POST",
                url: site_url + "/seller/bulk-delete-my-product",
                cache: !1,
                data: {
                    talent_id: t,
                    _token: token
                },
                success: function(e) {
                    e.success && (toastr.success(e.success), setTimeout((function() {
                        window.location.reload()
                    }), 1e3)), e.error && toastr.error(e.error), e.warning && toastr.warning(e.warning)
                },
                error: function(e) {
                    e && toastr.error("Bad Request.")
                }
            })
        } else toastr.info("All information related to these products are safe."), jQuery("#select_all").prop("checked", !1), jQuery(".emp_checkbox").prop("checked", !1)
    })), jQuery("#delete_records_undo").on("click", (function(e) {
        var r = [];
        if (jQuery(".emp_checkbox:checked").each((function() {
                r.push(jQuery(this).data("emp-id"))
            })), r.length <= 0) toastr.warning("Please select products to undo.");
        else if (confirm("Are you sure you want to undo " + (r.length > 1 ? "these" : "this") + " products?")) {
            var t = r.join(",");
            jQuery.ajax({
                type: "POST",
                url: site_url + "/seller/my-deleted-product-undo",
                cache: !1,
                data: {
                    talent_id: t,
                    _token: token
                },
                success: function(e) {
                    e.success && (toastr.success(e.success), setTimeout((function() {
                        window.location.href = "my-product"
                    }), 1e3)), e.error && toastr.error(e.error), e.warning && toastr.warning(e.warning)
                },
                error: function(e) {
                    e && toastr.error("Bad Request.")
                }
            })
        } else toastr.info("All information related to these products are safe."), jQuery("#select_all").prop("checked", !1), jQuery(".emp_checkbox").prop("checked", !1)
    })), jQuery("#delete_records_permanently").on("click", (function(e) {
        var r = [];
        if (jQuery(".emp_checkbox:checked").each((function() {
                r.push(jQuery(this).data("emp-id"))
            })), r.length <= 0) toastr.warning("Please select products to delete permanently.");
        else if (confirm("Are you sure you want to delete permanently " + (r.length > 1 ? "these" : "this") + " products?")) {
            var t = r.join(",");
            jQuery.ajax({
                type: "POST",
                url: site_url + "/seller/bulk-deleted-my-product-permanently",
                cache: !1,
                data: {
                    talent_id: t,
                    _token: token
                },
                success: function(e) {
                    e.success && (toastr.success(e.success), setTimeout((function() {
                        window.location.href = "seller/my-product"
                    }), 1e3)), e.error && toastr.error(e.error), e.warning && toastr.warning(e.warning)
                },
                error: function(e) {
                    e && toastr.error("Bad Request.")
                }
            })
        } else toastr.info("All information related to these products are safe."), jQuery("#select_all").prop("checked", !1), jQuery(".emp_checkbox").prop("checked", !1)
    })), jQuery(window).on("load", (function() {
        jQuery(".search-results").css({
            display: "none"
        })
    })), jQuery(document).ready((function() {
        jQuery(document).on("click", "#search-toggle", (function(e) {
            jQuery(".search-box-div").toggleClass("show").find(".search-input").focus(), jQuery(".search-re.show-re").css({
                display: "none",
                opacity: "0"
            }), e.preventDefault()
        })), jQuery(document).on("keyup", ".search-box .text.search-input", (function() {
            var e = jQuery(this).val();
            "" == e && null == e && null == e || jQuery.ajax({
                type: "POST",
                url: site_url + "/search",
                data: {
                    search: e,
                    _token: token
                },
                success: function(e) {
                    e ? (jQuery(".search-re").css({
                        display: "block",
                        opacity: "1"
                    }), jQuery(".search-re").show(), jQuery(".search-re").addClass("show-re"), jQuery(".search-re").html(e.searhlist)) : (jQuery(".search-re").css({
                        display: "none",
                        opacity: "0"
                    }), jQuery(".search-re").removeClass("show-re"), jQuery(".search-re").html(""))
                }
            })
        })), jQuery(document).on("submit", "#web_link_model_form form", (function(e) {
            return e.preventDefault(), anchor = jQuery("#web_link_model_form form #anchor").val(), website = jQuery("#web_link_model_form form #website").val(), link = jQuery("#web_link_model_form form #link").val(), term = jQuery("#web_link_model_form form #term").val(), blog_id = jQuery("#web_link_model_form form #blog_id_x").val(), 0 == anchor.length ? 0 : jQuery("#term").is(":checked") ? (jQuery("#web_link_model_form").modal("hide"), jQuery("#web_link_model_after_submit").modal("show"), void jQuery.ajax({
                type: "post",
                url: site_url + "/blogs/save-other-liks",
                data: {
                    _token: token,
                    anchor: jQuery("#web_link_model_form form #anchor").val(),
                    website: jQuery("#web_link_model_form form #website").val(),
                    link: jQuery("#term").is(":checked"),
                    term: jQuery("#web_link_model_form form #term").val(),
                    blog_id: jQuery("#web_link_model_form form #blog_id_x").val()
                },
                success: function(e) {
                    console.log(e), 1 == e.success && (jQuery("#web_link_model_after_submit img").attr("src", site_url + "/images/right-check.png"), jQuery("#web_link_model_after_submit h4").text("Thank You. Please allow 24-48 hours for your link to be added."))
                },
                error: function(e) {
                    e && toastr.error("Bad Request.")
                }
            })) : 0
        })), jQuery("#search").keyup((function() {
            jQuery(".search-results").css({
                display: "block",
                opacity: "1"
            });
            var e = jQuery(this).val();
            "" == e && null == e && null == e || jQuery.ajax({
                type: "POST",
                url: site_url + "/search",
                data: {
                    search: e,
                    _token: token
                },
                success: function(e) {
                    e ? (jQuery(".search-results").show(), jQuery(".search-results").html(e.searhlist)) : (jQuery(".search-results").css({
                        display: "none",
                        opacity: "0"
                    }), jQuery(".search-results").html(""))
                }
            })
        }))
    })), jQuery(document).ready((function() {
        jQuery("#profile_pic").change((function() {
            readURL(this);
            var e = jQuery("#profile_pic")[0].files[0].name,
                r = jQuery("#profile_pic")[0].files[0].type;
            jQuery.inArray(r, ["image/gif", "image/jpeg", "image/png"]) > 0 ? jQuery("#noFile2").text(e) : (toastr.error("File size should be less than or equal to 2MB."), jQuery("#profile_pic").val(""), jQuery("#noFile2").text(""))
        }))
    })), jQuery("#profile-imageModal").on("hidden.bs.modal", (function() {
        jQuery("#profile-image").attr("src", ""), jQuery("#noFile2").val(""), toastr.info("No changes done to profile picture."), window.location.reload()
    })), jQuery(document).ready((function() {
        jQuery("#upload_form").on("submit", (function(e) {
            e.preventDefault(), jQuery.ajax({
                url: site_url + "/image-upload",
                method: "POST",
                data: new FormData(this),
                dataType: "JSON",
                contentType: !1,
                cache: !1,
                processData: !1,
                success: function(e) {
                    e.success && (console.log("made by function"), toastr.success(e.success), setTimeout((function() {
                        window.location.reload()
                    }), 1e3)), e.error && toastr.error(e.error), e.warning && toastr.warning(e.warning)
                }
            })
        }))
    })), jQuery(".change_account").click((function() {
        var e = jQuery(this).data("id");
        if (console.log(e), e) {
            jQuery("#account_change_modal2").modal("show");
            var r = site_url + "/buyer/update-user-account";
            jQuery.ajax({
                type: "POST",
                url: r,
                data: {
                    _token: token,
                    role: e
                },
                success: function(e) {
                    e.success && (toastr.success(e.success), setTimeout((function() {
                        window.location.reload()
                    }), 1e3)), e.error && toastr.error(e.error), e.warning && toastr.warning(e.warning)
                },
                error: function(e) {
                    e && toastr.error("Bad Request.")
                }
            })
        }
    })), jQuery(document).ready((function() {
        jQuery('[id^="un-follow-"]').click((function() {
            var e = jQuery(this).data("url"),
                r = {
                    _token: token
                };
            const t = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: !1
            });
            t.fire({
                title: "Are you sure?",
                text: "You want to unfollow this user",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, Unfollow!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then((o => {
                o.value ? jQuery.ajax({
                    type: "POST",
                    url: e,
                    data: r,
                    success: function(e) {
                        e.success ? Swal.fire({
                            icon: "success",
                            title: "Unfollow!",
                            text: e.success
                        }).then((e => {
                            e.value && window.location.reload()
                        })) : Swal.fire({
                            icon: "error",
                            title: e.error,
                            text: "Not able to proecess your request"
                        }).then((e => {
                            e.value && window.location.reload()
                        }))
                    }
                }) : o.dismiss === Swal.DismissReason.cancel && t.fire("Cancelled", "Your imaginary file is safe :)", "error")
            }))
        }))
    })), jQuery((function(e) {
        jQuery(".main-slider").length > 0 && jQuery(".main-slider").owlCarousel({
            items: 1,
            mouseDrag: !0,
            loop: !0,
            touchDrag: !0,
            autoplay: !0,
            dots: !0,
            autoplayTimeout: 2500,
            animateOut: "fadeOut",
            autoplayHoverPause: !0,
            smartSpeed: 250
        })
    })), document.onreadystatechange = function() {
        "complete" == document.readyState && setTimeout((function() {
            document.getElementById("interactive"), document.getElementById("load").style.visibility = "hidden"
        }), 1e3)
    }, jQuery(document).ready((function() {
        jQuery(".scroll-top-arrow").fadeOut()
    })), jQuery(window).scroll((function() {
        jQuery(this).scrollTop() > 100 ? jQuery(".scroll-top-arrow").fadeIn() : jQuery(".scroll-top-arrow").fadeOut()
    })), jQuery(".scroll-top-arrow").click((function() {
        return jQuery("html, body").animate({
            scrollTop: 0,
            behavior: "smooth"
        }, "slow"), !1
    })), jQuery("#navbar-search").on("click", (function(e) {
        e.preventDefault(), jQuery(this).addClass("hide"), jQuery("#navbar-searchbar").removeClass("hide")
    })),
    function(e, r) {
        function t() {
            var e = document.createElement("script");
            e.async = 1, e.type = "text/javascript", e.src = "https://widget.helpcrunch.com/", (r.body || r.head).appendChild(e)
        }
        e.HelpCrunch = function() {
            e.HelpCrunch.q.push(arguments)
        }, e.HelpCrunch.q = [], e.attachEvent ? e.attachEvent("onload", t) : e.addEventListener("load", t, !1)
    }(window, document), HelpCrunch("init", "futurestarr", {
        applicationId: 1,
        applicationSecret: "Ns0ynOloC5Af/kb8xI3/UkQQ3XHJACiejXZ8LorjMvcLvuPvyxErFgv2kTtzR3KunGaM+IB6exYVq3CK4r/K2w=="
    }), HelpCrunch("showChatWidget"), (new WOW).init(), jQuery(document).on("click", ".deleteusermodel", (function() {
        jQuery("#deleteusermodel .modal-title").text(jQuery(".chat_box.chat-opened .main_chat .chat-user").text()), jQuery("#deleteusermodel .modal-body .bydc").attr("data-userid", jQuery(this).data("userid")), jQuery("#action_menu-" + jQuery(this).data("userid")).css("display", "none")
    })), jQuery(document).on("click", "#deleteusermodel .bydc", (function() {
        token = $("meta[name='csrf-token']").attr("content"), jQuery("#contacts .active a").each((function() {
            jQuery(this).data("id") == jQuery("#deleteusermodel .bydc").attr("data-userid") && (jQuery(this).parents(".active").remove(), jQuery("#chat_box_" + jQuery("#deleteusermodel .bydc").attr("data-userid")).remove())
        })), jQuery.ajax({
            type: "POST",
            url: site_url + "/send/del",
            data: {
                _token: token,
                id: jQuery(this).data("userid")
            },
            success: function(e) {
                1 == e.state && jQuery(".chat_box.chat-opened .panel-body.chat-area").html("")
            },
            error: function(e) {
                toastr.error("Bad Request.")
            }
        })
    }));
var lmi = 0,
    imvar = 0;

function auto_reply() {
    jQuery.ajax({
        type: "GET",
        url: site_url + "/buyer-seller/auto-reply",
        success: function(e) {},
        error: function(e) {
            toastr.error("Bad Request.")
        }
    })
}

function get_inbox_users() {
    jQuery.ajax({
        type: "GET",
        url: site_url + "/buyer-seller/inbox-message/same",
        success: function(e) {
            if (0 == e.state) jQuery(".inbox_chat").html("<p class='no-msg'>0 Messages</p>"), jQuery(".msg-count").html(0);
            else {
                jQuery(".msg-count").html(e.count);
                var r = e.messages;
                jQuery(".inbox_chat").html(r)
            }
        },
        error: function(e) {
            toastr.error("Bad Request.")
        }
    })
}

function get_all_contact_delete() {
    jQuery.ajax({
        type: "GET",
        url: site_url + "/buyer-seller/getalluser",
        success: function(e) {
            var r = e,
                t = "";
            jQuery.each(r, (function(e, r) {
                r.first_name && (r.profile_pic ? profile_pic = r.profile_pic : profile_pic = "assets/images/profile.png", t += '<div class="row m-t-10">', t += '<div class="col-sm-2 col-md-2 col-xs-3 no-padding-right get-all-users-de1"><img class="sidebar-pic" src="/' + profile_pic + '"></div>', t += '<div class="col-sm-10 col-md-10 col-xs-9 get-all-users-de2"><div class="row no-margin">', message = r.message, message && (message = message.substring(0, 20)), t += '<div class="col-sm-9 col-md-9 col-xs-9 text-left no-padding get-all-users-de22"><span><b style="font-size: 13px;">' + r.first_name + " " + r.last_name + ' </b></span><p class="faded-text">' + message + "</p></div>", t += '<div class="col-sm-3 col-md-3 col-xs-3 text-right get-all-users-de222"></div>', t += "</div></div>", t += "</div>")
            })), jQuery("#tab3").html(t)
        },
        error: function(e) {
            toastr.error("Bad Request.")
        }
    })
}

function get_read_users() {
    jQuery.ajax({
        type: "GET",
        url: site_url + "/buyer-seller/getallreaduser",
        success: function(e) {
            jQuery("#tab1 .filter a").removeClass("active"), jQuery("#readmsg").addClass("active"), jQuery("#tab1 .sidebar-message").html(e)
        },
        error: function(e) {
            toastr.error("Bad Request.")
        }
    })
}

function get_unread_users() {
    jQuery.ajax({
        type: "GET",
        url: site_url + "/buyer-seller/getallunreaduser",
        success: function(e) {
            0 == e.state ? (jQuery("#unrmsg").css({
                background: "",
                padding: "",
                "border-radius": ""
            }), jQuery("#tab1 .sidebar-message").html("<p class='no-msg'>0 Messages</p>")) : (jQuery("#unrmsg").css({
                background: "rgba(255, 0, 0, .09)",
                padding: "1px 5px",
                "border-radius": "7px"
            }), jQuery("#tab1 .sidebar-message").html(e))
        },
        error: function(e) {
            toastr.error("Bad Request.")
        }
    })
}

function get_all_users() {
    console.log("sfjsdhfjdshfjdshf"), console.log(site_url), jQuery.ajax({
        type: "GET",
        url: site_url + "/buyer-seller/getalluser",
        success: function(e) {
            jQuery("#tab1 .sidebar-message").html(e)
        },
        error: function(e) {
            toastr.error("Bad Request.")
        }
    })
}

function sendMessage(e, r) {
    jQuery('#send-message-form input[name="received_by"]').val(e), jQuery(".direct-chat-messages").html(""), jQuery(".buyer-form > h4").html("Message - " + r), e ? getMessage(r, e) : jQuery("html, body").animate({
        scrollTop: jQuery(".buyer-form").offset().top - 80
    }, 100)
}

function getMessage(e, r) {
    jQuery("#load").css("visibility", "visible");
    var t = site_url + "/buyer-seller/chat-message/" + r;
    console.log(t), jQuery.ajax({
        type: "GET",
        url: t,
        success: function(r) {
            console.log("test messages", r), "" != r && (jQuery("#lmi").html(r.lmi), lmi = jQuery("#lmi").text(), get_read_users(), jQuery(".direct-chat-messages").html(r.html), jQuery(".buyer-form > h4").html("Message - " + e), jQuery("html, body").animate({
                scrollTop: jQuery(".buyer-form").offset().top - 80
            }, 100), jQuery("#load").css("visibility", "hidden"), jQuery('#send-message-form input[name="received_by"]').val(r.receiver_id), jQuery(".direct-chat-messages").scrollTop(jQuery(".direct-chat-messages")[0].scrollHeight))
        },
        error: function(e) {
            console.log("Bad Request"), toastr.error("Bad Request."), jQuery("#load").css("visibility", "hidden")
        }
    })
}

function deletemessage(e, r) {
    !0 === confirm("Are you sure delete this message") && (jQuery("#load").css("visibility", "visible"), jQuery.ajax({
        type: "GET",
        url: site_url + "/buyer-seller/delete-message/" + r,
        success: function(e) {
            get_all_contact_delete(), get_all_users(), jQuery("#load").css("visibility", "hidden")
        },
        error: function(e) {
            toastr.error("Bad Request.")
        }
    }))
}

function deleteMessageSelected(e, r) {
    !0 === confirm("Are you sure delete this message") && (jQuery("#load").css("visibility", "visible"), jQuery.ajax({
        type: "GET",
        url: site_url + "/buyer-seller/delete-message/" + r,
        success: function(e) {
            get_all_users(), jQuery("#load").css("visibility", "hidden")
        },
        error: function(e) {
            toastr.error("Bad Request.")
        }
    }))
}

function desopen(e) {
    document.getElementById(e).classList.toggle("star-search-textdd");
    var r = document.getElementById("read_button");
    "Read More" === r.innerHTML ? r.innerHTML = "Read Less" : r.innerHTML = "Read More"
}

function setTimer(e, r) {
    console.log("dfjhdfhs"), setTimeout((function() {
        jQuery(".upload-percentage .c100").removeClass("p" + r), jQuery(".upload-percentage .c100").addClass("p" + e), jQuery(".upload-percentage .c100 span").text(e), console.log("dfjhdfhs"), r = e, (e += 1) <= 100 && setTimer(e, r)
    }), 100)
}

function showUploadVideo(e) {
    if (e.files && e.files[0]) {
        var r = new FileReader;
        r.onload = function(r) {
            var t = r.target.result;
            if (t.indexOf("data:image/jpeg") > -1 || t.indexOf("data:image/png") > -1 || t.indexOf("data:image/jpg") > -1) $("#sound").hide(), $("#video_here1").hide(), $("#show_image").show(), $("#show_image").attr("src", r.target.result), $("#upload_label").removeClass("label-upload");
            else if (t.indexOf("data:audio/mp3") > -1 || t.indexOf("data:audio/mpeg") > -1) {
                $("#show_image").hide(), $("#video_here1").hide();
                var o = document.getElementById("sound");
                o.src = URL.createObjectURL(e.files[0]), o.onend = function(r) {
                    URL.revokeObjectURL(e.src)
                }, $("#sound").show(), $("#upload_label").removeClass("label-upload")
            } else if (t.indexOf("data:video/mp4") > -1) {
                $("#sound").hide(), $("#show_image").hide();
                var s = $("#video_here");
                s[0].src = URL.createObjectURL(e.files[0]), s.parent()[0].load(), $("#video_here1").show(), $("#upload_label").removeClass("label-upload")
            }
            $(".remove-preview").show()
        }, r.readAsDataURL(e.files[0])
    }
    $(document).on("click", ".remove-preview", (function() {
        $("#show_image").hide(), $("#sound").hide(), $("#video_here1").hide(), $("#upload_label").addClass("label-upload"), $(this).hide()
    }))
}
1 === onlyMessageChatPage && (get_unread_users(), get_inbox_users(), setTimeout((function() {
    get_all_users()
}), 1e3), setTimeout((function() {
    auto_reply()
}), 2e4)), jQuery(document).on("click", ".get-all-users .get-all-users-mob2", (function() {
    console.log("correct click"), name = jQuery(this).find(".ttlusr").text(), sid = jQuery(this).parents(".get-all-users").find(".message-check input").data("sid"), get_unread_users(), getMessage(name, sid), get_inbox_users()
})), jQuery((function() {
    var e = jQuery("#send-message-form textarea").emojioneArea({
        pickerPosition: "left"
    });
    jQuery(".message-sidebar .nav-tabs a").on("click", (function() {
        var e;
        id = jQuery(this).attr("id"), "option1-a" == id && get_all_users(), "option2-a" == id && (e = site_url + '/api/message/get_all_contact/1"', jQuery.ajax({
            type: "GET",
            url: e,
            success: function(e) {
                var r = e,
                    t = "";
                jQuery.each(r, (function(e, r) {
                    profile_picnew = "assets/images/profile.png", null != r.profile_pic ? (t += '<div class="row margin-bottom-5 margin-top-5">', t += '<div class="col-sm-2 col-md-2 col-xs-3 get-all-users-anc1"><a href="#"><img class="sidebar-pic circular" src="/' + r.profile_pic + '"></a></div>', t += '<div class="col-sm-10 col-md-10 col-xs-9 get-all-users-anc2"><div style="text-align: left; font-size: 14px;"><span class="cursor-pointer" onClick="return sendMessage(' + r.id + ", '" + r.first_name + " " + r.last_name + "');\"><b>" + r.first_name + " " + r.last_name + " </b></span></div></div>", t += "</div>") : (t += '<div class="row margin-bottom-5 margin-top-5">', t += '<div class="col-sm-2 col-md-2 col-xs-3 get-all-users-anc1"><a href="#"><img class="sidebar-pic circular" src="/' + profile_picnew + '"></a></div>', t += '<div class="col-sm-10 col-md-10 col-xs-9 get-all-users-anc2"><div style="text-align: left; font-size: 14px;"><span class="cursor-pointer" onClick="return sendMessage(' + r.id + ", '" + r.first_name + " " + r.last_name + "');\"><b>" + r.first_name + " " + r.last_name + " </b></span></div></div>", t += "</div>")
                })), jQuery("#tab2 div").next("div").html(t)
            },
            error: function(e) {
                toastr.error("Bad Request.")
            }
        })), "option3-a" == id && get_all_contact_delete()
    })), jQuery("#tab1 .filter a").on("click", (function() {
        id = jQuery(this).attr("id"), jQuery("#tab1 .filter a").removeClass("active"), jQuery(this).addClass("active"), "allmsg" == id && get_all_users(), "readmsg" == id && get_read_users(), "unrmsg" == id && get_unread_users()
    })), jQuery(document).on("keydown", "#send-message-form", (function(e) {
        13 == e.which && jQuery("#send-message-form").submit()
    })), jQuery("#send-message-form").submit((function(r) {
        if (r.preventDefault(), message = e[0].emojioneArea.getText(), "" == message.trim() && (message = jQuery("#send-message-form .emojionearea-editor").text()), "" != message.trim() || 0 != jQuery("#message_file")[0].files.length) {
            jQuery("#send-message-form textarea").val(""), e[0].emojioneArea.setText(""), jQuery("#load").css("visibility", "visible");
            var t = new FormData(this);
            document.getElementById("message_file").value = "";
            t.append("message", message), t.append("currentUser", ""), btn = jQuery("#send-message-form button"), jQuery('input[name="received_by"]').val().length > 0 ? (jQuery(".loding").show(), jQuery.ajax({
                url: site_url + "/buyer-seller/chat-message",
                type: "POST",
                data: t,
                dataType: "json",
                cache: !1,
                contentType: !1,
                processData: !1,
                beforeSend: function() {
                    btn.button("loading")
                },
                success: function(r) {
                    jQuery(".loding").hide(), jQuery("#lmi").text(r.lmi), jQuery("#send-message-form textarea").val(""), e[0].emojioneArea.setText(""), jQuery("#load").css("visibility", "hidden"), jQuery("#message_file").val(""), jQuery(".direct-chat-messages").append(r.html), jQuery(".direct-chat-messages").scrollTop(jQuery(".direct-chat-messages")[0].scrollHeight)
                },
                error: function(r) {
                    jQuery("#send-message-form textarea").val(""), e[0].emojioneArea.setText(""), toastr.error("Bad Request.")
                }
            })) : (jQuery("#send-message-form textarea").val(""), e[0].emojioneArea.setText(""))
        }
    })), jQuery("#automatic-form").submit((function(e) {
        e.preventDefault();
        var r = new FormData(this);
        jQuery("#togBtn").is(":checked") ? r.append("auto_reply", 1) : r.append("auto_reply", 0), r.append("user_id", ""), jQuery.ajax({
            url: site_url + "/api/autoreply-setting",
            type: "POST",
            data: r,
            dataType: "json",
            cache: !1,
            contentType: !1,
            processData: !1,
            success: function(e) {
                e.success && toastr.success("Setting Saved.")
            },
            error: function(e) {
                toastr.error("Bad Request.")
            }
        })
    })), jQuery("#tab1 .message-search").on("keyup", (function() {
        var e = jQuery(this).val().toLowerCase(),
            r = jQuery("#tab1 .get-all-users");
        for (i = 0; i < r.length; i++) r[i].innerText.toLowerCase().includes(e) ? r[i].style.display = "block" : r[i].style.display = "none"
    })), jQuery("#tab2 .message-search").on("keyup", (function() {
        var e = jQuery(this).val().toLowerCase(),
            r = jQuery("#tab2 .row");
        for (i = 0; i < r.length; i++) r[i].innerText.toLowerCase().includes(e) ? r[i].style.display = "block" : r[i].style.display = "none"
    }))
})), jQuery(document).on("click", ".inbox_chat a", (function() {
    var e = jQuery(this).parents(".message-sec.side-sec").find(".msg-count").text(),
        r = jQuery(this).find(".unread-msg").text();
    e = parseInt(e), (e -= r = parseInt(r)) >= 0 && (jQuery(this).parents(".message-sec.side-sec").find(".msg-count").text(e), jQuery(".msg-count-out .msg-count").text(e), getMessage(jQuery(this).data("username"), jQuery(this).data("sent-id")), get_unread_users(), jQuery(this).remove())
})), setInterval((function() {
    lmi = jQuery("#lmi").text(), rec = jQuery('#send-message-form input[name="received_by"]').val(), 0 != lmi && jQuery.ajax({
        type: "GET",
        url: site_url + "/buyer-seller/refresh-message/" + lmi + "/" + rec,
        success: function(e) {
            e.lmi > lmi && (lmi = jQuery("#lmi").text(e.lmi), jQuery(".direct-chat-messages").append(e.html), jQuery(".direct-chat-messages").scrollTop(jQuery(".direct-chat-messages")[0].scrollHeight))
        }
    })
}), 1500), jQuery(document).on("click", ".message-all-check input", (function() {
    1 == jQuery(this).prop("checked") ? $(".get-all-users .message-check input").each((function() {
        $(this).prop("checked", !0)
    })) : $(".get-all-users .message-check input").each((function() {
        $(this).prop("checked", !1)
    }))
})), jQuery(document).on("click", ".setPPMCard", (function() {
    jQuery(".cc-card-p").show()
})), jQuery(document).on("click", ".setPPMPaypal", (function() {
    jQuery(".cc-card-p").hide()
})), jQuery(document).on("click", "#select-delete", (function() {
    var e = Array();
    jQuery(".get-all-users .message-check input").each((function() {
        1 == jQuery(this).prop("checked") && -1 === jQuery.inArray(jQuery(this).data("mid"), e) && e.push(jQuery(this).data("mid"))
    })), e.length > 0 && !0 === confirm("Are you sure delete this message") && (jQuery("#load").css("visibility", "visible"), token = $("meta[name='csrf-token']").attr("content"), jQuery.ajax({
        type: "POST",
        url: site_url + "/buyer-seller/check-delete-message",
        data: {
            _token: token,
            sid: e
        },
        success: function() {
            get_all_users(), jQuery("#load").css("visibility", "hidden")
        },
        error: function(e) {
            toastr.error("Bad Request.")
        }
    }))
})), $("#description").keyup((function(e) {
    $("#charter-left").show();
    var r = $("#description"),
        t = $("#my-textarea-length-left"),
        o = r.val().length;
    if (o >= 160 && (r.val(r.val().substring(0, 159)), t.text(0), 8 != e.which)) return !1;
    t.text(160 - o)
})), $((function() {
    $("#add-ad-form").submit((function() {
        return $("#loader-ad").css("display", "block"), $("#upload-ad").hide(), !0
    }))
})), $(document).ready((function() {
    jQuery(document).on("change", "#select-prdouct", (function() {
        var e = $(this).val();
        if (e) {
            var r = {
                _token: token,
                id: e
            };
            $.ajax({
                url: site_url + "/talent-mall/product-url",
                type: "GET",
                data: r,
                success: function(e) {
                    return $("#product-url").val(e.url), !0
                }
            })
        }
    })), $("#banner").change((function() {
        $("#selected-file-name").text("");
        var e = $("#banner")[0].files[0],
            r = $("#banner")[0].files[0].type,
            t = $("#banner")[0].files[0].size;
        if (!($.inArray(r, ["image/gif", "image/jpeg", "image/png", "video/mp4", "video/.wav", "audio/mp3", "audio/ogg", "audio/mpeg"]) > 0)) return toastr.error("Invalid file format. Please choose file with allowed format."), $("#banner").val(""), !1;
        if (t / 1024 > 1e4) return toastr.error("Future Starr accept maximum file sieze 10 MB."), $("#banner").val(""), !1;
        if ("video/mp4" == r || "video/wav" == r) {
            var o = (e = e).type,
                s = new FileReader;
            s.onload = function(e) {
                var r = new Blob([e.target.result], {
                        type: o
                    }),
                    t = (URL || webkitURL).createObjectURL(r),
                    s = document.createElement("video");
                s.preload = "metadata", s.addEventListener("loadedmetadata", (function() {
                    if (s.duration > 90) return toastr.error("Video can be max of 1min 30sec duration."), $("#banner").val(""), !1;
                    (URL || webkitURL).revokeObjectURL(t)
                })), s.src = t
            }, s.readAsArrayBuffer(e)
        }
        $("#selected-file-name").text(e.name)
    }))
})), jQuery(".close-error-pop-btn").click((function() {
    jQuery(".error-pop").hide()
})), $("#commercial").change((function() {
    $("#selected-commercial-file").text("");
    var e = $("#commercial")[0].files[0],
        r = $("#commercial")[0].files[0].type,
        t = $("#commercial")[0].files[0].size;
    if (!($.inArray(r, ["image/gif", "image/jpeg", "image/png", "video/mp4", "video/.wav", "audio/mp3", "audio/ogg", "audio/mpeg"]) > 0)) return toastr.error("Invalid file format. Please choose file with allowed format."), $("#commercial").val(""), !1;
    if (t / 1024 > 1e4) return jQuery(".error-pop.upload-limit-10").show(), $("#commercial").val(""), !1;
    if ("video/mp4" == r || "video/wav" == r) {
        var o = (e = e).type,
            s = new FileReader;
        s.onload = function(e) {
            var r = new Blob([e.target.result], {
                    type: o
                }),
                t = (URL || webkitURL).createObjectURL(r),
                s = document.createElement("video");
            s.preload = "metadata", s.addEventListener("loadedmetadata", (function() {
                if (s.duration > 90) return jQuery(".error-pop.upload-limit-10").show(), $("#commercial").val(""), !1;
                (URL || webkitURL).revokeObjectURL(t)
            })), s.src = t
        }, s.readAsArrayBuffer(e)
    }
    $("#selected-commercial-file").text(e.name)
})), $("#video").change((function() {
    $("#selected-video-file").text("");
    var e = $("#video")[0].files[0],
        r = $("#video")[0].files[0].type,
        t = $("#video")[0].files[0].size;
    if (!($.inArray(r, ["image/gif", "image/jpeg", "image/png", "video/mp4", "video/.wav", "audio/mp3", "audio/ogg", "audio/mpeg"]) > 0)) return toastr.error("Invalid file format. Please choose file with allowed format Error."), $("#video").val(""), !1;
    if (t / 1024 > 1e4) return jQuery(".error-pop.upload-limit-10").show(), $("#video").val(""), !1;
    if ("video/mp4" == r || "video/wav" == r) {
        var o = (e = e).type,
            s = new FileReader;
        s.onload = function(e) {
            var r = new Blob([e.target.result], {
                    type: o
                }),
                t = (URL || webkitURL).createObjectURL(r),
                s = document.createElement("video");
            s.preload = "metadata", s.addEventListener("loadedmetadata", (function() {
                if (s.duration > 90) return jQuery(".error-pop.upload-limit-10").show(), $("#video").val(""), !1;
                (URL || webkitURL).revokeObjectURL(t)
            })), s.src = t
        }, s.readAsArrayBuffer(e)
    }
    $("#selected-video-file").text(e.name)
})), jQuery(document).on("submit", "#add-product-form", (function(e) {
    var r = 0;
    e.preventDefault(), $(this).ajaxForm({
        url: site_url + "/seller/store-product",
        beforeSubmit: function() {
            jQuery(".error-pop.upload-process").show()
        },
        uploadProgress: function(e, t, o, s) {
            var a = s + "%";
            jQuery(".upload-percentage .c100").removeClass("p" + r), jQuery(".upload-percentage .c100").addClass("p" + s), jQuery(".upload-percentage .c100 span").text(a), r = s, 100 == s && setTimeout((function() {
                jQuery(".error-pop.upload-process").hide(), jQuery(".error-pop.send-to-approval").show(), window.location.href = site_url + "/seller/my-product"
            }), 1500)
        },
        error: function(e, r, t) {
            alert("Oops something went.")
        },
        complete: function(e) {
            e.responseText && "error" != e.responseText ? $("#outputImage").html(e.responseText) : ($("#outputImage").show(), $("#outputImage").html("<div class='error'>Problem in uploading file.</div>"), $("#progressBar").stop())
        }
    })
})), jQuery(document).ready((function() {
    jQuery(document).on("click", "section.t-shirts .inner-t-s .swatch ul.swa-body li span", (function() {
        jQuery(this).parents("section.t-shirts .inner-t-s .swatch ul.swa-body li").siblings("li").find("span").removeClass("active"), jQuery(this).addClass("active")
    })), jQuery(document).on("click", "section.t-shirts .inner-t-s button.order-shirt", (function() {
        swatch = Array(), jQuery("section.t-shirts .inner-t-s .swatch ul.swa-body li span.active").each((function(e) {
            null != jQuery(this).data("gender") && (swatch.gender = jQuery(this).data("gender")), null != jQuery(this).data("neck") && (swatch.neck = jQuery(this).data("neck")), null != jQuery(this).data("color") && (swatch.color = jQuery(this).data("color")), null != jQuery(this).data("size") && (swatch.size = jQuery(this).data("size"))
        })), jQuery.ajax({
            url: site_url + "/buyer/t-shirt",
            type: "post",
            data: {
                _token: token,
                gender: swatch.gender,
                neck: swatch.neck,
                color: swatch.color,
                size: swatch.size,
                slug: jQuery(this).data("slug")
            },
            success: function(e) {
                toastr.success("product add in cart"), window.location.href = site_url + "/buyer/t-shirt-checkout"
            },
            error: function(e) {
                toastr.error("Select all variation"), toastr.error("Product not add in cart")
            }
        })
    })), jQuery(".shipping-info .form-check input").click((function() {
        jQuery(".shipping-info .form-check").css({
            "background-color": "",
            border: "",
            "font-weight": ""
        }), jQuery(this).parents(".shipping-info .form-check").css({
            "background-color": "#f5f4f4",
            border: "1px solid #c9302c",
            "font-weight": "600"
        })
    })), jQuery(document).on("click", ".shipping-info .form-check .ch-ship", (function() {
        jQuery.ajax({
            url: site_url + "/buyer/change-shipping",
            type: "post",
            data: {
                _token: token,
                sid: jQuery(this).data("sid")
            },
            success: function(e) {
                toastr.success("Shipping Update"), jQuery(".ts-checkout .check-side").replaceWith(e)
            }
        })
    })), jQuery(document).on("click", ".ts-checkout .cart .item-row .btn.pro-rm", (function() {
        var e = this;
        jQuery.ajax({
            url: site_url + "/buyer/remove-cart-product",
            type: "post",
            data: {
                _token: token,
                sku: jQuery(this).data("sku")
            },
            success: function(r) {
                console.log(r), jQuery(e).parents(".ts-checkout .cart .item-row").remove(), jQuery(".ts-checkout .check-side").replaceWith(r), 0 === jQuery(".ts-checkout .cart .item-row").length && (window.location.href = site_url + "/buyer/t-shirt-checkout"), toastr.success("product removed from cart")
            }
        })
    })), jQuery(document).on("submit", "#saveShippingAddress", (function(e) {
        e.preventDefault(), jQuery.ajax({
            url: site_url + "/buyer/save-shipping-address",
            type: "post",
            data: jQuery(this).serialize(),
            success: function(e) {
                jQuery("#shippingAddressModal").modal("hide"), jQuery(".ts-checkout .chshaddr").replaceWith(e), toastr.success("Shipping Address Updated")
            }
        })
    })), jQuery(document).on("submit", "#saveBillingAddress", (function(e) {
        e.preventDefault(), jQuery.ajax({
            url: site_url + "/buyer/save-billing-address",
            type: "post",
            data: jQuery(this).serialize(),
            success: function(e) {
                jQuery("#billingAddressModal").modal("hide"), jQuery(".ts-checkout .chbladdr").replaceWith(e), toastr.success("Billing Address Updated")
            }
        })
    })), jQuery(document).on("click", ".ts-checkout .pay-w-paypal", (function(e) {
        jQuery(".ts-checkout .form-w-stripe").hide(), jQuery(".ts-checkout .form-w-paypal").show(), jQuery(".ts-checkout .pay-w-stripe").removeClass("active"), jQuery(".ts-checkout .pay-w-paypal").addClass("active")
    })), jQuery(document).on("click", ".ts-checkout .pay-w-stripe", (function(e) {
        jQuery(".ts-checkout .form-w-paypal").hide(), jQuery(".ts-checkout .form-w-stripe").show(), jQuery(".ts-checkout .pay-w-stripe").addClass("active"), jQuery(".ts-checkout .pay-w-paypal").removeClass("active")
    }))
}));;