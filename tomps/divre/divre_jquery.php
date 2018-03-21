
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
  scEventControl_data["md_iddivre_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["md_kodedivre_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["md_namadivre_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["md_iddivre_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["md_iddivre_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["md_kodedivre_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["md_kodedivre_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["md_namadivre_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["md_namadivre_" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_active_all() {
  for (var i = 1; i < iAjaxNewLine; i++) {
    if (scEventControl_active(i)) {
      return true;
    }
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
  $('#id_sc_field_md_kodedivre_' + iSeqRow).bind('blur', function() { sc_divre_md_kodedivre__onblur(this, iSeqRow) })
                                           .bind('change', function() { sc_divre_md_kodedivre__onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_divre_md_kodedivre__onfocus(this, iSeqRow) });
  $('#id_sc_field_md_namadivre_' + iSeqRow).bind('blur', function() { sc_divre_md_namadivre__onblur(this, iSeqRow) })
                                           .bind('change', function() { sc_divre_md_namadivre__onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_divre_md_namadivre__onfocus(this, iSeqRow) });
  $('#id_sc_field_md_iddivre_' + iSeqRow).bind('blur', function() { sc_divre_md_iddivre__onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_divre_md_iddivre__onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_divre_md_iddivre__onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_divre_md_kodedivre__onblur(oThis, iSeqRow) {
  do_ajax_divre_validate_md_kodedivre_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_divre_md_kodedivre__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_divre_md_kodedivre__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_divre_md_namadivre__onblur(oThis, iSeqRow) {
  do_ajax_divre_validate_md_namadivre_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_divre_md_namadivre__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_divre_md_namadivre__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_divre_md_iddivre__onblur(oThis, iSeqRow) {
  do_ajax_divre_validate_md_iddivre_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_divre_md_iddivre__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_divre_md_iddivre__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_divre_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(13);
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

