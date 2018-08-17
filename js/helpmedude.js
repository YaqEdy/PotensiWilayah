function getMonthNum(val) {
    switch (val) {
        case 'January':
            return '1';
            break;
        case 'February':
            return '2';
            break;
        case 'March':
            return '3';
            break;
        case 'April':
            return '4';
            break;
        case 'May':
            return '5';
            break;
        case 'June':
            return '6';
            break;
        case 'July':
            return '7';
            break;
        case 'August':
            return '8';
            break;
        case 'September':
            return '9';
            break;
        case 'October':
            return '10';
            break;
        case 'November':
            return '11';
            break;
        case 'December':
            return '12';
            break;
        default:
            return '';
    }
}


//---AJAX FORM ---//	

function ajaxAction(sUrl, sFocus) {
    ajaxModal();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: base_url() + sUrl,
        data: dataString,
        success: function (data) {
            $('#id_Reload').trigger('click');
            $('#id_btnBatal').trigger('click');
            UIToastr.init(data.tipePesan, data.pesan);
        }

    });
    $('#' + sFocus).focus();
}

function getAksiBtn(val) {
    var sRet = new Array();
    switch (val) {
        case '1':
            sRet['action'] = 'simpan';
            sRet['alertconfirm'] = 'Anda yakin menyimpan data ini?';
            break;
        case '2':
            sRet['action'] = 'ubah';
            sRet['alertconfirm'] = 'Anda yakin merubah data ini?';
            break;
        case '3':
            sRet['action'] = 'hapus';
            sRet['alertconfirm'] = 'Anda yakin menghapus data ini?';
            break;
        default:
            return false;
    }
    return sRet;
}

//--------------//


    