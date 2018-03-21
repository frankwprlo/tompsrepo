
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
  scEventControl_data["prepare" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["perijinan" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["inst_testcomm" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["idproject" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["tahapanproject" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["templateproject" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["prepare" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["prepare" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["perijinan" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["perijinan" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["inst_testcomm" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["inst_testcomm" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["idproject" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["idproject" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tahapanproject" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tahapanproject" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["templateproject" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["templateproject" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
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
  $('#id_sc_field_prepare' + iSeqRow).bind('blur', function() { sc_project_edit_update_main_controlclose_prepare_onblur(this, iSeqRow) })
                                     .bind('focus', function() { sc_project_edit_update_main_controlclose_prepare_onfocus(this, iSeqRow) });
  $('#id_sc_field_perijinan' + iSeqRow).bind('blur', function() { sc_project_edit_update_main_controlclose_perijinan_onblur(this, iSeqRow) })
                                       .bind('focus', function() { sc_project_edit_update_main_controlclose_perijinan_onfocus(this, iSeqRow) });
  $('#id_sc_field_inst_testcomm' + iSeqRow).bind('blur', function() { sc_project_edit_update_main_controlclose_inst_testcomm_onblur(this, iSeqRow) })
                                           .bind('focus', function() { sc_project_edit_update_main_controlclose_inst_testcomm_onfocus(this, iSeqRow) });
  $('#id_sc_field_idproject' + iSeqRow).bind('blur', function() { sc_project_edit_update_main_controlclose_idproject_onblur(this, iSeqRow) })
                                       .bind('focus', function() { sc_project_edit_update_main_controlclose_idproject_onfocus(this, iSeqRow) });
  $('#id_sc_field_tahapanproject' + iSeqRow).bind('blur', function() { sc_project_edit_update_main_controlclose_tahapanproject_onblur(this, iSeqRow) })
                                            .bind('focus', function() { sc_project_edit_update_main_controlclose_tahapanproject_onfocus(this, iSeqRow) });
  $('#id_sc_field_templateproject' + iSeqRow).bind('blur', function() { sc_project_edit_update_main_controlclose_templateproject_onblur(this, iSeqRow) })
                                             .bind('focus', function() { sc_project_edit_update_main_controlclose_templateproject_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_project_edit_update_main_controlclose_prepare_onblur(oThis, iSeqRow) {
  do_ajax_project_edit_update_main_controlclose_validate_prepare();
  scCssBlur(oThis);
}

function sc_project_edit_update_main_controlclose_prepare_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_project_edit_update_main_controlclose_perijinan_onblur(oThis, iSeqRow) {
  do_ajax_project_edit_update_main_controlclose_validate_perijinan();
  scCssBlur(oThis);
}

function sc_project_edit_update_main_controlclose_perijinan_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_project_edit_update_main_controlclose_inst_testcomm_onblur(oThis, iSeqRow) {
  do_ajax_project_edit_update_main_controlclose_validate_inst_testcomm();
  scCssBlur(oThis);
}

function sc_project_edit_update_main_controlclose_inst_testcomm_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_project_edit_update_main_controlclose_idproject_onblur(oThis, iSeqRow) {
  do_ajax_project_edit_update_main_controlclose_validate_idproject();
  scCssBlur(oThis);
}

function sc_project_edit_update_main_controlclose_idproject_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_project_edit_update_main_controlclose_tahapanproject_onblur(oThis, iSeqRow) {
  do_ajax_project_edit_update_main_controlclose_validate_tahapanproject();
  scCssBlur(oThis);
}

function sc_project_edit_update_main_controlclose_tahapanproject_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_project_edit_update_main_controlclose_templateproject_onblur(oThis, iSeqRow) {
  do_ajax_project_edit_update_main_controlclose_validate_templateproject();
  scCssBlur(oThis);
}

function sc_project_edit_update_main_controlclose_templateproject_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_project_edit_update_main_controlclose_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(45);
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

