$(function () {

    $("#trail_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });

    $("#official_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });

    

    $('#enrollment').on('change', function(){
        
        if($(this).val() == 'Trail Enrollment'){
            $('#trail_date_show').show();
            $('#official_date_show').hide();
        } else if($(this).val() == 'Official Enrollment'){
            $('#trail_date_show').hide();
            $('#official_date_show').show();
        } else {
            $('#trail_date_show').hide();
            $('#official_date_show').hide();
        }
    }); 
    // $('#dual_nationality_container').hide();
    var formData = {
        student_name: null,
        department_id: null,
        class_id: null,
        section_id: null,
        session_id: null,
        status: "0",
        academic_year: academic_session_id
    };
    if (studentList !== undefined && studentList !== null) {
        getStudentList(formData);
    }
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#editadmission';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    $("#department_id_filter").on('change', function (e) {
        e.preventDefault();
        var Selector = '#StudentFilter';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="class_id"]').empty();
        $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
        $(Selector).find('select[name="section_id"]').empty();
        $(Selector).find('select[name="section_id"]').append('<option value="">' + select_class + '</option>');
        if (department_id) {
            $.post(getGradeByDepartmentUrl,
                {
                    branch_id: branchID,
                    department_id: department_id
                }, function (res) {
                    if (res.code == 200) {
                        $.each(res.data, function (key, val) {
                            $(Selector).find('select[name="class_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                        if (classID != '') {
                            $(Selector).find('select[name="class_id"]').val(classID);
                        }
                    }
                }, 'json');
        }
    }
    $(".number_validation").keypress(function () {
        var regex = new RegExp("^[0-9-+]");
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
    // $("#student").hide();
    var father_id = $("#father_id").val();
    if (father_id) {
        father(father_id);
    }

    var mother_id = $("#mother_id").val();
    if (mother_id) {
        mother(mother_id);
    }

    var guardian_id = $("#guardian_id").val();
    if (guardian_id) {
        guardian(guardian_id);
    }

    $("#admission_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });

    $("#passport_expiry_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });

    $("#visa_expiry_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });

    $('#passport_photo').change(function () {
        // var i = $(this).prev('label').clone();
        var file = $('#passport_photo')[0].files[0];
        if (file.size > 2097152) {
            $('#passport_photo_name').text("File greater than 2Mb");
            $("#passport_photo_name").addClass("error");
            $('#passport_photo').val('');
        } else {
            $("#passport_photo_name").removeClass("error");
            $('#passport_photo_name').text(file.name);
        }
    });

    $('#visa_photo').change(function () {
        // var i = $(this).prev('label').clone();
        var file = $('#visa_photo')[0].files[0];
        if (file.size > 2097152) {
            $('#visa_photo_name').text("File greater than 2Mb");
            $("#visa_photo_name").addClass("error");
            $('#visa_photo').val('');
        } else {
            $("#visa_photo_name").removeClass("error");
            $('#visa_photo_name').text(file.name);
        }
    });
    $('#nric_photo').change(function () {
        // var i = $(this).prev('label').clone();
        var file = $('#nric_photo')[0].files[0];
        if (file.size > 2097152) {
            $('#nric_photo_name').text("File greater than 2Mb");
            $("#nric_photo_name").addClass("error");
            $('#nric_photo').val('');
        } else {
            $("#nric_photo_name").removeClass("error");
            $('#nric_photo_name').text(file.name);
        }
    });
    $("#visa_type_others_show").hide();

    // Listen for changes in the visa_type dropdown
    $("#visa_type").change(function () {
        // If the selected value is "Others", show the additional input field, otherwise hide it
        if ($(this).val() === "Others") {
            $("#visa_type_others_show").show();
        } else {
            $("#visa_type_others_show").hide();
        }
    });
    $("#dob").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-60:+1", // last hundred years
        maxDate: 0
    });

    $('#guardian_name').keyup(function () {
        var name = $(this).val();
        if (name != '') {
            $.ajax({
                url: parentName,
                method: "GET",
                data: { token: token, branch_id: branchID, name: name },
                success: function (data) {
                    $('#guardian_list').fadeIn();
                    $('#guardian_list').html(data);
                }
            });
        }
    });

    $('#guardian_list').on('click', 'li', function () {

        $('#guardian_name').val($(this).text());
        $('#guardian_list').fadeOut();
        var value = $(this).text();
        if (value == "No results Found") {
            $('#guardian_name').val("");
            $("#guardian_form").hide("slow");
            $("#guardian_photo").hide();

        } else {
            var id = $(this).val();
            guardian(id);

            copyparent();
        }
    });

    function guardian(id) {
        $('#guardian_id').val(id);
        $("#guardian_form").show("slow");
        $("#guardian_info").show();
        $("#guardian_photo").show();
        $.post(parentDetails, { token: token, branch_id: branchID, id: id }, function (res) {
            if (res.code == 200) {
                var data = res.data.parent;
                if (data.photo) {
                    var src = parentImg + "/" + data.photo;
                } else {
                    var src = defaultImg;
                }
                var name = data.first_name + " " + data.last_name;
                var name_furigana = data.first_name_furigana + " " + data.last_name_furigana;
                var name_english = data.first_name_english + " " + data.last_name_english;
                $('#guardian_name_furigana').val(name_furigana);
                $('#guardian_name_english').val(name_english);
                $('#guardian_name').val(name);
                $("#guardian_photo").html('<img src="' + src + '" class="img-fluid d-block rounded" style="width:100px" />');
                $("#guardian_first_name").val(data.first_name);
                $("#guardian_last_name").val(data.last_name);
                $("#guardian_middle_name").val(data.middle_name);
                $("#guardian_last_name_furigana").val(data.last_name_furigana);
                $("#guardian_middle_name_furigana").val(data.middle_name_furigana);
                $("#guardian_middle_name_furigana").val(data.middle_name_furigana);
                $("#guardian_last_name_english").val(data.last_name_english);
                $("#guardian_middle_name_english").val(data.middle_name_english);
                $("#guardian_first_name_english").val(data.first_name_english);
                $("#guardian_company_name_japan").val(data.guardian_company_name_japan);
                $("#guardian_company_name_local").val(data.guardian_company_name_local);
                $("#guardian_company_phone_number").val(data.guardian_company_phone_number);
                $("#guardian_employment_status").val(data.guardian_employment_status);
                $("#guardian_email").val(data.email);
                $("#guardian_nric").val(data.nric);
                $("#guardian_gender").val(data.gender);
                $("#guardian_date_of_birth").val(data.date_of_birth);
                $("#guardian_passport").val(data.passport);
                $("#guardian_country").val(data.country);
                $("#guardian_post_code").val(data.post_code);
                $("#guardian_address_2").val(data.address_2);
                $("#guardian_occupation").val(data.occupation);
                $("#guardian_income").val(data.income);
                $("#guardian_blooddgrp").val(data.blood_group);
                $("#guardian_education").val(data.education);
                $("#guardian_mobile_no").val(data.mobile_no);
                $("#guardian_state").val(data.state);
                $("#guardian_city").val(data.city);
                $("#guardian_address").val(data.address);

                $(".guardian_name").html(name);
                $('.guardian_name_furigana').html(name_furigana);
                $('.guardian_name_english').html(name_english);
                $(".guardian_date_of_birth").html(data.date_of_birth);
                $(".guardian_email").html(data.email);
                $(".guardian_passport").html(data.passport);
                $(".guardian_country").html(data.country);
                $(".guardian_post_code").html(data.post_code);
                $(".guardian_address_2").html(data.address_2);
                $(".guardian_nric").html(data.nric);
                $(".guardian_occupation").html(data.occupation);
                $(".guardian_income").html(data.income);
                $(".guardian_blood_group").html(data.blood_group);
                $(".guardian_education").html(data.education);
                $(".guardian_mobile_no").html(data.mobile_no);
                $(".guardian_state").html(data.state);
                $(".guardian_city").html(data.city);
                $(".guardian_address").html(data.address);
                $(".guardian_company_name_japan").html(data.company_name_japan);
                $(".guardian_company_name_local").html(data.company_name_local);
                $(".guardian_company_phone_number").html(data.company_phone_number);
                $(".guardian_employment_status").html(data.employment_status);
            }
        }, 'json');
    }
    $('#father_name').keyup(function () {
        var name = $(this).val();
        if (name != '') {
            $.ajax({
                url: parentName,
                method: "GET",
                data: { token: token, branch_id: branchID, name: name },
                success: function (data) {
                    $('#father_list').fadeIn();
                    $('#father_list').html(data);
                }
            });
        }
    });

    $('#father_list').on('click', 'li', function () {

        $('#father_name').val($(this).text());
        $('#father_list').fadeOut();
        var value = $(this).text();
        if (value == "No results Found") {
            $('#father_name').val("");
            $("#father_form").hide("slow");
            $("#father_photo").hide();

        } else {
            var id = $(this).val();
            father(id);
        }
    });

    function father(id) {
        $('#father_id').val(id);
        $("#father_form").show("slow");
        $("#father_info").show();
        $("#father_photo").show();
        $.post(parentDetails, { token: token, branch_id: branchID, id: id }, function (res) {
            if (res.code == 200) {
                var data = res.data.parent;
                if (data.photo) {
                    var src = parentImg + "/" + data.photo;
                } else {
                    var src = defaultImg;
                }
                var name = data.first_name + " " + data.last_name;
                var name_furigana = data.first_name_furigana + " " + data.last_name_furigana;
                var name_english = data.first_name_english + " " + data.last_name_english;
                $('#father_name').val(name);
                $('#father_name_furigana').val(name_furigana);
                $('#father_name_english').val(name_english);
                $("#father_photo").html('<img src="' + src + '" class="img-fluid d-block rounded" style="width:100px" />');
                $("#father_first_name").val(data.first_name);
                $("#father_middle_name").val(data.middle_name);
                $("#father_last_name").val(data.last_name);
                $("#father_last_name_furigana").val(data.last_name_furigana);
                $("#father_middle_name_furigana").val(data.middle_name_furigana);
                $("#father_first_name_furigana").val(data.first_name_furigana);
                $("#father_last_name_english").val(data.last_name_english);
                $("#father_middle_name_english").val(data.middle_name_english);
                $("#father_first_name_english").val(data.first_name_english);
                $("#father_nationality").val(data.nationality);
                var nationalityName = data.nationality;
                var countryCode = getCountryCodeByNationality(nationalityName);
                // Find the flag element within the .selected-flag container and update its class
                $(".father .selected-flag .flag").removeClass().addClass("flag " + countryCode);
                $("#father_email").val(data.email);
                $("#father_gender").val(data.gender);
                $("#father_date_of_birth").val(data.date_of_birth);
                $("#father_passport").val(data.passport);
                $("#father_country").val(data.country);
                $("#father_post_code").val(data.post_code);
                $("#father_address_2").val(data.address_2);
                $("#father_nric").val(data.nric);
                $("#father_occupation").val(data.occupation);
                $("#father_income").val(data.income);
                $("#father_blooddgrp").val(data.blood_group);
                $("#father_education").val(data.education);
                $("#father_mobile_no").val(data.mobile_no);
                $("#father_state").val(data.state);
                $("#father_city").val(data.city);
                $("#father_address").val(data.address);



                $(".father_name").html(name);
                $('.father_name_furigana').html(name_furigana)
                $('.father_name_english').html(name_english)
                $(".father_date_of_birth").html(data.date_of_birth);
                $(".father_email").html(data.email);
                $(".father_passport").html(data.passport);
                $(".father_country").html(data.country);
                $(".father_post_code").html(data.post_code);
                $(".father_address_2").html(data.address_2);
                $(".father_nric").html(data.nric);
                $(".father_occupation").html(data.occupation);
                $(".father_income").html(data.income);
                $(".father_blood_group").html(data.blood_group);
                $(".father_education").html(data.education);
                $(".father_mobile_no").html(data.mobile_no);
                $(".father_state").html(data.state);
                $(".father_city").html(data.city);
                $(".father_address").html(data.address);
                $(".father_nationality").html(data.nationality);
            }
        }, 'json');
    }

    $('#mother_name').keyup(function () {
        var name = $(this).val();
        if (name != '') {
            $.ajax({
                url: parentName,
                method: "GET",
                data: { token: token, branch_id: branchID, name: name },
                success: function (data) {
                    $('#mother_list').fadeIn();
                    $('#mother_list').html(data);
                }
            });
        }
    });

    $('#mother_list').on('click', 'li', function () {

        $('#mother_name').val($(this).text());
        $('#mother_list').fadeOut();
        var value = $(this).text();
        if (value == "No results Found") {
            $('#mother_name').val("");
            $("#mother_form").hide("slow");
            $("#mother_photo").hide();

        } else {
            var id = $(this).val();
            mother(id);
        }
    });

    function mother(id) {
        $('#mother_id').val(id);
        // $("#mother_form").show("slow");
        $("#mother_photo").show();
        $("#mother_info").show();
        $.post(parentDetails, { token: token, branch_id: branchID, id: id }, function (res) {
            if (res.code == 200) {
                var data = res.data.parent;
                if (data.photo) {
                    var src = parentImg + "/" + data.photo;
                } else {
                    var src = defaultImg;
                }
                var name = data.first_name + " " + data.last_name;
                var name_furigana = data.first_name_furigana + " " + data.last_name_furigana;
                var name_english = data.first_name_english + " " + data.last_name_english;
                $('#mother_name_furigana').val(name_furigana);
                $('#mother_name_english').val(name_english);
                $('#mother_name').val(name);
                $("#mother_photo").html('<img src="' + src + '" class="img-fluid d-block rounded" style="width:100px" />');
                $("#mother_first_name").val(data.first_name);
                $("#mother_last_name").val(data.last_name);
                $("#mother_middle_name").val(data.middle_name);
                $("#mother_last_name_furigana").val(data.last_name_furigana);
                $("#mother_middle_name_furigana").val(data.middle_name_furigana);
                $("#mother_first_name_furigana").val(data.first_name_furigana);
                $("#mother_last_name_english").val(data.last_name_english);
                $("#mother_middle_name_english").val(data.middle_name_english);
                $("#mother_first_name_english").val(data.first_name_english);
                $("#mother_nationality").val(data.nationality);
                var nationalityName = data.nationality;
                var countryCode = getCountryCodeByNationality(nationalityName);
                // Find the flag element within the .selected-flag container and update its class
                $(".mother .selected-flag .flag").removeClass().addClass("flag " + countryCode);

                $("#mother_email").val(data.email);
                $("#mother_gender").val(data.gender);
                $("#mother_date_of_birth").val(data.date_of_birth);
                $("#mother_passport").val(data.passport);
                $("#mother_country").val(data.country);
                $("#mother_post_code").val(data.post_code);
                $("#mother_address_2").val(data.address_2);
                $("#mother_nric").val(data.nric);
                $("#mother_occupation").val(data.occupation);
                $("#mother_income").val(data.income);
                $("#mother_blooddgrp").val(data.blood_group);
                $("#mother_education").val(data.education);
                $("#mother_mobile_no").val(data.mobile_no);
                $("#mother_state").val(data.state);
                $("#mother_city").val(data.city);
                $("#mother_address").val(data.address);

                $(".mother_name").html(name);
                $('.mother_name_furigana').html(name_furigana)
                $('.mother_name_english').html(name_english)
                $(".mother_date_of_birth").html(data.date_of_birth);
                $(".mother_email").html(data.email);
                $(".mother_passport").html(data.passport);
                $(".mother_country").html(data.country);
                $(".mother_post_code").html(data.post_code);
                $(".mother_address_2").html(data.address_2);
                $(".mother_nric").html(data.nric);
                $(".mother_occupation").html(data.occupation);
                $(".mother_income").html(data.income);
                $(".mother_blood_group").html(data.blood_group);
                $(".mother_education").html(data.education);
                $(".mother_mobile_no").html(data.mobile_no);
                $(".mother_state").html(data.state);
                $(".mother_city").html(data.city);
                $(".mother_address").html(data.address);
                $(".mother_nationality").html(data.nationality);
            }
        }, 'json');
    }
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
    // rules validation

    // get student list
    $('#StudentFilter').on('submit', function (e) {
        e.preventDefault();
        // var StudentFilter = $("#StudentFilter").valid();
        // if (StudentFilter === true) {
        // var academic_year = $('#academic_year').val();
        var student_name = $('#student_name').val();
        var department_id_filter = $('#department_id_filter').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var session_id = $('#session_id').val();
        var status = $('#student_status').val();

        var classObj = {
            student_name: student_name,
            department_id: department_id_filter,
            classID: class_id,
            sectionID: section_id,
            sessionID: session_id,
            userID: userID,
            status: status,
            // academic_year:academic_year
        };
        // setLocalStorageForStudentList(classObj);

        var formData = {
            status: status,
            student_name: student_name,
            department_id: department_id_filter,
            class_id: class_id,
            section_id: section_id,
            session_id: session_id,
            // academic_year:academic_year
        };
        getStudentList(formData);
        // } else {
        //     $("#student").hide("slow");
        // }

    });
    $('#StudentSettingFilter').on('submit', function (e) {
        e.preventDefault();
        var formData = {
            studentDetails: document.getElementById('checkboxStudentDetails').checked,
            parentDetails: document.getElementById('checkboxParentDetails').checked,
            schoolDetails: document.getElementById('checkboxSchoolDetails').checked,
            // academicDetails: document.getElementById('checkboxAcademic').checked,
            // gradeAndClasses: document.getElementById('checkboxGrade').checked,
            // gardeClassAcademic: $('#gardeClassAcademic').val(),
            // attendance: document.getElementById('checkboxAttendance').checked,
            // attendanceAcademic: $('#attendanceAcademic').val(),
            // testResult: document.getElementById('checkboxTestResult').checked,
            // testResultAcademic: $('#testResultAcademic').val()
            // Add similar lines for other checkboxes as needed
            // Add data for dropdowns if needed
        };
        // console.log(formData);
        // Send the data to the server using AJAX
        $.ajax({
            type: 'POST',
            url: studentSettings, // Replace with your Laravel route
            data: formData,
            success: function (response) {
                // Handle success, if needed
                // console.log('Data saved successfully:', response);
                // swal.fire("Success", "Your data has been saved.", "success");
                if (response.code == 200) {
                    toastr.success(response.message);
                    // window.location.href = indexStudent;
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (error) {
                // Handle errors, if needed
                // console.error('Error saving data:', error);
                // swal.fire("Error", "There was an error saving your data.", "error");
                toastr.error(error.message);
            }
        });

    });

    function getStudentList(formData) {
        $("#student").show("slow");
        // set download filter value
        $('#excelStudentName').val(formData.student_name);
        $('#excelDepartment').val(formData.department_id);
        $('#excelClassID').val(formData.class_id);
        $('#excelSectionID').val(formData.section_id);
        $('#excelStatus').val(formData.status);
        $('#excelSession').val(formData.session_id);
        // $('#academicYear').val(formData.academic_year);
        var table = $('#student-table').DataTable({
            processing: true,
            info: true,
            bDestroy: true,
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
            // exportOptions: { rows: ':visible' },
            ajax: {
                url: studentList,
                data: function (d) {
                    Object.assign(d, formData);
                }
            },
            pageLength: 10,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'name', name: 'name' },
                { data: 'name_common', name: 'name_common' },
                { data: 'register_no', name: 'register_no' },
                { data: 'attendance_no', name: 'attendance_no' },
                { data: 'gender', name: 'gender' },
                { data: 'email', name: 'email' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            columnDefs: [
                {
                    targets: 1,
                    className: 'table-user',
                    render: function (data, type, row, meta) {
                        var currentImg = studentImg + row.photo;
                        var img = (row.photo != null) ? currentImg : defaultImg;
                        return '<img src="' + img + '" class="mr-2 rounded-circle">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                    }
                }
            ]
        });

    }

    // function setLocalStorageForStudentList(classObj) {

    //     var studentListDetails = new Object();
    //     studentListDetails.class_id = classObj.classID;
    //     studentListDetails.section_id = classObj.sectionID;
    //     studentListDetails.student_name = classObj.student_name;
    //     studentListDetails.session_id = classObj.sessionID;
    //     // here to attached to avoid localStorage other users to add
    //     studentListDetails.branch_id = branchID;
    //     studentListDetails.role_id = get_roll_id;
    //     studentListDetails.user_id = ref_user_id;
    //     var studentListClassArr = [];
    //     studentListClassArr.push(studentListDetails);
    //     if (get_roll_id == "2") {
    //         // admin
    //         localStorage.removeItem("admin_student_list_details");
    //         localStorage.setItem('admin_student_list_details', JSON.stringify(studentListClassArr));
    //     }
    //     if (get_roll_id == "4") {
    //         // teacher
    //         localStorage.removeItem("teacher_student_list_details");
    //         localStorage.setItem('teacher_student_list_details', JSON.stringify(studentListClassArr));
    //     }
    //     return true;
    // }
    // // if localStorage
    // if (typeof student_list_storage !== 'undefined') {
    //     if ((student_list_storage)) {
    //         if (student_list_storage) {
    //             var studentListStorage = JSON.parse(student_list_storage);
    //             if (studentListStorage.length == 1) {
    //                 var classID, student_name, sectionID, sessionID, userBranchID, userRoleID, userID;
    //                 studentListStorage.forEach(function (user) {
    //                     classID = user.class_id;
    //                     student_name = user.student_name;
    //                     sectionID = user.section_id;
    //                     sessionID = user.session_id;
    //                     userBranchID = user.branch_id;
    //                     userRoleID = user.role_id;
    //                     userID = user.user_id;
    //                 });
    //                 if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
    //                     $('#class_id').val(classID);
    //                     $("#student_name").val(student_name);
    //                     $('#session_id').val(sessionID);
    //                     if (classID) {
    //                         $("#section_id").empty();
    //                         $("#section_id").append('<option value="">' + select_class + '</option>');
    //                         $.post(sectionByClass, { class_id: classID }, function (res) {
    //                             if (res.code == 200) {
    //                                 $.each(res.data, function (key, val) {
    //                                     $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
    //                                 });
    //                                 $("#section_id").val(classID);
    //                             }
    //                         }, 'json');
    //                     }


    //                     var formData = {
    //                         student_name: student_name,
    //                         class_id: classID,
    //                         section_id: sectionID,
    //                         session_id: sessionID,
    //                     };
    //                     getStudentList(formData);
    //                 }
    //             }
    //         }
    //     }
    // }
    // var student_name = $('#student_name').val();
    //     var department_id_filter = $('#department_id_filter').val();
    //     var class_id = $('#class_id').val();
    //     var section_id = $('#section_id').val();
    //     var session_id = $('#session_id').val();

    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        $("#section_id").empty();
        $("#section_id").append('<option value="">' + select_class + '</option>');
        $.post(sectionByClass, { class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    $("#guardian_relation").change(function () {

        copyparent();
    });

    function copyparent() {

        var dataParentId = $('#guardian_relation').find(':selected').data('parent-id');

        var guardianLastName = $('#guardian_last_name').val();
        var guardianMiddleName = $('#guardian_middle_name').val();
        var guardianFirstName = $('#guardian_first_name').val();
        var guardianLastNameFurigana = $('#guardian_last_name_furigana').val();
        var guardianMiddleNameFurigana = $('#guardian_middle_name_furigana').val();
        var guardianFirstNameFurigana = $('#guardian_first_name_furigana').val();
        var guardianLastNameEnglish = $('#guardian_last_name_english').val();
        var guardianMiddleNameEnglish = $('#guardian_middle_name_english').val();
        var guardianFirstNameEnglish = $('#guardian_first_name_english').val();
        var guardianEmail = $('#guardian_email').val();
        var guardianMobileNo = $('#guardian_mobile_no').val();
        var guardianOccupation = $('#guardian_occupation').val();
        var guardianId = $('#guardian_id').val();
        // Check if data-parent-id is 1 for father or 2 for mother
        if (dataParentId === 1 || dataParentId === 2) {

            if (dataParentId === 1) {

                $("#father_form").show("slow");
                $('#skip_father_details').prop('checked', false);
                $('#father_id').val(guardianId);
                $('#father_last_name').val(guardianLastName);
                $('#father_middle_name').val(guardianMiddleName);
                $('#father_first_name').val(guardianFirstName);
                $('#father_last_name_furigana').val(guardianLastNameFurigana);
                $('#father_middle_name_furigana').val(guardianMiddleNameFurigana);
                $('#father_first_name_furigana').val(guardianFirstNameFurigana);
                $('#father_last_name_english').val(guardianLastNameEnglish);
                $('#father_middle_name_english').val(guardianMiddleNameEnglish);
                $('#father_first_name_english').val(guardianFirstNameEnglish);
                $('#father_email').val(guardianEmail);
                $('#father_mobile_no').val(guardianMobileNo);
                $('#father_occupation').val(guardianOccupation);
                $('#father_form input, #father_form select').prop('readonly', true);
                $('#mother_form input, #mother_form select').prop('readonly', false);
                $('#mother_form input').val('');
                $('#mother_form select').val('');
            } else if (dataParentId === 2) {

                $("#mother_form").show("slow");
                $('#skip_mother_details').prop('checked', false);
                $('#mother_id').val(guardianId);
                $('#mother_last_name').val(guardianLastName);
                $('#mother_middle_name').val(guardianMiddleName);
                $('#mother_first_name').val(guardianFirstName);
                $('#mother_last_name_furigana').val(guardianLastNameFurigana);
                $('#mother_middle_name_furigana').val(guardianMiddleNameFurigana);
                $('#mother_first_name_furigana').val(guardianFirstNameFurigana);
                $('#mother_last_name_english').val(guardianLastNameEnglish);
                $('#mother_middle_name_english').val(guardianMiddleNameEnglish);
                $('#mother_first_name_english').val(guardianFirstNameEnglish);
                $('#mother_email').val(guardianEmail);
                $('#mother_mobile_no').val(guardianMobileNo);
                $('#mother_occupation').val(guardianOccupation);
                $('#mother_form input, #mother_form select').prop('readonly', true);
                $('#father_form input, #father_form select').prop('readonly', false);
                $('#father_form input').val('');
                $('#father_form select').val('');
            }
        } else {
            var fatherEmail = $('#father_email').val();
            var motherEmail = $('#mother_email').val();
            // Enable all fields if data-parent-id is neither 1 nor 2
            if (guardianEmail == fatherEmail) {
                $('#father_form input').val('');
                $('#father_form select').val('');
                $('#father_form input, #father_form select').prop('readonly', false);
            } else if (guardianEmail == motherEmail) {
                $('#mother_form input').val('');
                $('#mother_form select').val('');
                $('#mother_form input, #mother_form select').prop('readonly', false);
            }

        }
    }

    // skip_mother_details
    $("#skip_mother_details").on("change", function () {

        if ($(this).is(":checked")) {

            $("#mother_form input").val("");
            $("#mother_form select").val("");
            $("#mother_form").hide("slow");
        } else {
            $("#mother_form").show("slow");
        }
    });
    // skip_father_details
    $("#skip_father_details").on("change", function () {

        if ($(this).is(":checked")) {

            $("#father_form input").val("");
            $("#father_form select").val("");
            $("#father_form").hide("slow");
        } else {
            $("#father_form").show("slow");
        }
    });
    $("#passport, #japanese_association_membership_number_student").on("input", function () {
        var regexp = /^[A-Za-z0-9]+$/;
        if (!regexp.test($(this).val())) {
            $(this).val($(this).val().replace(/[^\w]/gi, ''));
        }
    });
    $(document).ready(function () {
        $("#drp_post_code").change(function () {

            var postalCode = $('#drp_post_code').val();
            var country = $('#drp_country').val();
            var formData = new FormData();
            formData.append('postalCode', postalCode);
            formData.append('country', country);
            console.log(formData);
            $.ajax({
                url: malaysiaPostalCode,
                type: "POST",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    console.log(response);
                    if (response.places && response.places.length > 0) {
                        var place = response.places[0];
                        var city = place['place name'];
                        var state = place['state'];
                        $('#drp_city').val(city);
                        $('#drp_state').val(state);
                    } else {
                        alert('Postal code not found or invalid.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });


        });
    });
    $('#has_dual_nationality_checkbox').change(function () {
        if (this.checked) {
            $('#dual_nationality_container').show();
        } else {
            $('#dual_nationality_container').hide();
        }
    });
    $("#editadmission").validate({
        rules: {
            year: "required",
            // txt_regiter_no: "required",
            txt_emailid: {
                required: true,
                email: true
            },
            // txt_roll_no: "required",
            admission_date: "required",
            classnames: "required",
            department_id: "required",
            class_id: "required",
            // section_id: "required",
            // categy: "required",
            fname: "required",
            txt_mobile_no: "required",
            // school_enrollment_status_tendency: "required",
            // categy: "required",
            fname: "required",
            first_name_english: "required",
            // first_name_furigana: "required",
            txt_mobile_no: "required",
            lname: "required",
            last_name_english: "required",
            // last_name_furigana: "required",
            dob: "required",
            // gender: "required",
            // address_unit_no: "required",
            // address_condominium: "required",
            // address_street: "required",
            // address_district: "required",
            // drp_city: "required",
            // drp_state: "required",
            // drp_country: "required",
            // drp_post_code: "required",
            // txt_religion: "required",
            nationality: "required",
            passport: "required",
            // passport_expiry_date: "required",
            // passport_photo: "required",
            // visa_expiry_date: "required",
            // visa_photo: "required",
            // visa_type: "required",
            japanese_association_membership_number_student: "required",
            // japanese_association_membership_image_principal:"required",
            // txt_prev_schname: "required",
            // school_country: "required",
            // school_state: "required",
            // school_city: "required",
            // school_postal_code: "required",
            // school_enrollment_status: "required",
            father_last_name: "required",
            father_first_name: "required",
            // father_last_name_furigana: "required",
            // father_first_name_furigana: "required",
            father_last_name_english: "required",
            father_first_name_english: "required",
            father_nationality: "required",
            father_email: "required",
            father_mobile_no: "required",
            // father_occupation: "required",
            mother_last_name: "required",
            mother_first_name: "required",
            // mother_last_name_furigana: "required",
            // mother_first_name_furigana: "required",
            mother_last_name_english: "required",
            mother_first_name_english: "required",
            mother_nationality: "required",
            mother_email: "required",
            mother_mobile_no: "required",
            // mother_occupation: "required",
            guardian_last_name: "required",
            guardian_last_name_furigana: "required",
            guardian_last_name_english: "required",
            guardian_first_name_furigana: "required",
            guardian_first_name_english: "required",

            guardian_company_name_japan: "required",
            guardian_company_name_local: "required",
            // guardian_company_phone_number: "required",

            guardian_company_phone_number: {
                required: true,
                minlength: 8
            },
            guardian_employment_status: "required",
            guardian_first_name: "required",
            guardian_relation: "required",
            guardian_phone_number: {
                required: true,
                minlength: 8
            },
            guardian_occupation: "required",
            guardian_email: {
                required: true,
                email: true
            },
            guardian_occupation: "required",

            "passport_photo": {
                required: function (element) {
                    if ($("#passport_old_photo").val() == null) {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
            "visa_photo": {
                required: function (element) {
                    if ($("#visa_old_photo").val() == null) {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
            "japanese_association_membership_image_principal": {
                required: function (element) {
                    if ($("#japanese_association_membership_image_principal_old").val() == null) {
                        return true;
                    } else {
                        return false;
                    }
                }
            },

            // txt_pwd: {
            //     minlength: 6
            // },
            // txt_retype_pwd: {
            //     minlength: 6,
            //     equalTo: "txt_pwd"
            // },  
            password: {
                // required: $("#password").val().length > 0,
                minlength: 6
            },
            confirm_password: {
                // required: $("#confirm_password").val().length > 0,
                minlength: 6,
                equalTo: "#password"
            }
        }
    });

    $('#editadmission').on('submit', function (e) {
        e.preventDefault();
        var admissionCheck = $("#editadmission").valid();
        if (admissionCheck === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        toastr.success(data.message);
                        window.location.href = indexStudent;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // delete Student 
    $(document).on('click', '#deleteStudentBtn', function () {
        var id = $(this).data('id');
        var url = studentDelete;
        swal.fire({
            title: deleteTitle + '?',
            html: deleteHtml,
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: deletecancelButtonText,
            confirmButtonText: deleteconfirmButtonText,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 400,
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $.post(url, {
                    id: id
                }, function (data) {
                    if (data.code == 200) {
                        // $('#student-table').DataTable().ajax.reload(null, false);
                        var student_name = $('#student_name').val();
                        var department_id_filter = $('#department_id_filter').val();
                        var class_id = $('#class_id').val();
                        var section_id = $('#section_id').val();
                        var session_id = $('#session_id').val();
                        var status = $('#student_status').val();

                        var formData = {
                            status: status,
                            student_name: student_name,
                            department_id: department_id_filter,
                            class_id: class_id,
                            section_id: section_id,
                            session_id: session_id,
                            // academic_year:academic_year
                        };
                        getStudentList(formData);
                        toastr.success(data.message);
                    } else {
                        $("#student").hide("slow");
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    $("#drp_transport_route").on('change', function (e) {
        e.preventDefault();
        var route_id = $(this).val();
        $("#drp_transport_vechicleno").empty();
        $("#drp_transport_vechicleno").append('<option value="">' + select_vehicle_number + '</option>');
        $.post(vehicleByRoute, { route_id: route_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#drp_transport_vechicleno").append('<option value="' + val.vehicle_id + '">' + val.vehicle_no + '</option>');
                });
            }
        }, 'json');
    });



    $("#drp_hostelnam").on('change', function (e) {
        e.preventDefault();
        var hostel_id = $(this).val();
        $("#drp_roomname").empty();
        $("#drp_roomname").append('<option value="">' + select_room_name + '</option>');
        $.post(roomByHostel, { hostel_id: hostel_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#drp_roomname").append('<option value="' + val.room_id + '">' + val.room_name + '</option>');
                });
            }
        }, 'json');
    });


    // function getStudentList(formData){
    //     $("#student").show("slow");

    //     $('#student-table').DataTable({
    //         processing: true,
    //         info: true,
    //         bDestroy: true,
    //         // dom: 'lBfrtip',
    //         dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
    //             "<'row'<'col-sm-12'tr>>" +
    //             "<'row'<'col-sm-6'i><'col-sm-6'p>>",
    //         "language": {

    //             "emptyTable": no_data_available,
    //             "infoFiltered": filter_from_total_entries,
    //             "zeroRecords": no_matching_records_found,
    //             "infoEmpty": showing_zero_entries,
    //             "info": showing_entries,
    //             "lengthMenu": show_entries,
    //             "search": datatable_search,
    //             "paginate": {
    //                 "next": next,
    //                 "previous": previous
    //             },
    //         },
    //         buttons: [
    //             {
    //                 extend: 'csv',
    //                 text: downloadcsv,
    //                 extension: '.csv',
    //                 charset: 'utf-8',
    //                 bom: true,
    //                 exportOptions: {
    //                     columns: 'th:not(:last-child)'
    //                 }
    //             },
    //             {
    //                 extend: 'pdf',
    //                 text: downloadpdf,
    //                 extension: '.pdf',
    //                 charset: 'utf-8',
    //                 bom: true,
    //                 exportOptions: {
    //                     columns: 'th:not(:last-child)'
    //                 },


    //                 customize: function (doc) {
    //                 doc.pageMargins = [50,50,50,50];
    //                 doc.defaultStyle.fontSize = 10;
    //                 doc.styles.tableHeader.fontSize = 12;
    //                 doc.styles.title.fontSize = 14;
    //                 // Remove spaces around page title
    //                 doc.content[0].text = doc.content[0].text.trim();
    //                 /*// Create a Header
    //                 doc['header']=(function(page, pages) {
    //                     return {
    //                         columns: [

    //                             {
    //                                 // This is the right column
    //                                 bold: true,
    //                                 fontSize: 20,
    //                                 color: 'Blue',
    //                                 fillColor: '#fff',
    //                                 alignment: 'center',
    //                                 text: header_txt
    //                             }
    //                         ],
    //                         margin:  [50, 15,0,0]
    //                     }
    //                 });*/
    //                 // Create a footer

    //                 doc['footer']=(function(page, pages) {
    //                     return {
    //                         columns: [
    //                             { alignment: 'left', text: [ footer_txt ],width:400} ,
    //                             {
    //                                 // This is the right column
    //                                 alignment: 'right',
    //                                 text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }],
    //                                 width:100

    //                             }
    //                         ],
    //                         margin: [50, 0,0,0]
    //                     }
    //                 });

    //             }
    //         }
    //         ],
    //         serverSide: true,
    //         ajax: {
    //             url: studentList,
    //             data: function (d) {
    //                 d.student_name = formData.student_name,
    //                     d.class_id = formData.class_id,
    //                     d.section_id = formData.section_id,
    //                     d.session_id = formData.session_id
    //             }
    //         },
    //         "pageLength": 10,
    //         "aLengthMenu": [
    //             [5, 10, 25, 50, -1],
    //             [5, 10, 25, 50, "All"]
    //         ],
    //         columns: [
    //             {
    //                 searchable: false,
    //                 data: 'DT_RowIndex',
    //                 name: 'DT_RowIndex'
    //             }
    //             ,
    //             {
    //                 data: 'name',
    //                 name: 'name'
    //             },
    //             {
    //                 data: 'register_no',
    //                 name: 'register_no'
    //             },
    //             {
    //                 data: 'roll_no',
    //                 name: 'roll_no'
    //             },
    //             {
    //                 data: 'gender',
    //                 name: 'gender'
    //             },
    //             {
    //                 data: 'email',
    //                 name: 'email'
    //             },
    //             {
    //                 data: 'actions',
    //                 name: 'actions',
    //                 orderable: false,
    //                 searchable: false
    //             },
    //         ],
    //         columnDefs: [
    //             {
    //                 "targets": 1,
    //                 "className": "table-user",
    //                 "render": function (data, type, row, meta) {
    //                     var currentImg = studentImg + row.photo;
    //                     // var existUrl = UrlExists(currentImg);
    //                     // console.log(currentImg);
    //                     var img = (row.photo != null) ? currentImg : defaultImg;
    //                     var first_name = '<img src="' + img + '" class="mr-2 rounded-circle">' +
    //                         '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
    //                     return first_name;
    //                 }
    //             },
    //         ]
    //     });
    // }
});
