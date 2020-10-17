// Owl Carousel Start..................



$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});








// Owl Carousel End..................


// catch contact data
$('#contactSendbtn').click(function() {
    var contactName = $('#contactName').val();
    var contactMobile = $('#contactMobile').val();
    var contactEmail = $('#contactEmail').val();
    var contactMsg = $('#contactMsg').val();

    contactSendData(contactName, contactMobile, contactEmail,contactMsg);
})
function  contactSendData(contactName,contactMobile,contactEmail,contactMsg){
    if (contactName.length == 0) {
        $('#contactSendbtn').html('Name is not be empty !');
        setTimeout(function () {
            $('#contactSendbtn').html('পাঠিয়ে দিন');
        },1000)
    } else if (contactMobile.length == 0) {
        $('#contactSendbtn').html('Mobile no is not be empty !');
        setTimeout(function () {
            $('#contactSendbtn').html('পাঠিয়ে দিন');
        },1000)
    } else if (contactEmail.length == 0) {
        $('#contactSendbtn').html('Email is not be empty !');
        setTimeout(function () {
            $('#contactSendbtn').html('পাঠিয়ে দিন');
        },1000)
    }else if (contactMsg.length == 0) {
        $('#contactSendbtn').html('Massage is not be empty !');
        setTimeout(function () {
            $('#contactSendbtn').html('পাঠিয়ে দিন');
        },1000)
    } else {
        $('#contactSendbtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
        axios.post('/contactSend', {
            contact_name: contactName,
            contact_mobile: contactMobile,
            contact_email: contactEmail,
            contact_msg: contactMsg,
        })
            .then(function(response) {
                $('#contactSendbtn').html('পাঠিয়ে দিন');
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#contactSendbtn').html('Contact send succefully');
                        setTimeout(function () {
                            $('#contactSendbtn').html('পাঠিয়ে দিন');
                        },1000)
                    } else {
                        $('#contactSendbtn').html('Something watn wrong!');
                        setTimeout(function () {
                            $('#contactSendbtn').html('পাঠিয়ে দিন');
                        },1000)
                    }
                } else {
                    $('#contactSendbtn').html('Something watn wrong!');
                    setTimeout(function () {
                        $('#contactSendbtn').html('পাঠিয়ে দিন');
                    },1000)
                }
            })
            .catch(function(error) {
                $('#contactSendbtn').html('Something watn wrong!');
                setTimeout(function () {
                    $('#contactSendbtn').html('পাঠিয়ে দিন');
                },1000)
            });
    }
}



















































