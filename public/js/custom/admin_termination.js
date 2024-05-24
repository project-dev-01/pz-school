$(function () {

    $(document).ready(function () {

        $('#terminationModal').on('shown.bs.modal', function () {
            $("#date_of_termination").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                autoclose: true,
                yearRange: "-100:+50", // last hundred years
                container: '#terminationModal modal-body'
            });
        });

    });
    $('#termination_status').on('change', function () {
        var status = $(this).val();
        
        $("#remarks_row").hide();
        $("#date_of_termination_row").hide();
        if(status=="Approved"){

            $("#date_of_termination_row").show();
        }else if(status=="Send Back" || status=="Rejected"){

            $("#remarks_row").show();
        }
    });
    
    $(document).on('click', '#editTerminationBtn', function () {
        
        $('#date_of_termination_row').hide();
        $('#remarks_row').hide();
        $('#student_status_row').hide();
        var id = $(this).data('id');

        // $('.editAbsentReason').find('form')[0].reset();
        $.post(terminationDetails, { id: id,token: token,branch_id: branchID }, function (data) {
            
            // console.log('id',data)
            if (data.code == 200) {
                $('#id').val(data.data.id);
                
                $('#name').text(data.data.name);
                $('#date').text(data.data.date);
                $('#control_number').text(data.data.control_number);
                $('#schedule_date_of_termination').val(data.data.schedule_date_of_termination);
                $('#reason_for_transfer').val(data.data.reason_for_transfer);
                $('#transfer_destination_school_name').val(data.data.transfer_destination_school_name);
                $('#transfer_destination_tel').val(data.data.transfer_destination_tel);
                $('#parent_phone_number_after_transfer').val(data.data.parent_phone_number_after_transfer);
                
                // var parent_phone_number_after_transfer = data.parent_phone_number_after_transfer;
                // var  parent_phone_number_after_transfer_flag= getCountryCodeByNationality(parent_phone_number_after_transfer);
                // // Find the flag element within the .selected-flag container and update its class
                // $(".parent_phone_number_after_transfer .selected-flag .flag").removeClass().addClass("flag " + parent_phone_number_after_transfer_flag);
                $('#parent_email_address_after_transfer').val(data.data.parent_email_address_after_transfer);
                $('#parent_address_after_transfer').val(data.data.parent_address_after_transfer);
                $('#school_fees_payment_status').val(data.data.school_fees_payment_status);
                $('#termination_status').val(data.data.termination_status);
                $('#termination_status_old').val(data.data.termination_status);
                console.log('123',data.data.delete_google_address)
                if(data.data.delete_google_address == "Yes"){
                    $('#delete_google_address').prop('checked',true)
                }
                if(data.data.date_of_termination){
                $('#date_of_termination').val(data.data.date_of_termination);
                $('#date_of_termination_row').show();
                }
                if(data.data.termination_status=="Approved"){
                    // console.log('date_of_termination',date_of_termination)
                    if(data.data.date_of_termination < data.data.today_date ){
                        if(data.data.student_status){
                            $('#student_status').val(data.data.student_status);
                        }else{
                            $('#student_status').val("Deactive");
                        }
                        $('#student_status_row').show();
                    }
                }

                if(data.data.remarks){
                    $('#remarks').val(data.data.remarks);
                    $('#remarks_row').show();
                }
                
                // $('#reason_for_transfer').val(data.data.reason_for_transfer);
                // $('#reason_for_transfer').val(data.data.reason_for_transfer);
            }
            $('.editAbsentReason').modal('show');
        }, 'json');
    });
    
    $("#terminationEditForm").validate({
        rules: {
            date_of_termination : "required", 
            // termination_status: "required", 
            // school_fees_payment_status : "required", 
        }
    });
    // $('#school_fees_payment_status').on('change', function () {
    //     var isUnpaidSelected = $(this).val() === 'Unpaid';
    //     $('#termination_status option[value="Approved"]').prop('disabled', isUnpaidSelected);
    //     $('#termination_status').val('').trigger('change'); 
    // });
    $('#terminationEditForm').on('submit', function(e){
        e.preventDefault();

        var terminationCheck = $("#terminationEditForm").valid();
        if (terminationCheck === true) {
            var form = this;
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:new FormData(form),
                processData:false,
                dataType:'json',
                contentType:false,
                success: function(data){
                    if (data.code == 200) {
                        
                        $('#termination-table').DataTable().ajax.reload(null, false);
                        $('.updateTermination').modal('hide');
                        $('.updateTermination').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    
    terminationTable();
    
    $('#applicationFilter').on('submit', function (e) {
        e.preventDefault();
        terminationTable();
    });
    function terminationTable() {
        
        $('#termination-table').DataTable({
            processing: true,
            info: true,
            bDestroy: true,
            // dom: 'lBfrtip',
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "language": {

                "emptyTable": no_data_available,
                "infoFiltered": filter_from_total_entries,
                "zeroRecords": no_matching_records_found,
                "infoEmpty": showing_zero_entries,
                "info": showing_entries,
                "lengthMenu": show_entries,
                "search": datatable_search,
                "paginate": {
                    "next": next,
                    "previous": previous
                },
            },
            buttons: [
                {
                    extend: 'csv',
                    text: downloadcsv,
                    extension: '.csv',
                    charset: 'utf-8',
                    bom: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    },
                    enabled: false, // Initially disable CSV button
                },
                {
                    extend: 'pdf',
                    text: downloadpdf,
                    extension: '.pdf',
                    charset: 'utf-8',
                    bom: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    },
                    enabled: false, // Initially disable PDF button
                
                    customize: function (doc) {
                    doc.pageMargins = [50,50,50,50];
                    doc.defaultStyle.fontSize = 10;
                    doc.styles.tableHeader.fontSize = 12;
                    doc.styles.title.fontSize = 14;
                    // Remove spaces around page title
                    doc.content[0].text = doc.content[0].text.trim();
                    /*// Create a Header
                    doc['header']=(function(page, pages) {
                        return {
                            columns: [
                                
                                {
                                    // This is the right column
                                    bold: true,
                                    fontSize: 20,
                                    color: 'Blue',
                                    fillColor: '#fff',
                                    alignment: 'center',
                                    text: header_txt
                                }
                            ],
                            margin:  [50, 15,0,0]
                        }
                    });*/
                    // Create a footer
                    
                    doc['footer']=(function(page, pages) {
                        return {
                            columns: [
                                { alignment: 'left', text: [ footer_txt ],width:400} ,
                                {
                                    // This is the right column
                                    alignment: 'right',
                                    text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }],
                                    width:100

                                }
                            ],
                            margin: [50, 0,0,0]
                        }
                    });
                    
                }
            }
            ],
            initComplete: function () {
                var table = this;
                $.ajax({
                    url: terminationList,
                    data: function (d) {                    
                        d.academic_year = $('#academic_year').val(),
                        d.academic_grade = $('#academic_grade').val()
                    },
                    success: function(data) {
                        console.log(data.data.length);
                        if (data && data.data.length > 0) {
                            console.log('ok');
                            $('#application-table_wrapper .buttons-csv').removeClass('disabled');
                            $('#application-table_wrapper .buttons-pdf').removeClass('disabled');  // Enable all buttons if at least one record exists
                        } else {
                            console.log(data);
                            $('#application-table_wrapper .buttons-csv').addClass('disabled');
                            $('#application-table_wrapper .buttons-pdf').addClass('disabled');               
                        }
                    },
                    error: function() {
                        console.log('error');
                        // Handle error if necessary
                    }
                });
            },
            serverSide: true,
            ajax: {
                url: terminationList,
                data: function (d) {
                    
                    d.academic_year = $('#academic_year').val(),
                    d.academic_grade = $('#academic_grade').val()
                }
            },
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            
            columns: [
                //  {data:'id', name:'id'},
                // {
                //     data: 'checkbox',
                //     name: 'checkbox',
                //     orderable: false,
                //     searchable: false
                // },
                {
                    searchable: false,
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'control_number',
                    name: 'control_number'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'name_english',
                    name: 'name_english'
                },
                {
                    data: 'gender',
                    name: 'gender'
                },
                {
                    data: 'parent_email_address_after_transfer',
                    name: 'parent_email_address_after_transfer'
                },
                {
                    data: 'academic_year',
                    name: 'academic_year'
                },
                {
                    data: 'class_name',
                    name: 'class_name'
                },
                {
                    data: 'termination_status',
                    name: 'termination_status'
                },
                {
                    data: 'date_of_termination',
                    name: 'date_of_termination'
                },
                {
                    data: 'school_fees_payment_status',
                    name: 'school_fees_payment_status'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    }
    // delete Termination Type
    $(document).on('click','#deleteTerminationBtn', function(){
        var termination_id = $(this).data('id');
        swal.fire({
             title:deleteTitle + '?',
             html:deleteHtml,
             showCancelButton:true,
             showCloseButton:true,
             cancelButtonText:deletecancelButtonText,
             confirmButtonText:deleteconfirmButtonText,
             cancelButtonColor:'#d33',
             confirmButtonColor:'#556ee6',
             width:400,
             allowOutsideClick:false
        }).then(function(result){
              if(result.value){
                  $.post(terminationDelete,{id:termination_id}, function(data){
                       if(data.code == 200){
                           $('#termination-table').DataTable().ajax.reload(null, false);
                           toastr.success(data.message);
                       }else{
                           toastr.error(data.message);
                       }
                  },'json');
              }
        });
    });

    
var countryCodes = {
"Afghanistan": "af",
"Åland Islands": "ax",
"Albania": "al",
"Algeria": "dz",
"American Samoa": "as",
"Andorra": "ad",
"Angola": "ao",
"Anguilla": "ai",
"Antarctica": "aq",
"Antigua and Barbuda": "ag",
"Argentina": "ar",
"Armenia": "am",
"Aruba": "aw",
"Australia": "au",
"Austria": "at",
"Azerbaijan": "az",
"Bahamas": "bs",
"Bahrain": "bh",
"Bangladesh": "bd",
"Barbados": "bb",
"Belarus": "by",
"Belgium": "be",
"Belize": "bz",
"Benin": "bj",
"Bermuda": "bm",
"Bhutan": "bt",
"Bolivia (Plurinational State of)": "bo",
"Bonaire, Sint Eustatius and Saba": "bq",
"Bosnia and Herzegovina": "ba",
"Botswana": "bw",
"Bouvet Island": "bv",
"Brazil": "br",
"British Indian Ocean Territory": "io",
"United States Minor Outlying Islands": "um",
"Virgin Islands (British)": "vg",
"Virgin Islands (U.S.)": "vi",
"Brunei Darussalam": "bn",
"Bulgaria": "bg",
"Burkina Faso": "bf",
"Burundi": "bi",
"Cambodia": "kh",
"Cameroon": "cm",
"Canada": "ca",
"Cabo Verde": "cv",
"Cayman Islands": "ky",
"Central African Republic": "cf",
"Chad": "td",
"Chile": "cl",
"China": "cn",
"Christmas Island": "cx",
"Cocos (Keeling) Islands": "cc",
"Colombia": "co",
"Comoros": "km",
"Congo": "cg",
"Congo (Democratic Republic of the)": "cd",
"Cook Islands": "ck",
"Costa Rica": "cr",
"Croatia": "hr",
"Cuba": "cu",
"Curaçao": "cw",
"Cyprus": "cy",
"Czech Republic": "cz",
"Denmark": "dk",
"Djibouti": "dj",
"Dominica": "dm",
"Dominican Republic": "do",
"Ecuador": "ec",
"Egypt": "eg",
"El Salvador": "sv",
"Equatorial Guinea": "gq",
"Eritrea": "er",
"Estonia": "ee",
"Eswatini": "sz",
"Ethiopia": "et",
"Falkland Islands (Malvinas)": "fk",
"Faroe Islands": "fo",
"Fiji": "fj",
"Finland": "fi",
"France": "fr",
"French Guiana": "gf",
"French Polynesia": "pf",
"French Southern Territories": "tf",
"Gabon": "ga",
"Gambia": "gm",
"Georgia": "ge",
"Germany": "de",
"Ghana": "gh",
"Gibraltar": "gi",
"Greece": "gr",
"Greenland": "gl",
"Grenada": "gd",
"Guadeloupe": "gp",
"Guam": "gu",
"Guatemala": "gt",
"Guernsey": "gg",
"Guinea": "gn",
"Guinea-Bissau": "gw",
"Guyana": "gy",
"Haiti": "ht",
"Heard Island and McDonald Islands": "hm",
"Holy See": "va",
"Honduras": "hn",
"Hong Kong": "hk",
"Hungary": "hu",
"Iceland": "is",
"India": "in",
"Indonesia": "id",
"Côte d'Ivoire": "ci",
"Iran (Islamic Republic of)": "ir",
"Iraq": "iq",
"Ireland": "ie",
"Isle of Man": "im",
"Israel": "il",
"Italy": "it",
"Jamaica": "jm",
"Japan": "jp",
"Jersey": "je",
"Jordan": "jo",
"Kazakhstan": "kz",
"Kenya": "ke",
"Kiribati": "ki",
"Kuwait": "kw",
"Kyrgyzstan": "kg",
"Lao People's Democratic Republic": "la",
"Latvia": "lv",
"Lebanon": "lb",
"Lesotho": "ls",
"Liberia": "lr",
"Libya": "ly",
"Liechtenstein": "li",
"Lithuania": "lt",
"Luxembourg": "lu",
"Macao": "mo",
"Madagascar": "mg",
"Malawi": "mw",
"Malaysia": "my",
"Maldives": "mv",
"Mali": "ml",
"Malta": "mt",
"Marshall Islands": "mh",
"Martinique": "mq",
"Mauritania": "mr",
"Mauritius": "mu",
"Mayotte": "yt",
"Mexico": "mx",
"Micronesia (Federated States of)": "fm",
"Moldova (Republic of)": "md",
"Monaco": "mc",
"Mongolia": "mn",
"Montenegro": "me",
"Montserrat": "ms",
"Morocco": "ma",
"Mozambique": "mz",
"Myanmar": "mm",
"Namibia": "na",
"Nauru": "nr",
"Nepal": "np",
"Netherlands": "nl",
"New Caledonia": "nc",
"New Zealand": "nz",
"Nicaragua": "ni",
"Niger": "ne",
"Nigeria": "ng",
"Niue": "nu",
"Norfolk Island": "nf",
"Korea (Democratic People's Republic of)": "kp",
"Northern Mariana Islands": "mp",
"Norway": "no",
"Oman": "om",
"Pakistan": "pk",
"Palau": "pw",
"Palestine, State of": "ps",
"Panama": "pa",
"Papua New Guinea": "pg",
"Paraguay": "py",
"Peru": "pe",
"Philippines": "ph",
"Pitcairn": "pn",
"Poland": "pl",
"Portugal": "pt",
"Puerto Rico": "pr",
"Qatar": "qa",
"Republic of North Macedonia": "mk",
"Romania": "ro",
"Russian Federation": "ru",
"Rwanda": "rw",
"Réunion": "re",
"Saint Barthélemy": "bl",
"Saint Helena, Ascension and Tristan da Cunha": "sh",
"Saint Kitts and Nevis": "kn",
"Saint Lucia": "lc",
"Saint Martin (French part)": "mf",
"Saint Pierre and Miquelon": "pm",
"Saint Vincent and the Grenadines": "vc",
"Samoa": "ws",
"San Marino": "sm",
"Sao Tome and Principe": "st",
"Saudi Arabia": "sa",
"Senegal": "sn",
"Serbia": "rs",
"Seychelles": "sc",
"Sierra Leone": "sl",
"Singapore": "sg",
"Sint Maarten (Dutch part)": "sx",
"Slovakia": "sk",
"Slovenia": "si",
"Solomon Islands": "sb",
"Somalia": "so",
"South Africa": "za",
"South Georgia and the South Sandwich Islands": "gs",
"Korea (Republic of)": "kr",
"South Sudan": "ss",
"Spain": "es",
"Sri Lanka": "lk",
"Sudan": "sd",
"Suriname": "sr",
"Svalbard and Jan Mayen": "sj",
"Sweden": "se",
"Switzerland": "ch",
"Syrian Arab Republic": "sy",
"Taiwan": "tw",
"Tajikistan": "tj",
"Tanzania, United Republic of": "tz",
"Thailand": "th",
"Timor-Leste": "tl",
"Togo": "tg",
"Tokelau": "tk",
"Tonga": "to",
"Trinidad and Tobago": "tt",
"Tunisia": "tn",
"Turkey": "tr",
"Turkmenistan": "tm",
"Turks and Caicos Islands": "tc",
"Tuvalu": "tv",
"Uganda": "ug",
"Ukraine": "ua",
"United Arab Emirates": "ae",
"United Kingdom of Great Britain and Northern Ireland": "gb",
"United States of America": "us",
"Uruguay": "uy",
"Uzbekistan": "uz",
"Vanuatu": "vu",
"Venezuela (Bolivarian Republic of)": "ve",
"Viet Nam": "vn",
"Wallis and Futuna": "wf",
"Western Sahara": "eh",
"Yemen": "ye",
"Zambia": "zm",
"Zimbabwe": "zw"
};


// Function to retrieve country code based on nationality name
function getCountryCodeByNationality(nationalityName) {
return countryCodes[nationalityName];
}


});