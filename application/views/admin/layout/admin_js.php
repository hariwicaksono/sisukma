<script type='text/javascript'>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
<script type='text/javascript'>
 /*-- Change Name Image on Update Profile --*/
 $('.custom-file-input').on('change', function(){
  let fileName = $(this).val().split('\\').pop();
  $(this).next('.custom-file-label').addClass("selected").html(fileName);
});
 
 var baseURL= "<?= base_url();?>";

 /*-- Toastr  --*/
 toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-center",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
<?php if ($this->session->flashdata('success')) {?>
  toastr.success("<?php echo $this->session->flashdata('success'); ?>");
<?php } else if ($this->session->flashdata('error')) {?>
  toastr.error("<?php echo $this->session->flashdata('error'); ?>");
<?php } else if ($this->session->flashdata('warning')) {?>
  toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
<?php } else if ($this->session->flashdata('info')) {?>
  toastr.info("<?php echo $this->session->flashdata('info'); ?>");
<?php }?>

/*-- Scanner  --*/

function docReady(fn) {
  /*-- see if DOM is already available  --*/
  if (document.readyState === "complete"
    || document.readyState === "interactive") {
    /*-- call on next available tick  --*/
  setTimeout(fn, 1);
} else {
  document.addEventListener("DOMContentLoaded", fn);
}
}

docReady(function () {
  var resultContainer = document.getElementById('qr_reader_results');
  var lastResult, countResults = 0;
  function onScanSuccess(qrCodeMessage) {
    if (qrCodeMessage !== lastResult) {
      ++countResults;
      lastResult = qrCodeMessage;
      resultContainer.innerHTML
      += `${qrCodeMessage}`;
    }
  }

  var html5QrcodeScanner = new Html5QrcodeScanner(
    "qr-reader", { fps: 10, qrbox: 250 });
  html5QrcodeScanner.render(onScanSuccess);
});
/*-- !Scanner  --*/

/*-- Seacrh Scan  --*/
$('#searchen').on('click', function(e){
  e.preventDefault();
  var kode = $('#qr_reader_results').val();
  var website = "<?= base_url();?>";
  $.ajax({
    url: "<?= base_url('ajax/searchEn/')?>",
    type:"post",
    // data:{kode:kode},
    data:'kode='+kode+'&website=' +website,
    dataType:'json',
    success:function(data){
      $('#kode').val(data.enkripsi);
      $('#n').val(data.n);
      $('#d').val(data.d);
    },
    error:function(data){
      swal({
       title: "Enkripsi Tidak Ada",
       type: "error",
     });
    }
  });
});

/*-- !Seacrh Scan  --*/

/*-- Dekripsi  --*/
$('#dekripsi').click(function(){
  var kode = $('#kode').val()
  var n = $('#n').val();
  var d = $('#d').val();
  swal({

    title: "Loading...",
    text: "Please wait Decryption",
    imageUrl: baseURL+'/assets/esurat/img/loading.gif',
    button: false,
    closeOnClickOutside: false,
    closeOnEsc: false,
    showConfirmButton: false,

  });
  $.ajax({
    type:"POST",
    url: "<?php echo site_url('ajax/getDekripsi/');?>",
    data:'kode='+ kode +'&n='+ n +'&d=' +d,
    dataType:'json',
    success:function(data){

      if(data.success == true){
        $('#hasildekripsi').val(data.dekripsi[1]);
        swal.close();
      }else{
        $.each(data.messages, function(key, value){
          var element = $('#' + key);
          element.closest('.form-control')
          .removeClass('is-invalid')
          .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');
          element.closest('div.form-group').find('.text-danger')
          .remove();
          element.after(value);
        });
      }
    }
  });
});

/*-- !Dekripsi  --*/

$(document).ready(function() {

  $('#addMenuFor').change(function(){
    var role_id = $('#addMenuFor').val();
    if(role_id != ''){
      $.ajax({
        url:baseURL+'ajax/fetchAddMenu',
        method:"POST",
        data:{role_id:role_id},
        success:function(data){
          $('#addMenuTree').html(data);
        }
      })
    }
  });

//   $('#collapseExample').collapse({
//     var table = $('#example').DataTable();
//     table.columns.adjust().draw();  
// })

/*-- Ajax Responsive Table Whitout ServerSide For Mobile  --*/
var table = $('#example').DataTable( {
  rowReorder: {
    selector: 'td:nth-child(0)'
  },
  responsive: true,
});

/*-- Ajax Memilih Tanda Tangan Berdasarkan Dosen  --*/
$('#spkpCosDosen').change(function(){
  var dosen_id = $('#spkpCosDosen').val();
  if(dosen_id != ''){
    $.ajax({
      url:baseURL+'pengajuan/fetchDosenWithTTD',
      method:'POST',
      data:{dosen_id:dosen_id},
      success:function(data){
        $('#spkpCosTTD').val(data);
      }
    });
  }
});

/*-- Ajax Memilih Nim dan Nama Mahasiswa  --*/
$('#spkpCosNIM').change(function(){
  var nimCos = $('#spkpCosNIM').val();
  if(nimCos != ''){
    $.ajax({
      url:baseURL+'pengajuan/fetchNIMWithNama',
      method:'POST',
      dataType : 'json',
      data:{nimCos:nimCos},
      success:function(data){
        $('#spkpCosNama').val(data.nama);
        $('#spkpCosProdi').val(data.prodi);
        $('#spkpCosSemester').val(data.semester);
      }
    });
  }
});

});


$(function () {

  'use strict'

  // Make the dashboard widgets sortable Using jquery UI
  $('.connectedSortable').sortable({
    placeholder         : 'sort-highlight',
    connectWith         : '.connectedSortable',
    handle              : '.card-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex              : 999999
  });
  
  $('.connectedSortable .card-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move');

  /*-- Select 2 --*/
  $('.select2').select2();

  /*-- Timeout Alert Error form_validation 5sec --*/
  var timeout = 5000; 
  $('.alert').delay(timeout).fadeOut(500);

  /*-- Plugin for edit data mahasiswa --*/
  $('[data-mask]').inputmask();

  /*-- DatePicker Plugin to avoid Confict Wit JQuery --*/
  var datepicker = $.fn.datepicker.noConflict();
  $.fn.bootstrapDP = datepicker;    
  $('#tglLhr .input-group.date').datepicker({


  });

});

/*-- DataTable To Load Data Mahasiswa --*/
var mhs = $('#mhs_data').DataTable({ 

  "processing": true, 
  "serverSide": true, 
  "order": [],
  "ajax": {
    "url": baseURL+'ajax/get_data_mhs',
    "type": "POST"

  },

  "columnDefs": [{ 

    "targets": [ 0 ], 
    "orderable": false, 

  }],

  "responsive": true

});

/*-- DataTable To Delete Data Mahasiswa --*/
function deletemhs(nim){

  swal({

    title: "Apakah Anda Yakin Ingin Menghapus?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Ya, Hapus!",
    closeOnConfirm: false

  },

  function(){

    $.ajax({

      url : baseURL+'ajax/dMahasiswaDelete',
      method:"post",
      data:{nim:nim},
      dataType: 'json',

      success:function(data){

        swal("Data Berhasil DiHapus", data.nim, "success");
        $('#mhs_data').DataTable().ajax.reload();

      },

      error:function(data){

        swal("Data Gagal DiHapus", data.nim, "error");
        $('#mhs_data').DataTable().ajax.reload();

      }

    });
  });
};

/*-- DataTable To Load Data PermintaanSurat --*/
var permintaan = $('#pmr_data').DataTable({ 

  "processing": true, 
  "serverSide": true, 
  "order": [],
  "ajax": {
    "url": baseURL+'ajax/get_data_pmr',
    "type": "POST"

  },

  "columnDefs": [{ 

    "targets": [ 0 ], 
    "orderable": false, 

  }],

  "responsive": true

});

/*-- DataTable To Delete PermintaanSurat --*/
function deletepmr(id_permintaan){

  swal({

    title: "Apakah Anda Yakin Ingin Menghapus?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Ya, Hapus!",
    closeOnConfirm: false

  },

  function(){

    $.ajax({

      url : baseURL+'ajax/pengajuanDelete',
      method:"post",
      data:{id_permintaan:id_permintaan},
      dataType: 'json',

      success:function(data){

        swal("Data Berhasil DiHapus", data.id_permintann, "success");
        $('#pmr_data').DataTable().ajax.reload();

      },

      error:function(data){

        swal("Data Gagal DiHapus", data.id_permintann, "error");
        $('#pmr_data').DataTable().ajax.reload();

      }

    });
  });
};

/*-- DataTable To Load Data SuratSelesai --*/
var selesai = $('#sls_data').DataTable({ 

  "processing": true, 
  "serverSide": true, 
  "order": [],
  "ajax": {
    "url": baseURL+'ajax/get_data_sls',
    "type": "POST"

  },

  "columnDefs": [{ 

    "targets": [ 0 ], 
    "orderable": false, 

  }],

  "responsive": true

});

/*-- DataTable To Delete SuratSelesai --*/
function deletesls(id_selesai){

  swal({

    title: "Apakah Anda Yakin Ingin Menghapus?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Ya, Hapus!",
    closeOnConfirm: false

  },

  function(){

    $.ajax({

      url : baseURL+'ajax/deleteSelesai',
      method:"post",
      data:{id_selesai:id_selesai},
      dataType: 'json',

      success:function(data){

        swal("Data Berhasil DiHapus", data.id_selesai, "success");
        $('#sls_data').DataTable().ajax.reload();

      },

      error:function(data){

        swal("Data Gagal DiHapus", data.id_selesai, "error");
        $('#sls_data').DataTable().ajax.reload();

      }

    });
  });
};

/*-- Ajax Generate No Surat, Enkripsi And Convert Permintaan Surat  --*/
$( "#generatePmr" ).click(function() {

  var id = $('#zz').val();
  swal({

    title: "Loading...",
    text: "Please wait Generating No Surat, Enkripsi and Convert",
    imageUrl: baseURL+'/assets/esurat/img/loading.gif',
    button: false,
    closeOnClickOutside: false,
    closeOnEsc: false,
    showConfirmButton: false,

  });

  /*-- Ajax Generate No Surat Permintaan Surat  --*/
  $.ajax({

    url : baseURL+'pengajuan/getNoSuratPmr',
    method :'post',
    data : {id:id},

    success:function(data){

      $('#no_surat').val(data);

      var no_surat = data;

      /*-- Ajax Generate Enkripsi Permintaan Surat  --*/
      $.ajax({

        url : baseURL+'pengajuan/getEnkripsiPmr',
        method : 'post',
        data : 'no_surat=' +no_surat+ '&id='+id,
        dataType : 'json',
        success : function(data){

          $('#spkpHasilEnkripsi').val(data.enkripsi);

          var url = baseURL;
          var enkripsi = data.enkripsi;

          /*-- Ajax Generate Convert Permintaan Surat  --*/
          $.ajax({

            url : baseURL+'pengajuan/getconvertPmr',
            method:"post",
            data:'domain='+url+'&enkripsi=' +enkripsi+'&no_surat='+no_surat,
            success:function(data){

              swal({

                title: "Berhasil",
                text: "Generate No Surat, Enkripsi dan Convert",
                type: "success",
                showConfirmButton: true

              });

              var namafile = "<?php echo base_url('assets/esurat/img/QRCode/') ?>" + data.replace("/", "_")+".png";
              $("#qrcode").attr("src",namafile);

            },
            error:function(data){

              swal({

                title: "Gagal",
                text : "Menconvert QR Code",
                type: "error",
                showConfirmButton: true

              });
            }
          });
          /*-- / Ajax Convert Permintaan Surat  --*/

        },
        error:function(data){

          swal({

            title: "Gagal",
            text : "Mengenkripsi No Surat",
            type: "error",
            showConfirmButton: true

          });
        }
      });
      /*-- / Ajax Enkripsi Permintaan Surat  --*/

    },
    error:function(data){

      swal({

        title: "Gagal",
        text : "Generate No Surat",
        type: "error",
        showConfirmButton: true

      });

    }
  });
  /*-- / Ajax Generate No Surat Permintaan Surat  --*/

});
/*-- / Ajax Generate No Surat, Enkripsi And Convert Permintaan Surat  --*/


/*-- Ajax Generate No Surat, Enkripsi And Convert Costum Surat  --*/
$( "#generateCos" ).click(function() {

  var kd_suratCos = $('#spkpCosKodeSurat').val();
  swal({

    title: "Loading...",
    text: "Please wait Generating No Surat, Enkripsi and Convert",
    imageUrl: baseURL+'/assets/esurat/img/loading.gif',
    button: false,
    closeOnClickOutside: false,
    closeOnEsc: false,
    showConfirmButton: false,

  });

  /*-- Ajax Generate No Surat Costum Surat  --*/
  $.ajax({

    url : baseURL+'pengajuan/getNoSuratCos',
    method :'post',
    data : {kd_suratCos:kd_suratCos},

    success:function(data){

      $('#spkpCosNo_surat').val(data);

      var no_suratCos = data;

      /*-- Ajax Generate Enkripsi Costum Surat  --*/
      $.ajax({

        url : baseURL+'pengajuan/getEnkripsiCos',
        method : 'post',
        data : 'no_suratCos=' +no_suratCos,
        dataType : 'json',
        success : function(data){

          $('#spkpCosP').val(data.pCos);
          $('#spkpCosQ').val(data.qCos);
          $('#spkpCosN').val(data.nCos);
          $('#spkpCosE').val(data.eCos);
          $('#spkpCosD').val(data.dCos);
          $('#spkpCosHasilEnkripsi').val(data.enkripsiCos);

          var urlCos = baseURL;
          var enkripsiCos = data.enkripsiCos;

          /*-- Ajax Generate Convert Costum Surat  --*/
          $.ajax({

            url : baseURL+'pengajuan/getconvertCos',
            method:"post",
            data:'domainCos='+urlCos+'&enkripsiCos=' +enkripsiCos+'&no_suratCos='+no_suratCos,
            success:function(data){

              swal({

                title: "Berhasil",
                text: "Generate No Surat, Enkripsi dan Convert",
                type: "success",
                showConfirmButton: true

              });

              var namafile = "<?php echo base_url('assets/esurat/img/QRCode/') ?>" + data.replace("/", "_")+".png";
              $("#qrcodeCos").attr("src",namafile);

            },
            error:function(data){

              swal({

                title: "Gagal",
                text : "Menconvert QR Code",
                type: "error",
                showConfirmButton: true

              });
            }
          });
          /*-- / Ajax Convert Costum Surat  --*/

        },
        error:function(data){

          swal({

            title: "Gagal",
            text : "Mengenkripsi No Surat",
            type: "error",
            showConfirmButton: true

          });
        }
      });
      /*-- / Ajax Enkripsi Costum Surat  --*/

    },
    error:function(data){

      swal({

        title: "Gagal",
        text : "Generate No Surat",
        type: "error",
        showConfirmButton: true

      });

    }
  });
  /*-- / Ajax Generate No Surat Costum Surat  --*/

});
/*-- / Ajax Generate No Surat, Enkripsi And Convert Costum Surat  --*/

</script>