
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
  scEventControl_data["po_id_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["po_idproject_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["po_tpmoid_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["po_tipenode_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["po_namanode_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["po_merk_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["po_kapport_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["po_alamatlokasi_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["po_latitude_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["po_longitude_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["po_nosp_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["po_tglbast_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["po_uraian_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["po_witel_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["po_sto_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["po_mitra_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["po_id_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["po_id_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["po_idproject_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["po_idproject_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["po_tpmoid_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["po_tpmoid_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["po_tipenode_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["po_tipenode_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["po_namanode_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["po_namanode_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["po_merk_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["po_merk_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["po_kapport_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["po_kapport_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["po_alamatlokasi_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["po_alamatlokasi_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["po_latitude_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["po_latitude_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["po_longitude_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["po_longitude_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["po_nosp_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["po_nosp_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["po_tglbast_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["po_tglbast_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["po_uraian_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["po_uraian_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["po_witel_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["po_witel_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["po_sto_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["po_sto_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["po_mitra_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["po_mitra_" + iSeqRow]["change"]) {
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
  $('#id_sc_field_po_id_' + iSeqRow).bind('blur', function() { sc_odp_edit_po_id__onblur(this, iSeqRow) })
                                    .bind('change', function() { sc_odp_edit_po_id__onchange(this, iSeqRow) })
                                    .bind('focus', function() { sc_odp_edit_po_id__onfocus(this, iSeqRow) });
  $('#id_sc_field_po_witel_' + iSeqRow).bind('blur', function() { sc_odp_edit_po_witel__onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_odp_edit_po_witel__onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_odp_edit_po_witel__onfocus(this, iSeqRow) });
  $('#id_sc_field_po_sto_' + iSeqRow).bind('blur', function() { sc_odp_edit_po_sto__onblur(this, iSeqRow) })
                                     .bind('change', function() { sc_odp_edit_po_sto__onchange(this, iSeqRow) })
                                     .bind('focus', function() { sc_odp_edit_po_sto__onfocus(this, iSeqRow) });
  $('#id_sc_field_po_tipenode_' + iSeqRow).bind('blur', function() { sc_odp_edit_po_tipenode__onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_odp_edit_po_tipenode__onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_odp_edit_po_tipenode__onfocus(this, iSeqRow) });
  $('#id_sc_field_po_namanode_' + iSeqRow).bind('blur', function() { sc_odp_edit_po_namanode__onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_odp_edit_po_namanode__onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_odp_edit_po_namanode__onfocus(this, iSeqRow) });
  $('#id_sc_field_po_merk_' + iSeqRow).bind('blur', function() { sc_odp_edit_po_merk__onblur(this, iSeqRow) })
                                      .bind('change', function() { sc_odp_edit_po_merk__onchange(this, iSeqRow) })
                                      .bind('focus', function() { sc_odp_edit_po_merk__onfocus(this, iSeqRow) });
  $('#id_sc_field_po_kapport_' + iSeqRow).bind('blur', function() { sc_odp_edit_po_kapport__onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_odp_edit_po_kapport__onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_odp_edit_po_kapport__onfocus(this, iSeqRow) });
  $('#id_sc_field_po_alamatlokasi_' + iSeqRow).bind('blur', function() { sc_odp_edit_po_alamatlokasi__onblur(this, iSeqRow) })
                                              .bind('change', function() { sc_odp_edit_po_alamatlokasi__onchange(this, iSeqRow) })
                                              .bind('focus', function() { sc_odp_edit_po_alamatlokasi__onfocus(this, iSeqRow) });
  $('#id_sc_field_po_latitude_' + iSeqRow).bind('blur', function() { sc_odp_edit_po_latitude__onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_odp_edit_po_latitude__onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_odp_edit_po_latitude__onfocus(this, iSeqRow) });
  $('#id_sc_field_po_longitude_' + iSeqRow).bind('blur', function() { sc_odp_edit_po_longitude__onblur(this, iSeqRow) })
                                           .bind('change', function() { sc_odp_edit_po_longitude__onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_odp_edit_po_longitude__onfocus(this, iSeqRow) });
  $('#id_sc_field_po_mitra_' + iSeqRow).bind('blur', function() { sc_odp_edit_po_mitra__onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_odp_edit_po_mitra__onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_odp_edit_po_mitra__onfocus(this, iSeqRow) });
  $('#id_sc_field_po_nosp_' + iSeqRow).bind('blur', function() { sc_odp_edit_po_nosp__onblur(this, iSeqRow) })
                                      .bind('change', function() { sc_odp_edit_po_nosp__onchange(this, iSeqRow) })
                                      .bind('focus', function() { sc_odp_edit_po_nosp__onfocus(this, iSeqRow) });
  $('#id_sc_field_po_tglbast_' + iSeqRow).bind('blur', function() { sc_odp_edit_po_tglbast__onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_odp_edit_po_tglbast__onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_odp_edit_po_tglbast__onfocus(this, iSeqRow) });
  $('#id_sc_field_po_uraian_' + iSeqRow).bind('blur', function() { sc_odp_edit_po_uraian__onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_odp_edit_po_uraian__onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_odp_edit_po_uraian__onfocus(this, iSeqRow) });
  $('#id_sc_field_po_idproject_' + iSeqRow).bind('blur', function() { sc_odp_edit_po_idproject__onblur(this, iSeqRow) })
                                           .bind('change', function() { sc_odp_edit_po_idproject__onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_odp_edit_po_idproject__onfocus(this, iSeqRow) });
  $('#id_sc_field_po_tpmoid_' + iSeqRow).bind('blur', function() { sc_odp_edit_po_tpmoid__onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_odp_edit_po_tpmoid__onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_odp_edit_po_tpmoid__onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_odp_edit_po_id__onblur(oThis, iSeqRow) {
  do_ajax_odp_edit_validate_po_id_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_odp_edit_po_id__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_odp_edit_po_id__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_odp_edit_po_witel__onblur(oThis, iSeqRow) {
  do_ajax_odp_edit_validate_po_witel_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_odp_edit_po_witel__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_odp_edit_po_witel__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_odp_edit_po_sto__onblur(oThis, iSeqRow) {
  do_ajax_odp_edit_validate_po_sto_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_odp_edit_po_sto__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_odp_edit_po_sto__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_odp_edit_po_tipenode__onblur(oThis, iSeqRow) {
  do_ajax_odp_edit_validate_po_tipenode_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_odp_edit_po_tipenode__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_odp_edit_po_tipenode__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_odp_edit_po_namanode__onblur(oThis, iSeqRow) {
  do_ajax_odp_edit_validate_po_namanode_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_odp_edit_po_namanode__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_odp_edit_po_namanode__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_odp_edit_po_merk__onblur(oThis, iSeqRow) {
  do_ajax_odp_edit_validate_po_merk_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_odp_edit_po_merk__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_odp_edit_po_merk__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_odp_edit_po_kapport__onblur(oThis, iSeqRow) {
  do_ajax_odp_edit_validate_po_kapport_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_odp_edit_po_kapport__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_odp_edit_po_kapport__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_odp_edit_po_alamatlokasi__onblur(oThis, iSeqRow) {
  do_ajax_odp_edit_validate_po_alamatlokasi_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_odp_edit_po_alamatlokasi__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_odp_edit_po_alamatlokasi__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_odp_edit_po_latitude__onblur(oThis, iSeqRow) {
  do_ajax_odp_edit_validate_po_latitude_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_odp_edit_po_latitude__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_odp_edit_po_latitude__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_odp_edit_po_longitude__onblur(oThis, iSeqRow) {
  do_ajax_odp_edit_validate_po_longitude_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_odp_edit_po_longitude__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_odp_edit_po_longitude__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_odp_edit_po_mitra__onblur(oThis, iSeqRow) {
  do_ajax_odp_edit_validate_po_mitra_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_odp_edit_po_mitra__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_odp_edit_po_mitra__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_odp_edit_po_nosp__onblur(oThis, iSeqRow) {
  do_ajax_odp_edit_validate_po_nosp_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_odp_edit_po_nosp__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_odp_edit_po_nosp__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_odp_edit_po_tglbast__onblur(oThis, iSeqRow) {
  do_ajax_odp_edit_validate_po_tglbast_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_odp_edit_po_tglbast__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_odp_edit_po_tglbast__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_odp_edit_po_uraian__onblur(oThis, iSeqRow) {
  do_ajax_odp_edit_validate_po_uraian_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_odp_edit_po_uraian__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_odp_edit_po_uraian__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_odp_edit_po_idproject__onblur(oThis, iSeqRow) {
  do_ajax_odp_edit_validate_po_idproject_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_odp_edit_po_idproject__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_odp_edit_po_idproject__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_odp_edit_po_tpmoid__onblur(oThis, iSeqRow) {
  do_ajax_odp_edit_validate_po_tpmoid_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_odp_edit_po_tpmoid__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_odp_edit_po_tpmoid__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_odp_edit_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(16);
                }
        }
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_po_tglbast_" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_po_tglbast_" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNames: ["<?php      echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['po_tglbast_']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
    buttonImage: "<?php echo $this->jqueryIconFile('calendar'); ?>",
    buttonImageOnly: true,
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  });

  $("#id_sc_field_po_tglentry_" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_po_tglentry_" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNames: ["<?php      echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['po_tglentry_']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
    buttonImage: "<?php echo $this->jqueryIconFile('calendar'); ?>",
    buttonImageOnly: true,
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  });

  $("#id_sc_field_po_tglupdate_" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_po_tglupdate_" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNames: ["<?php      echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['po_tglupdate_']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
    buttonImage: "<?php echo $this->jqueryIconFile('calendar'); ?>",
    buttonImageOnly: true,
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  });

} // scJQCalendarAdd

function scJQUploadAdd(iSeqRow) {
} // scJQUploadAdd


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQCalendarAdd(iLine);
  scJQUploadAdd(iLine);
} // scJQElementsAdd

