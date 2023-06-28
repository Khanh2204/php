@extends('admin.master')

@section('Title')
Cửa hàng
@endsection

@section('Content')
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<link href="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.css" rel="stylesheet">

<script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table-locale-all.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.21.4/dist/extensions/export/bootstrap-table-export.min.js"></script>

<style>
  .select,
  #locale {
    width: 100%;
  }
  .like {
    margin-right: 10px;
  }
</style>

<div class="select">
  <select class="form-control" id="locale">
    <option value="af-ZA">af-ZA</option>
    <option value="ar-SA">ar-SA</option>
    <option value="ca-ES">ca-ES</option>
    <option value="cs-CZ">cs-CZ</option>
    <option value="da-DK">da-DK</option>
    <option value="de-DE">de-DE</option>
    <option value="el-GR">el-GR</option>
    <option value="en-US" selected>en-US</option>
    <option value="es-AR">es-AR</option>
    <option value="es-CL">es-CL</option>
    <option value="es-CR">es-CR</option>
    <option value="es-ES">es-ES</option>
    <option value="es-MX">es-MX</option>
    <option value="es-NI">es-NI</option>
    <option value="es-SP">es-SP</option>
    <option value="et-EE">et-EE</option>
    <option value="eu-EU">eu-EU</option>
    <option value="fa-IR">fa-IR</option>
    <option value="fi-FI">fi-FI</option>
    <option value="fr-BE">fr-BE</option>
    <option value="fr-FR">fr-FR</option>
    <option value="he-IL">he-IL</option>
    <option value="hr-HR">hr-HR</option>
    <option value="hu-HU">hu-HU</option>
    <option value="id-ID">id-ID</option>
    <option value="it-IT">it-IT</option>
    <option value="ja-JP">ja-JP</option>
    <option value="ka-GE">ka-GE</option>
    <option value="ko-KR">ko-KR</option>
    <option value="ms-MY">ms-MY</option>
    <option value="nb-NO">nb-NO</option>
    <option value="nl-NL">nl-NL</option>
    <option value="pl-PL">pl-PL</option>
    <option value="pt-BR">pt-BR</option>
    <option value="pt-PT">pt-PT</option>
    <option value="ro-RO">ro-RO</option>
    <option value="ru-RU">ru-RU</option>
    <option value="sk-SK">sk-SK</option>
    <option value="sv-SE">sv-SE</option>
    <option value="th-TH">th-TH</option>
    <option value="tr-TR">tr-TR</option>
    <option value="uk-UA">uk-UA</option>
    <option value="ur-PK">ur-PK</option>
    <option value="uz-Latn-UZ">uz-Latn-UZ</option>
    <option value="vi-VN">vi-VN</option>
    <option value="zh-CN">zh-CN</option>
    <option value="zh-TW">zh-TW</option>
  </select>
</div>

<div id="toolbar">
  <button id="remove" class="btn btn-danger" disabled>
    <i class="fa fa-trash"></i> Delete
  </button>
</div>
<table
  id="table"
  data-toolbar="#toolbar"
  data-search="true"
  data-show-refresh="true"
  data-show-toggle="true"
  data-show-fullscreen="true"
  data-show-columns="true"
  data-show-columns-toggle-all="true"
  data-detail-view="true"
  data-show-export="true"
  data-click-to-select="true"
  data-detail-formatter="detailFormatter"
  data-minimum-count-columns="2"
  data-show-pagination-switch="true"
  data-pagination="true"
  data-id-field="id"
  data-page-list="[5, 10, 15, 20, all]"
  data-show-footer="true"
  data-side-pagination="server"
  data-url="http://127.0.0.1:8000/api/admin/office"
  data-response-handler="responseHandler">
</table>

<script>
  var $table = $('#table')
  var $remove = $('#remove')
  var selections = []

  function getIdSelections() {
    return $.map($table.bootstrapTable('getSelections'), function (row) {
      return row.id
    })
  }

  function responseHandler(res) {
    $.each(res.rows, function (i, row) {
      row.state = $.inArray(row.id, selections) !== -1
    })
    return res
  }

  function detailFormatter(index, row) {
    var html = []
    let st="<tr>"
    $.each(row, function (key, value) {
        st += "<td>"+ value+"</td>";
    //   html.push('<p><b>' + key + ':</b> ' + value + '</p>')
    })
    st +="</tr>";
    html.push(st);
    return html.join('')
  }

  function operateFormatter(value, row, index) {
    return [
      '<a class="like" href="javascript:void(0)" title="Like">',
      '<i class="fa fa-heart"></i>',
      '</a>  ',
      '<a class="remove" href="javascript:void(0)" title="Remove">',
      '<i class="fa fa-trash"></i>',
      '</a>'
    ].join('')
  }

  window.operateEvents = {
    'click .like': function (e, value, row, index) {
      alert('You click like action, row: ' + JSON.stringify(row))
    },
    'click .remove': function (e, value, row, index) {
      $table.bootstrapTable('remove', {
        field: 'id',
        values: [row.id]
      })
    }
  }

  function totalTextFormatter(data) {
    return 'Total'
  }

  function totalNameFormatter(data) {
    return data.length
  }

  function totalPriceFormatter(data) {
    var field = this.field
    return '$' + data.map(function (row) {
      return +row[field].substring(1)
    }).reduce(function (sum, i) {
      return sum + i
    }, 0)
  }

  function initTable() {
    $table.bootstrapTable('destroy').bootstrapTable({
      height: 550,
      locale: $('#locale').val(),
      columns: [
        [{
          field: 'state',
          checkbox: true,
          rowspan: 2,
          align: 'center',
          valign: 'middle'
        }, {
          title: 'Item ID',
          field: 'officeCode',
          rowspan: 2,
          align: 'center',
          valign: 'middle',
          sortable: true,
          footerFormatter: totalTextFormatter
        }, {
          title: 'Item Detail',
          colspan: 5,
          align: 'center'
        }],

        [{
          field: 'officeCode',
          title: 'Tên cửa hàng',
          sortable: true,
          align: 'center',
          footerFormatter: totalNameFormatter
        }, {
          field: 'city',
          title: 'Thành phố',
          sortable: true,
          align: 'center',
          footerFormatter: totalPriceFormatter
        }, {
          field: 'phone',
          title: 'Điện thoại',
          align: 'center',
          
        }, {
          field: 'addressLine1',
          title: 'Địa chỉ',
          sortable: true,
          align: 'center',
          footerFormatter: totalPriceFormatter
        }, {
          field: 'country',
          title: 'Quốc gia',
          sortable: true,
          align: 'center',
          footerFormatter: totalPriceFormatter
        }]
      ]
    })
    $table.on('check.bs.table uncheck.bs.table ' +
      'check-all.bs.table uncheck-all.bs.table',
    function () {
      $remove.prop('disabled', !$table.bootstrapTable('getSelections').length)

      // save your data, here just save the current page
      selections = getIdSelections()
      // push or splice the selections if you want to save all data selections
    })
    $table.on('all.bs.table', function (e, name, args) {
      console.log(name, args)
    })
    $remove.click(function () {
      var ids = getIdSelections()
      $table.bootstrapTable('remove', {
        field: 'id',
        values: ids
      })
      $remove.prop('disabled', true)
    })
  }

  $(function() {
    initTable()

    $('#locale').change(initTable)
  })
</script>
@endsection