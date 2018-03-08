$(document).ready(function(){
    var images = [];
    if(localStorage.menu == 'true'){
        $('.menu').css({'width':'50px', 'font-size':'0'});
        $('.adminstatus').css('padding', '30px 5px 40px 5px');
        $('.adminstatus text').css({'margin-top':'12px', 'margin-left':'-4px'});
        $('.adminstatus text').find('i').css('display', 'none');
        $('#logoutclick').css({'margin-top':'10px', 'margin-left':'6px'});
        $('.maincontent').css('padding-left','50px')
    }else{
        $('.menu').css({'width':'250px', 'font-size':'14px'});
        $('.adminstatus').css('padding', '30px 15px 40px 15px');
        $('.adminstatus text').css({'margin-top':'3px', 'margin-left':'inherit'});
        $('.adminstatus text').find('i').css('display', 'inline');
        $('#logoutclick').css({'margin-top':'inherit', 'margin-left':'40px'});
        $('.maincontent').css('padding-left','250px')
    }
    $('.loadhere').load('dashboard', function(){
        loadchart();
    });
    $("#admindata").click(function(){
        $(".maindrop").toggle();
    });
    $('#menu-col').click(function(){
        if(localStorage.menu == 'false' || localStorage.menu == null){
            localStorage.setItem('menu', true)
            $('.menu').css({'width':'50px', 'font-size':'0'});
            $('.adminstatus').css('padding', '30px 5px 40px 5px');
            $('.adminstatus text').css({'margin-top':'12px', 'margin-left':'-4px'});
            $('.adminstatus text').find('i').css('display', 'none');
            $('#logoutclick').css({'margin-top':'10px', 'margin-left':'6px'});
            $('.maincontent').css('padding-left','50px')
        }else{
            localStorage.setItem('menu', false)
            $('.menu').css({'width':'250px', 'font-size':'14px'});
            $('.adminstatus').css('padding', '30px 15px 40px 15px');
            $('.adminstatus text').css({'margin-top':'3px', 'margin-left':'inherit'});
            $('.adminstatus text').find('i').css('display', 'inline');
            $('#logoutclick').css({'margin-top':'inherit', 'margin-left':'40px'});
            $('.maincontent').css('padding-left','250px')
        }
    })

    $(".file").change(function() {
        var nrImages = $(".gallery-img").length;
        if( $(".file")[0].files.length > (4 - nrImages) ) {
            alert("You can select only 4 images");
        }else{
            var files   = document.querySelector('.file').files;
            console.log(files);
            function readAndPreview(file) {
                if ( /\.(jpe?g|png)$/i.test(file.name) ) {
                    var reader = new FileReader();
                    reader.addEventListener("load", function () {
                        var image = new Image();
                        image.src = this.result;
                        var lil=this.result;
                        var width = image.width;
                        var height = image.height;
                        var imgggg = lil.split(',')[1];
                        var dataimg = {filename:file.name,content_type:file.type,data:imgggg};
                        image.className = "gallery-img";
                        images.push(dataimg);
                        $('.file-preview ').prepend(image);
                    }, false);

                    reader.readAsDataURL(file);
                }

            }

            if (files) {
                [].forEach.call(files, readAndPreview);
            }

            console.log(images);
        }

    });
    $("#cover").change(function() {
        var nrImages = $(".gallery-img").length;
        if( $("#cover")[0].files.length > (1 - nrImages) ) {
            alert("You can select only 1 images");
        }else{
            var files   = document.querySelector('#cover').files;
            console.log(files);
            function readAndPreview(file) {
                if ( /\.(jpe?g|png)$/i.test(file.name) ) {
                    var reader = new FileReader();
                    reader.addEventListener("load", function () {
                        var image = new Image();
                        image.src = this.result;
                        var lil=this.result;
                        var width = image.width;
                        var height = image.height;
                        var imgggg = lil.split(',')[1];
                        var dataimg = {filename:file.name,content_type:file.type,data:imgggg};
                        image.className = "gallery-img";
                        images.push(dataimg);
                        $('.cover-content').prepend(image);
                        $('#btn-example-file-reset').show();
                    }, false);

                    reader.readAsDataURL(file);
                }

            }

            if (files) {
                [].forEach.call(files, readAndPreview);
            }

            console.log(images);
        }

    });
    $('#btn-example-file-reset').on('click', function(e){
        $(this).hide();
        var $el = $('#cover');
        $('.gallery-img').remove();
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
    });
    $('#addblog').click(function(){
        var title = $('#title').val();
        var cover;
        if($('.cover-content img') == 'undefind'){
            console.log('no cover')
        }else{
            cover = $('.cover-content img').attr('src').split(',')[1];
        }
        var category = $('#hipotek ').find('option:selected').val();
        var description = $('#summernote').summernote('code');
        var data = {title:title, id_category:category, description:description, cover:cover}
        $.post('/admin/blog/posts/add', data, function(response){
            console.log(response)
        })
    })
    // $('#dash').click(function(){
    //     if (!$('#dash').hasClass('active')) {
    //         $('#dash').addClass('active');
    //         $('#dash').siblings().removeClass('active');
    //         $('.loadhere').empty();
    //         $('.loadhere').load('dashboard', function(){
    //             loadchart();
    //             $('.partup').html('Dashboard');
    //             $('.partdown').html('DASHBOARD');
    //             $(".partdesc").html('Welcome back Raiffeisen Bank');
    //         })
    //     }
    // })
    // $('#list').click(function(){
    //     if (!$('#list').hasClass('active')) {
    //         $('#list').addClass('active');
    //         $('#list').siblings().removeClass('active');
    //         $('.loadhere').empty();
    //         $('.loadhere').load('listing', function(){
    //             $('.partup').html('Listing');
    //             $('.partdown').html('LISTING');
    //             $(".partdesc").html('All listing for Shtepia ime');
    //         })
    //     }
    // })
});

function loadchart(){
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        axisY: {
            titleFontColor: "#4F81BC",
            lineColor: "#4F81BC",
            labelFontColor: "#4F81BC",
            tickColor: "#4F81BC"
        },
        axisY2: {
            titleFontColor: "#C0504E",
            lineColor: "#C0504E",
            labelFontColor: "#C0504E",
            tickColor: "#C0504E"
        },
        axisY3: {
            titleFontColor: "#C0504E",
            lineColor: "#C0504E",
            labelFontColor: "#C0504E",
            tickColor: "#C0504E"
        },
        toolTip: {
            shared: true
        },
        legend: {
            cursor: "pointer",
            itemclick: toggleDataSeries
        },
        data: [{
            type: "column",
            name: "Android",
            showInLegend: true,
            yValueFormatString: "#,##0.# Units",
            dataPoints: [
                { label: "Android",  y: 10 },
                { label: "iOS", y: 15 },
                { label: "Website", y: 30 }
            ]
        },
            {
                type: "column",
                name: "iOS",
                showInLegend: true,
                yValueFormatString: "#,##0.# Units",
                dataPoints: [
                    { label: "Android",  y: 10 },
                    { label: "iOS", y: 15 },
                    { label: "Website", y: 30 }
                ]
            },
            {
                type: "column",
                name: "Website",
                showInLegend: true,
                yValueFormatString: "#,##0.# Units",
                dataPoints: [
                    { label: "Android",  y: 10 },
                    { label: "iOS", y: 15 },
                    { label: "Website", y: 30 }
                ]
            }]
    });
    chart.render();

    function toggleDataSeries(e) {
        if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        } else {
            e.dataSeries.visible = true;
        }
        e.chart.render();
    }
    var chart1 = new CanvasJS.Chart("chartContainer1", {
        animationEnabled: true,
        title:{
            text: offers + " Property Listed",
            horizontalAlign: "left"
        },
        data: [{
            type: "doughnut",
            startAngle: 60,
            //innerRadius: 60,
            indexLabelFontSize: 17,
            indexLabel: "{label} - #percent%",
            toolTipContent: "<b>{label}:</b> {y} (#percent%)",
            dataPoints: [
                { y: home / countAll, label: "HOME" },
                { y: newLand / countAll, label: "LAND" },
                { y: apartments / countAll, label: "APARTAMENT/UNIT" },
                { y: houseLand / countAll, label: "HOUSE & LAND"},
                { y: rural / countAll, label: "RURAL"},
            ]
        }]
    });
    chart1.render();
}
