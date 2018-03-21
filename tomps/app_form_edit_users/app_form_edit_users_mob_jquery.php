
function scJQGeneralAdd() {
  scLoadScInput('input:text.sc-js-input');
  scLoadScInput('input:password.sc-js-input');
  scLoadScInput('input:checkbox.sc-js-input');
  scLoadScInput('input:radio.sc-js-input');
  scLoadScInput('select.sc-js-input');
  scLoadScInput('textarea.sc-js-input');

} // scJQGeneralAdd

function scFocusField(sField) {
  var $oField = $('#id_sc_field_' + sField);

  if (0 == $oField.length) {
    $oField = $('input[name=' + sField + ']');
  }

  if (0 == $oField.length && document.F1.elements[sField]) {
    $oField = $(document.F1.elements[sField]);
  }

  if (false == scSetFocusOnField($oField) && $("#id_ac_" + sField).length > 0) {
    if (false == scSetFocusOnField($("#id_ac_" + sField))) {
      setTimeout(function() { scSetFocusOnField($("#id_ac_" + sField)); }, 500);
    }
  }
  else {
    setTimeout(function() { scSetFocusOnField($oField); }, 500);
  }
} // scFocusField

function scSetFocusOnField($oField) {
  if ($oField.length > 0 && $oField[0].offsetHeight > 0 && $oField[0].offsetWidth > 0 && !$oField[0].disabled) {
    $oField[0].focus();
    return true;
  }
  return false;
} // scSetFocusOnField

function scEventControl_init(iSeqRow) {
  scEventControl_data["login" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["pswd" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["confirm_pswd" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["email" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["active" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["priv_mitra" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["kodemitra" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["priv_lokasi" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["groups" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["iddivre" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["idwitel" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["name" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["login" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["login" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["pswd" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["pswd" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["confirm_pswd" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["confirm_pswd" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["email" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["email" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["active" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["active" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["priv_mitra" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["priv_mitra" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["kodemitra" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["kodemitra" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["priv_lokasi" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["priv_lokasi" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["groups" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["groups" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["iddivre" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["iddivre" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["idwitel" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["idwitel" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["name" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["name" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("kodemitra" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("iddivre" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("idwitel" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  scEventControl_data[fieldName]["change"] = false;
} // scEventControl_onFocus

function scEventControl_onBlur(sFieldName) {
  scEventControl_data[sFieldName]["blur"] = false;
  if (scEventControl_data[sFieldName]["change"]) {
        if (scEventControl_data[sFieldName]["original"] == $("#id_sc_field_" + sFieldName).val()) {
          scEventControl_data[sFieldName]["change"] = false;
        }
  }
} // scEventControl_onBlur

function scEventControl_onChange(sFieldName) {
  scEventControl_data[sFieldName]["change"] = false;
} // scEventControl_onChange

function scEventControl_onAutocomp(sFieldName) {
  scEventControl_data[sFieldName]["autocomp"] = false;
} // scEventControl_onChange

var scEventControl_data = {};

function scJQEventsAdd(iSeqRow) {
  $('#id_sc_field_login' + iSeqRow).bind('blur', function() { sc_app_form_edit_users_login_onblur(this, iSeqRow) })
                                   .bind('focus', function() { sc_app_form_edit_users_login_onfocus(this, iSeqRow) });
  $('#id_sc_field_pswd' + iSeqRow).bind('blur', function() { sc_app_form_edit_users_pswd_onblur(this, iSeqRow) })
                                  .bind('focus', function() { sc_app_form_edit_users_pswd_onfocus(this, iSeqRow) });
  $('#id_sc_field_name' + iSeqRow).bind('blur', function() { sc_app_form_edit_users_name_onblur(this, iSeqRow) })
                                  .bind('focus', function() { sc_app_form_edit_users_name_onfocus(this, iSeqRow) });
  $('#id_sc_field_email' + iSeqRow).bind('blur', function() { sc_app_form_edit_users_email_onblur(this, iSeqRow) })
                                   .bind('focus', function() { sc_app_form_edit_users_email_onfocus(this, iSeqRow) });
  $('#id_sc_field_active' + iSeqRow).bind('blur', function() { sc_app_form_edit_users_active_onblur(this, iSeqRow) })
                                    .bind('focus', function() { sc_app_form_edit_users_active_onfocus(this, iSeqRow) });
  $('#id_sc_field_priv_mitra' + iSeqRow).bind('blur', function() { sc_app_form_edit_users_priv_mitra_onblur(this, iSeqRow) })
                                        .bind('click', function() { sc_app_form_edit_users_priv_mitra_onclick(this, iSeqRow) })
                                        .bind('focus', function() { sc_app_form_edit_users_priv_mitra_onfocus(this, iSeqRow) });
  $('#id_sc_field_kodemitra' + iSeqRow).bind('blur', function() { sc_app_form_edit_users_kodemitra_onblur(this, iSeqRow) })
                                       .bind('focus', function() { sc_app_form_edit_users_kodemitra_onfocus(this, iSeqRow) });
  $('#id_sc_field_iddivre' + iSeqRow).bind('blur', function() { sc_app_form_edit_users_iddivre_onblur(this, iSeqRow) })
                                     .bind('change', function() { sc_app_form_edit_users_iddivre_onchange(this, iSeqRow) })
                                     .bind('focus', function() { sc_app_form_edit_users_iddivre_onfocus(this, iSeqRow) });
  $('#id_sc_field_idwitel' + iSeqRow).bind('blur', function() { sc_app_form_edit_users_idwitel_onblur(this, iSeqRow) })
                                     .bind('focus', function() { sc_app_form_edit_users_idwitel_onfocus(this, iSeqRow) });
  $('#id_sc_field_priv_lokasi' + iSeqRow).bind('blur', function() { sc_app_form_edit_users_priv_lokasi_onblur(this, iSeqRow) })
                                         .bind('click', function() { sc_app_form_edit_users_priv_lokasi_onclick(this, iSeqRow) })
                                         .bind('focus', function() { sc_app_form_edit_users_priv_lokasi_onfocus(this, iSeqRow) });
  $('#id_sc_field_groups' + iSeqRow).bind('blur', function() { sc_app_form_edit_users_groups_onblur(this, iSeqRow) })
                                    .bind('focus', function() { sc_app_form_edit_users_groups_onfocus(this, iSeqRow) });
  $('#id_sc_field_confirm_pswd' + iSeqRow).bind('blur', function() { sc_app_form_edit_users_confirm_pswd_onblur(this, iSeqRow) })
                                          .bind('focus', function() { sc_app_form_edit_users_confirm_pswd_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_app_form_edit_users_login_onblur(oThis, iSeqRow) {
  do_ajax_app_form_edit_users_mob_validate_login();
  scCssBlur(oThis);
}

function sc_app_form_edit_users_login_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_form_edit_users_pswd_onblur(oThis, iSeqRow) {
  do_ajax_app_form_edit_users_mob_validate_pswd();
  scCssBlur(oThis);
}

function sc_app_form_edit_users_pswd_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_form_edit_users_name_onblur(oThis, iSeqRow) {
  do_ajax_app_form_edit_users_mob_validate_name();
  scCssBlur(oThis);
}

function sc_app_form_edit_users_name_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_form_edit_users_email_onblur(oThis, iSeqRow) {
  do_ajax_app_form_edit_users_mob_validate_email();
  scCssBlur(oThis);
}

function sc_app_form_edit_users_email_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_form_edit_users_active_onblur(oThis, iSeqRow) {
  do_ajax_app_form_edit_users_mob_validate_active();
  scCssBlur(oThis);
}

function sc_app_form_edit_users_active_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_form_edit_users_priv_mitra_onblur(oThis, iSeqRow) {
  do_ajax_app_form_edit_users_mob_validate_priv_mitra();
  scCssBlur(oThis);
}

function sc_app_form_edit_users_priv_mitra_onclick(oThis, iSeqRow) {
  do_ajax_app_form_edit_users_mob_event_priv_mitra_onclick();
}

function sc_app_form_edit_users_priv_mitra_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_form_edit_users_kodemitra_onblur(oThis, iSeqRow) {
  do_ajax_app_form_edit_users_mob_validate_kodemitra();
  scCssBlur(oThis);
}

function sc_app_form_edit_users_kodemitra_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_form_edit_users_iddivre_onblur(oThis, iSeqRow) {
  do_ajax_app_form_edit_users_mob_validate_iddivre();
  scCssBlur(oThis);
}

function sc_app_form_edit_users_iddivre_onchange(oThis, iSeqRow) {
  do_ajax_app_form_edit_users_mob_refresh_iddivre();
}

function sc_app_form_edit_users_iddivre_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_form_edit_users_idwitel_onblur(oThis, iSeqRow) {
  do_ajax_app_form_edit_users_mob_validate_idwitel();
  scCssBlur(oThis);
}

function sc_app_form_edit_users_idwitel_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_form_edit_users_priv_lokasi_onblur(oThis, iSeqRow) {
  do_ajax_app_form_edit_users_mob_validate_priv_lokasi();
  scCssBlur(oThis);
}

function sc_app_form_edit_users_priv_lokasi_onclick(oThis, iSeqRow) {
  do_ajax_app_form_edit_users_mob_event_priv_lokasi_onclick();
}

function sc_app_form_edit_users_priv_lokasi_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_form_edit_users_groups_onblur(oThis, iSeqRow) {
  do_ajax_app_form_edit_users_mob_validate_groups();
  scCssBlur(oThis);
}

function sc_app_form_edit_users_groups_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_form_edit_users_confirm_pswd_onblur(oThis, iSeqRow) {
  do_ajax_app_form_edit_users_mob_validate_confirm_pswd();
  scCssBlur(oThis);
}

function sc_app_form_edit_users_confirm_pswd_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_app_form_edit_users_mob_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(31);
                }
        }
}
function scJQUploadAdd(iSeqRow) {
} // scJQUploadAdd


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQUploadAdd(iLine);
} // scJQElementsAdd

